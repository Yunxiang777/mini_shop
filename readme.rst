# CodeIgniter 3 小型商城範例

一個使用 CodeIgniter 3 + MySQL 實現的簡易線上商城，適合學習、練習或作為小型專案的起點。

## 功能特色

📦 商品列表展示（從資料庫動態讀取）
🛒 加入購物車、調整數量、移除商品、清空購物車
💾 使用 CodeIgniter 內建 Cart Library（購物車資料基於 Session 儲存）
💳 簡單結帳流程（填寫姓名與 Email，訂單與訂單明細自動存入資料庫）
🎨 共用 Header 與 Footer（Header 顯示即時購物車商品數量）
📱 響應式版面（引入 Bootstrap 4）
## 專案畫面預覽

![小型商城預覽圖](screenshot.png)

> 圖片說明：上方為商品列表頁面，下方為購物車與結帳流程

## 環境需求

PHP 7.2 或以上版本
MySQL 5.7 或以上版本
Apache/Nginx 網頁伺服器
CodeIgniter 3.x
## 安裝步驟

### 1. 下載專案

`bash
git clone https://github.com/your-username/mini_shop.git
cd mini_shop
`

### 2. 資料庫設定

建立資料庫 mini_shop：

`sql
CREATE DATABASE mini_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
`

執行以下 SQL 建立表格並插入測試資料：

``sql -- 商品表 CREATE TABLE `products (

id int(11) NOT NULL AUTO_INCREMENT, name varchar(255) NOT NULL, price decimal(10,2) NOT NULL, description text, created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 訂單表 CREATE TABLE orders (

id int(11) NOT NULL AUTO_INCREMENT, customer_name varchar(100) NOT NULL, customer_email varchar(100) NOT NULL, total_amount decimal(10,2) NOT NULL, created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 訂單明細表 CREATE TABLE order_items (

id int(11) NOT NULL AUTO_INCREMENT, order_id int(11) NOT NULL, product_id int(11) NOT NULL, product_name varchar(255) NOT NULL, quantity int(11) NOT NULL, price decimal(10,2) NOT NULL, PRIMARY KEY (id), KEY order_id (order_id), CONSTRAINT order_items_ibfk_1 FOREIGN KEY (order_id) REFERENCES orders (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 插入測試商品 INSERT INTO products (name, price, description) VALUES ('筆記型電腦', 25000.00, '輕薄高效能筆電，適合辦公與娛樂'), ('無線滑鼠', 599.00, '人體工學設計，2.4GHz 無線連接'), ('機械式鍵盤', 2990.00, '青軸機械鍵盤，RGB 背光'), ('27吋顯示器', 8900.00, 'Full HD IPS 面板，支援 HDMI'), ('藍牙耳機', 1590.00, '主動降噪，續航力 30 小時'); ```

### 3. 設定 CodeIgniter

編輯 application/config/database.php：

```php $db['default'] = array(

'hostname' => 'localhost', 'username' => 'root', // 修改為你的資料庫使用者名稱 'password' => '', // 修改為你的資料庫密碼 'database' => 'mini_shop', 'dbdriver' => 'mysqli', // ... 其他設定保持預設
);
編輯 application/config/config.php：

`php
$config['base_url'] = 'http://localhost/mini_shop/';  // 修改為你的網址
$config['encryption_key'] = 'your_random_encryption_key_here';  // 設定加密金鑰
`

### 4. 啟動專案

將專案放置於網頁伺服器目錄（如 XAMPP 的 htdocs），然後訪問：

`
http://localhost/mini_shop/
`

## 主要路由

路由 | 說明 |
|------|------| | / | 首頁 / 商品列表 | | /shop/add_to_cart/{商品ID} | 加入購物車 | | /cart | 購物車頁面 | | /shop/checkout | 結帳頁面 | | /shop/process_checkout | 處理結帳 |

## 專案結構

`
mini_shop/
├── application/
│   ├── controllers/
│   │   └── Shop.php          # 主要商城控制器
│   ├── models/
│   │   └── Product_model.php # 商品模型
│   ├── views/
│   │   ├── header.php        # 共用頁首
│   │   ├── footer.php        # 共用頁尾
│   │   ├── products.php      # 商品列表頁面
│   │   ├── cart.php          # 購物車頁面
│   │   └── checkout.php      # 結帳頁面
│   └── config/
│       ├── database.php      # 資料庫設定
│       └── routes.php        # 路由設定
└── README.md
`

## 後續可擴充功能建議

[ ] 會員註冊與登入系統
[ ] 購物車資料庫儲存（支援跨裝置與關閉瀏覽器後保留）
[ ] 商品圖片上傳功能
[ ] 商品分類、搜尋、分頁
[ ] 整合線上金流（藍新、綠界等）
[ ] 後台訂單管理系統
[ ] 商品庫存管理
[ ] 優惠券與促銷活動
[ ] 會員等級與紅利點數
## 常見問題

Q: 購物車資料會保留多久？ A: 購物車使用 Session 儲存，瀏覽器關閉後資料會消失。若需持久化儲存，建議改用資料庫儲存購物車資料。

Q: 如何修改商品資料？ A: 目前需直接在資料庫中修改 products 表格。建議未來新增後台管理功能。

Q: 遇到 404 錯誤怎麼辦？ A: 檢查 .htaccess 是否正確設定，以及 Apache 是否啟用 mod_rewrite 模組。

## 授權

本專案僅供學習與個人使用，歡迎自由修改與擴充。

## 貢獻

歡迎提交 Issue 或 Pull Request 來改善此專案！

---

開發者: Your Name 最後更新: 2025-12-30