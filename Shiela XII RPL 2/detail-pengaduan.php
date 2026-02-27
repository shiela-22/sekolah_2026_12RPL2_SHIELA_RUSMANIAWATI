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
body { font-family: Arial; padding: 20px; max-width: 700px; margin: auto; }
table { border-collapse: collapse; width: 100%; }
td { padding: 10px; border: 1px solid #ccc; vertical-align: top; }
select, textarea { width: 100%; padding: 8px; }
button { padding: 10px 20px; background: #ffcbe7; color: white; border: none; border-radius: 5px; cursor:pointer; }
button:hover { background: #ff97d5; }
a { display: inline-block; margin-top: 15px; text-decoration: none; color: #2980b9; }
</style>
</head>
<body>

<h2>Detail Pengaduan</h2>
<p><b>Role:</b> <?= htmlspecialchars(ucfirst($role)) ?></p>

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

<a href="index.php">← Kembali</a>

</body>
</html>