<?php

//★基本設定/////////////////////////////////////////////////////////

$conn = mysql_connect('mysql116.heteml.jp','_stella','sugarless');
mysql_select_db('_stella',$conn);
mysql_set_charset('utf8',$conn);

//☆////////////////////////////////////////////////////////////////

//--------ユーザーページ--------

//ログイン画面
if(!isset($_POST['flag'])){
  if(isset($_GET['failed'])){
    $failed = "<p style='color:red'><img src='picture/warning.png' class='icon' />ログインに失敗しました。</p>";
  }
$menu = <<< EOF

  <div id="menubox">
    <h3>ログイン</h3>
    <p>登録したユーザーIDとパスワードを入力して、ログインボタンを押してください。</p>
    {$failed}
    <form method="post">
      <dl>
        <dt>ユーザーID</dt>
        <dd><input type="text" name="userid" style="width:200px" /></dd>
        <dt>パスワード</dt>
        <dd><input type="password" name="password" style="width:200px" /></dd>
      </dl>
      <p style="text-align:right"><input type="submit" value="ログイン" /></p>
      <input type="hidden" name="flag" value="nextLoginChecker">
    </form>
  </div>

EOF;

$body = <<< EOF

  <h3>stella(ステラ)はシリアルコード・システムを採用しています</h3>
  <p>stella(ステラ)では有効期限付きのシリアルコードを発行することで、システムをご利用いただけます。はじめてご利用の方は、ログイン後、シリアルコードを発行してください。</p>
  <div style="height:20px;"></div>
  <h3>お申込がまだお済みでないかたへ</h3>
  <p>stella(ステラ)のご利用にはユーザーIDとパスワードを発行する必要があります。まだユーザーIDをお持ちでないかたは、お申込ページよりご登録をお願いいたします。</p>

EOF;
}

//ログインチェック
if($_POST['flag']=="nextLoginChecker"){
  $sql="SELECT * from stella_userbasic where userid = '{$_POST['userid']}' limit 1";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    if($row['password']==$_POST['password']){
      $successkey = true;
      $userbasic = $row;
    }else{
      $successkey = false;
    }
  }
  if(!$successkey){
    header("Location: ./?failed");
  }else{
    setcookie("loginkey", md5($_POST['password']), time()+3600);
    setcookie("userid", $userbasic['userid'], time()+3600);
    header("Location: .");
  }
}

//ログイン後
if(isset($_COOKIE['loginkey'])){
$menu = <<< EOF

  <p><img src="picture/tick.png" class="icon" />ログインしました。</p>
  <ul>
    <li><a href="./">お知らせ</a></li>
    <li><a href="?page=getSerialCode">シリアルコードの発行 (ご契約)</a></li>
    <li><a href="?page=listSerialCode">シリアルコードの管理</a></li>
    <li><a href="http://editor.stella-mail.com" target="_blank">メルマガ発行画面</a></li>
    <li><a href="?page=betaversion">β版について</a></li>
    <li><a href="?logout">ログアウト</a></li>
  </ul>

EOF;
  if(!isset($_GET['page'])){
$body = <<< EOF

  <h3>お知らせ</h3>
  <p>現在お知らせはありません</p>

EOF;
  }elseif($_GET['page']=='getSerialCode'){
    if(!isset($_POST['flag'])){
$body = <<< EOF

  <h3>シリアルコードの発行 (ご契約)</h3>
  <p>stella(ステラ)では有効期限付きのシリアルコードを発行することで、システムをご利用いただけます。はじめてご利用の方や更新をご希望の方は、新たにシリアルコードを発行してください。ご利用規約をよく読み、ご契約内容を入力してください。</p>
  <form method="post">
    <dl>
      <dt>ご契約期間</dt>
      <dd>
        <p><img src="../picture/tick.png" class="icon" />現在「3ヶ月」・「6ヶ月」の契約期間をお選びいただけます</p>
        <input type="radio" name="period" value="3" checked /><strong>3ヶ月</strong> (基本料金：980円×3＝2,940円(税込))<br />
        <input type="radio" name="period" value="6" /><strong>6ヶ月</strong> (基本料金：980円×6＝5,880円(税込))<br />
      </dd>
      <dt>オプション</dt>
      <dd>
        <p><img src="../picture/tick.png" class="icon" />β版につき、オプションプランはご利用頂けません。</p>
        <div style="opacity:0.5">
        <input type="checkbox" name="option_birthday" value="true" disabled /><strong>バースデーメールオプション</strong> (料金：210円/月(税込))<br />
        登録読者の誕生日にあらかじめ設定した「バースデーメール」を自動送信できる機能です<br /><br />
        <input type="checkbox" name="option_regadd" value="true" disabled /><strong>登録用メールアドレス追加オプション</strong> (料金：210円/月(税込))<br />
        空メールを送ると登録用ページのURLを記載したメールを自動返信する専用メールアドレスを発行します<br /><br />
        <input type="checkbox" name="option_feedback" value="true" disabled /><strong>フィードバックページ追加オプション</strong> (料金：210円/月(税込))<br />
        メルマガを読んだ読者がメールごとに感想やコメントを送信できる「フィードバックページ」を追加します<br /><br />
        </div>
      </dd>
      <dt>お支払い方法</dt>
      <dd>
        <p><img src="../picture/tick.png" class="icon" />現在お振込のみとなっております。</p>
        <input type="radio" name="pay" value="hurikomi" checked /><strong>銀行振込</strong> (手数料：お客様負担)<br />
        <div style="opacity:0.5"><input type="radio" name="pay" value="smartpit" disabled /><strong>smartPitによるコンビニ支払い</strong> (手数料：210円(税込))</div>
      </dd>
    </dl>
    <p style="text-align:right"><input type="submit" value="確認" /></p>
    <input type="hidden" name="flag" value="checkSum">
  </form>

EOF;
    }elseif($_POST['flag']=='checkSum'){
      //---ロジック部分---
      if($_POST['period']==3){
        $period = "3ヶ月 (基本料金：980円×3＝2940円(税込))";
        $sumprice += 2940;
      }elseif($_POST['period']==6){
        $period = "6ヶ月 (基本料金：980円×6＝5880円(税込))";
        $sumprice += 5880;
      }
      $opt['none'] = "オプションプランは選択されていません";
      $optPost['b'] = "0";
      $optPost['r'] = "0";
      $optPost['f'] = "0";
      if($_POST['option_birthday']){
        $p = $period * 210;
        $opt['birthday'] = "バースデーメールオプション (料金：210円×{$_POST['period']}={$p}円(税込))<br />";
        $optPost['b'] = "1";
        $opt['none'] = "";
        $sumprice += ($_POST['period'] * 210);
      }
      if($_POST['option_regadd']){
        $p = $period * 210;
        $opt['regadd'] = "登録用メールアドレス追加オプション (料金：210円×{$_POST['period']}={$p}円(税込))<br />";
        $optPost['r'] = "1";
        $opt['none'] = "";
        $sumprice += ($_POST['period'] * 210);
      }
      if($_POST['option_feedback']){
        $p = $period * 210;
        $opt['feedback'] = "フィードバックページ追加オプション (料金：210円×{$_POST['period']}={$p}円(税込))<br />";
        $optPost['f'] = "1";
        $opt['none'] = "";
        $sumprice += ($_POST['period'] * 210);
      }
      //---END---
$body = <<< EOF

  <h3>シリアルコードの発行 (ご契約)</h3>
  <p>ご契約の内容をご確認いただき、画面右下の「シリアルコードを発行」を押して下さい。</p>
  <form method="post">
    <dl>
      <dt>ご契約期間</dt>
      <dd>
        {$period}
      </dd>
      <dt>オプション</dt>
      <dd>
        {$opt['birthday']}{$opt['regadd']}{$opt['feedback']}{$opt['none']}
      </dd>
      <dt>お支払い方法</dt>
      <dd>
        銀行振込
      </dd>
      <dt>合計</dt>
      <dd>
        {$sumprice}円
      </dd>
    </dl>
    <p style="text-align:right"><input type="submit" value="シリアルコードを発行" /></p>
    <input type="hidden" name="flag" value="generateSerialCode">
    <input type="hidden" name="opt_b" value="{$optPost['b']}">
    <input type="hidden" name="opt_r" value="{$optPost['r']}">
    <input type="hidden" name="opt_f" value="{$optPost['f']}">
    <input type="hidden" name="period" value="{$_POST['period']}">
    <input type="hidden" name="price" value="{$sumprice}">
  </form>

EOF;
    }elseif($_POST['flag']=='generateSerialCode'){
      //---ロジック部分---
      $code[1] = rand(1000,9999);
      $code[2] = rand(1000,9999);
      $code[3] = rand(1000,9999);
      $code[4] = rand(1000,9999);
      $code['all'] = $code[1] .'-'. $code[2] .'-'. $code[3] .'-'. $code[4];
      $dtimestamp = strtotime('+'.$_POST['period'].' month');
      $deadline = date('Y/m/d',$dtimestamp);
      $paydead = strtotime('+3 day');
      $settime = date('Y/m/d',$paydead);
      //---END---
      
      //---データベース書き込み---
      $sql   = "INSERT INTO stella_serialcode
                (userid,serialcode,option_birthday,option_regadd,option_feedback,price,paydead,deadline)
                  VALUES
                ('{$_COOKIE['userid']}','{$code['all']}','{$_POST['opt_b']}','{$_POST['opt_r']}','{$_POST['opt_f']}','{$_POST['price']}','{$paydead}','{$dtimestamp}')";
      $query = mysql_query($sql,$conn);
      //---END---
$body = <<< EOF

  <h3>シリアルコードの発行 (ご契約)</h3>
  <p>シリアルコードを発行しました。お支払い方法はメールにも記載していますので、ご確認ください。</p>
    <dl>
      <dt>シリアルコード</dt>
      <dd>
        {$code['all']}
      </dd>
      <dt>有効期限</dt>
      <dd>
        {$deadline}
      </dd>
      <dt>合計</dt>
      <dd>
        {$_POST['price']}円
      </dd>
      <dt>振込先</dt>
      <dd>
        じぶん銀行 みどり支店 (普)2288698　酒井 涼<br /><br />
        ※ 指定期日までにお振込ください<br />
        ※ 手数料はお客様負担となります<br />
        ※ シリアルコードの上4桁({$code[1]})を振込名義人の前につけてください
      </dd>
      <dt>振込期限</dt>
      <dd>
        {$settime} (指定期日までにお振込がなければ無効となります)
      </dd>
    </dl>
    <p style="text-align:right"><button href="?page=listSerialCode">シリアルコード管理</button></p>

EOF;
    }
  }elseif($_GET['page']=='betaversion'){
$body = <<< EOF

  <h3>β版について</h3>
  <p>8月1日の正式リリースに先立ち、現在ステラはプレリリース(β版)として一部の方に先行してサービスを提供しております。万一システムに不備がある場合は、以下の連絡先までお知らせください。</p>
  <p>＜連絡先＞<br />contact@stella-magazine.com (24時間受付)</p><p>SUGARLESS imagination カスタマーサポートセンター<br />050-3598-2200 (水〜金曜 7:00〜12:00 / 22:00〜25:00)</p>
  <p>※ ご連絡は原則2日以内に返答させていただきますが、遅れた際はご容赦ください。</p>

EOF;
  }elseif($_GET['page']=='listSerialCode'){
    $body = "<h3>シリアルコードの管理</h3><p>取得したシリアルコードを確認できます。お支払がお済みであるにもかかわらずお支払確認が「未」と表示される場合は、お手数ですがお問合せください。</p>"; 
    //---シリアルコードリスト---
    $n = 0;
    $sql="SELECT * from stella_serialcode where userid = '{$_COOKIE['userid']}'";
    $query = mysql_query($sql,$conn);
    while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
      $list[$n] = $row;
      $n++;
    }
    //---END---
    if($list[0]['userid']!=""){
      $body .= "<table><tr><th>シリアルコード</th><td>ご契約情報</td></tr>";
      for($i=0;$i<=$n-1;$i++){
        if($list[$i]['paycheck']==0){    //支払確認「未」の場合
          $d = date('Y/m/d',$list[$i]['paydead']);
          $serialinfo = "お支払確認：未<br />ご請求金額：{$list[$i]['price']}円<br />お支払期限：{$d}";
        }else{                           //支払確認「済」の場合
          $d = date('Y/m/d',$list[$i]['deadline']);
          $serialinfo = "お支払確認：済<br />ご契約期限：{$d}";        
        }
        $body .= "<tr><th>{$list[$i]['serialcode']}</th><td>{$serialinfo}</td></tr>";
      }
      $body .= "</table>";
    }else{
      $body .= "<p>シリアルコードが発行されていません</p>";
    }
  $body .= "<p style='border:2px solid #999;padding:10px;margin:12px'>振込先<br />じぶん銀行 みどり支店 (普)2288698　酒井 涼<br /><br />
  ※ 指定期日までにお振込ください<br />※ 手数料はお客様負担となります<br />※ シリアルコードの上4桁を振込名義人の前につけてください</p>";
  }
}

if(isset($_GET['logout'])){
  setcookie("loginkey", "", time() - 3600);
  setcookie("userbasic", "", time() - 3600);
  header("Location: .");
}