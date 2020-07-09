<?php

//1.POSTでデータを取得
$email = $_POST["email"];
$password = $_POST["password"];
$name = $_POST["name"];
$username = $_POST["username"];
$id = $_POST["id"];
$bio = $_POST["bio"];
$profile_picture = $_FILES["profile_picture"]["name"];
$background_image = $_FILES["background_image"]["name"];

// echo $profile_picture;

require "function.php";
$pdo = db_connect();

// 2. ファイルのアップロード処理
// （プロフィール画像編）
$upload = "img/profile_picture/";
if(move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $upload.$profile_picture)){

} else {
  echo "Upload Failed";
  echo $_FILES["profile_picture"]["error"];
};
// （背景画像編）
$upload_back = "img/background_image/";
if(move_uploaded_file($_FILES["background_image"]["tmp_name"], $upload_back.$background_image)){

} else {
  echo "Upload Failed";
  echo $_FILES["background_image"]["error"];
};


//3.UPDATE gs_an_table SET ....; で更新(bindValue)
$sql = 'UPDATE twitter_account SET email=:a1,password=:a2,username=:a3,name=:a4,bio=:a6,profile_picture=:a7,background_image=:a8 WHERE id=:a5';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1',  $email,  PDO::PARAM_STR);
$stmt->bindValue(':a2',  $password,  PDO::PARAM_STR);
$stmt->bindValue(':a3',  $username,  PDO::PARAM_STR);
$stmt->bindValue(':a4',  $name,  PDO::PARAM_STR);    //更新したいidを渡す
$stmt->bindValue(':a5',  $id,  PDO::PARAM_INT);    //更新したいidを渡す
$stmt->bindValue(':a6',  $bio,  PDO::PARAM_STR);    //更新したいidを渡す
$stmt->bindValue(':a7',  $profile_picture,  PDO::PARAM_STR);    //更新したいidを渡す
$stmt->bindValue(':a8',  $background_image,  PDO::PARAM_STR);    //更新したいidを渡す
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //select.phpへリダイレクト
  header("Location: profile.php?username=".$username);
  exit;
}

?>