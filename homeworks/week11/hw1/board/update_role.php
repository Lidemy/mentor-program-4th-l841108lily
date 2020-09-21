<?php
  require_once("conn.php");

  if(empty($_POST["role"])) {
    header("Location:admin.php?errCode=1");
    die("資料不齊全");
  }

  $username = $_POST["username"];
  $role = $_POST["role"];

  $sql = "UPDATE l841108lily_users SET role=? WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $role, $username);

  $result = $stmt->execute();
  if(!$result) {
    die($conn->error);
  }
  header("Location: admin.php");

?>
