<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>売上情報 - バックルームコンピューター</title>
    <link rel="stylesheet" href="style/sales.css">
</head>
<body>
    <div class="main-container">
        
        <div class="top-section">
            <a href="menu.php" class="btn-back">戻る</a>
        </div>
        
        <div class="tab-group">
            <button class="tab-btn" data-period="過去1時間">過去1時間</button>
            <button class="tab-btn active" data-period="本日">本日</button>
            <button class="tab-btn" data-period="今週">今週</button>
            <button class="tab-btn" data-period="今月">今月</button>
            <button class="tab-btn" data-period="今年">今年</button>
        </div>

        <div class="dashboard-grid">
            <div class="data-card">
                <h3 id="sales-title">本日の売り上げ</h3>
                <div class="data-value" id="sales-value">145,200円</div>
            </div>

            <div class="data-card">
                <h3 id="count-title">本日の会計回数</h3>
                <div class="data-value" id="count-value">84回</div>
            </div>

            <div class="data-card">
                <h3>売れているジャンル</h3>
                <div class="data-list" id="genre-list">
                    <p>1. 野菜</p>
                    <p>2. 肉・魚</p>
                    <p>3. 飲料</p>
                </div>
            </div>

            <div class="weather-and-btn">
                <div class="weather-card">
                    <h3>現在の天気</h3>
                    <div id="weather-info" class="data-value weather-value">取得中...</div>
                </div>
                <a href="sales_detail.php" class="btn-detail">詳細へ</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            /* ----------------------------------------------------
               1. 天気予報の取得処理（気象庁オープンデータ）
            ---------------------------------------------------- */
            fetch('https://www.jma.go.jp/bosai/forecast/data/forecast/140000.json')
                .then(response => response.json())
                .then(data => {
                    const weatherText = data[0].timeSeries[0].areas[0].weathers[0];
                    document.getElementById('weather-info').textContent = weatherText.replace(/　/g, ' ');
                })
                .catch(error => {
                    document.getElementById('weather-info').textContent = '情報取得エラー';
                    console.error('天気情報の取得に失敗:', error);
                });

            /* ----------------------------------------------------
               2. タブ切り替えとデータの動的変更処理
            ---------------------------------------------------- */
            const dummyData = {
                "過去1時間": { sales: "12,500円", count: "8回", genres: ["1. 飲料", "2. 食品", "3. 野菜"] },
                "本日":      { sales: "145,200円", count: "84回", genres: ["1. 野菜", "2. 肉・魚", "3. 飲料"] },
                "今週":      { sales: "920,400円", count: "512回", genres: ["1. 肉・魚", "2. 野菜", "3. 食品"] },
                "今月":      { sales: "3,840,000円", count: "2,055回", genres: ["1. 肉・魚", "2. 食品", "3. 飲料"] },
                "今年":      { sales: "45,600,000円", count: "25,300回", genres: ["1. 食品", "2. 肉・魚", "3. 野菜"] }
            };

            const tabBtns = document.querySelectorAll('.tab-btn');
            const salesTitle = document.getElementById('sales-title');
            const salesValue = document.getElementById('sales-value');
            const countTitle = document.getElementById('count-title');
            const countValue = document.getElementById('count-value');
            const genreList = document.getElementById('genre-list');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // タブの色を切り替え
                    tabBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const period = this.getAttribute('data-period');
                    
                    // タイトルを書き換え（「今年の売り上げ」「今年の会計回数」など）
                    salesTitle.textContent = period + "の売り上げ";
                    countTitle.textContent = period + "の会計回数";
                    
                    // 数値とジャンルを書き換え
                    if (dummyData[period]) {
                        salesValue.textContent = dummyData[period].sales;
                        countValue.textContent = dummyData[period].count;
                        genreList.innerHTML = `
                            <p>${dummyData[period].genres[0]}</p>
                            <p>${dummyData[period].genres[1]}</p>
                            <p>${dummyData[period].genres[2]}</p>
                        `;
                    }
                });
            });
        });
    </script>
</body>
</html>