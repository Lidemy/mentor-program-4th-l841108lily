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

  $sql = "SELECT users.username AS username,
          users.nickname AS nickname,
          users.created_at AS created_at,
          users.role AS role
          FROM l841108lily_users AS users";
  $stmt = $conn->prepare($sql);
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
    <a class="board__btn" href="index.php">回留言板</a>
    <h1 class="board__title">權限管理</h1>
    <div class="board__hr"></div>
    <?php if($user['role'] == 2) {?>
      <section>
        <table class="table__role">
          <tr>
            <th>帳號</th>
            <th>暱稱</th>
            <th>建立時間</th>
            <th>權限</th>
          </tr>
          <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row["username"]; ?></td>
              <td><?php echo $row["nickname"]; ?></td>
              <td><?php echo $row["created_at"]; ?></td>
              <td>
                <form method="POST" action="update_role.php">            
                  <select name="role">
                    <option value="1" <?php echo ($row["role"] == 1)? "selected" : ""; ?>>1</option>
                    <option value="2" <?php echo ($row["role"] == 2)? "selected" : ""; ?>>2</option>
                    <option value="3" <?php echo ($row["role"] == 3)? "selected" : ""; ?>>3</option>
                  </select>
                  <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                  <input type="submit" value="確認">
                </form>
              </td>
            </tr>
          <?php } ?>
        </table>
        <div class="notice">權限說明：1 為一般使用者，2 為管理員，3 為已停權使用者。</div>
      </section>
    <?php } else {echo "您無法編輯權限"; }?>
    <div class="board__hr"></div>
  </main>
</body>
</html>



