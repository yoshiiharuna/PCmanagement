<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <link rel="stylesheet" type="text/css" href="add.css">
</head>
<body>
    <h1>新規登録</h1>
    <form action="add_process.php" method="post">
        <label for="pcid">PCID:</label>
        <input type="text" id="pcid" name="pcid" required><br>
        
        <label for="model">モデル:</label>
        <input type="text" id="model" name="model" required><br>
        
        <label for="os">OS:</label>
        <input type="text" id="os" name="os" required><br>
        
        <label for="cpu">CPU:</label>
        <input type="text" id="cpu" name="cpu" required><br>
        
        <label for="memory">メモリ:</label>
        <input type="text" id="memory" name="memory" required><br>
        
        <label for="name">名前:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="storagerocation">保管場所:</label>
        <input type="text" id="storagerocation" name="storagerocation" required><br>
        
        <label for="memo">メモ:</label>
        <textarea id="memo" name="memo"></textarea><br>
        
        <input type="submit" value="登録">
    </form>
</body>
</html>
