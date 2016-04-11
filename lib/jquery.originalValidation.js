/*RegForm Validation*/

$(function(){


    $("#parts_SIGNUP form").submit(function(){
        //エラーの初期化
        $("p.error").remove();
        $("dl dd").removeClass("error");
        
        $(":text,:password,textarea").filter(".validate").each(function(){
            
            //必須項目のチェック
            $(this).filter(".required").each(function(){
                if($(this).val()==""){
                    $(this).parent().prepend("<p class='error'><i class='icon-check'></i> 必須項目です</p>")
                }
            })
            
            //数値のチェック
            $(this).filter(".number").each(function(){
                if(isNaN($(this).val())){
                    $(this).parent().prepend("<p class='error'><i class='icon-check'></i> 数値のみ入力可能です</p>")
                }
            })
            
            //メールアドレスのチェック
            $(this).filter(".mail").each(function(){
                if($(this).val() && !$(this).val().match(/.+@.+\..+/g)){
                    $(this).parent().prepend("<p class='error'><i class='icon-check'></i> メールアドレスの形式が異なります</p>")
                }
            })
            
            //メールアドレス確認のチェック
            $(this).filter(".mail_check").each(function(){
                if($(this).val() && $(this).val()!=$("input[name="+$(this).attr("name").replace(/^(.+)_check$/, "$1")+"]").val()){
                    $(this).parent().prepend("<p class='error'><i class='icon-check'></i> 内容が異なります</p>")
                }
            })

            //userID文字数のチェック
            $(this).filter(".useridLength").each(function(){
                if($(this).val().length < 5){
                    $(this).parent().prepend("<p class='error'><i class='icon-check'></i> IDは5文字以上で設定してください</p>")
                }
                if($(this).val().length > 20){
                    $(this).parent().prepend("<p class='error'><i class='icon-check'></i> IDは20文字以内で設定してください</p>")
                }
            })

            //password文字数のチェック
            $(this).filter(".passLength").each(function(){
                if($(this).val().length < 5){
                    $(this).parent().prepend("<p class='error'><i class='icon-check'></i> パスワードの文字数が少なすぎます</p>")
                }
                if($(this).val().length > 20){
                    $(this).parent().prepend("<p class='error'><i class='icon-check'></i> パスワードは20文字以内で設定してください</p>")
                }
            })
            
        })
        
        //チェックボックスのチェック
        $(".checkboxRequired").each(function(){
            if($(":checkbox:checked").size()==0){
                $(this).parent().parent().prepend("<p class='error'><i class='icon-check'></i> 利用規約に同意しない場合、会員登録ができません</p>")
            }
        })
        
        //エラーの際の処理
        if($("p.error").size() > 0){
                $('html,body').animate({ scrollTop: $("p.error:first").offset().top-80 }, 'slow');
                return false;
        }
        
    });
		 	
});
