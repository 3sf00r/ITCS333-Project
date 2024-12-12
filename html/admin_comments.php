<?php session_start(); 
include '../includes/header.php';
include '../includes/functions.php';
include '../includes/db_connect.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;}

function getRoomName($roomId){
        $stmt = $pdo->prepare("SELECT name FROM rooms WHERE id = ?");
        $stmt->execute([$roomId]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['name'];
}
?>

<div class="main">
    <h2 class="mt-3">Comments</h2>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM comments");
    $stmt->execute();
    echo '<table class="table">';
    echo '<thead><tr><th>Booking ID</th><th>Room name</th><th>User Email</th><th>Comment</th><th>Date Created</th></tr></thead>';

    while ($comment = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $comment['booking_id'] . '</td>';
        echo '<td>' . getRoomName($comment['room_id']) . '</td>';
        echo '<td>' . $comment['user_email'] . '</td>';
        echo '<td>' . $comment['comment'] . '</td>';
        echo '<td>' . $comment['created_at'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';

    ?>
</div>

<?php include '../includes/footer.php'; ?>
