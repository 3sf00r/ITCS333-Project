<?php
session_start();
include '../includes/db_connect.php';
include '../includes/background.php';

function isAdmin2() {
    return isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $profile_picture = $_FILES['profile_picture'];

    if (preg_match('/^[a-zA-Z]+@uob\.edu\.bh$|^[0-9]+@stu\.uob\.edu\.bh$/', $email)) {
        $hashed_password = hashPassword($password);
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($profile_picture["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
		echo "<script>alert('Sorry, your file was not uploaded.');</script>";
        } else {
            if (move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, profile_picture) VALUES (:name, :email, :password, :profile_picture)");
                    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashed_password, 'profile_picture' => $target_file]);
		            echo "<script>alert('User Registered Successfully'); window.location.href='login.php';</script>";
                    } 
                catch (\PDOException $e) {
                    echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
                }
            } else {
		            echo "<script>alert(Sorry, there was an error uploading your file'); </script>";
                }
        }
        } else {
	        echo "<script>alert('Invalid UoB email address.');</script>";
                }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >UOB booking system</title>
    <div class="main2">
    <div class="container">
        <?php 
            if (isAdmin2()) {
                    echo '<a href="admin_dashboard.php"><img src="../img/logo.png" alt="logo" width="150px" height="150px"></a>';
                            }else{
            if (isset($_SESSION['user_id'])) {
                echo '<a href="dashboard.php"><img src="../img/logo.png" alt="logo" width="150px" height="150px"></a>';
            }
	        else{
		        echo'<a href="index.php"><img src="../img/logo.png" alt="logo" width="150px" height="150px"></a>';
                }
            }    
?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> 
    </div>	
</head>
<body>
<div >
    <h1>UOB booking system</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="profile.php">Profile</a> |
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a class="about" href="aboutUS.php">About US</a>
    <?php endif; ?>
</div>
    
    <div class="container">
        
        <h2>Register</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture"><br><br>

            <button type="submit">Register</button>
        </form>
    </div>
</div>
    
<?php include '../includes/footer.php'; ?>
