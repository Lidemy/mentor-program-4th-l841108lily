<?php
  require_once("conn.php");

  if(empty($_POST["username"]) || empty($_POST["password"])) {
    header("Location:login.php?errCode=1");
    die("資料不齊全");
  }

  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = sprintf(
    "SELECT * FROM l841108lily_users WHERE username='%s' AND password='%s'",
    $username,
    $password
  );

  $result = $conn->query($sql);
  if(!$result) {
    die($conn->error);
  }
  if($result->num_rows){
    // 登入成功！
    $expire = time() + 3600 * 24 * 30; // 現在時間 + 30 天
    setcookie("username", $username, $expire);
    header("Location: index.php");
  }else{
    header("Location: login.php?errCode=2");
  }

  
?>
