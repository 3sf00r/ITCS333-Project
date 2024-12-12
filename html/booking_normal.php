<?php
session_start();
include '../includes/header.php';
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {}

$error = '';

$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];  
  
  ?>

<div class="container">
<h2>Book a Room</h2>

</div>

<?php include '../includes/footer.php'; ?>
