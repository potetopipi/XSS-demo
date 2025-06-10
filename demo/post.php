<?php
session_start();
$db = new PDO("sqlite:db.sqlite3");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_SESSION['user'] ?? 'ゲスト';  // ← 信頼できる
    $content = $_POST['content'] ?? '';

    $stmt = $db->prepare("INSERT INTO posts (name, content) VALUES (?, ?)");
    $stmt->execute([$name, $content]);
}



header('Location: view.php');
exit;
?>
