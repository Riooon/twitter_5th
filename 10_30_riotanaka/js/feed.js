
// ポップアップの表示ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
$(".tweet").on("click", function(){
    $(".popup").fadeIn();
});

$(".popup-top i").on("click", function(){
    $(".popup").fadeOut();
});

// 設定の表示ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
$(".settings-action").on("click", function(){
    $(".settings").css("display", "block");
});
$(".settings-end").on("click", function(){
    $(".settings").css("display", "none");
});


// ツイートの文字数カウントーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
$("#tweeting").on('input', function(){
    //文字数を取得
    var cnt = $(this).val().length;
    //現在の文字数を表示
    $('.now_cnt').text(cnt);
    if(cnt > 0 && 140 > cnt){
        //1文字以上かつ140文字以内の場合はボタンを有効化＆黒字
        $('#submit-tweet').prop('disabled', false);
        $("#submit-tweet").removeClass("btn-disabled");
        $(".now_cnt").removeClass("text_over");

    }else{
        //0文字または140文字を超える場合はボタンを無効化＆赤字
        $('#submit-tweet').prop('disabled', true);
        $("#submit-tweet").addClass("btn-disabled");
        $(".now_cnt").addClass("text_over");
    }
});

// timeline.php でツイート画面が2つあるため、2つ目を用意
$("#text_tweeting").on('input', function(){
    var cnt = $(this).val().length;
    $('.now_count').text(cnt);
    if(cnt > 0 && 140 > cnt){
        $('#tweet-submitted').prop('disabled', false);
        $("#tweet-submitted").removeClass("btn-disabled");
        $(".now_count").removeClass("text_over");

    }else{
        $('#tweet-submitted').prop('disabled', true);
        $("#tweet-submitted").addClass("btn-disabled");
        $(".now_count").addClass("text_over");
    }
});

// リツイートした人を表示 (tweet_detail.php)ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$("#show_retweeter").on("click", function(){
    $(".retweet_popup").fadeIn();
});
$(".retweeted_by i").on("click", function(){
    $(".retweet_popup").fadeOut();
});

// リツイートした人を表示 (tweet_detail.php)ーーーーーーーーーーーーーーーーーーーーーーーーーーー

$("#show_liker").on("click", function(){
    $(".like_popup").fadeIn();
});
$(".liked_by i").on("click", function(){
    $(".like_popup").fadeOut();
});