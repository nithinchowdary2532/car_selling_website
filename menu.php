
<?php
include 'connect.php';


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menu</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="menu.css">
</head>

<body>
  <?php
  include 'admin_header.php'
  ?>

  <div class="heading">
     <h3>Our Cars</h3>
     <p><a href="home.php">home</a> <span> / Products</span></p>
     <button class="btn"><a style="text-decoration: none;" href="products.php">Add Product</a></button>
  </div>

  <section class="products">

     <h1 class="title">Latest Vehicles</h1>
     <div class="box-container">

        <?php
           $select_products = $conn->prepare("SELECT * FROM `products`");
           $select_products->execute();
           if($select_products->rowCount() > 0){
              while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="box">
           <form action="#" method="post" onclick="navigateToProduct(<?php echo $fetch_products['id']; ?>)">
              <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
              <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
              <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
              <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
              <img src=<?= $fetch_products['image']; ?> alt="">
              <div class="flex-container">
                 
                 <div class="price"><span>₹</span><?= $fetch_products['price']; ?></div>
                 <div class="category"><?= $fetch_products['category']; ?></div>
              </div>
              <div class="flex">
              <div class="name"><?= $fetch_products['name']; ?></div>
              </div>
           </form>
        </div>
        <?php
              }
           }else{
              echo '<p class="empty">no products added yet!</p>';
           }
        ?>

     </div>

  </section>
  <script>
    function navigateToProduct(productID) {
        window.location.href = "quick_view.php?id=" + productID;
    }
</script>

</body>
</html>
