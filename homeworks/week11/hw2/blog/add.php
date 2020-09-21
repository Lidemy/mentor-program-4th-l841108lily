<?php
  session_start();

  require_once("./conn.php");
  require_once("./utils.php");

  $user = NULL;
  $username = NULL;
  if(!empty($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $user = getUserFromUsername($username);
  }

  $sql = "SELECT * FROM l841108lily_categories ORDER BY created_at DESC";

  $stmt = $conn->prepare($sql);
  $result = $stmt->execute();
  if(!$result) {
    die($conn->error);
  }
  $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Blog 部落格</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <nav class="nav">
    <div>
      <h1>Fang's Blog</h1>
      <a href="./index.php">文章列表</a>
      <a href="./about.php">關於我</a>
    </div>
    <div>
      <?php if(empty($username)) {?>
        <a href="./login.php">登入</a>
      <?php } else {?>
        <a class="active" href="./admin.php">文章後台</a>
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
  <?php if(empty($username)) {?>
    <h1>您沒有權限新增文章</h1>
  <?php } else {?>
  <div class="container">
    <div class="articles">
      <div class="article">
        <h3>發表文章：</h3>
        <form class="blog__form" method="POST" action="handle_add.php">
          <div>標題：<input class="blog__title" name="title"></div>
          <div>內容：<textarea name="content" rows="5"></textarea></div>
          <div>
            分類：<select name="category_id">
              <?php
                while ($row = $result->fetch_assoc()) {
                  $id = $row["id"];
                  $name = $row["name"];
                  echo "<option value='$id'>$name</option>";
                };
              ?>
            </select>
          </div>
          <div><input class="blog__submit-btn" type="submit" value="送出"></div>
        </form>
      </div>
    </div>
  </div>
  <?php }?>
</body>
<footer>
  Copyright © 2020 Who's Blog All Rights Reserved.
</footer>
</html>


