<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

</head>
<body>
if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
</body>
<?php include '../includes/footer.php'; ?>
