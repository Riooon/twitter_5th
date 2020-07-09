<?php
session_start();

$session_id = $_SESSION["id"];
$session_email = $_SESSION["email"];
$session_password = $_SESSION["password"];
$session_username = $_SESSION["username"];
$session_name = $_SESSION["name"];
$session_bio = $_SESSION["bio"];
$session_profile_picture = $_SESSION["profile_picture"];
$session_background_image = $_SESSION["background_image"];

require "function.php";
$pdo = db_connect();
login_check_by_ssid();

$tweet_num = $_GET["tweet"];

// 「誰がリツイートしたか」というデータを取得ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$stmt = $pdo->prepare("SELECT * FROM twitter_account JOIN retweet_list on twitter_account.id = retweet_list.retweeted_by WHERE tweet_num=:tweet_num ORDER BY retweet_id DESC");
$stmt->bindValue(':tweet_num', $tweet_num,PDO::PARAM_INT);
$status = $stmt->execute();

// フォローしているアカウントを配列にIN!
$retweet_accounts=array();

if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    array_push($retweet_accounts,$result["retweeted_by"]);
  }
}


//　リツイートした人をポップアップ表示ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$account_info="";

for($i=0;$i<count($retweet_accounts);$i++){
$stmt = $pdo->prepare("SELECT * FROM twitter_account WHERE id=:id");
$stmt ->bindvalue(":id",$retweet_accounts[$i],PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 

    $picture_id = $result["profile_picture"];
    $user_name = $result["username"];

    $account_info.="<div class='account_card'>";
    if ($picture_id==NULL){
        $account_info .= "<a href='account.php?username=$user_name'><img src='img/profile_picture/default_icon.png'></a>";
    }
    else{ //NULLじゃない時は登録データを表示
        $account_info .= "<a href='account.php?username=$user_name'><img src='img/profile_picture/$picture_id'></a>";
    }
        $account_info.="<div class='info'>";
            $account_info.="<div class='top'>";
                $account_info.="<div class='names'>";
                    $account_info.="<a href='account.php?username=$user_name'><h4>".$result["name"]."</h4></a>";
                    $account_info.="<p> @".$result["username"]."</p>";
                $account_info.="</div>";
            $account_info.="</div>";
            $account_info.="<div class='bottom'>";
            $account_info.="<p>".$result["bio"]."</p>";
            $account_info.="</div>";
        $account_info.="</div>";
    $account_info.="</div>";
    
}
}
}


// 「誰がいいねしたか」というデータを取得ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$stmt = $pdo->prepare("SELECT * FROM twitter_account JOIN like_list on twitter_account.id = like_list.liked_by WHERE tweet_num=:tweet_num ORDER BY like_id DESC");
$stmt->bindValue(':tweet_num', $tweet_num,PDO::PARAM_INT);
$status = $stmt->execute();

// フォローしているアカウントを配列にIN!
$like_accounts=array();

if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    array_push($like_accounts,$result["liked_by"]);
  }
}

//　いいねした人をポップアップ表示ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$like_list="";

for($i=0;$i<count($like_accounts);$i++){
$stmt = $pdo->prepare("SELECT * FROM twitter_account WHERE id=:id");
$stmt ->bindvalue(":id",$like_accounts[$i],PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){

    $picture_id = $result["profile_picture"];
    $user_name = $result["username"];

    $like_list.="<div class='account_card'>";
    if ($picture_id==NULL){
        $like_list .= "<a href='account.php?username=$user_name'><img src='img/profile_picture/default_icon.png'></a>";
    }
    else{ //NULLじゃない時は登録データを表示
        $like_list .= "<a href='account.php?username=$user_name'><img src='img/profile_picture/$picture_id'></a>";
    }
        $like_list.="<div class='info'>";
            $like_list.="<div class='top'>";
                $like_list.="<div class='names'>";
                    $like_list.="<a href='account.php?username=$user_name'><h4>".$result["name"]."</h4></a>";
                    $like_list.="<p> @".$result["username"]."</p>";
                $like_list.="</div>";
            $like_list.="</div>";
            $like_list.="<div class='bottom'>";
            $like_list.="<p>".$result["bio"]."</p>";
            $like_list.="</div>";
        $like_list.="</div>";
    $like_list.="</div>";
    
}
}
}


//　ツイートを取得して表示ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$stmt = $pdo->prepare("SELECT * FROM twitter_account JOIN tweet_content on twitter_account.id = tweet_content.id WHERE tweet_num=:tweet_num ORDER BY tweet_num DESC");
$stmt ->bindvalue(":tweet_num",$tweet_num,PDO::PARAM_INT);
$status = $stmt->execute();

$embed_tweet='';
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    // クォーテーションの3つにつき、変数の中にIN!
    $tweet_num=$result["tweet_num"];
    $result_pic = $result["profile_picture"];
    $result_username = $result["username"];

    $embed_tweet .= "<div class='tweet-card'>";
        $embed_tweet .= "<div class='picture'>";
        if ($result_pic==NULL){
            $embed_tweet .= "<a href='account.php?username=$result_username'><img src='img/profile_picture/default_icon.png'></a>";
        }
        else{ //NULLじゃない時は登録データを表示
            $embed_tweet .= "<a href='account.php?username=$result_username'><img src='img/profile_picture/$result_pic'></a>";
        }
        $embed_tweet .= "</div>";
        $embed_tweet .= "<div class='text'>";
            $embed_tweet .= "<div class='info'>";
                $embed_tweet .= "<a href='account.php?username=$result_username'><h4>".$result["name"]."</h4></a>";
                $embed_tweet .= "　"."<p>@".$result["username"]."</p>";
            $embed_tweet .= "</div>";
            $embed_tweet .= "<div class='description'>";
            $embed_tweet .= $result['tweet'];
            $embed_tweet .= "</div>";
            $embed_tweet .= "<div class='tweet_result'>";
            $embed_tweet .= "<p id='show_retweeter'><span id='retweet_count'>".count($retweet_accounts)."</span> <span class='texts'>Retweets</span></p>";
            $embed_tweet .= "<p id='show_liker'><span id='like_count'>".count($like_accounts)."</span> <span class='texts'>Likes</span></p>";
            $embed_tweet .= "</div>";
            $embed_tweet .= "<div class='reaction'>";
                $embed_tweet .= "<i class='far fa-comment'></i>";
                $embed_tweet .= "<i class='fas fa-retweet' name='$tweet_num'></i>";
                $embed_tweet .= "<i class='far fa-heart'></i>";
                $embed_tweet .= "<i class='fas fa-external-link-alt'></i>";
            $embed_tweet .= "</div>";
        $embed_tweet .= "</div>";
    $embed_tweet .= "</div>";
  }
}

// ajax のデータ送信用にアカウント情報を取得ーーーーーーーーーーーーーーーー

$stmt = $pdo->prepare("SELECT * FROM tweet_content WHERE tweet_num=:tweet_num");
$stmt ->bindvalue(":tweet_num",$tweet_num,PDO::PARAM_INT);
$status = $stmt->execute();

//結果をfetch()
if ($status == false) { 
    //SQLエラー関数
    sql_error($stmt);
  }else{
    $view = $stmt->fetch();
}

$stmt = $pdo->prepare("SELECT * FROM twitter_account WHERE id=:id");
$stmt ->bindvalue(":id",$session_id,PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) { 
    sql_error($stmt);
  }else{
    $view_id = $stmt->fetch();
}

// 画像の表示（登録しなかった場合に、デフォルトを取得） ーーーーーーーーー
if($session_profile_picture==NULL){
    $show_pp = "dafault_icon.png";
}else {
    $show_pp = $session_profile_picture;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/tweet_detail.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <title>Document</title>
</head>
<body>

    <div class="left">
        <div class="icon"><i class="fab fa-twitter"></i></div>
        <ul class="list-entire">
            <li><i class="fas fa-home"></i>Home</li>
            <a href="timeline.php"><li><i class="fas fa-hashtag"></i>Explore</li></a>
            <li><i class="far fa-bell"></i>Notifications</li>
            <li><i class="far fa-envelope"></i>Messages</li>
            <li><i class="far fa-bookmark"></i>Bookmarks</li>
            <li><i class="far fa-list-alt"></i>Lists</li>
            <a href='profile.php?username=<?= $session_username?>'><li><i class="fas fa-user-alt"></i>Profile</li></a>
            <li class="settings-action"><i class="fas fa-sliders-h"></i>Settings</li>
        </ul>

        <div class="tweet">
            <a href="#">Tweet</a>
        </div>
    </div>

    <div class="center">
        <div class="center-top">
            <div class="title">
                <h4 class="arrow"><a href="javascript:history.back()"><i class="fas fa-arrow-left"></i></a></h4>
                <h3>Tweet</h3>
            </div>
        </div>
       
        <!-- DBから受け取ったツイートの表示 -->
        <?= $embed_tweet ?>

        <!-- ポップアップでリツイートした人を表示 -->
        <div class="retweet_popup">
            <div class="retweeted_by">
                <div class="popup-top">
                        <i class="fas fa-times"></i>
                        <h3>Retweeeted By</h3>
                </div>
                <div class="popup-below">
                    <!-- ここにリツイートした人を表示 -->
                    <?= $account_info ?>
                </div>
            </div>
        </div>
        <div class="like_popup">
            <div class="liked_by">
                <div class="popup-top">
                    <i class="fas fa-times"></i>
                    <h3>Liked By</h3>
                </div>
                <div class="popup-below">
                    <!-- ここにいいねした人を表示 -->
                    <?= $like_list ?>
                </div>
            </div>
        </div>

        <div class="popup">
            <div class="popup-form">
                <form method="post" action="tweet_on_explore.php">
                    <div class="popup-top">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="popup-middle">
                        <img src="img/profile_picture/<?= $session_profile_picture ?>">
                        <textarea id="tweeting" name="tweet" cols="30" rows="7" placeholder="What's happening?"></textarea>
                    </div>
                    <div class="popup-bottom">
                        <div class="logo">
                            <i class="far fa-image"></i>
                            <i class="fab fa-github"></i>
                            <i class="fas fa-poll"></i>
                            <i class="far fa-smile"></i>
                            <i class="fas fa-business-time"></i>
                        </div>
                        <div class="cnt_area"><span class="now_cnt">0</span> / 140</div>
                        <input type="hidden" name="id" value='<?= $session_id ?>'>
                        <input id="submit-tweet" type="submit" value="Tweet">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="right">
         <div class="settings">
             <div class="title">
                <i class="fas fa-times settings-end"></i>
                <p>Settings</p>
             </div>

            <form method="POST" action="update.php" enctype="multipart/form-data">
                <details>
                    <summary>Email</summary>
                    <input type="text" name="email" value="<?= $session_email ?>">
                </details>
                <details>
                    <summary>Password</summary>
                    <input type="password" name="password" value="<?= $session_password ?>">
                </details>
                <details>
                    <summary>Name</summary>
                    <input type="text" name="name" value="<?= $session_name ?>">
                </details>
                <details>
                    <summary>Username</summary>
                    <input type="text" name="username" value="<?= $session_username ?>">
                </details>
                <details>
                    <summary>Bio</summary>
                    <textarea class="bio" name="bio" cols="32" rows="2"><?= $session_bio ?></textarea>
                </details>
                <details>
                    <summary>Profile Picture</summary>
                    <input type="file" name="profile_picture" accept="image/*">
                </details>
                <details>
                    <summary>Background Image</summary>
                    <input type="file" name="background_image" accept="image/*">
                </details>
                <input type="hidden" name="id" value="<?= $session_id ?>">
                <input type="submit" value="Update" class="submit">
            </form>
            <ul>
                <li><a class="logout" href="logout.php">Log out</a></li>
                <li><a class="deactivate" href="deactivate.php?id=<?= $session_id ?>">Deactivate</a></li>
            </ul>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/feed.js"></script>
<script>
let no_of_retweet = <?= json_encode(count($retweet_accounts))?>;
let no_of_like = <?= json_encode(count($like_accounts))?>;

$(".fa-retweet").one("click", function(){
    $.ajax({
        type: "POST",
        url: "retweet.php",
        data: {
            tweeted_by: <?= json_encode($view["id"]) ?>,
            tweet_num: <?= json_encode($tweet_num) ?>,
            retweeted_by: <?= json_encode($view_id["id"]) ?>,
        },
        dataType: "html",
        success: function(data){
            if(data=="false"){
                alert("ERROR");
            }else{
                $(".fa-retweet").addClass("retweeted");
                no_of_retweet++;
                $("#retweet_count").html(no_of_retweet);
            }
        }
    });
});

$(".fa-heart").one("click", function(){
    $.ajax({
        type: "POST",
        url: "like.php",
        data: {
            tweeted_by: <?= json_encode($view["id"]) ?>,
            tweet_num: <?= json_encode($tweet_num) ?>,
            liked_by: <?= json_encode($view_id["id"]) ?>,
        },
        dataType: "html",
        success: function(data){
            if(data=="false"){
                alert("ERROR");
            }else{
                $(".fa-heart").addClass("liked");
                no_of_like++;
                $("#like_count").html(no_of_like);
            }
        }
    });
});

</script>
</body>
</html>