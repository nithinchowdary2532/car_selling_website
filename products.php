   <?php
   session_start();
   include 'connect.php';

   if (!isset($_SESSION['user_id'])) {
      header('Location: login.php');
      exit();
  }

   $image_folder = 'images/';
   if(isset($_POST['add_product'])){
      $name = isset($_POST['name']) ? $_POST['name'] : '';
      $price = isset($_POST['price']) ? $_POST['price'] : '';
      $category = isset($_POST['category']) ? $_POST['category'] : '';
      $variant = isset($_POST['variant']) ? $_POST['variant'] : '';
      $fuel = isset($_POST['fuel']) ? $_POST['fuel'] : '';
      $year = isset($_POST['year']) ? $_POST['year'] : '';
      $condition = isset($_POST['condition']) ? $_POST['condition'] : '';
      

      $image = $_FILES['image']['name'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = ''.$image;

      $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
      $select_products->execute([$name]);

      if($select_products->rowCount() > 0){
         echo 'Product name already exists!';
      }else{
         if($image_size > 2000000){
            echo 'Image size is too large';
         }else{
            $image_path = $image_folder . $image;
            if (move_uploaded_file($image_tmp_name, $image_path)) {
               if(isset($_SESSION['user_id'])) {
                  $user_id = $_SESSION['user_id'];
                  $insert_product = $conn->prepare("INSERT INTO `products` (user_id, name, category, price, variant, fuel, `year`, `condition`, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                  $insert_product->execute([$user_id, $name, $category, $price, $variant, $fuel, $year, $condition, $image_path]);  
                  echo 'New product added!';
               } else {
                  echo 'User not logged in!';
               }
            } else {
               echo 'Failed to upload image.';
            }
         }
      }
   }

   if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $delete_product_image->execute([$delete_id]);
      $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);

      if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $fetch_delete_image['user_id']) {
         unlink($fetch_delete_image['image']);
         $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
         $delete_product->execute([$delete_id]);
         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
         $delete_cart->execute([$delete_id]);
         $delete_cart = $conn->prepare(" SET  @num := 0;UPDATE products SET id = @num := (@num+1);ALTER TABLE `products` AUTO_INCREMENT = 1");
         header('location:products.php');
      } else {
         echo 'You do not have permission to delete this product.';
      }
   }
   ?>


   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Products</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
      <link rel="stylesheet" href="admin_styless.css">
   </head>
   <body>
      <?php
      include 'admin_header.php'
      ?>
   <section class="add-products">
      <form action="" method="POST" enctype="multipart/form-data">
         <h3>Add Product</h3>
         <select name="category" class="box" required>
            <option value="" disabled selected>Select Company name --</option>
            <option value="Suzuki">Suzuki</option>
            <option value="Ford">Ford</option>
            <option value="Volkswagen">Volkswagen</option>
            <option value="Honda">Honda</option>
            <option value="Toyota">Toyota</option>
            <option value="Nissan">Nissan</option>
            <option value="Hyundai">Hyundai</option>
            <option value="Audi">Audi</option>
            <option value="Ferrari">Ferrari</option>
            <option value="Mahindra">Mahindra</option>
         </select>
         <input type="text" required placeholder="Enter Car name" name="name" maxlength="100" class="box">
         <select name="variant" class="box" required>
            <option value="" disabled selected>Car Variants</option>
            <option value="hatchback">Hatchback</option>
            <option value="sedan">Sedan</option>
            <option value="SUV">SUV</option>
            <option value="Luxury">Luxury</option>
            <option value="Hybrid">Hybrid</option>
         </select>
         <select name="fuel" class="box" required>
            <option value="" disabled selected>Select Fuel Variant</option>
            <option value="Petrol">Petrol</option>
            <option value="Diesel">Diesel</option>
            <option value="Others">LPG/CNG</option>
         </select>
         <input type="number" required placeholder="Manufacturing Year" name="year" maxlength="4" class="box"  >
         <input type="number" required placeholder="Kilometers travelled" name="condition" class="box">
         <input type="number" min="0" max="9999999999" required placeholder="Enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
         <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
         <input type="submit" value="Add Product" name="add_product" class="btn" style="margin-left:0px;font-size:20px">
      </form>
   </section>
   <section class="show-products" style="padding-top: 0;">
   <div class="box-container">
   <?php
   if(isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      $show_products = $conn->prepare("SELECT * FROM `products` WHERE user_id = ?");
      $show_products->execute([$user_id]);

      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box">
            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
              <img src=<?= $fetch_products['image']; ?> alt="">
               <div class="flex">
                  <div class="price"><span>₹</span><?= $fetch_products['price']; ?><span>/-</span></div>
                  <div class="category"><?= $fetch_products['category']; ?></div>
               </div>
               <div class="name"><?= $fetch_products['name']; ?></div>
               <div class="flex-btn">
               <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn" style="text-decoration:none" >update</a>
               <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');" style="text-decoration:none">delete</a>
               </div>
            </div>
            <?php
         }
      }else{
         echo '<p class="empty">No products added yet!</p>';
      }
   } else {
      echo '<p class="empty">Please log in to view your products.</p>';
   }
   ?>
   </div>
   </section>
   </body>
   </html>