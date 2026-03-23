<?php
$host = "localhost";
$db = "";
$user = "";
$pass = ""; // حط الباسورد لو فيه

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>
