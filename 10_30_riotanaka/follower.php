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

// 「どのアカウントをフォローしているか」というデータを取得ーーーーーーーーーーーーーーーー

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM twitter_account JOIN follow_list on twitter_account.id = follow_list.is_followed WHERE username=:username ORDER BY follow_id DESC");
$stmt->bindValue(':username', $username,PDO::PARAM_STR);
$status = $stmt->execute();

// フォローしているアカウントを配列にIN!
$following_accounts=array();

if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    array_push($following_accounts,$result["followed_by"]);
  }
}


// 配列に入れたデータ一つ一つのアカウント情報を取得 > それをループで回して全フォロー中アカウントの情報を取得

// そのアカウントのアカウント情報を取得ーーーーーーーーーーーーーーーーーーーーーーーーー
$account_info="";

for($i=0;$i<count($following_accounts);$i++){
//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM twitter_account WHERE id=:id");
$stmt->bindValue(':id', $following_accounts[$i],PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
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
                    $account_info.="<p>".$result["username"]."</p>";
                $account_info.="</div>";
                $account_info.="<form action=''>";
                    $account_info.="<input class='follow' type='submit' value='Following'>";
                $account_info.="</form>";
            $account_info.="</div>";
            $account_info.="<div class='bottom'>";
            $account_info.="<p>".$result["bio"]."</p>";
            $account_info.="</div>";
        $account_info.="</div>";
    $account_info.="</div>";
    
}
}
}

// 選択したアカウントの名前を表示させたいためのデータ取得
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

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/follow_pages.css">
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
            <div class="arrow">
                <a href="profile.php?username=<?= $session_username ?>"><i class="fas fa-arrow-left"></i>
            </div>
            <div class="names">
                <h4><?= $view["name"] ?></h4>
                <p>@ <?= $view["username"] ?></p>
            </div>
        </div>
        <div class="follows">
            <a href="following.php?username=<?= $view["username"] ?>" class="off">Following</a>
            <a href="#" class="on">Followers</a>
        </div>

        <?= $account_info ?>

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
                        <input type="hidden" name="username" value='<?= $session_username ?>'>
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