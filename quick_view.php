<?php
include 'connect.php';

if (isset($_GET['id'])) {
   
   $productID = $_GET['id'];

    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = :product_id");
    $select_product->bindParam(':product_id', $productID, PDO::PARAM_INT);
    $select_product->execute();


    if ($select_product->rowCount() > 0) {
        $product_details = $select_product->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Product not found.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="quick_view.css">

</head>
<body>
<?php include 'admin_header.php'; ?>
    <h1>Product Details</h1>
    <div class="product-details">
    <div class="image-container">
        <img src="<?= $product_details['image']; ?>" alt="<?= $product_details['name']; ?>" class="product-image">
    </div>
    <div class="text-container">
        <div class="details">
            <h2 class="carname" ><?= $product_details['name']; ?></h2>
            <p>Company Name: <?= $product_details['category']; ?></p>
            <p>Fuel: <?= $product_details['fuel']; ?></p>  
            <p>Variant: <?= $product_details['variant']; ?></p>
            <p>kilometers travelled: <?= $product_details['condition']; ?></p>  
            <p>Manufacturing Year: <?= $product_details['year']; ?></p>
            <p>Price: <?= $product_details['price']; ?></p> 
            <button class="btn" ><a href="user_details.php?user_id=<?= $product_details['user_id']; ?>">Get Contact Details</a></button>
        </div>
    </div>
    </div>
</body>
</html>
