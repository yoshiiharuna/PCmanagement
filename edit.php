<?php
// データベース接続
$pdo = new PDO('mysql:host=localhost;dbname=pc_management;charset=utf8', 'root', '');

// PC情報を取得
$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM pcs WHERE id = ?');
$stmt->execute([$id]);
$pc = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>編集</h1>
    <form action="edit_process.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($pc['id']); ?>">
        
        <label for="pcid">PCID:</label>
        <input type="text" id="pcid" name="pcid" value="<?php echo htmlspecialchars($pc['pcid']); ?>" required><br>
        
        <label for="model">モデル:</label>
        <input type="text" id="model" name="model" value="<?php echo htmlspecialchars($pc['model']); ?>" required><br>
        
        <label for="os">OS:</label>
        <input type="text" id="os" name="os" value="<?php echo htmlspecialchars($pc['os']); ?>" required><br>
        
        <label for="cpu">CPU:</label>
        <input type="text" id="cpu" name="cpu" value="<?php echo htmlspecialchars($pc['cpu']); ?>" required><br>
        
        <label for="memory">メモリ:</label>
        <input type="text" id="memory" name="memory" value="<?php echo htmlspecialchars($pc['memory']); ?>" required><br>
        
        <label for="name">名前:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($pc['name']); ?>" required><br>
        
        <label for="storagerocation">保管場所:</label>
        <input type="text" id="storagerocation" name="storagerocation" value="<?php echo htmlspecialchars($pc['storagerocation']); ?>" required><br>
        
        <label for="memo">メモ:</label>
        <textarea id="memo" name="memo"><?php echo htmlspecialchars($pc['memo']); ?></textarea><br>
        
        <input type="submit" value="更新">
    </form>
</body>
</html>
