<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>XSSデモ掲示板</title>
</head>
<body>
  <h1>XSSデモ掲示板</h1>
<!-- post.phpで処理 -->
<form method="POST" action="post.php">
  <!-- ユーザー名は表示だけ。送らない -->
  投稿者: <?= $_SESSION['user']?><br>
  内容: <textarea name="content"></textarea><br>
  <input type="submit" value="投稿">
</form>


  <a href="view.php">投稿を表示</a>
  <a href="delete.php">全削除</a>
</body>
</html>
