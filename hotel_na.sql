-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 02:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_na`
--

-- --------------------------------------------------------

--
-- Table structure for table `kamar_na`
--

CREATE TABLE `kamar_na` (
  `id_kamar_na` int(11) NOT NULL,
  `gambar_na` varchar(25) NOT NULL DEFAULT 'kosongkamar.png',
  `jenis_kamar_na` varchar(25) NOT NULL,
  `kapasitas_na` int(4) NOT NULL,
  `harga_na` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar_na`
--

INSERT INTO `kamar_na` (`id_kamar_na`, `gambar_na`, `jenis_kamar_na`, `kapasitas_na`, `harga_na`) VALUES
(2, '668c79ce0cdb9.jpeg', 'Deluxe Room', 4, '240000'),
(17, '668c79c04e5cb.jpeg', 'Single Bad', 1, '100000'),
(18, '668c79f321bd3.jpg', 'Luxury Room', 4, '850000'),
(19, '668c775f4c6e3.jpeg', 'Standart Room', 2, '150000');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_na`
--

CREATE TABLE `pemesanan_na` (
  `id_pemesanan_na` int(11) NOT NULL,
  `id_user_na` int(11) DEFAULT NULL,
  `id_kamar_na` int(11) DEFAULT NULL,
  `nama_na` varchar(50) NOT NULL,
  `email_na` varchar(50) NOT NULL,
  `nohp_na` varchar(15) NOT NULL,
  `check_in_na` date DEFAULT NULL,
  `check_out_na` date DEFAULT NULL,
  `total_harga_na` decimal(10,2) DEFAULT NULL,
  `status_na` varchar(50) DEFAULT 'pending',
  `bukti_pembayaran_na` varchar(50) NOT NULL,
  `keterangan_na` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan_na`
--

INSERT INTO `pemesanan_na` (`id_pemesanan_na`, `id_user_na`, `id_kamar_na`, `nama_na`, `email_na`, `nohp_na`, `check_in_na`, `check_out_na`, `total_harga_na`, `status_na`, `bukti_pembayaran_na`, `keterangan_na`) VALUES
(3, 21, 2, 'asdaa', 'asdar@gmail.com', '1234', '2024-07-09', '2024-07-17', 1600000.00, 'terverifikasi', '668c2cc25dce6.jpg', '123'),
(4, 21, 18, '123', '123@gmail.com', '123', '2024-07-11', '2024-07-25', 99999999.99, 'terverifikasi', '668c2cf994f89.jpeg', '123'),
(5, 22, 17, 'Ajengtes', 'Ajeng@gmail.com', '123', '2024-07-10', '2024-07-20', 1000000.00, 'terverifikasi', '668c301986111.jpeg', 'asd'),
(6, 23, 18, 'Jabaleman', 'jabaleman@gmail.com', '123', '2024-07-10', '2024-07-28', 99999999.99, '', '668c317d2e0a9.jpeg', '1233'),
(7, 24, 2, 'Pria Tampan', 'asdar@gmail.com', '123', '2024-07-23', '2024-08-02', 2000000.00, 'dibatalkan', '668c5eb4a138e.jpg', 'sa'),
(9, 24, 2, 'asdaa', 'asdar@gmail.com', '123', '2024-07-10', '2024-07-19', 1800000.00, 'dibatalkan', '668c5e3c84813.jpg', 'asasas'),
(10, 24, 2, '34', '123@gmail.com', '123', '2024-07-10', '2024-07-18', 1600000.00, 'dibatalkan', '668c63bbe2b57.jpeg', '123'),
(11, 24, 2, 'asdaa', 'asdar@gmail.com', '1234', '2024-07-11', '2024-07-24', 2600000.00, 'terverifikasi', '668c64594d79a.jpeg', 'asd'),
(12, 24, 2, 'asdasdasd', 'Ajeng@gmail.com', '123', '2024-07-09', '2024-07-10', 200000.00, 'menunggu verifikasi', '668c653a5a079.jpeg', 'ss'),
(13, 24, 2, 'jarotasd', 'asdar@gmail.com', '213', '2024-07-10', '2024-07-26', 3200000.00, 'menunggu verifikasi', '668c666bcaea5.jpeg', 'asd'),
(14, 24, 17, 'asd', 'asd@gmail.com', '123', '2024-07-10', '2024-07-17', 700000.00, 'terverifikasi', '', '123'),
(15, 24, 2, '123', '123@gmail.com', '123', '2024-07-11', '2024-07-31', 4000000.00, 'menunggu verifikasi', '668c73762f963.jpeg', '123312'),
(16, 24, 17, 'asdaa', 'asdaa@gmail.com', '1234', '2024-07-09', '2024-07-26', 1700000.00, 'menunggu verifikasi', '668c734aab1b5.jpg', '12332'),
(17, 24, 17, 'adsadasdasd', 'asdar@gmail.com', 'asdasdasd', '2024-07-18', '2024-07-31', 1300000.00, 'menunggu verifikasi', '668c73600c601.jpeg', 'asadsads'),
(18, 24, 2, 'asdadsasd', 'asdar@gmail.com', 'asdasdasd', '2024-07-18', '2024-08-01', 2800000.00, 'menunggu verifikasi', '668c738804dfd.jpg', 'asddasasd'),
(19, 24, 2, 'asda', 'asdar@gmail.com', 'addas', '2024-07-09', '2024-07-18', 1800000.00, 'menunggu verifikasi', '668c740311465.jpg', 'asdasd'),
(20, 24, 2, 'asd', 'asdar@gmail.com', 'asdar@gmail.com', '2024-07-09', '2024-07-23', 2800000.00, 'menunggu verifikasi', '668c7458ef430.jpeg', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi_kamar_na`
--

CREATE TABLE `reservasi_kamar_na` (
  `id_reservasi_kamar_na` int(11) NOT NULL,
  `id_reservasi_na` int(11) NOT NULL,
  `id_kamar_na` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservasi_na`
--

CREATE TABLE `reservasi_na` (
  `id_reservasi_na` int(11) NOT NULL,
  `id_user_na` int(11) NOT NULL,
  `tanggal_checkin_na` date NOT NULL,
  `tanggal_checkout_na` date NOT NULL,
  `jumlah_harga_na` decimal(15,2) NOT NULL,
  `status_reservasi` enum('pending','konfirmasi','batal','') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservasi_na`
--

INSERT INTO `reservasi_na` (`id_reservasi_na`, `id_user_na`, `tanggal_checkin_na`, `tanggal_checkout_na`, `jumlah_harga_na`, `status_reservasi`) VALUES
(1, 5, '2024-07-10', '2024-07-13', 50000000.00, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_na`
--

CREATE TABLE `user_na` (
  `id_na` int(11) NOT NULL,
  `email_na` varchar(50) NOT NULL,
  `nama_na` varchar(50) NOT NULL,
  `password_na` varchar(64) NOT NULL,
  `no_hp_na` varchar(15) NOT NULL,
  `foto_na` varchar(255) NOT NULL DEFAULT 'kosong.png',
  `alamat_na` text NOT NULL,
  `role_na` varchar(12) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_na`
--

INSERT INTO `user_na` (`id_na`, `email_na`, `nama_na`, `password_na`, `no_hp_na`, `foto_na`, `alamat_na`, `role_na`) VALUES
(21, 'staff@gmail.com', 'staff', '$2y$10$/gF3aCOrUNqAYraU8dWpp.hUmBPzvhvvvHDr8.w46o5P6nfMsu5xq', '123', 'kosong.png', 'alamat_na', 'staff'),
(22, 'admin@gmail.com', 'admin', '$2y$10$KIupZuIVZaCtxXq9tFsPFu8lHYMgaXmQ7/xFu1SQscwFDVMmKJF2i', '123', 'kosong.png', 'alamat_na', 'admin'),
(23, 'user@gmail.com', 'user', '$2y$10$U4YfbomdY8PZCHr8rzgRputVGRlMXTLnNIIs5h/LOON1H55siDtw6', '123', 'kosong.png', 'alamat_na', 'user'),
(24, 'james@gmail.com', 'james', '$2y$10$6unAN/SGIM76rv86kHXCYuFZY3V.TkaxCRZt48PcOG7d1v6jLkHUu', '123', '668c7ae93f814.jpeg', 'diamana', 'user'),
(26, 'asdar@gmail.com', 'ameks', 'asd', '123', '668c7c6e40a1b.jpeg', 'asdasdadsssss', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar_na`
--
ALTER TABLE `kamar_na`
  ADD PRIMARY KEY (`id_kamar_na`);

--
-- Indexes for table `pemesanan_na`
--
ALTER TABLE `pemesanan_na`
  ADD PRIMARY KEY (`id_pemesanan_na`),
  ADD KEY `id_user_na` (`id_user_na`),
  ADD KEY `id_kamar_na` (`id_kamar_na`);

--
-- Indexes for table `reservasi_kamar_na`
--
ALTER TABLE `reservasi_kamar_na`
  ADD PRIMARY KEY (`id_reservasi_kamar_na`),
  ADD KEY `id_reservasi_na` (`id_reservasi_na`,`id_kamar_na`),
  ADD KEY `id_kamar_na` (`id_kamar_na`);

--
-- Indexes for table `reservasi_na`
--
ALTER TABLE `reservasi_na`
  ADD PRIMARY KEY (`id_reservasi_na`),
  ADD UNIQUE KEY `id_user_na` (`id_user_na`);

--
-- Indexes for table `user_na`
--
ALTER TABLE `user_na`
  ADD PRIMARY KEY (`id_na`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kamar_na`
--
ALTER TABLE `kamar_na`
  MODIFY `id_kamar_na` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pemesanan_na`
--
ALTER TABLE `pemesanan_na`
  MODIFY `id_pemesanan_na` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reservasi_kamar_na`
--
ALTER TABLE `reservasi_kamar_na`
  MODIFY `id_reservasi_kamar_na` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservasi_na`
--
ALTER TABLE `reservasi_na`
  MODIFY `id_reservasi_na` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_na`
--
ALTER TABLE `user_na`
  MODIFY `id_na` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemesanan_na`
--
ALTER TABLE `pemesanan_na`
  ADD CONSTRAINT `pemesanan_na_ibfk_1` FOREIGN KEY (`id_user_na`) REFERENCES `user_na` (`id_na`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_na_ibfk_2` FOREIGN KEY (`id_kamar_na`) REFERENCES `kamar_na` (`id_kamar_na`) ON UPDATE CASCADE;

--
-- Constraints for table `reservasi_kamar_na`
--
ALTER TABLE `reservasi_kamar_na`
  ADD CONSTRAINT `reservasi_kamar_na_ibfk_1` FOREIGN KEY (`id_reservasi_na`) REFERENCES `reservasi_na` (`id_reservasi_na`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
