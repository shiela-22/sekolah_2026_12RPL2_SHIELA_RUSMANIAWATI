<?php
session_start();

// Cek login
if(!isset($_SESSION['username']) || !isset($_SESSION['role'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$role     = $_SESSION['role']; // siswa / admin
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Pengaduan Mutu</title>

<style>
body{
    margin:0;
    font-family: Arial;
    background: linear-gradient(to right,#ffbece,#ffffff);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}
.box{
    background:white;
    padding:40px;
    width:450px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 0 15px rgba(0,0,0,0.2);
}
h1{
    margin-bottom:10px;
}
.role{
    font-weight:bold;
    color:#ff69b4;
}
.btn{
    display:block;
    margin:10px 0;
    padding:12px;
    background:#ffb5da;
    color:white;
    text-decoration:none;
    border-radius:6px;
    font-weight:bold;
}
.btn:hover{
    background:#ff91c8;
}
.logout{
    background:#e74c3c;
}
.logout:hover{
    background:#c0392b;
}
</style>
</head>

<body>

<div class="box">

<h1>SELAMAT DATANG</h1>
<p>Halo, <b><?= htmlspecialchars($username); ?></b></p>
<p>Login sebagai: <span class="role"><?= strtoupper($role); ?></span></p>

<?php if($role == "siswa"): ?>

    <!-- MENU SISWA -->
    <a href="form-pengaduan.php" class="btn">Buat Pengaduan</a>
    <a href="cari-pengaduan.php" class="btn">Cari Pengaduan</a>

<?php elseif($role == "admin"): ?>

    <!-- MENU ADMIN -->
    <a href="data-pengaduan.php" class="btn">Lihat Semua Pengaduan</a>
    <a href="kelola-user.php" class="btn">Kelola User</a>
    <a href="laporan.php" class="btn">Laporan Pengaduan</a>

<?php endif; ?>

<a href="logout-pengaduan.php" class="btn logout">Logout</a>

</div>

</body>
</html>
