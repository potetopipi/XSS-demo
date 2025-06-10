<?php
session_start();
//csrf対策掲示板
// CSRFトークン生成（初回または期限切れなら新しく生成）
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>CSRF対策掲示板</title>
</head>
<body>
  <h1>CSRF対策掲示板</h1>

  <form method="POST" action="post2.php">
    投稿者: <?= htmlspecialchars($_SESSION['user'] ?? 'ゲスト', ENT_QUOTES, 'UTF-8') ?><br>
    内容: <textarea name="content"></textarea><br>
    <!-- CSRFトークン hiddenで送信 -->
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8') ?>">
    <input type="submit" value="投稿">
  </form>

  <a href="view.php">投稿を見る</a>
</body>
</html>
