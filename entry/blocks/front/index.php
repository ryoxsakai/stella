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
      <p>この度は、<strong><?= $magazineTitle; ?></strong>へのご登録、まことにありがとうございます。<br />以下に必要事項を記入の上、送信ボタンを押してください。<br />※ すべて必須項目です。</p>
      <form method="post">
        <dl>
          <dt>お名前(ニックネームも可)</dt>
          <dd class="design"><input type="text" name="nickname" required /></dd>
          <dt>生年月日</dt>
          <dd>
            <select name="year"><?=$Year ?></select>年
            <select name="month"><?=$Month ?></select>月
            <select name="day"><?=$Day ?></select>日
          </dd>
          <dt>性別</dt>
          <dd>
            <input type="radio" name="sex" value="male" id="male" /><label for="male">男性</label>
            <input type="radio" name="sex" value="female" id="female" /><label for="female">女性</label>
          </dd>
          <dt>住所</dt>
          <dd><select name="prefecture" required /><?=$address; ?></select></dd>
          <dt>職業</dt>
          <dd class="design"><input type="text" name="job" required /></dd>
          <dt>メールアドレス</dt>
          <dd class="design"><input type="text" name="address" required /></dd>
        </dl>
        <div class="alignRight"><input type="submit" value="送信" /></div>
        <input type="hidden" name="flag" value="on" />
      </form>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>