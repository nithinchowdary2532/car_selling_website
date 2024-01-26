<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Contact Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        p {
            margin: 10px 0;
            color: #555;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include 'connect.php';
        if (isset($_GET['user_id'])) {
            $userId = $_GET['user_id'];
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = :user_id");
            $select_user->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $select_user->execute();

            if ($select_user->rowCount() > 0) {
                $user_details = $select_user->fetch(PDO::FETCH_ASSOC);

                // Display user contact details
                echo "<h1>User Contact Details</h1>";
                echo "<p>Name: " . htmlspecialchars($user_details['name']) . "</p>";
                echo "<p>Email: " . htmlspecialchars($user_details['email']) . "</p>";
                echo "<p>Number: " . htmlspecialchars($user_details['number']) . "</p>";
            } else {
                echo "<p>User not found.</p>";
            }
        } else {
            echo "<p>User ID not provided.</p>";
        }
        ?>
    </div>  
</body>
</html>
