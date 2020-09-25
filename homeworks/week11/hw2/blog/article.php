<?php
  session_start();
  require_once("./conn.php");
  require_once("utils.php");
  $id = $_GET["id"];

  $user = NULL;
  $username = NULL;
  if(!empty($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $user = getUserFromUsername($username);
  }

  $sql = "SELECT articles.id, articles.title,
          articles.content, categories.name
          FROM l841108lily_articles AS articles
          LEFT JOIN l841108lily_categories AS categories
          ON articles.category_id = categories.id
          WHERE articles.id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
  if(!$result) {
    die($conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $title = $row["title"];
  $content = $row["content"]
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>部落格</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<nav class="nav">
    <div>
      <h1>Fang's Blog</h1>
      <a class="active" href="./index.php">文章列表</a>
      <a href="./about.php">關於我</a>
    </div>
    <div>
      <?php if(empty($username)) {?>
        <a href="./login.php">登入</a>
      <?php } else {?>
        <a href="./admin.php">文章後台</a>
        <a href="./admin_category.php">分類後台</a>
        <a href="./logout.php">登出</a>
      <?php }?>
    </div>
  </nav>
  <section class="banner">
    <div class="title">
      <h2>存放技術之地</h2>
      <div>Welcome to my blog</div>
    </div>
  </section>

  <div class="container">
    <div class="articles">
      <div class="article">
        <h1><?php echo escape($title);?></h1>
        <h2>分類：<?php echo escape($row['name']);?></h2>
        <p><?php echo escape($content);?></p>
      </div>
    </div>
  </div>
</body>
<footer>
  Copyright © 2020 Who's Blog All Rights Reserved.
</footer>
</html>



