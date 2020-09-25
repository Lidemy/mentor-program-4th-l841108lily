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
    <h1>您沒有權限管理後台</h1>
  <?php } else {?>
  <div class="container">
    <div class="articles">
      <div class="btn_add_article"> <a href="./add_category.php">新增分類</a></div>
      <?php
        $sql = "SELECT * FROM l841108lily_categories ORDER BY created_at DESC";
          $stmt = $conn->prepare($sql);
          $result = $stmt->execute();
          if(!$result) {
            die($conn->error);
          }
          $result = $stmt->get_result();
        if($result->num_rows >0) {
          while($row = $result->fetch_assoc()) { ?>
            <div class="article__admin">
              <div class="article__title">
                <?php echo escape($row['name']); ?>
              </div>
              <div class="article__edit">
                <div class="created_at"><?php echo escape($row['created_at']); ?></div>
                <a class="btn_admin" href="./update_category.php?id=<?php echo $row['id']; ?>">編輯</a>
                <a class="btn_admin" href="./delete_category.php?id=<?php echo $row['id']; ?>">刪除</a>
              </div>
            </dir>
            <!-- 不知道哪裡的 div 沒有關好，所以多加一個div-->
            </div>
      <?php }} ?>
    </div>
  </div>
  <?php }?>
</body>
<footer>
  Copyright © 2020 Who's Blog All Rights Reserved.
</footer>
</html>
