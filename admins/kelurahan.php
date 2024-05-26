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

// Fungsi untuk menghapus data kelurahan
function deleteKelurahan($id) {
    global $conn;
    $sql = "DELETE FROM areakelurahan WHERE id_kelurahan=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data kelurahan berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Inisialisasi variabel pencarian
$searchQuery = "";
$searchBy = "";

// Jika form pencarian disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchQuery']) && isset($_POST['searchBy'])) {
    $searchQuery = $_POST['searchQuery'];
    $searchBy = $_POST['searchBy'];
}

// Query untuk mengambil data kelurahan dan kecamatan
$sql = "SELECT areakelurahan.id_kelurahan, areakelurahan.kelurahan, areakelurahan.id_kecamatan, areakelurahan.kodepos, areakecamatan.kecamatan 
        FROM areakelurahan 
        JOIN areakecamatan ON areakelurahan.id_kecamatan = areakecamatan.id_kecamatan";

// Menambahkan filter pencarian ke query
if (!empty($searchQuery)) {
    switch ($searchBy) {
        case 'id_kelurahan':
            $sql .= " WHERE areakelurahan.id_kelurahan LIKE '%" . $conn->real_escape_string($searchQuery) . "%'";
            break;
        case 'kelurahan':
            $sql .= " WHERE areakelurahan.kelurahan LIKE '%" . $conn->real_escape_string($searchQuery) . "%'";
            break;
        case 'id_kecamatan':
            $sql .= " WHERE areakelurahan.id_kecamatan LIKE '%" . $conn->real_escape_string($searchQuery) . "%'";
            break;
        case 'kecamatan':
            $sql .= " WHERE areakecamatan.kecamatan LIKE '%" . $conn->real_escape_string($searchQuery) . "%'";
            break;
        case 'kodepos':
            $sql .= " WHERE areakelurahan.kodepos LIKE '%" . $conn->real_escape_string($searchQuery) . "%'";
            break;
    }
}

$result = $conn->query($sql);

// Periksa hasil query
if ($result === false) {
    die("Error: " . $conn->error); // Hentikan eksekusi jika terjadi kesalahan dalam query
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Input Area Kelurahan</title>
<style>
/* CSS */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 20px;
}

.navbar {
    background-color: black; 
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

.container {
    width: 90%;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden; /* Menambahkan properti untuk mengatur overflow */
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th, .data-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center; /* Teks rata tengah */
}

/* Mengatur lebar kolom ID Provinsi */
.data-table th:first-child,
.data-table td:first-child {
    width: 15%; /* Sesuaikan dengan lebar yang diinginkan */
}

.data-table th {
    background-color: #333;
    color: #fff;
}

.data-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.data-table tr:hover {
    background-color: #ddd;
}

/* Tombol edit */
.edit-button {
    background-color: #ffc107; /* Warna kuning */
    color: #000; /* Warna teks hitam */
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
}

/* Tombol hapus */
.delete-button {
    background-color: #f44336; /* Warna merah */
    color: #fff; /* Warna teks putih */
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
}

/* Tombol home */
.home-button {
    background-color: #4caf50; /* Warna hijau */
    color: #fff; /* Warna teks putih */
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
}

/* Tombol pencarian */
.search-container {
    text-align: center;
    margin: 20px 0;
}

.search-container input[type="text"] {
    padding: 10px;
    font-size: 17px;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 60%;
}

.search-container select {
    padding: 10px;
    font-size: 17px;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: 20%;
}

.search-container button {
    padding: 10px;
    font-size: 17px;
    background-color: #4caf50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.search-container button:hover {
    background-color: #45a049;
}
</style>
</head>
<body>
<h1>SISTEM INFORMASI A</h1>
<div class="navbar">
    <a href="../index.php" class="active">Home</a>
    <a href="../admins/negara.php">Data Negara</a>
    <a href="../admins/provinsi.php">Data Provinsi</a>
    <a href="../admins/kabkota.php">Data Kabupaten / Kota</a>
    <a href="../admins/kecamatan.php">Data Kecamatan</a>
    <a href="../admins/kelurahan.php">Data Kelurahan</a>
    <a href="../admins/data.php">Data Lengkap</a>
</div>

<div class="container">
    <div class="search-container">
        <form action="kelurahan.php" method="post">
            <select name="searchBy">
                <option value="id_kelurahan" <?php if ($searchBy == "id_kelurahan") echo "selected"; ?>>ID Kelurahan</option>
                <option value="kelurahan" <?php if ($searchBy == "kelurahan") echo "selected"; ?>>Nama Kelurahan</option>
                <option value="id_kecamatan" <?php if ($searchBy == "id_kecamatan") echo "selected"; ?>>ID Kecamatan</option>
                <option value="kecamatan" <?php if ($searchBy == "kecamatan") echo "selected"; ?>>Nama Kecamatan</option>
                <option value="kodepos" <?php if ($searchBy == "kodepos") echo "selected"; ?>>Kodepos</option>
            </select>
            <input type="text" placeholder="Masukkan nilai pencarian..." name="searchQuery" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <?php
    // Tampilkan data kelurahan jika ada hasil
    if ($result->num_rows > 0) {
        echo "<h2 align='center'>Daftar Kelurahan</h2>";
        echo "<table class='data-table'>";
        echo "<tr><th>ID Kelurahan</th><th>Nama Kelurahan</th><th>ID Kecamatan</th><th>KodePos</th><th>Aksi</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id_kelurahan"] . "</td><td>" . $row["kelurahan"] . "</td><td>" . $row["id_kecamatan"] . " - " . $row["kecamatan"] . "</td><td>" . $row["kodepos"] . "</td><td><a href='../edit/editkelu.php?id=" . $row["id_kelurahan"] . "' class='edit-button'>Edit</a> | <a href='../hapus/deletekelu.php?id=" . $row["id_kelurahan"] . "' class='delete-button'>Hapus</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada Kelurahan yang ditemukan.";
    }

    // Tutup koneksi
    $conn->close();
    ?>
</div>

<!-- Navbar baru di bawah -->
<div class="navbar">
    <a href="negara.php">Negara</a>
    <a href="provinsi.php">Provinsi</a>
    <a href="kabkota.php">Kabupaten / Kota</a>
    <a href="kecamatan.php">Kecamatan</a>
    <a href="kelurahan.php">Kelurahan</a>

</div>

</body>
</html>
