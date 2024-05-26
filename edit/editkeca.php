<?php
// editprov.php

// Ambil ID kecamatan dari parameter URL
$id_kecamatan = $_GET['id'];

// Periksa apakah ID kecamatan valid
if (!is_numeric($id_kecamatan)) {
    echo "ID Kecamatan tidak valid.";
    exit;
}

// Buat koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "sia"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $kecamatan = $_POST["kecamatan"];
    $id_kabkota = $_POST["id_kabkota"];

    // Query untuk mengupdate data kecamatan
    $sql = "UPDATE areakecamatan SET kecamatan='$kecamatan', id_kabkota='$id_kabkota' WHERE id_kecamatan=$id_kecamatan";

    if ($conn->query($sql) === TRUE) {
        echo "Data kecamatan berhasil diperbarui.";
        // Jika proses edit berhasil, arahkan kembali ke halaman kecamatan.php
        header("Location: ../admins/kecamatan.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Query untuk mengambil data kecamatan berdasarkan ID
$sql = "SELECT id_kecamatan, kecamatan, id_kabkota FROM areakecamatan WHERE id_kecamatan=$id_kecamatan";
$result = $conn->query($sql);

// Periksa apakah hasil query mengembalikan baris data
if ($result->num_rows == 1) {
    // Ambil data kecamatan
    $row = $result->fetch_assoc();
    $kecamatan = $row["kecamatan"];
    $id_kabkota = $row["id_kabkota"];
} else {
    echo "Tidak ada kecamatan yang ditemukan.";
    exit;
}

// Query untuk mengambil data kabupaten/kota
$sql_kabkota = "SELECT id_kabkota, kabkota FROM areakabkota";
$result_kabkota = $conn->query($sql_kabkota);

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Area Kecamatan</title>
<style>
/* CSS */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

h1 {
    text-align: center;
    margin-top: 20px;
}

.navbar {
    background-color: #333;
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
    flex: 1;
    max-width: 150px;
}

.navbar a:hover {
    background-color: #ddd;
    color: #333;
}

.navbar a.active {
    background-color: #4CAF50;
    color: white;
}

.container {
    width: 80%;
    max-width: 600px;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: left;
    margin: 150px auto;
}

.container h2 {
    text-align: center;
}

h2 {
    text-align: center;
}

form {
    margin-top: 20px;
}

form div {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    text-align: left;
}

input[type="text"], select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
<h1 align="center">SISTEM INFORMASI A</h1>
<div class="navbar">
    <a href="../index.php" class="active">Home</a>
    <a href="../inputnegara.php">Area Negara</a>
    <a href="../inputprov.php">Area Provinsi</a>
    <a href="../inputkabkota.php">Area Kabupaten / Kota</a>
    <a href="../inputkeca.php">Area Kecamatan</a>
    <a href="../inputkelu.php">Area Kelurahan</a>
    <a href="../input.php">Hasil Input</a>
</div>

<div class="container">
    <h2>Edit Kecamatan</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id_kecamatan; ?>" method="post">
        <label for="kecamatan">Nama Kecamatan:</label>
        <input type="text" id="kecamatan" name="kecamatan" value="<?php echo htmlspecialchars($kecamatan); ?>"><br><br>
        
        <label for="id_kabkota">ID Kabupaten / Kota:</label>
        <select id="id_kabkota" name="id_kabkota">
            <?php
            if ($result_kabkota->num_rows > 0) {
                while ($row_kabkota = $result_kabkota->fetch_assoc()) {
                    $selected = ($row_kabkota["id_kabkota"] == $id_kabkota) ? "selected" : "";
                    echo "<option value='" . $row_kabkota["id_kabkota"] . "' $selected>" . $row_kabkota["id_kabkota"] . " - " . $row_kabkota["kabkota"] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada kabupaten/kota yang ditemukan</option>";
            }
            ?>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>
</div>
</body>
</html>
