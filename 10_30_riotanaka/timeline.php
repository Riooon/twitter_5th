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

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM twitter_account JOIN tweet_content on twitter_account.id = tweet_content.id WHERE NOT username=:username ORDER BY tweet_num DESC");
$stmt ->bindvalue(":username",$session_username,PDO::PARAM_STR);
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
        // $embed_tweet .= "<a href='account.php?username=$result_username'><img src='img/profile_picture/$result_pic'></a>";
        $embed_tweet .= "</div>";
        $embed_tweet .= "<div class='text'>";
            $embed_tweet .= "<div class='info'>";
                $embed_tweet .= "<a href='account.php?username=$result_username'><h4>".$result["name"]."</h4></a>";
                $embed_tweet .= "　"."<p>@".$result["username"]."</p>";
            $embed_tweet .= "</div>";
            $embed_tweet .= "<a href='tweet_detail.php?tweet=$tweet_num'>";
            $embed_tweet .= "<div class='description'>";
            $embed_tweet .= $result['tweet'];
            $embed_tweet .= "</div>";
            $embed_tweet .= "</a>";
            $embed_tweet .= "<div class='reaction'>";
                $embed_tweet .= "<i class='far fa-comment'></i>";
                $embed_tweet .= "<i class='fas fa-retweet' name='$tweet_num'></i>";
                $embed_tweet .= "<i class='far fa-heart'></i>";
                $embed_tweet .= "<i class='fas fa-external-link-alt'></i>";
                $embed_tweet .= "<i class='far fa-chart-bar'></i>";
            $embed_tweet .= "</div>";
        $embed_tweet .= "</div>";
    $embed_tweet .= "</div>";
  }
}

// 画像の表示（登録しなかった場合に、デフォルトを取得）
if ($session_profile_picture==NULL){
    $show_pp = "default_icon.png";
}
else{
    $show_pp = $session_profile_picture;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/timeline.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <title>Document</title>
</head>
<body>

    <div class="left">
        <div class="icon"><i class="fab fa-twitter"></i></div>
        <ul class="list-entire">
            <li><i class="fas fa-home"></i>Home</li>
            <li><i class="fas fa-hashtag"></i>Explore</li>
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
                <h3>Explore</h3>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="top-tweet">
                <form method="post" action="tweet_on_explore.php">
                    <div class="top-middle">
                        <img src="img/profile_picture/<?= $show_pp ?>">
                        <textarea id="text_tweeting" name="tweet" cols="30" rows="7" placeholder="What's happening?"></textarea>
                    </div>
                    <div class="top-bottom">
                        <div class="logo">
                            <i class="far fa-image"></i>
                            <i class="fab fa-github"></i>
                            <i class="fas fa-poll"></i>
                            <i class="far fa-smile"></i>
                            <i class="fas fa-business-time"></i>
                        </div>
                        <div class="cnt_area"><span class="now_count">0</span> / 140</div>
                        <input type="hidden" name="id" value='<?= $session_id ?>'>
                        <input type="hidden" name="username" value='<?= $session_username ?>'>
                        <input id="tweet-submitted" type="submit" value="Tweet">
                    </div>
                </form>
            </div>
        </div>
       
            <!-- DBから受け取ったツイートの表示 -->
            <?= $embed_tweet ?>
        <div class="popup">
            <div class="popup-form">
                <form method="post" action="tweet_on_explore.php">
                    <div class="popup-top">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="popup-middle">
                        <img src="img/profile_picture/<?= $show_pp ?>">
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

</body>
</html>