-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2024 pada 04.21
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
('424210', 'aan1', '819988727', 'L', 'A', 'template/img/dosen-424210-1709715228.jpg'),
('424211', 'aan2', '819988727', 'L', 'A', 'template/img/dosen-424211-1709715239.png'),
('424212', 'aan3', '819988727', 'L', 'A', ''),
('424213', 'aan4', '819988727', 'L', 'A', ''),
('424214', 'aan5', '819988727', 'L', 'A', ''),
('424215', 'aan6', '819988727', 'L', 'A', ''),
('424216', 'aan7', '819988727', 'L', 'A', ''),
('424217', 'aan8', '819988727', 'L', 'A', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_klsmatkul`
--

CREATE TABLE `tbl_klsmatkul` (
  `Id` int(11) NOT NULL,
  `nid` varchar(10) NOT NULL,
  `kode_matkul` varchar(10) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `kelas` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_klsmatkul`
--

INSERT INTO `tbl_klsmatkul` (`Id`, `nid`, `kode_matkul`, `id_periode`, `kelas`) VALUES
(1, '424210', 'A1', 4, 'B'),
(2, '424211', 'A2', 4, 'A'),
(3, '424212', 'A3', 4, 'B'),
(4, '424213', 'A4', 4, 'B'),
(5, '424214', 'A5', 4, 'A'),
(6, '424215', 'A6', 4, 'A'),
(7, '424216', 'A7', 4, 'B'),
(8, '424217', 'A8', 4, 'A');

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
('42421071', 'matien', 'L', '+62819987727', 'A', 'template/img/mhs-42421071-1709716268.jpg'),
('42421072', 'matiena', 'L', '+62819988728', 'A', ''),
('42421073', 'matienb', 'L', '+62819989729', 'A', ''),
('42421074', 'matienc', 'L', '+628199810727', 'A', ''),
('42421075', 'matiend', 'L', '+62819987727', 'A', ''),
('42421076', 'matiene', 'L', '+62819988728', 'A', ''),
('42421077', 'matienf', 'L', '+62819989729', 'A', ''),
('42421078', 'matieng', 'L', '+628199810727', 'A', '');

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
(250, '424210', 'a2e5000fe1b089f2a50d7601580789567529f699', 'dosen', 'aan1'),
(251, '424211', 'd95c33b9a7f2581c63893f30579f9efa221b980d', 'dosen', 'aan2'),
(252, '424212', '13e3c5350981964266ded89eaa83af8e4c7df034', 'dosen', 'aan3'),
(253, '424213', '155403fff6a041dfd679e6f3c2079103d9d92e2d', 'dosen', 'aan4'),
(254, '424214', 'a944be2a4ed62a73529332cb3afc2f198eca82c5', 'dosen', 'aan5'),
(255, '424215', '425df859f17533b08d81763616df413e1f065946', 'dosen', 'aan6'),
(256, '424216', '1cfd4be8da566286a34529857b5eb9b9a8c1cd4a', 'dosen', 'aan7'),
(257, '424217', '3904a05de2322c7a3de2e0e8684c4facb4d4a9bf', 'dosen', 'aan8'),
(259, '42421071', '2cb2a8dde81439f7420e18649521d853dfcc7810', 'mhs', 'matien'),
(260, '42421072', '15fc78cc5e8376892f0661dbff46561f0dded61f', 'mhs', 'matiena'),
(261, '42421073', 'e9dd9bed882957b1f452f2277664461f58d2dbcd', 'mhs', 'matienb'),
(262, '42421074', '303c9ae20a0c7fdf7d24d11d99019244ebc86666', 'mhs', 'matienc'),
(263, '42421075', '89fb0e5f1595a423317baf26fe024365f9404f10', 'mhs', 'matiend'),
(264, '42421076', '291225cba25b9f7d718fa44183971caa1af73a84', 'mhs', 'matiene'),
(265, '42421077', 'cc188cfce66684700c5b212a6fc4c5f6fc3090db', 'mhs', 'matienf'),
(266, '42421078', 'b485cf483185240564e9719757954c0c00abace5', 'mhs', 'matieng');

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
(7, '2019', 'Genap', 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesertamatkul`
--

CREATE TABLE `tbl_pesertamatkul` (
  `id_klsmatkul` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pesertamatkul`
--

INSERT INTO `tbl_pesertamatkul` (`id_klsmatkul`, `nim`, `id_periode`) VALUES
(1, '42421071', 4),
(1, '42421072', 4),
(1, '42421073', 4),
(1, '42421074', 4),
(1, '42421075', 4),
(1, '42421076', 4),
(1, '42421077', 4),
(1, '42421078', 4),
(2, '42421076', 4),
(3, '42421077', 4),
(4, '42421078', 4),
(5, '42421071', 4),
(6, '42421072', 4),
(7, '42421073', 4),
(8, '42421074', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_presensi`
--

CREATE TABLE `tbl_presensi` (
  `id_klsmatkul` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `nim` int(11) NOT NULL,
  `kehadiran` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_presensi`
--

INSERT INTO `tbl_presensi` (`id_klsmatkul`, `tanggal`, `nim`, `kehadiran`) VALUES
(1, '2024-03-07 19:16:07', 42421071, 'Y'),
(1, '2024-03-07 19:16:07', 42421072, 'N'),
(1, '2024-03-07 19:16:07', 42421073, 'N'),
(1, '2024-03-07 19:16:07', 42421074, 'N'),
(1, '2024-03-07 19:16:07', 42421075, 'N'),
(1, '2024-03-11 23:38:26', 42421076, 'N'),
(1, '2024-03-11 23:38:26', 42421077, 'N'),
(1, '2024-03-11 23:38:26', 42421078, 'N'),
(5, '2024-03-11 23:40:18', 42421071, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tglpresensi`
--

CREATE TABLE `tbl_tglpresensi` (
  `Id` int(11) NOT NULL,
  `id_klsmatkul` int(11) NOT NULL,
  `tgl_presensi` datetime NOT NULL
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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_matkul`
--
ALTER TABLE `tbl_matkul`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
