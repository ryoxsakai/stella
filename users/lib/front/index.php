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
        <h3><i class="icon-dashboard"></i> ダッシュボード</h3>
        <p class="info"><?=$_COOKIE['userid']; ?>さん、こんにちは！早速記事を書いてみませんか？</p>
        <p><a href="?mode=edit"><i class="icon-edit"></i> メルマガ記事を作成</a></p>
      </div>
      <div class="multicolumn">
        <h3><i class="icon-smile"></i> 読者数と記事数</h3>
        <p>現在の読者数：<?php echo stella_countlist($_COOKIE['userid']); ?>件 <span class="typebutton <?php $n = stella_holdertype($_COOKIE['userid']); echo $n['name']; ?>"><?php echo $n['desc']; ?>プラン</span></p>
        <p>現在の記事数：<?php echo stella_countholder($_COOKIE['userid']); ?>件</p>
      </div>
      <div class="multicolumn">
        <h3><i class="icon-th"></i> ユーザーページ</h3>
        <p><i class="icon-paper-clip"></i> 本文に貼り付けるなどしてご活用ください</p>
        <h4>読者登録ページ</h4>
        <p>http://entry.stella-mail.jp/<?=$_COOKIE['userid']; ?>/</p>
        <h4>読者情報変更ページ</h4>
        <p>http://reader.stella-mail.jp/<?=$_COOKIE['userid']; ?>/</p>
      </div>
      <h3><i class="icon-star"></i> 配信レポート</h3>
      <table class="multitable"><?=stella_actionreport_list($_COOKIE['userid'],'send_article') ?></table>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>