<?php include '../includes/background.php';include '../includes/functions.php'; ?>

<div class="main">
    <title >UOB booking system</title>
<div class="container">
<?php 
        if (isset($_SESSION['user_id'])) {
                echo '<a href="dashboard.php"><img src="../img/logo.png" alt="logo" width="150px" height="150px"></a>';}
	else{
		echo'<a href="index.php"><img src="../img/logo.png" alt="logo" width="150px" height="150px"></a>';
        }
?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css"> 
</div>	


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
    <h1>Welcome to UOB Room Booking System</h1>
    <p>This is the main home page. You can register, login, browse rooms, and book a room.</p>
    	<div class="d-flex justify-content-center">
        	<a href="registration.php" class="glass-btn">Register</a>
        	<a href="login.php" class="glass-btn">Login</a>
    	</div>
</div>
	
</div>
<?php include '../includes/footer.php'; ?>
