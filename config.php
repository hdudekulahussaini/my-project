<?php
$conn = mysqli_connect("localhost", "root", "", "products");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>