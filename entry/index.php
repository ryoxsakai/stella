<?php

require_once 'lib/connection.php';
require_once 'lib/function.php';
require_once 'lib/mailer.php';

//ファイルの読み込み
$magazineTitle = @file_get_contents("http://users.stella-mail.com/server/u/{$_GET['host']}/magazineTitle.txt");
if($magazineTitle==""){
  $magazineTitle = @file_get_contents("http://free.stella-mail.com/server/u/{$_GET['host']}/magazineTitle.txt");
}

if($_POST['flag']=='on'){
  $switch = true;
  $sql="SELECT * from userdata_{$_GET['host']}_list where address = '{$_POST['address']}' limit 1";
  $query = mysql_query($sql,$conn);
  while ($row = @mysql_fetch_array($query, MYSQL_BOTH)){
    $switch = false;
  }
  if($switch){
    $step      = "0";
    $state     = "valid";
    $age       = strtotime("{$_POST['year']}/{$_POST['month']}/{$_POST['day']}");
    $verifier  = md5($_POST['address']);
    $sql       = "INSERT INTO userdata_{$_GET['host']}_list (code,nickname,age,sex,address,prefecture,job,state,verifier) VALUES ('{$_POST['code']}','{$_POST['nickname']}','{$age}','{$_POST['sex']}','{$_POST['address']}','{$_POST['prefecture']}','{$_POST['job']}','{$state}','{$verifier}')";
    $query     = mysql_query($sql,$conn);
    $warning   = "登録しました。";
    MAG_WELCOMEMAILER($_POST['nickname'],$_POST['address'],$_GET['host']);
  }else{
    $warning = "入力されたアドレスではすでに登録されています。";
  }
}

//FULLPASSの定義
define("FULLPATH", 'server/u/'.$_COOKIE['userid'].'/');

//モードがない場合はフロントページへ
if(!isset($_GET['mode'])){
  require_once 'pages/front/index.php';
}else{
  require_once "pages/{$_GET['mode']}/index.php";
}

?>