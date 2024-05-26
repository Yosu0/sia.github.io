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
$id_kecamatan = $_POST['id_kecamatan'];
$kecamatan = $_POST['kecamatan'];
$id_kabkota = $_POST['id_kabkota'];
// Tambahkan tanda titik koma di sini

// Menyiapkan dan mengeksekusi statement SQL untuk menyimpan data ke dalam database
$sql = "INSERT INTO areakecamatan (id_kecamatan, kecamatan, id_kabkota) VALUES ('$id_kecamatan', '$kecamatan', '$id_kabkota')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Proses data formulir di sini...

// Redirect kembali ke halaman inputkeca.php setelah pemrosesan formulir selesai
header("Location: ../inputkeca.php");
exit; // Pastikan tidak ada output lain sebelum redirect
?>
