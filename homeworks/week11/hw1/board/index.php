<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

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

  $sql = "SELECT comments.id AS id, comments.content AS content, 
          comments.created_at AS created_at, users.nickname AS nickname,
          users.username AS username
          FROM l841108lily_comments AS comments 
          LEFT JOIN l841108lily_users AS users 
          ON comments.username = users.username
          WHERE comments.is_deleted IS NULL 
          ORDER BY comments.id DESC 
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
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="warning">
    <strong>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，
    註冊時請勿使用任何真實的帳號或密碼！</strong>
  </header>

  <main class="board">
    <?php if(!empty($user['role'])) {
      if($user['role'] == 2) {?>
        <a class="board__btn" href="admin.php">編輯權限</a>
    <?php } } ?>

    <?php if(empty($username)) {?>
      <a class="board__btn" href="register.php">註冊</a>
      <a class="board__btn" href="login.php">登入</a>
    <?php } else {?>

      <a class="board__btn" href="logout.php">登出</a>
      <a class="board__btn update__nickname" >編輯暱稱</a>

      <form class="hide board__nickname-form board__new-comment-form" method="POST" action="update_user.php">
        <div class="board__nickname">
          <span>新的暱稱：</span>
          <input type="text" name="nickname">
        </div>
        <input class="board__submit-btn" type="submit">
      </form>

      <h3>你好！<?php echo escape($user["nickname"]); ?></h3>
    <?php } ?>

    <h1 class="board__title">Comments</h1>
    <?php
      if(!empty($_GET["errCode"])) {
        $code = $_GET["errCode"];
        $msg = "error";
        if($code === "1") {
          $msg = "資料不齊全";
        }
        echo "<h2 class='error'>錯誤：" . $msg . "</h2>";
      }
    ?>
    <?php if($username) {
            if($user["role"] != 3){
      ?>
      <form class="board__new-comment-form" method="POST" action="handle_add_comment.php">
        <textarea name="content" rows="5"></textarea>
        <input class="board__submit-btn" type="submit" value="送出">
      </form>
      
    <?php } else {?>
      <h3>您目前已被停權，無法新增留言</h3>
    <?php }
      } else {?>
      <h3>請登入發布留言</h3>
    <?php } ?>
    <div class="board__hr"></div>
    <section>
      <?php
        while($row = $result->fetch_assoc()){
      ?>
      <div class="card">
        <div class="card__avatar">
        </div>
        <div class="card__body">
          <div class="card__info">
            <span class="card__author">
              <?php echo escape($row['nickname'])?>
              (@<?php echo escape($row['username'])?>)
            </span>
            <span class="card__time">
              <?php echo escape($row['created_at'])?>
            </span>
            <?php if(!empty($username)){
            if($row["username"] === $username or $user["role"] == 2) { ?>
              <a href="update_comment.php?id=<?php echo $row['id']; ?>">編輯</a>
              <a href="delete_comment.php?id=<?php echo $row['id']; ?>">刪除</a>
            <?php }} ?>
          </div>
          <p class="card__content"><?php echo escape($row['content'])?></p>
        </div>
      </div>
      <?php } ?>
    </section>
    <div class="board__hr"></div>
    <?php
      $sql = "SELECT COUNT(id) AS count FROM l841108lily_comments WHERE is_deleted IS NULL";
      $stmt = $conn->prepare($sql);
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row['count'];
      $total_page = ceil($count / $items_per_page);
    ?>
    <div class="page-info">
      <span>總共有 <?php echo $count; ?> 筆留言，頁數：</span>
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
  </main>

  <script>
    var btn = document.querySelector(".update__nickname")
    btn.addEventListener("click", function() {
      var form = document.querySelector(".board__nickname-form")
      form.classList.toggle("hide")
    })
  </script>

</body>
</html>



