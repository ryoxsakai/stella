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
$price = ($remainDate * 35) + 105;

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
        <h3><i class="icon-credit-card"></i> お支払い情報の設定</h3>
        <p>初月のみ、日割料金が発生します。料金のお支払いについては、<a href="http://stella-mail.com/pages/payment/" target="_blank">ペイメントガイド</a>をお読みください。</p>
        <dl>
          <dt>日割料金</dt>
          <dd>
            <?=$price ?>円 (1日あたり35円＋CV手数料105円で計算しています)<input type="hidden" name="amount" value="<?=$price ?>" />
          </dd>
          <dt>クレジットカード番号</dt>
          <dd>
            <input type="tel" name="cardNum1" maxlength="4" class="Cardnum" /> - <input type="tel" name="cardNum2" maxlength="4" class="Cardnum" /> - <input type="tel" name="cardNum3" maxlength="4" class="Cardnum" /> - <input type="tel" name="cardNum4" maxlength="4" class="Cardnum" />
          </dd>
          <dt>有効期限</dt>
          <dd>
            <input type="tel" name="cardExMonth" maxlength="2" class="Cardnum" placeholder="<?php echo date('m') ?>" /> / <input type="tel" name="cardExYear" maxlength="2" class="Cardnum" placeholder="<?php echo date('y') ?>" />
          </dd>
          <dt>CVC</dt>
          <dd>
            <input type="password" name="cardCVC" maxlength="3" class="Cardnum" placeholder="123" />
            <p><i class="icon-chevron-sign-right"></i> カード裏面に記載されている3ケタのセキュリティコードです。</p>
          </dd>
          <dt>カード保有者氏名</dt>
          <dd class="design">
            <input type="text" name="cardName" maxlength="20" placeholder="FUMIKO HOSHINO" />
            <p><i class="icon-chevron-sign-right"></i> カードに記載されている通りにご記入ください。</p>
          </dd>
        </dl>
        <div class="alignRight design"><input type="submit" value="保存" /></div>
        <input type="hidden" name="flag" value="firstAssistance" />
      </form>
      <p>エラーメッセージが表示されましたらブラウザの「戻る」ボタンを押して再度正しいクレジットカード情報を入力してください。</p>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>