<?php
session_start();
$login_mail = $_POST["login_mail"];
$login_pass = $_POST["login_pass"];

//1. 接続します
require"function.php";
$pdo = db_connect();

//２．データ登録SQL作成
$sql = "SELECT * FROM twitter_account WHERE email=:login_mail AND password=:login_pass";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':login_mail', $login_mail);
$stmt->bindValue(':login_pass', $login_pass);
$res = $stmt->execute();

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//３．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法


//４. 該当レコードがあればSESSIONに値を代入
if( $val["id"] != "" ){
  $_SESSION["ssid"]  = session_id();
  //Login処理OKの場合select.phpへ遷移
  header('Location: profile.php?username='.$val["username"]);
}else{
  //Login処理NGの場合login.phpへ遷移
  header("Location: login.php");
}
//処理終了
exit();
?>

