<?php

require_once 'mailer.php';

require_once 'connection.php';

//flagを調べる
if(isset($_POST['flag'])){
  stella_reg();
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

?>