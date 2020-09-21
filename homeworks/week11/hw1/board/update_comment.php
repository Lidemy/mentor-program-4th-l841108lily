<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $id = $_GET["id"];
  $user = NULL;
  $username = NULL;
  if(!empty($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $user = getUserFromUsername($username);
  }
  

  $sql = "SELECT *
          FROM l841108lily_comments
          WHERE id=? AND username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("is", $id, $username);
  $result = $stmt->execute();

  if(!$result) {
    die("錯誤：" . $conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

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

    <h1 class="board__title">編輯留言</h1>
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
      <form class="board__new-comment-form" method="POST" action="handle_update_comment.php">
        <textarea name="content" rows="5"><?php echo $row["content"]; ?></textarea>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input class="board__submit-btn" type="submit" value="送出">
      </form>
      
  </main>

</body>
</html>



