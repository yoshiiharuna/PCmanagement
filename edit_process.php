<?php
// データベース接続
$pdo = new PDO('mysql:host=localhost;dbname=pc_management;charset=utf8', 'root', '');

// フォームデータを取得
$id = $_POST['id'];
$pcid = $_POST['pcid'];
$model = $_POST['model'];
$os = $_POST['os'];
$cpu = $_POST['cpu'];
$memory = $_POST['memory'];
$name = $_POST['name'];
$storagerocation = $_POST['storagerocation'];
$memo = $_POST['memo'];

// データベースのPC情報を更新
$stmt = $pdo->prepare('UPDATE pcs SET pcid = ?, model = ?, os = ?, cpu = ?, memory = ?, name = ?, storagerocation = ?, memo = ? WHERE id = ?');
$stmt->execute([$pcid, $model, $os, $cpu, $memory, $name, $storagerocation, $memo, $id]);

// リダイレクトしてPC管理画面に戻る
header('Location: pc-list.php');
?>
