<?php
session_start();

// ================= KONEKSI DATABASE =================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ujikom_12rpl2_shiela_rusmaniawat";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// ================= PROSES SIMPAN =================
if (isset($_POST['simpan'])) {

    $nis      = trim($_POST['nis']);
    $username = trim($_POST['username']);
    $kelas    = trim($_POST['kelas']);
    $password = trim($_POST['password']);

    if ($nis == "" || $username == "" || $kelas == "" || $password == "") {
        echo "<script>alert('Semua data wajib diisi!');</script>";
    } else {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user (nis, username, kelas, password)
                  VALUES ('$nis', '$username', '$kelas', '$password_hash')";

        mysqli_query($koneksi, $query);
        echo "<script>alert('Data berhasil disimpan');</script>";
    }
}

// ================= PROSES UPDATE =================
if (isset($_POST['update'])) {

    $nis        = $_POST['nis'];
    $username   = trim($_POST['username']);
    $password   = trim($_POST['password']);

    if ($username == "" || $password == "") {
        echo "<script>alert('Username dan Password wajib diisi!');</script>";
    } else {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $update = "UPDATE user 
                   SET username='$username', password='$password_hash' 
                   WHERE nis='$nis'";

        mysqli_query($koneksi, $update);
        echo "<script>alert('Data berhasil diubah'); window.location='';</script>";
    }
}

// ================= AMBIL DATA =================
$data = mysqli_query($koneksi, "SELECT nis, username, kelas FROM user");

// ================= AMBIL DATA UNTUK EDIT =================
$editData = null;
if (isset($_GET['edit'])) {
    $nis_edit = $_GET['edit'];
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE nis='$nis_edit'");
    $editData = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Siswa</title>
<style>
body {
    font-family: Arial;
    background: linear-gradient(to right,#ffb6d9,#ffffff);
    padding: 20px;
}

/* ===== BUTTON AREA ===== */
.btn-area {
    margin-bottom: 20px;
}
.btn {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    color: white;
    border-radius: 5px;
    margin-right: 10px;
    font-size: 14px;
}
.btn-back {
    background:#FADCE9;
}
.btn-logout {
    background:#FADCE9;
}

/* ===== FORM & TABLE ===== */
form {
    width: 350px;
    background: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 30px;
}
input {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
}
button {
    margin-top: 15px;
    padding: 10px;
    background:#FADCE9;
    color: white;
    border: none;
    cursor: pointer;
    width: 100%;
}
table {
    background: white;
    border-collapse: collapse;
    width: 80%;
}
th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: center;
}
th {
    background:#FADCE9;
    color: white;
}
a.edit-btn {
    color: blue;
    text-decoration: none;
}
</style>
</head>
<body>

<!-- ===== TOMBOL KEMBALI & LOGOUT ===== -->
<div class="btn-area">
    <a href="index.php" class="btn btn-back">⬅ Kembali</a>
    <a href="logout-pengaduan.php" class="btn btn-logout">Logout</a>
</div>

<h2>Form Input Data Siswa</h2>

<form method="post">
    <label>NIS</label>
    <input type="text" name="nis" required>

    <label>Username</label>
    <input type="text" name="username" required>

    <label>Kelas</label>
    <input type="text" name="kelas" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit" name="simpan">Simpan</button>
</form>

<?php if ($editData) { ?>
<h2>Form Ubah Username & Password</h2>
<form method="post">
    <input type="hidden" name="nis" value="<?= $editData['nis']; ?>">

    <label>Username Baru</label>
    <input type="text" name="username" value="<?= $editData['username']; ?>" required>

    <label>Password Baru</label>
    <input type="password" name="password" required>

    <button type="submit" name="update">Update</button>
</form>
<?php } ?>

<h2>Data Siswa</h2>

<table>
<tr>
    <th>NIS</th>
    <th>Username</th>
    <th>Kelas</th>
    <th>Aksi</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= htmlspecialchars($row['nis']); ?></td>
    <td><?= htmlspecialchars($row['username']); ?></td>
    <td><?= htmlspecialchars($row['kelas']); ?></td>
    <td>
        <a class="edit-btn" href="?edit=<?= $row['nis']; ?>">Edit</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>