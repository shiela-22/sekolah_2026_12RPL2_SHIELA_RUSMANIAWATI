<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengaduan Mutu Sekolah</title>
    <style>
        body{
            font-family: 'Quicksand';
            background: #f4f4f4;
            padding: 20px;
        }
        .container{
            background: #fff;
            padding: 30px;
            max-width: 300px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        h2{
            text-align: center;
        }
        input, textarea, button{
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button{
            background: #ff9ac1;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover{
            background: #ff9cb1;
        }
        .success{color: green;text-align:center;}
        .error{color:red;text-align:center;}
        a{display:block;text-align:center;margin-top:10px;text-decoration:none;color:#2193b0;}
    </style>
</head>
<body>

<div class="container">
    <h2>Form Pengaduan Mutu Sekolah</h2>

    <?php if(isset($success)) { echo "<p class='success'>$success</p>"; } ?>
    <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>

    <form method="post" action="">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="judul" placeholder="Judul Pengaduan" required>
        <textarea name="isi" placeholder="Isi Pengaduan" rows="5" required></textarea>
        <button type="submit" name="submit">Kirim Pengaduan</button>
    </form>

    <a href="index.php">Kembali ke Beranda</a>
</div>

</body>
</html>
