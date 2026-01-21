<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengaduan</title>
    <style>
        body{
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }
        .container{
            background: #fff;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow:0 0 10px rgb(255, 157, 203);
        }
        h2{text-align:center;}
        p{margin:10px 0;}
        label{font-weight:bold;}
        select, button{
            padding:10px;
            margin-top:10px;
            width: 100%;
            border-radius:5px;
            border:1px solid #ffb3d3;
        }
        button{
            background:#2193b0;
            color:white;
            border:none;
            cursor:pointer;
        }
        button:hover{
            background:#176b87;
        }
        a{
            display:block;
            margin-top:15px;
            text-align:center;
            text-decoration:none;
            color:#2193b0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Detail Pengaduan</h2>

    <p><label>Nama:</label> <?= $data['nama']; ?></p>
    <p><label>Email:</label> <?= $data['email']; ?></p>
    <p><label>Judul:</label> <?= $data['judul']; ?></p>
    <p><label>Isi:</label><br><?= nl2br($data['isi']); ?></p>
    <p><label>Status:</label> <?= $data['status']; ?></p>
    <p><label>Tanggal:</label> <?= $data['tanggal']; ?></p>

    <!-- Form update status, bisa dihapus jika hanya user -->
    <form method="post">
        <label>Ubah Status:</label>
        <select name="status">
            <option value="Dikirim" <?= $data['status']=='Dikirim'?'selected':'' ?>>Dikirim</option>
            <option value="Diproses" <?= $data['status']=='Diproses'?'selected':'' ?>>Diproses</option>
            <option value="Selesai" <?= $data['status']=='Selesai'?'selected':'' ?>>Selesai</option>
        </select>
        <button type="submit" name="update">Update Status</button>
    </form>

    <a href="index.php">Kembali ke Beranda</a>
</div>

</body>
</html>
