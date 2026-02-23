<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['id'])){
    echo "Anda belum login!";
    exit;
}

$id = $_SESSION['id'];

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$user = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($password)){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE user SET username='$username', password='$password_hash' WHERE id='$id'");
    }else{
        mysqli_query($koneksi, "UPDATE user SET username='$username' WHERE id='$id'");
    }

    $_SESSION['username'] = $username;

    echo "<script>alert('Data berhasil diupdate!'); window.location='editpassword-pengaduan.php';</script>";
    exit;
}
?>