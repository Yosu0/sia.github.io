<?php
// Koneksi ke database
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

// Jika form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $id_kelurahan = $_POST['id_kelurahan'];
    $kelurahan = $_POST['kelurahan'];
    $id_kecamatan = $_POST['id_kecamatan'];
    $kodepos = $_POST['kodepos']; // Mendapatkan data kodepos

    // Menyiapkan dan mengeksekusi statement SQL untuk menyimpan data ke dalam database
    $sql = "INSERT INTO areakelurahan (id_kelurahan, kelurahan, id_kecamatan, kodepos) VALUES ('$id_kelurahan', '$kelurahan', '$id_kecamatan', '$kodepos')";

    if ($conn->query($sql) === TRUE) {
        // Data berhasil disimpan, lakukan pengalihan header
        header("Location: inputkelu.php");
        exit(); // Pastikan keluar dari skrip setelah pengalihan header dilakukan
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Input Area Kabupaten / Kota</title>
<style>
/* CSS */
h1 {
    justify-content: center;
    align-items: center;
    position: top;
    display: flex;
}

body {
    font-family: Arial, sans-serif, bold;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    /* display: flex; */
    justify-content: center; /* Memastikan body memusatkan kontennya secara horizontal */
    align-items: center; /* Memastikan body memusatkan kontennya secara vertikal */
    /* height: 100vh; Pastikan body memenuhi tinggi viewport */
}

.container {
    width: 80%; /* Lebar container lebih besar untuk memastikan terlihat di tengah */
    max-width: 600px; /* Maksimal lebar untuk container */
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center; /* Pusatkan teks di dalam container */
    float: right;
    margin-top: 50px;
    margin-right: 50px;
    overflow: auto;
}

.hasilinput {
    width: 28%; /* Lebar div hasilinput */
    padding: 25px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    float: left; /* Pindahkan div ke sebelah kiri */
    margin-right: 1%;
    overflow-y: auto; /* Mengaktifkan scrolling vertical jika konten melebihi ketinggian maksimal */
    max-height: 440px; /* Tentukan ketinggian maksimal */
    margin-top: 50px;
    margin-left: 100px;
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
    text-align: left; /* Pastikan label tetap rata kiri */
}

input[type="text"], select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Tambahkan ini agar padding tidak memengaruhi lebar total */
}

button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
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
    flex: 1; /* Menambahkan fleksibilitas pada item */
    max-width: 150px; /* Menambahkan lebar maksimum untuk item */
}
.navbar a:hover {
    background-color: #ddd;
    color: black;
}

.navbar a.active {
    background-color: #4CAF50;
    color: white;
}

/* Tambahkan CSS untuk garis pemisah */
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center; /* Teks di tengah */
}
th {
    background-color: black; /* Background color yang sama untuk menampilkan konten dengan jelas */
    color: white; /* Warna teks putih */
    position: sticky; /* Tetap di tempatnya saat scrolling */
    top: 0; /* Menempel di bagian atas container saat scrolling */
    z-index: 2; /* Pastikan konten tetap di atas konten yang lain */
}

/* Tambahkan CSS untuk warna teks hitam */
.id-, .provinsi .id-negara {
    color: black;
}
</style>
</head>
<body>
<h1 align="center">SISTEM INFORMASI A</h1>
<div class="navbar">
    <a href="index.php" class="active">Home</a>
    <a href="inputnegara.php">Input Negara</a>
    <a href="inputprov.php">Input Provinsi</a>
    <a href="inputkabkota.php">Input Kabupaten / Kota</a>
    <a href="inputkeca.php">Input Kecamatan</a>
    <a href="inputkelu.php">Input Kelurahan</a>
    <a href="input.php">Hasil Input</a>
</div>
<div class="container">
    <h2>Form Input Area Kelurahan</h2>
    <form action="../sia/process/process_kelurahan.php" method="post">
        <div>
            <label for="id_kelurahan">ID kelurahan:</label>
            <input type="text" id="id_kelurahan" name="id_kelurahan" required>
        </div>
        <div>
            <label for="kelurahan">Kelurahan:</label>
            <input type="text" id="kelurahan" name="kelurahan" required>
        </div>
        <div>
            <label for="id_kecamatan">ID Kecamatan:</label>
            <select id="id_kecamatan" name="id_kecamatan" required>
                <?php
                // Koneksi ke database
                $servername = "localhost";
                $username = "root"; // Ganti dengan username MySQL Anda
                $password = ""; // Ganti dengan password MySQL Anda
                $dbname = "sia"; // Ganti dengan nama database Anda

                // Buat koneksi
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Query untuk mengambil data Kecamatan
                $sql = "SELECT id_kecamatan, kecamatan FROM areakecamatan";
                $result = $conn->query($sql);

                // Periksa hasil query
                if ($result && $result->num_rows > 0) {
                    // Tampilkan data negara dalam dropdown
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id_kecamatan"] . "'>" . $row["id_kecamatan"] . " - " . $row["kecamatan"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada negara tersedia</option>";
                }
                // Tutup koneksi
                $conn->close();
                ?>
            </select>
            </div>
            <div>
            <label for="kodepos">Kodepos:</label>
            <input type="text" id="kodepos" name="kodepos" required>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
<div class="hasilinput">
    <table>
        <thead>
            <tr>
                <th>ID kelurahan</th>
                <th>Kelurahan</th>
                <th>ID Kecamatan</th>
                <th>KodePos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Koneksi ke database
            $servername = "localhost";
            $username = "root"; // Ganti dengan username MySQL Anda
            $password = ""; // Ganti dengan password MySQL Anda
            $dbname = "sia"; // Ganti dengan nama database Anda

            // Buat koneksi
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Periksa koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Query untuk mengambil data kelurahan
            $sql = "SELECT id_kelurahan, kelurahan, id_kecamatan, kodepos FROM areakelurahan";
            $result = $conn->query($sql);

            // Periksa hasil query
            if ($result && $result->num_rows > 0) {
                // Tampilkan data kelurahan dalam tabel
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='id-kelurahan'>" . $row["id_kelurahan"] . "</td>";
                    echo "<td class='kelurahan'>" . $row["kelurahan"] . "</td>";
                    echo "<td class='id-kecamatan'>" . $row["id_kecamatan"] . "</td>";
                    echo "<td class='kodepos'>" . $row["kodepos"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada hasil input kelurahan.</td></tr>";
            }
            // Tutup koneksi
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
