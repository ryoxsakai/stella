<?php

require_once 'connection.php';

function stella_countholder($id){
  global $conn;
  $count = 0;
  $sql="SELECT count(*) as count from userdata_{$id}_list";
  $query = mysql_query($sql,$conn);
  $row = @mysql_fetch_assoc($query);
  return $row["count"];
}

function stella_holdertype($id){
  global $conn;
  $num = 0;
  $sql="SELECT * from userdata_{$id}_list order by code desc";
  $query = @mysql_query($sql,$conn);
  while ($row = @mysql_fetch_array($query, MYSQL_BOTH)){
    $num++;
  }
  if($num<=250){
    $type['name'] = "beginners";
    $type['desc'] = "<i class='icon-heart'></i> ビギナーズ";
    $type['cost'] = 980;
  }elseif($num<=1000){
    $type['name'] = "standard";
    $type['desc'] = "<i class='icon-star'></i> スタンダード";
    $type['cost'] = 1980;
  }else{
    $type['name'] = "packet";
    $type['desc'] = "<i class='icon-trophy'></i> パケット";
    $type['cost'] = 2980;
  }
  return $type;
}

function stella_countlist($id){
  global $conn;
  $count = 0;
  $sql="SELECT count(*) as count from userdata_{$id}_list";
  $query = mysql_query($sql,$conn);
  $row = mysql_fetch_assoc($query);
  return $row["count"];
}

function stella_actionreport_insert($id,$action_type,$action_desc){
  global $conn;
  $time = time();
  $sql = "INSERT INTO stella_actionreport (userid,action_type,action_desc,action_time) VALUES ('{$id}','{$action_type}','{$action_desc}','{$time}')";
  $query = mysql_query($sql,$conn);
}

function stella_article_title($userid,$articleid){
  global $conn;
  $sql="SELECT * from userdata_{$userid}_holder where code = '{$articleid}' limit 1";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    $title = $row['title'];
  }
  return $title;
}

function stella_actionreport_list($userid, $action_type = "*"){
  global $conn;
  $sql="SELECT * from stella_actionreport where action_type = '{$action_type}' and userid = '{$_COOKIE['userid']}' ORDER BY code desc limit 10";
  $query = mysql_query($sql,$conn);
$list = <<< EOF
<tr>
  <th><i class="icon-asterisk"></i> 履歴</th>
  <th style="display:none"></th>
</tr>
EOF;
while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
$time = date('Y-m-d h:i',$row['action_time']);
$list .= <<< EOF
<tr>
  <td><strong>{$row['action_desc']}</strong><br/ ><small><i class="icon-time"></i> {$time}</small></td>
  <td style="display:none"></td>
</tr>
EOF;
}
return $list;
}

function stella_userbasic_search($element,$search,$value){
  global $conn;
  $sql="SELECT {$element} from stella_userbasic where {$search} = '{$value}'";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    $key = $row[$element];
  }
  return $key;
}

function stella_userbasic_list(){
  global $conn;
  $sql="SELECT * from stella_userbasic ORDER BY setuptime desc";
  $query = mysql_query($sql,$conn);
$holder = <<< EOF
<tr>
  <th><i class="icon-user"></i> ユーザーID</th>
  <th><i class="icon-envelope-alt"></i> メールアドレス</th>
  <th><i class="icon-credit-card"></i> カスタマーID</th>
  <th class="no-mobile"><i class="icon-time"></i> 登録日時</th>
</tr>
EOF;
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    $count = stella_countholder($row['userid']);
    if($count==''){
      $count = '0';
    }else{
      $type = stella_holdertype($row['userid']);
    }
$holder .= <<< EOF
<tr>
  <td><a href="/edit/{$row['code']}/">{$row['userid']} ({$count})</a></td>
  <td>{$row['mail']}</td>
  <td>{$row['customerid']}</td>
  <td class="no-mobile">{$row['setuptime']}</td>
</tr>
EOF;
  }
  return $holder;
}

function stella_userbasic_paymentplate(){
  global $conn;
  $sql="SELECT * from stella_userbasic where customerid != '' ORDER BY setuptime desc";
  $query = mysql_query($sql,$conn);
$holder = <<< EOF
<tr>
  <th><i class="icon-user"></i> ユーザーID</th>
  <th class="no-mobile"><i class="icon-credit-card"></i> カスタマーID</th>
  <th class="no-mobile"><i class="icon-group"></i> 読者数</th>
  <th><i class="icon-plane"></i> プラン</th>
  <th><i class="icon-yen"></i> 料金</th>
</tr>
EOF;
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
    $count = stella_countholder($row['userid']);
    $type  = stella_holdertype($row['userid']);
$holder .= <<< EOF
<tr>
  <td>{$row['userid']}</td>
  <td class="no-mobile">{$row['customerid']}</td>
  <td class="no-mobile">{$count}</td>
  <td><span class="typebutton {$type['name']}">{$type['desc']}</span></td>
  <td><input type="text" name="{$row['customerid']}" value="{$type['cost']}" style="width:40px" /></td>
</tr>
EOF;
  }
  return $holder;
}

?>