<?php
/* ================== KONEKSI DATABASE ================== */
$koneksi = mysqli_connect("localhost","root","","ujikom_12rpl2_shiela_rusmaniawat");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

/* ================== CEK ID ================== */
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

/* ================== AMBIL DATA ================== */
$data = mysqli_query($koneksi, "SELECT * FROM input_aspirasi WHERE id_pelaporan='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

/* ================== CEGAH NULL ================== */
$feedback = $row['feedback'] ?? '';
$status   = $row['status'] ?? '';
$lokasi   = $row['lokasi'] ?? '';
$kategori = $row['kategori'] ?? '';

/* ================== UPDATE DATA ================== */
if (isset($_POST['submit'])) {

    $feedback = $_POST['feedback'];
    $status   = $_POST['status'];
    $lokasi   = $_POST['lokasi'];
    $kategori = $_POST['kategori'];

    $update = mysqli_query($koneksi,"
        UPDATE input_aspirasi 
        SET feedback='$feedback',
            status='$status',
            lokasi='$lokasi',
            kategori='$kategori'
        WHERE id_pelaporan='$id'
    ");

    if($update){
        header("Location: tampildata.php");
        exit;
    }else{
        echo "Gagal update data";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Pengaduan</title>

<style>

/* BACKGROUND */
body{
font-family: 'Segoe UI', sans-serif;
background: linear-gradient(to right,#ffd6e7,#fff0f6);
margin:0;
padding:0;
}

/* BOX FORM */
.box{
width:420px;
background:white;
padding:30px;
margin:100px auto;
border-radius:18px;
box-shadow:0 10px 25px rgba(255,105,180,0.2);
border:3px solid #ffc1da;
}

/* JUDUL */
h2{
text-align:center;
color:#ff4f9a;
margin-bottom:20px;
}

/* INPUT */
textarea, select, input{
width:100%;
padding:10px;
margin-top:5px;
border-radius:8px;
border:1px solid #ffc1da;
outline:none;
font-size:14px;
}

textarea:focus, select:focus, input:focus{
background:#fff0f6;
border-color:#ff8fc1;
}

/* BUTTON */
button{
padding:10px 18px;
margin-top:15px;
border:none;
border-radius:10px;
background:#ff8fc1;
color:white;
font-weight:bold;
cursor:pointer;
transition:0.2s;
}

button:hover{
background:#ff6fa5;
}

/* BUTTON KEMBALI */
a button{
background:#ffb3d1;
}

a button:hover{
background:#ff9cc6;
}

</style>

</head>

<body>

<div class="box">

<h2>Update Status Pengaduan 💕</h2>

<form method="POST">

Lokasi:<br>
<input type="text" name="lokasi" value="<?= htmlspecialchars($lokasi); ?>">

<br><br>

Kategori:<br>
<select name="kategori">
<option value="jalan" <?= $kategori=="jalan"?"selected":""; ?>>Kerusakan Jalan</option>
<option value="lampu" <?= $kategori=="lampu"?"selected":""; ?>>Lampu Jalan</option>
<option value="sampah" <?= $kategori=="sampah"?"selected":""; ?>>Sampah</option>
<option value="lainnya" <?= $kategori=="lainnya"?"selected":""; ?>>Lainnya</option>
</select>

<br><br>

Feedback:<br>
<textarea name="feedback" rows="4"><?= htmlspecialchars($feedback); ?></textarea>

<br><br>

Status:<br>
<select name="status">
<option value="Menunggu" <?= $status=="Menunggu"?"selected":""; ?>>Menunggu</option>
<option value="Proses" <?= $status=="Proses"?"selected":""; ?>>Proses</option>
<option value="Selesai" <?= $status=="Selesai"?"selected":""; ?>>Selesai</option>
</select>

<br><br>

<button type="submit" name="submit">Update</button>
<a href="tampildata.php"><button type="button">Kembali</button></a>

</form>

</div>

</body>
</html>