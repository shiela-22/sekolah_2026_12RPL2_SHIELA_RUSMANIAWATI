<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role'])) {
    echo "Akses ditolak!";
    exit;
}

$role = $_SESSION['role'];
$no = 1;

// Ambil data sesuai role
if ($role == 'admin') {
    $query = mysqli_query($koneksi, "
        SELECT input_aspirasi.*, kategori.ket_kategori
        FROM input_aspirasi
        LEFT JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
        ORDER BY input_aspirasi.id_pelaporan DESC
    ");
} elseif ($role == 'siswa') {
    $nis = $_SESSION['nis'] ?? '';
    $query = mysqli_query($koneksi, "
        SELECT input_aspirasi.*, kategori.ket_kategori
        FROM input_aspirasi
        LEFT JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
        WHERE input_aspirasi.nis = '$nis'
        ORDER BY input_aspirasi.id_pelaporan DESC
    ");
} else {
    $query = false;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Data Pengaduan</title>
</head>
<body>

<h2>Data Pengaduan</h2>

<?php if ($query && mysqli_num_rows($query) > 0) { ?>
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

    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
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
<?php } else { ?>
    <p><i>Tidak ada data pengaduan untuk ditampilkan.</i></p>
<?php } ?>

<br>

<a href="logout-pengaduan.php">
    <button>Logout</button>
</a>

<a href="index.php">
    <button>Kembali</button>
</a>

</body>
</html>
