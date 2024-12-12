
<?php
session_start();
include 'includes/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

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
