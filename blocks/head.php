<?php
  $home_url = "http://stella-mail.com/";
?>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel=”shortcut icon” href="picture/favicon.ico" />
<link rel="stylesheet" href="<?=$home_url; ?>style.css">
<link rel="stylesheet" href="<?=$home_url; ?>lib/base.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.2.0/grids-min.css">
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' type='text/css'>
<?php
if(stristr($_SERVER["HTTP_USER_AGENT"], "iPhone") ) {
echo '<link rel="stylesheet" href="mobile.css">';
}elseif(stristr($_SERVER["HTTP_USER_AGENT"], "Android") ) {
echo '<link rel="stylesheet" href="mobile.css">';
}
?>
<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$home_url; ?>lib/jquery.jrumble.min.js"></script>
<script type="text/javascript" src="<?=$home_url; ?>lib/jquery.originalValidation.js"></script>
<script>
$(function(){
  $('h1').jrumble({
	speed: 100
  });
  $('h1').hover(function(){
	$(this).trigger('startRumble');
  }, function(){
	$(this).trigger('stopRumble');
  });
  $('a[href^="#"]').click(function(event) {
    var id = $(this).attr("href");
    var offset = 0;
    var target = $(id).offset().top - offset;
    $('html, body').animate({scrollTop:target}, 500);
    event.preventDefault();
    formfocus();
    return false;
  });
  $('.blackout').click(function(){
    $('#parts_LOGIN').show();
    var width  = $(document).width();
    var height = $(document).height() + 100;
    $('#layer').width(width)
               .height(height)
               .show()
               .fadeTo('slow',0.8);
    $('#loginid').focus();
  });
  $('#layer').click(function(){
    $(this).fadeTo('fast',0).hide();
    $('#parts_LOGIN').hide();
  });
});
function formfocus(){
  $('#userid').focus();
}
var d = window.document;
if(navigator.userAgent.indexOf('iPhone') > -1)
	d.write('<meta name="viewport" content="width=320px; user-scalable=no" />');
else if(navigator.userAgent.indexOf('iPad') > -1)
	d.write('<meta name="viewport" content="width=device-width; initial-scale=1.0;" />');
</script>