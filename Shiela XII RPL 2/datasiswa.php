<?php
session_start();
include 'koneksi.php';

/*
=========================================
STRUKTUR DATABASE YANG DIGUNAKAN
=========================================

Tabel input_aspirasi:
- id_pelaporan
- nis
- id_kategori
- lokasi
- ket
- status
- feedback

Tabel kategori:
- id_kategori
- ket_kategori

Tabel user:
- id
- username
- password
- role
- nis
- kelas
=========================================
*/

// =======================
// CEK SESSION LOGIN
// =======================
// Pastikan saat login kamu menyimpan $_SESSION['nis']
if(!isset($_SESSION['nis'])) {
    $_SESSION['nis'] = '04'; // contoh sesuai database
}

$nis = $_SESSION['nis'];


// =======================
// PROSES SIMPAN PENGADUAN
// =======================
if(isset($_POST['submit'])) {

    $id_kategori = $_POST['id_kategori'];
    $lokasi      = $_POST['lokasi'];
    $keterangan  = $_POST['keterangan'];

    $query_insert = "INSERT INTO input_aspirasi 
    (
        nis,
        id_kategori,
        lokasi,
        ket,
        status,
        feedback
    )
    VALUES
    (
        '$nis',
        '$id_kategori',
        '$lokasi',
        '$keterangan',
        'Menunggu',
        NULL
    )";

    mysqli_query($koneksi, $query_insert);

    header("Location: pengaduan_siswa.php");
    exit();
}


// =======================
// QUERY DATA PENGADUAN
// =======================
$query = mysqli_query($koneksi, "
    SELECT 
        input_aspirasi.id_pelaporan,
        input_aspirasi.nis,
        input_aspirasi.id_kategori,
        input_aspirasi.lokasi,
        input_aspirasi.ket,
        input_aspirasi.status,
        kategori.ket_kategori
    FROM input_aspirasi
    LEFT JOIN kategori 
        ON input_aspirasi.id_kategori = kategori.id_kategori
    WHERE input_aspirasi.nis = '$nis'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengaduan Siswa</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { margin-bottom: 40px; }
        input, select, textarea { width: 100%; padding: 8px; margin: 8px 0; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; }
        th { background-color: #f2f2f2; }
        button, a.btn {
            display: inline-block;
            padding: 10px 20px;
            background: pink;
            border: none;
            color: black;
            cursor: pointer;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-right: 10px;
        }
        button:hover, a.btn:hover {
            background: #ff69b4;
            color: white;
        }
        .btn-logout {
            background: #e74c3c;
            color: white;
        }
        .btn-logout:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

<h2>Form Pengaduan</h2>

<form method="post">

    <label>Kategori</label>
    <select name="id_kategori" required>
        <option value="">-- Pilih Kategori --</option>

        <?php
        $kategori = mysqli_query($koneksi, "
            SELECT 
                id_kategori,
                ket_kategori
            FROM kategori
        ");

        while($data_kategori = mysqli_fetch_assoc($kategori)) {
            echo "<option value='".$data_kategori['id_kategori']."'>"
                 .htmlspecialchars($data_kategori['ket_kategori']).
                 "</option>";
        }
        ?>
    </select>

    <label>Lokasi</label>
    <input type="text" name="lokasi" required>

    <label>Keterangan</label>
    <textarea name="keterangan" required></textarea>

    <button type="submit" name="submit">Kirim Pengaduan</button>

</form>


<h2>Daftar Pengaduan Saya</h2>

<table>
<tr>
    <th>No</th>
    <th>ID Pelaporan</th>
    <th>NIS</th>
    <th>Kategori</th>
    <th>Lokasi</th>
    <th>Keterangan</th>
    <th>Status</th>
</tr>

<?php
$no = 1;

while($row = mysqli_fetch_assoc($query)) {
    echo "<tr>";
    echo "<td>".$no++."</td>";
    echo "<td>".htmlspecialchars($row['id_pelaporan'])."</td>";
    echo "<td>".htmlspecialchars($row['nis'])."</td>";
    echo "<td>".htmlspecialchars($row['ket_kategori'])."</td>";
    echo "<td>".htmlspecialchars($row['lokasi'])."</td>";
    echo "<td>".htmlspecialchars($row['ket'])."</td>";
    echo "<td>".htmlspecialchars($row['status'])."</td>";
    echo "</tr>";
}
?>

</table>

<!-- Tombol Kembali dan Logout -->
<div style="margin-top: 20px;">
    <a href="index.php" class="btn">Kembali</a>
    <a href="logout-pengaduan.php" class="btn btn-logout">Logout</a>
</div>

</body>
</html>
