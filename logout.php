<?php
session_start();
session_unset();
session_destroy();
if (isset($_SESSION['user_id'])) {
    $_SESSION = array();
    header("Location: home.php");
    exit();
} else {
    header("Location: home.php");
    exit();
}
?>
