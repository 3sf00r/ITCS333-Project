
<?php
session_start();
include 'includes/db_connect.php';
include '../includes/background.php';
include '../includes/functions.php';
function isAdmin2() {
    return isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && verifyPassword($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['user_email'] = $user['email'];
        if ($_SESSION['user_role']==='admin') {
                header('Location: admin_Dashboard.php');}
    else{
        header('Location: Dashboard.php');
        }
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email format.";
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
                echo '<a href="dashboard.php"><img src="../img/logo.png" alt="logo" width="150px" height="150px"></a>';}
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
        <h2>Login</h2>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input  type="password" id="password" name="password" required><br><br>

            <button class="about" type="submit">Login</button>
        </form>
</div>

</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
