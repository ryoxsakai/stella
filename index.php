<?php
  if(!isset($_POST['flag'])){
    require_once 'pages/index.php';
  }else{
    require_once 'lib/reg.php';
    require_once 'pages/welcome/index.php';
  }
?>