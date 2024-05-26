<?php
// editkelu.php

// Ambil ID Kelurahan dari parameter URL
$id_kelurahan = $_GET['id'];

// Periksa apakah ID Kelurahan valid
if (!is_numeric($id_kelurahan)) {
    echo "ID Kelurahan tidak valid.";
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
    $kelurahan = $_POST["kelurahan"];
    $id_kecamatan = $_POST["id_kecamatan"];
    $kodepos = $_POST['kodepos'];

    // Query untuk mengupdate data kelurahan
    $sql = "UPDATE areakelurahan SET kelurahan='$kelurahan', id_kecamatan='$id_kecamatan', kodepos='$kodepos' WHERE id_kelurahan=$id_kelurahan";

    if ($conn->query($sql) === TRUE) {
        echo "Data kelurahan berhasil diperbarui.";
        // Jika proses edit berhasil, arahkan kembali ke halaman kelurahan.php
        header("Location: ../admins/kelurahan.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Query untuk mengambil data kelurahan berdasarkan ID
$sql = "SELECT id_kelurahan, kelurahan, id_kecamatan, kodepos FROM areakelurahan WHERE id_kelurahan=$id_kelurahan";
$result = $conn->query($sql);

// Periksa apakah hasil query mengembalikan baris data
if ($result->num_rows == 1) {
    // Ambil data kelurahan
    $row = $result->fetch_assoc();
    $kelurahan = $row["kelurahan"];
    $id_kecamatan = $row["id_kecamatan"];
    $kodepos = $row['kodepos'];
} else {
    echo "Tidak ada kelurahan yang ditemukan.";
    exit;
}

// Query untuk mengambil data kecamatan
$sql_kecamatan = "SELECT id_kecamatan, kecamatan FROM areakecamatan";
$result_kecamatan = $conn->query($sql_kecamatan);

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Area Kelurahan</title>
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
    <h2>Edit Kelurahan</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id_kelurahan; ?>" method="post">
        <label for="kelurahan">Nama Kelurahan:</label>
        <input type="text" id="kelurahan" name="kelurahan" value="<?php echo htmlspecialchars($kelurahan); ?>"><br><br>
        
        <label for="id_kecamatan">ID Kecamatan:</label>
        <select id="id_kecamatan" name="id_kecamatan">
            <?php
            if ($result_kecamatan->num_rows > 0) {
                while ($row_kecamatan = $result_kecamatan->fetch_assoc()) {
                    $selected = ($row_kecamatan["id_kecamatan"] == $id_kecamatan) ? "selected" : "";
                    echo "<option value='" . $row_kecamatan["id_kecamatan"] . "' $selected>" . $row_kecamatan["id_kecamatan"] . " - " . $row_kecamatan["kecamatan"] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada kecamatan yang ditemukan</option>";
            }
            ?>
        </select><br><br>
        <label for="kodepos">KodePos:</label>
        <input type="text" id="kodepos" name="kodepos" value="<?php echo htmlspecialchars($kodepos); ?>"><br><br>

        <button type="submit">Simpan</button>
    </form>
</div>
</body>
</html>
