<?php
session_start();

/* ================== KONEKSI DATABASE ================== */
$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_shiela_rusmaniawat");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

/* ================== CEK LOGIN ================== */
if (!isset($_SESSION['role'])) {
    echo "Akses ditolak!";
    exit;
}

$role = $_SESSION['role'];
$no = 1;

/* ================== AMBIL DATA ================== */
$query = mysqli_query($koneksi, "
    SELECT input_aspirasi.*, kategori.ket_kategori
    FROM input_aspirasi
    LEFT JOIN kategori
        ON input_aspirasi.id_kategori = kategori.id_kategori
    ORDER BY input_aspirasi.id_pelaporan DESC
");

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>
<head>
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

<?php while ($data = mysqli_fetch_assoc($query)) { 
    // cegah NULL (anti deprecated)
    $data = array_map(function($v){ return $v ?? ''; }, $data);
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
            <button type="button">Detail</button>
        </a>

        <a href="edit-pengaduan.php?id=<?= $data['id_pelaporan']; ?>">
            <button type="button">Edit</button>
        </a>

        <a href="delete-pengaduan.php?id=<?= $data['id_pelaporan']; ?>"
           onclick="return confirm('Yakin ingin menghapus data ini?')">
            <button type="button">Delete</button>
        </a>
    </td>
    <?php } ?>

</tr>
<?php } ?>

</table>

<br><br>

<a href="logout-pengaduan.php"><button type="button">Logout</button></a>
<a href="index.php"><button type="button">Kembali</button></a>

</body>
</html>