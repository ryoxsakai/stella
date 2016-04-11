<?php

require_once 'lib/webpay.php';
require_once 'lib/function.php';

$info = "お支払い情報についてのページです。";

if($_POST['flag']=='paymentAction'){
  //課金情報
  $e = WebPayCreateCustomer($_POST);

  //magazineSecret
  $fp = fopen(FULLPATH.'magazineSecret.txt', "w");
  @fwrite($fp, $e, strlen($e) );
  fclose($fp);
  $sql = "UPDATE stella_userbasic SET customerid = '{$e}' where userid = '{$_COOKIE['userid']}'";
  $query = mysql_query($sql,$conn);
  
  //CV手数料の課金
  $userid = stella_userbasic_search('userid','customerid',$e);
  $data['amount'] = 105;
  $data['customer'] = $e;
  $data['description'] = '[stella] '.$userid.' : CV手数料として'.$data['amount'].'円を課金しました';
  try {
    WebPayCustomerCharge($data);
    stella_actionreport_insert($_COOKIE['userid'],'make_charge','CV手数料として'.$data['amount'].'円を課金しました');
    // 有効性情報をTRUEに
    $sql = "UPDATE stella_userbasic SET card_validation = 1 where userid = '{$_COOKIE['userid']}'";
    $query = mysql_query($sql,$conn);
    //更新完了
    stella_actionreport_insert("{$_COOKIE['userid']}","modify_credit","クレジットカード情報を変更しました。");
    $info = "クレジットカード情報を更新しました";
  }catch(Stripe_CardError $e) {
  // カードが拒否された場合
  $body = $e->getJsonBody();
  $err = $body['error'];
  print('Status is:' . $e->getHttpStatus() . "\n");
  print('Type is:' . $err['type'] . "\n");
  print('Code is:' . $err['code'] . "\n");
  print('Param is:' . $err['param'] . "\n");
  print('Message is:' . $err['message'] . "\n");
} catch (Stripe_InvalidRequestError $e) {
  // リクエストで指定したパラメータが不正な場合
} catch (Stripe_AuthenticationError $e) {
  // 認証に失敗した場合
} catch (Stripe_ApiConnectionError $e) {
  // APIへの接続エラーが起きた場合
} catch (Stripe_Error $e) {
  // WebPayのサーバでエラーが起きた場合
} catch (Exception $e) {
  // WebPayとは関係ない例外の場合
}
/*
  } catch (Stripe_CardError $e) {
    // カードが拒否された場合
    $body = $e->getJsonBody();
    $err = $body['error'];
    stella_actionreport_insert($_COOKIE['userid'],'card_error',"カード情報の有効性が確認できません (エラーコード：{$err['code']}) {$err['message']}");
    // 有効性情報をFALSEに
    $sql = "UPDATE stella_userbasic SET card_validation = 0 where userid = '{$_COOKIE['userid']}'";
    $query = mysql_query($sql,$conn);
    $info = "カード情報の有効性が確認できません (エラーコード：{$err['code']}) {$err['message']}";
  } catch (Stripe_InvalidRequestError $e) {
    // リクエストで指定したパラメータが不正な場合
    $info = "カード情報の有効性が確認できません (情報を再度入力してください)";
  } catch (Stripe_AuthenticationError $e) {
    // 認証に失敗した場合
    $info = "認証に失敗しました。この状態が長く続く場合はお問合せください。";
  } catch (Stripe_ApiConnectionError $e) {
    // APIへの接続エラーが起きた場合
    $info = "接続に失敗しました。この状態が長く続く場合はお問合せください。";
  } catch (Stripe_Error $e) {
    // WebPayのサーバでエラーが起きた場合
    $info = "サーバーエラーが発生しました。この状態が長く続く場合はお問合せください。";
  } catch (Exception $e) {
    // WebPayとは関係ない例外の場合
    $info = "予期しないエラーが発生しました。この状態が長く続く場合はお問合せください。";
  }
*/
}

//$customer = WebPayCustomerInformation($_COOKIE['id']);

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
        <h3><i class="icon-yen"></i> お支払い情報</h3>
      </div>
      <p class="info"><?=$info; ?></p>
      <form method="post">
        <h3><i class="icon-credit-card"></i> 登録中のカード情報</h3>
        <dl>
          <dt>現在登録中のクレジットカード</dt>
          <dd>
            <p>****-****-****-<?=$customer->active_card->last4; ?> (<?=$customer->active_card->type; ?>)</p>
            <p><i class="icon-chevron-sign-right"></i> カード情報が無効になるとサービスが停止しますので、正常な情報が入力されているかご確認ください。</p>
          </dd>
        </dl>
        <h3><i class="icon-credit-card"></i> お支払い履歴</h3>
        <p>課金処理については、<a href="http://stella-mail.com/pages/payment/" target="_blank">ペイメントガイド</a>をお読みください。</p>
        <table class="multitable"><?=stella_actionreport_list($_COOKIE['userid'],'make_charge') ?></table>
        <h3><i class="icon-credit-card"></i> カード情報の更新</h3>
        <p>料金のお支払いについては、<a href="http://stella-mail.com/pages/payment/" target="_blank">ペイメントガイド</a>をお読みください。</p>
        <dl>
          <dt>CV手数料</dt>
          <dd>
            105円 (税込)
          </dd>
          <dt>クレジットカード番号</dt>
          <dd>
            <input type="tel" name="cardNum1" maxlength="4" class="Cardnum" /> - <input type="tel" name="cardNum2" maxlength="4" class="Cardnum" /> - <input type="tel" name="cardNum3" maxlength="4" class="Cardnum" /> - <input type="tel" name="cardNum4" maxlength="4" class="Cardnum" />
          </dd>
          <dt>有効期限</dt>
          <dd>
            <input type="tel" name="cardExMonth" maxlength="2" class="Cardnum" placeholdinfo = "<?php echo date('m') ?>" /> / <input type="tel" name="cardExYear" maxlength="2" class="Cardnum" placeholdinfo = "<?php echo date('y') ?>" />
          </dd>
          <dt>CVC</dt>
          <dd>
            <input type="password" name="cardCVC" maxlength="3" class="Cardnum" placeholdinfo = "123" />
            <p><i class="icon-chevron-sign-right"></i> カード裏面に記載されている3ケタのセキュリティコードです。</p>
          </dd>
          <dt>カード保有者氏名</dt>
          <dd class="design">
            <input type="text" name="cardName" maxlength="20" placeholdinfo = "FUMIKO HOSHINO" />
            <p><i class="icon-chevron-sign-right"></i> カードに記載されている通りにご記入ください。</p>
          </dd>
        </dl>
        <div class="alignRight design"><input type="submit" value="保存" /></div>
        <input type="hidden" name="flag" value="paymentAction" />
      </form>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>