<?php
  $home_url = "http://admin.stella-mail.com/";
?>
  <div style="background:#ddd">
    <div class="section container">
      <ul id="menubar" class="col nine mobile-full">
        <li class="mobile-four"><a href="<?=$home_url; ?>"><i class="icon-dashboard"></i> ダッシュボード</a></li>
        <li class="mobile-four"><a href="<?=$home_url; ?>payment/"><i class="icon-yen"></i> 支払い確定</a></li>
      </ul>
      <div class="col three no-mobile" id="menubarid"><i class="icon-gear"></i> 管理者ページ</div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="parts" id="logo_container">
    <div class="section container">
      <div class="col four mobile-full title align-left"><div class="align-center"><a href="<?=$home_url; ?>"><h1>stella</h1><h2>multi-mail-publishing platform<br />beta version 2.0</h2></a></div></div>
      <div class="col eight mobile-full align-right" style="margin-top:20px">
        <div class="col six tablet-four no-mobile" style="color:white">_</div>
        <a href="<?=$home_url ?>edit" class="button button-orange font-small col three tablet-four no-mobile"><i class="icon-pencil"></i> 記事を作成</a>
        <a href="<?=$home_url ?>?logout" class="button button-orange font-small col three tablet-four no-mobile"><i class="icon-power-off"></i> ログアウト</a>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>