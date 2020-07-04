-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 10:54 AM
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
(1, 1, 'ketika tanaman dicabut, akar membengkak seperti gada', 1),
(2, 1, 'daun pada tanaman akan layu seperti kekurangan air', 0.6),
(3, 1, 'gejala pada tanaman terjadi pada siang hari, dan pada malam hari akan segar kembali hingga pagi', 0.6),
(4, 1, 'tanaman menjadi kerdil', 0.7),
(5, 1, 'akar membengkak seperti umbi', 1),
(6, 2, 'daun berair', 0.6),
(7, 2, 'muncul bercak kecoklatan pada daun', 0.7),
(8, 2, 'daun melunak dan berlendir', 0.9),
(9, 2, 'mengeluarkan bau yang khas pada daun', 0.9),
(10, 2, 'bercak membesar dan bentuknya tidak beraturan', 0.8),
(11, 3, 'daun atau batang kubis menguning hingga menghitam', 0.6),
(12, 3, 'tanaman layu', 0.5),
(13, 3, 'daun yang terinfeksi akan membentuk wilayah V', 0.7),
(14, 3, 'dasar daun menjadi kering', 0.9),
(15, 3, 'tanaman menunjukkan gejala kerdil', 0.9),
(16, 4, 'pada daun terdapat bercak-bercak kecil', 0.3),
(17, 4, 'bercak pada daun berwarna kelabu gelap mendekati hitam', 0.6),
(18, 4, 'bercak melingkar atau bulat', 0.7),
(19, 4, 'bercak mudah berkembang dan meluas', 0.7),
(20, 4, 'noda kuning pada daun paling tua atau batang', 0.8),
(21, 5, 'ulat yang menyerang 1 atau 2', 0.8),
(22, 5, 'daunnya habis dimakan', 0.8),
(23, 5, 'ada sisa-sisa kotoran pada tanaman yang dimakan ulat ', 0.8),
(24, 5, 'tanaman berlubang dan hanya tinggal tulang-tulang daunnya', 1),
(25, 6, 'ulat memakan pinggir daun', 0.8),
(26, 6, 'daun berlubang-lubang', 0.7),
(27, 6, 'daun tampak bercak-bercak putih', 0.7),
(28, 6, 'jika ulat terancam, akan menjatuhkan diri dan mengeluarkan benang', 0.7),
(29, 6, 'daun menjadi tinggal tulang daun', 0.9);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `jawaban` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_user`, `id_penyakit`, `id_gejala`, `jawaban`) VALUES
(1, 2, 1, 2, 'b'),
(2, 2, 1, 1, 'b'),
(3, 2, 1, 3, 'b'),
(4, 2, 1, 4, 'b'),
(5, 2, 1, 5, 'b'),
(6, 2, 2, 6, 'b'),
(7, 2, 2, 7, 'a'),
(8, 2, 2, 8, 'b'),
(9, 2, 2, 9, 'a'),
(10, 2, 2, 10, 'b'),
(11, 2, 3, 11, 'b'),
(12, 2, 3, 12, 'a'),
(13, 2, 3, 13, 'a'),
(14, 2, 3, 14, 'b'),
(15, 2, 3, 15, 'a'),
(16, 2, 4, 16, 'b'),
(17, 2, 4, 17, 'a'),
(18, 2, 4, 18, 'b'),
(19, 2, 4, 19, 'b'),
(20, 2, 4, 20, 'a');

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
(2, 'Brigita Tiora', 'Jakarta', '0987654321'),
(5, 'Jhon F. Kenedy', 'Washington DC', '1234567890'),
(11, 'Rudy Hartanto', 'Jakarta', '1233345677');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

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
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
