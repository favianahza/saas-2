-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2020 at 01:06 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saas_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_siswa`
--

CREATE TABLE `file_siswa` (
  `id_siswa` int(11) NOT NULL,
  `judul_laporan` varchar(192) DEFAULT NULL,
  `file_laporan` varchar(255) DEFAULT NULL,
  `absensi_pkl` varchar(255) DEFAULT NULL,
  `agenda_pkl` varchar(255) DEFAULT NULL,
  `nilai_pkl` varchar(255) DEFAULT NULL,
  `sertifikat_pkl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kepala_bengkel`
--

CREATE TABLE `kepala_bengkel` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jurusan` enum('IOP','MEKATRONIKA','PFPT','RPL','SIJA','TEDK','TOI','TEI','TPTU') NOT NULL,
  `username` char(9) NOT NULL,
  `password` char(60) NOT NULL,
  `foto` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kepala_bengkel`
--

INSERT INTO `kepala_bengkel` (`id_user`, `nama`, `jurusan`, `username`, `password`, `foto`) VALUES
(1, 'asep', 'TEI', '123', '$2y$10$Qdr.8r3cWGpEN/Y8k4m4..zvnU1NnyxFF4tacatGpMKPFQEqBnUBi', '00-default.jpg'),
(2, '1234', 'MEKATRONIKA', '1234', '$2y$10$.mhN8bwLBcf8kvTQLNZCtufBb217/OL.oJQKCGYZTrd7fY3RDeRnC', '00-default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id_pembimbing` int(2) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jurusan` enum('SIJA','TEDK','TEI','IOP','MEKATRONIKA','PFPT','RPL','TOI','TPTU') NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` char(60) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `NIS` char(9) NOT NULL,
  `password` char(60) NOT NULL,
  `kelas` enum('XIII-A','XIII-B','XIII-C','XIII-D') NOT NULL,
  `foto` varchar(128) NOT NULL,
  `jurusan` enum('SIJA','TEDK','TOI','TPTU','RPL','IOP','MEKATRONIKA','PFPT','TEI') NOT NULL,
  `id_pembimbing` int(2) DEFAULT NULL,
  `pembimbing_pkl` varchar(64) DEFAULT NULL,
  `tempat_pkl` varchar(128) DEFAULT NULL,
  `tgl_pkl` date DEFAULT NULL,
  `lama_pkl` int(2) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `persetujuan` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_siswa`
--
ALTER TABLE `file_siswa`
  ADD UNIQUE KEY `id_siswa_2` (`id_siswa`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `kepala_bengkel`
--
ALTER TABLE `kepala_bengkel`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id_pembimbing`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_pembimbing` (`id_pembimbing`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kepala_bengkel`
--
ALTER TABLE `kepala_bengkel`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id_pembimbing` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file_siswa`
--
ALTER TABLE `file_siswa`
  ADD CONSTRAINT `fk.id_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
