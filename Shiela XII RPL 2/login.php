<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <style>
        body{
            font-family: Arial;
            background: linear-gradient(to right, #ffa1c5, #fafafa);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box{
            background: white;
            padding: 40px;
            width: 350px;
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
    <form action="proses-login.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>