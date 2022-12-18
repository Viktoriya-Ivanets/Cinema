<?php
global $conn;
$conn = mysqli_connect("localhost", "root", "root", "cinema", 3306);
if ($conn->connect_error) {
    error_log('Connection error: ' . $conn->connect_error);
}
?>