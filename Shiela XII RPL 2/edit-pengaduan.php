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

/* ================== CEK KOLOM ================== */
$cek1 = mysqli_query($koneksi,"SHOW COLUMNS FROM user LIKE 'feedback'");
if(mysqli_num_rows($cek1)==0){
    mysqli_query($koneksi,"ALTER TABLE user ADD feedback TEXT");
}

$cek2 = mysqli_query($koneksi,"SHOW COLUMNS FROM user LIKE 'status'");
if(mysqli_num_rows($cek2)==0){
    mysqli_query($koneksi,"ALTER TABLE user ADD status VARCHAR(20)");
}

/* ================== AMBIL DATA ================== */
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

/* ================== CEGAH NULL ================== */
$feedback = $row['feedback'] ?? '';
$status   = $row['status'] ?? '';

/* ================== UPDATE DATA ================== */
if (isset($_POST['submit'])) {

    $feedback = $_POST['feedback'] ?? '';
    $status   = $_POST['status'] ?? '';

    mysqli_query($koneksi,"
        UPDATE user 
        SET feedback='$feedback',
            status='$status'
        WHERE id='$id'
    ");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Pengaduan</title>

<style>

body{
font-family: Arial, sans-serif;
background:#ffe4ec;
margin:0;
padding:0;
}

/* BOX FORM */

.box{
width:420px;
background:white;
padding:25px;
margin:120px auto;
border-radius:12px;
box-shadow:0 8px 20px rgba(0,0,0,0.1);
border:2px solid #ffc1d6;
}

h2{
text-align:center;
color:#ff4f87;
margin-bottom:20px;
}

/* INPUT */

textarea, select{
width:100%;
padding:10px;
margin-top:5px;
border-radius:6px;
border:1px solid #ffb6c1;
outline:none;
}

textarea:focus, select:focus{
border-color:#ff4f87;
}

/* BUTTON */

button{
padding:10px 18px;
margin-top:15px;
border:none;
border-radius:6px;
background:#ff6fa5;
color:white;
font-weight:bold;
cursor:pointer;
}

button:hover{
background:#ff4f87;
}

/* LINK BUTTON */

a button{
background:#ffb6c1;
}

a button:hover{
background:#ff8fb3;
}

</style>

</head>

<body>

<div class="box">

<h2>Update Status Pengaduan</h2>

<form method="POST">

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
<a href="index.php"><button type="button">Kembali</button></a>

</form>

</div>

</body>
</html>