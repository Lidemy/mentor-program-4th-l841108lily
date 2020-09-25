<?php
  require_once("./conn.php");

  $title = $_POST["title"];
  $content = $_POST["content"];
  $category_id = $_POST["category_id"];

  if(empty($title) || empty($content) || empty($category_id)) {
    die("請填寫資料");
  }

  $sql = "INSERT INTO l841108lily_articles(title, content, category_id) VALUE(?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi", $title, $content, $category_id);
  $result = $stmt->execute();
  if(!$result) {
    die($conn->error);
  }

  header("Location: admin.php");
?>