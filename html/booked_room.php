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

        function getBookingDetails($user_id) {
            include '../includes/db_connect.php';
            $stmt = $pdo->prepare("SELECT b.id, r.name AS room_name, b.start_time, b.end_time, b.status ,r.type FROM bookings b JOIN rooms r ON b.room_id = r.id WHERE b.user_id = :user_id AND b.status = 'booked'");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                echo "<div class='alert alert-warning'>No booked room found for this user.</div>";
                return false;
            }
        }

        // use the above fun to get the bookings array
        $bookings = getBookingDetails($user_id); 
    ?>

    <?php if ($bookings): ?>
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
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['room_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['type']); ?></td>
                        <td><?php echo date('F j, Y', strtotime($booking['start_time'])); ?></td>
                        <td><?php echo date('g:i a', strtotime($booking['start_time'])); ?> to <?php echo date('g:i a', strtotime($booking['end_time'])); ?></td>
                        <td><?php echo htmlspecialchars($booking['status']); ?></td>
                        <td>
                            <?php if ($booking['status'] === 'booked'): ?>
                                <form action="cancel_booking.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Cancel Booking</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No booked room found for this user.</div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
