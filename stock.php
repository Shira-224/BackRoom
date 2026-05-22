<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>在庫確認 - バックルームコンピューター</title>
    <link rel="stylesheet" href="style/stock_page.css">
</head>
<body>
    <div class="main-container">
        <div class="top-section">
            <a href="stock_select.php" class="btn-back">戻る</a>
            
            <div class="search-container">
                <select id="search-type" class="search-select">
                    <option value="name">商品名</option>
                    <option value="id">商品ID</option>
                </select>
                <input type="text" id="search-input" placeholder="キーワードを入力" class="search-input">
                <button id="btn-search" class="btn-search">検索</button>
            </div>
        </div>
        
        <div class="table-container">
            <table class="stock-table" id="stock-table">
                <thead>
                    <tr>
                        <th>商品名</th>
                        <th>商品ID</th>
                        <th>個数</th>
                        <th>ジャンル</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>商品A</td><td>10001</td><td>50</td><td>食品</td></tr>
                    <tr><td>商品B</td><td>10002</td><td>20</td><td>日用品</td></tr>
                    <tr><td>商品C</td><td>10003</td><td>150</td><td>飲料</td></tr>
                    <tr><td>商品D</td><td>10004</td><td>5</td><td>雑貨</td></tr>
                    <tr><td>商品E</td><td>10005</td><td>80</td><td>食品</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('btn-search').addEventListener('click', function() {
            // 選択されている検索タイプ（商品名かIDか）を取得
            const searchType = document.getElementById('search-type').value;
            // 入力された文字を取得（大文字小文字を区別しないように小文字化）
            const keyword = document.getElementById('search-input').value.toLowerCase();
            // テーブルの行をすべて取得
            const rows = document.querySelectorAll('#stock-table tbody tr');

            rows.forEach(row => {
                // 商品名は0番目の列(td)、IDは1番目の列(td)
                const cellIndex = (searchType === 'name') ? 0 : 1;
                const cellText = row.cells[cellIndex].textContent.toLowerCase();

                // キーワードが含まれているかチェック
                if (cellText.includes(keyword)) {
                    row.style.display = ""; // 表示
                } else {
                    row.style.display = "none"; // 非表示
                }
            });
        });

        // エンターキーでも検索できるように設定
        document.getElementById('search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('btn-search').click();
            }
        });
    </script>
</body>
</html>