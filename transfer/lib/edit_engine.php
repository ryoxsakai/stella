<?php

require_once 'mailer.php';
require_once 'function.php';

//登録
if($_POST['flag']=='reg'){
  $sendtime  = mktime($_POST['h'], 0, 0, $_POST['m'], $_POST['d'], $_POST['y']);
  $regtime = time();
  $sql      = "INSERT INTO userdata_{$_COOKIE['userid']}_holder (code,regtime,sendtime,title,content,status) VALUES ('{$_POST['code']}','{$regtime}','{$sendtime}','{$_POST['title']}','{$_POST['content']}','{$_POST['status']}')";
  $query    = mysql_query($sql,$conn);
  stella_actionreport_insert("{$_COOKIE['userid']}","make_article","メルマガ記事『{$_POST['title']}』を作成しました。");
  $info  = "登録しました。";
}

//上書き
if($_POST['flag']=='rewrite'){
  $sendtime  = mktime($_POST['h'], 0, 0, $_POST['m'], $_POST['d'], $_POST['y']);
  $regtime = time();
  $sql      = "UPDATE userdata_{$_COOKIE['userid']}_holder SET regtime = '{$regtime}', sendtime = '{$sendtime}', title = '{$_POST['title']}', content = '{$_POST['content']}', status = '{$_POST['status']}' where code = '{$_GET['code']}'";
  $query    = mysql_query($sql,$conn);
  stella_actionreport_insert("{$_COOKIE['userid']}","modify_article","メルマガ記事『{$_POST['title']}』を上書きしました。");
  $info     = "上書きしました。";
}

//すぐに送信
if($_POST['status']=="immediate"){
  $sql="SELECT * from userdata_{$_COOKIE['userid']}_holder where status = 'immediate' limit 1";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    $code = $row['code'];
    MAG_ENHANCER($code);
  }
  $regtime  = time();
  $sql      = "UPDATE userdata_{$_COOKIE['userid']}_holder SET regtime = {$regtime}, status = 'sent' where code = '{$code}'";
  $query    = mysql_query($sql,$conn);
  stella_actionreport_insert("{$_COOKIE['userid']}","send_article","メルマガ記事『{$_POST['title']}』を送信しました。");
  $info     = "送信しました。";
}

//ファイルの読み込み
$key['title']   = @file_get_contents(FULLPATH.'magazineTitle.txt');
$magazineHeader = @file_get_contents(FULLPATH.'magazineHeader.txt');
$magazineFooter = @file_get_contents(FULLPATH.'magazineFooter.txt');
$key['content'] = $magazineHeader . '
' .$magazineFooter;

//codeから読み込み
if(isset($_GET['code'])){
  $sql="SELECT * from userdata_{$_COOKIE['userid']}_holder where code = {$_GET['code']}";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    $key  = $row;
    $flag = 'rewrite';
  }
  $key['y'] = date("Y",$key['sendtime']);
  $key['m'] = date("n",$key['sendtime']);
  $key['d'] = date("j",$key['sendtime']);
  $key['h'] = date("H",$key['sendtime']);
  $key['header'] = "記事の編集";
  $key['desc'] = "メルマガ記事『{$key['title']}』を編集します。";
}else{
  $flag = "reg";
  $key['header'] = "記事を作成";
  $key['desc'] = "新しくメルマガ記事を作成します。";
}

if($key['status']=="draft"||!isset($key['status'])){
  $selected['draft'] = " checked";
}elseif($key['status']=="reserved"){
  $selected['reserved'] = " checked";
}elseif($key['status']=="sent"){
  $selected['sent'] = " checked";
}

if(!isset($key['y'])){
  $key['y'] = date("Y");
}
if(!isset($key['m'])){
  $key['m'] = date("n");
}
if(!isset($key['d'])){
  $key['d'] = date("j");
}
if(!isset($key['h'])){
  $key['h'] = date("H");
}

if($_POST['flag']=="reg"||$_POST['flag']=="rewrite"){
  $key['desc'] = $info;
}

function optionLoop($start, $end, $value = null){
  for($i = $start; $i <= $end; $i++){
    if(isset($value) &&  $value == $i){
	  $loop .= "<option value=\"{$i}\" selected=\"selected\">{$i}</option>";
	}else{
	  $loop .= "<option value=\"{$i}\">{$i}</option>";
	}
  }
  return $loop;
}

?>