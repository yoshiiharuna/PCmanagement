<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> <!-- 文字エンコーディング -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- レスポンシブデザイン有効、モバイルデバイスでの表示を最適化 -->
    <title>PC管理画面</title> <!-- ブラウザタブ -->
    <link rel="stylesheet" type="text/css" href="pc-list.css"> <!-- 外部スタイルシート読込 -->
</head>

<body>
    <h1>PC管理画面</h1>
    <button onclick="location.href='add.php'">新規登録</button>
    <table> <!-- PC管理情報を表示するためのテーブル -->
        <thead> <!-- テーブルヘッダーを定義 -->
            <tr> <!-- テーブル行を定義 -->
                <th>ID</th> <!-- テーブルヘッダーセルを定義 -->
                <th>PCID</th> 
                <th>モデル</th>
                <th>OS</th>
                <th>CPU</th>
                <th>メモリ</th>
                <th>名前</th>
                <th>保管場所</th>
                <th>メモ</th>
                <th>編集</th>
            </tr>
        </thead>

        <tbody> <!-- テーブルボディを定義。ここにPHPを使ってデータベースから取得したデータが表示 -->
            <?php
            // データベース接続 PHP Data Objectsの略。さまざまなデータベース管理システム（DBMS）に対して同じインターフェースで接続できる
            // 新しいPDOオブジェクトを作成するためのコンストラクタ呼び出し。MySQLデータベースに接続
            $pdo = new PDO('mysql:host=localhost;dbname=pc_management;charset=utf8', 'root', '');
            // $stmtは、PDOStatementオブジェクトを保持する変数。クエリの結果を操作するために使用。 PDOインスタンスのメソッドで、SQLクエリを実行。
            $stmt = $pdo->query('SELECT * FROM pcs');
            // PHPでデータベースから取得した結果を反復処理する構文 foreach:反復 $stmt:SQLクエリの実行結果 $rows:現在の行のデータを保持する変数 反復処理ごとに次の行に移動し、その行のデータを格納 
            foreach ($stmt as $row) {
                echo '<tr>'; // テーブル行を開始
                // 取得した行のデータをHTMLのテーブルセル（<td>要素）に出力 <td>要素:HTMLの表形式（テーブル）において1つのセルを定義
                // htmlspecialchars()は、HTML特殊文字をエスケープするためのPHPの関数 悪意のあるユーザーがHTMLやJavaScriptを埋め込んで攻撃するのを防ぐ
                // $row[]は取得した行の中でのカラムの値を示す この値がテーブルセルに出力
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['pcid']) . '</td>';
                echo '<td>' . htmlspecialchars($row['model']) . '</td>';
                echo '<td>' . htmlspecialchars($row['os']) . '</td>';
                echo '<td>' . htmlspecialchars($row['cpu']) . '</td>';
                echo '<td>' . htmlspecialchars($row['memory']) . '</td>';
                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['storagerocation']) . '</td>';
                echo '<td>' . htmlspecialchars($row['memo']) . '</td>';
                echo '<td><a href="edit.php?id=' . htmlspecialchars($row['id']) . '">編集</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

  <!-- 削除ボタンをテーブルの外に配置 -->
    <form method="POST" action="delete.php" id="deleteForm"> <!-- 削除フォームを定義し、delete.phpにPOSTリクエストを送信 -->
        <label for="deleteId">削除するPCのID:</label>
        <input type="text" name="id" id="deleteId" required> <!-- 削除するPCのIDを入力するテキストフィールド -->
        <input type="submit" value="削除">
    </form>

    <!-- 削除ボタンをクリックしたときに、削除する行のIDを設定 -->
    <script>
        function setDeleteId(id) { // JavaScript関数 この関数は引数として1つのIDを取る。削除ボタンを押したときに設定したい値
            document.getElementById('deleteId').value = id; // 指定されたIDを削除フォームのdeleteIdフィールドに設定 ドキュメント内の要素を取得するためのメソッド。引数として指定されたIDを持つ要素が返される
        }
    </script>  
</body>
</html>