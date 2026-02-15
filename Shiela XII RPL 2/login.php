<?php
session_start();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // ===== DATA LOGIN SEDERHANA =====
    // ADMIN
    if($username == "admin" && $password == "12345"){
        $_SESSION['username'] = $username;
        $_SESSION['role']     = "admin";
        header("Location: dashboard.php");
        exit();
    }

    // SISWA
    elseif($username == "siswa" && $password == "12345"){
        $_SESSION['username'] = $username;
        $_SESSION['role']     = "siswa";
        header("Location: dashboard.php");
        exit();
    }

    else{
        $error = "Login gagal! Username atau Password salah.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Pengaduan Mutu</title>
<style>
body{
    font-family: Arial;
    background: linear-gradient(to right,#ffa1c5,#fafafa);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}
.login-box{
    background:white;
    padding:40px;
    width:300px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 0 15px rgba(0,0,0,0.2);
}
input{
    width:100%;
    padding:10px;
    margin:8px 0;
}
button{
    background:#ff69b4;
    color:white;
    padding:10px;
    width:100%;
    border:none;
    cursor:pointer;
}
button:hover{
    background:#ff3e9e;
}
.error{
    color:red;
}
</style>
</head>
<body>

<div class="login-box">
<h2>Login</h2>

<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" name="login">Login</button>
</form>

</div>

</body>
</html>
