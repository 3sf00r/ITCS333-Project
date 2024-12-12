<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit();
}
include '../includes/db_connect.php';

$booking_id = $_POST['id'];

$stmt = $pdo->prepare("UPDATE bookings SET status = 'canceled' WHERE id = :id AND user_id = :user_id");

$stmt->bindParam(':id', $booking_id);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "<div class='alert alert-success'>Booking cancelled successfully.</div>";
} else {
    echo "<div class='alert alert-danger'>Failed to cancel booking. Please try again later.</div>";
}

header('Location: booked_room.php');
exit();
?>
