<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role'])) {
    echo "Akses ditolak!";
    exit;
}

$role = $_SESSION['role'];
$no = 1;
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
$query = mysqli_query($koneksi, "
    SELECT input_aspirasi.*, kategori.ket_kategori
    FROM input_aspirasi
    LEFT JOIN kategori
        ON input_aspirasi.id_kategori = kategori.id_kategori
");

while ($data = mysqli_fetch_assoc($query)) {
?>

    <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['id_kategori']; ?></td>
        <td><?= $data['ket_kategori']; ?></td>
        <td><?= $data['lokasi']; ?></td>
        <td><?= $data['ket']; ?></td>
        <td><?= ucfirst($data['status']); ?></td>

        <?php if ($role == 'admin') { ?>
        <td>
            <!-- Detail -->
            <a href="detail-pengaduan.php?id=<?= $data['id_pelaporan']; ?>">
                <button>Detail</button>
            </a>

            <!-- Edit -->
            <a href="edit-pengaduan.php?id=<?= $data['id_pelaporan']; ?>">
                <button>Edit</button>
            </a>

            <!-- Delete -->
            <a href="delete-pengaduan.php?id=<?= $data['id_pelaporan']; ?>"
               onclick="return confirm('Yakin ingin menghapus data ini?')">
                <button>Delete</button>
            </a>
        </td>
        <?php } ?>

    </tr>

<?php } ?>

</table>

<br>

<a href="logout-pengaduan.php">
    <button>Logout</button>
</a>

<a href="index.php">
    <button>Kembali</button>
</a>

</body>
</html>