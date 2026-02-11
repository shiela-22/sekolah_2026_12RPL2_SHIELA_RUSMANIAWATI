<?php
session_start();

// Cek apakah user sudah login
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SELAMAT DATANG DI WEBSITE PENGADUAN MUTU</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: 'Quicksand';
            background: linear-gradient(to right, #ffbece, #ffffff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .box{
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 420px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        h1{
            margin-bottom: 5px;
        }
        p{
            color: #555;
        }
        .btn{
            display: inline-block;
            margin: 15px 10px;
            padding: 12px 30px;
            background: #ffb5da;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .btn:hover{
            background: #ff91c8;
        }
    </style>
</head>

<body>

<div class="box">
    <h1>SELAMAT DATANG</h1>
    <p>DI WEBSITE PENGADUAN MUTU</p>
    <p>Halo, <b><?php echo $_SESSION['username']; ?></b></p>

    <a href="form-pengaduan.php" class="btn">Buat Pengaduan</a>
    <a href="logout-pengaduan.php" class="btn">Logout</a>
</div>

</body>
</html>