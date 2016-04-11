<?php
  $home_url = "http://free.stella-mail.com/";
  if(!isset($_COOKIE['loginkey'])){
?>
  <div id="layer"></div>
  <div class="parts hide" id="parts_LOGIN">
    <div class="section container"><p>ログイン</p></div>
    <form method="post" class="section container" action="<?=$urlpostfix; ?>">
      <div class="col five mobile-full">
        <input type="text" name="userid" id="loginid" placeholder="ユーザーID" autocapitalize="off" autocorrect="off" />
      </div>
      <div class="col five mobile-full">
        <input type="password" name="password" id="loginpass" placeholder="パスワード" autocapitalize="off" autocorrect="off" />
      </div>
      <div class="col two mobile-full">
        <input type="submit" value="ログイン" />
        <input type="hidden" name="flag" value="loginChecker">
      </div>
    </form>
    <div class="clearfix"></div>
  </div> 
  <div class="parts" style="padding-bottom:40px">
    <div class="section container">
      <div class="col four mobile-full title"><a href="http://stella-mail.com/"><h1>stella</h1><h2>multi-mail-publishing platform</h2></a></div>
      <div class="col eight mobile-full align-right" style="margin-top:20px">
        <div class="col eight tablet-seven no-mobile" style="color:white">_</div>
        <a href="http://stella-mail.com/" class="button  button-orange font-small col four tablet-five mobile-full"><i class="icon-share-alt"></i> トップページへ</a>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
<?php
  }else{
?>
  <div style="background:#ddd">
    <div class="section container">
      <ul id="menubar" class="col nine mobile-full">
        <li class="mobile-four"><a href="<?=$home_url; ?>"><i class="icon-dashboard"></i> ダッシュボード</a></li>
        <li class="mobile-four"><a href="<?=$home_url; ?>list/"><i class="icon-list-alt"></i> リスト</a></li>
        <li class="mobile-four"><a href="<?=$home_url; ?>edit/"><i class="icon-edit"></i> 記事を作成</a></li>
        <li class="mobile-four"><a href="<?=$home_url; ?>config/"><i class="icon-cog"></i> メルマガの設定</a></li>
        <li class="no-tablet mobile-four"><a href="<?=$home_url; ?>?logout"><i class="icon-power-off"></i> ログアウト</a></li>
      </ul>
      <div class="col three no-mobile" id="menubarid"><i class="icon-user"></i> <?=$_COOKIE['userid']; ?> (フリープラン)</div>
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
<?php
  }
?>