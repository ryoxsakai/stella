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

if($info==''){
  $info = "カードの有効性が確認できません。料金のお支払いについては、<a href=\"http://stella-mail.com/pages/payment/\" target=\"_blank\">ペイメントガイド</a>をお読みください。";
}

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
        <h3><i class="icon-credit-card"></i> お支払い情報の再設定</h3>
        <p class="info">有効なカードを再入力してください</p>
      </div>
      <form method="post">
        <p><?php echo $info; ?></p>
        <dl>
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
        <div class="alignRight design"><input type="submit" value="お支払い情報を更新" /></div>
        <input type="hidden" name="flag" value="exitexpiration" />
      </form>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>