<!DOCTYPE html>
<html>
<head>
<?php require_once 'blocks/head.php'; ?>
<title>「<?= $magazineTitle; ?>」の登録｜メルマガスタンド stella -ステラ-｜配信無制限！業界新登場の高機能メルマガスタンド ステップメールもできて月額980円〜</title>
</head>
<body>
  <?php require_once 'blocks/top.php'; ?>
  <div class="content">
    <div class="section container">
      <div class="headtypo">
        <h3><i class="icon-envelope-alt"></i> 登録完了</h3>
      </div>
      <p class="info">登録ありがとうございました。「<?= $_POST['mail'] ?>」に確認メールを送信しましたので、ご確認ください。</p>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>