<?php
  require_once("conn.php");

  if(empty($_POST["content"])) {
    header("Location:index.php?errCode=1");
    die("資料不齊全");
  }


  $username = $_COOKIE["username"];
  $user_sql = sprintf(
    "SELECT nickname FROM l841108lily_users WHERE username='%s'",
    $username
  );
  $user_result = $conn->query($user_sql);
  $user_row = $user_result->fetch_assoc();

  $nickname = $user_row["nickname"];
  $content = $_POST["content"];

  $sql = sprintf(
    "INSERT INTO l841108lily_comments(nickname, content) value('%s', '%s')",
    $nickname,
    $content
  );

  $result = $conn->query($sql);
  if(!$result) {
    die($conn->error);
  }

  header("Location: index.php");
?>
