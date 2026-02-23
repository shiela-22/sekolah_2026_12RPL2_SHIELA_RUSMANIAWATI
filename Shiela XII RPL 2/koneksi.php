<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ujikom_12rpl2_shiela_rusmaniawat";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>