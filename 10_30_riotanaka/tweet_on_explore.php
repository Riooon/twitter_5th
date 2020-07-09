<?php

$id = $_POST["id"];
$tweet = $_POST["tweet"];

// 2. DB接続します（11行目以外は基本同じなので、使用する時はコピペでOK）
require "function.php";
$pdo = db_connect();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO tweet_content(id,tweet,posted_by)VALUES (:id,:tweet,:id)");

$stmt->bindValue(':tweet', $tweet, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMassage:".$error[2]);
  }else{
    //５．index.phpへリダイレクト
    header("Location: timeline.php");
  }

?>