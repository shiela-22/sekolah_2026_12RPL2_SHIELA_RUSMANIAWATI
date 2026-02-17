<?php
session_start();

// Jika sudah login, bisa redirect ke dashboard atau halaman lain jika perlu
// Tapi di sini hanya tampil tombol Login

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Halaman Utama</title>

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
    width:300px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 0 15px rgba(0,0,0,0.2);
}
.btn{
    display:block;
    margin:20px auto 0;
    padding:12px;
    background:#ffb5da;
    color:white;
    text-decoration:none;
    border-radius:6px;
    font-weight:bold;
    width: 100%;
    max-width: 200px;
    text-align: center;
}
.btn:hover{
    background:#ff91c8;
}
</style>
</head>

<body>

<div class="box">

<h1>Selamat Datang</h1>

<a href="login.php" class="btn">Login</a>

</div>

</body>
</html>
