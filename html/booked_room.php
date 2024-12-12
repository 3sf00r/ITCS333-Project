<?php session_start(); include '../includes/header.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
} ?>
    <div class="main">
    <h2>Booked Room Details</h2>

    <?php 
        $user_email = $_SESSION['user_email'];
        $user_id = $_SESSION['user_id'];

    ?>


        <table class="table">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
<?php include '../includes/footer.php'; ?>
