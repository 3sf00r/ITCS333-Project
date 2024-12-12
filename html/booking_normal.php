<?php
session_start();
include '../includes/header.php';
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {}

$error = '';

$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email']; 
$room_id = $_POST['room_id'];
$start_date = $_POST['start_date'];
$start_time = $_POST['start_time'];

  
  ?>

<div class="container">
<h2>Book a Room</h2>
<div class="main2">
    <h2>Room Filter</h2>
    <form name="filterform" id="filterForm" action="" method="post">
        <div class="form-group">
            <label for="department_id">Select Department:</label>
            <select name="department_id" id="department_id" class="select" onchange="toggletype()">
                <option value="">-- Select a department --</option>


            </select>
        </div>
      <div class="form-group">
            <label for="list_all">List All Rooms:</label>
            <input type="checkbox" name="list_all" id="list_all">
        </div>

        <button type="submit" name="filter" class="glass-btn">Filter</button>
    </form>
</div>
</div>

<?php include '../includes/footer.php'; ?>
