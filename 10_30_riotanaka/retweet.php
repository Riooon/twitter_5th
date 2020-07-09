<?php
session_start();

$tweet_num = $_POST["tweet_num"];
$tweeted_by = $_POST["tweeted_by"];
$retweeted_by = $_POST["retweeted_by"];

require"function.php";
$pdo = db_connect();
login_check_by_ssid();

$stmt = $pdo->prepare("INSERT INTO tweet_content(id,tweet,posted_by)
                        SELECT id, tweet, :retweeted_by
                        FROM tweet_content
                        WHERE tweet_num=:tweet_num");
$stmt ->bindvalue(":tweet_num",$tweet_num,PDO::PARAM_INT);
$stmt ->bindvalue(":retweeted_by",$retweeted_by,PDO::PARAM_INT);
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMassage:".$error[2]);
}

// データ登録 & 重複いいねの防止ーーーーーーーーーーーーーーーーーーーー

$stmt = $pdo->prepare("SELECT * FROM retweet_list WHERE tweet_num=:tweet_num AND tweeted_by=:tweeted_by AND retweeted_by=:retweeted_by");
$stmt->bindValue(':tweet_num', $tweet_num, PDO::PARAM_INT);
$stmt->bindValue(':tweeted_by', $tweeted_by, PDO::PARAM_INT);
$stmt->bindValue(':retweeted_by', $retweeted_by, PDO::PARAM_INT);
$status = $stmt->execute();
$like_data = $stmt->rowcount();

if(!empty($like_data)){
  $stmt = $pdo->prepare("DELETE FROM retweet_list WHERE tweet_num=:tweet_num AND tweeted_by=:tweeted_by AND retweeted_by=:retweeted_by");
  $stmt->bindValue(':tweet_num', $tweet_num, PDO::PARAM_INT);
  $stmt->bindValue(':tweeted_by', $tweeted_by, PDO::PARAM_INT);
  $stmt->bindValue(':retweeted_by', $retweeted_by, PDO::PARAM_INT);
} else {
  $stmt = $pdo->prepare("INSERT INTO retweet_list(tweet_num,tweeted_by,retweeted_by)VALUES(:tweet_num,:tweeted_by,:retweeted_by)");
  $stmt->bindValue(':tweet_num', $tweet_num, PDO::PARAM_INT);
  $stmt->bindValue(':tweeted_by', $tweeted_by, PDO::PARAM_INT);
  $stmt->bindValue(':retweeted_by', $retweeted_by, PDO::PARAM_INT);
  $status = $stmt->execute();
}

if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}


?>
