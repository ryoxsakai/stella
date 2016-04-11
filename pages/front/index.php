<?php

//ファイルの読み込み//
$magazineFrom   = @file_get_contents(FULLPATH.'magazineFrom.txt');
$magazineTitle  = @file_get_contents(FULLPATH.'magazineTitle.txt');
$magazineHeader = @file_get_contents(FULLPATH.'magazineHeader.txt');
$magazineFooter = @file_get_contents(FULLPATH.'magazineFooter.txt');
$magazineTestAddress = @file_get_contents(FULLPATH.'magazineTestAddress.txt');
$magazineWelcomeMail = @file_get_contents(FULLPATH.'magazineWelcomeMail.txt');

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
        <h3><i class="icon-dashboard"></i> ダッシュボード</h3>
        <p class="info"><?=$_COOKIE['userid']; ?>さん、こんにちは！早速記事を書いてみませんか？</p>
        <p><a href="?mode=edit"><i class="icon-edit"></i> メルマガ記事を作成</a></p>
      </div>
      <div class="multicolumn">
        <h3><i class="icon-comment-alt"></i> 発行中のメルマガ</h3>
        <p>メルマガのタイトル<br /><?=$magazineTitle; ?></p>
        <p><i class="icon-chevron-right"></i> <a href="https://users.stella-mail.com/config/">変更する</a></p>
      </div>
      <div class="multicolumn">
        <h3><i class="icon-smile"></i> 読者数と記事数</h3>
        <p><div class="mobile-six">現在の読者数：<?php echo stella_countlist($_COOKIE['userid']); ?>件</div><span class="typebutton <?php $n = stella_holdertype($_COOKIE['userid']); echo $n['name']; ?> mobile-six"><?php echo $n['desc']; ?>プラン</span></p>
        <p>現在の記事数：<?php echo stella_countholder($_COOKIE['userid']); ?>件</p>
        <p><i class="icon-chevron-right"></i> <a href="https://users.stella-mail.com/list/">配信リストを表示</a></p>
      </div>
      <div class="multicolumn">
        <h3><i class="icon-th"></i> ユーザーページ</h3>
        <p>本文に貼り付けるなどしてご活用ください</p>
        <h4>読者登録ページ</h4>
        <p><a href="http://entry.stella-mail.com/<?=$_COOKIE['userid']; ?>/" target="_blank">http://entry.stella-mail.com/<?=$_COOKIE['userid']; ?>/</a></p>
        <h4>バックナンバーページ</h4>
        <p><a href="http://backnumber.stella-mail.com/<?=$_COOKIE['userid']; ?>/" target="_blank">http://backnumber.stella-mail.com/<?=$_COOKIE['userid']; ?>/</a></p>
        <h4>読者情報変更ページ</h4>
        <p>http://client.stella-mail.com/<?=$_COOKIE['userid']; ?>/[VERIFIER]/</p>
        <p>メールに貼り付けると[VERIFIER]タグは個人の識別IDに置き換えられます。詳しくはタグ一覧をご覧下さい。</p>
      </div>
      <div class="multicolumn" style="padding-bottom:20px">
        <h3><i class="icon-star"></i> 配信レポート</h3>
        <table class="multitable"><?=stella_actionreport_list($_COOKIE['userid'],'send_article') ?></table>
      </div>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>