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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_id = $_POST['department'];
    $name = htmlspecialchars($_POST['name']);
    $capacity = intval($_POST['capacity']);
    $equipment = htmlspecialchars($_POST['equipment']);
    $type = htmlspecialchars($_POST['type']);

    insertRoom($department_id, $name, $capacity, $equipment, $type);
    header('Location: admin.php');
    exit;
}
?>

<title>Add Room by Department</title>
<div class="main">
    <h2>Add Room</h2>
        <form method="POST" action="">
        <div class="form-group">
            <label for="department">Department:</label>
            <select name="department" class="select" required>
                <?php foreach ($departments as $dept) { ?>
                    <option value="<?php echo $dept['id']; ?>"><?php echo $dept['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
                <input type="text"  id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" name="capacity" required>
        </div>
        <div class="form-group">
            <label for="equipment">Equipment:</label>
                <input type="text"id="equipment" name="equipment" required>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <select name="type" class="select" required>
                <option value="class">class</option>
                <option value="lab">lab</option>
            </select>
        </div>
        <button type="submit" class="glass-btn">Add</button>
        </form>
    </div>
<?php include '../includes/footer.php'; ?>
