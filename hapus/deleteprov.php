<?php
// Cek apakah parameter id telah diberikan
if(isset($_GET['id'])) {
    // Tangkap nilai id dari URL
    $id_provinsi = $_GET['id'];
    
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
    $sql = "DELETE FROM areaprovinsi WHERE id_provinsi=$id_provinsi";

    // Lakukan query
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman provinsi.php setelah berhasil menghapus data
        header("Location: ../admins/provinsi.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika parameter id tidak diberikan, tampilkan pesan error
    echo "ID tidak diberikan.";
}
?>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Area Negara</title>
<link rel="stylesheet" type="text/css" href="style/styles.css">
</head>
<body>
<h1 align="center">PENGINPUTAN TUGAS SIA</h1>
<div class="navbar">
    <a href="index.html" class="active">Home</a>
    <a href="negara.html">Area Negara</a>
    <a href="provinsi.html">Area Provinsi</a>
    <a href="kabkota.html">Area Kabupaten / Kota</a>
    <a href="kecamatan.html">Area Kecamatan</a>
    <a href="kelurahan.html">Area Kelurahan</a>
</div>

<div class="container">
    <h2>Edit Negara</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id_negara; ?>" method="post">
        <label for="nama_negara">Nama Negara:</label>
        <input type="text" id="nama_negara" name="nama_negara" value="<?php echo $nama_negara; ?>"><br><br>
        <input type="submit" value="Simpan">
    </form>
</div>
</body>
</html> -->
