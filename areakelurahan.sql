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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areakelurahan`
--
ALTER TABLE `areakelurahan`
  ADD PRIMARY KEY (`Id_Kelurahan`),
  ADD KEY `IdKecamatan` (`Id_Kecamatan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
