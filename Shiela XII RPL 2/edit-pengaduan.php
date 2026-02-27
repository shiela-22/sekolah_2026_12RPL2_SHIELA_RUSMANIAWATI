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
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

/* ================== UPDATE DATA ================== */
if (isset($_POST['submit'])) {

    $username = $_POST['username'] ?? '';
    $nis      = $_POST['nis'] ?? '';
    $kelas    = $_POST['kelas'] ?? '';

    mysqli_query($koneksi, "
        UPDATE user 
        SET username='$username',
            nis='$nis',
            kelas='$kelas'
        WHERE id='$id'
    ");

    header("Location: index.php");
    exit;
}

/* CEGAH NULL */
$row = array_map(function($v){
    return $v ?? '';
}, $row);
?>

<h2>Edit Data Siswa</h2>

<form method="POST">

    Username:<br>
    <input type="text" name="username" 
           value="<?= htmlspecialchars($row['username']); ?>"><br><br>

    NIS:<br>
    <input type="text" name="nis" 
           value="<?= htmlspecialchars($row['nis']); ?>"><br><br>

    Kelas:<br>
    <input type="text" name="kelas" 
           value="<?= htmlspecialchars($row['kelas']); ?>"><br><br>

    <button type="submit" name="submit">Update</button>
    
    <!-- BUTTON KEMBALI -->
    <a href="index.php">
        <button type="button">Kembali</button>
    </a>

</form>