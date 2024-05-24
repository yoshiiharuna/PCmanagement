<?php
// データベース接続 
$pdo = new PDO('mysql:host=localhost;dbname=pc_management;charset=utf8', 'root', '');

// フォームデータを取得
$pcid = $_POST['pcid'];
$model = $_POST['model'];
$os = $_POST['os'];
$cpu = $_POST['cpu'];
$memory = $_POST['memory'];
$name = $_POST['name']; 
$storagerocation = $_POST['storagerocation'];
$memo = $_POST['memo'];

// データベースに新しいPC情報を追加
$stmt = $pdo->prepare('INSERT INTO pcs (pcid, model, os, cpu, memory, name, storagerocation, memo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->execute([$pcid, $model, $os, $cpu, $memory, $name, $storagerocation, $memo]);

// リダイレクトしてPC管理画面に戻る
header('Location: pc-list.php');
?>
