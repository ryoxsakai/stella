<?php

require_once 'lib/connection.php';
require_once 'lib/mailer.php';

//コードがない場合は一覧へ
if(!isset($_GET['code'])){
  require_once 'pages/front/index.php';
}else{
  require_once "pages/backnumber/index.php";
}

?>