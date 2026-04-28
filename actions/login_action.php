<?php
session_start();
include("../config/database.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {

    $user = mysqli_fetch_assoc($result);
    if ($user['status'] == 'inactive') {
        header("Location: ../auth/login.php?error=inactive");
        exit();
    }

    if (password_verify($password, $user['password'])) {


        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];


        // REDIRECT
        if ($user['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } elseif ($user['role'] == 'restaurant' && $user['status'] == 'active') {
            header("Location: ../restaurant/dashboard.php");
        } elseif ($user['role'] == 'restaurant' && $user['status'] == 'inactive') {
            header("Location: ../auth/login.php?error=inactive");
        } else {
            header("Location: ../index.php");
        }
    } else {
        header("Location: ../auth/login.php?error=password");
        exit();
    }
} else {
    header("Location: ../auth/login.php?error=user");
    exit();
}
