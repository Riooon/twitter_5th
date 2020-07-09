<?php

// データベースへの接続
function db_connect(){
    try {
        //Password:MAMP='root',XAMPP=''
        return new PDO('mysql:dbname=twitter_db;charset=utf8;host=localhost','root','root');
        } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
        }
}

// セッションIDでログインしてないユーザーを弾く
function login_check_by_ssid(){
    if( !isset($_SESSION["ssid"]) || $_SESSION["ssid"]!=session_id()){
        header("Location: login.php");
        exit();
    }
}

?>