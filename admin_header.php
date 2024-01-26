<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            padding: 10px 20px;
            background-color:white; 
            margin-top:30px;
            margin-bottom:12px;
        }

        .nav-logo {
            font-size: 30px;
            font-weight: bold;
            color:red;
            margin-left:100px
        }

        .nav-menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            margin-right: 100px;
            font-weight:600;
        }

        .nav-menu li {
            margin: 0 10px;
        }

        .nav-menu li a {
            color: black;
            text-decoration: none;
        }

        .nav-menu li a:hover {
            text-decoration: underline;
        }
        .link{
            font-size:16px;
            padding-left:8px
        }
        .login-btn {
            background-color: red;
            color: #333;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }

        @media (max-width: 767px) {
    .navbar {
        flex-direction: column;
        text-align: center;
    }

    .nav-logo {
        margin-left: 0;
    }

    .nav-menu {
        margin-right: 0;
        margin-top: 10px;
    }

    .login-btn {
        margin-top: 10px;
    }
}
    </style>
</head>
<body>
    <div class="navbar">
        <div class="nav-logo"><i>CruiseWheels</i></div>
        <ul class="nav-menu">
            <li><a class="link" href="home.php">Home</a></li>
            <li><a class="link" href="menu.php">Products</a></li>
            <li><a class="link" href="contact.php">Contact</a></li>
            <li><a class="link" href="search.php">Search</a></li>
        <?php
        
        if (isset($_SESSION['user_id'])) {
          echo '<button class="login-btn"><a style="padding-left:0px;text-decoration: none;" href="logout.php">Logout</a></button>';
        } else {
          echo '<button class="login-btn"><a style="padding-left:0px;text-decoration: none;" href="login.php">Login</a></button>';
        }
        ?>
        </ul>
    </div>
</body>
</html>
