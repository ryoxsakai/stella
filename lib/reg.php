<?php

require_once 'mailer.php';

require_once 'connection.php';

//flagを調べる
if(isset($_POST['flag'])){
  if($_GET['specialmode']=='free'){
    stella_free_reg();
  }elseif($_GET['specialmode']=='transfer'){
    stella_transfer_reg();
  }else{
    stella_reg();
  }
}

//stella_reg関数
function stella_reg(){
  global $conn;
  $sql   = "INSERT INTO stella_userbasic (mail,userid,password) VALUES ('{$_POST['mail']}','{$_POST['userid']}','{$_POST['password']}')";
  $query = mysql_query($sql,$conn);
  echo $query;

  INQUIRY_MAILER($_POST);
  RECHECK_MAILER($_POST);
}

//stella_free_reg関数
function stella_free_reg(){
  global $conn;
  $sql   = "INSERT INTO stella_freebasic (mail,userid,password) VALUES ('{$_POST['mail']}','{$_POST['userid']}','{$_POST['password']}')";
  $query = mysql_query($sql,$conn);
  echo $query;

  INQUIRY_MAILER($_POST,'free');
  RECHECK_MAILER($_POST,'free');
}

//stella_transfer_reg関数
function stella_transfer_reg(){
  global $conn;
  $sql   = "INSERT INTO stella_transferbasic (mail,userid,password) VALUES ('{$_POST['mail']}','{$_POST['userid']}','{$_POST['password']}')";
  $query = mysql_query($sql,$conn);
  echo $query;

  INQUIRY_MAILER($_POST,'transfer');
  RECHECK_MAILER($_POST,'transfer');
}

?>