 
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
function fetchRoomsByDepartmentId($departmentId) {
    $conn = db_connect();
    $query = "SELECT * FROM Rooms WHERE department_id = $departmentId";
    $result = mysqli_query($conn, $query);
    $rooms = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row;
    }
    mysqli_close($conn);
    return $rooms;
}

function isAdmin() {
    return isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin';
}

function fetchAllRooms() {
    $conn = db_connect();
    $query = "SELECT * FROM Rooms";
    $result = mysqli_query($conn, $query);
    $rooms = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row;
    }
    mysqli_close($conn);
    return $rooms;
}

function insertRoom($department, $name, $capacity, $equipment, $type) {
    $conn = db_connect();

    $sql = "INSERT INTO Rooms (department_id, name, capacity, equipment, type) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, 'issss', $department, $name, $capacity, $equipment, $type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function deleteRoom($roomId) {
    $conn = db_connect();
    $query = "DELETE FROM Rooms WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $roomId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function editRoom($id,$department_id, $name, $capacity, $equipment, $type) {
    $conn = db_connect();

    $sql = "UPDATE Rooms SET department_id = ?, name = ?, capacity = ?, equipment = ?, type = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, 'issssi', $department_id, $name, $capacity, $equipment, $type, $id);

    mysqli_stmt_execute($stmt);
}

function getRoomIdByName($name) {
    $conn = db_connect();

    $sql = "SELECT id FROM rooms WHERE name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    } else {
        return null;
    }
}
function fetchRoomsByDepartmentIdAndType($department_id, $room_type) {
    if ($room_type === 'all') {
        $sql = "SELECT * FROM rooms WHERE department_id = ?";
    } else {
        $sql = "SELECT * FROM rooms WHERE department_id = ? AND type = ?";
    }
    $conn = db_connect();

    $stmt = $conn->prepare($sql);
    if ($room_type === 'all') {
        $stmt->bind_param("i", $department_id);
    } else {
        $stmt->bind_param("is", $department_id, $room_type);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $rooms = [];
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }

    return $rooms;
}

function getRoomDataByName($name) {
    $conn = db_connect();

    $sql = "SELECT * FROM Rooms WHERE name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}
?>
