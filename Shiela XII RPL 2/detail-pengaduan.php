<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role'])) {
    echo "Akses ditolak!";
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID pengaduan tidak ditemukan!";
    exit;
}

$id   = $_GET['id'];
$role = $_SESSION['role'];


// ================== UPDATE (HANYA ADMIN) ==================
if ($role == 'admin' && isset($_POST['simpan'])) {

    $status   = $_POST['status'];
    $feedback = $_POST['feedback'];

    mysqli_query($koneksi, "
        UPDATE input_anspirasi 
        SET status='$status', feedback='$feedback' 
        WHERE id_pelaporan='$id'
    ");

    header("Location: admin.php");
    exit;
}


// ================== AMBIL DATA ==================
$query = mysqli_query($koneksi, "
    SELECT input_anspirasi.*, kategori.ket_kategori
    FROM input_anspirasi
    LEFT JOIN kategori
        ON input_anspirasi.id_kategori = kategori.id_kategori
    WHERE input_anspirasi.id_pelaporan = '$id'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data pengaduan tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pengaduan</title>
</head>
<body>

<h2>Detail Pengaduan</h2>
<p><b>Role:</b> <?= ucfirst($role) ?></p>

<form method="POST">

<table border="1" cellpadding="8" cellspacing="0">

    <tr>
        <td><b>ID Pengaduan</b></td>
        <td><?= $data['id_pelaporan']; ?></td>
    </tr>

    <tr>
        <td><b>NIS</b></td>
        <td><?= $data['nis']; ?></td>
    </tr>

    <tr>
        <td><b>Kategori</b></td>
        <td><?= $data['ket_kategori']; ?></td>
    </tr>

    <tr>
        <td><b>Lokasi</b></td>
        <td><?= $data['lokasi']; ?></td>
    </tr>

    <tr>
        <td><b>Keterangan</b></td>
        <td><?= $data['ket']; ?></td>
    </tr>

    <!-- STATUS -->
    <tr>
        <td><b>Status</b></td>
        <td>
            <?php if ($role == 'admin') { ?>
                <select name="status">
                    <option value="menunggu" <?= ($data['status']=='menunggu')?'selected':'' ?>>Menunggu</option>
                    <option value="proses" <?= ($data['status']=='proses')?'selected':'' ?>>Proses</option>
                    <option value="selesai" <?= ($data['status']=='selesai')?'selected':'' ?>>Selesai</option>
                </select>
            <?php } else { ?>
                <?= ucfirst($data['status']); ?>
            <?php } ?>
        </td>
    </tr>

    <!-- FEEDBACK ADMIN -->
    <?php if ($role == 'admin') { ?>
    <tr>
        <td><b>Feedback Admin</b></td>
        <td>
            <textarea name="feedback" rows="4" cols="40"><?= $data['feedback']; ?></textarea>
        </td>
    </tr>
    <?php } ?>

</table>

<br>

<?php if ($role == 'admin') { ?>
    <button type="submit" name="simpan">Simpan Perubahan</button>
<?php } ?>

<a href="index.php">Kembali</a>

</form>

</body>
</html>
