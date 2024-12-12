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
        <a class="glass-btn" href="index.php">Home</a>
    <?php endif; ?>
</div>



  <title>About Us - College Room Booking System</title>
  <section id="about-us">
    <div class="container">
      <h2>About Us</h2>
      <p>
        Welcome to the College Room Booking System! We are committed to providing an efficient and user-friendly platform for students, faculty, and staff to book rooms for academic, recreational, and event purposes.
      </p>
      <p>
        Our system is designed to simplify the room reservation process, ensuring accessibility, transparency, and convenience for all users. Whether you need a quiet study space, a classroom for group discussions, or a hall for events, we’ve got you covered!
      </p>
      <p>
        We value your feedback and are continuously improving our services to meet your needs. Thank you for choosing our platform!
      </p>
    </div>
  </section>
    </div>
    
<?php
include '../includes/footer.php'; 
?>
