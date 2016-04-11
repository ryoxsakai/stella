<?php

require_once 'lib/connection.php';
require_once 'lib/function.php';

//FULLPASSの定義
define("FULLPATH", 'server/u/'.$_COOKIE['userid'].'/');

//ログインチェック
if($_POST['flag']=="loginChecker"){
  $sql="SELECT * from stella_transferbasic where userid = '{$_POST['userid']}' limit 1";
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
    setcookie("loginkey", md5($_POST['password']), time()+3600, '/');
    setcookie("userid", $userbasic['userid'], time()+3600, '/');
    setcookie("mail", $userbasic['mail'], time()+3600, '/');
    stella_actionreport_insert($_POST['userid'],'user_login',"{$_POST['id']}さんがログインしました。");
    header('Location: .');
  }
}

if(isset($_GET['logout'])){
  setcookie("loginkey", "", time() - 3600, '/');
  setcookie("userid", "", time() - 3600, '/');
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

  if(!file_exists(FULLPATH.'magazineTransferCheck.txt')){
    //初期設定ファイルがない場合はファーストアシスタンスへ
      require_once "pages/firstassistance/index.php";
  }elseif(!isset($_GET['mode'])){
    //モードがない場合はフロントページへ
      require_once 'pages/front/index.php';
  }else{
    //モードに飛ばします
      require_once "pages/{$_GET['mode']}/index.php";
  }
}

?>