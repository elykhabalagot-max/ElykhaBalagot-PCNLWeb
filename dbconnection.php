<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'enrollmentdb';

$conn = mysqli_connect($host, $username, $password, $database);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>