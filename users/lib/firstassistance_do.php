<?php

//★基本設定/////////////////////////////////////////////////////////

$conn = mysql_connect('mysql116.heteml.jp','_stella','sugarless');
mysql_select_db('_stella',$conn);
mysql_set_charset('utf8',$conn);

//☆////////////////////////////////////////////////////////////////

//ファイルの書き込み//
define("FULLPATH", 'server/u/'.$_COOKIE['userid'].'/');

$magazineFooter = @file_get_contents('lib/default/footer.txt');
$magazineWelcomeMail = @file_get_contents('lib/default/welcomeMail.txt');

if($_POST['flag']=="firstAssistance"){

  //フォルダ作成
  if (!file_exists('server/u')) {
    mkdir('server/u');
  }
  mkdir(FULLPATH);
  
  //テーブル作成
  $sql = "CREATE TABLE userdata_{$_COOKIE['userid']}_holder (code int(11) auto_increment primary key, regtime varchar(20), sendtime varchar(20), title text, content text, status text)";
  $query = mysql_query($sql,$conn);
  $sql = "CREATE TABLE userdata_{$_COOKIE['userid']}_list (code int(11) auto_increment primary key, nickname text, age varchar(20), sex varchar(20), address text, job text, prefecture text, step varchar(10), verifier text, state text)";
  $query = mysql_query($sql,$conn);
  
  //テスト設定
  $regtime = time();$sendtime = time();
  $sql = "INSERT INTO userdata_{$_COOKIE['userid']}_holder (code,regtime,sendtime,title,content,status) VALUES ('','{$regtime}','{$sendtime}','stellaへようこそ','ステラをご利用頂きましてまことにありがとうございます。
テストデータにつき、削除していただいてかまいません。','draft')";
  $query = mysql_query($sql,$conn);
  $sql = "INSERT INTO userdata_{$_COOKIE['userid']}_list (code,nickname,age,sex,address,prefecture,job,step,state) VALUES ('','ステラ事務局','20','','usermagazine@stella-mail.com','東京都','メルマガスタンド','0','valid')";
  $query = mysql_query($sql,$conn);
  
  //magazineFrom
  $fp = fopen(FULLPATH.'magazineFrom.txt', "w");
  @fwrite($fp, $_POST['magazineFrom'], strlen($_POST['magazineFrom']) );
  fclose($fp);

  //magazineTitle
  $fp = fopen(FULLPATH.'magazineTitle.txt', "w");
  @fwrite($fp, $_POST['magazineTitle'], strlen($_POST['magazineTitle']) );
  fclose($fp);

  //magazineHeader
  $fp = fopen(FULLPATH.'magazineHeader.txt', "w");
  @fwrite($fp, $_POST['magazineHeader'], strlen($_POST['magazineHeader']) );
  fclose($fp);

  //magazineTitle
  $fp = fopen(FULLPATH.'magazineFooter.txt', "w");
  @fwrite($fp, $_POST['magazineFooter'], strlen($_POST['magazineFooter']) );
  fclose($fp);

  //magazineTestAddress
  $fp = fopen(FULLPATH.'magazineTestAddress.txt', "w");
  @fwrite($fp, $_POST['magazineTestAddress'], strlen($_POST['magazineTestAddress']) );
  fclose($fp);

  //magazineWelcomeMail
  $fp = fopen(FULLPATH.'magazineWelcomeMail.txt', "w");
  @fwrite($fp, $_POST['magazineWelcomeMail'], strlen($_POST['magazineWelcomeMail']) );
  fclose($fp);

  //---課金情報---
  require_once 'webpay.php';
  $e = WebPayCreateCustomer($_POST);

  //カスタマーIDの書き込み
  $fp = fopen(FULLPATH.'magazineSecret.txt', "w");
  @fwrite($fp, $e, strlen($e) );
  fclose($fp);
  $sql = "UPDATE stella_userbasic SET customerid = '{$e}' where userid = '{$_COOKIE['userid']}'";
  $query = mysql_query($sql,$conn);
  
  //日割の料金売上
  $userid = stella_userbasic_search('userid','customerid',$e);
  $data['amount'] = $_POST['amount'];
  $data['customer'] = $e;
  $data['description'] = '[stella] '.$userid.' : '.date('n').'月分の日割料金として'.$data['amount'].'円を課金しました';
  try{
    WebPayCustomerCharge($data);
    stella_actionreport_insert($_COOKIE['userid'],'make_charge',date('n').'月分の日割料金として'.$data['amount'].'円を課金しました');
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
    $retry = "カード情報の有効性が確認できません (エラーコード：{$err['code']}) {$err['message']}";
  } catch (Stripe_InvalidRequestError $e) {
    // リクエストで指定したパラメータが不正な場合
    $retry = "カード情報の有効性が確認できません (情報を再度入力してください)";
  } catch (Stripe_AuthenticationError $e) {
    // 認証に失敗した場合
    $retry = "認証に失敗しました。この状態が長く続く場合はお問合せください。";
  } catch (Stripe_ApiConnectionError $e) {
    // APIへの接続エラーが起きた場合
    $retry = "接続に失敗しました。この状態が長く続く場合はお問合せください。";
  } catch (Stripe_Error $e) {
    // WebPayのサーバでエラーが起きた場合
    $retry = "サーバーエラーが発生しました。この状態が長く続く場合はお問合せください。";
  } catch (Exception $e) {
    // WebPayとは関係ない例外の場合
    $retry = "予期しないエラーが発生しました。この状態が長く続く場合はお問合せください。";
  }


}

?>