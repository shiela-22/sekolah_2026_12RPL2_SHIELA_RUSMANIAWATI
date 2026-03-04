<?php
session_start();

/* =========================
   KONEKSI DATABASE
========================= */
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ujikom_12rpl2_shiela_rusmaniawat";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

/* =========================
   CEK ROLE
========================= */
if (!isset($_SESSION['role'])) {
    echo "Akses ditolak!";
    exit;
}

/* =========================
   CEK ID
========================= */
if (!isset($_GET['id'])) {
    echo "ID pengaduan tidak ditemukan!";
    exit;
}

$id   = mysqli_real_escape_string($koneksi, $_GET['id']);
$role = $_SESSION['role'];

/* =========================
   UPDATE (ADMIN ONLY)
========================= */
if ($role == 'admin' && isset($_POST['simpan'])) {

    $status   = mysqli_real_escape_string($koneksi, $_POST['status']);
    $feedback = mysqli_real_escape_string($koneksi, $_POST['feedback']);

    $update = mysqli_query($koneksi, "
        UPDATE input_aspirasi 
        SET status='$status', feedback='$feedback' 
        WHERE id_pelaporan='$id'
    ");

    if ($update) {
        header("Location: data-pengaduan.php");
        exit;
    } else {
        echo "Gagal menyimpan data!";
        exit;
    }
}

/* =========================
   AMBIL DATA
========================= */
$query = mysqli_query($koneksi, "
    SELECT input_aspirasi.*, kategori.ket_kategori
    FROM input_aspirasi
    LEFT JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
    WHERE input_aspirasi.id_pelaporan = '$id'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data pengaduan tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Pengaduan</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background: #ffe6f0;
    margin: 0;
    padding: 40px;
}

.container{
    max-width: 700px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

h2{
    text-align: center;
    color: #d63384;
}

.role{
    text-align:center;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse: collapse;
}

td{
    padding:10px;
    border:1px solid #ffc0d9;
}

tr:nth-child(even){
    background:#fff0f6;
}

select, textarea{
    width:100%;
    padding:8px;
    border-radius:5px;
    border:1px solid #ffc0d9;
}

textarea{
    resize:none;
}

button{
    background:#ff66a3;
    color:white;
    border:none;
    padding:10px 18px;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:#e05590;
}

.kembali{
    display:inline-block;
    margin-top:20px;
    color:#d63384;
    text-decoration:none;
    font-weight:bold;
}

</style>

</head>
<body>

<div class="container">

<h2>Detail Pengaduan</h2>

<p class="role"><b>Role:</b> <?= htmlspecialchars(ucfirst($role)) ?></p>

<form method="POST">

<table>

<tr>
<td><b>ID Pengaduan</b></td>
<td><?= htmlspecialchars($data['id_pelaporan']) ?></td>
</tr>

<tr>
<td><b>Kategori</b></td>
<td><?= htmlspecialchars($data['ket_kategori'] ?? '-') ?></td>
</tr>

<tr>
<td><b>Lokasi</b></td>
<td><?= htmlspecialchars($data['lokasi'] ?? '-') ?></td>
</tr>

<tr>
<td><b>Keterangan</b></td>
<td><?= nl2br(htmlspecialchars($data['ket'] ?? '-')) ?></td>
</tr>

<tr>
<td><b>Status</b></td>
<td>

<?php if ($role == 'admin'): ?>

<select name="status" required>
<option value="menunggu" <?= ($data['status']=='menunggu')?'selected':'' ?>>Menunggu</option>
<option value="proses" <?= ($data['status']=='proses')?'selected':'' ?>>Proses</option>
<option value="selesai" <?= ($data['status']=='selesai')?'selected':'' ?>>Selesai</option>
</select>

<?php else: ?>

<?= htmlspecialchars(ucfirst($data['status'] ?? '-')) ?>

<?php endif; ?>

</td>
</tr>

<?php if ($role == 'admin'): ?>

<tr>
<td><b>Feedback Admin</b></td>
<td>
<textarea name="feedback" rows="5"><?= htmlspecialchars($data['feedback'] ?? '') ?></textarea>
</td>
</tr>

<?php endif; ?>

</table>

<br>

<?php if ($role == 'admin'): ?>
<button type="submit" name="simpan">Simpan Perubahan</button>
<?php endif; ?>

</form>

<a href="index.php" class="kembali">← Kembali</a>

</div>

</body>
</html>