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

$username = $_GET["username"];

require "function.php";
$pdo = db_connect();
login_check_by_ssid();

// アカウント情報を取得ーーーーーーーーーーーーーーーー

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM twitter_account WHERE username=:username");
$stmt ->bindvalue(":username",$username,PDO::PARAM_STR);
$status = $stmt->execute();

//結果をfetch()
if ($status == false) { 
    //SQLエラー関数
    sql_error($stmt);
  }else{
    $view = $stmt->fetch();
}

// 画像の表示（登録しなかった場合に、デフォルトを取得） ーーーー
if ($view["profile_picture"]==NULL){
    $show_pp = "default_icon.png";
}
else{
    $show_pp = $view["profile_picture"];
}

if ($view["background_image"]==NULL){
    $show_bg = "default_bg.jpg";
}
else{
    $show_bg = $view["background_image"];
}

// ツイート内容をを取得ーーーーーーーーーーーーーーーー

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM tweet_content JOIN twitter_account on twitter_account.id=tweet_content.id WHERE posted_by=:posted_by ORDER BY tweet_num DESC");
$stmt ->bindvalue(":posted_by",$view["id"],PDO::PARAM_INT);
$status = $stmt->execute();

// .3データ表示内while分中で表示させる際、""が3つ重なってしまう（誤作動）のため、変数に格納
$profile_image_id = $view["profile_picture"];

//３．データ表示
$view_tweet="";
$tweet_array=array();
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    array_push($tweet_array, $result["username"]);
    $tweet_num=$result["tweet_num"];
    $tweet_img = $result["profile_picture"];
    $result_username = $result["username"];

    $embed_tweet .= "<div class='tweet-card'>";
        $embed_tweet .= "<div class='picture'>";
        if ($tweet_img==NULL){
            $embed_tweet .= "<a href='account.php?username=$result_username'><img src='img/profile_picture/default_icon.png'></a>";
        }
        else{ //NULLじゃない時は登録データを表示
            $embed_tweet .= "<a href='account.php?username=$result_username'><img src='img/profile_picture/$tweet_img'></a>";
        }
        $embed_tweet .= "</div>";
        $embed_tweet .= "<div class='text'>";
                $embed_tweet .= "<div class='info'>";
                    $embed_tweet .= "<a href='account.php?username=$result_username'><h4>".$result["name"]."</h4></a>";
                    $embed_tweet .= "<p>　@".$result["username"]."</p>";
                $embed_tweet .= "</div>";
                $embed_tweet .= "<a href='tweet_detail.php?tweet=$tweet_num'>";
                $embed_tweet .= "<div class='description'>";
                $embed_tweet .= $result['tweet'];
                $embed_tweet .= "</div>";
                $embed_tweet .= "</a>";
            $embed_tweet .= "<div class='reaction'>";
                $embed_tweet .= "<i class='far fa-comment'></i>";
                $embed_tweet .= "<i class='fas fa-retweet' name='$tweet_num'></i>";
                $embed_tweet .= "<i class='far fa-heart' name='$tweet_num'></i>";
                $embed_tweet .= "<i class='fas fa-external-link-alt'></i>";
                $embed_tweet .= "<i class='far fa-chart-bar'></i>";
            $embed_tweet .= "</div>";
        $embed_tweet .= "</div>";
    $embed_tweet .= "</div>";
  }
}

// ツイート数を表示
$no_of_tweets = count($tweet_array);

// フォロー数を取得ーーーーーーーーーーーーーーーー

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM follow_list WHERE followed_by=:id");
$stmt ->bindvalue(":id",$view["id"],PDO::PARAM_INT);
$status = $stmt->execute();
$following = $stmt->rowcount();


// // フォロワー数を取得ーーーーーーーーーーーーーーーー

// //２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM follow_list WHERE is_followed=:id");
$stmt ->bindvalue(":id",$view["id"],PDO::PARAM_INT);
$status = $stmt->execute();
$followers = $stmt->rowcount();


// 自分のID情報を取得ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
// （セッションで取得した値を json_encodeしても値が取得できない？のでデータベースから探して取得）

$stmt = $pdo->prepare("SELECT * FROM twitter_account WHERE id=:id");
$stmt ->bindvalue(":id",$session_id,PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) { 
    sql_error($stmt);
  }else{
    $view_id = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/profile.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
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
            <a href="profile.php?username=<?= $session_username ?>"><li><i class="fas fa-user-alt"></i>Profile</li></a>
            <li class="settings-action"><i class="fas fa-sliders-h"></i>Settings</li> 
        </ul>

        <div class="tweet">
            <a href="#">Tweet</a>
        </div>
    </div>

    <div class="center">
        <div class="center-fixed">
            <div class="arrow">
                <a href="javascript:history.back()"><i class="fas fa-arrow-left"></i></a>
            </div>
            <div class="names">
                <h4><?= $view["name"]?></h4>
                <p><?= $no_of_tweets ?> tweets</p>
            </div>
        </div>
        <div class="center-profile">
            <div class="center-background">
                <img src="img/background_image/<?= $show_bg ?>">
            </div>
            <div class="center-pic">
                <img src="img/profile_picture/<?= $show_pp ?>">
                <form action="follow.php" method="post">
                    <input type="hidden" name="is_followed" value='<?= $view["id"] ?>'>
                    <input type="hidden" name="followed_by" value='<?= $session_id ?>'>
                    <input type="submit" value="Follow" id="follow_btn">
                </form>
            </div>
            <div class="profile-box">
                <div class="profile-name">
                    <h3><?= $view["name"] ?></h3>
                    <p>@<?= $view["username"] ?></p>
                </div>
                <div class="profile-tagline">
                    <p><?= $view["bio"]?></p>
                </div>
                <div class="profile-info">
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i>Tokyo-to, Japan</li>
                        <li><i class="fas fa-link"></i>link.co.jp</li>
                        <li><i class="fas fa-golf-ball"></i>Date of Birth</li>
                        <li><i class="far fa-calendar-alt"></i>The moment you joined</li>
                    </ul>
                </div>
                <div class="profile-follows">
                    <a href="following.php?username=<?= $view["username"] ?>"><h4><span><?= $following ?></span> following</h4></a>
                    <a href="follower.php?username=<?= $view["username"] ?>"><h4><span><?=  $followers ?></span> followers</h4></a>
                </div>
            </div>
            
            <div class="tweet-list">
                <ul>
                    <li>Tweets</li>
                    <li>Tweets & replies</li>
                    <li>Media</li>
                    <li>Likes</li>
                </ul>
            </div>

            <!-- DBから受け取ったツイートの表示 -->
            <?= $embed_tweet ?>
        </div>

            <div></div>


        <div class="popup">
            <div class="popup-form">
                <form method="post" action="tweet.php">
                    <div class="popup-top">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="popup-middle">
                        <img src="img/profile_picture/<?= $show_pp ?>">
                        <textarea name="tweet" id="tweeting" cols="30" rows="7" placeholder="What's happening?"></textarea>
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
                        <input type="hidden" name="username" value='<?= $session_username ?>'>
                        <input type="submit" value="Tweet" id="submit-tweet">
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
$(".fa-retweet").on("click", function(){
    const tweet_num = $(this).attr('name');
    console.log(tweet_num);

    $.ajax({
        type: "POST",
        url: "retweet.php",
        data: {
            tweeted_by: <?= json_encode($view["id"]) ?>,
            tweet_num: tweet_num,
            retweeted_by: <?= json_encode($view_id["id"]) ?>,
        },
        dataType: "html",
        success: function(data){
            if(data=="false"){
                alert("ERROR");
            }else{
                $(".fa-retweet[name="+tweet_num+"]").addClass("retweeted");
            }
        }
    });
});

$(".fa-heart").on("click", function(){
    const tweet_num = $(this).attr('name');
    console.log(tweet_num);

    $.ajax({
        type: "POST",
        url: "like.php",
        data: {
            tweeted_by: <?= json_encode($view["id"]) ?>,
            tweet_num: tweet_num,
            liked_by: <?= json_encode($view_id["id"]) ?>,
        },
        dataType: "html",
        success: function(data){
            if(data=="false"){
                alert("ERROR");
            }else{
                $(".fa-heart[name="+tweet_num+"]").addClass("liked");
            }
        }
    });
});
</script>
</body>
</html>