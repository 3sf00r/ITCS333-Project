<?php
session_start();
include '../includes/db_connect.php';
include '../includes/functions.php';
include '../includes/header.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

$departments = fetchDepartments();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    header('Location: admin.php');
    exit;
}
?>

    <title>Add Room by Department</title>
    <div class="main">
        <h2>Add Room</h2>
