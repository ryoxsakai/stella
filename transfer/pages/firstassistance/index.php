<?php

if(!isset($_POST['flag'])){
  $magazineHeader = @file_get_contents('lib/default/header.txt');
  $magazineFooter = @file_get_contents('lib/default/footer.txt');
  $magazineWelcomeMail = @file_get_contents('lib/default/welcomeMail.txt');
}

//今月の残り日数
function remainDate($day){
  return intval((strtotime($day) - strtotime(date('Y/m/d'))) / (60*60*24));
}

$remainDate = remainDate(date('Y/m/t'));
$hiwari_price = ($remainDate * 35) + 105;

$price = $hiwari_price + (980*2);

$deadline = date("Y年m月",strtotime("+1 month"));
$transfer_day = date("Y年m月d日",strtotime("+4 day"));

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
        <h3><span class="id">stella</span>へようこそ！</h3>
        <p class="info">まずは初期設定を行いましょう</p>
        <p>この度は<span class="id">stella</span>をご利用いただきありがとうございます。<br />まずはじめにメルマガの利用開始に必要な<strong>初期設定</strong>を行います。<br />インストラクションにしたがって必要な情報を入力しましょう！</p>
      </div>
      <form method="post">
        <h3><i class="icon-envelope-alt"></i> メルマガの設定</h3>
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
        <h3><i class="icon-credit-card"></i> お支払いについて</h3>
        <p>お振込の方に限り、3ヶ月ごとに3ヶ月分のお支払いをお願いしております(初月は日割＋2ヶ月分となります)。</p>
        <p>振込先情報は設定後「お支払い情報」ページでもご確認いただけます。</p>
        <dl>
          <dt>ご利用料金 (<?=$deadline ?>末日まで)</dt>
          <dd>
            <?=$price ?>円 (日割料金 <?=$hiwari_price ?>円 が含まれます)<input type="hidden" name="amount" value="<?=$price ?>" />
            <input type="hidden" name="deadline" value="<?=$deadline ?>" /><input type="hidden" name="check" value="NotYet" />
          </dd>
          <dt>振込先</dt>
          <dd>
            ジャパンネット銀行 すずめ支店 (支店番号002)<br />
            普通口座 2612568<br />
            名義：シュガーレスイマジネーションサカイリョウ
          </dd>
          <dt>お振込期限</dt>
          <dd>
            <?=$transfer_day; ?><br />
            ※ 必ず期日までにお支払いください。
          </dd>
        </dl>
        <div class="alignRight design"><input type="submit" value="保存" /></div>
        <input type="hidden" name="flag" value="firstAssistance" />
      </form>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>