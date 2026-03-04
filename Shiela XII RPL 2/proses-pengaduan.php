<?php
// koneksi database
$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_shiela_rusmaniawat");

if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}

// ambil data dari form
$nis        = isset($_POST['nis']) ? mysqli_real_escape_string($koneksi,$_POST['nis']) : '';
$kategori   = isset($_POST['kategori']) ? intval($_POST['kategori']) : 0;
$lokasi     = isset($_POST['lokasi']) ? mysqli_real_escape_string($koneksi,$_POST['lokasi']) : '';
$keterangan = isset($_POST['keterangan']) ? mysqli_real_escape_string($koneksi,$_POST['keterangan']) : '';

// validasi
if (empty($nis) || $kategori <= 0 || empty($lokasi) || empty($keterangan)) {
    die("Data tidak lengkap. Pastikan semua field diisi dengan benar.");
}

// simpan ke database
$sql = "INSERT INTO input_aspirasi 
        (nis, id_kategori, lokasi, ket, status, feedback) 
        VALUES ('$nis','$kategori','$lokasi','$keterangan','Menunggu',NULL)";

if (mysqli_query($koneksi, $sql)) {
?>

<!DOCTYPE html>
<html>
<head>
<title>Pengaduan Berhasil</title>
</head>
<body>

<h2>Pengaduan berhasil dikirim</h2>

NIS: <?php echo $nis; ?> <br>
Kategori ID: <?php echo $kategori; ?> <br>
Lokasi: <?php echo $lokasi; ?> <br>
Keterangan: <?php echo $keterangan; ?> <br><br>

<a href="index.php"><button>Kembali</button></a>

</body>
</html>

<?php
} else {
    echo "Gagal menyimpan pengaduan: " . mysqli_error($koneksi);
}
?>