<?php
  require_once 'lib/publish_list.php';
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once 'blocks/head.php'; ?>
<script type="text/javascript">
<!--
function disp(code){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('メルマガ記事を削除しますか？')){
		location.href = "?mode=list&del=" + code ;
	}else{
		window.alert('キャンセルされました'); // 警告ダイアログを表示
	}
}
function test(code){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('メルマガ記事をテスト配信しますか？')){
		location.href = "?mode=list&test=" + code ;
	}else{
		window.alert('キャンセルされました'); // 警告ダイアログを表示
	}
}
function delstep(code){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('ステップ記事を削除しますか？')){
		location.href = "?mode=list&delstep=" + code ;
	}else{
		window.alert('キャンセルされました'); // 警告ダイアログを表示
	}
}
function teststep(code){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('ステップ記事をテスト配信しますか？')){
		location.href = "?mode=list&deltest=" + code ;
	}else{
		window.alert('キャンセルされました'); // 警告ダイアログを表示
	}
}
function delmail(code){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('メールアドレスを削除しますか？')){
		location.href = "?mode=list&delmail=" + code ;
	}else{
		window.alert('キャンセルされました'); // 警告ダイアログを表示
	}
}
// -->
</script>
<title>メルマガスタンド stella -ステラ-｜配信無制限！業界新登場の高機能メルマガスタンド ステップメールもできて月額980円〜</title>
</head>
<body>
  <?php require_once 'blocks/top.php'; ?>
  <div class="content">
    <div class="section container">
      <div class="headtypo">
        <h3><i class="icon-list-alt"></i> 配信リスト</h3>
        <p class="info"><?=$info; ?></p>
      </div>
      <h4>配信一覧 (<?php echo stella_countholder($_COOKIE['id']); ?>件)</h4>
      <table class="multitable"><?=$holder; ?></table>
      <h4>読者一覧 (<?php echo stella_countlist($_COOKIE['id']); ?>件) <span class="typebutton <?php $n = stella_holdertype($_COOKIE['id']); echo $n['name']; ?>" style="font-weight:normal"><?php echo $n['desc']; ?>プラン</span></h4>
      <table class="multitable"><?=$list; ?></table>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>