<?php
// editkabkota.php

// Ambil ID Kabkota dari parameter URL
$id_kabkota = $_GET['id'];

// Periksa apakah ID Kabkota valid
if (!is_numeric($id_kabkota)) {
    echo "ID Kabkota tidak valid.";
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
    $kabkota = $_POST["kabkota"];
    $id_provinsi = $_POST["id_provinsi"];

    // Query untuk mengupdate data kabkota
    $sql = "UPDATE areakabkota SET kabkota='$kabkota', id_provinsi='$id_provinsi' WHERE id_kabkota=$id_kabkota";

    if ($conn->query($sql) === TRUE) {
        echo "Data Kabupaten / Kota berhasil diperbarui.";
        // Jika proses edit berhasil, arahkan kembali ke halaman kabkota.php
        header("Location: ../admins/kabkota.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Query untuk mengambil data kabkota berdasarkan ID
$sql = "SELECT id_kabkota, kabkota, id_provinsi FROM areakabkota WHERE id_kabkota=$id_kabkota";
$result = $conn->query($sql);

// Periksa apakah hasil query mengembalikan baris data
if ($result->num_rows == 1) {
    // Ambil data Kabupaten / Kota
    $row = $result->fetch_assoc();
    $kabkota = $row["kabkota"];
    $id_provinsi = $row["id_provinsi"];
} else {
    echo "Tidak ada Kabupaten / Kota yang ditemukan.";
    exit;
}

// Query untuk mengambil semua data provinsi
$sql_provinsi = "SELECT id_provinsi, provinsi FROM areaprovinsi";
$result_provinsi = $conn->query($sql_provinsi);

$provinsi_options = [];
if ($result_provinsi->num_rows > 0) {
    while($row_provinsi = $result_provinsi->fetch_assoc()) {
        $provinsi_options[] = $row_provinsi;
    }
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Area Kabupaten / Kota</title>
<style>
/* CSS */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

h1 {
    text-align: center;
    margin-top: 20px;
}

.navbar {
    background-color: #333;
    overflow: hidden;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
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
    color: #333;
}

.navbar a.active {
    background-color: #4CAF50;
    color: white;
}

.container {
    width: 80%;
    max-width: 600px;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: left;
    margin: 150px auto;
}

.container h2 {
    text-align: center;
}

h2 {
    text-align: center;
}

form {
    margin-top: 20px;
}

form div {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    text-align: left;
}

input[type="text"], select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
<h1 align="center">SISTEM INFORMASI A</h1>
<div class="navbar">
<a href="index.php" class="active">Home</a>
    <a href="inputnegara.php">Area Negara</a>
    <a href="inputprov.php">Area Provinsi</a>
    <a href="inputkabkota.php">Area Kabupaten / Kota</a>
    <a href="inputkeca.php">Area Kecamatan</a>
    <a href="inputkelu.php">Area Kelurahan</a>
    <a href="input.php">Hasil Input</a>
</div>

<div class="container">
    <h2>Edit Kabupaten Kota</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id_kabkota; ?>" method="post">
        <label for="kabkota">Nama Kabupaten / Kota:</label>
        <input type="text" id="kabkota" name="kabkota" value="<?php echo htmlspecialchars($kabkota); ?>"><br><br>
        
        <label for="id_provinsi">ID Provinsi:</label>
        <select id="id_provinsi" name="id_provinsi">
            <?php foreach ($provinsi_options as $provinsi): ?>
                <option value="<?php echo $provinsi['id_provinsi']; ?>" <?php if ($provinsi['id_provinsi'] == $id_provinsi) echo 'selected'; ?>>
                    <?php echo $provinsi['id_provinsi'] . " - " . $provinsi['provinsi']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>
</div>
</body>
</html>
