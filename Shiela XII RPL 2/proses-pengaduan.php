<?php
session_start();
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

// Ambil NIS dari database berdasarkan user login
$queryUser = mysqli_query($koneksi, "SELECT nis FROM user WHERE id='$user_id'");
$dataUser  = mysqli_fetch_assoc($queryUser);
$nis       = $dataUser['nis'] ?? '';

// Ambil input lain
$kategori   = isset($_POST['kategori']) ? intval($_POST['kategori']) : 0;
$lokasi     = mysqli_real_escape_string($koneksi, $_POST['lokasi'] ?? '');
$keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');

// Validasi
if (empty($nis) || $kategori <= 0 || empty($lokasi) || empty($keterangan)) {
    die("Data tidak lengkap. Pastikan semua field diisi dengan benar.");
}

// Insert ke database
$sql = "INSERT INTO input_aspirasi 
        (nis, id_kategori, lokasi, ket, status, feedback) 
        VALUES ('$nis', $kategori, '$lokasi', '$keterangan', 'Menunggu', NULL)";

if (mysqli_query($koneksi, $sql)) {
    echo "<h2>Pengaduan berhasil dikirim</h2>";
    echo "NIS: " . htmlspecialchars($nis) . "<br>";
    echo "Kategori ID: " . htmlspecialchars($kategori) . "<br>";
    echo "Lokasi: " . htmlspecialchars($lokasi) . "<br>";
    echo "Keterangan: " . htmlspecialchars($keterangan) . "<br><br>";
    echo '<a href="form-pengaduan.php"><button>Kembali</button></a>';
} else {
    echo "Gagal menyimpan pengaduan: " . mysqli_error($koneksi);
}
?>