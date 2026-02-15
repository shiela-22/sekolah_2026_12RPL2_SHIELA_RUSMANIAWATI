<!-- <?php
$nis = $_POST['nis'];
$kategori = $_POST['kategori'];
$lokasi = $_POST['lokasi'];
$keterangan = $_POST['keterangan'];


echo "<h2>Pengaduan berhasil dikirim</h2>";
echo "NIS: $nis <br>";
echo "kategori: $kategori <br>";
echo "Lokasi: $lokasi <br>";
echo "Keterangan: $keterangan <br>";


$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_shiela_rusmaniawat");
mysqli_query($koneksi,"INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `status`, `feedback`) 
VALUES (NULL, '$nis','$kategori','$lokasi', '$keterangan', 'Menunggu', NULL)");
?> -->


<?php
$nis = $_POST['nis'];
$kategori = $_POST['kategori'];
$lokasi = $_POST['lokasi'];
$keterangan = $_POST['keterangan'];

$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_shiela_rusmaniawat");

mysqli_query($koneksi,"INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `status`, `feedback`) 
VALUES (NULL, '$nis','$kategori','$lokasi', '$keterangan', 'Menunggu', NULL)");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengaduan Terkirim</title>
</head>
<body>

<h2>Pengaduan Berhasil Dikirim</h2>

<p>
    NIS: <?= htmlspecialchars($nis) ?> <br>
    Kategori: <?= htmlspecialchars($kategori) ?> <br>
    Lokasi: <?= htmlspecialchars($lokasi) ?> <br>
    Keterangan: <?= htmlspecialchars($keterangan) ?>
</p>

<!-- Tombol Kembali dan Logout -->
<p>
    <a href="index.php">Kembali</a> | 
    <a href="logout-pengaduan.php">Logout</a>
</p>

</body>
</html>
