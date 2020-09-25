<?php
  require_once("./conn.php");

  $title = $_POST["title"];
  $content = $_POST["content"];
  $category_id = $_POST["category_id"];
  $id = $_POST["id"];
  $page = $_POST["page"];

  if(empty($title) || empty($content) || empty($category_id) || empty($id)) {
    die("請填寫資料");
  }

  $sql = "UPDATE l841108lily_articles SET title = ?, content = ?, category_id = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssii", $title, $content, $category_id, $id);
  $result = $stmt->execute();
  if(!$result) {
    die($conn->error);
  }

  header("Location: " . $page);
?>