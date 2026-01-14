-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2026 at 09:27 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom_12rpl2_shiela_rusmaniawati`
--

-- --------------------------------------------------------

--
-- Table structure for table `input anspirasi`
--

CREATE TABLE `input anspirasi` (
  `id_pelaporan` int NOT NULL,
  `nis` varchar(20) NOT NULL,
  `id_kategori` int NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('siswa','admin') NOT NULL DEFAULT 'siswa',
  `nis` varchar(10) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `nis`, `kelas`) VALUES
(1, 'cila', 'cilaimupp26', 'siswa', '123', '12 rpl 2'),
(2, 'sila', 'silacanci', 'siswa', '2233', '10 plg 2'),
(3, 'shiela', 'shielakiyowok', 'siswa', '3344', '11 tkj 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `input anspirasi`
--
ALTER TABLE `input anspirasi`
  ADD PRIMARY KEY (`id_pelaporan`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `input anspirasi`
--
ALTER TABLE `input anspirasi`
  ADD CONSTRAINT `input anspirasi_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `input anspirasi_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `user` (`nis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
