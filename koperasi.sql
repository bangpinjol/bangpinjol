-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2019 at 07:43 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','superadmin','user') NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `username`, `password`, `level`, `gambar`) VALUES
(3, 'M Zulfa Akbar', 'mzakbar', '$2y$10$gmdTHAlsq3XXuK69S8.NZ.Gb3Z5NSlfPSoo/LXyBWLhuBlyMAyVha', 'superadmin', 'img_5cc58b9517b19.jpg'),
(10, 'Rifan Alamsyah', 'F13nd', '$2y$10$LwT878UVy0g4o5ykCahqF.par0SNVQOfEeIW.0NbsxhJop5oo8Z/S', 'superadmin', 'img_5cc592137eadb.jpg'),
(15, 'Sinta Dianti', 'SintaD', '$2y$10$5oGCdQFi7PVurGBxDxcEwuBRTgawSiOAyEwgls3ucZmTjcS8qc1ae', 'admin', 'img_5cc5baf45c76f.jpg'),
(20, 'syarif', '1606109@sttgarut.ac.id', '$2y$10$EumkYf7kz/N.Wrg.IWk2ieNlh7vl.5u0dyFThyeavI92f71wXont.', 'user', 'img_5d0927d011da2.jpg'),
(21, 'Dina Nurdinah', '1606103@sttgarut.ac.id', '$2y$10$X5z4EqrIbIbU9b603Shr5e8xiM2b5NUV4k66ePXajCQEpqejgRS8u', 'user', 'img_5d0a5e12d3cf9.jpg'),
(22, 'sinta nurfatonah', '1606002@sttgarut.ac.id', '$2y$10$mc1Rnj6EF.Xyqfi7vHqU4.W/WyOem7QTob5DZMMJHKFQY9fugAxMq', 'user', 'img_5d0a61027417a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jk` enum('pria','wanita') NOT NULL,
  `tmp_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `penghasilan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nik`, `nama_anggota`, `foto`, `jk`, `tmp_lahir`, `tgl_lahir`, `alamat`, `no_telp`, `pekerjaan`, `penghasilan`) VALUES
(2, '1212121212121212', 'sinta dianti', 'img_5cc3f7d84a5cf.gif', 'wanita', 'garut', '1998-04-01', 'bayongbong garut', '089089089089', 'mahasiswa', '2000000'),
(3, '123123123123123', 'Rifan Alamsyah', 'img_5cc7f6c4dd26a.jpg', 'pria', 'Garut', '1997-06-02', 'Kp Sadang Sucinaraja Garut Jawabaran indonesia', '089699922923', 'Mahasiswa', '500000'),
(5, '1234', 'zul', 'img_5cd3dc9f7ba91.gif', 'pria', 'garut', '2019-05-02', 'garut', '07302', 'mahasiswa', '2000000'),
(9, '1234', 'syarif', 'img_5d0927d011da2.jpg', 'pria', 'garut', '1111-02-14', 'kaum', '089999999', 'mahasiswa', '2000000'),
(10, '123456789', 'Dina Nurdinah', 'img_5d0a5e12d3cf9.jpg', 'wanita', 'Garut', '2019-01-05', 'kp sukapadang tarogong kaler garut', '08989898989', 'mahasiswa', '12000000'),
(11, '123445', 'sinta nurfatonah', 'img_5d0a61027417a.jpg', 'wanita', 'garut', '1998-04-01', 'kadungora', '0899898989', 'mahasiswa', '1230000');

-- --------------------------------------------------------

--
-- Table structure for table `koperasi`
--

CREATE TABLE `koperasi` (
  `id_toko` int(11) NOT NULL,
  `nama_koperasi` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `bunga` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koperasi`
--

INSERT INTO `koperasi` (`id_toko`, `nama_koperasi`, `logo`, `bunga`) VALUES
(1, 'Sadang Maju', 'img_5ce9046a550fd.png', 15);

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `jml_pinjam` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `status` enum('lunas','belum dibayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`id_pinjam`, `id_anggota`, `jml_pinjam`, `tgl_pinjam`, `status`) VALUES
(5, 3, 700000, '2019-05-19', 'belum dibayar'),
(6, 2, 2000000, '2019-04-30', 'belum dibayar'),
(9, 9, 120000, '2019-06-05', 'lunas'),
(10, 11, 100000, '2019-06-20', 'belum dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `simpan`
--

CREATE TABLE `simpan` (
  `id_simpan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `jml_simpan` int(11) NOT NULL,
  `tgl_simpan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpan`
--

INSERT INTO `simpan` (`id_simpan`, `id_anggota`, `jml_simpan`, `tgl_simpan`) VALUES
(12, 3, 400000, '2019-04-22'),
(13, 2, 600000, '2019-04-15'),
(14, 2, 200000, '2019-05-06'),
(15, 2, 200000, '2019-03-12'),
(17, 9, 200000, '2019-06-21'),
(18, 11, 20000000, '2019-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `tarik`
--

CREATE TABLE `tarik` (
  `id_tarik` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `jml_tarik` int(11) NOT NULL,
  `tgl_tarik` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarik`
--

INSERT INTO `tarik` (`id_tarik`, `id_anggota`, `jml_tarik`, `tgl_tarik`) VALUES
(1, 2, 30000, '2019-04-26'),
(7, 3, 120000, '2019-04-23'),
(9, 9, 100000, '2019-06-18'),
(10, 11, 123000, '2019-06-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `koperasi`
--
ALTER TABLE `koperasi`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `jml_pinjam` (`jml_pinjam`),
  ADD KEY `jml_pinjam_2` (`jml_pinjam`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `simpan`
--
ALTER TABLE `simpan`
  ADD PRIMARY KEY (`id_simpan`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `tarik`
--
ALTER TABLE `tarik`
  ADD PRIMARY KEY (`id_tarik`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `koperasi`
--
ALTER TABLE `koperasi`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `simpan`
--
ALTER TABLE `simpan`
  MODIFY `id_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tarik`
--
ALTER TABLE `tarik`
  MODIFY `id_tarik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pinjam_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simpan`
--
ALTER TABLE `simpan`
  ADD CONSTRAINT `simpan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tarik`
--
ALTER TABLE `tarik`
  ADD CONSTRAINT `tarik_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
