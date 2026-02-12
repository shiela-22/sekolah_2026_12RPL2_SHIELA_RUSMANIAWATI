<?php
// Koneksi ke database
$host = "localhost";
$db   = "ujikom_12rpl2_shiela_rusmaniawat";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

$keyword = "";
$hasil = [];

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    $sql = "SELECT * FROM pengaduan 
            WHERE nomor_pengaduan LIKE :keyword 
            OR nama_pelapor LIKE :keyword
            ORDER BY tanggal DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['keyword' => "%$keyword%"]);
    $hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cari Pengaduan</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        input[type=text] { padding: 8px; width: 300px; }
        input[type=submit] { padding: 8px 15px; }
    </style>
</head>
<body>

<h2>Cari Data Pengaduan</h2>

<form method="GET" action="">
    <input type="text" name="keyword" placeholder="Masukkan nomor atau nama pelapor..." value="<?= htmlspecialchars($keyword) ?>">
    <input type="submit" value="Cari">
</form>

<?php if ($keyword != ""): ?>
    <h3>Hasil Pencarian: "<?= htmlspecialchars($keyword) ?>"</h3>

    <?php if (count($hasil) > 0): ?>
        <table>
            <tr>
                <th>No</th>
                <th>Nomor Pengaduan</th>
                <th>Nama Pelapor</th>
                <th>Tanggal</th>
                <th>Isi Laporan</th>
                <th>Status</th>
            </tr>

            <?php foreach ($hasil as $index => $row): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($row['nomor_pengaduan']) ?></td>
                <td><?= htmlspecialchars($row['nama_pelapor']) ?></td>
                <td><?= htmlspecialchars($row['tanggal']) ?></td>
                <td><?= htmlspecialchars($row['isi_laporan']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Data tidak ditemukan.</p>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>
