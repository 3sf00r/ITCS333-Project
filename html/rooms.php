<?php
session_start();
include '../includes/header.php';
include '../includes/functions.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include '../includes/db_connect2.php';

$departments = fetchDepartments();
?>
<link rel="stylesheet" href="style.css">

<div class="main">

    <!-- Add Filter Form -->
    <form method="GET" action="">
        <label for="room_type">Filter by Room Type:</label>
        <select name="room_type" id="room_type">
            <option value="all">List All</option>
            <option value="class">Class</option>
            <option value="lab">Lab</option>
        </select>
        <button type="submit">Apply Filter</button>
    </form>

    <h2 class="text-white">Departments</h2>
