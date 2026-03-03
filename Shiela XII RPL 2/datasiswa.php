<?php
session_start();

// ================= KONEKSI DATABASE =================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ujikom_12rpl2_shiela_rusmaniawat";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// ================= PROSES SIMPAN =================
if (isset($_POST['simpan'])) {

    // AMBIL DATA DARI FORM
    $nis      = trim($_POST['nis']);
    $username = trim($_POST['username']);
    $kelas    = trim($_POST['kelas']);
    $password = trim($_POST['password']);

    // VALIDASI TIDAK BOLEH KOSONG
    if ($nis == "" || $username == "" || $kelas == "" || $password == "") {
        echo "<script>alert('Semua data wajib diisi!');</script>";
    } else {

        // HASH PASSWORD (WAJIB)
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // SIMPAN KE DATABASE
        $query = "INSERT INTO user (nis, username, kelas, password)
                  VALUES ('$nis', '$username', '$kelas', '$password_hash')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data berhasil disimpan');</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data');</script>";
        }
    }
}

// ================= AMBIL DATA =================
$data = mysqli_query($koneksi, "SELECT nis, username, kelas, password FROM user");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(to right,#ffb6d9,#ffffff);
            padding: 20px;
        }
        .btn-area {
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            margin-right: 10px;
            font-size: 14px;
        }
        .btn-back {
            background:#FADCE9;
        }
        .btn-logout {
            background:#FADCE9;
        }
        form {
            width: 320px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            background:#FADCE9;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        table {
            background: white;
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background:#FADCE9;    
            color: white;
        }
    </style>
</head>
<body>

<!-- TOMBOL -->
<div class="btn-area">
    <a href="index.php" class="btn btn-back">⬅ Kembali</a>
    <a href="logout-pengaduan.php" class="btn btn-logout">Logout</a>
</div>

<h2>Form Input Data Siswa</h2>

<form method="post">
    <label>NIS</label>
    <input type="text" name="nis" required>

    <label>Username</label>
    <input type="text" name="username" required>

    <label>Kelas</label>
    <input type="text" name="kelas" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit" name="simpan">Simpan</button>
</form>

<h2>Data Siswa</h2>

<table>
    <tr>
        <th>NIS</th>
        <th>Username</th>
        <th>Kelas</th>
        <th>Password (Hash)</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
        <td><?= htmlspecialchars($row['nis']); ?></td>
        <td><?= htmlspecialchars($row['username']); ?></td>
        <td><?= htmlspecialchars($row['kelas']); ?></td>
        <td><?= $row['password']; ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>