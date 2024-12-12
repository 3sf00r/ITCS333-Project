<?php session_start(); include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$booking_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$room_id = isset($_POST['room_id']) ? intval($_POST['room_id']) : 0;
$booking_details = getBookingDetails($booking_id); 

function insertComment($booking_id,$room_id, $user_id, $user_email, $comment_text) {
    include '../includes/db_connect.php';
    $stmt = $pdo->prepare("INSERT INTO comments (booking_id,room_id, user_id, user_email, comment, created_at) VALUES (:booking_id,:room_id, :user_id, :user_email, :comment, NOW())");
    
    if ($stmt->execute(['booking_id' => $booking_id,'room_id' => $room_id, 'user_id' => $user_id, 'user_email' => $user_email, 'comment' => $comment_text])) {
        echo "<script>alert('commented Successfully'); window.location.href='comments.php';</script>";
        exit();
    } else {
        echo "<div class='alert alert-danger'>Failed to insert comment. Please try again later.</div>";
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = intval($_POST['id']);
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];
    if (isset($_POST['comment'])) {
        $comment_text = htmlspecialchars($_POST['comment']);

        if (empty($user_email) || empty($comment_text)) {
            echo "<div class='alert alert-warning'>Please enter both your email and a comment.</div>";
        } else {
            insertComment($booking_id,$room_id, $user_id, $user_email, $comment_text);
        }
    } else {
        echo "<div class='alert alert-warning'>No comment provided. Please enter a comment.</div>";
    }
}


function getBookingDetails($booking_id) {
    include '../includes/db_connect.php';
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = :booking_id");
    $stmt->bindParam(':booking_id', $booking_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "<div class='alert alert-warning'>No booking found for this ID.</div>";
        return false;
    }
}

?>

<div class="container">
    <h2>Comment on Booking</h2>

    <?php if ($booking_details): ?>
        <form action="comment.php" method="post">
            <input type="hidden" name="id" value="<?php echo $booking_id; ?>">
            <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea id="comment" name="comment" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>
    <?php else: ?>
        <div class='alert alert-warning'>No booking found for this ID.</div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
