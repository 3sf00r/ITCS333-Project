<?php session_start(); include '../includes/header.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
} ?>
    <tr>
            <th>Room Name</th>
            <th>Type</th>
             <th>Date</th>
             <th>Time</th>
            <th>Action</th>
    </tr>
<?php include '../includes/footer.php'; ?>
