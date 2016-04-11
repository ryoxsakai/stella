<?php
  if($_GET['specialmode']=='transfer'){
    $specialdesc = '<p class="error">特別モード：振込決済対応(3ヶ月支払)で登録します</p>';
  }elseif($_GET['specialmode']=='free'){
    $specialdesc = '<p class="error">特別モード：特別無料招待モードで登録します</p>';
  }
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once 'blocks/head.php'; ?>
<script>
$(function(){
  $("#mail,#userid").blur(function (){
    $("p.error").remove();
    $('#submit').attr('disabled','disabled');
    $.ajax({
      url: 'http://stella-mail.com/lib/unvalidationchecker.php',
      type: 'POST',
      data: {
        mail: $('#mail').val(),
        userid: $('#userid').val()
      },
      dataType: 'html',
      success: function(data){
        $('form').prepend(data);
        if($("p.error").size() == 0){
          $('#submit').removeAttr('disabled');
        }
      },
      error: function(data){
        $('form').prepend('<p class="error">通信エラー</p>');
        $('#submit').attr('disabled','disabled');     
      }
    });
  });
});
</script>
<title>メルマガスタンド stella -ステラ-｜配信無制限！業界新登場の高機能メルマガスタンド ステップメールもできて月額980円〜</title>
</head>
<body>
  <?php require_once 'blocks/top.php'; ?>
  <div class="parts" id="parts_HEAD">
    <div class="section container align-center">
      <p>配信無制限！業界新登場の高機能メルマガスタンド「<span class="id">stella</span>」(ステラ)</p>
    </div>
    <div class="section container no-mobile align-center">
      <img src="picture/topboard.png" id="topboard" />
      <a href="#parts_SIGNUP" class="button button-block button-large button-red" id="ImmediateSignup"><i class="icon-share-alt"></i> 今すぐサインアップ</a>
    </div>
  </div>
  <div class="parts" id="parts_PRICE">
    <div class="section container align-center">
      <h3><i class="icon-envelope-alt" style="font-size:300%"></i>多機能メルマガが今までで一番カンタンに。<br />月額たったの980円から。</h3>
      <p>ご利用にかかる初期費用は一切なし。<br />980円からというリーズナブルな価格でプロ並みのメルマガスタンドが使えます。</p>
      <table id="list" style="text-align:center;overflow:scroll">
        <tr>
          <th></th>
          <th>ビギナーズプラン</th>
          <th>スタンダードプラン</th>
          <th>パケットプラン</th>
        </tr>
        <tr>
          <th>配信数</th>
          <td><strong>無制限</strong></td>
          <td><strong>無制限</strong></td>
          <td><strong>無制限</strong></td>
        </tr>
        <tr>
          <th>登録リスト数</th>
          <td>250件</td>
          <td>1000件</td>
          <td><strong>無制限</strong></td>
        </tr>
        <tr>
          <th>初期費用</th>
          <td><strong>無料</strong></td>
          <td><strong>無料</strong></td>
          <td><strong>無料</strong></td>
        </tr>
        <tr>
          <th>月額料金 <small>(税込)</small></th>
          <td>980円</td>
          <td>1,980円</td>
          <td>2,980円</td>
        </tr>
        <tr>
          <th>お支払い方法</th>
          <td colspan="3">クレジットカード決済</td>
        </tr>
        </tr>
      </table>
      <div class="align-left">
        <small>
          ※1 各プランをご利用の際には、<strong>クレジットカード登録</strong>が必須です。<br />
          ※2 登録リスト数が251件・1001件になると自動的にプランが「スタンダードプラン」及び「パケットプラン」に繰り上げられます。<br />
          ※3 初月のみ、日割にて料金を算出します。詳しくはペイメントガイドをご覧下さい。
        </small>
      </div>
    </div>
  </div>
  <div class="parts" id="parts_REASON">
    <div class="section container align-center">
      <h3><i class="icon-thumbs-up-alt" style="font-size:300%"></i>選ばれているのには理由がある。<br />初心者にも分かりやすいインターフェイス。</h3>
      <img src="picture/screenimage.png" class="float-right" width="350px" /><p>これからメルマガを始める女の子でもカンタン操作。<br />iPhone・iPadにも対応してさらに便利に。</p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="parts" id="parts_FUNCTION">
    <div class="section container align-center">
      <h3><i class="icon-bar-chart" style="font-size:300%"></i>本当に必要な機能だけを「標準実装」。<br />新たな機能もどんどん追加していきます。</h3>
      <p>シンプル・明快・便利がそろいました。<br />効果的に使いこなしてあなたの読者を増やしましょう。</p>
      <div class="function" class="section row">
        <div class="col four mobile-full"><h4><i class="icon-time"></i>時間指定配信</h4><small>あらかじめ指定した時刻にメールを配信します　<small style="color:darkorange">※1</small></small></div>
        <div class="col four no-mobile"><h4><i class="icon-list-ul"></i>登録読者一覧</h4><small>登録読者の年齢や地域などを並び替えできます</small></div>
        <div class="col four mobile-full"><h4><i class="icon-spinner"></i>ステップメール配信</h4><small>シナリオを作成して自動で売上アップにつなげましょう　<small style="color:darkorange">※1</small></small></div>
      </div>
      <div class="function" class="section row">
        <div class="col four no-mobile"><h4><i class="icon-indent-right"></i>宛名差込</h4><small>相手のお名前やメールアドレスなどを本文に差し込むことができます</small></div>
        <div class="col four no-mobile"><h4><i class="icon-edit"></i>ヘッダー＆フッター</h4><small>決まった定型の形をヘッダー・フッターとして差し込むことができます</small></div>
        <div class="col four mobile-full"><h4><i class="icon-comment-alt"></i>ウェルカムメール送信</h4><small>読者登録直後に最初に送るメールの定型文を編集できます</small></div>
      </div>
      <div class="function" class="section row">
        <div class="col four no-mobile"><h4><i class="icon-download-alt"></i>ショートURL作成</h4><small>p.tl APIと連動しているので、長いアドレスもカンタンにショートURL化できます</small></div>
        <div class="col four mobile-full"><h4><i class="icon-qrcode"></i>QRコード発行</h4><small>登録ページURLのQRコードを自動生成して名刺などに転載できます</small></div>
        <div class="col four no-mobile"><h4><i class="icon-desktop"></i>配信レポート</h4><small>配信時間・配信数などが一目で分かるページ＆メールでも送信可能　<small style="color:darkorange">※1</small></small></div>
      </div>
      <div class="function" class="section row">
        <div class="col four no-mobile"><h4><i class="icon-external-link"></i>テスト配信</h4><small>一斉送信前にご自身のアドレスにテスト配信することもできます</small></div>
        <div class="col four mobile-full"><h4><i class="icon-calendar"></i>バックナンバーページ</h4><small>これまで配信されたバックナンバーの一覧ページも利用できます</small></div>
        <div class="col four no-mobile"><h4><i class="icon-mobile-phone"></i>スマホ対応</h4><small>スマートフォンにも対応しているのでいつでも持ち歩き可能</small></div>
      </div>
      <div class="align-left clearfix">
        <small>
          ※1 β版(1.1)につき「時間指定配信」「ステップメール配信」「配信レポート」機能については<strong>今後リリース予定</strong>となります。
        </small>
      </div>
    </div>
  </div>
  <div class="parts" id="parts_SIGNUP">
    <div class="section container align-center">
      <p>準備はできましたか？<br />3つの項目を埋めるだけで、すぐにメルマガ配信を始められます。</p><br />
      <div class='pure-g-r'>
        <div class="col five tablet-four no-mobile align-center" style="margin-top:80px"><img src="picture/breaktime.png" /></div>
        <div class="col seven tablet-eight mobile-full">
          <form method="post">
            <?=$specialdesc;?>
            <label for="userid"><i class="icon-male"></i>希望ID</label>
            <input type="text" name="userid" id="userid" class="validate useridLength required" autocapitalize="off" autocorrect="off" />
            <label for="password"><i class="icon-key"></i>パスワード</label>
            <input type="password" name="password" id="password" class="validate passwordLength required" autocorrect="off" />
            <label for="mail"><i class="icon-envelope-alt"></i>メールアドレス</label>
            <input type="text" name="mail" id="mail" class="validate mail required" autocapitalize="off" autocorrect="off" />
            <div class="align-right" style="margin:10px 0">
              <input type="checkbox" name="terms" id="terms" class="validate checkboxRequired" /><label for="terms" style="display:inline"><small><a href="pages/terms/" target="_blank"  style="letter-spacing:4px">利用規約</a>に同意する</small></label>
            </div>
            <input type="submit" id="submit" class="button button-block" value="サインアップしてメルマガをはじめる" disabled="disabled" />
            <input type="hidden" name="flag" />
          </form>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>