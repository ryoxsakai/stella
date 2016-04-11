<?php

require_once 'lib/connection.php';
require_once 'lib/mailer.php';

//モードがない場合はフロントページへ
if(!isset($_GET['mode'])){
  require_once 'pages/front/index.php';
}else{
  require_once "pages/{$_GET['mode']}/index.php";
}

?>