<?php
session_start();

/* ================== KONEKSI DATABASE ================== */
$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_shiela_rusmaniawat");

if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}

/* ================== CEK LOGIN ================== */
if(!isset($_SESSION['id'])){
    echo "Anda belum login!";
    exit;
}

$id = $_SESSION['id'];

/* ================== AMBIL DATA USER ================== */
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$user = mysqli_fetch_assoc($data);

if(!$user){
    echo "User tidak ditemukan!";
    exit;
}

/* ================== UPDATE DATA ================== */
if(isset($_POST['update'])){

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    if(!empty($password)){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, 
            "UPDATE user SET username='$username', password='$password_hash' WHERE id='$id'"
        );
    } else {
        mysqli_query($koneksi, 
            "UPDATE user SET username='$username' WHERE id='$id'"
        );
    }

    $_SESSION['username'] = $username;

    echo "<script>alert('Data berhasil diupdate!'); window.location='editpassword-pengaduan.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Akun</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#ffe6f0;
    margin:0;
    padding:40px;
}

.card{
    width:420px;
    margin:auto;
    padding:25px;
    background:white;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
    color:#d63384;
}

label{
    font-weight:bold;
    color:#555;
}

input{
    width:100%;
    padding:10px;
    margin:8px 0 15px 0;
    border:1px solid #ffc0d9;
    border-radius:6px;
}

input:focus{
    outline:none;
    border-color:#ff66a3;
}

button{
    background:#ff66a3;
    color:white;
    border:none;
    padding:10px 16px;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:#e05590;
}

.btn-kembali{
    display:inline-block;
    margin-left:10px;
    padding:10px 16px;
    background:#ffc0d9;
    color:#d63384;
    border-radius:6px;
    text-decoration:none;
}

.btn-kembali:hover{
    background:#ffb3d1;
}

</style>

</head>
<body>

<div class="card">

<h2>Edit Akun</h2>

<form method="POST">

<label>Username</label>
<input type="text" name="username"
value="<?= htmlspecialchars($user['username']); ?>" required>

<label>Password Baru (Kosongkan jika tidak ingin ganti)</label>
<input type="password" name="password">

<button type="submit" name="update">Update</button>
<a href="index.php" class="btn-kembali">Kembali</a>

</form>

</div>

</body>
</html>