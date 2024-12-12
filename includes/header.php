<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >UOB booking system</title>
<div class="container">
<?php 
function isAdmin2() {
    return isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin';
}
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> 
</div>
</head>
<body>
<nav class="navbar navbar-light bg-light">

  <?php if (isAdmin2()) {
    echo '<a class="navbar-brand" href="admin_dashboard.php">';
}else{
        if (isset($_SESSION['user_id'])) {
                echo '<a class="navbar-brand" href="dashboard.php">';}
    else{
        echo'<a class="navbar-brand" href="index.php">';
        }
    }
?>
    <img src="../img/logo.png" width="50" height="50" class="d-inline-block align-top" alt="">UOB booking system</a>



    </div>
    <div >
        <ul class="nav justify-content-end">
    <?php if (isset($_SESSION['user_id'])): ?>
        <li class="nav-item">
        <a class="nav-link glass-btn" href="profile.php">Profile</a> |
        </li><li class="nav-item">
        <a class="nav-link glass-btn" href="logout.php">Logout</a>
        </li>
