<?
$info = (isset($_GET['failed'])) ? 'ログインに失敗しました。' : 'ログインはこちらから。';
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once 'blocks/head.php'; ?>
<title>メルマガスタンド stella -ステラ-｜配信無制限！業界新登場の高機能メルマガスタンド ステップメールもできて月額980円〜</title>
</head>
<body>
  <?php require_once 'blocks/top.php'; ?>
  <div class="parts" id="parts_SIGNUP">
    <div class="section container align-center">
      <p>ログインはこちらから。</p><br />
      <div class='pure-g-r'>
        <div class="col three tablet-two no-mobile">&nbsp;</div>
        <div class="col six tablet-eight mobile-full">
          <form method="post" action="<?=$urlpostfix; ?>">
            <label for="userid"><i class="icon-male"></i>ユーザーID</label>
            <input type="text" name="userid" id="userid" value="<?= $_COOKIE['userid'] ?>" class="validate useridLength required" autocapitalize="off" autocorrect="off" />
            <label for="password"><i class="icon-key"></i>パスワード</label>
            <input type="password" name="password" id="password" class="validate passwordLength required" autocorrect="off" />
            <input type="submit" id="submit" class="button button-block" value="ログイン" />
            <input type="hidden" name="flag" value="loginChecker" />
          </form>
          <div class="clearfix"></div>
        </div>
        <div class="col three tablet-two no-mobile">&nbsp;</div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>