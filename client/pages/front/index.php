<?php

//Option Loop
function optionLoop($start, $end, $value = null){
  for($i = $start; $i <= $end; $i++){
    if(isset($value) &&  $value == $i){
	  $loop .= "<option value=\"{$i}\" selected=\"selected\">{$i}</option>";
	}else{
	  $loop .= "<option value=\"{$i}\">{$i}</option>";
	}
  }
  return $loop;
}

//Year, Month, Day
$Year  = optionLoop('1950', date('Y'), '1990');
$Month = optionLoop('1', '12');
$Day   = optionLoop('1', '31');

for($i=12;$i<=120;$i++){
  $selected = ($i==20) ? "selected" : "";
  $age .= "<option value='{$i}'{$selected}>{$i}</option>";
}

$pref_list = Array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','長野県','新潟県','富山県','石川県','福井県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
foreach($pref_list as $__pref){
  $selected = ($__pref == "東京都") ? " selected" : "";
  $address .= "<option value=\"{$__pref}\"{$selected}>{$__pref}</option>";
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
        <h3><i class="icon-envelope-alt"></i> 読者登録</h3>
      </div>
      <p class="info"><?=$key['nickname']; ?>さんの登録情報の変更をします。</p>
      <p><?= $warning; ?></p>
      <form method="post">
        <dl class="design">
          <dt>ニックネーム</dt>
          <dd><input type="text" name="nickname" value="<?=$key['nickname'] ?>" /></dd>
          <dt>メールアドレス</dt>
          <dd><input type="text" name="address" value="<?=$key['address'] ?>" /></dd>
        </dl>
        <div class="alignRight design"><input type="submit" value="保存" /></div>
        <input type="hidden" name="code" value="<?=$key['code'] ?>" />
        <input type="hidden" name="flag" value="change" />
      </form>
      <h3><i class="icon-frown"></i> 登録を解除する場合は？</h3>
      <p>登録を解除する場合は、以下のボタンをクリックしてください。</p>
      <form method="post">
        <div class="alignRight design"><input type="submit" value="登録解除" /></div>
        <input type="hidden" name="code" value="<?=$key['code'] ?>" />
        <input type="hidden" name="flag" value="delete" />
      </form>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>