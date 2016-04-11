<?php

require_once 'lib/connection.php';
require_once 'lib/mailer.php';

//flag = change:処理
if($_POST['flag']=='change'){
  $verifier = md5($_POST['address']);
  $sql   = "UPDATE userdata_{$_GET['host']}_list SET nickname = '{$_POST['nickname']}', address = '{$_POST['address']}', verifier = '{$verifier}' where code = '{$_POST['code']}'";
  $query = mysql_query($sql,$conn);
  exit('<head><meta http-equiv="Content-Type" content="text/html;charset=utf-8" /></head><body><script type="text/javascript">alert("ニックネーム・アドレスを変更しました。");window.location="'.$service['serverRegURL'].'client/?verifier='.$verifier.'";</script></body>');
}elseif($_POST['flag']=='delete'){
  $sql   = "DELETE from userdata_{$_GET['host']}_list where code = '{$_POST['code']}'";
  $query = mysql_query($sql,$conn);
  exit('<head><meta http-equiv="Content-Type" content="text/html;charset=utf-8" /></head><body><script type="text/javascript">alert("メルマガ登録を解除しました。");window.location="http://stella-mail.com/";</script></body>');
}

//verifierの値から個人情報を取得
if(isset($_GET['verifier'])&&isset($_GET['host'])){
  $sql="SELECT * from userdata_{$_GET['host']}_list where verifier = '{$_GET['verifier']}' limit 1";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    $key = $row;
  }
}else{
  exit('<h1>NO AUTHENTIFICATION</h1>YOU ARE NOT ARROWED TO ACCESS, FOR YOU HAVE NO VERIFICATED CODE');
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