<?php
$koneksi = mysqli_connect("localhost", "root", "", "ujikom_12rpl2_shiela_rusmaniawat");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>