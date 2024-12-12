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

    <title>Edit Room</title>
    <div class="main">
    <form method="POST" action="">

        <label for="name">Room:</label>
        <select name="name" required>
            <?php foreach ($rooms as $room) { ?>
                <option value="<?php echo $room['name']; ?>"><?php echo $room['name']; ?></option>
            <?php } ?>
        </select>
        <label for="department"> Change Department:</label>
        <select name="department" >
            <?php foreach ($departments as $dept) { ?>
                <option value="<?php echo $dept['id']; ?>"><?php echo $dept['name']; ?></option>
            <?php } ?>
        </select>
        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <input type="number"  id="capacity" name="capacity" value="" required>
        </div>
        <div class="form-group">
            <label for="equipment">Equipment:</label>
            <input type="text"  id="equipment" name="equipment" value="" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select name="type" class="select" required>
            <option value="class">class</option>
            <option value="lab">lab</option>
            </select>
            </div>
        <button type="submit" class="glass-btn">Edit</button>
        
    </form>
    </div>
<?php include '../includes/footer.php'; ?>
