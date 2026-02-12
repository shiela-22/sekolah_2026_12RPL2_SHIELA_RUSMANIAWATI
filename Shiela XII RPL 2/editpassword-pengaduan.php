<?php
session_start();
include "koneksi.php"; // file koneksi database

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

if (isset($_POST['submit'])) {

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Ambil password lama dari database
    $query = mysqli_query($conn, "SELECT password FROM users WHERE id='$user_id'");
    $data = mysqli_fetch_assoc($query);
    $db_password = $data['password'];

    // Validasi password lama
    if (!password_verify($old_password, $db_password)) {
        $message = "<div class='alert alert-danger'>Password lama salah!</div>";
    }
    // Validasi konfirmasi password
    elseif ($new_password != $confirm_password) {
        $message = "<div class='alert alert-danger'>Konfirmasi password tidak cocok!</div>";
    }
    else {
        // Hash password baru
        $new_hash = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password
        $update = mysqli_query($conn, "UPDATE users SET password='$new_hash' WHERE id='$user_id'");

        if ($update) {
            $message = "<div class='alert alert-success'>Password berhasil diubah!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Gagal mengubah password!</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Edit Password</h4>
        </div>
        <div class="card-body">
            <?php echo $message; ?>
            <form method="POST">
                <div class="mb-3">
                    <label>Password Lama</label>
                    <input type="password" name="old_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>

                <button type="submit" name="submit" class="btn btn-success">
                    Update Password
                </button>
                <a href="dashboard.php" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
