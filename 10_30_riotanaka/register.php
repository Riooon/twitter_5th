<?php
session_start();
$_SESSION["ssid"]  = session_id();

$email = $_POST["email"];
$password = $_POST["password"];
$username = $_POST["username"];
$name = $_POST["name"];

require"function.php";
$pdo = db_connect();

$stmt = $pdo->prepare("INSERT INTO twitter_account(id,email,password,username,name)VALUES(NULL,:email,:password,:username,:name)");
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':password', $password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':username', $username, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header('Location: profile.php?username='.$username);
}

?>