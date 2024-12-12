<?php
session_start();
include '../includes/db_connect2.php';
include '../includes/functions.php';
include '../includes/header.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

$departments = fetchDepartments();
$rooms = fetchrooms();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $department_id = $_POST['department'];
    $name = htmlspecialchars($_POST['name']);
    $capacity = intval($_POST['capacity']);
    $equipment = htmlspecialchars($_POST['equipment']);
    $type = htmlspecialchars($_POST['type']);
    $id = getRoomIdByName($name);

    editRoom($id,$department_id, $name, $capacity, $equipment, $type);
    echo "<script>alert('room edited Successfully'); window.location.href='edit_rooms.php';</script>";
    exit;
}

?>


    <title>Manage Rooms</title>
    <div class="main">
        <h2>Manage Rooms</h2>
        <?php $rooms = fetchAllRooms(); ?>
        <?php foreach ($rooms as $room): ?>
            <div class="main2">
                <div class="card-body">
                    <h5><?php echo htmlspecialchars($room['name']); ?></h5>
                    <p>Capacity: <?php echo htmlspecialchars($room['capacity']); ?></p>
                    <form method="POST" action="manage_rooms.php">
                        <input type="hidden" name="delete_room" value="<?php echo $room['id']; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php include '../includes/footer.php'; ?> 
