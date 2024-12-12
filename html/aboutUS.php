<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">


<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >UOB booking system</title>
    <div class="main2">
<div class="container">
<?php 
function isAdmin2() {
    return isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin';
}
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
