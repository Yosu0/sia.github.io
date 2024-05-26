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
$id_kelurahan = $_POST['id_kelurahan'];
$kelurahan = $_POST['kelurahan'];
$id_kecamatan = $_POST['id_kecamatan'];
$kodepos = $_POST['kodepos'];

// Menyiapkan dan mengeksekusi statement SQL untuk menyimpan data ke dalam database
$sql = "INSERT INTO areakelurahan (id_kelurahan, kelurahan, id_kecamatan, kodepos) VALUES ('$id_kelurahan', '$kelurahan', '$id_kecamatan', $kodepos)";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Proses data formulir di sini...

// Redirect kembali ke halaman index.html setelah pemrosesan formulir selesai
header("Location: ../inputkelu.php");
exit; // Pastikan tidak ada output lain sebelum redirect
?>
