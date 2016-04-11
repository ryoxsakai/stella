<?php

function stella_countholder($id){
  global $conn;
  $count = 0;
  $sql="SELECT count(*) from userdata_{$id}_holder";
  $query = mysql_query($sql,$conn);
  $count = mysql_num_rows($query);
  return $count;
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
    $type['desc'] = "<i class='icon-heart'></i> ({$num}) ビギナーズ";
    $type['cost'] = 980;
  }elseif($num<=1000){
    $type['name'] = "standard";
    $type['desc'] = "<i class='icon-star'></i> ({$num}) スタンダード";
    $type['cost'] = 1980;
  }else{
    $type['name'] = "packet";
    $type['desc'] = "<i class='icon-trophy'></i> ({$num}) パケット";
    $type['cost'] = 2980;
  }
  return $type;
}

function stella_countlist($id){
  global $conn;
  $count = 0;
  $sql="SELECT count(*) from userdata_{$id}_list";
  $query = mysql_query($sql,$conn);
  $count = mysql_num_rows($query);
  return $count;
}

?>