<?php
//header("Content-Security-Policy: default-src 'self'; script-src 'self'");
$db = new PDO('sqlite:db.sqlite3');
$posts = $db->query("SELECT * FROM posts")->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>投稿一覧</title>
</head>
<body>
  <h1>投稿一覧</h1>
  <ul>
    <?php foreach ($posts as $post): ?>
      <li>
        <?= $post['name'] ?>: <?= $post['content'] ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <a href="keizi.php">戻る</a>
</body>
</html>
