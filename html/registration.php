<?php
session_start(); 
include '../includes/db_connect.php'; // Connect to the database
include '../includes/background.php'; // Include background styling 

function isAdmin2() {
    return isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin'; 
}

?>

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
