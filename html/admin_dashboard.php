<?php session_start();
include '../includes/db_connect.php'; 
include '../includes/header.php'; 
?>
<div class="navbar">
    <a href="booked_room.php" class="navbar-link">Booked Room</a>
    <a href="booking_normal.php" class="navbar-link">Booking</a>
    <a href="rooms.php" class="navbar-link">Rooms</a>
    <a href="comments.php" class="navbar-link">Comments</a>
</div>

<?php 
        if (!isset($_SESSION['user_id'])) {
                header("Location: login.php");
                exit();
            }

        $user_id = $_SESSION['user_id'];
//for upcomming
        $stmt = $pdo->prepare("SELECT b.id, r.name AS room_name, b.start_time, b.end_time
                FROM bookings b
                JOIN rooms r ON b.room_id = r.id
                WHERE b.status = 'booked' AND b.user_id = ? AND start_time > NOW()
                ORDER BY start_time ASC");
        $stmt->execute([$user_id]);
        $upcoming_bookings = $stmt->fetchAll();
//for past bookings
        $stmt = $pdo->prepare("SELECT b.id, r.name AS room_name, b.start_time, b.end_time
                           FROM bookings b
                           JOIN rooms r ON b.room_id = r.id
                           WHERE b.status = 'booked' AND b.user_id = ? AND start_time <= NOW()
                           ORDER BY start_time DESC");
        $stmt->execute([$user_id]);
        $past_bookings = $stmt->fetchAll();
?>
