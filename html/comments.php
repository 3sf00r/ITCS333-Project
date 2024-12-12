<?php session_start(); include '../includes/header.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
} ?>
<?php include '../includes/footer.php'; ?>
