<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            text-align: center;
            padding: 20px;
            background-color: #007bff;
            color: #fff;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .product-card {
            width: 300px;
            margin: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
            box-sizing: border-box;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-details {
            padding: 20px;
        }

        h2 {
            margin-top: 0;
        }

        p {
            margin: 10px 0;
        }
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #333;
    padding: 10px 20px;
}

.navbar h2, .navbar ul {
    margin: 0;
    padding: 0;
    list-style: none;
    color: #fff;
    display: inline-block;
}

.navbar ul li {
    display: inline-block;
    margin-left: 20px;
}

.navbar ul li a {
    text-decoration: none;
    color: #fff;
    font-size: 18px;
}

.navbar ul li a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
<nav class="navbar">
    <h2>Admin Dashboard</h2>
    <ul>
        <li><a href="admin_dashboard.php">Dashboard</a></li>
        <li><a href="admin_products.php">Products</a></li>
        <li><a href="all_users.php">Users</a></li>
        <li><a href="approve_users.php">Approve Users</a></li>
        <li><a href="admin_contact.php">Messages</a></li>
        <li><a href="admin_logout.php">Log Out</a></li>
    </ul>
</nav>
    <header>
        <h1>All Products</h1>
    </header>
    <div class="product-container">
        <?php
            include 'connect.php'; 
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $products = $select_products->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $product) {
                echo '<div class="product-card">';
                echo '<img class="product-image" src="../' . $product['image'] . '" alt="' . $product['name'] . '">';
                echo '<div class="product-details">';
                echo '<h2>' . $product['name'] . '</h2>';
                echo '<p>Category: ' . $product['category'] . '</p>';
                echo '<p>Price: $' . $product['price'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        ?>
    </div>
</body>
</html>
