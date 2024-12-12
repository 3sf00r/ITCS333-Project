 
<?php session_start(); 
include '../includes/header.php';
include '../includes/functions.php';
if (!isAdmin()) {
    header('Location: index.php');
    exit;}

    function getRoomName($roomId)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT name FROM rooms WHERE id = ?");
    $stmt->execute([$roomId]);

    return $stmt->fetch(PDO::FETCH_ASSOC)['name'];
}
?>

<?php if ($bookings): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Room Name</th>
                <th>Type</th>
                <th>Date</th>
                <th>Time</th>
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
                    <td>        
                                <form action="comment.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
                                    <input type="hidden" name="room_id" value="<?php echo $booking['room_id']; ?>">
                                    <button type="submit" class="btn btn-danger">comment</button>
                                </form>
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

