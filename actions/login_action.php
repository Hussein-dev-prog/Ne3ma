<?php
session_start();
include("../config/database.php");

$email = $_POST['email'];
$password = $_POST['password'];
$selected_role = $_POST['role'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){

    $user = mysqli_fetch_assoc($result);

    if(password_verify($password, $user['password'])){

        // CHECK ROLE
        if($user['role'] != $selected_role){
            header("Location: ../auth/login.php?error=role");
            exit();
        }

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // REDIRECT
        if($user['role'] == 'admin'){
            header("Location: ../admin/dashboard.php");
        } elseif($user['role'] == 'restaurant'){
            header("Location: ../restaurant/dashboard.php");
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