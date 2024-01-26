<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $query = "UPDATE users SET STATUS = 1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$userId]);

    header('location: approve_users.php');
    exit();
}

$query = "SELECT id, name, email,number FROM users WHERE STATUS = 0";
$stmt = $conn->prepare($query);
$stmt->execute();
$unapprovedUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>approve users</title>
    <script src="https://kit.fontawesome.com/d7cff5fbbc.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="approve_users.css" />
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


    <h1 class="text-center mt-4">Admin Approve Users</h1>

    <div class="container mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($unapprovedUsers as $user) : ?>
                <tr>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['number']; ?></td>
                    <td>
                        <a href="approve_users.php?id=<?php echo $user['id']; ?>" class="btn btn-success">Approve</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>