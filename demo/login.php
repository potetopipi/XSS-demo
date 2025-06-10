<?php
// クッキー属性を設定（初回に限り有効）
session_set_cookie_params([
  'httponly' => false,
  'secure' => false,
  'samesite' => 'Lax'
]);
session_start(); // クッキー送信される

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $db = new PDO('sqlite:db.sqlite3');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // ユーザー名とパスワードを照合
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['user'] = $user['username'];
            header("Location: keizi.php"); // ログイン後のページ
            exit;
        } else {
            echo "ユーザー名またはパスワードが正しくありません。";
        }
    } catch (PDOException $e) {
        echo "データベースエラー: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "ユーザー名とパスワードを入力してください。";
}
?>
