<?php
  $home_url = "//users.stella-mail.com/";
  
  if(isset($_GET)){
    $urlpostfix = "?";
    foreach ($_GET as $x => $value){
	  $urlpostfix .= $x . "=" . $value . "&";
    }
    $urlpostfix = substr($urlpostfix, 0, -1);
  }
  
?>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel=”shortcut icon” href="picture/favicon.ico" />
<link rel="stylesheet" href="<?=$home_url; ?>style.css">
<link rel="stylesheet" href="<?=$home_url; ?>lib/base.css">
<link rel="stylesheet" href="<?=$home_url; ?>lib/animate.css">
<link rel="stylesheet" href="<?=$home_url; ?>lib/jquery.powertip.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' type='text/css'>
<?php
if(stristr($_SERVER["HTTP_USER_AGENT"], "iPhone") ) {
echo '<link rel="stylesheet" href="mobile.css">';
}elseif(stristr($_SERVER["HTTP_USER_AGENT"], "Android") ) {
echo '<link rel="stylesheet" href="mobile.css">';
}
?>
<script src="//code.jquery.com/jquery-latest.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=$home_url; ?>lib/jquery.elastic.js"></script>
<script type="text/javascript" src="<?=$home_url; ?>lib/jquery.jrumble.min.js"></script>
<script type="text/javascript" src="<?=$home_url; ?>lib/jquery.originalValidation.js"></script>
<script type="text/javascript" src="<?=$home_url; ?>lib/jquery.powertip.js"></script>
<script type="text/javascript" src="<?=$home_url; ?>lib/jquery.lettering.js"></script>
<script type="text/javascript" src="<?=$home_url; ?>lib/jquery.textillate.js"></script>
<script>
$(function(){
  if ( navigator.userAgent.indexOf('iPhone') > 0 ){
    $('html,body').animate({ scrollTop: $('.content').offset().top }, 'slow','swing');
  }
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
  $('textarea').elastic();
  $('.tips').powerTip({
	placement: 'n',
	smartPlacement: true
  });
  $('.info').textillate({ in: { effect: 'flash' } });
});
function formfocus(){
  $('#userid').focus();
}
if ( navigator.userAgent.indexOf('iPhone') > 0 ){
  window.addEventListener("load", function() {
    setTimeout(scrollBy, 100, 0, $('#logo_container').offset());
  }, false);
}
var d = window.document;
if(navigator.userAgent.indexOf('iPhone') > -1)
	d.write('<meta name="viewport" content="width=320px; user-scalable=no" />');
else if(navigator.userAgent.indexOf('iPad') > -1)
	d.write('<meta name="viewport" content="width=device-width; initial-scale=1.0;" />');
</script>