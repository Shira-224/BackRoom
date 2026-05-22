<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録画面 - バックルームコンピューター</title>
    <link rel="stylesheet" href="style/newcontent.css">
</head>
<body>
    <div class="main-container">
        <form action="#" method="POST">
            
            <div class="top-section">
                <a href="in_out_updt.php" class="btn-back">戻る</a>
                <a href="update.php" class="btn-menu">更新メニューへ</a>
            </div>
            
            <div class="form-grid">
                
                <div class="form-group">
                    <label>商品名</label>
                    <input type="text" name="product_name" placeholder="商品名を入力">
                </div>
                
                <div class="form-group">
                    <label>バーコード番号</label>
                    <input type="text" name="barcode_number" placeholder="バーコード番号">
                </div>
                
                <div class="form-group">
                    <label>商品ID</label>
                    <input type="text" name="product_id" placeholder="商品ID">
                </div>
                
                <div class="form-group">
                    <label>在庫数</label>
                    <input type="number" name="stock_count" placeholder="0" min="0">
                </div>

                <div class="form-group">
                    <label>単価</label>
                    <input type="number" name="price" placeholder="0" min="0">
                </div>
                
                <div class="form-group">
                    <label>税率</label>
                    <select name="tax_rate">
                        <option value="8">8% (軽減税率)</option>
                        <option value="10">10% (標準税率)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>ジャンル</label>
                    <select name="genre">
                        <option value="野菜">野菜</option>
                        <option value="肉・魚">肉・魚</option>
                        <option value="飲料">飲料</option>
                        <option value="食品">食品</option>
                        <option value="その他">その他</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>バーコードの有無</label>
                    <select name="barcode_status">
                        <option value="有り">有り</option>
                        <option value="無し">無し</option>
                    </select>
                </div>
                
            </div>

            <div class="bottom-btn-wrapper">
                <button type="submit" class="btn-submit-large">更新する</button>
            </div>
            
        </form>
    </div>
</body>
</html>