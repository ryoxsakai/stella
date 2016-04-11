<?php

$home_url = "http://stella-mail.com/";

require_once 'connection.php';
require_once 'mailer.php';

function stella_userbasic_list(){
  global $conn;
/*--ここから-----------------*/
  $sql="SELECT * from stella_userbasic ORDER BY setuptime desc";
  $query = mysql_query($sql,$conn);
  $holder = <<< EOF
<tr>
  <th><i class="icon-user"></i> ユーザーID</th>
  <th width="20%"><i class="icon-envelope-alt"></i> メールアドレス</th>
  <th width="20%"><i class="icon-yen"></i> カスタマーID</th>
  <th width="20%"><i class="icon-time"></i> 登録日時</th>
</tr>
EOF;
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
  $holder .= <<< EOF
<tr>
  <td><a href="/edit/{$row['code']}/">{$row['userid']}</a></td>
  <td>{$row['mail']}</td>
  <td>{$row['moneykey']}</td>
  <td>{$row['setuptime']}</td>
</tr>
EOF;
  }
  return $holder;
/*--ここまで-----------------*/
}

?>