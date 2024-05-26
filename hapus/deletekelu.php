<?php
// Cek apakah parameter id telah diberikan
if(isset($_GET['id'])) {
    // Tangkap nilai id dari URL
    $id_kelurahan = $_GET['id'];
    
    // Lakukan koneksi ke database
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

    // Query SQL untuk menghapus data berdasarkan id_provinsi
    $sql = "DELETE FROM areakelurahan WHERE id_kelurahan=$id_kelurahan";

    // Lakukan query
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman provinsi.php setelah berhasil menghapus data
        header("Location: ../admins/kelurahan.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika parameter id tidak diberikan, tampilkan pesan error
    echo "ID kelurahan tidak diberikan.";
}
?>