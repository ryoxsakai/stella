<?php
  require_once 'lib/config_do.php';
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
        <h3><i class="icon-user"></i> ユーザーアカウントの設定</h3>
      </div>
      <p class="info"><?=$info; ?></p>
      <form method="post">
        <dl class="design">
          <dt>メールアドレス</dt>
          <dd>
            <input type="text" name="mail" placeholder="hello@stella-mail.com" value="" />
            <p><i class="icon-chevron-sign-right"></i> テスト送信にも利用します</p>
          </dd>
          <dt>パスワード</dt>
          <dd>
            <input type="password" name="password" placeholder="" value="" />
            <p><i class="icon-chevron-sign-right"></i> 安全のため、空欄で表示されています</p>
          </dd>
          <dt>ソーシャルメディアID</dt>
          <dd>
            <input type="text" name="TWITTER_ID" placeholder="twitter" value="" />
            <input type="text" name="FACEBOOK_ID" placeholder="facebook" value="" />
            <input type="text" name="GPLUS_ID" placeholder="google+" value="" />
            <p><i class="icon-chevron-sign-right"></i> 設定すると[TWITTER_ID][FACEBOOK_ID][GPLUS_ID]が本文で利用できます。詳しくはタグ一覧をご覧ください。</p>
          </dd>
          <dt>ライターのプロフィール</dt>
          <dd>
            <textarea name="profile"></textarea>
            <p><i class="icon-chevron-sign-right"></i> 書き手のプロフィールを入力すると、読者登録ページにプロフィールが表示されます。</p>
          </dd>
        </dl>
        <div class="alignRight design"><input type="submit" value="保存" /></div>
        <input type="hidden" name="flag" value="configAction" />
      </form>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>