<?php
session_start();
include '../includes/db_connect2.php'; 
include '../includes/functions.php'; 
include '../includes/header.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['delete_room'])) {
    deleteRoom($_POST['delete_room']);
    header('Location: delete_rooms.php');
    exit;
}
?>
