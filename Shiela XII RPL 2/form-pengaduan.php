<?php
session_start();

// Koneksi database
$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_shiela_rusmaniawat");

if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek login
if (!isset($_SESSION['id'])) {  
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['id'];

// Ambil data user
$queryUser = mysqli_query($koneksi, "SELECT nis, username FROM user WHERE id='$user_id'");
$dataUser = mysqli_fetch_assoc($queryUser);

$nis = $dataUser['nis'] ?? '';
$username = $dataUser['username'] ?? '';

// Ambil data kategori dari database
$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html>
<head>
<title>Halaman Pengaduan</title>
<style>
*{box-sizing:border-box;font-family:Arial;}
body{background:#ffe6f0;min-height:100vh;margin:0;padding:40px;}
h1{text-align:center;color:#d63384;margin-bottom:30px;}
form{background:white;max-width:500px;margin:auto;padding:30px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.1);}
form div{margin-bottom:18px;}
label{font-weight:bold;color:#555;}
input[type="text"],select,textarea{width:100%;padding:10px;margin-top:6px;border-radius:6px;border:1px solid #ffc0d9;}
input:focus,select:focus,textarea:focus{outline:none;border-color:#ff66a3;}
textarea{min-height:100px;resize:vertical;}
button{padding:10px 18px;border:none;border-radius:6px;font-size:14px;cursor:pointer;margin-right:10px;color:white;}
.btn-kembali{background:#ffc0d9;color:#d63384;}
.btn-kembali:hover{background:#ffb3d1;}
.btn-kirim{background:#ff66a3;}
.btn-kirim:hover{background:#e05590;}
</style>
</head>
<body>

<h1>Form Pengaduan Sarana Sekolah</h1>

<form action="proses-pengaduan.php" method="POST">

<!-- Hidden kirim NIS -->
<input type="hidden" name="nis" value="<?= htmlspecialchars($nis); ?>">

<div>
<label>NIS</label>
<input type="text" value="<?= htmlspecialchars($nis); ?>" readonly>
</div>

<div>
<label>Kategori</label>
<select name="kategori" required>
<option value="">-- Pilih Kategori --</option>
<?php while($kat = mysqli_fetch_assoc($queryKategori)) { ?>
    <option value="<?= $kat['id_kategori']; ?>">
        <?= htmlspecialchars($kat['ket_kategori']); ?>
    </option>
<?php } ?>
</select>
</div>

<div>
<label>Lokasi</label>
<input type="text" name="lokasi" required>
</div>

<div>
<label>Keterangan</label>
<textarea name="keterangan" required></textarea>
</div>

<a href="index.php">
<button type="button" class="btn-kembali">Kembali</button>
</a>

<button type="submit" class="btn-kirim">Kirim</button>

</form>

</body>
</html>