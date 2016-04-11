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
        <h3><i class="icon-cog"></i> メルマガの設定</h3>
      </div>
      <p class="info"><?=$info; ?></p>
      <form method="post">
        <dl class="design">
          <dt>メールの差出人</dt>
          <dd>
            <input type="text" name="magazineFrom" placeholder="星野 文子" value="<?= $magazineFrom; ?>" />
            <p><i class="icon-chevron-sign-right"></i> メールの「差出人」欄に表示されます。</p>
          </dd>
          <dt>メルマガタイトル</dt>
          <dd>
            <input type="text" name="magazineTitle" placeholder="ステラメルマガ" value="<?= $magazineTitle; ?>" />
            <p><i class="icon-chevron-sign-right"></i> 登録フォームなどに「タイトル」として表示されます。</p>
          </dd>
          <dt>メルマガのヘッダーテンプレート</dt>
          <dd>
            <textarea name="magazineHeader" placeholder="メルマガの上部に表示する文章を入力"><?= $magazineHeader; ?></textarea>
            <p><i class="icon-chevron-sign-right"></i> メルマガのヘッダーを設定できます。</p>
          </dd>
          <dt>メルマガのフッターテンプレート</dt>
          <dd>
            <textarea name="magazineFooter" placeholder="メルマガの下部に表示する文章を入力"><?= $magazineFooter; ?></textarea>
            <p><i class="icon-chevron-sign-right"></i> メルマガのフッターを設定できます。テンプレートを改良してご利用ください。
            <a href="tag.php" onclick="window.open('tag.php', '', 'width=500,height=400'); return false;">タグ</a>がご利用いただけます。</p>
          </dd>
          <dt>ウェルカムメールの設定</dt>
          <dd>
            <textarea name="magazineWelcomeMail" placeholder="ウェルカムメールを入力"><?= $magazineWelcomeMail; ?></textarea>
            <p><i class="icon-chevron-sign-right"></i> メルマガを登録後、最初に送られる挨拶メールを設定できます。
            <a href="tag.php" onclick="window.open('tag.php', '', 'width=500,height=400'); return false;">タグ</a>がご利用いただけます。</p>
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