<?php
include 'connect.php';

session_start();

$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';

if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $pass = filter_var(sha1($_POST['pass']), FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        if ($row['STATUS']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header('location: home.php');
            exit();
        } else {
            echo 'Need to be approved by admin';
        }
    } else {
        echo 'Incorrect username or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->
</head>
<body>
    <section class="login">
        <div class="form-box">
            <div class="form-value">
                <form method="post">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                    </div>
                    <div class="inputbox">
                        <input type="password" name="pass" required placeholder="Enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                    </div>
                    <input type="submit" value="Login now" name="submit" class="btn">
                    <div class="register">
                        <p>Don't have an account? <a href="register.php">Register now</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
