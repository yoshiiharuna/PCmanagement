<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h2>ログイン</h2>
    <form action="login_process.php" method="post">
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required><br>
        
        <input type="submit" value="ログイン">
    </form>
</body>
</html>

<?php
// データベース接続
$pdo = new PDO('mysql:host=localhost;dbname=your_database_name;charset=utf8', 'root', '');

// POSTデータからメールアドレスとパスワードを取得
$email = $_POST['email'];
$password = $_POST['password'];

// パスワードのハッシュ化
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// データベースからメールアドレスに対応するユーザーを取得
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザーが存在し、パスワードが一致するかチェック
if ($user && password_verify($password, $user['password'])) {
    // ログイン成功
    session_start();
    $_SESSION['user_id'] = $user['id']; // ユーザーIDをセッションに保存
    header('Location: dashboard.php'); // ダッシュボードページにリダイレクト
    exit();
} else {
    // ログイン失敗
    echo "メールアドレスまたはパスワードが正しくありません。";
}
?>
