<?php
session_start();
$conn = mysqli_connect("localhost","root","","ujikom_12rpl2_shiela_rusmaniawat");

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}

/* =========================
   LOGOUT
========================= */
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: index.php");
    exit;
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
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nis'] = $data['nis'] ?? ''; // tambahkan ini supaya tidak null
    }else{
        echo "<script>alert('Login gagal!');</script>";
    }
}

/* =========================
   UPDATE AKUN
========================= */
if(isset($_POST['update']) && isset($_SESSION['id'])){

    $id = $_SESSION['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($password)){
        $password_hash = password_hash($password,PASSWORD_DEFAULT);
        $query = "UPDATE user SET username='$username', password='$password_hash' WHERE id='$id'";
    }else{
        $query = "UPDATE user SET username='$username' WHERE id='$id'";
    }

    mysqli_query($conn,$query);
    $_SESSION['username'] = $username;

    echo "<script>alert('Data berhasil diupdate!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login & Edit Akun</title>
<style>
body{
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    background:#f4f4f4;
    font-family:Arial;
}
.box{
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
    width:320px;
}
input{
    width:100%;
    padding:8px;
    margin:8px 0;
}
button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
.login-btn{ background:#28a745; color:white; }
.update-btn{ background:#007bff; color:white; }
.logout-btn{ background:#dc3545; color:white; margin-top:10px; }
</style>
</head>
<body>

<div class="box">

<?php if(!isset($_SESSION['id'])){ ?>

<!-- FORM LOGIN -->
<h3>Login</h3>
<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" name="login" class="login-btn">Login</button>
</form>

<?php } else { ?>

<!-- FORM EDIT -->
<h3>Edit Akun</h3>
<p>Login sebagai: <b><?= htmlspecialchars($_SESSION['username']); ?></b></p>
<p>NIS: <b><?= htmlspecialchars($_SESSION['nis'] ?? ''); ?></b></p>

<form method="POST">
<input type="text" name="username" value="<?= htmlspecialchars($_SESSION['username']); ?>" required>
<input type="password" name="password" placeholder="Password baru (opsional)">
<button type="submit" name="update" class="update-btn">Update</button>
</form>

<a href="?logout=true">
<button type="button" class="logout-btn">Logout</button>
</a>

<?php } ?>

</div>

</body>
</html>