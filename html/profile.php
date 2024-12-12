<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include '../includes/header.php';
>?
<?php include '../includes/footer.php'; ?>
