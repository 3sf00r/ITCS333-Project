<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include '../includes/db_connect.php';

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = :id");
    $stmt->execute(['id' => $roomId]);
    $room = $stmt->fetch(PDO::FETCH_ASSOC);
  
    if (!$room) {
        header('Location: rooms.php');
        exit();
    }
}
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="container">
        <h2><?= htmlspecialchars($room['name']) ?></h2>
        <p>Description: <?= htmlspecialchars($room['description']) ?></p>
        <img src="<?= htmlspecialchars($room['image_url']) ?>" alt="Room Image" width="400" height="300">
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html> 
