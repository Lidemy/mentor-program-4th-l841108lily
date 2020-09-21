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
  
  $page = 1;
  if(!empty($_GET["page"])){
    $page = intval($_GET["page"]);
  }
  $items_per_page = 5;
  $offset = ($page - 1) * $items_per_page;

  $sql = "SELECT articles.id AS id, articles.title AS title,
          articles.content AS content, articles.created_at AS created_at, 
          categories.name AS category
          FROM l841108lily_articles AS articles
          LEFT JOIN l841108lily_categories AS categories
          ON articles.category_id = categories.id 
          WHERE articles.is_deleted IS NULL 
          ORDER BY articles.created_at DESC 
          LIMIT ? OFFSET ? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $items_per_page, $offset);
  $result = $stmt->execute();

  if(!$result) {
    die("錯誤：" . $conn->error);
  }
  $result = $stmt->get_result();

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
      <?php
        while($row = $result->fetch_assoc()){
      ?>
      <div class="article">
        <div class="article__info">
          <div class="info__title"><?php echo escape($row['title']);?></div>
           <?php if(!empty($username)){?>
              <a class="btn_admin" href="update.php?id=<?php echo $row['id']; ?>">編輯</a>
            <?php } ?>
        </div>
        <div class="article__type">
          <img src="/blog/image/created_at.png">
          <div class="type__created_at"><?php echo escape($row['created_at']);?></div>
          <img src="/blog/image/category.png">
          <div class="type__category"><?php echo escape($row['category']);?></div>
        </div>
        <div class="article__content">
          <?php echo substr(escape($row['content']), 0, 200);?>
        </div>
        <a class="article__btn" href="./article.php?id=<?php echo escape($row['id']);?>">
          READ MORE
        </a>
      </div>
      <?php } ?>
    </div>
  </div>

  <div class="board__hr"></div>
    <?php
      $sql = "SELECT COUNT(id) AS count FROM l841108lily_articles WHERE is_deleted IS NULL";
      $stmt = $conn->prepare($sql);
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row['count'];
      $total_page = ceil($count / $items_per_page);
    ?>
    <div class="page-info">
      <span>總共有 <?php echo $count; ?> 個文章，頁數：</span>
      <span><?php echo $page; ?> / <?php echo $total_page; ?></span>
    </div>
    <div class="paginator">
      
      <?php if($page != 1) { ?>
        <a href="index.php?page=1">首頁</a>
        <a href="index.php?page=<?php echo $page-1 ; ?>">上一頁</a>        
      <?php } ?>

      <?php if($page != $total_page) { ?>
        <a href="index.php?page=<?php echo $page+1 ; ?>">下一頁</a>
        <a href="index.php?page=<?php echo $total_page; ?>">最後一頁</a>
      <?php } ?>
      
    </div>
</body>
<footer>
  Copyright © 2020 Who's Blog All Rights Reserved.
</footer>
</html>
