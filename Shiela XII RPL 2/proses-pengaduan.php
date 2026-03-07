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

<style>

body{
    font-family: Arial, sans-serif;
    background: linear-gradient(to right,#ffb6d9,#ffffff);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.card{
    background:white;
    padding:30px;
    border-radius:10px;
    width:350px;
    box-shadow:0 5px 20px rgba(0,0,0,0.2);
    text-align:center;
}

h2{
    color:#ffb6d9;
}

.data{
    text-align:left;
    margin-top:15px;
}

.data p{
    margin:6px 0;
}

button{
    margin-top:20px;
    padding:10px 20px;
    border:none;
    border-radius:6px;
    background:#ffb6d9;
    color:white;
    font-size:14px;
    cursor:pointer;
}

button:hover{
    background-collator_asort: #e560bd;
}

</style>

</head>
<body>

<div class="card">

<h2>✓ Pengaduan Berhasil Dikirim</h2>

<div class="data">
<p><b>NIS:</b> <?php echo $nis; ?></p>
<p><b>Kategori ID:</b> <?php echo $kategori; ?></p>
<p><b>Lokasi:</b> <?php echo $lokasi; ?></p>
<p><b>Keterangan:</b> <?php echo $keterangan; ?></p>
</div>

<a href="index.php">
<button>Kembali</button>
</a>

</div>

</body>
</html>

<?php
} else {
    echo "Gagal menyimpan pengaduan: " . mysqli_error($koneksi);
}
?>