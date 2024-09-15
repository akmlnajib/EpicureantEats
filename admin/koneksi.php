<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "ee_store";

$conn = mysqli_connect($server, $user, $password, $nama_database);
if (!$conn) {
    die("Tidak bisa menghubungkan ke database: " . mysqli_connect_error());
}
