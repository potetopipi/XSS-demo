<?php
$db = new PDO('sqlite:db.sqlite3');
$db->exec("DELETE FROM posts");

header('Location: view.php');
exit;
?>
