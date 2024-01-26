<?php
session_start();

include 'connect.php';

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';

if (!$user_id) {
    header('location: login.php');
    exit();
}

$select_products = $conn->prepare("SELECT * FROM `products` WHERE user_id = ?");
$select_products->execute([$user_id]);
$products = $select_products->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid black;
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
    background-color: #f2f2f2;
}

img {
    max-width: 100px;
    max-height: 100px;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    text-decoration: none;
    color: #333;
    font-weight: bold;
    font-size: 18px;
}

    </style>
</head>
<body>
    <h1>My Products</h1>

    <table border="1">
        <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Price</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><img src="product_images/<?php echo $product['image']; ?>" alt="<?php echo $product['product_name']; ?>" width="100"></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <a href="add_product.php">Add Product</a>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
