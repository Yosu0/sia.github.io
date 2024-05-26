<?php
// Pastikan koneksi ke database sudah dibuat sebelumnya

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nama_tabel = $_POST['nama_tabel'];
    $kolom1 = $_POST['kolom1'];
    // Ambil kolom lainnya sesuai kebutuhan

    // Validasi data jika diperlukan

    // Buat query untuk membuat tabel baru
    $sql = "CREATE TABLE $nama_tabel (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                $kolom1 VARCHAR(30) NOT NULL
                -- Tambahkan definisi kolom lainnya sesuai kebutuhan
            )";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "Tabel $nama_tabel berhasil dibuat";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

// Tutup koneksi ke database
$conn->close();

// Proses data formulir di sini...

// Redirect kembali ke halaman index.html setelah pemrosesan formulir selesai
header("Location: ../add_data.php");
exit; // Pastikan tidak ada output lain sebelum redirect
?>
