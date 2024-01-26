<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Admin Approval</title>
</head>
<body>
<div class="center">
    <h1>User Register</h1>
    <table id="users">
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email Address</th>
            <th>Action</th>
        </tr>
        <?php
        
        $query = "SELECT * FROM sers WHERE status = 'pending' ORDER BY id ASC";
        
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email_address']; ?></td>
                <td>
                    <form action="admin-approval.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="approve" value="Approve">
                        <input type="submit" name="deny" value="Deny">
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>

<?php
if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $select = "UPDATE tbl_users SET status='approved' WHERE id = '$id'";
    $result = mysqli_query($conn, $select);
    if ($result) {
        echo '<script type="text/javascript">';
        echo 'alert("User Approved!");';
        echo 'window.location.href = "admin.php"';
        echo '</script>';
    } else {
        echo "Error updating user status: " . mysqli_error($conn);
    }
}

if (isset($_POST['deny'])) {
    $id = $_POST['id'];
    $select = "DELETE FROM tbl_users WHERE id = '$id'";
    $result = mysqli_query($conn, $select);
    if ($result) {
        echo '<script type="text/javascript">';
        echo 'alert("User Denied!");';
        echo 'window.location.href = "admin.php"';
        echo '</script>';
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}
?>
</body>
</html>
