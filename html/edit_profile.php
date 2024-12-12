<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include '../includes/header.php';
include '../includes/db_connect.php';
include '../includes/functions.php';

$target_dir = "../uploads/";
        
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

    if (isset($password) && !empty($password)) {
        if ($password !== $confirmPassword) {
            echo "<div class='alert alert-danger'>Passwords do not match.</div>";
        } 
    }
    

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
		echo "<script>alert('Sorry, your file was not uploaded.');</script>";
    } else {
         if (move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
                try {
                                                                        // Insert user to the database
                    $stmt = $pdo->prepare("UPDATE users SET name = :name, password = :password, profile_picture = :profile_picture WHERE email = :email");
                    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashed_password, 'profile_picture' => $target_file]);
		            echo "<script>alert('Profile Changed Successfully'); window.location.href='profile.php';</script>";
                    } catch (\PDOException $e) {
                            echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
                                                }
        } else {
		        echo "<script>alert(Sorry, there was an error uploading your file'); </script>";
            }
        }
    }

?>
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
