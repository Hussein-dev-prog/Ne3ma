<?php
include "../../config/database.php";

$action = $_POST['action'] ?? '';

if ($action == "add") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    $pass = password_hash("123456", PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users(name,email,password,role,status)
  VALUES('$name','$email','$pass','restaurant','$status')");

    $uid = mysqli_insert_id($conn);

    mysqli_query($conn, "INSERT INTO restaurants(restaurant_name,phone,location,user_id)
  VALUES('$name','$phone','$address','$uid')");

    echo json_encode(["message" => "Added"]);
}

if ($action == "edit") {
    $id = $_POST['user_id'];

    mysqli_query($conn, "UPDATE users SET name='{$_POST['name']}',email='{$_POST['email']}' WHERE user_id=$id");

    mysqli_query($conn, "UPDATE restaurants SET restaurant_name='{$_POST['name']}',phone='{$_POST['phone']}',location='{$_POST['address']}' WHERE user_id=$id");

    echo json_encode(["message" => "Updated"]);
}

if ($action == "delete") {
    $id = $_POST['id'];

    mysqli_query($conn, "DELETE FROM restaurants WHERE user_id=$id");
    mysqli_query($conn, "DELETE FROM users WHERE user_id=$id");

    echo json_encode(["message" => "Deleted"]);
}

if ($action == "toggle") {
    $id = $_POST['id'];

    $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT status FROM users WHERE user_id=$id"));
    $new = $r['status'] == "active" ? "inactive" : "active";

    mysqli_query($conn, "UPDATE users SET status='$new' WHERE user_id=$id");

    echo json_encode(["message" => "Status updated"]);
}
