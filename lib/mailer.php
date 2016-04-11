<?php

//★RECHECK_MAILER()/////////////////////////////////////////////////

function RECHECK_MAILER($action,$specialmode = 'normal'){
  //言語設定、内部エンコーディングを指定する
  mb_language("japanese");
  mb_internal_encoding("UTF-8");
  
  //スペシャルモード設定
  if($specialmode == 'normal'){
    $userpage = 'https://users.stella-mail.com/';
    $userspecial = '';
  }elseif($specialmode == 'free'){
    $userpage = 'http://free.stella-mail.com/';
    $userspecial = '※ 今回、無料プランへの特別ご招待を実施しています。';
  }elseif($specialmode == 'transfer'){
    $userpage = 'http://transfer.stella-mail.com/';
    $userspecial = '※ 今回、振込プランへの特別ご招待を実施しています。';
  }

  //メール部分
  $to = $action['mail'];
  $subject = "【Stella -ステラ-】お申込完了メール";
  $date = date('m月d日 H:i');
  $body = <<< END
■-------------------------------------------------------------------
│ 業界新登場の高機能メルマガスタンド「stella -ステラ-」
| http://stella-mail.com/
■-------------------------------------------------------------------

【お申込完了メール】

{$date}

ユーザー登録が完了しましたのでお知らせ致します。

確認のため、ご入力された内容の一部を記載しておりますので
再度ご確認をお願いいたします。

＜メールアドレス＞
　{$action['mail']}

＜ユーザーID＞
　{$action['userid']}

＜パスワード＞
　{$action['password']}


{$userspecial}


ユーザー専用ページにログインすることで
メルマガの設定や発行が可能になります！

＜ユーザー専用ページ＞
　{$userpage}



あなた専用の読者登録ページはこちらです。

＜読者登録ページ＞
　http://entry.stella-mail.com/{$action['userid']}/
　(設定が完了するまではアクセスできません)



以上で、メルマガ配信の準備は整いました。
twitterやfacebook、ホームページなどのメディアに
登録ページのアドレスを貼り付けて、読者を増やしましょう！
　


万一登録情報に誤りがある場合は、下記のアドレスまでお知らせください。

hello@stella-mail.com

今後とも、よろしくお願い致します。

■-------------------------------------------------------------------
│このメールには返信できません。
■-------------------------------------------------------------------

END;

  $from = mb_encode_mimeheader(mb_convert_encoding("stella(ステラ) 事務局","UTF8")).'<noreply@stella-mail.com>';

  mb_send_mail($to,$subject,$body,"From:".$from);
}

//☆/////////////////////////////////////////////////////////////////

//★INQUIRY_MAILER()/////////////////////////////////////////////////

function INQUIRY_MAILER($action, $specialmode = 'normal'){
  //言語設定、内部エンコーディングを指定する
  mb_language("japanese");
  mb_internal_encoding("UTF-8");
  
  //スペシャルモード設定
  if($specialmode == 'normal'){
    $userpage = 'https://users.stella-mail.com/';
    $userspecial = '';
  }elseif($specialmode == 'free'){
    $userpage = 'http://free.stella-mail.com/';
    $userspecial = '※ 今回、無料プランへの特別ご招待を実施しています。';
  }elseif($specialmode == 'transfer'){
    $userpage = 'http://transfer.stella-mail.com/';
    $userspecial = '※ 今回、振込プランへの特別ご招待を実施しています。';
  }

  //メール部分
  $to = 'ryoxsakai@gmail.com';
  $subject = "【Stella -ステラ-】お申込完了メール";
  $date = date('m月d日 H:i');
  $body = <<< END
■-------------------------------------------------------------------
│ 業界新登場の高機能メルマガスタンド「stella -ステラ-」
| http://stella-mail.com/
■-------------------------------------------------------------------

【お申込完了メール】

{$date}

ユーザー登録が完了しましたのでお知らせ致します。

確認のため、ご入力された内容の一部を記載しておりますので
再度ご確認をお願いいたします。

＜メールアドレス＞
　{$action['mail']}

＜ユーザーID＞
　{$action['userid']}

＜パスワード＞
　{$action['password']}


{$userspecial}


ユーザー専用ページにログインすることで
メルマガの設定や発行が可能になります！

＜ユーザー専用ページ＞
　{$userpage}



あなた専用の読者登録ページはこちらです。

＜読者登録ページ＞
　http://entry.stella-mail.com/{$action['userid']}/
　(設定が完了するまではアクセスできません)



以上で、メルマガ配信の準備は整いました。
twitterやfacebook、ホームページなどのメディアに
登録ページのアドレスを貼り付けて、読者を増やしましょう！
　


万一登録情報に誤りがある場合は、下記のアドレスまでお知らせください。

hello@stella-mail.com

今後とも、よろしくお願い致します。

■-------------------------------------------------------------------
│このメールには返信できません。
■-------------------------------------------------------------------

END;

  $from = mb_encode_mimeheader(mb_convert_encoding("stella(ステラ) 事務局","UTF8")).'<noreply@stella-mail.com>';

  mb_send_mail($to,$subject,$body,"From:".$from);
}

//☆/////////////////////////////////////////////////////////////////

?>