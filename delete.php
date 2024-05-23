<?php
// データベース接続
$pdo = new PDO('mysql:host=localhost;dbname=pc_management;charset=utf8', 'root', '');

// 削除する行のIDを取得
$id = isset($_POST['id']) ? $_POST['id'] : null;

// IDが指定されていない場合は何もせずに終了
if (!$id) {
    exit('IDが指定されていません。');
}

// 削除クエリの実行
$stmt = $pdo->prepare('DELETE FROM pcs WHERE id = ?');
$stmt->execute([$id]);

// ページにリダイレクト
header('Location: pc-list.php');
