
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品情報更新画面 - バックルームコンピューター</title>
    <link rel="stylesheet" href="style/update.css">
</head>
<body>
    <div class="main-container">
        
        <div class="top-section">
            <a href="in_out_updt.php" class="btn-back">戻る</a>
        </div>
        
        <div class="search-section">
            <select id="search-type" class="search-select">
                <option value="name">商品名</option>
                <option value="id">商品ID</option>
                <option value="barcode">バーコード番号</option>
            </select>
            <input type="text" id="search-keyword" class="search-input" placeholder="変更したい商品を検索してください">
            <button type="button" id="btn-search" class="btn-search">検索</button>
        </div>
        
        <div id="no-data-message" class="no-data-msg">
            変更したい商品を上の検索窓から検索してください。ここに現在のデータが入った編集用入力欄が表示されます。
        </div>

        <div id="update-form-area" class="update-form-area" style="display: none;">
            <form action="#" method="POST">
                
                <div class="form-grid">
                    
                    <div class="form-group">
                        <label>商品名</label>
                        <input type="text" id="form-name" name="product_name" placeholder="商品名を入力">
                    </div>
                    
                    <div class="form-group">
                        <label>バーコード番号</label>
                        <input type="text" id="form-barcode" name="barcode_number" placeholder="バーコード番号">
                    </div>
                    
                    <div class="form-group">
                        <label>商品ID</label>
                        <input type="text" id="form-id" name="product_id" placeholder="商品ID">
                    </div>
                    
                    <div class="form-group">
                        <label>在庫数</label>
                        <input type="number" id="form-stock" name="stock_count" placeholder="0" min="0">
                    </div>

                    <div class="form-group">
                        <label>単価</label>
                        <input type="number" id="form-price" name="price" placeholder="0" min="0">
                    </div>
                    
                    <div class="form-group">
                        <label>税率</label>
                        <select id="form-tax" name="tax_rate">
                            <option value="8">8% (軽減税率)</option>
                            <option value="10">10% (標準税率)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>ジャンル</label>
                        <select id="form-genre" name="genre">
                            <option value="野菜">野菜</option>
                            <option value="肉・魚">肉・魚</option>
                            <option value="飲料">飲料</option>
                            <option value="食品">食品</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>バーコードの有無</label>
                        <select id="form-barcode-status" name="barcode_status">
                            <option value="有り">有り</option>
                            <option value="無し">無し</option>
                        </select>
                    </div>
                    
                </div>

                <div class="bottom-btn-wrapper">
                    <button type="submit" id="btn-submit" class="btn-submit-large">更新する</button>
                </div>
                
            </form>
        </div>

    </div>

    <script>
        // テスト用のダミー商品データ（現在のデータベースの状態を仮定）
        const mockProducts = [
            { name: "トマト", barcode: "4901234567890", id: "A001", stock: 25, price: 150, tax: "8", genre: "野菜", barcodeStatus: "有り" },
            { name: "国産牛ミニステーキ", barcode: "4901111222222", id: "B055", stock: 12, price: 1280, tax: "8", genre: "肉・魚", barcodeStatus: "有り" },
            { name: "緑茶 500ml", barcode: "4902222333333", id: "C102", stock: 60, price: 100, tax: "8", genre: "飲料", barcodeStatus: "有り" },
            { name: "ポテトチップス", barcode: "4903333444444", id: "D201", stock: 18, price: 120, tax: "10", genre: "食品", barcodeStatus: "有り" }
        ];

        // HTML要素の取得
        const searchType = document.getElementById('search-type');
        const searchKeyword = document.getElementById('search-keyword');
        const btnSearch = document.getElementById('btn-search');
        const noDataMessage = document.getElementById('no-data-message');
        const updateFormArea = document.getElementById('update-form-area');
        
        // フォーム内の各パーツの取得
        const formName = document.getElementById('form-name');
        const formBarcode = document.getElementById('form-barcode');
        const formId = document.getElementById('form-id');
        const formStock = document.getElementById('form-stock');
        const formPrice = document.getElementById('form-price');
        const formTax = document.getElementById('form-tax');
        const formGenre = document.getElementById('form-genre');
        const formBarcodeStatus = document.getElementById('form-barcode-status');
        const btnSubmit = document.getElementById('btn-submit');

        // 「検索」ボタンが押されたときの処理
        btnSearch.addEventListener('click', () => {
            const type = searchType.value;
            const keyword = searchKeyword.value.trim();
            
            if (!keyword) {
                alert("キーワードを入力してください。");
                return;
            }
            
            // 選択されたタイプ（商品名/ID/バーコード）に応じてデータを検索
            const foundProduct = mockProducts.find(product => {
                if (type === 'name') return product.name === keyword;
                if (type === 'id') return product.id === keyword;
                if (type === 'barcode') return product.barcode === keyword;
                return false;
            });
            
            if (foundProduct) {
                // 見つかった場合：各入力欄（input / select）に現在のデータをセット
                formName.value = foundProduct.name;
                formBarcode.value = foundProduct.barcode;
                formId.value = foundProduct.id;
                formStock.value = foundProduct.stock;
                formPrice.value = foundProduct.price;
                formTax.value = foundProduct.tax;
                formGenre.value = foundProduct.genre;
                formBarcodeStatus.value = foundProduct.barcodeStatus;
                
                // 案内文を隠して、入力フォームと更新ボタンをガバッと表示
                noDataMessage.style.display = 'none';
                updateFormArea.style.display = 'flex';
            } else {
                alert("該当する商品が見つかりませんでした。\n（※トマト、A001、4901234567890 などでお試しください）");
                // 見つからなければリセットしてフォームを隠す
                noDataMessage.style.display = 'flex';
                updateFormArea.style.display = 'none';
            }
        });

        // 「更新する」ボタンが押されたときの送信処理（確認アラート）
        btnSubmit.addEventListener('click', (e) => {
            e.preventDefault(); // テスト用に実際のページ遷移・送信を一旦ストップ
            
            const updatedName = formName.value;
            alert(`「${updatedName}」の商品情報を更新しました！\n（※データベース連携時にこの内容が保存されます）`);
            
            // テスト完了後に画面を綺麗にするため初期状態に戻す
            searchKeyword.value = "";
            noDataMessage.style.display = 'flex';
            updateFormArea.style.display = 'none';
        });
    </script>
</body>
</html>