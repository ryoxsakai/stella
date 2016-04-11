#!/usr/local/bin/php5
<?php

/*-----------------------------------------------

  日時指定配信機能 1.0

-----------------------------------------------*/

require_once 'connection.php';
require_once 'usermailer.php';

echo '<meta charset="UTF-8">';

//1. ユーザーを検索

$sql = "SELECT * from stella_userbasic ORDER BY setuptime desc";
$query = mysql_query($sql,$conn);

while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
  if(isset($_GET['uid'])){
    $userid = $_GET['uid'];
  }else{
    $userid = $row['userid'];
  }

  //2. 予約送信された記事を検索
  $now = time();
  $sql_2 = "SELECT * from userdata_{$userid}_holder where status = 'reserved' AND sendtime <= {$now}";
  echo $sql_2 . '<br />';
  $query_2 = mysql_query($sql_2,$conn);
  
  $count = 0;
  
  while ($row = mysql_fetch_array($query_2, MYSQL_BOTH)){
    //3. コードを判定してメールを送信
    $code = $row['code'];
    MAG_ENHANCER($code,$userid);
    $count ++;
  }
  
  echo "メール送信成功：{$userid} ({$count}件)<br />";
  
  if(isset($_GET['uid'])){
    die();
  }

}

?>