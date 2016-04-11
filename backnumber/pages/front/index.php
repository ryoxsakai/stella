<?php

require_once 'lib/connection.php';

$magazineTitle  = @file_get_contents("http://users.stella-mail.com/server/u/{$_GET['userid']}/magazineTitle.txt");
if($magazineTitle==""){
  $magazineTitle  = @file_get_contents("http://free.stella-mail.com/server/u/{$_GET['userid']}/magazineTitle.txt");
}

$sql="SELECT * from userdata_{$_GET['userid']}_holder where status = 'sent' order by sendtime desc";
$query = mysql_query($sql,$conn);
while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
$sendtime = date("Y-m-d" ,$row['sendtime']);
$holder .= <<< EOF
  <dt>{$sendtime}</dt>
  <dd><a href="http://backnumber.stella-mail.com/{$_GET['userid']}/{$row['code']}/">{$row['title']}</a></dd>
EOF;
$num++;
}

?>
<!DOCTYPE html>
<html>
<head>
<?php require_once 'blocks/head.php'; ?>
<title>「<?=$magazineTitle; ?>」のバックナンバー｜メルマガスタンド stella -ステラ-｜配信無制限！業界新登場の高機能メルマガスタンド ステップメールもできて月額980円〜</title>
</head>
<body>
  <?php require_once 'blocks/top.php'; ?>
  <div class="content">
    <div class="section container">
      <div class="headtypo"><h3>「<?=$magazineTitle; ?>」のバックナンバー</h3></div>
      <p class="info"><?=$num; ?>件のバックナンバーがあります</p>
      <dl><?=$holder; ?></dl>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>