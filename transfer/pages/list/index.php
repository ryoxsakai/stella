<?php
  $home_url = "https://users.stella-mail.com/";
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
		location.href = "<?php echo $home_url; ?>list/del/" + code ;
	}else{
		window.alert('キャンセルされました'); // 警告ダイアログを表示
	}
}
function test(code){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('メルマガ記事をテスト配信しますか？')){
		location.href = "<?php echo $home_url; ?>list/test/" + code ;
	}else{
		window.alert('キャンセルされました'); // 警告ダイアログを表示
	}
}
function delmail(code){
	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('メールアドレスを削除しますか？')){
		location.href = "<?php echo $home_url; ?>list/delmail/" + code ;
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
      <h4 style="display:inline-block;margin-right:20px">配信一覧 (<?php echo stella_countholder($_COOKIE['userid']); ?>件)</h4><a href="<?php echo $home_url; ?>edit/"><i class="icon-edit"></i> 新規作成</a>
      <table class="multitable"><?=$holder; ?></table>
      <h4 style="display:inline-block;margin-right:20px">読者一覧 (<?php echo stella_countlist($_COOKIE['userid']); ?>件)</h4><a href="http://client.stella-mail.com/<?php echo $_COOKIE['userid'] ?>/" target="_blank"><i class="icon-user"></i> 読者登録</a>
      <table class="multitable"><?=$list; ?></table>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>