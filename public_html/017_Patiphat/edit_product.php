<?php
include('db.php');

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Product not found!',
                icon: 'error'
            }).then(() => window.location.href = 'index.php');
          </script>";
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>

    <!-- Load Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Load SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-lg w-full mx-4">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Edit Product</h2>

        <!-- Edit Product Form -->
        <form method="POST" class="space-y-6">
            <!-- Product Name -->
            <input type="text" name="name" placeholder="Product Name" value="<?= htmlspecialchars($product['name']) ?>"
                class="w-full rounded-lg border-gray-300 p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <!-- Category -->
            <input type="text" name="category" placeholder="Category" value="<?= htmlspecialchars($product['category']) ?>"
                class="w-full rounded-lg border-gray-300 p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-green-500">

            <!-- Price -->
            <input type="number" step="0.01" name="price" placeholder="Price" value="<?= htmlspecialchars($product['price']) ?>"
                class="w-full rounded-lg border-gray-300 p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">

            <!-- Attributes -->
            <input type="text" name="attributes" placeholder="Attributes" value="<?= htmlspecialchars($product['attributes']) ?>"
                class="w-full rounded-lg border-gray-300 p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-purple-500">

            <!-- Stock Quantity -->
            <input type="number" name="stock_quantity" placeholder="Stock Quantity" value="<?= htmlspecialchars($product['stock_quantity']) ?>"
                class="w-full rounded-lg border-gray-300 p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-red-500">

            <!-- Save Changes Button -->
            <button type="submit"
                class="w-full bg-blue-500 text-white font-bold py-2 rounded-lg mt-4 shadow hover:bg-blue-600 focus:outline-none">
                Save Changes
            </button>
        </form>
    </div>

</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $attributes = $_POST['attributes'];
    $stock_quantity = $_POST['stock_quantity'];

    $update = $conn->prepare("UPDATE products SET name=?, category=?, price=?, attributes=?, stock_quantity=? WHERE id=?");
    $update->execute([$name, $category, $price, $attributes, $stock_quantity, $id]);

    echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Product updated successfully!',
                icon: 'success'
            }).then(() => window.location.href = 'index.php');
          </script>";
    exit();
}
?>