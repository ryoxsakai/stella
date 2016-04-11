<?php

require_once 'lib/connection.php';
require_once 'lib/function.php';

//FULLPASSの定義
define("FULLPATH", 'server/u/'.$_COOKIE['userid'].'/');

//ログインチェック
if($_POST['flag']=="loginChecker"){
  $sql="SELECT * from stella_userbasic where userid = '{$_POST['userid']}' limit 1";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    if($row['password']==$_POST['password']){
      $successkey = true;
      $userbasic = $row;
    }else{
      $successkey = false;
    }
  }
  if(!$successkey){
    header("Location: ./?failed");
  }else{
    $timeout = (@file_get_contents(FULLPATH.'systemAutoLogin.txt')) ? time()+(7 * 24 * 60 * 60) : time()+3600;
    setcookie("loginkey", md5($_POST['password']), $timeout, '/');
    setcookie("userid", $userbasic['userid'], $timeout, '/');
    setcookie("mail", $userbasic['mail'], $timeout, '/');
    stella_actionreport_insert($_POST['userid'],'user_login',"{$_POST['id']}さんがログインしました。");
    header('Location: .');
  }
}

if(isset($_GET['logout'])){
  setcookie("loginkey", "", time() - 3600, '/');
  //setcookie("userid", "", time() - 3600, '/');
  setcookie("mail", "", time() - 3600, '/');
  stella_actionreport_insert($_COOKIE['userid'],'user_logout',"{$_COOKIE['id']}さんがログアウトしました。");
  header('Location: .');
}

if(!isset($_COOKIE['loginkey'])){
  //ログインしていない場合
  require_once 'pages/login/index.php';
}else{
  //ログイン後の処理

  if($_POST['flag']=='firstAssistance'){
    //ファーストアシスタンスを実行
    require_once "lib/firstassistance_do.php";
  }
  
  //カードが期限切れの場合
  if($_POST['flag']=='exitexpiration'){
    //カード期限切れ解除を実行
    require_once "lib/expire.php";
  }
  $v = stella_userbasic_search('card_validation','userid',$_COOKIE['userid']);

  if(!file_exists(FULLPATH.'magazineSecret.txt')){
    //初期設定ファイルがない場合はファーストアシスタンスへ
    require_once "pages/firstassistance/index.php";
  }elseif($v==0){
    //カードが期限切れの場合
    require_once "pages/expire/index.php";
  }elseif(!isset($_GET['mode'])){
    //モードがない場合はフロントページへ
    require_once 'pages/front/index.php';
  }else{
    //モードに飛ばします
    require_once "pages/{$_GET['mode']}/index.php";
  }
}

?>