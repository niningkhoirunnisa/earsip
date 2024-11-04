-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Bulan Mei 2024 pada 15.35
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbarsip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_arsip`
--

CREATE TABLE `tbl_arsip` (
  `id_arsip` int(11) NOT NULL,
  `no_surat` varchar(30) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `id_departemen` int(11) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_arsip`
--

INSERT INTO `tbl_arsip` (`id_arsip`, `no_surat`, `tanggal_surat`, `tanggal_diterima`, `perihal`, `id_departemen`, `id_pengirim`, `file`) VALUES
(10, '2024/I/001', '2024-05-07', '2024-05-08', 'Pendataan ulang warga', 20, 6, '664bf2e7cf4fc-jpg'),
(12, '2024/V/003', '2024-05-18', '2024-05-20', 'Sosialisasi pengisian administrasi desa', 22, 7, '664bf47ed82fb-jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_departemen`
--

CREATE TABLE `tbl_departemen` (
  `id_departemen` int(11) NOT NULL,
  `nama_departemen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_departemen`
--

INSERT INTO `tbl_departemen` (`id_departemen`, `nama_departemen`) VALUES
(15, 'Pemerintahan'),
(16, 'Pembangunan'),
(17, 'Kesejahteraan Rakyat'),
(18, 'Keamanan dan Ketertiban'),
(19, 'Perekonomian'),
(20, 'Kependudukan dan Pencatatan Sipil'),
(21, 'Lingkungan Hidup'),
(22, 'Kesekretariatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keluar`
--

CREATE TABLE `tbl_keluar` (
  `id_arsip1` int(11) NOT NULL,
  `no_surat1` varchar(30) NOT NULL,
  `tanggal_surat1` date NOT NULL,
  `perihal1` varchar(100) NOT NULL,
  `id_departemen1` text NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_keluar`
--

INSERT INTO `tbl_keluar` (`id_arsip1`, `no_surat1`, `tanggal_surat1`, `perihal1`, `id_departemen1`, `file`) VALUES
(10, '001/KM/2024', '2024-05-21', 'Surat Keterangan Kematian', 'Dinas Kependudukan dan Catatan Sipil', '664be41372e3d-jpg'),
(11, '002/UD/2024', '2024-05-20', 'Musyawarah selamatan desa', 'Seluruh ketua RT di Desa Tambaharjo', '664be5d401efd-jpg'),
(12, '003/UD/2024', '2024-05-22', 'Undangan rapat desa', 'Seluruh ketua Rukun Warga Desa Tambaharjo', '664bed0151009-jpg'),
(13, '004/SK/2024', '2024-05-21', 'Surat Keterangan Domisili Sekolah', 'SMA N 1Kayen', '664bee4bd4b1b-png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengirim_surat`
--

CREATE TABLE `tbl_pengirim_surat` (
  `id_pengirim` int(11) NOT NULL,
  `nama_pengirim_surat` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pengirim_surat`
--

INSERT INTO `tbl_pengirim_surat` (`id_pengirim`, `nama_pengirim_surat`, `alamat`, `no_hp`, `email`) VALUES
(6, 'Dinas Kependudukan Dan Pencatatan Sipil', ' Gg. Bima No.3, Kaborongan, Pati Lor, Kec. Pati, Kabupaten Pati, Jawa Tengah 59119', ' (0295) 38626', 'diskepilpati@gmail.com'),
(7, 'Kantor Kecamatan Tambakromo', 'Jl.Raya Tambakromo No. 94, Kec. Tambakromo, Kabupaten Pati, Jawa Tengah 59174', ' (0295) 38726', 'kectambakromo1@gmail.com'),
(8, 'UPT Puskesmas Tambakromo', 'Ngarang, Tambakromo, Kec. Tambakromo, Kabupaten Pati, Jawa Tengah 59174', ' (0295) 41038', 'tambakromosehat@gmail.com'),
(9, 'Dinas Kesehatan Kab. Pati', 'Jl. Diponegoro No.153, Parenggan, Kec. Pati, Kabupaten Pati, Jawa Tengah 59119', ' (0295) 38168', 'dinkes_pati@gmail.com'),
(10, 'Dinas perhubungan kab pati', 'Jl. Diponegoro No.154, Parenggan, Kec. Pati, Kabupaten Pati, Jawa Tengah 59119', '1234567891', 'dishubpati@gmail.com'),
(14, 'Dinas Pemberdayaan Masyarakat dan Desa Kab Pati', ' Margorejo, Kec. Margorejo, Kabupaten Pati, Jawa Tengah 59163', '08587234556', 'dispermadespati@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`) VALUES
(1, 'admin', 'nicull2@gmail.com', '$2y$10$qiW2RKe8SDcV86w5ftGhLeI5tl.OvV.BpwvhsOpB.xDDRGhpeD2p.', 'Nining Khoirun Nisa&#39;'),
(2, 'admin1', 'nicul123@gmail.com', '1234', 'Nining KN');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_arsip`
--
ALTER TABLE `tbl_arsip`
  ADD PRIMARY KEY (`id_arsip`),
  ADD KEY `id_departemen_fkk` (`id_departemen`),
  ADD KEY `id_pengirim` (`id_pengirim`);

--
-- Indeks untuk tabel `tbl_departemen`
--
ALTER TABLE `tbl_departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indeks untuk tabel `tbl_keluar`
--
ALTER TABLE `tbl_keluar`
  ADD PRIMARY KEY (`id_arsip1`);

--
-- Indeks untuk tabel `tbl_pengirim_surat`
--
ALTER TABLE `tbl_pengirim_surat`
  ADD PRIMARY KEY (`id_pengirim`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_arsip`
--
ALTER TABLE `tbl_arsip`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_departemen`
--
ALTER TABLE `tbl_departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tbl_keluar`
--
ALTER TABLE `tbl_keluar`
  MODIFY `id_arsip1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengirim_surat`
--
ALTER TABLE `tbl_pengirim_surat`
  MODIFY `id_pengirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_arsip`
--
ALTER TABLE `tbl_arsip`
  ADD CONSTRAINT `id_departemen_fkk` FOREIGN KEY (`id_departemen`) REFERENCES `tbl_departemen` (`id_departemen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pengirim` FOREIGN KEY (`id_pengirim`) REFERENCES `tbl_pengirim_surat` (`id_pengirim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
