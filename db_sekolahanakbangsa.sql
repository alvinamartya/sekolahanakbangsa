-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2021 at 07:57 PM
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

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `get_gambar_aksi` (`idAksi` INT) RETURNS VARCHAR(100) CHARSET utf8mb4 BEGIN
    return (SELECT gambar FROM gambar_aksi where id_aksi = idAksi LIMIT 1);
    end$$

DELIMITER ;

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

--
-- Dumping data for table `aksi`
--

INSERT INTO `aksi` (`id_aksi`, `id_relawan`, `nama_aksi`, `target_donasi`, `deskripsi_aksi`, `tanggal_selesai`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(6, 12, 'Bantu anak pesantren', '130000', 'Test', '2021-02-25 00:00:00', 'teddy', '2021-02-10 20:01:31', 'teddy', '2021-02-10 20:01:51', 'A');

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

--
-- Dumping data for table `aksi_barang`
--

INSERT INTO `aksi_barang` (`id`, `id_aksi`, `id_barang`, `jumlah`, `harga_satuan`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(3, 6, 13, 4, 25000, 'teddy', '2021-02-10 20:01:31', 'teddy', '2021-02-10 20:01:51', 'A');

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

--
-- Dumping data for table `aksi_biaya_lainnya`
--

INSERT INTO `aksi_biaya_lainnya` (`id`, `id_aksi`, `id_biaya_lainnya`, `biaya`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(1, 6, 16, 30000, 'teddy', '2021-02-10 20:01:31', 'teddy', '2021-02-10 20:01:51', 'A');

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

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `deskripsi_barang`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(1, 'Papan tulis', '-', 'Alvin Amartya', '2021-02-11 01:15:53', 'Alvin Amartya', '2021-02-11 01:15:53', 'A'),
(2, 'Kursi', '-', 'Alvin Amartya', '2021-02-11 01:16:05', 'Alvin Amartya', '2021-02-11 01:16:05', 'A'),
(3, 'Meja', '-', 'Alvin Amartya', '2021-02-11 01:16:12', 'Alvin Amartya', '2021-02-11 01:16:12', 'A'),
(4, 'Penghapus', '-', 'Alvin Amartya', '2021-02-11 01:16:20', 'Alvin Amartya', '2021-02-11 01:16:20', 'A'),
(5, 'Pensil', '-', 'Alvin Amartya', '2021-02-11 01:16:27', 'Alvin Amartya', '2021-02-11 01:16:27', 'A'),
(6, 'Pena', '-', 'Alvin Amartya', '2021-02-11 01:16:43', 'Alvin Amartya', '2021-02-11 01:16:43', 'A'),
(7, 'Buku', '-', 'Alvin Amartya', '2021-02-11 01:16:51', 'Alvin Amartya', '2021-02-11 01:16:51', 'A'),
(8, 'Sandal', '-', 'Alvin Amartya', '2021-02-11 01:17:00', 'Alvin Amartya', '2021-02-11 01:17:00', 'A'),
(9, 'Dasi', '-', 'Alvin Amartya', '2021-02-11 01:17:07', 'Alvin Amartya', '2021-02-11 01:17:07', 'A'),
(10, 'Seragam', '-', 'Alvin Amartya', '2021-02-11 01:17:14', 'Alvin Amartya', '2021-02-11 01:17:14', 'A'),
(11, 'Mukenah', '-', 'Alvin Amartya', '2021-02-11 01:17:21', 'Alvin Amartya', '2021-02-11 01:17:21', 'A'),
(12, 'Sarung', '-', 'Alvin Amartya', '2021-02-11 01:17:26', 'Alvin Amartya', '2021-02-11 01:17:26', 'A'),
(13, 'Meja', 'Meja', 'Alvin Amartya', '2021-02-10 19:54:03', 'Alvin Amartya', '2021-02-10 19:54:03', 'A'),
(14, 'P3K', 'P3K', 'Alvin Amartya', '2021-02-10 19:54:17', 'Alvin Amartya', '2021-02-10 19:54:17', 'A'),
(15, 'Kursi', 'Kursi', 'Alvin Amartya', '2021-02-10 19:54:25', 'Alvin Amartya', '2021-02-10 19:54:25', 'A'),
(16, 'Gadget', '-', 'Alvin Amartya', '2021-02-11 01:17:57', 'Alvin Amartya', '2021-02-11 01:17:57', 'A'),
(17, 'Komik', '-', 'Alvin Amartya', '2021-02-11 01:18:11', 'Alvin Amartya', '2021-02-11 01:18:11', 'A'),
(18, 'Majalah', '-', 'Alvin Amartya', '2021-02-11 01:18:17', 'Alvin Amartya', '2021-02-11 01:18:17', 'A'),
(19, 'Kabel Rol', '-', 'Alvin Amartya', '2021-02-11 01:18:28', 'Alvin Amartya', '2021-02-11 01:18:28', 'A'),
(20, 'Sleeping Bag', '-', 'Alvin Amartya', '2021-02-11 01:18:40', 'Alvin Amartya', '2021-02-11 01:18:40', 'A'),
(21, 'Karpet', '-', 'Alvin Amartya', '2021-02-11 01:18:45', 'Alvin Amartya', '2021-02-11 01:18:45', 'A'),
(22, 'Slendang', '-', 'Alvin Amartya', '2021-02-11 01:18:53', 'Alvin Amartya', '2021-02-11 01:18:53', 'A'),
(23, 'Obat Merah', '-', 'Alvin Amartya', '2021-02-11 01:19:06', 'Alvin Amartya', '2021-02-11 01:19:06', 'A'),
(24, 'Bodrexin', '-', 'Alvin Amartya', '2021-02-11 01:19:14', 'Alvin Amartya', '2021-02-11 01:19:14', 'A'),
(25, 'Promag', '-', 'Alvin Amartya', '2021-02-11 01:19:19', 'Alvin Amartya', '2021-02-11 01:19:19', 'A'),
(26, 'Vitamin C', '-', 'Alvin Amartya', '2021-02-11 01:19:33', 'Alvin Amartya', '2021-02-11 01:19:33', 'A');

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

--
-- Dumping data for table `biaya_lainnya`
--

INSERT INTO `biaya_lainnya` (`id_biaya_lainnya`, `nama_biaya_lainnya`, `deskripsi_biaya_lainnya`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(15, 'Renovasi Genteng', 'Renovasi Genteng', 'Alvin Amartya', '2021-02-10 19:54:55', 'Alvin Amartya', '2021-02-10 19:54:55', 'A'),
(16, 'Renovasi Lantai', 'Renovasi Lantai', 'Alvin Amartya', '2021-02-10 19:55:06', 'Alvin Amartya', '2021-02-10 19:55:06', 'A'),
(17, 'Biaya pengobatan', 'Biaya pengobatan ketika terjadi sesuatu tak terduga', 'Alvin Amartya', '2021-02-10 22:28:28', 'Alvin Amartya', '2021-02-10 22:28:28', 'A'),
(18, 'Biaya transportasi', 'Biaya ketika dibutuhkan transportasi tertentu', 'Alvin Amartya', '2021-02-10 22:29:18', 'Alvin Amartya', '2021-02-10 22:29:18', 'A'),
(19, 'Biaya konsumsi', 'Biaya ketika dibutuhkan guna konsumsi', 'Alvin Amartya', '2021-02-10 22:29:35', 'Alvin Amartya', '2021-02-10 22:29:35', 'A'),
(20, 'Biaya tak terduga', 'Biaya yang digunakan untuk membayar hal-hal di luar rencana', 'Alvin Amartya', '2021-02-10 22:30:08', 'Alvin Amartya', '2021-02-10 22:30:08', 'A'),
(21, 'Biaya event besar', 'Biaya digunakan untuk acara-acara tahunan', 'Alvin Amartya', '2021-02-10 22:30:45', 'Alvin Amartya', '2021-02-10 22:30:45', 'A'),
(22, 'Biaya event kecil', 'Digunakan untuk acara-acara kecil', 'Alvin Amartya', '2021-02-10 22:31:09', 'Alvin Amartya', '2021-02-10 22:31:09', 'A'),
(23, 'Biaya pajak kebutuhan', 'Digunakan untuk pembiayaan pajak transaksi kebutuhan', 'Alvin Amartya', '2021-02-10 22:31:50', 'Alvin Amartya', '2021-02-10 22:31:50', 'A'),
(24, 'Biaya penginapan', 'Digunakan untuk biaya biaya ketika dibutuhkan penginapan', 'Alvin Amartya', '2021-02-10 22:32:18', 'Alvin Amartya', '2021-02-10 22:32:18', 'A'),
(25, 'Biaya kecelakaan', 'Digunakan untuk membiayai kecelakan yang tidak terduga', 'Alvin Amartya', '2021-02-10 22:33:04', 'Alvin Amartya', '2021-02-10 22:33:04', 'A'),
(26, 'Biaya perawatan', 'Digunakan untuk pembiayaan kebutuhan perawatan', 'Alvin Amartya', '2021-02-10 22:33:25', 'Alvin Amartya', '2021-02-10 22:33:25', 'A'),
(27, 'Biaya penyewaan', 'Biaya yang digunakan untuk menyewa alat-alat yang dibutuhkan', 'Alvin Amartya', '2021-02-10 22:33:48', 'Alvin Amartya', '2021-02-10 22:33:48', 'A'),
(28, 'Biaya keamanan', 'Digunakan untuk biaya keamanan', 'Alvin Amartya', '2021-02-11 01:21:57', 'Alvin Amartya', '2021-02-11 01:21:57', 'A'),
(29, 'Biaya jasa angkut', 'Digunakan untuk jasa angkut barang', 'Alvin Amartya', '2021-02-11 01:23:43', 'Alvin Amartya', '2021-02-11 01:23:43', 'A'),
(30, 'Biaya belasungkawa', 'Digunakan untuk berbelasungkawa', 'Alvin Amartya', '2021-02-11 01:24:21', 'Alvin Amartya', '2021-02-11 01:24:21', 'A'),
(31, 'Biaya perawatan asset', 'Digunakan untuk biaya perawatan asset', 'Alvin Amartya', '2021-02-11 01:25:02', 'Alvin Amartya', '2021-02-11 01:25:02', 'A');

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

--
-- Dumping data for table `cluster_relawan`
--

INSERT INTO `cluster_relawan` (`id_cluster_relawan`, `nama_cluster`, `deskripsi_cluster`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(7, 'Guru', 'Guru', 'Alvin Amartya', '2021-02-10 19:55:27', 'Alvin Amartya', '2021-02-10 19:55:27', 'A'),
(8, 'Medis', 'Medis', 'Alvin Amartya', '2021-02-10 19:56:14', 'Alvin Amartya', '2021-02-10 19:56:14', 'A'),
(10, 'Publikasi Dokumentasi', 'Bagian Publikasi dan Dokumentasi', 'Alvin Amartya', '2021-02-10 22:21:51', 'Alvin Amartya', '2021-02-10 22:21:51', 'A'),
(11, 'Kesehatan', 'Bagian kesehatan seperti perawat, suster, bidan, dan sebagainya', 'Alvin Amartya', '2021-02-10 22:22:20', 'Alvin Amartya', '2021-02-10 22:22:20', 'A'),
(12, 'Social Development', 'Bagian yang membangun pengembangan social', 'Alvin Amartya', '2021-02-10 22:23:22', 'Alvin Amartya', '2021-02-10 22:23:22', 'A'),
(13, 'Logistik', 'Bagian yang menangani bagian logistik', 'Alvin Amartya', '2021-02-10 22:23:55', 'Alvin Amartya', '2021-02-10 22:23:55', 'A'),
(14, 'Humas', 'Bagian yang menangani segala macam hubungan masyarakat', 'Alvin Amartya', '2021-02-10 22:24:22', 'Alvin Amartya', '2021-02-10 22:24:22', 'A'),
(15, 'Human Resource', 'Bagian yang menangani kebutuhan tenaga kerja', 'Alvin Amartya', '2021-02-10 22:24:53', 'Alvin Amartya', '2021-02-10 22:24:53', 'A'),
(16, 'Finnance', 'Bagian penanggung jawab dana', 'Alvin Amartya', '2021-02-10 22:25:30', 'Alvin Amartya', '2021-02-10 22:25:30', 'A'),
(17, 'Transportasi', 'Bagian khusus penanganan segala macam transportasi', 'Alvin Amartya', '2021-02-10 22:26:18', 'Alvin Amartya', '2021-02-10 22:26:18', 'A'),
(18, 'Spesialist Cluster', 'Bagian bagian khusus yang tidak tercantum pada cluster', 'Alvin Amartya', '2021-02-10 22:27:18', 'Alvin Amartya', '2021-02-10 22:27:18', 'A');

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

--
-- Dumping data for table `donatur`
--

INSERT INTO `donatur` (`id_donatur`, `id_user_login`, `nama_donatur`, `email_donatur`, `jenis_kelamin`, `no_telepon`, `creaby`, `credate`, `modiby`, `modidate`, `row_status`) VALUES
(8, 33, 'Ivan', 'ivan@gmail.com', 'L', '081231723123', '-', '2021-02-10 19:58:47', '-', '2021-02-10 19:58:47', 'A'),
(9, 77, 'Bagus galih', 'bagus@gmail.com', 'L', '083430458304', 'ivan', '2021-02-12 01:29:33', '', '2021-02-11 01:31:35', 'A'),
(10, 1, 'sonata', 'sonata@gmail.com', 'P', '083430458337', 'smodra', '2021-02-16 01:31:40', '', '2021-02-11 01:32:19', 'A'),
(11, 78, 'adit', 'adit@gmail.com', 'P', '083430458304', 'sam', '2021-02-11 01:32:22', '', '2021-02-11 01:32:52', 'A'),
(12, 77, 'aisha', 'aisha@gmail.com', 'P', '0834304583333', 'ivan', '2021-02-11 01:32:55', '', '2021-02-11 01:33:29', 'A'),
(13, 76, 'desta', 'desta@gmail.com', 'P', '0834304583333', 'samidra', '2021-02-11 01:33:37', '', '2021-02-11 01:34:02', 'A'),
(14, 1, 'angga', 'angga@gmail.com', 'L', '083430458304', 'samidea', '2021-02-11 01:34:05', '', '2021-02-11 01:34:35', 'A'),
(15, 77, 'chomel', 'chomel@gmail.com', 'P', '083430458304', 'chomel', '2021-02-11 01:34:38', '', '2021-02-11 01:35:54', 'A'),
(16, 78, 'izza', 'izaa@gmail.com', 'P', '083430458304', 'samidra', '2021-02-11 01:35:57', '', '2021-02-11 01:36:21', 'A'),
(17, 76, 'iwang', 'iawang@gmail.com', 'L', '0834304583333', 'samidra', '2021-02-11 01:36:24', '', '2021-02-11 01:36:49', 'A'),
(18, 1, 'lilis', 'lilis@gmail.com', 'L', '083430458304', 'ivan', '2021-02-11 01:37:31', '', '2021-02-11 01:37:59', 'A'),
(19, 77, 'ladia', 'ladia@gmail.com', 'P', '083430458304', 'ivan', '2021-02-11 01:38:22', '', '2021-02-11 01:38:22', 'A'),
(20, 78, 'zidan', 'zidan@gmail.com', 'L', '083430458304', 'iwang', '2021-02-11 01:38:25', '', '2021-02-11 01:38:49', 'A'),
(21, 76, 'luthfan', 'luthfan@gmail.com', 'L', '083430458304', 'ivan', '2021-02-11 01:38:52', '', '2021-02-11 01:39:19', 'A'),
(22, 77, 'fariq', 'fariq@gmail.com', 'L', '0834304583333', 'samo', '2021-02-11 01:39:47', '', '2021-02-11 01:39:47', 'A'),
(23, 78, 'tito', 'tito@gmail.com', 'L', '43045730458304', 'ivan', '2021-02-11 01:40:11', '', '2021-02-11 01:40:11', 'A'),
(24, 1, 'riki', 'riki@gmail.com', 'L', '083430458304', 'ivan', '2021-02-11 01:40:52', '', '2021-02-11 01:40:52', 'A'),
(25, 76, 'rizal', 'rizal@gmail.com', 'L', '0834304583333', 'ivan', '2021-02-11 01:41:15', '', '2021-02-11 01:41:15', 'A'),
(26, 77, 'rizka', 'rizka@gmail.com', 'L', '0834304583333', 'ivan', '2021-02-11 01:41:39', '', '2021-02-11 01:41:39', 'A'),
(27, 78, 'yuhal', 'yuhal@gmail.com', 'L', '43045730458304', 'ivan', '2021-02-11 01:41:42', '', '2021-02-11 01:42:05', 'A');

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

--
-- Dumping data for table `donatur_aksi`
--

INSERT INTO `donatur_aksi` (`id`, `id_donatur`, `id_aksi`, `id_status_aksi`, `donasi`, `bukti_transfer`, `is_valid`, `is_anonum`, `keterangan`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(7, 8, 6, 3, 100000, 'fort_rotterdam.jpg', 'Y', 'Y', 'Test', 'Ivan', '2021-02-10 20:03:34', 'Alvin Amartya', '2021-02-10 20:03:34', 'A'),
(8, 8, 6, 2, 10000, 'jendela_alam.jpg', NULL, 'Y', 'Semoga bermanfaat', 'Ivan', '2021-02-10 22:59:53', 'Ivan', '2021-02-10 22:59:53', 'A');

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

--
-- Dumping data for table `gambar_aksi`
--

INSERT INTO `gambar_aksi` (`id`, `id_aksi`, `gambar`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(8, 6, '202102100801510.jpg', 'teddy', '2021-02-10 20:01:52', 'teddy', '2021-02-10 20:01:52', 'A'),
(9, 6, '2021021008015101.jpg', 'teddy', '2021-02-10 20:01:52', 'teddy', '2021-02-10 20:01:52', 'A');

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
(7, 1, 'Alvin Amartya', 'L', 'Super Admin', '1123156785431236-', '08123456789', 'alvinamartya@gmail.com', 'Bengkulu', '2000-05-02 23:38:47', '', '2021-02-09 23:40:07', '', '2021-02-09 23:40:07', 'A'),
(8, 32, 'Rizki', 'L', 'Admin', '0192831723871823', '09172387123', 'rizki@gmail.com', 'Jakarta', '2000-01-01 00:00:00', 'Alvin Amartya', '2021-02-10 19:57:59', 'Alvin Amartya', '2021-02-10 19:57:59', 'A'),
(9, 56, 'syafi', 'L', 'Admin', '0001230810281024', '08917471471', 'asd@gmail.com', 'Pemalang', '2009-08-01 00:00:00', 'Alvin Amartya', '2021-02-11 01:37:39', 'Alvin Amartya', '2021-02-11 01:37:39', 'A'),
(10, 57, 'Handa', 'L', 'Admin', '0001202900192012', '00912841278', 'asd@gmail.com', 'pemalanga', '1998-06-01 00:00:00', 'Alvin Amartya', '2021-02-11 01:38:08', 'Alvin Amartya', '2021-02-11 01:38:08', 'A'),
(11, 58, 'Ipul', 'L', 'Admin', '0881288412848128', '087166142', 'ipul@gmail.com', 'pemalang', '1999-01-01 00:00:00', 'Alvin Amartya', '2021-02-11 01:38:29', 'Alvin Amartya', '2021-02-11 01:38:29', 'A'),
(12, 59, 'Soleh', 'L', 'Admin', '0012084128421748', '0892746126', 'asdh@gmail.com', 'pemalang', '1989-04-07 00:00:00', 'Alvin Amartya', '2021-02-11 01:39:05', 'Alvin Amartya', '2021-02-11 01:39:05', 'A'),
(13, 60, 'Ari', 'L', 'Admin', '0812084912741824', '08197419724', 'jsadh@gmail.com', 'pemalang', '1998-07-07 00:00:00', 'Alvin Amartya', '2021-02-11 01:39:35', 'Alvin Amartya', '2021-02-11 01:39:35', 'A'),
(14, 61, 'Garep', 'L', 'Admin', '0801287412874812', '08917462724', 'adajh@gmail.com', 'pemalang', '1986-01-01 00:00:00', 'Alvin Amartya', '2021-02-11 01:40:02', 'Alvin Amartya', '2021-02-11 01:40:02', 'A'),
(15, 62, 'Yolanda', 'P', 'Admin', '0919287864128412', '0872641726', 'adas@gmail.com', 'pemalang', '1998-07-18 00:00:00', 'Alvin Amartya', '2021-02-11 01:40:29', 'Alvin Amartya', '2021-02-11 01:40:29', 'A'),
(16, 63, 'Uinta', 'P', 'Admin', '0081272614712467', '0812974214', 'ash@gmail.com', 'pemalang', '1998-07-08 00:00:00', 'Alvin Amartya', '2021-02-11 01:41:03', 'Alvin Amartya', '2021-02-11 01:41:03', 'A'),
(17, 64, 'Lulu', 'P', 'Admin', '0012837124871248', '0891238123', 'jsdhaj@gmail.com', 'pemalang', '1997-02-04 00:00:00', 'Alvin Amartya', '2021-02-11 01:41:24', 'Alvin Amartya', '2021-02-11 01:41:24', 'A'),
(18, 65, 'Yunita', 'P', 'Admin', '2909159129851298', '98294821', 'jsadh@gmail.com', 'pemalang', '1998-07-04 00:00:00', 'Alvin Amartya', '2021-02-11 01:41:45', 'Alvin Amartya', '2021-02-11 01:41:45', 'A'),
(19, 66, 'Julita', 'P', 'Admin', '0910293741827481', '287481724', 'adsj@gmail.com', 'pemalang', '1999-08-08 00:00:00', 'Alvin Amartya', '2021-02-11 01:42:14', 'Alvin Amartya', '2021-02-11 01:42:14', 'A'),
(20, 67, 'Bagon', 'P', 'Admin', '1009401924812412', '00912877217213', 'asd@gmail.com', 'pemalang', '1987-07-08 00:00:00', 'Alvin Amartya', '2021-02-11 01:42:44', 'Alvin Amartya', '2021-02-11 01:42:44', 'A'),
(21, 68, 'Handoko', 'P', 'Admin', '0910293891428912', '091987481273', 'tyagd@gmail.com', 'pemalang', '1984-09-09 00:00:00', 'Alvin Amartya', '2021-02-11 01:43:13', 'Alvin Amartya', '2021-02-11 01:43:13', 'A'),
(22, 69, 'Hindasd', 'P', 'Admin', '0910283874187182', '08918247126', 'asd@gmail.com', 'pemalang', '1998-07-08 00:00:00', 'Alvin Amartya', '2021-02-11 01:43:35', 'Alvin Amartya', '2021-02-11 01:43:35', 'A'),
(23, 70, 'Kalana', 'L', 'Admin', '0981238612846812', '0819287423', 'jkasu@gmail.com', 'pemalang', '1989-06-08 00:00:00', 'Alvin Amartya', '2021-02-11 01:44:16', 'Alvin Amartya', '2021-02-11 01:44:16', 'A'),
(24, 71, 'Dermawan', 'L', 'Admin', '0981823787481724', '0819273641', 'gbaj@gmail.com', 'pemalang', '2009-07-08 00:00:00', 'Alvin Amartya', '2021-02-11 01:44:45', 'Alvin Amartya', '2021-02-11 01:44:45', 'A'),
(25, 72, 'Gigah', 'L', 'Admin', '0819237487128471', '089745646276', 'asd@gmail.com', 'pemalang', '1989-03-08 00:00:00', 'Alvin Amartya', '2021-02-11 01:45:07', 'Alvin Amartya', '2021-02-11 01:45:07', 'A'),
(26, 73, 'Endra', 'L', 'Admin', '0812983746712412', '08962636746', 'ads@gmail.com', 'pemalang', '1989-07-08 00:00:00', 'Alvin Amartya', '2021-02-11 01:45:40', 'Alvin Amartya', '2021-02-11 01:45:40', 'A'),
(27, 74, 'Cerikka', 'P', 'Admin', '0819238841928591', '089572613613', 'adskjd@gmail.com', 'pemalang', '1998-07-08 00:00:00', 'Alvin Amartya', '2021-02-11 01:46:08', 'Alvin Amartya', '2021-02-11 01:46:08', 'A'),
(28, 75, 'Rendi', 'P', 'Admin', '0819287481748172', '089572663723', 'ndnus@gmail.com', 'pemalang', '1999-08-09 00:00:00', 'Alvin Amartya', '2021-02-11 01:46:39', 'Alvin Amartya', '2021-02-11 01:46:39', 'A');

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
  `kt_status` enum('Draft','Menunggu Persetujuan','Disetujui','Ditolak') NOT NULL DEFAULT 'Draft',
  `laporan_pertanggung_jawaban` varchar(100) DEFAULT NULL,
  `creaby` varchar(100) NOT NULL,
  `creadate` datetime NOT NULL DEFAULT current_timestamp(),
  `modiby` varchar(100) NOT NULL,
  `modidate` datetime NOT NULL DEFAULT current_timestamp(),
  `row_status` enum('A','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kebutuhan_tahunan`
--

INSERT INTO `kebutuhan_tahunan` (`id`, `id_relawan`, `id_sekolah`, `tahun`, `total_kebutuhan`, `deskripsi`, `kt_status`, `laporan_pertanggung_jawaban`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(48, 12, 11, '2022', '20000', 'Oke ', 'Disetujui', '20210210080933.xlsx', 'teddy', '2021-02-10 20:02:44', 'teddy', '2021-02-10 20:09:33', 'A'),
(49, 12, 11, '2023', '260000', 'Kebutuhan tahunan', 'Menunggu Persetujuan', NULL, 'teddy', '2021-02-10 20:52:21', 'teddy', '2021-02-10 20:52:21', 'A'),
(50, 12, 11, '2021', '25000', 'asd', 'Menunggu Persetujuan', NULL, 'teddy', '2021-02-10 22:34:05', 'teddy', '2021-02-10 22:34:05', 'A');

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

--
-- Dumping data for table `kt_barang`
--

INSERT INTO `kt_barang` (`id`, `id_kt`, `id_barang`, `jumlah`, `harga_satuan`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(4, 48, 13, 4, 25000, 'teddy', '2021-02-10 20:02:44', 'teddy', '2021-02-10 21:36:42', 'D'),
(5, 49, 13, 5, 50000, 'teddy', '2021-02-10 20:52:21', 'teddy', '2021-02-10 21:57:46', 'A');

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

--
-- Dumping data for table `kt_biaya_lainnya`
--

INSERT INTO `kt_biaya_lainnya` (`id`, `id_kt`, `id_biaya_lainnya`, `biaya`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(8, 48, 16, 20000, 'teddy', '2021-02-10 20:02:44', 'teddy', '2021-02-10 21:57:36', 'A'),
(9, 49, 16, 10000, 'teddy', '2021-02-10 20:52:21', 'teddy', '2021-02-10 21:57:46', 'A'),
(10, 50, 16, 25000, 'teddy', '2021-02-10 22:34:05', 'teddy', '2021-02-10 22:54:37', 'A');

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

--
-- Dumping data for table `relawan`
--

INSERT INTO `relawan` (`id_relawan`, `id_cluster_relawan`, `id_sekolah`, `id_user_login`, `nik`, `nama_relawan`, `jenis_kelamin`, `no_telepon`, `email`, `tempat_lahir`, `tanggal_lahir`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(12, 7, 11, 34, '0912839172371827', 'teddy', 'L', '00192831927381723', 'teddy@gmail.com', 'Pemalang', '2000-01-15 00:00:00', '-', '2021-02-10 19:59:34', 'Alvin Amartya', '2021-02-10 19:59:34', 'A'),
(13, 11, 11, 35, '0092745637463515', 'Andi', 'L', '0895606425777', 'atplotonom@gmail.com', 'Pemalang', '1971-01-01 00:00:00', '-', '2021-02-10 22:53:13', 'Alvin Amartya', '2021-02-10 22:53:13', 'A'),
(14, 7, 14, 36, '10502457080001', 'Roger Morrison', 'L', '08956064231', 'roger@gmail.com', 'Jakarta', '1987-04-02 00:00:00', '-', '2021-02-11 00:46:04', 'Alvin Amartya', '2021-02-11 00:46:04', 'A'),
(15, 7, 15, 37, '12742747472727271', 'Teguh Boentoro', 'L', '019287412764', 'Teguh@gmail.com', 'Jakarta', '1998-02-09 00:00:00', '-', '2021-02-11 00:47:54', 'Alvin Amartya', '2021-02-11 00:47:54', 'A'),
(16, 8, NULL, 38, '0000000000000001', 'Bundo', 'L', '0912039184', 'bundo@gmaiil.com', 'Jakarta', '1989-05-09 00:00:00', '-', '2021-02-11 00:51:55', 'Alvin Amartya', '2021-02-11 00:53:20', 'D'),
(17, 8, 14, 39, '17836573738172647', 'Bandar', 'P', '0912039184', 'bundo1@gmaiil.com', 'Jakarta', '1989-05-09 00:00:00', '-', '2021-02-11 00:51:55', 'Alvin Amartya', '2021-02-11 00:51:55', 'A'),
(18, 8, 19, 40, '00000000009871', 'Rendi', 'L', '0912039184', 'bundo@gmaiil.com', 'Jakarta', '1979-05-09 00:00:00', '-', '2021-02-11 00:51:55', 'Alvin Amartya', '2021-02-11 00:51:55', 'A'),
(19, 10, 15, 41, '0982976552651647', 'Bagas', 'L', '0912039184', 'bundo3@gmaiil.com', 'Jakarta', '1976-05-09 00:00:00', '-', '2021-02-11 00:51:55', 'Alvin Amartya', '2021-02-11 00:51:55', 'A'),
(20, 13, 21, 42, '7872647829849287', 'Candar', 'L', '0912039184', 'ban4@gmaiil.com', 'Jakarta', '1974-05-09 00:00:00', '-', '2021-02-11 00:51:56', 'Alvin Amartya', '2021-02-11 00:51:56', 'A'),
(21, 14, 21, 43, '000000001324761', 'Hanrianti', 'L', '0912039184', 'bundo@gmaiil.com', 'Jakarta', '1989-05-09 00:00:00', '-', '2021-02-11 00:51:56', 'Alvin Amartya', '2021-02-11 00:51:56', 'A'),
(22, 8, 21, 44, '38712761274621411', 'Hanri', 'L', '0912039184', 'bundo@gmaiil.com', 'Jakarta', '1989-05-09 00:00:00', '-', '2021-02-11 00:51:56', 'Alvin Amartya', '2021-02-11 00:51:56', 'A'),
(23, 10, 25, 45, '2637466789543453', 'Bundo', 'L', '0912039184', 'bundo@gmaiil.com', 'Jakarta', '1989-05-09 00:00:00', '-', '2021-02-11 00:51:56', 'Alvin Amartya', '2021-02-11 00:51:56', 'A'),
(24, 13, 24, 46, '000000000000189', 'Haiue', 'L', '0912039184', 'bund41o@gmaiil.com', 'Jakarta', '1989-05-09 00:00:00', '-', '2021-02-11 00:51:56', 'Alvin Amartya', '2021-02-11 00:51:56', 'A'),
(25, 11, 25, 47, '5263746262536462', 'Bambang', 'L', '08947626637172', 'aba@gmail.com', 'Jakarta', '1999-02-08 00:00:00', '-', '2021-02-11 01:02:13', 'Alvin Amartya', '2021-02-11 01:02:13', 'A'),
(26, 13, 16, 48, '1231412412612761', 'Linli', 'L', '084827847274', 'lin@gmail.com', 'Jakarta', '1998-02-08 00:00:00', '-', '2021-02-11 01:02:50', 'Alvin Amartya', '2021-02-11 01:02:50', 'A'),
(27, 14, 29, 49, '1293164172412481', 'Mandai', 'P', '08947612535', 'man@gmail.com', 'Jakarta', '1987-09-01 00:00:00', '-', '2021-02-11 01:03:24', 'Alvin Amartya', '2021-02-11 01:03:24', 'A'),
(28, 11, 20, 50, '0091238127412948', 'Renata', 'P', '098841651267', 'g@gmail.com', 'Jakarta', '1988-02-09 00:00:00', '-', '2021-02-11 01:04:12', 'Alvin Amartya', '2021-02-11 01:04:12', 'A'),
(29, 10, 29, 51, '0001241129897512', 'Untara', 'P', '08912864124', 'un@gmail.com', 'Jakarta', '2009-08-09 00:00:00', '-', '2021-02-11 01:04:48', 'Alvin Amartya', '2021-02-11 01:04:48', 'A'),
(30, 13, 27, 52, '0001923876417241', 'Wenda', 'L', '0887127848288', 'wen@gmail.com', 'Jakarta', '1987-06-18 00:00:00', '-', '2021-02-11 01:05:28', 'Alvin Amartya', '2021-02-11 01:05:28', 'A'),
(31, 14, NULL, 53, '0001238174162741', 'Kalama', 'P', '08192776124', 'asd@gmail.com', 'Jakarta', '1997-08-09 00:00:00', '-', '2021-02-11 01:06:39', '-', '2021-02-11 01:06:39', 'A'),
(32, 14, NULL, 54, '0001238172471249', 'Umina', 'P', '0891626612412', 'hasd@gmail.com', 'Jakarta', '1998-12-09 00:00:00', '-', '2021-02-11 01:07:25', '-', '2021-02-11 01:07:25', 'A'),
(33, 12, NULL, 55, '0001288471724712', 'Yuni', 'P', '089625254623', 'basdg@gmail.com', 'Jakarta', '1989-07-08 00:00:00', '-', '2021-02-11 01:08:03', '-', '2021-02-11 01:08:03', 'A');

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

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `jenis_sekolah`, `alamat`, `provinsi`, `kota`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(11, 'SDN 1 Babadan', 'Rumah Singgah', 'Babadan', 'Jawa Timur', 'Kabupaten Ponorogo', 'Alvin Amartya', '2021-02-10 19:56:37', 'Alvin Amartya', '2021-02-10 19:56:37', 'A'),
(12, 'SDN 1 Trisono', 'Rumah Singgah', 'Trisono', 'Di Yogyakarta', 'Kabupaten Bantul', 'Alvin Amartya', '2021-02-10 19:57:04', 'Alvin Amartya', '2021-02-10 19:57:04', 'A'),
(13, 'SMP 1 Comal', 'Sekolah Pedalaman', 'Mbalamoa', 'Jawa Tengah', 'Kabupaten Rembang', 'Alvin Amartya', '2021-02-10 22:38:19', 'Alvin Amartya', '2021-02-10 22:38:19', 'A'),
(14, 'SDLB NEGERI BAMBI', 'Sekolah Pedalaman', 'Kec. Peukan Baro', 'Aceh', 'Kabupaten Simeulue', 'Alvin Amartya', '2021-02-10 23:54:34', 'Alvin Amartya', '2021-02-10 23:54:34', 'A'),
(15, 'SD Janik Gorontalo', 'Sekolah Pedalaman', 'Kec. Rote', 'Jawa Barat', 'Kabupaten Purwakarta', 'Alvin Amartya', '2021-02-10 23:59:09', 'Alvin Amartya', '2021-02-10 23:59:09', 'A'),
(16, 'Rumah Kita Bersama Jambi', 'Rumah Singgah', 'Kec. Hega', 'Jawa Tengah', 'Kabupaten Sragen', 'Alvin Amartya', '2021-02-11 00:00:01', 'Alvin Amartya', '2021-02-11 00:00:01', 'A'),
(17, 'Rumah Oky Jakut', 'Rumah Singgah', 'Kampung Kerang', 'Dki Jakarta', 'Kota Jakarta Utara', 'Alvin Amartya', '2021-02-11 00:00:51', 'Alvin Amartya', '2021-02-11 00:00:51', 'A'),
(18, 'Rumah Oky Banten', 'Rumah Singgah', 'Kec. Lunja', 'Jawa Timur', 'Kabupaten Bondowoso', 'Alvin Amartya', '2021-02-11 00:01:24', 'Alvin Amartya', '2021-02-11 00:01:24', 'A'),
(19, 'SD 01 Monogiri', 'Sekolah Pedalaman', 'Kec. Monogiri', 'Jawa Timur', 'Kabupaten Probolinggo', 'Alvin Amartya', '2021-02-11 00:01:58', 'Alvin Amartya', '2021-02-11 00:01:58', 'A'),
(20, 'SD 03 Lembang', 'Sekolah Pedalaman', 'Kec. Lembang', 'Nusa Tenggara Timur', 'Kabupaten Ende', 'Alvin Amartya', '2021-02-11 00:02:22', 'Alvin Amartya', '2021-02-11 00:02:22', 'A'),
(21, 'Rumah Bersama Indah Maumere', 'Rumah Singgah', 'Kec. Maumere', 'Nusa Tenggara Barat', 'Kabupaten Lombok Tengah', 'Alvin Amartya', '2021-02-11 00:02:56', 'Alvin Amartya', '2021-02-11 00:02:56', 'A'),
(22, 'SD 01 Giliageng', 'Sekolah Pedalaman', 'Kec. Sekaleng', 'Lampung', 'Kabupaten Lampung Tengah', 'Alvin Amartya', '2021-02-11 00:03:39', 'Alvin Amartya', '2021-02-11 00:03:39', 'A'),
(23, 'Rumah Indah Bersama Kiliaging', 'Rumah Singgah', 'Kec. Bulu', 'Jawa Timur', 'Kabupaten Kediri', 'Alvin Amartya', '2021-02-11 00:04:26', 'Alvin Amartya', '2021-02-11 00:04:26', 'A'),
(24, 'SD 05 Tulungagung', 'Sekolah Pedalaman', 'Kec. Tulung', 'Kepulauan Riau', 'Kabupaten Bintan', 'Alvin Amartya', '2021-02-11 00:04:59', 'Alvin Amartya', '2021-02-11 00:04:59', 'A'),
(25, 'SD Pedalaman Helanik', 'Sekolah Pedalaman', 'Kec. Helanik', 'Kepulauan Riau', 'Kabupaten Lingga', 'Alvin Amartya', '2021-02-11 00:05:41', 'Alvin Amartya', '2021-02-11 00:05:41', 'A'),
(26, 'Rumah Paman Dony', 'Rumah Singgah', 'Kec. Tambun', 'Jawa Barat', 'Kabupaten Bekasi', 'Alvin Amartya', '2021-02-11 00:06:56', 'Alvin Amartya', '2021-02-11 00:06:56', 'A'),
(27, 'Rumah Ivan Bersama', 'Rumah Singgah', 'Kec. Ulujami', 'Jawa Tengah', 'Kabupaten Pemalang', 'Alvin Amartya', '2021-02-11 00:07:32', 'Alvin Amartya', '2021-02-11 00:07:32', 'A'),
(28, 'Sekolah Bersama Pak Heri', 'Sekolah Pedalaman', 'Kec. Gili', 'Bengkulu', 'Kabupaten Rejang Lebong', 'Alvin Amartya', '2021-02-11 00:08:21', 'Alvin Amartya', '2021-02-11 00:08:21', 'A'),
(29, 'Rumah Bunga Indah', 'Rumah Singgah', 'Kec. Bandar', 'Jawa Timur', 'Kabupaten Situbondo', 'Alvin Amartya', '2021-02-11 00:09:04', 'Alvin Amartya', '2021-02-11 00:09:04', 'A'),
(30, 'Rumah Bagus Jakarta', 'Rumah Singgah', 'Kec. Pademangan', 'Dki Jakarta', 'Kota Jakarta Barat', 'Alvin Amartya', '2021-02-11 00:09:51', 'Alvin Amartya', '2021-02-11 00:09:51', 'A'),
(31, 'Rumah Tandang Raya', 'Rumah Singgah', 'Kec. Bagalak', 'Maluku', 'Kabupaten Seram Bagian Timur', 'Alvin Amartya', '2021-02-11 00:10:24', 'Alvin Amartya', '2021-02-11 00:10:24', 'A'),
(32, 'SD N 01 Katana', 'Sekolah Pedalaman', 'Kec. Gandar', 'Banten', 'Kabupaten Serang', 'Alvin Amartya', '2021-02-11 00:11:01', 'Alvin Amartya', '2021-02-11 00:11:01', 'A');

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

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_sekolah`, `nama_siswa`, `nisn`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `creaby`, `creadate`, `modiby`, `modidate`, `row_status`) VALUES
(1, 14, 'Andi', '', 'Jakarta', '2000-12-01 00:00:00', 'L', 'A', '2021-02-11 00:24:45', '', '2021-02-11 00:24:45', 'A'),
(2, 15, 'Aji', '', 'Banten', '2005-08-01 00:00:00', 'L', 'A', '2021-02-11 00:25:22', '', '2021-02-11 00:25:22', 'A'),
(3, 16, 'Ani', '', 'Cirebon', '2008-02-19 00:00:00', 'L', 'A', '2021-02-11 00:25:40', '', '2021-02-11 00:25:40', 'A'),
(4, 19, 'Anggi', '', 'Jakarta', '2007-04-18 00:00:00', 'L', 'A', '2021-02-11 00:26:03', '', '2021-02-11 00:26:03', 'A'),
(5, 21, 'Alin', '', 'Bandung', '2004-06-17 00:00:00', 'L', 'A', '2021-02-11 00:26:38', '', '2021-02-11 00:26:38', 'A'),
(6, 24, 'Budi', '', 'Jambi', '2008-08-17 00:00:00', 'P', 'A', '2021-02-11 00:27:03', '', '2021-02-11 00:27:03', 'A'),
(7, 27, 'Beni', '', 'Palembang', '2009-08-27 00:00:00', 'P', 'A', '2021-02-11 00:28:10', '', '2021-02-11 00:28:10', 'A'),
(8, 29, 'Billy', '', 'Ternate', '2009-08-18 00:00:00', 'P', 'A', '2021-02-11 00:28:48', '', '2021-02-11 00:28:48', 'A'),
(9, 29, 'Beki', '', 'Ulujami', '2008-08-09 00:00:00', 'L', 'A', '2021-02-11 00:30:35', '', '2021-02-11 00:30:35', 'A'),
(10, 25, 'Cani', '', 'Jakarta', '2009-06-09 00:00:00', 'P', 'A', '2021-02-11 00:30:58', '', '2021-02-11 00:30:58', 'A'),
(11, 15, 'Ivan Firmansyah', '', 'Pemalang', '2000-06-02 00:00:00', 'L', 'A', '2021-02-11 00:32:05', '', '2021-02-11 00:32:05', 'A'),
(12, 25, 'Aditya Prayoga', '', 'Palembang', '2008-06-28 00:00:00', 'L', 'A', '2021-02-11 00:32:30', '', '2021-02-11 00:32:30', 'A'),
(13, 24, 'Syamsul', '', 'Tambun', '1999-01-01 00:00:00', 'L', 'A', '2021-02-11 00:32:49', '', '2021-02-11 00:32:49', 'A'),
(14, 12, 'Hendri', '', 'Jakarta', '2008-02-04 00:00:00', 'L', 'A', '2021-02-11 00:33:10', '', '2021-02-11 00:33:10', 'A'),
(15, 18, 'Gendis', '', 'Riau', '2009-10-31 00:00:00', 'L', 'A', '2021-02-11 00:33:58', '', '2021-02-11 00:33:58', 'A'),
(16, 24, 'Gondam', '', 'Gorontalo', '2010-08-07 00:00:00', 'L', 'A', '2021-02-11 00:34:28', '', '2021-02-11 00:34:28', 'A'),
(17, 15, 'Chorida Ulya', '', 'Jakarta', '2000-08-19 00:00:00', 'P', 'A', '2021-02-11 00:34:57', '', '2021-02-11 00:34:57', 'A'),
(18, 15, 'Firda Riska Pratiwi', '', 'Bekasi', '2001-01-19 00:00:00', 'P', 'A', '2021-02-11 00:35:26', '', '2021-02-11 00:35:26', 'A'),
(19, 15, 'Salsabila Khroinsin', '', 'Jakarta', '2000-09-17 00:00:00', 'P', 'A', '2021-02-11 00:35:50', '', '2021-02-11 00:35:50', 'A'),
(20, 15, 'Habibah Shiba Zahidah', '', 'Tuban', '2000-07-19 00:00:00', 'P', 'A', '2021-02-11 00:36:25', '', '2021-02-11 00:36:25', 'A'),
(21, 15, 'Alfadli Raihan Tsani', '', 'Jakarta', '2001-02-19 00:00:00', 'L', 'A', '2021-02-11 00:36:55', '', '2021-02-11 00:36:55', 'A'),
(22, 15, 'Albertus Aristyanto', '', 'Bekasi', '2000-09-09 00:00:00', 'L', 'A', '2021-02-11 00:37:18', '', '2021-02-11 00:37:18', 'A'),
(23, 15, 'Fikri Adriyansyah', '', 'Sukabumi', '2000-04-28 00:00:00', 'L', 'A', '2021-02-11 00:37:47', '', '2021-02-11 00:37:47', 'A'),
(24, 15, 'Dio Putra Anugerah', '', 'Bekasi', '2000-02-08 00:00:00', 'L', 'A', '2021-02-11 00:38:30', '', '2021-02-11 00:38:30', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `status_aksi`
--

CREATE TABLE `status_aksi` (
  `id_status_aksi` int(11) NOT NULL,
  `nama_status_aksi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_aksi`
--

INSERT INTO `status_aksi` (`id_status_aksi`, `nama_status_aksi`) VALUES
(1, 'Menunggu Pembayaran'),
(2, 'Sedang Diproses'),
(3, 'Terkonfirmasi'),
(4, 'Ditolak');

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
(1, 'sa', '$2y$10$yp1I2KBPVa1TNCq3JTZxheZgQ94GaKtdftJ8047niyjV22br4JSWG', 'Karyawan', 'Alvin Amartya', '2021-01-21 10:39:34', 'Alvin Amartya', '2021-01-21 10:39:34', 'A'),
(32, 'rizki', '$2y$10$CbtUV//p/EOoo.3BZ/6c8.zL8fpMCATQEyik7P4hu6XVxaLYHQpIe', 'Karyawan', 'Alvin Amartya', '2021-02-10 19:57:59', 'Alvin Amartya', '2021-02-10 19:57:59', 'A'),
(33, 'ivan', '$2y$10$L.IeCrLiIlAWet1N9UhYvORmBNYgwEwXgBIagjTs8CHiEatdR.KMW', 'Donatur', '-', '2021-02-10 19:58:47', '-', '2021-02-10 19:58:47', 'A'),
(34, 'teddy', '$2y$10$ZjcqRJ1djIo4QVJClG/YTufCAhMBszKFYy/UgQs1FUwjMZ8N8.M1i', 'Relawan', '-', '2021-02-10 19:59:34', '-', '2021-02-10 19:59:34', 'A'),
(35, 'relawan', '$2y$10$ti99EgcJd8Xy2sodrTekPecpaZMAT1Jrky5Py9dU3CfNgNC3lD.wO', 'Relawan', '-', '2021-02-10 22:53:13', '-', '2021-02-10 22:53:13', 'A'),
(36, 'Roger', '$2y$10$6Ohhp8lMiGBjKCM100FZke2KL/FmEp4pkdcToMuobuhr3llTnjuNa', 'Relawan', '-', '2021-02-11 00:46:04', '-', '2021-02-11 00:46:04', 'A'),
(37, 'Teguh', '$2y$10$tzPrBx2i3jJK97JiZCNLT.wAaJxMI/Ivt/1HWnTJQsskGZn.HwVse', 'Relawan', '-', '2021-02-11 00:47:54', '-', '2021-02-11 00:47:54', 'A'),
(38, 'Bundo', '$2y$10$Kag5ULjwO4A/zENa3aVRUet6kRw8Xs4GiCS0buP1U5diP./jAIeB.', 'Relawan', '-', '2021-02-11 00:51:55', 'Alvin Amartya', '2021-02-11 00:53:20', 'D'),
(39, 'Bundo', '$2y$10$P3JVdr4mre0CONu0sIRyO.g/VizNm9BMw0JjdwKLXEHLFZk6/Q176', 'Relawan', '-', '2021-02-11 00:51:55', '-', '2021-02-11 00:51:55', 'A'),
(40, 'Bundo', '$2y$10$mXdqpUnntZ.p6q6XJ1chguUTz3NvCAo/HEbVyVn4cvk8zXiJDsGzO', 'Relawan', '-', '2021-02-11 00:51:55', '-', '2021-02-11 00:51:55', 'A'),
(41, 'Bundo', '$2y$10$dP3fE62rtfyjns2o71TRzenZLTGk1vlKcoHObteBHe0W3BrJ5MOfa', 'Relawan', '-', '2021-02-11 00:51:55', '-', '2021-02-11 00:51:55', 'A'),
(42, 'Bundo', '$2y$10$gUbO827tNNtLufDWzEU6UexHw2aVI16qh4yImfBfdPkGbEmu5I7Eu', 'Relawan', '-', '2021-02-11 00:51:56', '-', '2021-02-11 00:51:56', 'A'),
(43, 'Bundo', '$2y$10$05R9QvDCGEQVVvYsQJGpg.bC4ESE.xVMXaTaUiBZ7owlDI9QEncGu', 'Relawan', '-', '2021-02-11 00:51:56', '-', '2021-02-11 00:51:56', 'A'),
(44, 'Bundo', '$2y$10$5jqAaSjtFpj1dMBMe/wkYessViKaV3gZ.pWNASCOLyIWf0Iq5Poza', 'Relawan', '-', '2021-02-11 00:51:56', '-', '2021-02-11 00:51:56', 'A'),
(45, 'Bundo', '$2y$10$JiBAQyNJgK.xK8PPYvnHJeRN4AumdltkprYywXhYwCebvcKrP18ua', 'Relawan', '-', '2021-02-11 00:51:56', '-', '2021-02-11 00:51:56', 'A'),
(46, 'Bundo', '$2y$10$Rltr/lSJGj34Qudpw0MCYOSC8muh4qW3zDxYduEKCCSr/LNsaRxNy', 'Relawan', '-', '2021-02-11 00:51:56', '-', '2021-02-11 00:51:56', 'A'),
(47, 'bambang', '$2y$10$wtXsGu9pfVjIuDOn0gQAaeSuHORsOYJigU8Cu.0yefhSPFbmsu7se', 'Relawan', '-', '2021-02-11 01:02:13', '-', '2021-02-11 01:02:13', 'A'),
(48, 'lin', '$2y$10$so8.A5QrkmEjgSjSH/kdruXbqF1Yq9mexIWwbrQx114zGxTjYMysm', 'Relawan', '-', '2021-02-11 01:02:50', '-', '2021-02-11 01:02:50', 'A'),
(49, 'man', '$2y$10$WI3YJhs6CDPFx7Zm7zhOhOKOTeTKHNDpkrEvq6AigQF/6LCwJQE9u', 'Relawan', '-', '2021-02-11 01:03:24', '-', '2021-02-11 01:03:24', 'A'),
(50, 'ren', '$2y$10$5QPPqy1nrdwkpiKWogJ./emVRkPwGJ4JP2yaVVq/rbq1StaqchBwK', 'Relawan', '-', '2021-02-11 01:04:12', '-', '2021-02-11 01:04:12', 'A'),
(51, 'un', '$2y$10$UMT5Btpa3mzTxMXeHRpdl.7r/g3hx8yB.Sr03h90uCmAwFxIa.kvS', 'Relawan', '-', '2021-02-11 01:04:48', '-', '2021-02-11 01:04:48', 'A'),
(52, 'wen', '$2y$10$ARxcXi3ZQbtaJ514kotspev61TG7yYJqn1WrYXcPsHN6DlJ41Vrpm', 'Relawan', '-', '2021-02-11 01:05:28', '-', '2021-02-11 01:05:28', 'A'),
(53, 'kal', '$2y$10$BjieGxLBvo67XsQCm3r9j.xHYsvtayuxyZ6UBkShNFQwhS3L1pLx.', 'Relawan', '-', '2021-02-11 01:06:39', '-', '2021-02-11 01:06:39', 'A'),
(54, 'um', '$2y$10$Wo3Vi2r2CRzJZ04R8oEUkOGEyMMoIKTYMnYi1jA0d8EeiXcWI1iLm', 'Relawan', '-', '2021-02-11 01:07:25', '-', '2021-02-11 01:07:25', 'A'),
(55, 'ma', '$2y$10$fvlmgUHHyOE4mnwNGtZ.1OA32wR8Nrudbxk45SMZArxZI/bnqDvaW', 'Relawan', '-', '2021-02-11 01:08:03', '-', '2021-02-11 01:08:03', 'A'),
(56, 'Pem', '$2y$10$fTMDdHLBGT1CdGaVbeZiwep6Ixci5QoA5fxbyODDjaZQfn8LWw/S2', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:37:39', 'Alvin Amartya', '2021-02-11 01:37:39', 'A'),
(57, 'asfasf', '$2y$10$H44V9xUtDnLrro.rc7QqJuljQK16X/Ne9zvZB3sxjagYl.3anyDFi', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:38:08', 'Alvin Amartya', '2021-02-11 01:38:08', 'A'),
(58, 'ipul', '$2y$10$RbJvUMg9IKZW7FjaASb0ReExIAycQ/Ouk24zEbdEUrH5DswlpmqPy', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:38:29', 'Alvin Amartya', '2021-02-11 01:38:29', 'A'),
(59, 'adsh', '$2y$10$9Eb/kr6R7RNDR20mvlOgs.IcT1Hse6UihDbZm16CpI/MnJSEr2VPS', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:39:05', 'Alvin Amartya', '2021-02-11 01:39:05', 'A'),
(60, 'asdasda', '$2y$10$hoOk9nkEqGCUbEJUghP9duCof9oUNu4a6xg.NAEbTNqxNOEUe.QXK', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:39:35', 'Alvin Amartya', '2021-02-11 01:39:35', 'A'),
(61, 'adshj', '$2y$10$Pxz2EkzvBVbsQSZxUeRtzuDNo33E1yhn/wpE3d72vmAAoCoXkFiOe', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:40:02', 'Alvin Amartya', '2021-02-11 01:40:02', 'A'),
(62, 'oaoda', '$2y$10$Kvf02LFOkjRuVCtYVSr0AenW6/QjMam7lAJ95QJDScxzRyy7WXA76', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:40:29', 'Alvin Amartya', '2021-02-11 01:40:29', 'A'),
(63, 'plklkad', '$2y$10$Phmd1vH/j.6XcyLkiXn70.BDAKHZCg39zWg5N2s0crO2bEx0BCEEG', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:41:03', 'Alvin Amartya', '2021-02-11 01:41:03', 'A'),
(64, 'asdk', '$2y$10$wbFR0xAfXZ5Ruxx/b86XJOfhzOs2m09oEpWwz96TzKB1gS8EJWS06', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:41:24', 'Alvin Amartya', '2021-02-11 01:41:24', 'A'),
(65, 'ijadsi', '$2y$10$z1wQb7EEsB.xuh75ri12fOqfLRyTuCKIBcvkISDw3wEbXII81Ltxm', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:41:45', 'Alvin Amartya', '2021-02-11 01:41:45', 'A'),
(66, 'kjkje', '$2y$10$5SVakrI4fPZe4tUsyP3GoOFwqTOsofDZg5LIZmKlCe15NPuQbxPWm', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:42:14', 'Alvin Amartya', '2021-02-11 01:42:14', 'A'),
(67, 'asdj', '$2y$10$gQQ0hqlBpQ3ji9e3CfV9UO6XLjx7k8h4MBaXGBFznY3XegjXzRQx.', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:42:44', 'Alvin Amartya', '2021-02-11 01:42:44', 'A'),
(68, 'cmlasdk', '$2y$10$zrG2E9RRdDAikhrVvKD1V.D95LcoT11v/HVEj7fMq7zyftAkbaCtq', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:43:13', 'Alvin Amartya', '2021-02-11 01:43:13', 'A'),
(69, 'kasdjaksdj', '$2y$10$VUzTQORiEM6zNl6LloDXT.RIH6bNon7w7CU.iBGbK07qWDTmSJ1Fy', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:43:35', 'Alvin Amartya', '2021-02-11 01:43:35', 'A'),
(70, 'kjake', '$2y$10$X2yOW6ck10GWuhlG5fhTG.AGubDI/nmg3Prb7uJZmZ84.YX.C7Bbe', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:44:16', 'Alvin Amartya', '2021-02-11 01:44:16', 'A'),
(71, 'kjekj', '$2y$10$IUGIYxYBiSbjWdt8JTrcOuJnuX4JO0Pp03yQ7Xef0ObSexOzXsTVK', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:44:45', 'Alvin Amartya', '2021-02-11 01:44:45', 'A'),
(72, 'aodsas', '$2y$10$/xy1l.hsGaAr9I5awiTTbeyf8eWpMWIJXyS5osujA0Dv5StL8831a', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:45:07', 'Alvin Amartya', '2021-02-11 01:45:07', 'A'),
(73, 'pemasd', '$2y$10$dDFBaSHVfG0rOYqEasPrnODlk7ipK3fcgtIMjR0jzIZavnO1Bwmgi', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:45:40', 'Alvin Amartya', '2021-02-11 01:45:40', 'A'),
(74, 'klmadsj', '$2y$10$RQHwWoRLBzYEhTxvP28Mu.dq2AdBBWOMvnZMMPxsXX9CcB0oWXZoy', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:46:08', 'Alvin Amartya', '2021-02-11 01:46:08', 'A'),
(75, 'mmenlw', '$2y$10$Ji1KhLMuQEESgvRXz1Ytfu9HY15UeLwT8znurf3aw4vZq.IjrJ7dC', 'Karyawan', 'Alvin Amartya', '2021-02-11 01:46:39', 'Alvin Amartya', '2021-02-11 01:46:39', 'A'),
(76, 'adit', 'polman', 'Donatur', 'ivan', '2021-02-11 01:52:35', '', '2021-02-11 01:52:35', 'A'),
(77, 'aisha', 'polman', 'Donatur', 'ivan', '2021-02-11 01:52:57', '', '2021-02-11 01:52:57', 'A'),
(78, 'desta', 'polman', 'Donatur', 'ivan', '2021-02-11 01:53:19', '', '2021-02-11 01:53:19', 'A'),
(79, 'choml', 'polman', 'Donatur', 'ivan', '2021-02-11 01:53:58', '', '2021-02-11 01:53:58', 'A');

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
  MODIFY `id_aksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `aksi_barang`
--
ALTER TABLE `aksi_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aksi_biaya_lainnya`
--
ALTER TABLE `aksi_biaya_lainnya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `biaya_lainnya`
--
ALTER TABLE `biaya_lainnya`
  MODIFY `id_biaya_lainnya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cluster_relawan`
--
ALTER TABLE `cluster_relawan`
  MODIFY `id_cluster_relawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `donatur`
--
ALTER TABLE `donatur`
  MODIFY `id_donatur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `donatur_aksi`
--
ALTER TABLE `donatur_aksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gambar_aksi`
--
ALTER TABLE `gambar_aksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kebutuhan_tahunan`
--
ALTER TABLE `kebutuhan_tahunan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `kt_barang`
--
ALTER TABLE `kt_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kt_biaya_lainnya`
--
ALTER TABLE `kt_biaya_lainnya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `relawan`
--
ALTER TABLE `relawan`
  MODIFY `id_relawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `status_aksi`
--
ALTER TABLE `status_aksi`
  MODIFY `id_status_aksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

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
