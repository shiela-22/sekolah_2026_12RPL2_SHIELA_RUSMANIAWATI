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

$role = $_SESSION['role'];
$no   = 1;

/* =========================
   CEK NIS (khusus siswa)
========================= */
$nis = isset($_SESSION['nis']) ? $_SESSION['nis'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Pengaduan</title>
</head>
<body>

<h2>Data Pengaduan</h2>

<table border="1" cellpadding="10" cellspacing="0">
<tr>
    <th>No</th>
    <th>ID Kategori</th>
    <th>Nama Kategori</th>
    <th>Lokasi</th>
    <th>Keterangan</th>
    <th>Status</th>
    <?php if ($role == 'admin') { ?>
        <th>Aksi</th>
    <?php } ?>
</tr>

<?php
if ($role == 'admin') {
    // ADMIN lihat semua data
    $query = mysqli_query($koneksi, "
        SELECT input_aspirasi.*, kategori.ket_kategori
        FROM input_aspirasi
        LEFT JOIN kategori
        ON input_aspirasi.id_kategori = kategori.id_kategori
    ");
} else {
    // SISWA hanya lihat data sendiri
    $query = mysqli_query($koneksi, "
        SELECT input_aspirasi.*, kategori.ket_kategori
        FROM input_aspirasi
        LEFT JOIN kategori
        ON input_aspirasi.id_kategori = kategori.id_kategori
        WHERE nis='$nis'
    ");
}

while ($data = mysqli_fetch_assoc($query)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($data['id_kategori']); ?></td>
    <td><?= htmlspecialchars($data['ket_kategori']); ?></td>
    <td><?= htmlspecialchars($data['lokasi']); ?></td>
    <td><?= htmlspecialchars($data['ket']); ?></td>
    <td><?= ucfirst(htmlspecialchars($data['status'])); ?></td>

    <?php if ($role == 'admin') { ?>
    <td>
        <a href="detail-pengaduan.php?id=<?= $data['id_pelaporan']; ?>">
            <button>Detail</button>
        </a>
    </td>
    <?php } ?>
</tr>
<?php } ?>

</table>

<br>

<a href="logout_pengaduan.php">
    <button>Logout</button>
</a>

<a href="index.php">
    <button>Kembali</button>
</a>

</body>
</html>