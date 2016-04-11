<?php

define("FULLPATH", 'http://users.stella-mail.com/server/u/'.$_GET['host'].'/');

//ファイルの読み込み
$magazineTitle = @file_get_contents(FULLPATH."magazineTitle.txt");
$magazineFrom = @file_get_contents(FULLPATH."magazineFrom.txt");

//★基本設定/////////////////////////////////////////////////////////

$conn = mysql_connect('mysql116.heteml.jp','_stella','sugarless');
mysql_select_db('_stella',$conn);
mysql_set_charset('utf8',$conn);

//☆////////////////////////////////////////////////////////////////

//★MAG_ENHANCER()//////////////////////////////////////////////////

function MAG_ENHANCER($code){
  global $conn, $service, $magazineFrom;
  $sql="SELECT * from userdata_{$_GET['host']}_list where state = 'valid'";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    MAG_MAILER($code,$row['address']);
  }
}

//☆////////////////////////////////////////////////////////////////

//★MAG_MAILER()////////////////////////////////////////////////////

function MAG_MAILER($code,$address){
  global $conn, $service, $magazineFrom;
  //言語設定、内部エンコーディングを指定する
  mb_language("japanese");
  mb_internal_encoding("UTF-8");
  
  //codeから読み込み
  $sql="SELECT * from userdata_{$_GET['host']}_holder where code = {$code}";
  $query = mysql_query($sql,$conn);
    while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
      $key  = $row;
    }

  //メール部分
  $to = $address;
  $subject = $key['title'];
  $body = $key['content'];

  $from = mb_encode_mimeheader(mb_convert_encoding("{$magazineFrom}","UTF8"))."<{$_GET['host']}@u.stella-mail.com>";

  mb_send_mail($to,$subject,$body,"From:".$from);
}

//☆////////////////////////////////////////////////////////////////

//★MAG_WELCOMEMAILER()/////////////////////////////////////////////

function MAG_WELCOMEMAILER($name,$address,$host){
  global $conn, $service, $magazineFrom;
  //言語設定、内部エンコーディングを指定する
  mb_language("japanese");
  mb_internal_encoding("UTF-8");
  
  $magazineTitle  = @file_get_contents(FULLPATH."magazineTitle.txt");
  $magazineWelcomeMail = @file_get_contents(FULLPATH."magazineWelcomeMail.txt");
  
  //verifierの取得
  $sql="SELECT * from userdata_{$_GET['host']}_list where address = '{$address}'";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    $verifier = $row['verifier'];
  }

  //メール部分
  $to = $address;
  $subject = "【登録完了】メールマガジンへの登録を受け付けました！";
  $body = $magazineWelcomeMail;
  $body = str_replace("[NAME]", $name, $body);
  $body = str_replace("[VERIFIER]", $verifier, $body);
  $body = str_replace("[TITLE]", $magazineTitle, $body);
  $body = str_replace("[USERID]", $host, $body);

  $from = mb_encode_mimeheader(mb_convert_encoding("{$magazineFrom}","UTF8"))."<{$_GET['host']}@u.stella-mail.com>";

  mb_send_mail($to,$subject,$body,"From:".$from);
}

//☆////////////////////////////////////////////////////////////////

?>