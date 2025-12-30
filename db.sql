CREATE DATABASE mini_shop;

USE mini_shop;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    -- DECIMAL(10,2) 表示最多10位數字，其中2位是小數，整數部分最多8位
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    description TEXT
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255),
    customer_email VARCHAR(255),
    total DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    qty INT,
    price DECIMAL(10,2),
    subtotal DECIMAL(10,2)
);

-- 插入一些測試商品
INSERT INTO products (name, price, image, description) VALUES
('T-Shirt', 399.00, 'tshirt.jpg', '舒適棉質T恤'),
('Pants', 999.00, 'pants.jpg', '休閒長褲'),
('Shoes', 1599.00, 'shoes.jpg', '運動鞋');