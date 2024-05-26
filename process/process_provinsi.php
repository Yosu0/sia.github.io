<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sia";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form
$id_provinsi = $_POST['id_provinsi'];
$provinsi = $_POST['provinsi'];
$id_negara = $_POST['id_negara'];

// Menyiapkan dan mengeksekusi statement SQL untuk menyimpan data ke dalam database
$sql = "INSERT INTO areaprovinsi (id_provinsi, provinsi, id_negara) VALUES ('$id_provinsi', '$provinsi', '$id_negara')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Proses data formulir di sini...

// Redirect kembali ke halaman index.html setelah pemrosesan formulir selesai
header("Location: ../inputprov.php");
exit; // Pastikan tidak ada output lain sebelum redirect


?>
