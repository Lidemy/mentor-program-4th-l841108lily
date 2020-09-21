<?php
  require_once("./conn.php");

  $name = $_POST["name"];
  $id = $_POST["id"];

  if(empty($name) || empty($id)) {
    die("請填寫資料");
  }

  $sql = "UPDATE l841108lily_categories SET name = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $name, $id);
  $result = $stmt->execute();
  if(!$result) {
    die($conn->error);
  }

  header("Location: admin_category.php");
?>