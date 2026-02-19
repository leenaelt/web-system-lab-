<?php
$servername = "localhost";
$username = "root"; // عادة افتراضي في XAMPP
$password = "";
$dbname = "student_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
