-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2021 at 05:31 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

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
(145, 'PLN', 'Malang', '2021-08-16', '09:49:14', 'Ade Ramadhana Pratama', 'RPL', 'image_1629082154.png'),
(146, 'PLN', 'Malang', '2021-08-15', '09:49:14', 'Ade Ramadhana Pratama', 'RPL', 'image_1629082154.png'),
(147, 'PLN', 'Malang', '2021-08-17', '21:07:49', 'Ade Ramadhana Pratama', 'RPL', 'image_1629209269.png'),
(148, 'PLN', 'Malang', '2021-09-02', '22:06:19', 'tes', 'RPL', 'image_1630595179.png'),
(149, 'PLN', 'Malang', '2021-09-20', '10:11:03', 'samsul', 'RPL', 'image_1632107463.png');

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
(7, 2021, 'Agustus', 0, 0, 2, 29);

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
(4, 'Berkas PKL', 'berkas_pkl.txt'),
(5, 'Tata Tertib', 'tata_tertib.docx');

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
(9, 'Anisa Istiqomah', 'anisa', 'guru'),
(10, 'Yustiana Amita Utama', 'yustiana', 'guru');

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
(10, 'Metro', 'Mekatronika'),
(11, 'Elin', 'Elektronika Industri');

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
(10, 32, 10, 9, 'Kegiatan', 'ade', '2021-09-20', '171111020_FRS.pdf');

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
(10, 90, 90, 90, 90, 90, 90, 0, 30, 1),
(11, 100, 100, 100, 100, 21, 32, 100, 31, 2),
(12, 100, 100, 100, 100, 100, 100, 0, 32, 1);

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
(40, '10', 'Selamat tempat pkl anda telah terkonfirmasi!', '32');

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
(4, 'Ganjil 2021', '2021-08-30', '2021-08-31', 1),
(6, 'Genap 2021', '2021-08-31', '2021-09-11', 1);

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
(1, 'SMKN 5 Malang', 'Jalan Piranha Atas', '205338171.png', 'Samsul - 081923', 1);

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
(29, 171111020, 'Ade Ramadhana Pratama', 'XI RPL B', 'RPL', 'sanade2034', 'bcd724d15cde8c47650fda962968f102', 'DSC_6609_edd2.jpg', 'L', 'saya seorang kapiten mantap jaya'),
(30, 0, 'tes', 'XI RPL B', 'RPL', 'tes', '28b662d883b6d76fd96e4ddc5e9ba780', 'man.png', 'L', ''),
(31, 21562516, 'sam', 'XI RPL B', 'RPL', 'sam', '332532dcfaa1cbf61e2a266bd723612c', 'man.png', 'L', ''),
(32, 12787312, 'samsul', 'XI RPL B', 'RPL', 'samsul', 'bcd724d15cde8c47650fda962968f102', 'man.png', 'L', 'Samsul');

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
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tempat_rekomendasi`
--

INSERT INTO `tb_tempat_rekomendasi` (`id_rekomendasi`, `nama_perusahaan`, `jurusan_perusahaan`, `visi`, `misi`, `alamat`, `foto`, `cp`, `user`, `pass`) VALUES
(9, 'Hummasoft', 'RPL', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Karangploso, Malang', 'ESJPvJlWAAIjbcU.jpg', 'Rizal 08932189', 'hummasoft', 'industri'),
(10, 'PLN', 'RPL, TKJ, Metro', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Malang', 'download.jpg', '768931', 'pln', 'industri'),
(11, 'Gojek', 'Metro, Elin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Blimbing, Malang', 'About_1_desktop.jpg', '67833', 'gojek', 'industri'),
(13, 'tes', 'RPL, TKJ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'tes', 'DSC_6609_edd.jpg', 'tes', 'tes', 'tes');

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
(23, 10, 9, 32, 6, 0);

-- --------------------------------------------------------

--
-- Structure for view `tb_kegiatan_view`
--
DROP TABLE IF EXISTS `tb_kegiatan_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tb_kegiatan_view`  AS  select `tb_kegiatan`.`id_kegiatan` AS `id_kegiatan`,`tb_kegiatan`.`id_siswa` AS `id_siswa`,`tb_kegiatan`.`id_rekomendasi` AS `id_rekomendasi`,`tb_kegiatan`.`nama_kegiatan` AS `nama_kegiatan`,`tb_kegiatan`.`deskripsi_kegiatan` AS `deskripsi_kegiatan`,`tb_kegiatan`.`tgl_kegiatan` AS `tgl_kegiatan`,`tb_kegiatan`.`bukti_kegiatan` AS `bukti_kegiatan`,`tb_siswa`.`nama_siswa` AS `nama_siswa`,`tb_siswa`.`user` AS `user_siswa`,`tb_tempat_rekomendasi`.`nama_perusahaan` AS `nama_perusahaan`,`tb_tempat_rekomendasi`.`user` AS `user_perusahaan`,`tb_guru`.`user` AS `user_guru` from ((((`tb_kegiatan` join `tb_siswa` on(`tb_siswa`.`id_siswa` = `tb_kegiatan`.`id_siswa`)) join `tb_tempat_rekomendasi` on(`tb_tempat_rekomendasi`.`id_rekomendasi` = `tb_kegiatan`.`id_rekomendasi`)) join `tb_tempat_siswa` on(`tb_tempat_siswa`.`id_rekomendasi` = `tb_tempat_rekomendasi`.`id_rekomendasi`)) join `tb_guru` on(`tb_guru`.`id_guru` = `tb_tempat_siswa`.`id_guru`)) ;

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
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `tb_absensi_manual`
--
ALTER TABLE `tb_absensi_manual`
  MODIFY `id_manual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_notif`
--
ALTER TABLE `tb_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_periode`
--
ALTER TABLE `tb_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_sementara`
--
ALTER TABLE `tb_sementara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_tempat_rekomendasi`
--
ALTER TABLE `tb_tempat_rekomendasi`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_tempat_siswa`
--
ALTER TABLE `tb_tempat_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
