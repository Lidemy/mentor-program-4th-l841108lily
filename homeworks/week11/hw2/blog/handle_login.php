<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  if(empty($_POST["username"]) || empty($_POST["password"])) {
    header("Location:login.php?errCode=1");
    die("資料不齊全");
  }

  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM l841108lily_users WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);

  // 只看有沒有執行成功
  $result = $stmt->execute();
  if(!$result) {
    die($conn->error);
  }

  // 拿到執行結果
  $result = $stmt->get_result();

  // 沒查到使用者
  if($result->num_rows === 0) {
    header("Location: login.php?errCode=2");
    exit();
  }


  // 有查到使用者，確認密碼
  $row = $result->fetch_assoc();
  if(password_verify($password, $row["password"])){
    // 登入成功！
    $_SESSION["username"] = $username;
    header("Location: index.php");
  }else{
    header("Location: login.php?errCode=2");
  }

  
?>
