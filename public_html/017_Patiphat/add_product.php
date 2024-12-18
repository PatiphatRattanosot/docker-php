<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $attributes = $_POST['attributes'];
    $stock_quantity = $_POST['stock_quantity'];

    if ($price < 0 || $stock_quantity < 0) {
        echo "<script>
                window.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Price and Stock Quantity cannot be negative!',
                        icon: 'error'
                    });
                });
              </script>";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO products (name, category, price, description, attributes, stock_quantity) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $category, $price, '', $attributes, $stock_quantity]);


    header("Location: add_product.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Product</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Load SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- SweetAlert Success Notification -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Product added successfully!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>
    <?php endif; ?>

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Add New Product</h2>

        <form method="POST" class="space-y-6" onsubmit="return validateForm()">
            <input type="text" name="name" placeholder="Product Name" required class="w-full rounded-lg border-gray-300 p-3">
            <input type="text" name="category" placeholder="Category" required class="w-full rounded-lg border-gray-300 p-3">
            <input type="number" step="0.01" name="price" placeholder="Price" min="0" required class="w-full rounded-lg border-gray-300 p-3">
            <input type="text" name="attributes" placeholder="Attributes" class="w-full rounded-lg border-gray-300 p-3">
            <input type="number" name="stock_quantity" placeholder="Stock Quantity" min="0" required class="w-full rounded-lg border-gray-300 p-3">
            <button type="submit" class="w-full bg-blue-500 text-white rounded-lg py-3 mt-2">
                Add Product
            </button>
        </form>
    </div>

    <script>
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 is NOT loaded');
        } else {
            console.log('SweetAlert2 successfully loaded');
        }

        function validateForm() {
            const price = parseFloat(document.getElementsByName('price')[0].value);
            const stockQuantity = parseInt(document.getElementsByName('stock_quantity')[0].value);

            if (price < 0 || stockQuantity < 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Price and Stock Quantity must be positive values!',
                    icon: 'error'
                });
                return false;
            }
            return true;
        }
    </script>
</body>

</html>