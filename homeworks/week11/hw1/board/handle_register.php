<?php
  session_start();
  require_once("conn.php");

  if(empty($_POST["nickname"]) || empty($_POST["username"]) || empty($_POST["password"])) {
    header("Location:register.php?errCode=1");
    die("資料不齊全");
  }

  $nickname = $_POST["nickname"];
  $username = $_POST["username"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $role = 1;

  $sql = "INSERT INTO l841108lily_users(nickname, username, password, role)
    value(?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssi", $nickname, $username, $password, $role);

  $result = $stmt->execute();
  if(!$result) {
    $code = $conn->errno;
    if($code === 1062) {
      header("Location:register.php?errCode=2");    
    }
    die($conn->error);
  }

  $_SESSION["username"] = $username;
  header("Location: index.php");
?>
