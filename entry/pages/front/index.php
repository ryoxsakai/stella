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
      <p class="info">この度は、「<?= $magazineTitle; ?>」へのご登録、まことにありがとうございます。以下に必要事項を記入の上、送信ボタンを押してください。</p>
      <p><?= $warning; ?></p>
      <form method="post" action="?mode=thanks">
        <dl>
          <dt>お名前(ニックネームも可)</dt>
          <dd class="design"><input type="text" name="nickname" required /></dd>
          <dt>生年月日</dt>
          <dd>
            <select name="year"><?=$Year ?></select>年
            <select name="month"><?=$Month ?></select>月
            <select name="day"><?=$Day ?></select>日
          </dd>
          <dt>性別</dt>
          <dd>
            <input type="radio" name="sex" value="male" id="male" /><label for="male">男性</label>
            <input type="radio" name="sex" value="female" id="female" /><label for="female">女性</label>
          </dd>
          <dt>住所</dt>
          <dd><select name="prefecture" required /><?=$address; ?></select></dd>
          <dt>職業</dt>
          <dd class="design"><input type="text" name="job" required /></dd>
          <dt>メールアドレス</dt>
          <dd class="design"><input type="text" name="address" required /></dd>
        </dl>
        <div class="alignRight design"><input type="submit" value="上記の内容で登録する" /></div>
        <input type="hidden" name="flag" value="on" />
      </form>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>