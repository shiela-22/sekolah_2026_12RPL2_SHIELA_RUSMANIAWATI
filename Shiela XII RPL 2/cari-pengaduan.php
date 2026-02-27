<?php
/* =========================
   KONEKSI DATABASE
========================= */
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ujikom_12rpl2_shiela_rusmaniawat";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

/* =========================
   PROSES CARI
========================= */
$keyword = "";
$hasil = [];
$statusList = ["Menunggu", "proses", "selesai"];

if (isset($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    $sql = "SELECT * FROM input_aspirasi 
            WHERE nis LIKE '%$keyword%' 
               OR lokasi LIKE '%$keyword%'";
    $query = mysqli_query($koneksi, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $hasil[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cari Pengaduan</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right,#ffb6d9,#ffffff);
    display: flex;
    justify-content: center;
    padding: 50px 0;
    margin: 0;
}

.container {
    background: #fff;
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,.2);
    width: 950px;
}

h2 { text-align:center; color:#2c3e50; }

input[type=text] {
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #ccc;
}

button {
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#FADCE9;
    color:#fff;
    font-size:16px;
    cursor:pointer;
}

table {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th, td {
    border:1px solid #cccccc;
    padding:10px;
    text-align:center;
}

th {
    background:#FADCE9;
    color:white;
}

.detail-btn {
    background:#FADCE9;
    color:white;
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
}

.status-select {
    padding:6px;
    border-radius:6px;
}

.back-btn {
    display:block;
    margin-top:25px;
    text-align:center;
    background:#95a5a6;
    color:white;
    padding:10px;
    border-radius:8px;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="container">
<h2>Cari Pengaduan</h2>

<form method="GET">
    <input type="text" name="keyword" placeholder="Cari NIS atau Lokasi"
           value="<?= htmlspecialchars($keyword); ?>" required>
    <button type="submit" name="cari">Cari</button>
</form>

<?php if (isset($_GET['cari'])) { ?>
<h3 style="margin-top:20px;">Hasil Pencarian</h3>

<?php if ($hasil) { ?>
<table>
<tr>
    <th>NO</th>
    <th>TANGGAL</th>
    <th>NIS</th>
    <th>KETERANGAN</th>
    <th>LOKASI</th>
    <th>STATUS</th>
    <th>AKSI</th>
</tr>

<?php $no=1; foreach ($hasil as $h) { ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= date('d-m-Y', strtotime($h['tanggal'])); ?></td>
    <td><?= htmlspecialchars($h['nis']); ?></td>

    <td>
        <?= htmlspecialchars(
            strlen($h['ket']) > 40
            ? substr($h['ket'],0,40).'...'
            : $h['ket']
        ); ?>
    </td>

    <td><?= htmlspecialchars($h['lokasi']); ?></td>

    <td>
        <select class="status-select" disabled>
            <?php foreach ($statusList as $s) { ?>
                <option <?= ($h['status']==$s)?'selected':''; ?>>
                    <?= ucfirst($s); ?>
                </option>
            <?php } ?>
        </select>
    </td>

    <td>
        <a class="detail-btn"
           href="detail-pengaduan.php?id=<?= $h['id_pelaporan']; ?>">
           Detail
        </a>
    </td>
</tr>
<?php } ?>
</table>

<?php } else { ?>
<p style="text-align:center;color:red;">Data tidak ditemukan</p>
<?php } } ?>

<a href="index.php" class="back-btn">← Kembali</a>
</div>

</body>
</html>