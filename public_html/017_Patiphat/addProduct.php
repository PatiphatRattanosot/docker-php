<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'connectDB.php';

    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $attributes = $_POST['attributes'];
    $stock_quantity = $_POST['stock_quantity'];

    $attributes = json_encode(explode(",", $attributes)); 

    if (empty($name) || empty($price) || empty($stock_quantity)) {
        echo "กรุณากรอกข้อมูลที่จำเป็นทั้งหมด!";
        exit;
    }

    try {
        $sql = "INSERT INTO products (name, category, price, description, image_url, attributes, stock_quantity) 
                VALUES (:name, :category, :price, :description, :image_url, :attributes, :stock_quantity)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':attributes', $attributes);
        $stmt->bindParam(':stock_quantity', $stock_quantity);

        $stmt->execute();

        echo "เพิ่มสินค้าเรียบร้อยแล้ว!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
