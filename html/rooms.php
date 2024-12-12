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
