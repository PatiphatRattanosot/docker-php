-- สร้างฐานข้อมูล (หากยังไม่มี)
CREATE DATABASE IF NOT EXISTS shopDB;

-- ใช้งานฐานข้อมูลที่สร้างขึ้น
USE shopDB;

-- สร้างตาราง products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    attributes JSON,
    stock_quantity INT NOT NULL
);
