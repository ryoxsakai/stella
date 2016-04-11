<?php

  require_once 'lib/function.php';

?>
<!DOCTYPE html>
<html>
<head>
<?php require_once 'blocks/head.php'; ?>
<title>メルマガスタンド stella -ステラ-｜配信無制限！業界新登場の高機能メルマガスタンド ステップメールもできて月額980円〜</title>
</head>
<body>
  <?php require_once 'blocks/top.php'; ?>
  <div class="content">
    <div class="section container">
      <div class="headtypo">
        <h3><i class="icon-user"></i> ユーザー一覧</h3>
      </div>
      <p class="info">ご利用頂いているユーザーを全表示します。</p>
      <table class="multitable"><?=stella_userbasic_list(); ?></table>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>