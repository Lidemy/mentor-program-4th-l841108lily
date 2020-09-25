<?php


  function generateToken() {
    $s = "";
    for($i=1; $i<=16; $i++) {
      $s .= chr(rand(65,90));
    }
    return $s;
  }
  // 拿 token 中的 username 對應到資料庫撈出 user 的 id, username, nickname
  function getUserFromUsername($username) {
    global $conn;
    $sql = sprintf(
      "SELECT * FROM l841108lily_users WHERE username = '%s'",
      $username
    );
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row;
  }

  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }
?>