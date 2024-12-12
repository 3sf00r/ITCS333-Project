<?php
session_start(); 
include '../includes/db_connect.php'; // Connect to the database
include '../includes/background.php'; // Include background styling 

function isAdmin2() {
    return isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'; 
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user inputs
    $name = sanitizeInput($_POST['name']); 
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']); 

    // Handle file upload (details added in later steps)
    $profile_picture = $_FILES['profile_picture']; 

    // Validate email address
    if (preg_match('/^[a-zA-Z]+@uob.edu.bh$|^[0-9]+@stu.uob.edu.bh$/', $email)) { 
        // Hash the password
        $hashed_password = hashPassword($password); 

        // ... (File upload handling) ... 

        // Insert user data into the database
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, profile_picture) VALUES (:name, :email, :password, :profile_picture)");
            $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashed_password, 'profile_picture' => $target_file]); 
            echo "<script>alert('User Registered Successfully'); window.location.href='login.php';</script>";
        } catch (\PDOException $e) {
            echo '<div class="alert alert-danger">' . $e->getMessage() . '</div>';
        } 
    } else {
        echo "<script>alert('Invalid UoB email address.');</script>";
    }
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB booking system</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> 
</head>
<body>
    <h1>UOB booking system</h1>
    <div class="container"> 
        <?php 
        if (isAdmin2()) {
            echo '<a href="admin_dashboard.php"><img src="../img/logo.png" alt="logo" width="150px" height="150px"></a>';
        } else {
            if (isset($_SESSION['user_id'])) {
                echo '<a href="dashboard.php"><img src="../img/logo.png" alt="logo" width="150px" height="150px"></a>';
            } else {
                echo'<a href="index.php"><img src="../img/logo.png" alt="logo" width="150px" height="150px"></a>';
            }
        }
        ?>
    </div>
    <div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="profile.php">Profile</a> |
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a class="about" href="aboutUS.php">About US</a>
        <?php endif; ?>
    </div>
    </body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB booking system</title>
</head>
<body>
    <h1>UOB booking system</h1> 
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
</body>
</html>
<?php include '../includes/footer.php'; ?>
