-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Apr 2024 pada 17.14
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
-- Struktur dari tabel `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kode_jurusan` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kode_jurusan`, `nama`) VALUES
('A001', 'Informatika'),
('A002', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_klsmatkul`
--

CREATE TABLE `tbl_klsmatkul` (
  `Id` int(11) NOT NULL,
  `nid` varchar(10) NOT NULL,
  `kode_matkul` varchar(10) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `kelas` varchar(3) NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_klsmatkul`
--

INSERT INTO `tbl_klsmatkul` (`Id`, `nid`, `kode_matkul`, `id_periode`, `kelas`, `kode_jurusan`) VALUES
(1, '424210', 'A1', 4, 'B', 'A001'),
(2, '424211', 'A2', 4, 'A', 'A001'),
(3, '424212', 'A3', 4, 'B', 'A001'),
(4, '424213', 'A4', 4, 'B', 'A001'),
(5, '424214', 'A5', 4, 'A', 'A001'),
(6, '424215', 'A6', 4, 'A', 'A001'),
(7, '424216', 'A7', 4, 'B', 'A001'),
(8, '424217', 'A8', 4, 'A', 'A001'),
(9, '424210', 'B7', 4, 'A', 'A001');

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
  `foto` text NOT NULL,
  `kode_jurusan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`nim`, `nama`, `kelamin`, `nohp`, `stat`, `foto`, `kode_jurusan`) VALUES
('42321018', 'Naylu Syifa', 'P', '+628998827277', 'A', '', 'A002'),
('42421054', 'Auliya Fitra Sabila', 'P', '+62819987727', 'A', '', 'A001'),
('42421055', 'Bayu Aji Assidiq', 'L', '+62819988728', 'A', '', 'A001'),
('42421056', 'Candrasa Asmaradanta', 'L', '+62819989729', 'A', '', 'A001'),
('42421057', 'Eko Gunawan', 'L', '+62819981001', 'A', '', 'A001'),
('42421059', 'Farchanul Umam', 'L', '+62819981002', 'A', '', 'A001'),
('42421060', 'Fatkhan Rizqi Amrulloh', 'L', '+62819981003', 'A', '', 'A001'),
('42421061', 'Femulia Arifka Nanda', 'P', '+62819981001', 'A', '', 'A001'),
('42421063', 'Hadi Saputra Arifin', 'L', '+62819981003', 'A', '', 'A001'),
('42421064', 'Ihzamulloh', 'L', '+62819981001', 'A', '', 'A001'),
('42421065', 'Irbah Izazi', 'P', '+62819981002', 'A', '', 'A001'),
('42421066', 'Khaqi Noer Oktavian Majid', 'L', '+62819981003', 'T', '', 'A001'),
('42421067', 'Krisdianto', 'L', '+62819981001', 'A', '', 'A001'),
('42421068', 'Lilis Suryani', 'P', '+62819981002', 'A', '', 'A001'),
('42421069', 'M. Noval Najib', 'L', '+62819981003', 'A', '', 'A001'),
('42421070', 'M. Yusuf Al Qaradlawi', 'L', '+62819981001', 'A', '', 'A001'),
('42421071', 'Matien Hakim Falahudin Bachtiar', 'L', '+62819981002', 'A', '', 'A001'),
('42421088', 'Ikrimatul A\'la', 'P', '+62819981002', 'A', '', 'A001');

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
(250, '424210', 'ce3eaa938d09504bae9458dffb805f2de7c9da4e', 'dosen', 'aan1'),
(251, '424211', 'd95c33b9a7f2581c63893f30579f9efa221b980d', 'dosen', 'aan2'),
(252, '424212', '13e3c5350981964266ded89eaa83af8e4c7df034', 'dosen', 'aan3'),
(253, '424213', '155403fff6a041dfd679e6f3c2079103d9d92e2d', 'dosen', 'aan4'),
(254, '424214', 'a944be2a4ed62a73529332cb3afc2f198eca82c5', 'dosen', 'aan5'),
(255, '424215', '425df859f17533b08d81763616df413e1f065946', 'dosen', 'aan6'),
(256, '424216', '1cfd4be8da566286a34529857b5eb9b9a8c1cd4a', 'dosen', 'aan7'),
(257, '424217', '3904a05de2322c7a3de2e0e8684c4facb4d4a9bf', 'dosen', 'aan8'),
(370, '42421054', 'e2160c3052c828511666a05d28cb10d29146c2a2', 'mhs', 'Auliya Fitra Sabila'),
(371, '42421055', '6fc289040a5fa6bf3cb76592758c127d6de40a18', 'mhs', 'Bayu Aji Assidiq'),
(372, '42421056', 'a8989d05a44eb50290a0a231a53990df53ae9720', 'mhs', 'Candrasa Asmaradanta'),
(373, '42421057', '56e84fee4eb53b19e70afd0937b52629cb4ca3c0', 'mhs', 'Eko Gunawan'),
(374, '42421059', '6ba2f01349145c2cc8e71b887fe7173c19547ba4', 'mhs', 'Farchanul Umam'),
(375, '42421060', '1cbbbbaf1633f232eba723838ccca7b0244677fc', 'mhs', 'Fatkhan Rizqi Amrulloh'),
(376, '42421061', 'e1292115ffc04d32a9452bd19daf22c12b1b9516', 'mhs', 'Femulia Arifka Nanda'),
(377, '42421088', '248ee961307a57162016ba8f5085547a44281467', 'mhs', 'Ikrimatul A\'la'),
(378, '42421063', '0927d5de0d3c9e62156becc49eda7dca0dff9718', 'mhs', 'Hadi Saputra Arifin'),
(379, '42421064', '301af11f92632575ee3dd96632ddd46994c1ae16', 'mhs', 'Ihzamulloh'),
(380, '42421065', 'ef261035201c5bb44c377d4df2a42bbe10132340', 'mhs', 'Irbah Izazi'),
(381, '42421066', '7f76f0834df6d19113de8b911c56cfa6bc144412', 'mhs', 'Khaqi Noer Oktavian Majid'),
(382, '42421067', 'ec091d85383babc2e7f977c9d8994196a62ab7be', 'mhs', 'Krisdianto'),
(383, '42421068', '6b44e52529db375e9976b1bf8efd0636f20513d3', 'mhs', 'Lilis Suryani'),
(384, '42421069', 'b66525a1f90691edf15a555918cb6816561785d9', 'mhs', 'M. Noval Najib'),
(385, '42421070', 'dfa19ebfaedf1b545aea0a4791085124ba525e38', 'mhs', 'M. Yusuf Al Qaradlawi'),
(386, '42421071', '67f22467d829a254d53fa5cf019787c23c57bbef', 'mhs', 'Matien Hakim Falahudin Bachtiar'),
(387, '42321018', 'd630322e61e7bce85b6887c9a323e54429278c65', 'mhs', 'Naylu Syifa');

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
-- Struktur dari tabel `tbl_pertemuan`
--

CREATE TABLE `tbl_pertemuan` (
  `id_klsmatkul` int(11) NOT NULL,
  `validasi` varchar(1) NOT NULL,
  `tanggal` date NOT NULL,
  `pertemuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pertemuan`
--

INSERT INTO `tbl_pertemuan` (`id_klsmatkul`, `validasi`, `tanggal`, `pertemuan`) VALUES
(1, '1', '2024-03-17', 1),
(1, '1', '2024-03-24', 2),
(1, '0', '2024-03-31', 3);

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
(1, '42421065', 4),
(1, '42421066', 4),
(1, '42421067', 4),
(1, '42421068', 4),
(1, '42421069', 4),
(1, '42421070', 4),
(1, '42421071', 4),
(5, '42421071', 4),
(9, '42321018', 4),
(9, '42421057', 4),
(9, '42421059', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_presensi`
--

CREATE TABLE `tbl_presensi` (
  `id_klsmatkul` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nim` int(11) NOT NULL,
  `kehadiran` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_presensi`
--

INSERT INTO `tbl_presensi` (`id_klsmatkul`, `tanggal`, `nim`, `kehadiran`) VALUES
(1, '2024-03-17', 42321018, 'Y'),
(1, '2024-03-17', 42421065, 'Y'),
(1, '2024-03-17', 42421066, 'Y'),
(1, '2024-03-17', 42421067, 'Y'),
(1, '2024-03-17', 42421068, 'Y'),
(1, '2024-03-17', 42421069, 'Y'),
(1, '2024-03-17', 42421070, 'Y'),
(1, '2024-03-17', 42421071, 'Y'),
(1, '2024-03-24', 42421065, 'N'),
(1, '2024-03-24', 42421066, 'N'),
(1, '2024-03-24', 42421067, 'N'),
(1, '2024-03-24', 42421068, 'Y'),
(1, '2024-03-24', 42421069, 'N'),
(1, '2024-03-24', 42421070, 'N'),
(1, '2024-03-24', 42421071, 'Y'),
(1, '2024-03-31', 42421065, 'N'),
(1, '2024-03-31', 42421066, 'Y'),
(1, '2024-03-31', 42421067, 'N'),
(1, '2024-03-31', 42421068, 'Y'),
(1, '2024-03-31', 42421069, 'N'),
(1, '2024-03-31', 42421070, 'N'),
(1, '2024-03-31', 42421071, 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_temp_presensi`
--

CREATE TABLE `tbl_temp_presensi` (
  `id_klsmatkul` int(11) NOT NULL,
  `state` enum('Y','N') NOT NULL,
  `pertemuan_ke` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_temp_presensi`
--

INSERT INTO `tbl_temp_presensi` (`id_klsmatkul`, `state`, `pertemuan_ke`) VALUES
(1, 'Y', ''),
(9, 'Y', '');

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_matkul`
--
ALTER TABLE `tbl_matkul`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

--
-- AUTO_INCREMENT untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
