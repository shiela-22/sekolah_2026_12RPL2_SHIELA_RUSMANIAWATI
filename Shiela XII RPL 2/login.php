<?php
session_start();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Contoh login sederhana
    if($username == "cila admin" && $password == "1226"){
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "Login gagal!";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <style>
        body{
            font-family: 'Quicksand';
            background: linear-gradient(to right, #ffa1c5, #fafafa);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box{
            background: white;
            padding: 40px;
            width: 200px;
            border-radius: 10px;
            text-align: center;
        }
        input{
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        button{
            background: #ffadcd;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>
    <form method="POST">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <button type="submit" name="login">Login</button>
</form>
</div>

</body>
</html>