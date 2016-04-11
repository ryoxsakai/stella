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
      <div class="col twelve title align-center"><a href="<?=$home_url; ?>"><h1>stella</h1><h2>multi-mail-publishing platform</h2></a></div>
    </div>
    <div class="clearfix"></div>
  </div>