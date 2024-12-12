<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include '../includes/header.php';
include '../includes/db_connect.php';
include '../includes/functions.php';


// Fetch user data based on the user_email in the session

$target_dir = "../uploads/";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitizeInput($_POST['name']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);
    $password = sanitizeInput($_POST['password']);
    $email = $_SESSION['user_email'];
    $profile_picture = $_FILES['profile_picture'];
    $target_file = $target_dir . basename($profile_picture["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $hashed_password = hashPassword($password);

<a href="profile.php" class="btn btn-primary">Back</a>
<div class="main">
    <h2>Edit Profile</h2>
    <form id="profileForm" method="POST" action="edit_profile.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="name" required>
        </div>
        <div class="form-group">
            <label for="password">New Password (leave blank if not changing):</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm New Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
        </div>
        <div class="form-group">
            <label for="profile_picture">Upload Profile Picture (leave blank if not changing):</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" >
        </div>
        <button type="submit">Update Profile</button>
    </form>
</div>
    
<?php include '../includes/footer.php'; ?>

