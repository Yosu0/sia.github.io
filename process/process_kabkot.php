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
$id_kabkota = $_POST['id_kabkota'];
$kabkota = $_POST['kabkota'];
$id_provinsi = $_POST['id_provinsi'];

// Menyiapkan dan mengeksekusi statement SQL untuk menyimpan data ke dalam database
$sql = "INSERT INTO areakabkota (id_kabkota, kabkota, id_provinsi) VALUES ('$id_kabkota', '$kabkota', '$id_provinsi')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Proses data formulir di sini...

// Redirect kembali ke halaman index.html setelah pemrosesan formulir selesai
header("Location: ../inputkabkota.php");
exit; // Pastikan tidak ada output lain sebelum redirect
?>
