<?php

  require_once 'lib/function.php';
  require_once 'lib/webpay.php';
  
  //当月の課金処理をしていない場合
  if(!file_exists('lib/charge/'.date('Y-m-').'charge.txt')){
    if($_POST['flag']=="check"){
      foreach($_POST as $key => $value){
        if(substr($key,0,3)=="cus"){
          if($value!=0){
            //---cusからuseridを検索---
            $userid = stella_userbasic_search('userid','customerid',$key);
            //---課金する---
            $data['amount']   = $value;
            $data['customer'] = $key;
            $data['description'] = '[stella] '.$userid.' : '.date('n').'月分の課金として'.$value.'円を課金しました';
            $query .= $data['description'] . '<br />';
            try{
              WebPayCustomerCharge($data);
              stella_actionreport_insert($userid,'make_charge',date('n').'月分の課金として'.$value.'円を課金しました');
              // 有効性情報をTRUEに
              $sql = "UPDATE stella_userbasic SET card_validation = 1 where userid = '{$userid}'";
              $query = mysql_query($sql,$conn);
              $info = "課金処理を完了しました";
            }catch(Stripe_CardError $e) {
              // カードが拒否された場合
              $body = $e->getJsonBody();
              $err = $body['error'];
              stella_actionreport_insert($userid,'card_error',"カード情報の有効性が確認できません (エラーコード：{$err['code']}) {$err['message']}");
              // 有効性情報をFALSEに
              $sql = "UPDATE stella_userbasic SET card_validation = 0 where userid = '$userid'";
              $query = mysql_query($sql,$conn);
              $info .= "{$userid} : カード情報の有効性が確認できません (エラーコード：{$err['code']}) {$err['message']}";
            } catch (Stripe_InvalidRequestError $e) {
              // リクエストで指定したパラメータが不正な場合
              $info .= "{$userid} : カード情報の有効性が確認できません (情報を再度入力してください)";
            } catch (Stripe_AuthenticationError $e) {
              // 認証に失敗した場合
              $info .= "{$userid} : 認証に失敗しました。この状態が長く続く場合はお問合せください。";
            } catch (Stripe_ApiConnectionError $e) {
              // APIへの接続エラーが起きた場合
              $info .= "{$userid} : 接続に失敗しました。この状態が長く続く場合はお問合せください。";
            } catch (Stripe_Error $e) {
              // WebPayのサーバでエラーが起きた場合
              $info .= "{$userid} : サーバーエラーが発生しました。この状態が長く続く場合はお問合せください。";
            } catch (Exception $e) {
              // WebPayとは関係ない例外の場合
              $info .= "{$userid} : 予期しないエラーが発生しました。この状態が長く続く場合はお問合せください。";
            }
          }
        }
      }

      //課金ファイルを作成
      $fp = fopen('lib/charge/'.date('Y-m-').'charge.txt', "w");
      @fwrite($fp, 'done', strlen('done'));
      fclose($fp);
      
$body = <<< EOF
      <p>下記の課金処理を行いましたのでご確認ください。</p>
      <div class="multicolumn"><p>{$query}<p></div>
EOF;

    }else{
      $info = "課金処理を行います";
      $plate = stella_userbasic_paymentplate();
$body = <<< EOF
      <form method="post">
        <table class="multitable">{$plate}</table>
        <div class="design"><input type="submit" value="確定" /></div>
        <input type="hidden" name="flag" value="check" />
      </form>
EOF;
    }
  }else{
    $m = date('n');
    $info = "今月の課金処理は終了しました";
$body = <<< EOF
      <p>{$m}月分の課金処理は終了しています</p>
EOF;
  }

?>