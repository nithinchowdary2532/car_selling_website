<?php
include 'connect.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $messageContent = $_POST['message'];
    $insert_message = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)");
    $insert_message->bindParam(':name', $name, PDO::PARAM_STR);
    $insert_message->bindParam(':email', $email, PDO::PARAM_STR);
    $insert_message->bindParam(':message', $messageContent, PDO::PARAM_STR);

    if ($insert_message->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 600px; /* Set the maximum width for the form */
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label,
        textarea,
        input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            font-size: 16px;
        }

        label {
            font-weight: bold;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        input[type="submit"] {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        input,
        textarea {
            border: 1px solid #ccc;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #007bff;
        }

        .message {
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include 'admin_header.php'?>

    <h1>Contact Us</h1>

    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
