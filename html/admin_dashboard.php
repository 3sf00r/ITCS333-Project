<?php session_start();
include '../includes/header.php'; 
include '../includes/db_connect.php'; 
include '../includes/functions.php';
if (!isAdmin()) {
    header('Location: index.php');
    exit;}

?>
<h2 class="text-white text-center">Admin Dashboard</h2>


	<div class=" d-flex justify-content-center">
        <a href="booked_room.php" class="btn glass-btn">booked room</a>
	<a href="booking_admin.php" class="btn glass-btn">booking</a>
	<a href="rooms.php" class="btn glass-btn">rooms</a>
	<a href="comments.php" class="btn glass-btn">comments</a>
	<a href="admin.php" class="btn glass-btn">management panel</a>
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
//past upcoming tables 
<div class="bookings-section">
        <div class="upcoming-bookings">
                <h3>Upcoming Bookings</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Room Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>
                    <tbody>
                        <?php foreach ($upcoming_bookings as $booking): ?>
                            <tr>
                                <td><?php echo $booking['room_name']; ?></td>
                                <td><?php echo date('F j, Y, g:i a', strtotime($booking['start_time'])); ?></td>
                                <td><?php echo date('F j, Y, g:i a', strtotime($booking['end_time'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
        <     /table>
    </div>
    <div class="past-bookings">
        <h3>Past Bookings</h3>
        table class="table">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($past_bookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking['room_name']; ?></td>
                        <td><?php echo date('F j, Y, g:i a', strtotime($booking['start_time'])); ?></td>
                        <td><?php echo date('F j, Y, g:i a', strtotime($booking['end_time'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
