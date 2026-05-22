<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品削除画面 - バックルームコンピューター</title>
    <link rel="stylesheet" href="style/delete.css">
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
            <input type="text" id="search-keyword" class="search-input" placeholder="検索キーワードを入力してください">
            <button type="button" id="btn-search" class="btn-search">検索</button>
        </div>
        
        <div class="detail-section">
            <div id="no-data-message" class="no-data-msg">
                上の検索窓から商品を検索してください。ここに商品の詳細が表示されます。
            </div>
            
            <div id="detail-grid" class="detail-grid" style="display: none;">
                <div class="grid-header">商品名</div>
                <div class="grid-header">バーコード</div>
                <div class="grid-header">商品ID</div>
                <div class="grid-header">単価</div>
                <div class="grid-header">税込み</div>
                <div class="grid-header">ジャンル</div>
                
                <div id="val-name" class="grid-value">-</div>
                <div id="val-barcode" class="grid-value">-</div>
                <div id="val-id" class="grid-value">-</div>
                <div id="val-price" class="grid-value">-</div>
                <div id="val-taxin" class="grid-value">-</div>
                <div id="val-genre" class="grid-value">-</div>
            </div>
        </div>
        
        <div class="bottom-section">
            <button type="button" id="btn-delete" class="btn-delete" disabled>削除する</button>
        </div>

    </div>

    <script>
        // テスト用のダミー商品データ（データベースの代わり）
        const mockProducts = [
            { name: "トマト", barcode: "4901234567890", id: "A001", price: "150円", taxin: "162円", genre: "野菜" },
            { name: "国産牛ミニステーキ", barcode: "4901111222222", id: "B055", price: "1,280円", taxin: "1,382円", genre: "肉・魚" },
            { name: "緑茶 500ml", barcode: "4902222333333", id: "C102", price: "100円", taxin: "108円", genre: "飲料" },
            { name: "ポテトチップス", barcode: "4903333444444", id: "D201", price: "120円", taxin: "130円", genre: "食品" }
        ];

        // HTML要素の取得
        const searchType = document.getElementById('search-type');
        const searchKeyword = document.getElementById('search-keyword');
        const btnSearch = document.getElementById('btn-search');
        const noDataMessage = document.getElementById('no-data-message');
        const detailGrid = document.getElementById('detail-grid');
        
        const valName = document.getElementById('val-name');
        const valBarcode = document.getElementById('val-barcode');
        const valId = document.getElementById('val-id');
        const valPrice = document.getElementById('val-price');
        const valTaxin = document.getElementById('val-taxin');
        const valGenre = document.getElementById('val-genre');
        
        const btnDelete = document.getElementById('btn-delete');

        // 「検索」ボタンが押されたときの処理
        btnSearch.addEventListener('click', () => {
            const type = searchType.value;
            const keyword = searchKeyword.value.trim();
            
            if (!keyword) {
                alert("キーワードを入力してください。");
                return;
            }
            
            // 選択されたプルダウンのタイプに応じてデータを検索
            const foundProduct = mockProducts.find(product => {
                if (type === 'name') return product.name === keyword;
                if (type === 'id') return product.id === keyword;
                if (type === 'barcode') return product.barcode === keyword;
                return false;
            });
            
            if (foundProduct) {
                // 見つかったらグリッドに値をハメ込んで表示する
                valName.textContent = foundProduct.name;
                valBarcode.textContent = foundProduct.barcode;
                valId.textContent = foundProduct.id;
                valPrice.textContent = foundProduct.price;
                valTaxin.textContent = foundProduct.taxin;
                valGenre.textContent = foundProduct.genre;
                
                noDataMessage.style.display = 'none';
                detailGrid.style.display = 'grid';
                btnDelete.disabled = false; // 削除ボタンを押せるようにする
            } else {
                alert("該当する商品が見つかりませんでした。\n（※トマト、A001、4901234567890 などでお試しください）");
                // リセットして非表示に戻す
                noDataMessage.style.display = 'block';
                detailGrid.style.display = 'none';
                btnDelete.disabled = true;
            }
        });

        // 「削除する」ボタンが押されたときの処理（確認画面）
        btnDelete.addEventListener('click', () => {
            const productName = valName.textContent;
            
            // ブラウザの確認ダイアログ（ポップアップ）を出す
            const isConfirmed = confirm(`本当に「${productName}」を削除してもよろしいですか？\n※この操作は取り消せません。`);
            
            if (isConfirmed) {
                alert(`「${productName}」を削除しました（※モック動作です）。`);
                
                // 削除した風に見せるため、画面を初期状態に戻す
                searchKeyword.value = "";
                noDataMessage.style.display = 'block';
                detailGrid.style.display = 'none';
                btnDelete.disabled = true;
            }
        });
    </script>
</body>
</html>