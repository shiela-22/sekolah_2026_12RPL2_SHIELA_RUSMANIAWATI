<?php
session_start();
require_once 'koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare($koneksi, "DELETE FROM input_aspirasi WHERE id_pelaporan = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: index.php");
exit;
?>