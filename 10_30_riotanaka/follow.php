<!-- ここにフォローの仕組みを書いていくなり -->

<?php
session_start();

$is_followed = $_POST["is_followed"];
$followed_by = $_POST["followed_by"];

// 関数に入れたら ERROR 500 出るので、関数化はいったん諦め
$session_id = $_SESSION["id"];
$session_email = $_SESSION["email"];
$session_password = $_SESSION["password"];
$session_username = $_SESSION["username"];
$session_name = $_SESSION["name"];
$session_bio = $_SESSION["bio"];
$session_profile_picture = $_SESSION["profile_picture"];
$session_background_image = $_SESSION["background_image"];

//1. 接続します
require "function.php";
$pdo = db_connect();

//２．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO follow_list(follow_id,is_followed,followed_by)VALUES(NULL,:is_followed,:followed_by)");
$stmt->bindValue(':is_followed', $is_followed, PDO::PARAM_INT);
$stmt->bindValue(':followed_by', $followed_by, PDO::PARAM_INT);
$status = $stmt->execute();


//エラー確認をしたいとき、コメントアウトーーーーーーーーーーーーーーーーーー
//４．データ登録処理後
// if($status==false){
//   //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
//   $error = $stmt->errorInfo();
//   exit("ErrorMassage:".$error[2]);
// }else{
//   //５．index.phpへリダイレクト
//   header('Location: profile.php?username='.$session_username);
// }
  

header('Location: profile.php?username='.$session_username);
?>