<?php
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}
function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}
function isAdmin() {
    return isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin';
}

function fetchDepartments() {
    $conn = db_connect();
    $query = "SELECT * FROM Departments";
    $result = mysqli_query($conn, $query);
    $departments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = $row;
    }
    mysqli_close($conn);
    return $departments;
}

function fetchrooms() {
    $conn = db_connect();
    $query = "SELECT * FROM rooms";
    $result = mysqli_query($conn, $query);
    $rooms = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row;
    }
    mysqli_close($conn);
    return $rooms;
}











?>
