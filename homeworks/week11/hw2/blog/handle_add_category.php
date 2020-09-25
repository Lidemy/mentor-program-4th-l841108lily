<?php
  require_once("./conn.php");

  $name = $_POST["name"];

  if(empty($name)) {
    die("請填寫資料");
  }

  $sql = "INSERT INTO l841108lily_categories(name) VALUE(?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $name);
  $result = $stmt->execute();
  if(!$result) {
    die($conn->error);
  }

  header("Location: admin_category.php");
?>