<?php

  require_once 'lib/function.php';
  require_once 'lib/webpay.php';
  
  //当月の課金処理をしていない場合
  if(!file_exists('lib/charge/'.date('Y-m-').'charge.txt')){
    if($_POST['flag']=="check"){
      foreach($_POST as $key => $value){
        if(substr($key,0,3)=="cus"){
          if($value!=0){
            $data['amount']   = $value;
            $data['customer'] = $key;
            $data['description'] = '[stella] '.$key.' : '.date('n').'月分の課金として'.$value.'円を課金しました';
            WebPayCustomerCharge($data);
            //---cusからuseridを検索---
            $userid = stella_userbasic_search('userid','moneykey',$key);
            //---actionreportの作成---
            stella_actionreport_insert($userid,'make_charge',date('n').'月分の課金として'.$value.'円を課金しました');
          }
        }
      }
      //課金ファイルを作成
      $fp = fopen('lib/charge/'.date('Y-m-').'charge.txt', "w");
      @fwrite($fp, 'done', strlen('done'));
      fclose($fp);
      
      $info = "課金処理を完了しました";
      
$body = <<< EOF
      <p>今月の課金処理は終了しています</p>
EOF;

    }else{
      $info = "課金処理を行います";
      $plate = stella_userbasic_paymentplate();
$body = <<< EOF
      <form method="post">
        <table class="multitable">{$plate}</table>
        <div class="design"><input type="submit" value="確定" /></div>
        <input type="hidden" name="flag" value="check" />
      </form>
EOF;
    }
  }else{
    $info = "今月の課金処理は終了しました";
$body = <<< EOF
      <p>今月の課金処理は終了しています</p>
EOF;
  }

?>