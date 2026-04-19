<?php
include("../config/database.php");

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];

// HASH PASSWORD
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// INSERT USER
$sql = "INSERT INTO users (name, email, password, role)
        VALUES ('$name', '$email', '$hashed_password', 'customer')";

if (mysqli_query($conn, $sql)) {
    header("Location: ../auth/login.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>