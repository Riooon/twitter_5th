<?php
session_start();

$tweet_num = $_POST["tweet_num"];
$tweeted_by = $_POST["tweeted_by"];
$liked_by = $_POST["liked_by"];

require "function.php";
$pdo = db_connect();
login_check_by_ssid();


// データ登録 & 重複いいねの防止ーーーーーーーーーーーーーーーーーーーー

$stmt = $pdo->prepare("SELECT * FROM like_list WHERE tweet_num=:tweet_num AND tweeted_by=:tweeted_by AND liked_by=:liked_by");
$stmt->bindValue(':tweet_num', $tweet_num, PDO::PARAM_INT);
$stmt->bindValue(':tweeted_by', $tweeted_by, PDO::PARAM_INT);
$stmt->bindValue(':liked_by', $liked_by, PDO::PARAM_INT);
$status = $stmt->execute();
$like_data = $stmt->rowcount();

if(!empty($like_data)){
  $stmt = $pdo->prepare("DELETE FROM like_list WHERE tweet_num=:tweet_num AND tweeted_by=:tweeted_by AND liked_by=:liked_by");
  $stmt->bindValue(':tweet_num', $tweet_num, PDO::PARAM_INT);
  $stmt->bindValue(':tweeted_by', $tweeted_by, PDO::PARAM_INT);
  $stmt->bindValue(':liked_by', $liked_by, PDO::PARAM_INT);
} else {
  $stmt = $pdo->prepare("INSERT INTO like_list(tweet_num,tweeted_by,liked_by)VALUES(:tweet_num,:tweeted_by,:liked_by)");
  $stmt->bindValue(':tweet_num', $tweet_num, PDO::PARAM_INT);
  $stmt->bindValue(':tweeted_by', $tweeted_by, PDO::PARAM_INT);
  $stmt->bindValue(':liked_by', $liked_by, PDO::PARAM_INT);
  $status = $stmt->execute();
}

if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}

?>