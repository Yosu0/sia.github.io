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

// Ambil nama tabel dari parameter GET
$table_name = $_GET['table'];

// Query SQL untuk mengambil semua data dari tabel yang sesuai
$sql = "SELECT * FROM $table_name";
$result = $conn->query($sql);

// Tampilkan data tabel dalam bentuk HTML
if ($result->num_rows > 0) {
    echo "<table>";
    // Output header tabel
    echo "<tr><th>ID</th><th>Nama</th></tr>";
    // Output baris data
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nama"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data yang ditemukan.";
}

// Tutup koneksi
$conn->close();
?>
