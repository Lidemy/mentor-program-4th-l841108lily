<?php
  session_start();
  require_once("./conn.php");
  require_once("utils.php");

  $user = NULL;
  $username = NULL;
  if(!empty($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $user = getUserFromUsername($username);
  }

  $id = $_GET["id"];
  $sql = "SELECT * FROM l841108lily_categories WHERE id = ?" ;
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $result = $stmt->execute();
  if(!$result) {
    die($conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
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
    <h1>您沒有權限修改分類</h1>
  <?php } else {?>
  <div class="container">
    <div class="articles">
      <div class="article">
        <h3>發表文章：</h3>
        <form class="blog__form" method="POST" action="handle_update_category.php">
          <div>名稱：<input class="blog__title" name="name" value="<?php echo $row['name'] ?>"></div>
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
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


