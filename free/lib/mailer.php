<?php

define("FULLPATH", 'server/u/'.$_COOKIE['userid'].'/');

$magazineTitle  = @file_get_contents(FULLPATH.'magazineTitle.txt');
$magazineFrom   = @file_get_contents(FULLPATH.'magazineFrom.txt');
$magazineTwitterID  = @file_get_contents(FULLPATH.'magazineTwitterID.txt');
$magazineFacebookID = @file_get_contents(FULLPATH.'magazineFacebookID.txt');
$magazineGPlusID    = @file_get_contents(FULLPATH.'magazineGPlusID.txt');

//★基本設定/////////////////////////////////////////////////////////

$conn = mysql_connect('mysql116.heteml.jp','_stella','sugarless');
mysql_select_db('_stella',$conn);
mysql_set_charset('utf8',$conn);

//☆////////////////////////////////////////////////////////////////

//★MAG_ENHANCER()//////////////////////////////////////////////////

if(!function_exists('MAG_ENHANCER')){
function MAG_ENHANCER($code){
  global $conn, $magazineFrom, $service;
  $sql="SELECT * from userdata_{$_COOKIE['userid']}_list where state = 'valid'";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    MAG_MAILER($code,$row['address'],$row['nickname'],$row['verifier']);
  }
}
}

//☆////////////////////////////////////////////////////////////////

//★MAG_MAILER()////////////////////////////////////////////////////

if(!function_exists('MAG_MAILER')){
function MAG_MAILER($code,$address,$name = "NO NAME",$verifier = "NO VERIFIED CODE"){
  global $conn, $magazineTitle, $magazineFrom, $magazineTwitterID, $magazineFacebookID, $magazineGPlusID;
  //言語設定、内部エンコーディングを指定する
  mb_language("japanese");
  mb_internal_encoding("UTF-8");
  
  //codeから読み込み
  $sql="SELECT * from userdata_{$_COOKIE['userid']}_holder where code = {$code}";
  $query = mysql_query($sql,$conn);
    while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
      $key  = $row;
    }

  //メール部分
  $to = $address;
  $subject = $key['title'];
  
  //置換
  $body = $key['content'];
  $body = str_replace("[NAME]", $name, $body);
  $body = str_replace("[VERIFIER]", $verifier, $body);
  $body = str_replace("[TITLE]", $magazineTitle, $body);
  $body = str_replace("[USERID]", $_COOKIE['userid'], $body);
  $body = str_replace("[TWITTER_ID]", $magazineTwitterID, $body);
  $body = str_replace("[FACEBOOK_ID]", $magazineFacebookID, $body);
  $body = str_replace("[GPLUS_ID]", $magazineGPlusID, $body);

  $from = mb_encode_mimeheader(mb_convert_encoding("{$magazineFrom}","UTF8"))."<{$_COOKIE['userid']}@u.stella-mail.com>";

  mb_send_mail($to,$subject,$body,"From:".$from);
}
}

//☆////////////////////////////////////////////////////////////////

//★MAG_RESERVED()////////////////////////////////////////////////////

if(!function_exists('MAG_RESERVED')){
function MAG_RESERVED($code){
  global $conn, $magazineFrom, $service;
  //言語設定、内部エンコーディングを指定する
  mb_language("japanese");
  mb_internal_encoding("UTF-8");
  
  //codeから読み込み
  $sql="SELECT * from userdata_{$_COOKIE['userid']}_holder where code = {$code}";
  $query = mysql_query($sql,$conn);
    while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
      $key  = $row;
    }

  //メール部分
  $to = $address;
  $subject = $key['title'];
  $body = <<<END
■ メール予約送信完了

「{$key['title']}」の送信を完了しました。

END;

  $from = mb_encode_mimeheader(mb_convert_encoding("{$magazineFrom}","UTF8"))."<{$_COOKIE['userid']}@u.stella-mail.com>";

  mb_send_mail($to,$subject,$body,"From:".$from);
}
}

//☆////////////////////////////////////////////////////////////////

?>