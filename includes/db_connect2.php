<?php
function db_connect() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "booking_sys";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
