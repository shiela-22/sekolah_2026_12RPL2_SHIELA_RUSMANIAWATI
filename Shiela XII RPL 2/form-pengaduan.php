<?php
session_start();

// Koneksi database
$conn = mysqli_connect("localhost","root","","ujikom_12rpl2_shiela_rusmaniawat");

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek login
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['id'];

// Ambil data user berdasarkan id login
$query = mysqli_query($conn, "SELECT nis, username FROM user WHERE id='$user_id'");
$data = mysqli_fetch_assoc($query);

$nis = $data['nis'] ?? '';
$username = $data['username'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Pengaduan</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body {
            background: linear-gradient(to right, #e2e2e2, #c894b4);
            min-height: 100vh;
            margin: 0;
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        form {
            background: #fff;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        form div {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #34495e;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        button {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            margin-right: 10px;
            color: white;
        }

        .btn-kembali {
            background-color: #7f8c8d;
        }

        .btn-kirim {
            background-color: #3498db;
        }

        .btn-kembali:hover {
            background-color: #636e72;
        }

        .btn-kirim:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<h1>Forum Pengaduan Sarana Sekolah</h1>

<form action="proses-pengaduan.php" method="POST">

    <!-- Hidden kirim user_id -->
    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id); ?>">

    <div>
        <label>NIS</label><br />
        <input type="text" value="<?= htmlspecialchars($nis); ?>" readonly />
    </div>

    <div>
        <label>Kategori</label><br>
        <select name="kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="1">Lingkungan</option>
            <option value="2">Fasilitas</option>
        </select>
    </div>

    <div>
        <label>Lokasi</label><br />
        <input type="text" name="lokasi" required />
    </div>

    <div>
        <label>Keterangan</label><br />
        <textarea name="keterangan" required></textarea>
    </div>

    <a href="index.php">
        <button type="button" class="btn-kembali">Kembali</button>
    </a>

    <button type="submit" class="btn-kirim">Kirim</button>

</form>

</body>
</html>