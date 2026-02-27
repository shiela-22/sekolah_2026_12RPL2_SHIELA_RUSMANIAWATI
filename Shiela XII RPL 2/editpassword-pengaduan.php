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
        body { font-family: Arial; background:#f4f4f4; }
        .card {
            width:400px;
            margin:80px auto;
            padding:20px;
            background:white;
            border-radius:8px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }
        input {
            width:100%;
            padding:8px;
            margin:8px 0;
        }
        button {
            padding:8px 15px;
            background:#8e7cc3;
            color:white;
            border:none;
            border-radius:4px;
            cursor:pointer;
        }
        button:hover {
            background:#6f5bb3;
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