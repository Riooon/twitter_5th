<?php
//1. GETでidを取得
$id = $_GET["id"];
// echo $id;

// //2. DB接続します
require "function.php";
$pdo = db_connect();

//3. データ削除SQLを準備
$delete = $pdo->prepare("DELETE FROM twitter_account WHERE id=:id");
$delete->bindvalue(":id",$id,PDO::PARAM_INT);

//4. SQL実行
$status = $delete->execute();
//5. 一覧ページへ戻す
if ($status == false) { 
    //SQLエラー関数
    sql_error($delete);
  }else{
    header('Location: index.php');
  }
?>