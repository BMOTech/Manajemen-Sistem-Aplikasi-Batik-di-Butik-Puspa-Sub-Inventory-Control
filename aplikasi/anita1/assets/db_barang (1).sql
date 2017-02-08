-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2017 at 03:07 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kode_brg` varchar(10) NOT NULL,
  `serial` varchar(20) NOT NULL,
  `nama_brg` varchar(30) NOT NULL,
  `kode_kategori` varchar(10) NOT NULL,
  `detail_brg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_brg`, `serial`, `nama_brg`, `kode_kategori`, `detail_brg`) VALUES
('BR002', 'f 43 b', 'Samsung', 'KB003', 'Bagus'),
('BR013', '789', 'hjk', 'KB003', 'bagus');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE IF NOT EXISTS `barang_keluar` (
  `no_brgkeluar` varchar(10) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `username` varchar(10) NOT NULL,
  `jml_brg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`no_brgkeluar`, `tgl_keluar`, `username`, `jml_brg`) VALUES
('MK000001', '2013-01-28', 'admin', 3),
('MK000002', '2013-01-28', 'admin', 18),
('MK000003', '2016-09-26', 'admin', 5),
('MK000004', '2016-09-29', 'admin', 2),
('MK000005', '2016-09-30', 'admin', 1),
('MK000006', '2016-10-01', 'Nita', 5);

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE IF NOT EXISTS `barang_masuk` (
  `no_brgmasuk` varchar(10) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `kode_supp` varchar(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `jml_brg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`no_brgmasuk`, `tgl_masuk`, `kode_supp`, `username`, `jml_brg`) VALUES
('MK000001', '2013-01-25', 'SP001', 'olip', 2),
('MK000002', '2013-01-25', 'SP002', 'olip', 3),
('MK000003', '2013-01-25', 'SP001', 'olip', 19),
('MK000004', '2013-01-03', 'SP001', 'admin', 20),
('MK000005', '2013-01-02', 'SP001', 'admin', 5),
('MK000006', '2013-01-08', 'SP001', 'admin', 12),
('MK000007', '2016-09-26', 'SP001', 'admin', 6),
('MK000008', '2016-09-26', 'SP002', 'admin', 7),
('MK000009', '2016-09-29', 'SP001', 'admin', 5),
('MK000010', '2016-09-29', 'SP001', 'admin', 5),
('MK000011', '2016-09-30', 'SP001', 'admin', 2),
('MK000012', '2016-10-01', 'SP002', 'Nita', 8);

-- --------------------------------------------------------

--
-- Table structure for table `detail_brgkeluar`
--

CREATE TABLE IF NOT EXISTS `detail_brgkeluar` (
`id_detail` int(11) NOT NULL,
  `no_brgkeluar` varchar(10) NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `jml_brg` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_brgkeluar`
--

INSERT INTO `detail_brgkeluar` (`id_detail`, `no_brgkeluar`, `kode_brg`, `jml_brg`) VALUES
(1, 'MK000001', 'BR001', 1),
(2, 'MK000001', 'BR002', 2),
(3, 'MK000002', 'BR001', 8),
(4, 'MK000002', 'BR002', 10),
(5, 'MK000003', 'BR006', 5),
(6, 'MK000004', 'BR002', 2),
(7, 'MK000005', 'BR010', 1),
(8, 'MK000006', 'BR002', 5),
(9, 'Mk3121', 'BR212', 30),
(10, 'mk919910', 'BR212', 100),
(11, 'mk919910', 'BR212', 22);

--
-- Triggers `detail_brgkeluar`
--
DELIMITER //
CREATE TRIGGER `barang_keluar` AFTER INSERT ON `detail_brgkeluar`
 FOR EACH ROW BEGIN
 UPDATE stok
 SET jml_brg = jml_brg - NEW.jml_brg
 WHERE
 kode_brg = NEW.kode_brg;
 END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_brgmasuk`
--

CREATE TABLE IF NOT EXISTS `detail_brgmasuk` (
`id_detail` int(11) NOT NULL,
  `no_brgmasuk` varchar(10) NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `jml_brg` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_brgmasuk`
--

INSERT INTO `detail_brgmasuk` (`id_detail`, `no_brgmasuk`, `kode_brg`, `jml_brg`) VALUES
(1, 'MK000001', 'BR001', 2),
(2, 'MK000002', 'BR001', 3),
(3, 'MK000003', 'BR003', 7),
(4, 'MK000003', 'BR001', 3),
(5, 'MK000003', 'BR002', 9),
(6, 'MK000004', 'BR001', 20),
(7, 'MK000005', 'BR001', 5),
(8, 'MK000006', 'BR006', 12),
(9, 'MK000007', 'BR006', 6),
(10, 'MK000008', 'BR007', 7),
(11, 'MK000009', 'BR002', 5),
(12, 'MK000010', 'BR002', 5),
(13, 'MK000011', 'BR010', 2),
(14, 'MK000012', 'BR002', 80),
(224, 'BRG90', 'BR212', 100),
(225, 'BRG91', 'BR212', 10),
(226, 'BRG92', 'BR212', 12);

--
-- Triggers `detail_brgmasuk`
--
DELIMITER //
CREATE TRIGGER `barang_masuk` AFTER INSERT ON `detail_brgmasuk`
 FOR EACH ROW BEGIN
 INSERT INTO stok SET
 kode_brg = NEW.kode_brg, jml_brg=New.jml_brg
 ON DUPLICATE KEY UPDATE jml_brg=jml_brg+New.jml_brg;
 END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_brg`
--

CREATE TABLE IF NOT EXISTS `kategori_brg` (
  `kode_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_brg`
--

INSERT INTO `kategori_brg` (`kode_kategori`, `nama_kategori`) VALUES
('KB001', 'PC'),
('KB002', 'Keyboard'),
('KB003', 'Printer'),
('KB004', 'Mouse'),
('KB005', 'Hub'),
('KB006', 'Modem'),
('KB007', 'Router'),
('KB008', 'PDT'),
('KB009', 'Keypad'),
('KB010', 'Aqua'),
('KD0928', 'Samsul');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
`id_pegawai` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `kode_brg` varchar(10) NOT NULL,
  `jml_brg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`kode_brg`, `jml_brg`) VALUES
('BR212', 100);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `kode_supp` varchar(10) NOT NULL,
  `nama_supp` varchar(30) NOT NULL,
  `alamat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supp`, `nama_supp`, `alamat`) VALUES
('SP002', 'PT Jaya Wijaya', 'Papua');

-- --------------------------------------------------------

--
-- Table structure for table `tmp`
--

CREATE TABLE IF NOT EXISTS `tmp` (
`id` int(11) NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`kode_brg`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
 ADD PRIMARY KEY (`no_brgkeluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
 ADD PRIMARY KEY (`no_brgmasuk`);

--
-- Indexes for table `detail_brgkeluar`
--
ALTER TABLE `detail_brgkeluar`
 ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `detail_brgmasuk`
--
ALTER TABLE `detail_brgmasuk`
 ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kategori_brg`
--
ALTER TABLE `kategori_brg`
 ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
 ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
 ADD PRIMARY KEY (`kode_brg`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
 ADD PRIMARY KEY (`kode_supp`);

--
-- Indexes for table `tmp`
--
ALTER TABLE `tmp`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_brgkeluar`
--
ALTER TABLE `detail_brgkeluar`
MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `detail_brgmasuk`
--
ALTER TABLE `detail_brgmasuk`
MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=227;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tmp`
--
ALTER TABLE `tmp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
