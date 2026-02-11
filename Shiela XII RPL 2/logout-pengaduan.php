<?php
// Mulai session
session_start();

// Kosongkan semua data session
$_SESSION = array();

// Hancurkan session
session_destroy();

// Arahkan kembali ke halaman login
header("Location: login.php");
exit;
?>