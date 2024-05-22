<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
</head>
<body>
    <h2>ユーザー登録</h2>
    <form action="register.php" method="post">
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="登録">
    </form>
</body>
</html>

<?php
try {
    // データベース接続
    $pdo = new PDO('mysql:host=localhost;dbname=pc_management;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // POSTデータの取得とバリデーション
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            echo "メールアドレスとパスワードは必須です。";
            exit();
        }

        // パスワードのハッシュ化
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // ユーザー情報のデータベースへの挿入
        $stmt = $pdo->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
        $stmt->execute([$email, $hashedPassword]);

        // ログインページにリダイレクト
        header('Location: login.php');
        exit();
    }
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
} catch (Exception $e) {
    echo "一般エラー: " . $e->getMessage();
}
?>
