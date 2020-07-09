<?php

$tweet = $_POST["tweet"];
$username = $_POST["username"];
$id = $_POST["id"];

//2. DB接続します（11行目以外は基本同じなので、使用する時はコピペでOK）
require "function.php";
$pdo = db_connect();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO tweet_content (tweet,id,posted_by)VALUES (:tweet,:id,:id)");
$stmt->bindValue(':tweet', $tweet, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

header("Location: profile.php?username=".$username);
?>