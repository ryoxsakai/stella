<?php

function stella_countholder($id){
  global $conn;
  $count = 0;
  $sql="SELECT count(*) as count from userdata_{$id}_holder";
  $query = mysql_query($sql,$conn);
  $row = mysql_fetch_assoc($query);
  return $row["count"];
}

function stella_holdertype($id){
  global $conn;
  $num = 0;
  $sql="SELECT * from userdata_{$id}_list order by code desc";
  $query = mysql_query($sql,$conn);
  while ($row = mysql_fetch_array($query, MYSQL_BOTH)){
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

function stella_userbasic_search($element,$search,$value){
  global $conn;
  $sql="SELECT {$element} from stella_userbasic where {$search} = '{$value}'";
  $query = mysql_query($sql,$conn);
  while ($row = @mysql_fetch_array($query, MYSQL_BOTH)){
    $key = $row[$element];
  }
  return $key;
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

?>