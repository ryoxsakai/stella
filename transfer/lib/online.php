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
      url: 'http://sugarless.heteml.jp/service/new_stella/lib/unvalidationchecker.php',
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
        $('form').prepend('エラー');
        $('#submit').attr('disabled','disabled');     
      }
    });
  });
});
</script>
<title>ユーザー専用ページ｜メルマガスタンド stella -ステラ-｜配信無制限！業界新登場の高機能メルマガスタンド ステップメールもできて月額980円〜</title>
</head>
<body>
  <?php require_once 'blocks/top.php'; ?>
  <div class="parts" id="parts_HEAD">
    <div class="section container align-center">
      <div>XXさん、ようこそ！</div>
    </div>
    </div>
  </div>
  </div><?php require_once 'blocks/bottom.php'; ?>
</body>
</html>