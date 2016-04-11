<?php

$home_url = "https://users.stella-mail.com/";

require_once 'mailer.php';

  $info = "このページでは配信一覧と読者リストが確認できます。";
  
  if(isset($_GET['from'])){
    if($_GET['from'] == 'newMail'){
      $info = "新しいメルマガ記事を保存しました。";
    }elseif($_GET['from'] == 'modMail'){
      if(isset($_GET['code'])){
        $info = "「".stella_article_title($_COOKIE['userid'],$_GET['code'])."」を保存しました。";
      }else{
        $info = "編集したメルマガ記事を保存しました。";
      }
    }elseif($_GET['from'] == 'sentMail'){
      if(isset($_GET['code'])){
        $info = "「".stella_article_title($_COOKIE['userid'],$_GET['code'])."」を送信しました。";
      }else{
        $info = "メルマガ記事を送信しました。";
      }
    }
  }

  //削除
  if(isset($_GET['del'])){
    $title = stella_article_title($_COOKIE['userid'],$_GET['del']);
    $sql = "DELETE from userdata_{$_COOKIE['userid']}_holder where code = '{$_GET['del']}'";
    $query = mysql_query($sql,$conn);
    stella_actionreport_insert("{$_COOKIE['userid']}","delete_article","メルマガ記事『{$title}』を削除しました。");
    $info = "メルマガ記事を削除しました。";
  }

  //メールアドレス削除
  if(isset($_GET['delmail'])){
    $sql = "DELETE from userdata_{$_COOKIE['userid']}_list where code = '{$_GET['delmail']}'";
    $query = mysql_query($sql,$conn);
    stella_actionreport_insert("{$_COOKIE['userid']}","delete_client_byuser","メールアドレスを削除しました。");
    $info = "メールアドレスを削除しました。";
  }
  
  //テスト配信
  if(isset($_GET['test'])){
    $magazineTestAddress = @file_get_contents(FULLPATH.'magazineTestAddress.txt');
    MAG_MAILER($_GET['test'],$magazineTestAddress);
    stella_actionreport_insert("{$_COOKIE['userid']}","test_article","メルマガ記事『{$title}』をテスト送信しました。");
    $info = "メルマガ記事をテスト配信しました。";
  }

$sql="SELECT * from userdata_{$_COOKIE['userid']}_holder ORDER BY sendtime desc";
$query = mysql_query($sql,$conn);
$holder = <<< EOF
<tr>
  <th><i class="icon-pencil"></i> 件名</th>
  <th class="align-center minimize"><i class="icon-leaf"></i> ステータス</th>
  <th class="no-mobile minimize"><i class="icon-time"></i> 予約日時</th>
  <th class="no-mobile minimize"><i class="icon-download-alt"></i> 登録日時</th>
  <th></td>
</tr>
EOF;
while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
$regtime  = date("Y-m-d-H" ,$row['regtime']);
$sendtime = date("Y-m-d-H" ,$row['sendtime']);
if($row['status']=="draft"){
  $status = "<span class='typebutton draft block'><i class='icon-quote-right'></i> 下書き</span>";
}elseif($row['status']=="reserved"){
  $status = "<span class='typebutton reserved block'><i class='icon-star-empty'></i> 日時指定</span>";
}elseif($row['status']=="sent"){
  $status = "<span class='typebutton sent block'><i class='icon-signout'></i> 送信済み</span>";
}
$holder .= <<< EOF
<tr>
  <td><a href="/edit/{$row['code']}/">{$row['title']}</a></td>
  <td class="align-center">{$status}</td>
  <td class="no-mobile">{$sendtime}</td>
  <td class="no-mobile">{$regtime}</td>
  <td class="align-center"><a href="{$home_url}edit/{$row['code']}/" class="tips" data-powertip="編集"><i class="icon-edit"></i></a><a href="#" class="tips" data-powertip="削除" onClick="disp({$row['code']})"><i class="icon-trash"></i></a><a href="#" class="tips" data-powertip="テスト配信" onClick="test({$row['code']})"><i class="icon-play-sign"></i></a></td>
</tr>
EOF;
}

$sql="SELECT * from userdata_{$_COOKIE['userid']}_list ORDER BY code desc";
$query = mysql_query($sql,$conn);
$list = <<< EOF
<tr>
  <th><i class="icon-group"></i> ニックネーム</td>
  <th class="no-tablet no-mobile minimize"><i class="icon-calendar"></i> 誕生日</th>
  <th class="no-mobile exminimize align-center"><i class="icon-asterisk"></i> 年齢</th>
  <th class="no-mobile exminimize align-center"><i class="icon-male"></i> 性別</th>
  <th class="no-tablet no-mobile minimize"><i class="icon-suitcase"></i> 職業</th>
  <th class="no-tablet no-mobile minimize"><i class="icon-map-marker"></i> 住所</th>
  <th><i class="icon-envelope-alt"></i> メールアドレス</th>
  <th></th>
</tr>
EOF;
while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
if($row['sex']=="male"){
  $sex = "<i class='icon-male'></i> 男性";
}elseif($row['sex']=="female"){
  $sex = "<i class='icon-female'></i> 女性";
}
$birthday = date("Y/m/d" ,$row['age']);
$age = (int)((date("Ymd",time()) - date("Ymd",$row['age']))/10000);
$list .= <<< EOF
<tr>
  <td>{$row['nickname']}</div>
  <td class="no-tablet no-mobile">{$birthday}</div>
  <td class="no-mobile align-center">{$age}</div>
  <td class="no-mobile align-center">{$sex}</div>
  <td class="no-tablet no-mobile">{$row['job']}</div>
  <td class="no-tablet no-mobile">{$row['prefecture']}</div>
  <td>{$row['address']}</div>
  <td class="align-center"><a href="#" class="tips" data-powertip="削除" onClick="delmail({$row['code']})"><i class="icon-trash"></i></a></td>
</tr>
EOF;
}

?>