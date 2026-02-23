<?php
session_start();
$conn = mysqli_connect("localhost","root","","ujikom_12rpl2_shiela_rusmaniawat");

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}

/* =========================
   LOGIN PROSES
========================= */
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,"SELECT * FROM user WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if($data && password_verify($password,$data['password'])){
        $_SESSION['id']       = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role']     = $data['role'];
    }else{
        $error = "Username atau Password salah!";
    }
}

/* =========================
   LOGOUT
========================= */
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Website Pengaduan Mutu</title>
<style>
body{
    font-family: Arial, sans-serif;
    background: linear-gradient(to right,#ffb6d9,#ffffff);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}
.box{
    background:white;
    padding:40px;
    width:350px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 0 15px rgba(0,0,0,0.2);
}
input{
    width:100%;
    padding:10px;
    margin:8px 0;
}
button{
    padding:10px;
    width:100%;
    background:#ff69b4;
    color:white;
    border:none;
    cursor:pointer;
    font-size:16px;
}
a.button-link{
    display:block;
    padding:10px;
    background:#ff69b4;
    color:#fff;
    text-decoration:none;
    border-radius:5px;
    margin:8px 0;
    font-weight:bold;
}
a.button-link:hover{
    background:#e04897;
}
.logout{
    background:#e74c3c !important;
}
.error{
    color:red;
    margin-bottom:10px;
}
</style>
</head>
<body>

<div class="box">

<?php if(!isset($_SESSION['id'])){ ?>

    <!-- FORM LOGIN -->
    <h2>Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

<?php } else { ?>

    <!-- DASHBOARD -->
    <h2>Selamat Datang</h2>
    <p>Halo, <b><?= htmlspecialchars($_SESSION['username']); ?></b></p>
    <p>Login sebagai: <b><?= strtoupper($_SESSION['role']); ?></b></p>

    <?php if($_SESSION['role'] == "admin"){ ?>
        <p><b>Menu Admin:</b></p>
        <a href="data-pengaduan.php" class="button-link">Data Pengaduan</a>
        <a href="editpassword-pengaduan.php" class="button-link">edit password</a>
        <a href="tampildata.php" class="button-link">Tampil Data</a>
        <a href="datasiswa.php" class="button-link">Data Siswa</a>
        <a href="cari-pengaduan.php" class="button-link">Cari Pengaduan</a>
    <?php } ?>

    <?php if($_SESSION['role'] == "siswa"){ ?>
        <p><b>Menu Siswa:</b></p>
        <a href="form-pengaduan.php" class="button-link">Buat Pengaduan</a>
        <a href="data-pengaduan.php" class="button-link">Data Pengaduan</a>
        <a href="cari-pengaduan.php" class="button-link">Cari Pengaduan Saya</a>
    <?php } ?>

    <a href="?logout=true" class="button-link logout">Logout</a>

<?php } ?>

</div>

</body>
</html>