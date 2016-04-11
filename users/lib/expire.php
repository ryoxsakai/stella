<?php

//★基本設定/////////////////////////////////////////////////////////

$conn = mysql_connect('mysql116.heteml.jp','_stella','sugarless');
mysql_select_db('_stella',$conn);
mysql_set_charset('utf8',$conn);

//☆////////////////////////////////////////////////////////////////

if($_POST['flag']=="exitexpiration"){

  //---課金情報---
  require_once 'webpay.php';

  //カスタマーIDがあるかどうかチェック
  $sql="SELECT customerid from stella_userbasic where userid = '{$_COOKIE['userid']}'";
  $query = mysql_query($sql,$conn);
  while ($row = @mysql_fetch_array($query, MYSQL_BOTH)){
    if($row['customerid']!=''){
      try{
        $oldcusid = $row['customerid'];
        WebPayDeleteCustomer($row['customerid']);
        stella_actionreport_insert($_COOKIE['userid'],'card_delete',"古いクレジットカード情報(下4ケタ：{$customer->active_card->last4})を削除しました");
        $sql = "UPDATE stella_userbasic SET customerid = '' where userid = '{$_COOKIE['userid']}'";
        $query = mysql_query($sql,$conn);
      }catch (Stripe_InvalidRequestError $e) {
        //nothing
      }
    }
  }
  
  //新しくカスタマーIDを作成
    try{
      $e = WebPayCreateCustomer($_POST);
      //カスタマーIDの書き込み
      $fp = fopen(FULLPATH.'magazineSecret.txt', "w");
      @fwrite($fp, $e, strlen($e) );
      fclose($fp);
      $sql = "UPDATE stella_userbasic SET customerid = '{$e}' where userid = '{$_COOKIE['userid']}'";
      $query = mysql_query($sql,$conn);
    }catch(Stripe_CardError $e) {
      $sql = "UPDATE stella_userbasic SET card_validation = 0 where userid = '{$_COOKIE['userid']}'";
      $query = mysql_query($sql,$conn);
      $info .= "カード情報の有効性が確認できません (エラーコード：{$err['code']}) {$err['message']}";
    }catch (Stripe_InvalidRequestError $e) {
      $sql = "UPDATE stella_userbasic SET card_validation = 0 where userid = '{$_COOKIE['userid']}'";
      $query = mysql_query($sql,$conn);
      $info .= "カード情報の有効性が確認できません (エラーコード：{$err['code']}) {$err['message']}";
    }
  
  //日割の料金売上
  $userid = stella_userbasic_search('userid','customerid',$e);
  $data['amount'] = $_POST['amount'];
  $data['customer'] = $e;
  $data['description'] = '[stella] '.$userid.' : '.date('n').'月分の日割料金として'.$data['amount'].'円を課金しました';
  try{
    //WebPayCustomerCharge($data);
    //stella_actionreport_insert($_COOKIE['userid'],'make_charge',date('n').'月分の日割料金として'.$data['amount'].'円を課金しました');
    // 有効性情報をTRUEに
    $sql = "UPDATE stella_userbasic SET card_validation = 1 where userid = '{$_COOKIE['userid']}'";
    $query = mysql_query($sql,$conn);
  }catch(Stripe_CardError $e) {
    // カードが拒否された場合
    $body = $e->getJsonBody();
    $err = $body['error'];
    stella_actionreport_insert($_COOKIE['userid'],'card_error',"カード情報の有効性が確認できません (エラーコード：{$err['code']}) {$err['message']}");
    // 有効性情報をFALSEに
    $sql = "UPDATE stella_userbasic SET card_validation = 0 where userid = '{$_COOKIE['userid']}'";
    $query = mysql_query($sql,$conn);
    $info .= "カード情報の有効性が確認できません (エラーコード：{$err['code']}) {$err['message']}";
  } catch (Stripe_InvalidRequestError $e) {
    // リクエストで指定したパラメータが不正な場合
    $info .= "カード情報の有効性が確認できません (情報を再度入力してください)";
  } catch (Stripe_AuthenticationError $e) {
    // 認証に失敗した場合
    $info .= "認証に失敗しました。この状態が長く続く場合はお問合せください。";
  } catch (Stripe_ApiConnectionError $e) {
    // APIへの接続エラーが起きた場合
    $info .= "接続に失敗しました。この状態が長く続く場合はお問合せください。";
  } catch (Stripe_Error $e) {
    // WebPayのサーバでエラーが起きた場合
    $info .= "サーバーエラーが発生しました。この状態が長く続く場合はお問合せください。";
  } catch (Exception $e) {
    // WebPayとは関係ない例外の場合
    $info .= "予期しないエラーが発生しました。この状態が長く続く場合はお問合せください。";
  }

}

?>