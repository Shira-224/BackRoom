<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会計履歴 - バックルームコンピューター</title>
    <link rel="stylesheet" href="style/accounting_history.css">
</head>
<body>
    <div class="main-container">
        <div class="top-section">
            <a href="menu.php" class="btn-back">戻る</a>
            
            <div class="search-container">
                <input type="text" placeholder="会計IDの入力欄" class="search-input">
                <button class="btn-search">検索</button>
            </div>
        </div>
        
        <div class="table-container">
            <table class="history-table">
                <thead>
                    <tr>
                        <th>会計ID</th>
                        <th>時間</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>00001</td>
                        <td>2026/05/15 10:00:00</td>
                    </tr>
                    <tr>
                        <td>00002</td>
                        <td>2026/05/15 10:30:15</td>
                    </tr>
                    <tr>
                        <td>00003</td>
                        <td>2026/05/15 11:15:42</td>
                    </tr>
                    <tr>
                        <td>00004</td>
                        <td>2026/05/15 12:05:10</td>
                    </tr>
                    <tr>
                        <td>00005</td>
                        <td>2026/05/15 13:20:05</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="bottom-section">
            <button class="btn-detail">詳細履歴</button>
        </div>
    </div>
</body>
</html>