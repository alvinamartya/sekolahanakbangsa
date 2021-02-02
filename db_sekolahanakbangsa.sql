-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2021 at 06:34 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sekolahanakbangsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `aksi`
--

CREATE TABLE `aksi` (
  `id_aksi` int(11) NOT NULL,
  `id_relawan` int(11) NOT NULL,
  `nama_aksi` varchar(100) NOT NULL,
  `target_donasi` decimal(10,0) NOT NULL,
  `deskripsi_aksi` varchar(255) NOT NULL,
  `tanggal_selesai` datetime NOT NULL DEFAULT current_timestamp(),
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `aksi_barang`
--

CREATE TABLE `aksi_barang` (
  `id` int(11) NOT NULL,
  `id_aksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `aksi_biaya_lainnya`
--

CREATE TABLE `aksi_biaya_lainnya` (
  `id` int(11) NOT NULL,
  `id_aksi` int(11) NOT NULL,
  `id_biaya_lainnya` int(11) NOT NULL,
  `biaya` int(11) DEFAULT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `deskripsi_barang` varchar(255) NOT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `biaya_lainnya`
--

CREATE TABLE `biaya_lainnya` (
  `id_biaya_lainnya` int(11) NOT NULL,
  `nama_biaya_lainnya` varchar(100) NOT NULL,
  `deskripsi_biaya_lainnya` varchar(255) NOT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cluster_relawan`
--

CREATE TABLE `cluster_relawan` (
  `id_cluster_relawan` int(11) NOT NULL,
  `nama_cluster` varchar(100) NOT NULL,
  `deskripsi_cluster` varchar(255) NOT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donatur`
--

CREATE TABLE `donatur` (
  `id_donatur` int(11) NOT NULL,
  `id_user_login` int(11) NOT NULL,
  `nama_donatur` varchar(100) NOT NULL,
  `email_donatur` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `creaby` varchar(100) NOT NULL,
  `credate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donatur_aksi`
--

CREATE TABLE `donatur_aksi` (
  `id` int(11) NOT NULL,
  `id_donatur` int(11) NOT NULL,
  `id_aksi` int(11) NOT NULL,
  `id_status_aksi` int(11) NOT NULL,
  `donasi` int(11) NOT NULL,
  `bukti_transfer` varchar(100) DEFAULT NULL,
  `is_valid` enum('Y','N') DEFAULT NULL,
  `is_anonum` enum('Y','N') NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gambar_aksi`
--

CREATE TABLE `gambar_aksi` (
  `id` int(11) NOT NULL,
  `id_aksi` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_user_login` int(11) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `jabatan_karyawan` enum('Admin','Super Admin') NOT NULL,
  `nik` varchar(50) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` datetime NOT NULL DEFAULT current_timestamp(),
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_user_login`, `nama_karyawan`, `jenis_kelamin`, `jabatan_karyawan`, `nik`, `no_telepon`, `email`, `tempat_lahir`, `tanggal_lahir`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(2, 1, 'Alvin Amartya', 'L', 'Super Admin', '', '', '', '', '1971-01-01 00:00:00', 'user_login', '2021-01-26 11:24:28', 'user_login', '2021-01-26 11:24:33', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `kebutuhan_tahunan`
--

CREATE TABLE `kebutuhan_tahunan` (
  `id` int(11) NOT NULL,
  `id_relawan` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `tahun` char(4) NOT NULL,
  `total_kebutuhan` decimal(10,0) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `is_approved` enum('Y','N') DEFAULT NULL,
  `laporan_pertanggung_jawaban` varchar(100) DEFAULT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kt_barang`
--

CREATE TABLE `kt_barang` (
  `id` int(11) NOT NULL,
  `id_kt` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kt_biaya_lainnya`
--

CREATE TABLE `kt_biaya_lainnya` (
  `id` int(11) NOT NULL,
  `id_kt` int(11) NOT NULL,
  `id_biaya_lainnya` int(11) NOT NULL,
  `biaya` int(11) DEFAULT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `relawan`
--

CREATE TABLE `relawan` (
  `id_relawan` int(11) NOT NULL,
  `id_cluster_relawan` int(11) NOT NULL,
  `id_sekolah` int(11) DEFAULT NULL,
  `id_user_login` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama_relawan` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` datetime NOT NULL DEFAULT current_timestamp(),
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `jenis_sekolah` enum('Rumah Singgah','Sekolah Pedalaman') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `nisn` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` datetime NOT NULL DEFAULT current_timestamp(),
  `jenis_kelamin` enum('L','P') NOT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status_aksi`
--

CREATE TABLE `status_aksi` (
  `id_status_aksi` int(11) NOT NULL,
  `nama_status_aksi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Donatur','Relawan','Karyawan') NOT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `username`, `password`, `role`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(1, 'sa', '$2y$10$yp1I2KBPVa1TNCq3JTZxheZgQ94GaKtdftJ8047niyjV22br4JSWG', 'Karyawan', 'Alvin Amartya', '2021-01-21 10:39:34', 'Alvin Amartya', '2021-01-21 10:39:34', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aksi`
--
ALTER TABLE `aksi`
  ADD PRIMARY KEY (`id_aksi`),
  ADD KEY `id_relawan` (`id_relawan`);

--
-- Indexes for table `aksi_barang`
--
ALTER TABLE `aksi_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aksi` (`id_aksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `aksi_biaya_lainnya`
--
ALTER TABLE `aksi_biaya_lainnya`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aksi` (`id_aksi`),
  ADD KEY `id_biaya_lainnya` (`id_biaya_lainnya`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `biaya_lainnya`
--
ALTER TABLE `biaya_lainnya`
  ADD PRIMARY KEY (`id_biaya_lainnya`);

--
-- Indexes for table `cluster_relawan`
--
ALTER TABLE `cluster_relawan`
  ADD PRIMARY KEY (`id_cluster_relawan`);

--
-- Indexes for table `donatur`
--
ALTER TABLE `donatur`
  ADD PRIMARY KEY (`id_donatur`),
  ADD KEY `id_user_login` (`id_user_login`);

--
-- Indexes for table `donatur_aksi`
--
ALTER TABLE `donatur_aksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_donatur` (`id_donatur`),
  ADD KEY `id_aksi` (`id_aksi`),
  ADD KEY `id_status_aksi` (`id_status_aksi`);

--
-- Indexes for table `gambar_aksi`
--
ALTER TABLE `gambar_aksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aksi` (`id_aksi`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_user_login` (`id_user_login`);

--
-- Indexes for table `kebutuhan_tahunan`
--
ALTER TABLE `kebutuhan_tahunan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_relawan` (`id_relawan`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indexes for table `kt_barang`
--
ALTER TABLE `kt_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kt` (`id_kt`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `kt_biaya_lainnya`
--
ALTER TABLE `kt_biaya_lainnya`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kt` (`id_kt`),
  ADD KEY `id_biaya_lainnya` (`id_biaya_lainnya`);

--
-- Indexes for table `relawan`
--
ALTER TABLE `relawan`
  ADD PRIMARY KEY (`id_relawan`),
  ADD KEY `id_cluster_relawan` (`id_cluster_relawan`),
  ADD KEY `id_sekolah` (`id_sekolah`),
  ADD KEY `id_user_login` (`id_user_login`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indexes for table `status_aksi`
--
ALTER TABLE `status_aksi`
  ADD PRIMARY KEY (`id_status_aksi`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aksi`
--
ALTER TABLE `aksi`
  MODIFY `id_aksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aksi_barang`
--
ALTER TABLE `aksi_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aksi_biaya_lainnya`
--
ALTER TABLE `aksi_biaya_lainnya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `biaya_lainnya`
--
ALTER TABLE `biaya_lainnya`
  MODIFY `id_biaya_lainnya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cluster_relawan`
--
ALTER TABLE `cluster_relawan`
  MODIFY `id_cluster_relawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donatur`
--
ALTER TABLE `donatur`
  MODIFY `id_donatur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donatur_aksi`
--
ALTER TABLE `donatur_aksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gambar_aksi`
--
ALTER TABLE `gambar_aksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kebutuhan_tahunan`
--
ALTER TABLE `kebutuhan_tahunan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kt_barang`
--
ALTER TABLE `kt_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kt_biaya_lainnya`
--
ALTER TABLE `kt_biaya_lainnya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relawan`
--
ALTER TABLE `relawan`
  MODIFY `id_relawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_aksi`
--
ALTER TABLE `status_aksi`
  MODIFY `id_status_aksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aksi`
--
ALTER TABLE `aksi`
  ADD CONSTRAINT `aksi_ibfk_1` FOREIGN KEY (`id_relawan`) REFERENCES `relawan` (`id_relawan`);

--
-- Constraints for table `aksi_barang`
--
ALTER TABLE `aksi_barang`
  ADD CONSTRAINT `aksi_barang_ibfk_1` FOREIGN KEY (`id_aksi`) REFERENCES `aksi` (`id_aksi`),
  ADD CONSTRAINT `aksi_barang_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `aksi_biaya_lainnya`
--
ALTER TABLE `aksi_biaya_lainnya`
  ADD CONSTRAINT `aksi_biaya_lainnya_ibfk_1` FOREIGN KEY (`id_aksi`) REFERENCES `aksi` (`id_aksi`),
  ADD CONSTRAINT `aksi_biaya_lainnya_ibfk_2` FOREIGN KEY (`id_biaya_lainnya`) REFERENCES `biaya_lainnya` (`id_biaya_lainnya`);

--
-- Constraints for table `donatur`
--
ALTER TABLE `donatur`
  ADD CONSTRAINT `donatur_ibfk_1` FOREIGN KEY (`id_user_login`) REFERENCES `user_login` (`id`);

--
-- Constraints for table `donatur_aksi`
--
ALTER TABLE `donatur_aksi`
  ADD CONSTRAINT `donatur_aksi_ibfk_1` FOREIGN KEY (`id_donatur`) REFERENCES `donatur` (`id_donatur`),
  ADD CONSTRAINT `donatur_aksi_ibfk_2` FOREIGN KEY (`id_aksi`) REFERENCES `aksi` (`id_aksi`),
  ADD CONSTRAINT `donatur_aksi_ibfk_3` FOREIGN KEY (`id_status_aksi`) REFERENCES `status_aksi` (`id_status_aksi`);

--
-- Constraints for table `gambar_aksi`
--
ALTER TABLE `gambar_aksi`
  ADD CONSTRAINT `gambar_aksi_ibfk_1` FOREIGN KEY (`id_aksi`) REFERENCES `aksi` (`id_aksi`);

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_user_login`) REFERENCES `user_login` (`id`);

--
-- Constraints for table `kebutuhan_tahunan`
--
ALTER TABLE `kebutuhan_tahunan`
  ADD CONSTRAINT `kebutuhan_tahunan_ibfk_1` FOREIGN KEY (`id_relawan`) REFERENCES `relawan` (`id_relawan`),
  ADD CONSTRAINT `kebutuhan_tahunan_ibfk_2` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`);

--
-- Constraints for table `kt_barang`
--
ALTER TABLE `kt_barang`
  ADD CONSTRAINT `kt_barang_ibfk_1` FOREIGN KEY (`id_kt`) REFERENCES `kebutuhan_tahunan` (`id`),
  ADD CONSTRAINT `kt_barang_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `kt_biaya_lainnya`
--
ALTER TABLE `kt_biaya_lainnya`
  ADD CONSTRAINT `kt_biaya_lainnya_ibfk_1` FOREIGN KEY (`id_kt`) REFERENCES `kebutuhan_tahunan` (`id`),
  ADD CONSTRAINT `kt_biaya_lainnya_ibfk_2` FOREIGN KEY (`id_biaya_lainnya`) REFERENCES `biaya_lainnya` (`id_biaya_lainnya`);

--
-- Constraints for table `relawan`
--
ALTER TABLE `relawan`
  ADD CONSTRAINT `relawan_ibfk_1` FOREIGN KEY (`id_cluster_relawan`) REFERENCES `cluster_relawan` (`id_cluster_relawan`),
  ADD CONSTRAINT `relawan_ibfk_2` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`),
  ADD CONSTRAINT `relawan_ibfk_3` FOREIGN KEY (`id_user_login`) REFERENCES `user_login` (`id`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
