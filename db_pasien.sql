-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2025 at 03:21 PM
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
-- Database: `db_pasien`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `no_rm` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `jk` enum('Tidak diketahui','Laki-laki','Perempuan','Tidak dapat ditentukan','Tidak mengisi') NOT NULL,
  `agama` enum('Islam','Kristen Protestan','Katolik','Hindu','Budha','Konghucu','Penghayat') NOT NULL,
  `jenis_pembiayaan` enum('JKN','Umum','Asuransi') NOT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `no_rm`, `nik`, `nama`, `no_hp`, `jk`, `agama`, `jenis_pembiayaan`, `provinsi`, `kota`, `kecamatan`, `kelurahan`, `alamat`, `created_at`) VALUES
(1, 1001, '3201012001010001', 'Andi Wijaya', '081234567890', 'Laki-laki', 'Islam', 'JKN', 'Jawa Barat', 'Bandung', 'Cicendo', 'Dago', 'Jl. Dago No.12', '2025-12-20 06:04:47'),
(2, 1002, '3201012001020002', 'Siti Aminah', '081298765432', 'Perempuan', 'Kristen Protestan', 'Umum', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', 'Pulo', 'Jl. Pulo No.3', '2025-12-20 06:04:47'),
(3, 1003, '3201012001030003', 'Budi Santoso', '081355566677', 'Laki-laki', 'Katolik', 'Asuransi', 'Jawa Tengah', 'Semarang', 'Candisari', 'Tlogosari', 'Jl. Tlogosari No.5', '2025-12-20 06:04:47'),
(4, 1004, '3201012001040004', 'Dewi Lestari', '081366677788', 'Perempuan', 'Hindu', 'JKN', 'Jawa Timur', 'Surabaya', 'Gubeng', 'Ketintang', 'Jl. Ketintang No.8', '2025-12-20 06:04:47'),
(5, 1005, '3201012001050005', 'Rina Putri', '081377788899', 'Perempuan', 'Budha', 'Umum', 'Banten', 'Tangerang', 'Ciledug', 'Larangan', 'Jl. Larangan No.7', '2025-12-20 06:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `resume_medis`
--

CREATE TABLE `resume_medis` (
  `id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `keluhan_utama` text NOT NULL,
  `diagnosis` text NOT NULL,
  `tindakan` text DEFAULT NULL,
  `snomed_tindakan` varchar(20) DEFAULT NULL,
  `obat` text DEFAULT NULL,
  `snomed_obat` varchar(20) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `total_biaya` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resume_medis`
--

INSERT INTO `resume_medis` (`id`, `pasien_id`, `keluhan_utama`, `diagnosis`, `tindakan`, `snomed_tindakan`, `obat`, `snomed_obat`, `catatan`, `total_biaya`, `tanggal`) VALUES
(2, 2, 'Sakit perut dan mual', 'Gastritis ringan', 'Pemberian obat lambung', '223344', 'Omeprazole', '887766', 'Hindari makanan pedas', 75000, '2025-12-20 13:04:47'),
(3, 3, 'Sakit kepala hebat', 'Migrain', 'Pemberian analgesik', '334455', 'Ibuprofen', '776655', 'Hindari stres berlebih', 60000, '2025-12-20 13:04:47'),
(4, 4, 'Nyeri sendi lutut', 'Osteoarthritis ringan', 'Fisioterapi + obat', '445566', 'Diclofenac', '665544', 'Lakukan senam ringan setiap hari', 120000, '2025-12-20 13:04:47'),
(5, 5, 'Batuk berkepanjangan', 'Infeksi saluran pernapasan', 'Pemberian antibiotik', '556677', 'Amoxicillin', '554433', 'Minum banyak air putih', 100000, '2025-12-20 13:04:47'),
(9, 1, 'Demam sejak 3 hari, disertai sakit kepala dan nyeri otot', 'Demam Viral', NULL, '386661006 | Fever ma', NULL, '372687004 | Paraceta', 'Pasien dianjurkan istirahat cukup, banyak minum, dan kontrol bila demam tidak turun', 75000, '2025-12-23 21:10:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_rm` (`no_rm`);

--
-- Indexes for table `resume_medis`
--
ALTER TABLE `resume_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasien_id` (`pasien_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resume_medis`
--
ALTER TABLE `resume_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resume_medis`
--
ALTER TABLE `resume_medis`
  ADD CONSTRAINT `resume_medis_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
