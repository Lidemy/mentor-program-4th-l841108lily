

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
      <a class="active" href="./login.php">登入</a>
    </div>
  </nav>
  <main>
    <div class="login__blog">

      <?php
        if(!empty($_GET["errCode"])) {
          $code = $_GET["errCode"];
          $msg = "error";
          if($code === "1") {
            $msg = "資料不齊全";
          } else if($code === "2") {
            $msg = "帳號或密碼填寫有誤";
          }
          echo "<h2 class='error'>錯誤：" . $msg . "</h2>";
        }
      ?>
      <form class="blog__form" method="POST" action="handle_login.php">   
        <h1>Log In</h1>
        <div class="blog__input">
          <span>帳號：</span><br>
          <input type="text" name="username">
        </div>
        <div class="blog__input">
          <span>密碼：</span><br>
          <input type="password" name="password">
        </div>
        <input class="blog__submit-btn" type="submit" value="送出">
      </form>
    </div>


  </main>
</body>
</html>



