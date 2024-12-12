<?php session_start();

$sql = "SELECT * FROM bookings WHERE user_id = ? AND start_time > NOW() ORDER BY start_time ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bind_param('user_id', $user_id);
        $stmt->execute();
        $upcoming_bookings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT * FROM bookings WHERE user_id = ? AND start_time <= NOW() ORDER BY start_time DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('user_id', $user_id);
        $stmt->execute();
        $past_bookings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<div class="navbar">
    <a href="booking_normal.php" class="navbar-link">Booking</a>
    <a href="rooms.php" class="navbar-link">Rooms</a>
</div>
</head>
<body>
        <?php
if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
?>

<div class="row">
<div class="col-md-6">
        <h3>Upcoming Bookings</h3>
            <ul>
                <?php foreach ($upcoming_bookings as $booking): ?>
                    <li><?php echo $booking['room_name']; ?> - Date: <?php echo date('F j, Y', strtotime($booking['start_time'])); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
<div class="col-md-6">
        <h3>Past Bookings</h3>
            <ul>
                <?php foreach ($past_bookings as $booking): ?>
                    <li><?php echo $booking['room_name']; ?> - Date: <?php echo date('F j, Y', strtotime($booking['start_time'])); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
</body>
<?php include '../includes/footer.php'; ?>
