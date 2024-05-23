<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="login-form.css">
</head>

<body>
    <div class="form-container">
        <h2>ログイン</h2>
        <form action="login.php" method="post">
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="ログイン">
            <a href='register.php'>ユーザー登録はこちら</a>
        </form>
    </div> 
</body>
</html>


<?php
session_start();

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

        // ユーザーの認証
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // セッションにユーザー情報を保存
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            
            // pc-list.phpにリダイレクト
            header('Location: pc-list.php');
            exit();
        } else {
            echo "無効なメールアドレスまたはパスワードです。";
        }
    
    }
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
} catch (Exception $e) {
    echo "一般エラー: " . $e->getMessage();
}
?>
