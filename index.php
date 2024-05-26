<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
<style>
/* CSS */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 100%;
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

h1 {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

table th {
    background-color: black;
    color: white;
    text-align: center;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
    text-align: center;
}

h1 {
    margin-top: 20px;
    text-align: center;
}

.navbar {
    background-color: #333;
    overflow: hidden;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 20px;
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
    color: black;
}

.navbar a.active {
    background-color: #4CAF50;
    color: white;
}

</style>
</head>
<body>
<h1>SISTEM INFORMASI A</h1>
<div class="navbar">
    <a href="index.php" class="active">Home</a>
    <a href="inputnegara.php">Input Negara</a>
    <a href="inputprov.php">Input Provinsi</a>
    <a href="inputkabkota.php">input Kabupaten / Kota</a>
    <a href="inputkeca.php">input Kecamatan</a>
    <a href="inputkelu.php">input Kelurahan</a>
    <a href="input.php">Hasil Input</a>
</div>

<div class="container">
    <h1>Data Tabel Dari Database</h1>
    <?php
    // Koneksi ke database
    $servername = "localhost";
    $username = "root"; // Ganti dengan username MySQL Anda
    $password = ""; // Ganti dengan password MySQL Anda
    $dbname = "sia"; // Ganti dengan nama database Anda

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk mendapatkan daftar tabel
    $tables = $conn->query("SHOW TABLES");

    // Jika ada tabel
    if ($tables->num_rows > 0) {
        while ($table = $tables->fetch_assoc()) {
            $tableName = $table["Tables_in_$dbname"]; // Sesuaikan dengan nama database Anda
            echo "<h2>$tableName</h2>";
            echo "<table>";
            // Query untuk mendapatkan isi tabel
            $result = $conn->query("SELECT * FROM $tableName");
            // Jika ada baris dalam tabel
            if ($result->num_rows > 0) {
                // Outputkan baris sebagai header
                echo "<thead><tr>";
                while ($header = $result->fetch_field()) {
                    echo "<th>$header->name</th>";
                }
                echo "</tr></thead>";
                // Outputkan data
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>$cell</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody>";
            } else {
                echo "<tr><td colspan='" . $result->field_count . "'>Tidak ada data dalam tabel '$tableName'</td></tr>";
            }
            echo "</table>";
        }
    } else {
        echo "<p>Tidak ada tabel dalam database '$dbname'</p>";
    }
    // Tutup koneksi
    $conn->close();
    ?>
</div>

</body>
</html>
