<?php
session_start();
include '../includes/db_connect2.php'; 
include '../includes/functions.php'; 
include '../includes/header.php'; 

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}
?>


    <div class="container">
        <h2>Welcome to the Admin Dashboard</h2>
        <a href="delete_rooms.php" class="glass-btn">delete Rooms</a>
        <a href="add_room.php" class="glass-btn">add Rooms</a>comments</a>
        <a href="analytics.php" class="glass-btn">Analytics</a>
    </div>
<?php include '../includes/footer.php'; ?>
