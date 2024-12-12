<?php
session_start();
include '../includes/db_connect.php';
include '../includes/functions.php';
include '../includes/header.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

$departments = fetchDepartments();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


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
