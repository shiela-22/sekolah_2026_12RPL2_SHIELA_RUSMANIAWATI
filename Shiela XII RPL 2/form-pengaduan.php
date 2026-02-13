<!DOCTYPE html>
<html>
<head>
    <title>Halaman Pengaduan</title>
    <link rel="stylesheet" href="style.css">
    <style>
       /* RESET */
* {
    box-sizing: border-box;
    font-family: 'Quicksand';
}

/* BODY */
body {
    background: linear-gradient(to right, #ffffff, #ffbbd5);
    min-height: 100vh;
    margin: 0;
    padding: 40px;
}

/* JUDUL */
h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 30px;
}

/* FORM */
form {
    background: #fff;
    max-width: 500px;
    margin: auto;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* SETIAP FIELD */
form div {
    margin-bottom: 20px;
}

/* LABEL */
label {
    font-weight: bold;
    color: #34495e;
}

/* INPUT, SELECT, TEXTAREA */
input[type="text"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
}

/* TEXTAREA */
textarea {
    min-height: 100px;
    resize: vertical;
}

/* BUTTON */
button {
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    margin-right: 10px;
}

/* TOMBOL KIRIM */
button:last-of-type {
    background-color: #3498db;
    color: white;
}

button:last-of-type:hover {
    background-color: #2980b9;
}

/* TOMBOL KEMBALI */
button a {
    text-decoration: none;
    color: white;
}

button:first-of-type {
    background-color: #7f8c8d;
}

button:first-of-type:hover {
    background-color: #636e72;
}

/* RESPONSIVE */
@media (max-width: 600px) {
    form {
        padding: 20px;
    }
}


    </style>
</head>
<body>
    <h1>Form Pengaduan Sarana Sekolah</h1>
<form action="proses-pengaduan.php" method="POST"> 
<div>
    <label for="">nis</label> <br />
    <input type="text" name="nis" />
</div>

<div>
    <label>kategori</label><br>
    <select name="kategori">
    <option value="">-- Pilih Kategori --</option>
    <option value="1">Lingkungan</option>
    <option value="2">Fasilitas</option>
</select>
</div>

<div>
    <label for="">lokasi</label> <br />
    <input type="text" name="lokasi" />
</div>

<div>
    <label for="">keterangan</label> <br />
    <textarea name="keterangan"></textarea>
</div>
<button><a href="index.php"> kembali</a></button>
<button> kirim</button>
</form>
</body>
</html>