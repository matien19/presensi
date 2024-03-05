-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Mar 2024 pada 00.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_proyekperadaban`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dosen`
--

CREATE TABLE `tbl_dosen` (
  `nid` varchar(10) NOT NULL,
  `nama` text NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `stat` varchar(1) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`nid`, `nama`, `kontak`, `kelamin`, `stat`, `foto`) VALUES
('1122312', 'stabilo', '+62899882742', 'L', 'A', 'template/img/dosen-1122312-1709560267.jpg'),
('665546', 'cece', '+62899877777', 'P', 'A', 'template/img/dosen-665546-1709559192.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_klsmatkul`
--

CREATE TABLE `tbl_klsmatkul` (
  `Id` int(11) NOT NULL,
  `nid` varchar(10) NOT NULL,
  `kode_matkul` varchar(10) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_klsmatkul`
--

INSERT INTO `tbl_klsmatkul` (`Id`, `nid`, `kode_matkul`, `id_periode`) VALUES
(1, '665546', 'A1', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `stat` varchar(1) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`nim`, `nama`, `kelamin`, `nohp`, `stat`, `foto`) VALUES
('42421071', 'Matien Hakim Falahudin Bachtiar', 'L', '+628998827278', 'A', 'template/imgmhs-42421071-1709556238.jpg'),
('424210711', 'Riki', 'P', '+62899882742', 'A', 'template/imgmhs-424210711-1709556202.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_matkul`
--

CREATE TABLE `tbl_matkul` (
  `Id` int(11) NOT NULL,
  `kode_matkul` varchar(10) NOT NULL,
  `nama_ind` varchar(20) NOT NULL,
  `nama_eng` varchar(20) NOT NULL,
  `sks` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_matkul`
--

INSERT INTO `tbl_matkul` (`Id`, `kode_matkul`, `nama_ind`, `nama_eng`, `sks`) VALUES
(1, 'B7', 'Informati', 'Informati', '3'),
(2, 'A1', 'B. Indoneisa1', 'Indonesian language1', '2'),
(3, 'A2', 'B. Indoneisa2', 'Indonesian language2', '3'),
(4, 'A3', 'B. Indoneisa3', 'Indonesian language3', '3'),
(5, 'A4', 'B. Indoneisa4', 'Indonesian language4', '2'),
(6, 'A5', 'B. Indoneisa5', 'Indonesian language5', '2'),
(7, 'A6', 'B. Indoneisa6', 'Indonesian language6', '3'),
(8, 'A7', 'B. Indoneisa7', 'Indonesian language7', '2'),
(9, 'A8', 'B. Indoneisa8', 'Indonesian language8', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `Id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `peran` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`Id`, `username`, `password`, `peran`, `nama`) VALUES
(105, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', 'Matien Hakim'),
(108, 'aan', 'ebba79a83e1cfef6d54fa5c33b2d5aa46f5e0df5', 'Admin', 'Aan'),
(119, 'admin', 'e0c9035898dd52fc65c41454cec9c4d2611bfb37', 'Admin', 'aa'),
(121, 'aa', 'e0c9035898dd52fc65c41454cec9c4d2611bfb37', 'Admin', 'aaa'),
(231, '42421071', '2cb2a8dde81439f7420e18649521d853dfcc7810', 'mhs', 'Matien Hakim Falahudin Bachtiar'),
(232, '424210711', '02e81df6135e7d310674978c7f45cf091c7a247c', 'mhs', 'Riki'),
(233, '1122312', '075861142754d720c0825f78472995e0d6158f92', 'dosen', 'stabilo'),
(234, '665546', '770e610ff60aa16fd63c3aabb34430b3d29d8ea2', 'dosen', 'cece');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_periode`
--

CREATE TABLE `tbl_periode` (
  `Id` int(11) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `stat` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_periode`
--

INSERT INTO `tbl_periode` (`Id`, `tahun`, `semester`, `stat`) VALUES
(2, '2023', 'Genap', 'T'),
(4, '2019', 'Ganjil', 'A'),
(5, '2018', 'Ganjil', 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesertamatkul`
--

CREATE TABLE `tbl_pesertamatkul` (
  `kode_klsmatkul` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  ADD PRIMARY KEY (`nid`);

--
-- Indeks untuk tabel `tbl_klsmatkul`
--
ALTER TABLE `tbl_klsmatkul`
  ADD PRIMARY KEY (`Id`);

--
-- Indeks untuk tabel `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `tbl_matkul`
--
ALTER TABLE `tbl_matkul`
  ADD PRIMARY KEY (`Id`);

--
-- Indeks untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`Id`);

--
-- Indeks untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_klsmatkul`
--
ALTER TABLE `tbl_klsmatkul`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_matkul`
--
ALTER TABLE `tbl_matkul`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
