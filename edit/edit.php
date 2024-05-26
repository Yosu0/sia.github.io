<?php
// edit.php

// Ambil ID negara dari parameter URL
$id_negara = $_GET['id'];

// Periksa apakah ID negara valid
if (!is_numeric($id_negara)) {
    echo "ID negara tidak valid.";
    exit;
}

// Buat koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "sia"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_negara = $_POST["nama_negara"];

    // Query untuk mengupdate data negara
    $sql = "UPDATE areanegara SET negara='$nama_negara' WHERE id_negara=$id_negara";

    if ($conn->query($sql) === TRUE) {
        echo "Data negara berhasil diperbarui.";
        // Jika proses edit berhasil, arahkan kembali ke halaman negara.php
        header("Location: ../admins/negara.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Query untuk mengambil data negara berdasarkan ID
$sql = "SELECT id_negara, negara FROM areanegara WHERE id_negara=$id_negara";
$result = $conn->query($sql);

// Periksa apakah hasil query mengembalikan baris data
if ($result->num_rows == 1) {
    // Ambil data negara
    $row = $result->fetch_assoc();
    $id_negara = $row["id_negara"];
    $nama_negara = $row["negara"];
} else {
    echo "Tidak ada negara yang ditemukan.";
    exit;
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Area Negara</title>
<style>
/* CSS */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 100%;
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

h1 {
    text-align: center;
}

h1 {
    margin-top: 20px;
    text-align: center;
}

.navbar {
    background-color: #333;
    overflow: hidden;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.navbar a {
    display: block;
    color: #fff;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
    flex: 1;
    max-width: 150px;
}

.navbar a:hover {
    background-color: #ddd;
    color: black;
}

.navbar a.active {
    background-color: #4CAF50;
    color: white;
}

.form-container {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    margin-top: 20px;
}

.form-container label {
    display: block;
    margin-bottom: 10px;
}

.form-container input[type="text"], .form-container textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.form-container button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.form-container button[type="submit"]:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
<h1 align="center">SISTEM INFORMASI A</h1>
<div class="navbar">
<a href="../index.php" class="active">Home</a>
    <a href="../inputnegara.php">Area Negara</a>
    <a href="../inputprov.php">Area Provinsi</a>
    <a href="../inputkabkota.php">Area Kabupaten / Kota</a>
    <a href="../inputkeca.php">Area Kecamatan</a>
    <a href="../inputkelu.php">Area Kelurahan</a>
    <a href="../input.php">Hasil Input</a>
</div>

<div class="container">
    <div class="form-container">
        <h2>Edit Negara</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id_negara; ?>" method="post">
            <label for="nama_negara">Nama Negara:</label>
            <input type="text" id="nama_negara" name="nama_negara" value="<?php echo $nama_negara; ?>"><br><br>
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>
</body>
</html>
