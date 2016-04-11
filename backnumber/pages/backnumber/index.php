<?php

require_once 'lib/connection.php';

if(isset($_GET['code'])){
$sql="SELECT * from userdata_{$_GET['userid']}_holder where code = {$_GET['code']}";
$query = mysql_query($sql,$conn);
while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
$sendtime = date("Y-m-d-H" ,$row['sendtime']);
$title = $row['title'];
$bn = nl2br($row['content']);
$holder .= <<< EOF
<div class="headtypo"><h3>{$row['title']}</h3></div>
<p>{$bn}</p>
<a href="http://backnumber.stella-mail.com/{$_GET['userid']}/">戻る</a>
EOF;
}
}

?>
<!DOCTYPE html>
<html>
<head>
<?php require_once 'blocks/head.php'; ?>
<title>「<?= $title; ?>」の登録｜メルマガスタンド stella -ステラ-｜配信無制限！業界新登場の高機能メルマガスタンド ステップメールもできて月額980円〜</title>
</head>
<body>
  <?php require_once 'blocks/top.php'; ?>
  <div class="content">
    <div class="section container">
      <?=$holder; ?>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>