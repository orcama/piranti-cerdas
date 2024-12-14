-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 10:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas2pirdas`
--

-- --------------------------------------------------------

--
-- Table structure for table `sensor_keamanan`
--

CREATE TABLE `sensor_keamanan` (
  `id` int(11) NOT NULL,
  `angleX` float DEFAULT NULL,
  `angleY` float DEFAULT NULL,
  `posisi_datar` varchar(10) DEFAULT NULL,
  `status_led` varchar(10) DEFAULT NULL,
  `status_buzzer` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensor_keamanan`
--

INSERT INTO `sensor_keamanan` (`id`, `angleX`, `angleY`, `posisi_datar`, `status_led`, `status_buzzer`) VALUES
(222, 9.81, 0.42, 'Datar', 'Nyala', 'Tidak Akti'),
(223, 3.56, -48.43, 'Miring', 'Mati', 'Aktif'),
(224, 11.05, 5.12, 'Datar', 'Nyala', 'Tidak Akti'),
(225, 4.72, -43.13, 'Miring', 'Mati', 'Aktif'),
(226, 9.57, 0.6, 'Datar', 'Nyala', 'Tidak Akti'),
(227, -6.6, 61.98, 'Miring', 'Mati', 'Aktif'),
(228, 10.99, -1.72, 'Datar', 'Nyala', 'Tidak Akti'),
(229, 37.02, 3.15, 'Miring', 'Mati', 'Aktif'),
(230, 9.65, 0.61, 'Datar', 'Nyala', 'Tidak Akti'),
(231, 0.68, 57.39, 'Miring', 'Mati', 'Aktif'),
(232, 10.32, -0.24, 'Datar', 'Nyala', 'Tidak Akti'),
(233, 7.57, -62.85, 'Miring', 'Mati', 'Aktif'),
(234, 9.6, 0.73, 'Datar', 'Nyala', 'Tidak Akti'),
(235, 15.68, 98.93, 'Miring', 'Mati', 'Aktif'),
(236, 9.66, -2.8, 'Datar', 'Nyala', 'Tidak Akti'),
(237, 6.71, -184.48, 'Miring', 'Mati', 'Aktif'),
(238, 9.56, 4.33, 'Datar', 'Nyala', 'Tidak Akti'),
(239, 10.59, 126.07, 'Miring', 'Mati', 'Aktif'),
(240, 9.63, 0.54, 'Datar', 'Nyala', 'Tidak Akti');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensor_keamanan`
--
ALTER TABLE `sensor_keamanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sensor_keamanan`
--
ALTER TABLE `sensor_keamanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
