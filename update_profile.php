<?php
include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $number = isset($_POST['number']) ? $_POST['number'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    
    $update_profile = $conn->prepare("UPDATE `users` SET name = ?, number = ?, email = ? WHERE id = ?");
    $update_profile->execute([$name, $number, $email, $user_id]);
    
    header('location:profile.php'); // Redirect to the profile page after updating
}

$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="profile.css">

</head>
<body>
   <?php include 'admin_header.php'; ?>

   <section class="user-details">
      <div class="user">
         <form method="POST" action="">
            <p><i class="fas fa-user"></i><span><input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required style="width: 300px;"></span></p>
            <p><i class="fas fa-phone"></i><span><input type="text" name="number" value="<?= $fetch_profile['number']; ?>" required style="width: 300px;"></span></p>
            <p><i class="fas fa-envelope"></i><span><input type="email" name="email" value="<?= $fetch_profile['email']; ?>" required style="width: 300px;"></span></p>
            <button type="submit" class="btn" style="margin-left:0px">Update Info</button>
         </form>
      </div>
   </section>

   <script src="js/script.js"></script>
</body>
</html>
