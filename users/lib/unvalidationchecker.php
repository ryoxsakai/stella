<?php

require_once 'connection.php';

//--------userid,mailが重なっているか調べる--------

//スイッチャー
$flag['userid'] = true;
$flag['mail'] = true;

//データベース検索
$sql="SELECT * from stella_userbasic ORDER BY code desc";
$query = mysql_query($sql,$conn);
while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
  if($row['userid'] == $_POST['userid']){
    $flag['userid'] = false; //偽ならスイッチオフ
  }
  if($row['mail'] == $_POST['mail']){
    $flag['mail'] = false;   //偽ならスイッチオフ
  }
}

if($flag['userid']==false){
  echo '<p class="error"><i class="icon-check"></i> このユーザーIDは登録済みです</p>';
}else{
}

if($flag['mail']==false){
  echo '<p class="error"><i class="icon-check"></i> このメールアドレスは登録済みです</p>';
}else{
}

?>