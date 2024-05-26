<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sia";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query SQL untuk mengambil jumlah negara
$sql_negara = "SELECT COUNT(*) AS total_negara FROM areanegara";
$result_negara = $conn->query($sql_negara);

// Periksa hasil query
if ($result_negara === false) {
    die("Error dalam query negara: " . $conn->error);
}

// Mengambil hasil query sebagai array asosiatif
$row_negara = $result_negara->fetch_assoc();
$total_negara = $row_negara['total_negara'];

// Query SQL untuk mengambil jumlah provinsi
$sql_provinsi = "SELECT COUNT(*) AS total_provinsi FROM areaprovinsi";
$result_provinsi = $conn->query($sql_provinsi);

// Periksa hasil query
if ($result_provinsi === false) {
    die("Error dalam query provinsi: " . $conn->error);
}

// Mengambil hasil query sebagai array asosiatif
$row_provinsi = $result_provinsi->fetch_assoc();
$total_provinsi = $row_provinsi['total_provinsi'];

// Query SQL untuk mengambil jumlah kabupaten/kota
$sql_kabkota = "SELECT COUNT(*) AS total_kabkota FROM areakabkota";
$result_kabkota = $conn->query($sql_kabkota);

// Periksa hasil query
if ($result_kabkota === false) {
    die("Error dalam query kabupaten/kota: " . $conn->error);
}

// Mengambil hasil query sebagai array asosiatif
$row_kabkota = $result_kabkota->fetch_assoc();
$total_kabkota = $row_kabkota['total_kabkota'];

// Query SQL untuk mengambil jumlah kecamatan
$sql_kecamatan = "SELECT COUNT(*) AS total_kecamatan FROM areakecamatan";
$result_kecamatan = $conn->query($sql_kecamatan);

// Periksa hasil query
if ($result_kecamatan === false) {
    die("Error dalam query kecamatan: " . $conn->error);
}

// Mengambil hasil query sebagai array asosiatif
$row_kecamatan = $result_kecamatan->fetch_assoc();
$total_kecamatan = $row_kecamatan['total_kecamatan'];

// Query SQL untuk mengambil jumlah kelurahan
$sql_kelurahan = "SELECT COUNT(*) AS total_kelurahan FROM areakelurahan";
$result_kelurahan = $conn->query($sql_kelurahan);

// Periksa hasil query
if ($result_kelurahan === false) {
    die("Error dalam query kelurahan: " . $conn->error);
}

// Mengambil hasil query sebagai array asosiatif
$row_kelurahan = $result_kelurahan->fetch_assoc();
$total_kelurahan = $row_kelurahan['total_kelurahan'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>
<style>
/* CSS */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

h1 {
    text-align: center;
    margin-top: 20px;
}

.navbar {
    background-color: black; 
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
    flex: 1; /* Menambahkan fleksibilitas pada item */
    max-width: 150px; /* Menambahkan lebar maksimum untuk item */
}
.navbar a:hover {
    background-color: #ddd;
    color: black;
}

.navbar a.active {
    background-color: #4CAF50;
    color: white;
}

.stats {
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}

.stat-box {
    background-color: black;
    color: white;
    padding: 20px;
    border-radius: 5px;
    width: 12%;
    text-align: center;
}

.stat-box-negara {
    background-color: grey;
    color: black;
    padding: 20px;
    border-radius: 5px;
    width: 12%;
    margin: auto;
    text-align: center;
}

.stat-box-prov {
    background-color: red;
    color: black;
    padding: 20px;
    border-radius: 5px;
    width: 12%;
    margin: auto;
    text-align: center;
}

.stat-box-kota {
    background-color: green;
    color: black;
    padding: 20px;
    border-radius: 5px;
    width: 12%;
    margin: auto;
    text-align: center;
}

.stat-box-keca {
    background-color: orange;
    color: black;
    padding: 20px;
    border-radius: 5px;
    width: 12%;
    margin: auto;
    text-align: center;
}

.stat-box-kelu {
    background-color: blue;
    color: black;
    padding: 20px;
    border-radius: 5px;
    width: 12%;
    margin: auto;
    text-align: center;
}

.table-container {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: center;
}

th {
    background-color: #4CAF50;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
</head>
<body>
<h1>SISTEM INFORMASI A</h1>
<div class="navbar">
    <a href="../index.php" class="active">Home</a>
    <a href="../inputnegara.php">Input Negara</a>
    <a href="../inputprov.php">Input Provinsi</a>
    <a href="../inputkabkota.php">Input Kabupaten / Kota</a>
    <a href="../inputkeca.php">Input Kecamatan</a>
    <a href="../inputkelu.php">Input Kelurahan</a>
    <a href="../input.php">Hasil Input</a>
</div>

<div class="container">
    <h2>Statistik</h2>
    <div class="stats">
        <div class="stat-box-negara">
            <h3>Total Negara</h3>
            <p><b><?php echo $total_negara; ?></b></p>
        </div>
        <div class="stat-box-prov">
            <h3>Total Provinsi</h3>
            <p><b><?php echo $total_provinsi; ?></b></p>
        </div>
        <div class="stat-box-kota">
            <h3>Total Kabupaten / Kota</h3>
            <p><b><?php echo $total_kabkota; ?></p></b>
        </div>
        <div class="stat-box-keca">
            <h3>Total Kecamatan</h3>
            <p><b><?php echo $total_kecamatan; ?></p></b>
        </div>
        <div class="stat-box-kelu">
            <h3>Total Kelurahan</h3>
            <p><b><?php echo $total_kelurahan; ?></p></b>
        </div>
    </div>
</div>
</body>
</html>
