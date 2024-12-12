<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include '../includes/header.php';
include '../includes/db_connect.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<title>Profile</title>
<div class="mainprofile"> 
<h2>Your Profile</h2>
    
<div class=" image d-flex flex-column justify-content-center align-items-center"> 
			 
	<img id="photo" src="<?= htmlspecialchars($user['profile_picture']) ?>" />
			<span class="name mt-3"><?= htmlspecialchars($user['name']) ?></span> 
				<span class="idd"><?= htmlspecialchars($user['email']) ?></span> 
					<div class=" d-flex mt-2"> <a href="edit_profile.php" class="glass-btn">Edit Profile</a>
</div> </div> </div>

        
 
<?php include '../includes/footer.php'; ?>
