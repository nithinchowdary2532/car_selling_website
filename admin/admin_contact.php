<?php
include 'connect.php';
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];

    $delete_message = $conn->prepare("DELETE FROM messages WHERE id = :id");
    $delete_message->bindParam(':id', $deleteId, PDO::PARAM_INT);
    $delete_message->execute();
    header("Location: admin_contact.php");
    exit;
}

$select_messages = $conn->query("SELECT * FROM messages");
$messages = $select_messages->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Contact Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
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


        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .done-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
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
    <h1>Admin Contact Messages</h1>

    <?php if (count($messages) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><?= $message['id']; ?></td>
                        <td><?= $message['name']; ?></td>
                        <td><?= $message['email']; ?></td>
                        <td><?= $message['message']; ?></td>
                        <td>
                            <a href="admin_contact.php?delete=<?= $message['id']; ?>" class="done-button">Done</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No messages found.</p>
    <?php endif; ?>
</body>
</html>
