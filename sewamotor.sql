-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 10:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewamotor`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `email`, `no_telp`, `alamat`) VALUES
(1, 'Alief Try Helfian', 'monb04973@gmail.com', '085356589551', 'Batam'),
(2, 'Enno Nurwansyah Rasyidi', 'kanekitouru2@gmail.com', '082388310607', 'Batam'),
(3, 'Muhammad Agil Azmi', 'eiternity231@gmail.com', '081261556984', 'Batam');

-- --------------------------------------------------------

--
-- Table structure for table `garasi`
--

CREATE TABLE `garasi` (
  `id_garasi` int(11) NOT NULL,
  `kendaraan_id_motor` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garasi`
--

INSERT INTO `garasi` (`id_garasi`, `kendaraan_id_motor`, `stok`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_motor` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `warna_motor` varchar(100) NOT NULL,
  `harga_per_hari` int(11) NOT NULL,
  `gambar_motor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_motor`, `brand`, `tipe`, `tahun`, `warna_motor`, `harga_per_hari`, `gambar_motor`) VALUES
(1, 'Yamaha', 'Nmax 125', 2024, 'Biru Tua', 85000, 'yamaha nmax 155.jpeg'),
(2, 'Honda', 'Vario 125', 2024, 'Biru Tua', 85000, 'honda vario 125.jpeg'),
(3, 'Yamaha', 'XSR 155', 2023, 'Merah', 115000, 'yahama xsr 155.png'),
(4, 'Mio', 'Gear 125', 2024, 'Hitam - Kuning', 85000, 'gear mio 125.png');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `stok` int(11) NOT NULL,
  `pengembalian_id_garasi` int(11) NOT NULL,
  `pengembalian_id_penyewaan` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `tanggal_pengembalian`, `stok`, `pengembalian_id_garasi`, `pengembalian_id_penyewaan`, `denda`) VALUES
(1, '2024-04-29', 1, 1, 1, 1000),
(2, '2024-05-10', 1, 1, 2, 1657500),
(2, '2024-05-10', 1, 2, 2, 1657500);

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` int(11) NOT NULL,
  `penyewaan_id_customer` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_balik` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `penyewaan_id_customer`, `tanggal_pinjam`, `tanggal_balik`) VALUES
(1, 1, '2024-03-20', '2024-03-24'),
(2, 2, '2024-04-25', '2024-04-27'),
(3, 3, '2024-04-26', '2024-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan_motor`
--

CREATE TABLE `penyewaan_motor` (
  `id_penyewaan` int(11) NOT NULL,
  `penyewaan_id_garasi` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyewaan_motor`
--

INSERT INTO `penyewaan_motor` (`id_penyewaan`, `penyewaan_id_garasi`, `stok`) VALUES
(1, 1, 1),
(2, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`) VALUES
(1, 'monb', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `garasi`
--
ALTER TABLE `garasi`
  ADD PRIMARY KEY (`id_garasi`),
  ADD KEY `fk_id_motor_garasi` (`kendaraan_id_motor`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_motor`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD KEY `fk_id_garasi_pengembalian` (`pengembalian_id_garasi`),
  ADD KEY `fk_id_penyewaan_pengembalian` (`pengembalian_id_penyewaan`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`),
  ADD KEY `peminjam_ibfk_1` (`penyewaan_id_customer`);

--
-- Indexes for table `penyewaan_motor`
--
ALTER TABLE `penyewaan_motor`
  ADD KEY `fk_id_garasi_penyewaan` (`penyewaan_id_garasi`),
  ADD KEY `id_penyewaan` (`id_penyewaan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `garasi`
--
ALTER TABLE `garasi`
  ADD CONSTRAINT `fk_id_motor_garasi` FOREIGN KEY (`kendaraan_id_motor`) REFERENCES `kendaraan` (`id_motor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `fk_id_garasi_pengembalian` FOREIGN KEY (`pengembalian_id_garasi`) REFERENCES `garasi` (`id_garasi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_penyewaan_pengembalian` FOREIGN KEY (`pengembalian_id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_ibfk_1` FOREIGN KEY (`penyewaan_id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penyewaan_motor`
--
ALTER TABLE `penyewaan_motor`
  ADD CONSTRAINT `fk_id_garasi_penyewaan` FOREIGN KEY (`penyewaan_id_garasi`) REFERENCES `garasi` (`id_garasi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_peminjam_penyewaan` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
