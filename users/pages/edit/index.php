<?php
  require_once 'lib/edit_engine.php';
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
        <h3><i class="icon-edit"></i> <?=$key['header']; ?></h3>
        <p class="info"><?=$key['desc']; ?></p>
      </div>
      <form method="post">
        <dl>
          <dt>メールの件名</dt>
          <dd class="design"><input type="text" name="title" placeholder="件名を入力" value="<?= $key['title']; ?>" /></dd>
          <dt>状態</dt>
          <dd>
            <input type="radio" name="status" value="draft" id="draft"<?= $selected['draft']; ?> /><label for="draft">下書き</label>
            <input type="radio" name="status" value="reserved" id="reserved"<?= $selected['reserved']; ?> /><label for="reserved">日時指定配信</label>
            <input type="radio" name="status" value="immediate" id="immediate"<?= $selected['immediate']; ?> /><label for="immediate">すぐに送信</label>
            <input type="radio" name="status" value="sent" id="sent"<?= $selected['sent']; ?> /><label for="sent">送信済み</label>
            <p><i class="icon-chevron-sign-right"></i> 「送信済み」にするとバックナンバーページに掲載されます。</p>
          </dd>
          <dt>送信日時指定</dt>
          <dd>
            <select name="y"><?php echo optionLoop(date('Y'), date('Y')+2, $key['y']);?></select>年
            <select name="m"><?php echo optionLoop('1', '12', $key['m']);?></select>月
            <select name="d"><?php echo optionLoop('1', '31', $key['d']);?></select>日
            <select name="h"><?php echo optionLoop('0', '23', $key['h']);?></select>時
            <p><i class="icon-chevron-sign-right"></i> 「日時指定配信」を設定したときにのみ有効です。</p> 
          </dd>
          <dt>本文</dt>
          <dd class="design">
<textarea name="content" id="content" placeholder="本文を入力">
<?= $key['content']; ?>
</textarea><p><i class="icon-chevron-sign-right"></i> タグが利用可能です。</p>
          </dd>
        </dl>
        <div class="alignRight design"><input type="submit" value="<?= $label ?>" /></div>
        <input type="hidden" name="flag" value="<?= $flag; ?>" />
      </form>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>