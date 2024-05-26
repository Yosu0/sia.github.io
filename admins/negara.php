<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Input Area Negara</title>
<style>
/* CSS */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
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

.container {
    width: 90%;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden; /* Menambahkan properti untuk mengatur overflow */
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th, .data-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center; /* Teks rata tengah */
}

/* Mengatur lebar kolom ID Kabupaten / Kota */
.data-table th:first-child,
.data-table td:first-child {
    width: 15%; /* Sesuaikan dengan lebar yang diinginkan */
}

.data-table th {
    background-color: #333;
    color: #fff;
}

.data-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.data-table tr:hover {
    background-color: #ddd;
}

/* Tombol edit */
.edit-button {
    background-color: #ffc107; /* Warna kuning */
    color: #000; /* Warna teks hitam */
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
}

/* Tombol hapus */
.delete-button {
    background-color: #f44336; /* Warna merah */
    color: #fff; /* Warna teks putih */
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
}

/* Tombol home */
.home-button {
    background-color: #4caf50; /* Warna hijau */
    color: #fff; /* Warna teks putih */
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
}

/* Tombol pencarian */
.search-container {
    text-align: center;
    margin: 20px 0;
}

.search-container input[type="text"] {
    padding: 10px;
    font-size: 17px;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 60%;
}

.search-container select {
    padding: 10px;
    font-size: 17px;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 20%;
}

.search-container button {
    padding: 10px;
    font-size: 17px;
    background-color: #4caf50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.search-container button:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
<h1>SISTEM INFORMASI A</h1>
<div class="navbar">
    <a href="../index.php" class="active">Home</a>
    <a href="../admins/negara.php">Data Negara</a>
    <a href="../admins/provinsi.php">Data Provinsi</a>
    <a href="../admins/kabkota.php">Data Kabupaten / Kota</a>
    <a href="../admins/kecamatan.php">Data Kecamatan</a>
    <a href="../admins/kelurahan.php">Data Kelurahan</a>
    <a href="../admins/data.php">Data Lengkap</a>
</div>
</div>

<div class="container">
    <div class="search-container">
        <form action="negara.php" method="post">
            <select name="searchBy">
                <option value="id_negara">ID Negara</option>
                <option value="negara">Nama Negara</option>
            </select>
            <input type="text" placeholder="Cari berdasarkan..." name="searchQuery">
            <button type="submit">Cari</button>
        </form>
    </div>

<?php
// Ambil data negara dari database
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "sia"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk menghapus data negara
function deleteNegara($id) {
    global $conn;
    $sql = "DELETE FROM areanegara WHERE id_negara=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data negara berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data pencarian dari formulir
$searchBy = isset($_POST['searchBy']) ? $_POST['searchBy'] : 'negara'; // Default ke kolom 'negara' jika tidak ada yang dipilih
$searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';

// Query untuk mengambil data negara berdasarkan pencarian
$sql = "SELECT id_negara, negara FROM areanegara WHERE $searchBy LIKE '%$searchQuery%'"; 
$result = $conn->query($sql);

// Periksa hasil query
if ($result === false) {
    die("Error: " . $conn->error); // Hentikan eksekusi jika terjadi kesalahan dalam query
}

// Tampilkan data negara jika ada hasil
if ($result->num_rows > 0) {
    echo "<h2 align='center'>Daftar Negara</h2>";
    echo "<table class='data-table'>";
    echo "<tr><th>ID Negara</th><th>Nama Negara</th><th>Aksi</th></tr>";
    while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id_negara"] . "</td><td>" . $row["negara"] . "</td><td><a href='../edit/edit.php?id=" . $row["id_negara"] . "' class='edit-button'>Edit</a> | <a href='../hapus/delete.php?id=" . $row["id_negara"] . "' class='delete-button'>Hapus</a></td></tr>";
    }
    echo "</table>";
    } else {
    echo "Tidak ada negara yang ditemukan.";
    }
    
    // Tutup koneksi
    $conn->close();
    ?>
    
    </div>
    <!-- Navbar baru di bawah -->
    <div class="navbar">
        <a href="negara.php">Negara</a>
        <a href="provinsi.php">Provinsi</a>
        <a href="kabkota.php">Kabupaten / Kota</a>
        <a href="kecamatan.php">Kecamatan</a>
        <a href="kelurahan.php">Kelurahan</a>
    </div>
    </body>
    </html>