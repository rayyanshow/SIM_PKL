-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2022 at 11:36 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absen` int(11) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `jam` time NOT NULL DEFAULT current_timestamp(),
  `siswa` varchar(110) NOT NULL,
  `jurusan` varchar(10) NOT NULL,
  `foto` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id_absen`, `perusahaan`, `alamat`, `tanggal`, `jam`, `siswa`, `jurusan`, `foto`) VALUES
(155, 'Universitas Terbuka Malang', 'Malang', '2021-11-03', '10:13:53', 'dewi candra irene', 'TKJ', 'image_1635909233.png'),
(156, 'PLN', 'Malang', '2022-01-08', '12:53:02', 'ryan candra s ', 'TKJ', 'image_1641621182.png'),
(157, 'Universitas Terbuka Malang', 'Malang', '2022-01-10', '14:06:00', 'ryacan', 'TKJ', 'image_1641798360.png'),
(158, 'Universitas Terbuka Malang', 'Malang', '2022-01-10', '23:05:36', 'dewi candra irene', 'TKJ', 'image_1641830736.png'),
(159, 'Universitas Terbuka Malang', 'Malang', '2022-01-11', '13:23:55', 'AFIRA SEPTA DELLA PUTERI', 'TKJ', 'image_1641882235.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi_manual`
--

CREATE TABLE `tb_absensi_manual` (
  `id_manual` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `sakit` int(11) NOT NULL,
  `ijin` int(11) NOT NULL,
  `masuk` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_absensi_manual`
--

INSERT INTO `tb_absensi_manual` (`id_manual`, `tahun`, `bulan`, `sakit`, `ijin`, `masuk`, `id_siswa`) VALUES
(11, 2022, 'januari', 0, 0, 1, 67),
(12, 2022, '', 0, 0, 2, 67);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `user`, `pass`, `foto`, `level`) VALUES
(1, 'admin', 'admin', 'admin', 'man.png', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_berkas`
--

CREATE TABLE `tb_berkas` (
  `id_berkas` int(11) NOT NULL,
  `nama_berkas` varchar(100) NOT NULL,
  `file_berkas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_berkas`
--

INSERT INTO `tb_berkas` (`id_berkas`, `nama_berkas`, `file_berkas`) VALUES
(4, 'Buku Panduan ', 'BUKU_PANDUAN_LAPORAN_PKL.docx'),
(5, 'Buku Jurnal Kegiatan', 'BUKU_JURNAL_PKL.doc');

-- --------------------------------------------------------

--
-- Table structure for table `tb_chat`
--

CREATE TABLE `tb_chat` (
  `id_chat` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `kepada` varchar(100) NOT NULL,
  `tgl_chat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_chat`
--

INSERT INTO `tb_chat` (`id_chat`, `id_siswa`, `pesan`, `kepada`, `tgl_chat`) VALUES
(1, 56, 'halo', 'admin', '2022-01-15 11:50:00'),
(2, 56, 'yo', 'siswa', '2022-01-15 11:55:27'),
(3, 56, 'halo', 'admin', '2022-01-15 12:13:28'),
(4, 56, 'halo hao', 'admin', '2022-01-15 12:15:00'),
(5, 56, 'Tes', 'admin', '2022-01-15 12:17:27'),
(6, 56, 'halooo', 'admin', '2022-01-17 06:32:31'),
(7, 56, 'rrr', 'admin', '2022-01-17 06:33:28'),
(8, 56, 'tes', 'admin', '2022-01-17 09:04:43'),
(9, 56, 'tes', 'admin', '2022-01-18 07:27:45'),
(10, 56, 'teees', 'admin', '2022-01-18 07:27:51'),
(11, 56, 'iii', 'admin', '2022-01-18 07:30:24'),
(12, 56, 'XFXV', 'admin', '2022-01-18 07:35:55'),
(13, 56, 'e', 'admin', '2022-01-18 07:37:28'),
(14, 56, 'r', 'admin', '2022-01-18 07:39:30'),
(15, 56, 'r', 'admin', '2022-01-18 07:39:35'),
(16, 56, 'r', 'admin', '2022-01-18 07:40:26'),
(17, 56, 'vv', 'admin', '2022-01-18 07:41:08'),
(18, 56, 'b', 'admin', '2022-01-18 07:42:32'),
(19, 56, 'tt', 'admin', '2022-01-18 07:46:24'),
(20, 56, 'fff', 'siswa', '2022-01-18 07:47:08'),
(21, 56, 'halo', 'admin', '2022-01-18 07:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nama`, `user`, `pass`) VALUES
(1, 'guru', 'guru', 'guru'),
(11, 'Dewi Yuda Ningrat, S.Pd', 'DEWI', 'DEWI');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_singkat` varchar(100) NOT NULL,
  `nama_panjang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `nama_singkat`, `nama_panjang`) VALUES
(8, 'RPL', 'Rekayasa Perangkat Lunak'),
(9, 'TKJ', 'Teknik Komputer dan Jaringan'),
(10, 'MM', 'Multimedia'),
(11, 'KPR', 'Keperawatan'),
(13, 'ANIMASI', 'Animasi'),
(14, 'TSM', 'Teknik Sepeda Motor'),
(15, 'TKR', 'Teknik Kendaraan Ringan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_rekomendasi` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `nama_kegiatan` varchar(200) NOT NULL,
  `deskripsi_kegiatan` varchar(255) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `bukti_kegiatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id_kegiatan`, `id_siswa`, `id_rekomendasi`, `id_guru`, `nama_kegiatan`, `deskripsi_kegiatan`, `tgl_kegiatan`, `bukti_kegiatan`) VALUES
(6, 29, 10, 9, 'Kegiatan 1', 'adeeda', '2021-09-02', 'test.docx'),
(7, 29, 10, 9, 'Kegiatan 2', 'deadea', '2021-09-02', 'test_(1).docx'),
(8, 30, 10, 1, 'Kegiatan 1', 'deadea', '2021-09-02', 'test1.docx'),
(9, 31, 10, 9, 'Kegiatan', 'deadea', '2021-09-02', 'test_(1)1.docx'),
(10, 32, 10, 1, 'laporan', 'laporan pkl minggu ke 2', '2021-09-08', 'Akar_panjang.docx'),
(11, 32, 10, 1, 'jurnal kegiatan', 'jurnal kegiatan minggu pertama sampai minggu ke 4', '2021-10-15', 'test11.docx'),
(12, 60, 16, 12, 'laporan', 'laporan minggu ke 1', '2021-11-10', 'BUKU_PANDUAN_LAPORAN_PKL.docx'),
(13, 63, 16, 1, 'cobaa', 'cobabuatkompree', '2022-01-10', '171111062_Kartu_Konsultasi_TA.pdf'),
(14, 66, 16, 11, 'laporan', 'laporan pkl minggu ke 2', '2022-01-10', 'toefl.pdf'),
(15, 67, 16, 11, 'coba', 'coba kompre', '2022-01-11', 'ryan_candra_s_171111062(kk).pdf');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tb_kegiatan_view`
-- (See below for the actual view)
--
CREATE TABLE `tb_kegiatan_view` (
`id_kegiatan` int(11)
,`id_siswa` int(11)
,`id_rekomendasi` int(11)
,`nama_kegiatan` varchar(200)
,`deskripsi_kegiatan` varchar(255)
,`tgl_kegiatan` date
,`bukti_kegiatan` varchar(100)
,`nama_siswa` varchar(100)
,`user_siswa` varchar(100)
,`nama_perusahaan` varchar(100)
,`user_perusahaan` varchar(50)
,`user_guru` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `kerajinan` int(100) NOT NULL,
  `prestasi` int(100) NOT NULL,
  `disiplin` int(100) NOT NULL,
  `kerjasama` int(100) NOT NULL,
  `inisiatif` int(100) NOT NULL,
  `tanggung_jawab` int(100) NOT NULL,
  `ujian_prakerin` int(100) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `status_nilai_industri` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `kerajinan`, `prestasi`, `disiplin`, `kerjasama`, `inisiatif`, `tanggung_jawab`, `ujian_prakerin`, `id_siswa`, `status_nilai_industri`) VALUES
(9, 90, 90, 90, 90, 90, 90, 100, 29, 2),
(10, 90, 90, 90, 90, 90, 90, 85, 30, 2),
(11, 100, 100, 100, 100, 21, 32, 100, 31, 2),
(12, 66, 65, 66, 65, 65, 65, 0, 32, 1),
(13, 90, 75, 80, 70, 65, 60, 86, 60, 2),
(14, 80, 90, 80, 85, 70, 87, 88, 66, 2),
(15, 88, 77, 60, 67, 66, 80, 9999, 67, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_notif`
--

CREATE TABLE `tb_notif` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `id_siswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_notif`
--

INSERT INTO `tb_notif` (`id`, `nama_perusahaan`, `pesan`, `id_siswa`) VALUES
(36, '10', 'Selamat tempat pkl anda telah terkonfirmasi!', '29'),
(38, '10', 'Selamat tempat pkl anda telah terkonfirmasi!', '30'),
(39, '10', 'Selamat tempat pkl anda telah terkonfirmasi!', '31'),
(40, '10', 'Selamat tempat pkl anda telah terkonfirmasi!', '32'),
(41, '10', 'Selamat tempat pkl anda telah terkonfirmasi!', '35'),
(42, '10', 'Selamat tempat pkl anda telah terkonfirmasi!', '37'),
(43, '10', 'Selamat tempat pkl anda telah terkonfirmasi!', '38'),
(44, '16', 'Selamat tempat pkl anda telah terkonfirmasi!', '49'),
(45, '16', 'Selamat tempat pkl anda telah terkonfirmasi!', '51'),
(46, '10', 'Selamat tempat pkl anda telah terkonfirmasi!', '53'),
(48, '16', 'Selamat tempat pkl anda telah terkonfirmasi!', '60'),
(49, '16', 'Selamat tempat pkl anda telah terkonfirmasi!', '63'),
(50, '16', 'Selamat tempat pkl anda telah terkonfirmasi!', '64'),
(51, '16', 'Selamat tempat pkl anda telah terkonfirmasi!', '65'),
(52, '16', 'Selamat tempat pkl anda telah terkonfirmasi!', '66'),
(53, '16', 'Selamat tempat pkl anda telah terkonfirmasi!', '67'),
(55, '', 'kamu memiliki pesan baru', '56');

-- --------------------------------------------------------

--
-- Table structure for table `tb_periode`
--

CREATE TABLE `tb_periode` (
  `id_periode` int(11) NOT NULL,
  `periode` varchar(100) NOT NULL,
  `tgl_start` date NOT NULL,
  `tgl_end` date NOT NULL,
  `status_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_periode`
--

INSERT INTO `tb_periode` (`id_periode`, `periode`, `tgl_start`, `tgl_end`, `status_periode`) VALUES
(13, 'Genap 2021', '2021-10-18', '2022-01-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sekolah`
--

CREATE TABLE `tb_sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `alamat_sekolah` varchar(250) NOT NULL,
  `logo_sekolah` varchar(100) NOT NULL,
  `cp_sekolah` varchar(50) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sekolah`
--

INSERT INTO `tb_sekolah` (`id_sekolah`, `nama_sekolah`, `alamat_sekolah`, `logo_sekolah`, `cp_sekolah`, `id_admin`) VALUES
(1, 'SMKN 11 Malang', 'Jl. Pelabuhan Bakahuni No.1, Bakalankrajan, Kec. Sukun, Kota Malang, Jawa Timur 65148', 'download_(1).png', 'cak ndik ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sementara`
--

CREATE TABLE `tb_sementara` (
  `id` int(11) NOT NULL,
  `id_rekomendasi` int(11) NOT NULL,
  `nama_pimpinan` varchar(100) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `jurusan_perusahaan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `cp` varchar(100) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `status_pkl` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `jurusan` varchar(5) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `jk` enum('P','L') NOT NULL,
  `diskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama_siswa`, `kelas`, `jurusan`, `user`, `pass`, `foto`, `jk`, `diskripsi`) VALUES
(56, 123456789, 'ryan candra s ', 'XI TKJ 1', 'TKJ', 'ryan', '10c7ccc7a4f0aff03c915c485565b9da', 'man.png', 'L', 'ryan candra s\r\n087859144759'),
(63, 333, 'ryacan', 'XI TKJ 1', 'TKJ', 'ryacan', '923ddac3c7aa448215b3576783ed7fa5', 'man.png', 'L', ''),
(67, 2147483647, 'AFIRA SEPTA DELLA PUTERI', 'XI TKJ 1', 'TKJ', 'afira', '3dfb76f1750c4f4af6821d8c7e5179ce', 'man.png', 'P', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tampung`
--

CREATE TABLE `tb_tampung` (
  `id` int(11) NOT NULL,
  `kepada` varchar(100) NOT NULL,
  `id_siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tempat_rekomendasi`
--

CREATE TABLE `tb_tempat_rekomendasi` (
  `id_rekomendasi` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `jurusan_perusahaan` varchar(100) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `cp` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nama_pimpinan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tempat_rekomendasi`
--

INSERT INTO `tb_tempat_rekomendasi` (`id_rekomendasi`, `nama_perusahaan`, `jurusan_perusahaan`, `visi`, `misi`, `alamat`, `foto`, `cp`, `user`, `pass`, `nama_pimpinan`) VALUES
(10, 'PLN', 'RPL, TKJ', '“Menjadi Penyedia Jasa Inspeksi, Pengujian dan Sertifikasi Terkemuka se-Asia Tenggara dan #1 Pilihan Pelanggan di Bidang Ketengalistrikan.', 'Misi PT PLN (Persero) Pusat Sertifikasi sesuai Peraturan Direksi PT PLN (Persero) No. 1554.P/DIR/2018 tentang Susunan Organisasi dan Formasi Jabatan PT PLN (Persero) Pusat Sertifikasi adalah sebagai berikut:\r\n\r\nMenjalankan bisnis Sertifikasi di bidang ketenagalistrikan yang meliputi Sertifikasi Produk, Sistem Manajemen Mutu, Lingkungan, K3 dan Sertifikasi Kelaikan Instalasi (Inspeksi Teknik) secara baik sesuai standar/ketentuan yang berlaku dengan kaidah bisnis yang sehat guna menjamin keberadaan dan pengembangannya dengan moto faster, better, and competitive;', 'Malang', 'download.jpg', '768931', 'pln', 'industri', 'Zulkifli Zaini'),
(11, 'Gojek', 'RPL, TKJ, MM, ANIMASI, TSM, TKR', '“Membantu memperbaiki struktur transportasi di Indonesia, memberikan kemudahan bagi masyarakat dalam melaksanakan pekerjaan sehari-hari seperti pengiriman dokumen, belanja harian, dengan menggunakan layanan fasilitas kurir, serta turut mensejahterakan kehidupan tukang ojek di Jakarta dan Indonesia kedepannya”', '1.Menjadikan PT Go-Jek Indonesia sebagai jasa transportasi tercepat dalam melayani kebutuhan masyarakat Indonesia.\r\n2.Menjadikan PT Go-Jek Indonesia sebagai acuan pelaksanaan kepatuhan dan tata kelola struktur transportasi yang baik dengan menggunakan kemajuan teknologi.', 'Blimbing, Malang', 'About_1_desktop.jpg', '67833', 'gojek', 'industri', 'Kevin Aluwi dan Andre Soelistyo'),
(16, 'Universitas Terbuka Malang', 'RPL, TKJ', '“Menjadi perguruan tinggi terbuka dan jarak jauh (PTTJJ) berkualitas dunia”.', '1. menyediakan akses pendidikan tinggi yang berkualitas dunia bagi semua lapisan masyarakat melalui penyelenggaraan berbagai program PTTJJ untuk menghasilkan lulusan yang berdaya saing tinggi;', 'Malang', 'download.png', '034123456789', 'UPBJJ', 'UPBJJ', 'Dr.Lilik Sulistyowati,M.Si');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tempat_siswa`
--

CREATE TABLE `tb_tempat_siswa` (
  `id` int(11) NOT NULL,
  `id_rekomendasi` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `status_pkl` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tempat_siswa`
--

INSERT INTO `tb_tempat_siswa` (`id`, `id_rekomendasi`, `id_guru`, `id_siswa`, `id_periode`, `status_pkl`) VALUES
(20, 10, 9, 29, 4, 0),
(21, 10, 1, 30, 4, 0),
(22, 10, 9, 31, 6, 0),
(23, 10, 1, 32, 6, 0),
(24, 10, 1, 35, 6, 0),
(25, 10, 1, 37, 6, 0),
(26, 10, 1, 38, 6, 0),
(27, 16, 11, 49, 4, 0),
(28, 16, 1, 51, 4, 0),
(29, 10, 1, 53, 4, 0),
(30, 10, 1, 56, 13, 0),
(31, 16, 12, 60, 14, 0),
(32, 16, 1, 63, 13, 0),
(33, 16, 1, 64, 13, 0),
(34, 16, 11, 65, 13, 0),
(35, 16, 11, 66, 13, 0),
(36, 16, 11, 67, 13, 0);

-- --------------------------------------------------------

--
-- Structure for view `tb_kegiatan_view`
--
DROP TABLE IF EXISTS `tb_kegiatan_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_kegiatan_view`  AS SELECT `tb_kegiatan`.`id_kegiatan` AS `id_kegiatan`, `tb_kegiatan`.`id_siswa` AS `id_siswa`, `tb_kegiatan`.`id_rekomendasi` AS `id_rekomendasi`, `tb_kegiatan`.`nama_kegiatan` AS `nama_kegiatan`, `tb_kegiatan`.`deskripsi_kegiatan` AS `deskripsi_kegiatan`, `tb_kegiatan`.`tgl_kegiatan` AS `tgl_kegiatan`, `tb_kegiatan`.`bukti_kegiatan` AS `bukti_kegiatan`, `tb_siswa`.`nama_siswa` AS `nama_siswa`, `tb_siswa`.`user` AS `user_siswa`, `tb_tempat_rekomendasi`.`nama_perusahaan` AS `nama_perusahaan`, `tb_tempat_rekomendasi`.`user` AS `user_perusahaan`, `tb_guru`.`user` AS `user_guru` FROM ((((`tb_kegiatan` join `tb_siswa` on(`tb_siswa`.`id_siswa` = `tb_kegiatan`.`id_siswa`)) join `tb_tempat_rekomendasi` on(`tb_tempat_rekomendasi`.`id_rekomendasi` = `tb_kegiatan`.`id_rekomendasi`)) join `tb_tempat_siswa` on(`tb_tempat_siswa`.`id_rekomendasi` = `tb_tempat_rekomendasi`.`id_rekomendasi`)) join `tb_guru` on(`tb_guru`.`id_guru` = `tb_tempat_siswa`.`id_guru`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `tb_absensi_manual`
--
ALTER TABLE `tb_absensi_manual`
  ADD PRIMARY KEY (`id_manual`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_berkas`
--
ALTER TABLE `tb_berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `tb_chat`
--
ALTER TABLE `tb_chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tb_notif`
--
ALTER TABLE `tb_notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `tb_sementara`
--
ALTER TABLE `tb_sementara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tb_tampung`
--
ALTER TABLE `tb_tampung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tempat_rekomendasi`
--
ALTER TABLE `tb_tempat_rekomendasi`
  ADD PRIMARY KEY (`id_rekomendasi`);

--
-- Indexes for table `tb_tempat_siswa`
--
ALTER TABLE `tb_tempat_siswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `tb_absensi_manual`
--
ALTER TABLE `tb_absensi_manual`
  MODIFY `id_manual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_berkas`
--
ALTER TABLE `tb_berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_chat`
--
ALTER TABLE `tb_chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_notif`
--
ALTER TABLE `tb_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_periode`
--
ALTER TABLE `tb_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_sementara`
--
ALTER TABLE `tb_sementara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tb_tampung`
--
ALTER TABLE `tb_tampung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_tempat_rekomendasi`
--
ALTER TABLE `tb_tempat_rekomendasi`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_tempat_siswa`
--
ALTER TABLE `tb_tempat_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
