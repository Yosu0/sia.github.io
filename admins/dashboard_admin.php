<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>
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
</style>
</head>
<body>
<h1>SISTEM INFORMASI A - Dashboard Admin</h1>
<div class="navbar">
<a href="dashboard_admin.php" class="active">Dashboard</a>
    <a href="negara.php">Data Negara</a>
    <a href="provinsi.php">Data Provinsi</a>
    <a href="kabkota.php">Data Kabupaten / Kota</a>
    <a href="kecamatan.php">Data Kecamatan</a>
    <a href="kelurahan.php">Data Kelurahan</a>
    <a href="data.php">Data Lengkap</a>
    <a href="index.php">Logout</a>
</div>
</body>
</html>
