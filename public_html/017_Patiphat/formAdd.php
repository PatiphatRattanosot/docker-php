<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสินค้า</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[type="url"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #fafafa;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="url"]:focus,
        select:focus,
        textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        textarea {
            resize: vertical;
            height: 120px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-container p {
            font-size: 14px;
            text-align: center;
            color: #666;
        }

        .form-container p a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form-container p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    
    <div class="form-container">
        <h1>เพิ่มสินค้า</h1>
        <form action="addProduct.php" method="POST">
            <label for="name">ชื่อสินค้า:</label>
            <input type="text" id="name" name="name" required>

            <label for="category">หมวดหมู่สินค้า:</label>
            <input type="text" id="category" name="category">

            <label for="price">ราคา:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="description">คำอธิบายสินค้า:</label>
            <textarea id="description" name="description"></textarea>

            <label for="image_url">URL รูปภาพ:</label>
            <input type="url" id="image_url" name="image_url">

            <label for="attributes">คุณสมบัติเฉพาะ:</label>
            <select id="attributes" name="attributes">
                <option value="size_m">ขนาด M</option>
                <option value="size_l">ขนาด L</option>
                <option value="color_red">สีแดง</option>
                <option value="color_blue">สีน้ำเงิน</option>
                <option value="material_cotton">วัสดุผ้าฝ้าย</option>
                <option value="material_silk">วัสดุผ้าไหม</option>
            </select>

            <label for="stock_quantity">จำนวนในสต็อก:</label>
            <input type="number" id="stock_quantity" name="stock_quantity" required>

            <button type="submit" name="submit">เพิ่มสินค้า</button>
        </form>
    </div>
</body>
</html>
