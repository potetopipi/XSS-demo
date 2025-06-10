<?php
session_start();
// CSRF対策編
// 関数でCSRFトークン検証
function validate_token($token) {
    return isset($_SESSION['csrf_token']) &&
           isset($token) &&
           hash_equals($_SESSION['csrf_token'], $token);
}

// POST以外を拒否
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('不正なリクエストです。');
}

// トークン検証
$submitted_token = $_POST['csrf_token'] ?? '';
if (!validate_token($submitted_token)) {
    die('CSRFトークンが無効です。フォームを再読み込みしてください。');
}

// 投稿処理
$db = new PDO("sqlite:db.sqlite3");

$name = $_SESSION['user'] ?? 'ゲスト';
$content = $_POST['content'] ?? '';

$stmt = $db->prepare("INSERT INTO posts (name, content) VALUES (?, ?)");
$stmt->execute([$name, $content]);

// トークンの使い回し防止（ワンタイムトークン化）
unset($_SESSION['csrf_token']);

header('Location: view.php');
exit;
