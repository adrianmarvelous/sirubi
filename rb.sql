-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2025 at 12:58 PM
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
-- Database: `rb`
--

-- --------------------------------------------------------

--
-- Table structure for table `rb_booking`
--

CREATE TABLE `rb_booking` (
  `id_booking` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `upload_surat_permohonan` varchar(255) NOT NULL,
  `upload_proposal_rundown` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `id_posisi_berkas` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rb_booking`
--

INSERT INTO `rb_booking` (`id_booking`, `id_user`, `name`, `instansi`, `telp`, `alamat`, `nama_kegiatan`, `upload_surat_permohonan`, `upload_proposal_rundown`, `created_at`, `id_posisi_berkas`) VALUES
(10, 8, 'Adrian Marvel Ugrasena', 'bkpsdm', '081216435394', 'Ngagel Mulyo', 'reuni', 'controller/../resources/upload/surat/1753550016_surat_permohonan_.pdf', 'controller/../resources/upload/surat/1753550016_proposal_.pdf', '2025-07-26 19:26:36', 2),
(11, 8, 'Adrian Marvel Ugrasena', 'bkpsdm', '081216435394', 'Ngagel Mulyo', 'reuni', 'controller/../resources/upload/surat/1753551226_surat_permohonan_.pdf', 'controller/../resources/upload/surat/1753551226_proposal_.pdf', '2025-07-26 19:33:49', 2),
(12, 8, 'adrian', 'bakes', '09123', 'jalan', 'testing', 'controller/../resources/upload/surat/1753593897_surat_permohonan_.pdf', 'controller/../resources/upload/surat/1753593897_proposal_.pdf', '2025-07-27 07:25:14', 2),
(13, 8, 'Adrian Marvel Ugrasena', 'bkpsdm', '081216435394', 'Ngagel Mulyo', 'testing', 'controller/../resources/upload/surat/1753594910_surat_permohonan_.pdf', 'controller/../resources/upload/surat/1753594910_proposal_.pdf', '2025-07-27 07:41:54', 3),
(14, 8, 'Adrian Marvel Ugrasena', 'bkpsdm', '081216435394', 'Ngagel Mulyo', 'testinggggggggg', 'controller/../resources/upload/surat/1753595324_surat_permohonan_.pdf', 'controller/../resources/upload/surat/1753595324_proposal_.pdf', '2025-07-27 07:49:03', 3),
(15, 8, 'tes', 'bkpsdm', '081216435394', 'GRAHA KEBONSARI LVK VII', 'reuni', 'controller/../resources/upload/surat/1753599629_surat_permohonan_.pdf', 'controller/../resources/upload/surat/1753599629_proposal_.pdf', '2025-07-27 09:00:40', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rb_menu`
--

CREATE TABLE `rb_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rb_menu`
--

INSERT INTO `rb_menu` (`id_menu`, `menu`, `slug`, `icon`) VALUES
(1, 'Peminjaman RuBi', '?pages=calendar_booking', 'calendar'),
(2, 'Daftar Permohonan', '?pages=list_booking', 'list-ul'),
(3, 'Users', '?pages=users', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `rb_posisi_berkas`
--

CREATE TABLE `rb_posisi_berkas` (
  `id_posisi_berkas` int(100) NOT NULL,
  `posisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rb_posisi_berkas`
--

INSERT INTO `rb_posisi_berkas` (`id_posisi_berkas`, `posisi`) VALUES
(2, 'Admin'),
(3, 'Ketua Tim Kerja (PIC)'),
(4, 'Sekretaris Badan'),
(5, 'Kepala Badan');

-- --------------------------------------------------------

--
-- Table structure for table `rb_role`
--

CREATE TABLE `rb_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rb_role`
--

INSERT INTO `rb_role` (`id_role`, `role`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'katim'),
(4, 'sekban'),
(5, 'kaban');

-- --------------------------------------------------------

--
-- Table structure for table `rb_role_to_menu`
--

CREATE TABLE `rb_role_to_menu` (
  `id_role_to_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rb_role_to_menu`
--

INSERT INTO `rb_role_to_menu` (`id_role_to_menu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rb_tanggal_booking`
--

CREATE TABLE `rb_tanggal_booking` (
  `id_tanggal_booking` int(100) NOT NULL,
  `id_booking` int(100) NOT NULL,
  `tanggal` date NOT NULL,
  `pukul_mulai` time NOT NULL,
  `pukul_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rb_tanggal_booking`
--

INSERT INTO `rb_tanggal_booking` (`id_tanggal_booking`, `id_booking`, `tanggal`, `pukul_mulai`, `pukul_selesai`) VALUES
(1, 10, '2025-07-02', '01:05:00', '02:05:00'),
(2, 11, '2025-07-02', '01:05:00', '02:05:00'),
(3, 11, '2025-07-03', '01:33:00', '02:33:00'),
(4, 12, '2025-07-10', '12:24:00', '13:24:00'),
(5, 13, '2025-07-10', '14:41:00', '16:41:00'),
(6, 14, '2025-07-16', '16:48:00', '20:48:00'),
(7, 15, '2025-07-04', '18:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rb_users`
--

CREATE TABLE `rb_users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rb_users`
--

INSERT INTO `rb_users` (`id_user`, `name`, `email`, `password`, `google_id`, `picture`, `role_id`, `instansi`, `telp`, `alamat`, `created_at`) VALUES
(3, 'Adrian Marvel', 'adrianmarvelugr@gmail.com', NULL, '105247084287404211837', 'https://lh3.googleusercontent.com/a/ACg8ocL9QdP_KssyoIQEgB7EBUn8yid717Z7edUmq0Kze7GYWEZDqA=s96-c', 1, NULL, NULL, NULL, '2025-07-06 19:56:12'),
(4, 'ADRIAN MARVEL', 'adrian.marvel@mhs.fasilkom.narotama.ac.id', NULL, '108536543563784047466', 'https://lh3.googleusercontent.com/a/ACg8ocJI7r_e8bTAlr8m9DibZjL51JGVyXcEk8Ncvl587oYIuQvgWQ=s96-c', 1, NULL, NULL, NULL, '2025-07-07 07:55:55'),
(5, 'tantannn', 'thaniajayanti88@gmail.com', NULL, '111666683396307276513', 'https://lh3.googleusercontent.com/a/ACg8ocL7P54RohGvscpIE-rp4A_bbkJnth-mAKdLkAWY-_-VQJFlfJxO=s96-c', 1, NULL, NULL, NULL, '2025-07-07 08:13:53'),
(6, 'Danang Arif', 'danangarif12@gmail.com', NULL, '114466840152322924740', 'https://lh3.googleusercontent.com/a/ACg8ocKSimfN144GPDGozFVA61nwMkxNq2XubmI2Q9CV2cwXmW5YksxD=s96-c', 1, NULL, NULL, NULL, '2025-07-18 10:07:39'),
(8, 'sugeng', 'sugengrudiyanto0@gmail.com', '$2y$10$RYtOPjXIdF9qwF2rbsmyF.SKBhiGo2bbv1zYvas2yp9Cu2cjm2LUi', NULL, NULL, 4, 'bkpsdm', '081216435394', 'GRAHA KEBONSARI LVK VII', '2025-07-27 09:15:33'),
(9, 'Adrian Marvel Ugrasena', 'nancymartha89@gmail.com', '$2y$10$p1o63wEeDPwxBEUl.eas9uVM4ffpYtoyiheZfMNPFcrAZ7GOW.3ny', NULL, NULL, 2, 'bkpsdm', '081216435394', 'Ngagel Mulyo', '2025-07-21 16:23:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rb_booking`
--
ALTER TABLE `rb_booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `rb_menu`
--
ALTER TABLE `rb_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `rb_posisi_berkas`
--
ALTER TABLE `rb_posisi_berkas`
  ADD PRIMARY KEY (`id_posisi_berkas`);

--
-- Indexes for table `rb_role`
--
ALTER TABLE `rb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `rb_role_to_menu`
--
ALTER TABLE `rb_role_to_menu`
  ADD PRIMARY KEY (`id_role_to_menu`);

--
-- Indexes for table `rb_tanggal_booking`
--
ALTER TABLE `rb_tanggal_booking`
  ADD PRIMARY KEY (`id_tanggal_booking`);

--
-- Indexes for table `rb_users`
--
ALTER TABLE `rb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rb_booking`
--
ALTER TABLE `rb_booking`
  MODIFY `id_booking` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rb_menu`
--
ALTER TABLE `rb_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rb_posisi_berkas`
--
ALTER TABLE `rb_posisi_berkas`
  MODIFY `id_posisi_berkas` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rb_role`
--
ALTER TABLE `rb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rb_role_to_menu`
--
ALTER TABLE `rb_role_to_menu`
  MODIFY `id_role_to_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rb_tanggal_booking`
--
ALTER TABLE `rb_tanggal_booking`
  MODIFY `id_tanggal_booking` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rb_users`
--
ALTER TABLE `rb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
