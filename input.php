<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Semua Data Yang Ada Di Data</title>
<style>
/* CSS */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    overflow: hidden; /* Menambahkan properti untuk mengatur overflow */
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
    color: #333;
}

.navbar a.active {
    background-color: #4CAF50;
    color: white;
}

.container {
    width: 80%;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden; /* Menambahkan properti untuk mengatur overflow */
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
    width: 80%;
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
<h1>SISTEM INFORMASI A - Data Seluruh Tabel</h1>
<div class="navbar">
    <a href="../index.php" class="active">Home</a>
    <a href="admins/negara.php">Data Negara</a>
    <a href="admins/provinsi.php">Data Provinsi</a>
    <a href="admins/kabkota.php">Data Kabupaten / Kota</a>
    <a href="admins/kecamatan.php">Data Kecamatan</a>
    <a href="admins/kelurahan.php">Data Kelurahan</a>
    <a href="admins/data.php">Data Lengkap</a>
    </div>

<div class="container">
    <div class="search-container">
        <form method="post" action="">
            <input type="text" placeholder="Masukkan kata kunci..." name="keyword">
            <button type="submit" name="search">Cari</button>
        </form>
    </div>

</div>

<!-- JavaScript untuk melakukan permintaan ke server dan berinteraksi dengan database -->
<script>
// Contoh penggunaan fetch API untuk mendapatkan data dari server
fetch('data-dari-server.php')
  .then(response => response.json())
  .then(data => {
    console.log('Data dari server:', data);
    // Lakukan sesuatu dengan data yang diterima dari server
  })
  .catch(error => {
    console.error('Terjadi kesalahan:', error);
  });
</script>
<div class="navbar">
        <a href="../sia/admins/negara.php">Negara</a>
        <a href="../sia/admins/provinsi.php">Provinsi</a>
        <a href="../sia/admins/kabkota.php">Kabupaten / Kota</a>
        <a href="../sia/admins/kecamatan.php">Kecamatan</a>
        <a href="../sia/admins/kelurahan.php">Kelurahan</a>
    </div>

</body>
</html>
