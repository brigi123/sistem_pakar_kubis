-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2020 at 04:11 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sispak_rest`
--

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `gejala` varchar(256) NOT NULL,
  `point` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `id_penyakit`, `gejala`, `point`) VALUES
(1, 1, 'Ketika tanaman dicabut, akar membengkak seperti gada', 1),
(2, 1, 'Daun pada tanaman akan layu seperti kekurangan air', 0.6),
(3, 1, 'Gejala pada tanaman akan terjadi pada siang hari, dan pada malam haari akan segar kembali hingga pagi', 0.6),
(4, 1, 'Tanaman menjadi kerdil', 0.7),
(5, 1, 'Akar membengkak seperti umbi', 1),
(6, 2, 'Daun berair', 0.6),
(7, 2, 'Muncul bercak kecoklatan pada daun', 0.7),
(8, 2, 'Daun melunak dan berlendir', 0.9),
(9, 2, 'Mengeluarkan bau yang khas pada daun', 0.9),
(10, 2, 'Bercak membesar dan bentuknya tidak beraturan', 0.8),
(11, 3, 'Daun atau batang kubis menguning hingga menghitam', 0.6),
(12, 3, 'Tanaman layu', 0.5),
(13, 3, 'Daun yang terinfeksi akan membentuk wilayah V', 0.7),
(14, 3, 'Dasar daun menjadi kering', 0.9),
(15, 3, 'Tanaman menunjukkan gejala kerdil', 0.9),
(16, 4, 'Pada daun terdapat bercak-bercak kecil', 0.3),
(17, 4, 'Bercak pada daun berwarna kelabu gelap mendekati hitam', 0.6),
(18, 4, 'Bercak melingkar atau bulat', 0.7),
(19, 4, 'Bercak mudah berkembang dan meluas', 0.7),
(20, 4, 'Noda kuning pada daun paling tua atau batang', 0.8),
(21, 5, 'Ulat yang menyerang 1 atau 2', 0.8),
(22, 5, 'Daunnya habis dimakan', 0.8),
(23, 5, 'Adanya sisa-sisa kotoran pada tanaman yang dimakan ulat ', 0.8),
(24, 5, 'Tanaman akan berlubang dan hanya tinggal tulang-tulang daunnya', 1),
(25, 6, 'Memakan pinggir daun', 0.8),
(26, 6, 'Daun berlubang-lubang', 0.7),
(27, 6, 'Daun tampak bercak-bercak putih', 0.7),
(28, 6, 'Jika ulat terancam, akan menjatuhkan diri dan mengeluarkan benang', 0.7),
(29, 6, 'Daun menjadi tinggal tulang daun', 0.9);

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `simbol_penyakit` varchar(128) NOT NULL,
  `nama_penyakit` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `simbol_penyakit`, `nama_penyakit`) VALUES
(1, 'A', 'Akar Gada (Plasmodiophora brassicae)'),
(2, 'B', 'Busuk Lunak (Erwina Carotovora)'),
(3, 'C', 'Busuk Hitam (Xanthomonas Campestris)'),
(4, 'D', 'Bercak Daun Alternaria (Alternaria Brassicae)'),
(5, 'E', 'Ulat Krop (Crocidolomia binotalis Zell)'),
(6, 'F', 'Ulat Kubis (Plutella Xylostella)');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `alamat`, `telepon`) VALUES
(2, 'Brigita Tiora', 'Banyuwangi', '08123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
