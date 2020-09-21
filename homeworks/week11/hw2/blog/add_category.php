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
        <a href="./admin.php">文章後台</a>
        <a class="active" href="./admin_category.php">分類後台</a>
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
        <h3>新增分類：</h3>
        <form class="blog__form" method="POST" action="handle_add_category.php">
          <div>名稱：<input class="blog__title" name="name"></div>
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


