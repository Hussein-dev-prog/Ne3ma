<?php
$conn = mysqli_connect("localhost", "root", "", "ne3ma");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
