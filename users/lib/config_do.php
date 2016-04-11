<?php

require_once 'function.php';

$info = "メルマガやテンプレートを設定します。";

define("FULLPATH", 'server/u/'.$_COOKIE['userid'].'/');

//ファイルの書き込み//
if($_POST['flag']=="configAction"){
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
  
  stella_actionreport_insert("{$_COOKIE['userid']}","modify_config","メルマガの設定を変更しました。");
  $info = "メルマガの設定を書き込みました。";
}

//ファイルの書き込み//
if($_POST['flag']=="systemAction"){
  //systemAutoLogin
  $fp = fopen(FULLPATH.'systemAutoLogin.txt', "w");
  @fwrite($fp, $_POST['systemAutoLogin'], strlen($_POST['systemAutoLogin']) );
  fclose($fp);

  //systemAfterEdit
  $fp = fopen(FULLPATH.'systemAfterEdit.txt', "w");
  @fwrite($fp, $_POST['systemAfterEdit'], strlen($_POST['systemAfterEdit']) );
  fclose($fp);
  
  stella_actionreport_insert("{$_COOKIE['userid']}","modify_config","システムの設定を変更しました。");
  $info = "システムの設定を書き込みました。";
}

//ファイルの読み込み//
$magazineFrom   = @file_get_contents(FULLPATH.'magazineFrom.txt');
$magazineTitle  = @file_get_contents(FULLPATH.'magazineTitle.txt');
$magazineHeader = @file_get_contents(FULLPATH.'magazineHeader.txt');
$magazineFooter = @file_get_contents(FULLPATH.'magazineFooter.txt');
$magazineTestAddress = @file_get_contents(FULLPATH.'magazineTestAddress.txt');
$magazineWelcomeMail = @file_get_contents(FULLPATH.'magazineWelcomeMail.txt');

//チェックボックス//
$systemAutoLogin['true'] = (@file_get_contents(FULLPATH.'systemAutoLogin.txt') == 'true') ? ' checked' : '';
$systemAutoLogin['false'] = (@file_get_contents(FULLPATH.'systemAutoLogin.txt') == 'false' || @file_get_contents(FULLPATH.'systemAutoLogin.txt') == '') ? ' checked' : '';
$systemAfterEdit['true'] = (@file_get_contents(FULLPATH.'systemAfterEdit.txt') == 'true' || @file_get_contents(FULLPATH.'systemAfterEdit.txt') == '') ? ' checked' : '';
$systemAfterEdit['false'] = (@file_get_contents(FULLPATH.'systemAfterEdit.txt') == 'false') ? ' checked' : '';

?>