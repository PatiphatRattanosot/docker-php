<?php
include('db.php');

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    try {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);

        echo "
        <script>
           window.location.href = 'index.php';
        </script>";
        exit();
    } catch (PDOException $e) {
        echo "<script>console.error('Delete failed: ' + '{$e->getMessage()}');</script>";
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product List</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Load SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- Navbar -->
    <nav class="bg-blue-500 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <span class="text-white text-2xl font-bold">Product Management</span>
            <a href="add_product.php" class="bg-green-500 px-4 py-2 rounded text-white">Add Product</a>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mx-auto mt-6">
        <h2 class="text-3xl font-bold mb-4">Product List</h2>

        <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 border-b">ID</th>
                    <th class="py-3 px-4 border-b">Name</th>
                    <th class="py-3 px-4 border-b">Category</th>
                    <th class="py-3 px-4 border-b">Price</th>
                    <th class="py-3 px-4 border-b">Stock</th>
                    <th class="py-3 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT * FROM products");
                $stmt->execute();
                $products = $stmt->fetchAll();

                foreach ($products as $product) {
                    echo "<tr>
                    <td class='py-3 px-4 text-center'>{$product['id']}</td>
                    <td class='py-3 px-4'>{$product['name']}</td>
                    <td class='py-3 px-4'>{$product['category']}</td>
                    <td class='py-3 px-4'>\$" . number_format($product['price'], 2) . "</td>
                    <td class='py-3 px-4'>{$product['stock_quantity']}</td>
                    <td class='py-3 px-4'>
                        <a href='edit_product.php?id={$product['id']}' class='bg-yellow-300 text-black px-2 py-1 rounded ml-2'>Edit</a>
                        <a href='#' onclick=\"confirmDelete({$product['id']})\" class='bg-red-500 text-white px-2 py-1 rounded ml-2'>Delete</a>
                    </td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript Confirm Delete -->
    <script>
        function confirmDelete(id) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Confirm Deletion',
                    text: 'Are you sure you want to delete this product?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74c3c',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `index.php?delete_id=${id}`;
                    }
                });
            } else {
                console.error('SweetAlert2 is NOT loaded');
            }
        }
    </script>

</body>

</html>