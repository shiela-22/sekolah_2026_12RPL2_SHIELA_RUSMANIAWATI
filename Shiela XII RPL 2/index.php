<?php
session_start();

/* =========================
   PROSES LOGIN
========================= */
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // LOGIN SEDERHANA (tanpa database)

    if($username == "admin" && $password == "12345"){
        $_SESSION['username'] = "admin";
        $_SESSION['role']     = "admin";
    }
    elseif($username == "siswa" && $password == "12345"){
        $_SESSION['username'] = "siswa";
        $_SESSION['role']     = "siswa";
    }
    else{
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
    box-sizing: border-box;
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
a.button-link {
    display:inline-block;
    padding:12px 20px;
    background:#ff69b4;
    color:#fff;
    text-decoration:none;
    border-radius:5px;
    margin:10px 0;
    font-weight: bold;
    cursor: pointer;
}
a.button-link:hover {
    background:#e04897;
}
.logout-link {
    background:#e74c3c !important;
    margin-top: 20px;
    display: inline-block;
}
.logout-link:hover {
    background:#c0392b !important;
}
.error {
    color: red;
    margin-bottom: 15px;
    font-weight: bold;
}
</style>
</head>
<body>

<div class="box">

<?php if(!isset($_SESSION['username'])){ ?>

    <!-- FORM LOGIN -->
    <h2>Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <p style="font-size:12px; margin-top:15px;">
        Admin → username: <b>admin</b> | password: <b>12345</b><br>
        Siswa → username: <b>siswa</b> | password: <b>12345</b>
    </p>

<?php } else { ?>

    <!-- DASHBOARD -->
    <h2>Selamat Datang</h2>
    <p>Halo, <b><?= htmlspecialchars($_SESSION['username']); ?></b></p>
    <p>Login sebagai: <b><?= strtoupper(htmlspecialchars($_SESSION['role'])); ?></b></p>


        <?php if($_SESSION['role'] == "admin"){ ?>
    <p>Menu Admin:</p>
    <div class="button-container">
        <a href="data-pengaduan.php" class="button-link">Data Pengaduan admin</a>
        <a href="datasiswa.php" class="button-link">Data siswa</a>
        <a href="cari-pengaduan.php" class="button-link">cari Data Pengaduan</a>
    </div>
<?php } ?>

<?php if($_SESSION['role'] == "siswa"){ ?>
    <p>Menu Siswa:</p>
    <div class="button-container">
        <a href="form-pengaduan.php" class="button-link">Buat Pengaduan</a>
        <a href="data-pengaduan.php" class="button-link">Data Pengaduan siswa</a>

        <a href="cari-pengaduan.php" class="button-link">cari Pengaduan Saya</a>
    </div>
<?php } ?>

<a href="?logout=true" class="button-link logout-link">Logout</a>

<?php } ?>

</div>

</body>
</html>
