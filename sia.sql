-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26 Mei 2024 pada 07.20
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `areakabkota`
--

CREATE TABLE `areakabkota` (
  `Id_KabKota` int(11) NOT NULL,
  `KabKota` varchar(100) NOT NULL,
  `Id_Provinsi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `areakabkota`
--

INSERT INTO `areakabkota` (`Id_KabKota`, `KabKota`, `Id_Provinsi`) VALUES
(1, 'Kota Semarang', 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `areakecamatan`
--

CREATE TABLE `areakecamatan` (
  `Id_Kecamatan` int(11) NOT NULL,
  `Kecamatan` varchar(100) NOT NULL,
  `Id_KabKota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `areakecamatan`
--

INSERT INTO `areakecamatan` (`Id_Kecamatan`, `Kecamatan`, `Id_KabKota`) VALUES
(1, 'Kecamatan Banyumanik', 1),
(2, 'Kecamatan Candisari', 1),
(3, 'Kecamatan Gajah Mungkur', 1),
(4, 'Kecamatan Gayamsari', 1),
(5, 'Kecamatan Genuk', 1),
(6, 'Kecamatan Gunungpati', 1),
(7, 'Kecamatan Mijen', 1),
(8, 'Kecamatan Ngaliyan', 1),
(9, 'Kecamatan Pedurungan', 1),
(10, 'Kecamatan Semarang Barat', 1),
(11, 'Kecamatan Semarang Selatan', 1),
(12, 'Kecamatan Semarang Tengah', 1),
(13, 'Kecamatan Semarang Timur', 1),
(14, 'Kecamatan Semarang Utara', 1),
(15, 'Kecamatan Tembalang', 1),
(16, 'Kecamatan Tugu', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `areakelurahan`
--

CREATE TABLE `areakelurahan` (
  `Id_Kelurahan` int(10) NOT NULL,
  `Kelurahan` varchar(100) NOT NULL,
  `Id_Kecamatan` int(11) NOT NULL,
  `KodePos` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `areakelurahan`
--

INSERT INTO `areakelurahan` (`Id_Kelurahan`, `Kelurahan`, `Id_Kecamatan`, `KodePos`) VALUES
(1, 'Plombokan', 14, 50171),
(2, 'Purwosari', 14, 50171),
(3, 'Dadapsari', 14, 50171),
(4, 'Tanjungmas', 14, 50171),
(5, 'Bandarharjo', 14, 50171),
(6, 'Kuningan', 14, 50171),
(7, 'Panggung Lor', 14, 50171),
(8, 'Panggung Kidul', 14, 50171),
(9, 'Bulu Lor', 14, 50171);

-- --------------------------------------------------------

--
-- Struktur dari tabel `areanegara`
--

CREATE TABLE `areanegara` (
  `Id_Negara` int(11) NOT NULL,
  `Negara` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `areanegara`
--

INSERT INTO `areanegara` (`Id_Negara`, `Negara`) VALUES
(1, 'INDONESIA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `areaprovinsi`
--

CREATE TABLE `areaprovinsi` (
  `Id_Provinsi` int(11) NOT NULL,
  `Provinsi` varchar(100) NOT NULL,
  `Id_Negara` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `areaprovinsi`
--

INSERT INTO `areaprovinsi` (`Id_Provinsi`, `Provinsi`, `Id_Negara`) VALUES
(1, 'Nanggroe Aceh Darussalam', 1),
(2, 'Sumatera Utara', 1),
(3, 'Sumatera Selatan', 1),
(4, 'Sumatera Barat', 1),
(5, 'Bengkulu', 1),
(6, 'Riau', 1),
(7, 'Kepulauan Riau', 1),
(8, 'Jambi', 1),
(9, 'Lampung', 1),
(10, 'Bangka Belitung', 1),
(11, 'Kalimantan Barat', 1),
(12, 'Kalimantan Timur', 1),
(13, 'Kalimantan Selatan', 1),
(14, 'Kalimantan Tengah', 1),
(15, 'Kalimantan Utara', 1),
(16, 'Banten', 1),
(17, 'DKI Jakarta', 1),
(18, 'Jawa Barat', 1),
(19, 'Jawa Tengah', 1),
(20, 'Daerah Istimewa Yogyakarta', 1),
(21, 'Jawa Timur', 1),
(22, 'Bali', 1),
(23, 'Nusa Tenggara Timur', 1),
(24, 'Nusa Tenggara Barat', 1),
(25, 'Gorontalo', 1),
(26, 'Sulawesi Barat', 1),
(27, 'Sulawesi Tengah', 1),
(28, 'Sulawesi Utara', 1),
(29, 'Sulawesi Tenggara ', 1),
(30, 'Sulawesi Selatan', 1),
(31, 'Maluku Utara', 1),
(32, 'Maluku', 1),
(33, 'Papua Barat', 1),
(34, 'Papua', 1),
(35, 'Papua Tengah', 1),
(36, 'Papua Pegunungan', 1),
(37, 'Papua Selatan', 1),
(38, 'Papua Barat Daya', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areakabkota`
--
ALTER TABLE `areakabkota`
  ADD PRIMARY KEY (`Id_KabKota`),
  ADD KEY `Id_Provinsi` (`Id_Provinsi`);

--
-- Indexes for table `areakecamatan`
--
ALTER TABLE `areakecamatan`
  ADD PRIMARY KEY (`Id_Kecamatan`),
  ADD KEY `IdKabKota` (`Id_KabKota`);

--
-- Indexes for table `areakelurahan`
--
ALTER TABLE `areakelurahan`
  ADD PRIMARY KEY (`Id_Kelurahan`),
  ADD KEY `IdKecamatan` (`Id_Kecamatan`);

--
-- Indexes for table `areanegara`
--
ALTER TABLE `areanegara`
  ADD PRIMARY KEY (`Id_Negara`);

--
-- Indexes for table `areaprovinsi`
--
ALTER TABLE `areaprovinsi`
  ADD PRIMARY KEY (`Id_Provinsi`),
  ADD KEY `IdNegara` (`Id_Negara`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
