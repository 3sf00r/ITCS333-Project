<?php
session_start();
include '../includes/header.php';
include '../includes/functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include '../includes/db_connect2.php';

$departments = fetchDepartments();
?>

<div class="main">
    <form method="GET" action="">
        <label for="room_type">Filter by Room Type:</label>
        <select name="room_type" id="room_type">
            <option value="all">List All</option>
            <option value="class">Class</option>
            <option value="lab">Lab</option>
        </select>
        <button type="submit">Apply Filter</button>
    </form>
    
    <h2 class="text-white">Departments</h2>

    <?php foreach ($departments as $department): ?>
        <h3 class="text-white"><?php echo htmlspecialchars($department['name']); ?></h3>
        <?php 
        $room_type_filter = isset($_GET['room_type']) ? $_GET['room_type'] : 'all';
        $rooms = fetchRoomsByDepartmentIdAndType($department['id'], $room_type_filter);
        ?>
        
        
        <?php if (empty($rooms)): ?>
            <p>No rooms available in this department.</p>
        <?php else: ?>
            <ul class="rom">
                <li>name - capacity - equipment - type</li>
                <?php foreach ($rooms as $room): ?>
                    <li><?php echo htmlspecialchars($room['name']); ?> - Capacity: <?php echo htmlspecialchars($room['capacity']); ?> - <?php echo htmlspecialchars($room['equipment']); ?> - <?php echo htmlspecialchars($room['type']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endforeach; 
    ?>
</div>

<?php include '../includes/footer.php';?>
