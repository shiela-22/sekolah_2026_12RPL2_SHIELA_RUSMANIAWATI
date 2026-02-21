<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];

    mysqli_query($koneksi, "UPDATE user 
        SET username='$username',
            nis='$nis',
            kelas='$kelas'
        WHERE id='$id'");

    header("Location: index.php");
    exit;
}
?>

<h2>Edit Data Siswa</h2>

<form method="POST">
    Username:
    <input type="text" name="username" value="<?= $row['username']; ?>"><br><br>

    NIS:
    <input type="text" name="nis" value="<?= $row['nis']; ?>"><br><br>

    Kelas:
    <input type="text" name="kelas" value="<?= $row['kelas']; ?>"><br><br>

    <button type="submit" name="submit">Update</button>
</form>