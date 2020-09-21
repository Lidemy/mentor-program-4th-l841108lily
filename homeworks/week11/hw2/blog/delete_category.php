<?php
  session_start();
  require_once("./conn.php");

  $id = $_GET["id"];
  if(!$_SESSION["username"]){
    die("您無權刪除分類");
  }

  $sql = "DELETE FROM l841108lily_categories WHERE id = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
  if(!$result) {
    die($conn->error);
  }

  header("Location: ./admin_category.php");
?>