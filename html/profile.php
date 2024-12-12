<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include '../includes/header.php';
include '../includes/db_connect.php';

// getting user data from the database

?>

    <title>Profile</title>
<div class="mainprofile"> 
<h2>Your Profile</h2>



        <div class=" image d-flex flex-column justify-content-center align-items-center"> 



 
<?php include '../includes/footer.php'; ?>
