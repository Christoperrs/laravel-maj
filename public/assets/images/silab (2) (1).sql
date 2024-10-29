-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Okt 2024 pada 05.17
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silab`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id_booking` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `asalkampus` varchar(255) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `form_pendaftaran` blob DEFAULT NULL,
  `file_proposal` blob DEFAULT NULL,
  `id_lab` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `tanggal_booking` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id_booking`, `id_user`, `namalengkap`, `asalkampus`, `nim`, `prodi`, `form_pendaftaran`, `file_proposal`, `id_lab`, `id_item`, `tanggal_booking`, `jam_mulai`, `jam_selesai`, `created_at`) VALUES
(14, 1, 'sa', 'sad', 'wqe', 's', 0x75706c6f6164732f4f4f442e646f6378, 0x75706c6f6164732f4f4f442e646f6378, NULL, NULL, '2024-10-24', '02:21:00', '03:20:00', '2024-10-15 19:23:55'),
(15, 1, 'sa', 'sad', 'wqe', 's', 0x75706c6f6164732f4f4f442e646f6378, 0x75706c6f6164732f4f4f442e646f6378, NULL, NULL, '2024-10-24', '02:21:00', '03:20:00', '2024-10-15 19:32:07'),
(16, 1, 'sa', 'sad', 'wqe', 's', 0x75706c6f6164732f4f4f442e646f6378, 0x75706c6f6164732f4f4f442e646f6378, NULL, NULL, '2024-10-24', '02:21:00', '03:20:00', '2024-10-15 20:12:04'),
(17, 1, 'sa', 'sad', 'wqe', 's', 0x75706c6f6164732f4f4f442e646f6378, 0x75706c6f6164732f4f4f442e646f6378, NULL, NULL, '2024-10-24', '02:21:00', '03:20:00', '2024-10-15 20:16:45'),
(18, 1, 'sa', 'sad', 'wqe', 's', 0x75706c6f6164732f4f4f442e646f6378, 0x75706c6f6164732f4f4f442e646f6378, NULL, NULL, '2024-10-24', '02:21:00', '03:20:00', '2024-10-15 20:19:06'),
(19, 1, 'sa', 'sad', 'wqe', 's', 0x75706c6f6164732f4f4f442e646f6378, 0x75706c6f6164732f4f4f442e646f6378, 3, NULL, '2024-10-24', '02:21:00', '03:20:00', '2024-10-15 21:26:50'),
(20, 1, 'sa', 'sad', 'wqe', 's', 0x75706c6f6164732f4f4f442e646f6378, 0x75706c6f6164732f4f4f442e646f6378, 1, NULL, '2024-10-24', '02:21:00', '03:20:00', '2024-10-15 21:43:50'),
(21, 1, 'agus', 'tes', 'wqe', 's', 0x75706c6f6164732f4f4f442e646f6378, 0x75706c6f6164732f4f4f442e646f6378, 1, NULL, '2024-10-24', '02:21:00', '03:20:00', '2024-10-15 21:47:21'),
(22, 1, 'agus Santoso', 'UI', '032189', 'Informatika', 0x75706c6f6164732f426173697320446174612e646f6378, 0x75706c6f6164732f4f4f442e646f6378, 1, NULL, '2024-10-17', '02:22:00', '06:20:00', '2024-10-15 21:48:38'),
(23, 1, 'agus Santoso', 'UI', '032189', 'Informatika', 0x75706c6f6164732f426173697320446174612e646f6378, 0x75706c6f6164732f4f4f442e646f6378, 1, NULL, '2024-10-17', '02:22:00', '06:20:00', '2024-10-15 22:06:43'),
(24, 1, 'agus Santoso', 'UI', '032189', 'Informatika', 0x75706c6f6164732f426173697320446174612e646f6378, 0x75706c6f6164732f4f4f442e646f6378, 1, NULL, '2024-10-17', '02:22:00', '06:20:00', '2024-10-15 22:12:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings_items`
--

CREATE TABLE `bookings_items` (
  `id_item` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `id_bahan` int(11) DEFAULT NULL,
  `id_alat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bookings_items`
--

INSERT INTO `bookings_items` (`id_item`, `booking_id`, `id_bahan`, `id_alat`) VALUES
(66, 24, 3, NULL),
(67, 24, 4, NULL),
(68, 24, NULL, 1),
(69, 24, NULL, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id_lab` int(11) NOT NULL,
  `nama_lab` varchar(255) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laboratorium`
--

INSERT INTO `laboratorium` (`id_lab`, `nama_lab`, `kapasitas`, `lokasi`, `created_at`) VALUES
(1, 'Laboratorium Kimia', 40, 'Lantai 1', '2024-10-10 04:44:04'),
(2, 'Laboratorium Biologi', 50, 'Lantai 2', '2024-10-10 04:44:04'),
(3, 'Laboratorium Fisika', 40, 'Lantai 3', '2024-10-10 04:44:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium_alat`
--

CREATE TABLE `laboratorium_alat` (
  `id_alat` int(11) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi` varchar(100) DEFAULT NULL,
  `tahun_perolehan` year(4) DEFAULT NULL,
  `ruang_penyimpanan` varchar(255) DEFAULT NULL,
  `penanggungjawab` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laboratorium_alat`
--

INSERT INTO `laboratorium_alat` (`id_alat`, `id_lab`, `nama_alat`, `jumlah`, `kondisi`, `tahun_perolehan`, `ruang_penyimpanan`, `penanggungjawab`) VALUES
(1, 1, 'Mikroskop', 10, 'Baik', 2020, 'Ruang Penyimpanan 1', 'Dr. Ali'),
(2, 1, 'Tabung Reaksi', 50, 'Baik', 2021, 'Ruang Penyimpanan 2', 'Dr. Budi'),
(3, 1, 'Pipet', 30, 'Baik', 2022, 'Ruang Penyimpanan 1', 'Dr. Citra'),
(4, 1, 'Gelas Piala', 20, 'Baik', 2019, 'Ruang Penyimpanan 3', 'Dr. Dika'),
(5, 1, 'Pemisah Campuran', 15, 'Rusak', 2020, 'Ruang Penyimpanan 1', 'Dr. Eko'),
(6, 1, 'Thermometer', 25, 'Baik', 2021, 'Ruang Penyimpanan 2', 'Dr. Fika'),
(7, 2, 'Sentrifugasi', 3, 'Baik', 2020, 'Ruang Penyimpanan 1', 'Dr. Hendra'),
(8, 2, 'Bunsen Burner', 8, 'Baik', 2022, 'Ruang Penyimpanan 2', 'Dr. Indah'),
(9, 2, 'Gelas Ukur', 15, 'Baik', 2021, 'Ruang Penyimpanan 1', 'Dr. Joko'),
(10, 2, 'Mikropipet', 30, 'Baik', 2022, 'Ruang Penyimpanan 3', 'Dr. Lila'),
(11, 2, 'pH Meter', 5, 'Baik', 2023, 'Ruang Penyimpanan 4', 'Dr. Miko'),
(12, 2, 'Reagen', 100, 'Baik', 2023, 'Ruang Penyimpanan 1', 'Dr. Nia'),
(13, 3, 'Peralatan Keselamatan', 50, 'Baik', 2023, 'Ruang Penyimpanan 2', 'Dr. Oki'),
(14, 3, 'Kalkulator Grafik', 4, 'Baik', 2022, 'Ruang Penyimpanan 3', 'Dr. Pita'),
(15, 3, 'Alat Ukur Listrik', 6, 'Baik', 2020, 'Ruang Penyimpanan 1', 'Dr. Qura'),
(16, 3, 'Suhu Digital', 15, 'Baik', 2021, 'Ruang Penyimpanan 2', 'Dr. Rudi'),
(17, 3, 'Laser Pointer', 9, 'Baik', 2023, 'Ruang Penyimpanan 3', 'Dr. Sari'),
(18, 3, 'Buku Referensi', 30, 'Baik', 2020, 'Ruang Penyimpanan 2', 'Dr. Tia'),
(19, 3, 'Magnet', 20, 'Baik', 2021, 'Ruang Penyimpanan 3', 'Dr. Vina'),
(20, 3, 'Kotak P3K', 5, 'Baik', 2021, 'Ruang Penyimpanan 1', 'Dr. Niko');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium_bahan`
--

CREATE TABLE `laboratorium_bahan` (
  `id_bahan` int(11) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `nama_bahan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `jenis` enum('padat','cair','gas') NOT NULL,
  `tahun_perolehan` year(4) DEFAULT NULL,
  `ruang_penyimpanan` varchar(255) DEFAULT NULL,
  `penanggungjawab` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laboratorium_bahan`
--

INSERT INTO `laboratorium_bahan` (`id_bahan`, `id_lab`, `nama_bahan`, `jumlah`, `satuan`, `jenis`, `tahun_perolehan`, `ruang_penyimpanan`, `penanggungjawab`) VALUES
(1, 1, 'Asam Sulfat', 25, 'Liter', 'cair', 2021, 'Ruang Penyimpanan 1', 'Dr. Ali'),
(2, 1, 'Natrium Klorida', 50, 'Kilogram', 'padat', 2022, 'Ruang Penyimpanan 2', 'Dr. Budi'),
(3, 1, 'Amonium Nitrat', 30, 'Kilogram', 'padat', 2021, 'Ruang Penyimpanan 3', 'Dr. Citra'),
(4, 1, 'Air Distilasi', 100, 'Liter', 'cair', 2023, 'Ruang Penyimpanan 1', 'Dr. Dika'),
(5, 1, 'Pewarna Indikator', 20, 'Botol', 'cair', 2020, 'Ruang Penyimpanan 2', 'Dr. Eko'),
(6, 2, 'Glukosa', 40, 'Kilogram', 'padat', 2021, 'Ruang Penyimpanan 1', 'Dr. Hendra'),
(7, 2, 'Larutan Garam', 30, 'Liter', 'cair', 2022, 'Ruang Penyimpanan 2', 'Dr. Indah'),
(8, 2, 'Daging Ayam', 10, 'Kilogram', 'cair', 2023, 'Ruang Penyimpanan 3', 'Dr. Joko'),
(9, 2, 'Bubuk Teh', 15, 'Kilogram', 'padat', 2021, 'Ruang Penyimpanan 1', 'Dr. Lila'),
(10, 2, 'Deterjen', 25, 'Liter', 'cair', 2023, 'Ruang Penyimpanan 2', 'Dr. Miko'),
(11, 2, 'Etanol', 20, 'Liter', 'cair', 2022, 'Ruang Penyimpanan 3', 'Dr. Nia'),
(12, 3, 'Silikon', 10, 'Kilogram', 'padat', 2021, 'Ruang Penyimpanan 1', 'Dr. Oki'),
(13, 3, 'Kapasitor', 50, 'Unit', 'padat', 2023, 'Ruang Penyimpanan 2', 'Dr. Pita'),
(14, 3, 'Resistor', 100, 'Unit', 'padat', 2021, 'Ruang Penyimpanan 3', 'Dr. Qura'),
(15, 3, 'Baterai', 30, 'Unit', 'padat', 2022, 'Ruang Penyimpanan 1', 'Dr. Rudi'),
(16, 3, 'Alat Ukur pH', 20, 'Unit', 'padat', 2023, 'Ruang Penyimpanan 2', 'Dr. Sari'),
(17, 3, 'Kawat Tembaga', 15, 'Kilogram', 'padat', 2021, 'Ruang Penyimpanan 3', 'Dr. Tia'),
(18, 3, 'Magnet', 25, 'Unit', 'padat', 2022, 'Ruang Penyimpanan 1', 'Dr. Vina'),
(19, 3, 'Pipa Kaca', 40, 'Unit', 'padat', 2021, 'Ruang Penyimpanan 2', 'Dr. Niko'),
(20, 3, 'Alat Ukur Suhu', 10, 'Unit', 'padat', 2023, 'Ruang Penyimpanan 3', 'Dr. Rudi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id_profil` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `asalkampus` varchar(255) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id_profil`, `user_id`, `asalkampus`, `nim`, `prodi`, `nohp`) VALUES
(1, 1, 'Universitas Hang Tuah Pekanbaru', '21081016', 'Teknik Informatika', '0895634874915');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `namalengkap`, `username`, `password`, `email`) VALUES
(1, 'Muhammad Nurfi Syahlan', 'nurfisyahlan', '123', 'nurfiisyahlan@gmail.com'),
(2, 'istianah', 'istiiii', '123', 'istianah@gmail.com'),
(3, 'Hana Silvanov R.', 'hansil', '123', 'hanasilva@gmail.com'),
(4, 'Administrator', 'admin', '123', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indeks untuk tabel `bookings_items`
--
ALTER TABLE `bookings_items`
  ADD PRIMARY KEY (`id_item`);

--
-- Indeks untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`id_lab`);

--
-- Indeks untuk tabel `laboratorium_alat`
--
ALTER TABLE `laboratorium_alat`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `id_lab` (`id_lab`);

--
-- Indeks untuk tabel `laboratorium_bahan`
--
ALTER TABLE `laboratorium_bahan`
  ADD PRIMARY KEY (`id_bahan`),
  ADD KEY `id_lab` (`id_lab`);

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_profil`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `bookings_items`
--
ALTER TABLE `bookings_items`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id_lab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `laboratorium_alat`
--
ALTER TABLE `laboratorium_alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `laboratorium_bahan`
--
ALTER TABLE `laboratorium_bahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laboratorium_alat`
--
ALTER TABLE `laboratorium_alat`
  ADD CONSTRAINT `laboratorium_alat_ibfk_1` FOREIGN KEY (`id_lab`) REFERENCES `laboratorium` (`id_lab`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laboratorium_bahan`
--
ALTER TABLE `laboratorium_bahan`
  ADD CONSTRAINT `laboratorium_bahan_ibfk_1` FOREIGN KEY (`id_lab`) REFERENCES `laboratorium` (`id_lab`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
