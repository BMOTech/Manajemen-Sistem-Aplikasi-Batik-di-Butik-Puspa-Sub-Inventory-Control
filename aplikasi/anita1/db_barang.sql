-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31 Jan 2017 pada 02.11
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_brg` varchar(10) NOT NULL,
  `serial` varchar(20) NOT NULL,
  `nama_brg` varchar(30) NOT NULL,
  `kode_kategori` varchar(10) NOT NULL,
  `detail_brg` text NOT NULL,
  `file` varchar(45) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_brg`, `serial`, `nama_brg`, `kode_kategori`, `detail_brg`, `file`, `type`) VALUES
('BR01323618', 'SN6182001323', 'Jas ket', 'KD136273', 'KD136273', 'file_1484971588.jpg', 'image/jpeg'),
('BR83236589', 'SN58983236', 'Baju batik', 'KD136273', 'jjkakakka', 'file_1483846355.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `no_brgkeluar` varchar(10) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `username` varchar(10) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `jml_brg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`no_brgkeluar`, `tgl_keluar`, `username`, `kode_brg`, `jml_brg`) VALUES
('MK01468151', '2017-01-30', 'admin', 'BR83236589', 18),
('MK03406717', '2017-01-30', 'admin', 'BR01323618', 51);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `no_brgmasuk` varchar(10) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `kode_supp` varchar(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `jml_brg` int(11) NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `rak` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`no_brgmasuk`, `tgl_masuk`, `kode_supp`, `username`, `jml_brg`, `kode_brg`, `rak`) VALUES
('MK02418122', '2017-01-31', '0', 'admin', 10, 'BR83236589', 'RK148'),
('MK03456252', '2017-01-30', '0', 'admin', 20, 'BR83236589', ''),
('MK12451318', '2017-01-30', '0', 'admin', 50, 'BR01323618', ''),
('MK13402326', '2017-01-30', '0', 'admin', 10, 'BR83236589', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_brgkeluar`
--

CREATE TABLE `detail_brgkeluar` (
  `id_detail` int(11) NOT NULL,
  `no_brgkeluar` varchar(10) NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `jml_brg` int(11) NOT NULL,
  `rak` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_brgkeluar`
--

INSERT INTO `detail_brgkeluar` (`id_detail`, `no_brgkeluar`, `kode_brg`, `jml_brg`, `rak`) VALUES
(1, 'MK000001', 'BR001', 1, ''),
(2, 'MK000001', 'BR002', 2, ''),
(3, 'MK000002', 'BR001', 8, ''),
(4, 'MK000002', 'BR002', 10, ''),
(5, 'MK000003', 'BR006', 5, ''),
(6, 'MK000004', 'BR002', 2, ''),
(7, 'MK000005', 'BR010', 1, ''),
(8, 'MK000006', 'BR002', 5, ''),
(9, 'Mk3121', 'BR212', 30, ''),
(10, 'mk919910', 'BR212', 100, ''),
(11, 'mk919910', 'BR212', 22, ''),
(12, 'MK01224102', 'BR83236589', 15, ''),
(13, 'mk919910', 'BR212', 0, ''),
(14, 'mk919910', 'BR212', 30, ''),
(15, 'mk91991023', 'BR2122', 30, ''),
(16, 'MK12345182', 'BR01323618', 20, ''),
(17, 'MK23416182', 'BR83236589', 20, ''),
(18, 'MK12415111', 'BR01323618', 51, ''),
(19, 'MK12311162', 'BR01323618', 46, ''),
(20, 'MK03406717', 'BR01323618', 51, ''),
(21, 'MK01468151', 'BR83236589', 18, '');

--
-- Trigger `detail_brgkeluar`
--
DELIMITER $$
CREATE TRIGGER `barang_keluar` AFTER INSERT ON `detail_brgkeluar` FOR EACH ROW BEGIN
 UPDATE stok
 SET jml_brg = GREATEST(0,jml_brg - NEW.jml_brg)
 WHERE
 kode_brg = NEW.kode_brg;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_brgmasuk`
--

CREATE TABLE `detail_brgmasuk` (
  `id_detail` int(11) NOT NULL,
  `no_brgmasuk` varchar(10) NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `jml_brg` int(11) NOT NULL,
  `rak` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_brgmasuk`
--

INSERT INTO `detail_brgmasuk` (`id_detail`, `no_brgmasuk`, `kode_brg`, `jml_brg`, `rak`) VALUES
(229, 'MK00000111', 'BR2122', 20, 'RK13300'),
(238, 'BRG90wert', 'BR2122', 40, 'RK13300'),
(239, 'MK13421242', 'BR01323618', 30, 'RK001'),
(240, 'MK03420222', 'BR01323618', 50, 'rk002'),
(241, 'MK23414161', 'BR01323618', 20, ''),
(242, 'MK02412192', 'BR01323618', 46, ''),
(243, 'MK01359172', 'BR83236589', 25, ''),
(244, 'MK02314151', 'BR83236589', 40, ''),
(245, 'MK12451318', 'BR01323618', 50, 'rk88'),
(246, 'MK03456252', 'BR83236589', 20, 'rk009'),
(247, 'MK13402326', 'BR83236589', 10, 'RK125'),
(248, 'MK02418122', 'BR83236589', 10, 'RK148');

--
-- Trigger `detail_brgmasuk`
--
DELIMITER $$
CREATE TRIGGER `barang_masuk` AFTER INSERT ON `detail_brgmasuk` FOR EACH ROW BEGIN
 INSERT INTO stok SET
 kode_brg = NEW.kode_brg, jml_brg=New.jml_brg, rak = NEW.rak
 ON DUPLICATE KEY UPDATE jml_brg=jml_brg+New.jml_brg;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_brg`
--

CREATE TABLE `kategori_brg` (
  `kode_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_brg`
--

INSERT INTO `kategori_brg` (`kode_kategori`, `nama_kategori`) VALUES
('KB003', 'kain'),
('KB004', 'Mouse'),
('KB005', 'Hub'),
('KB006', 'Modem'),
('KB007', 'Router'),
('KB008', 'PDT'),
('KB009', 'Keypad'),
('KB010', 'Aqua'),
('KB058', 'Sandal Batik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `level` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `username`, `password`, `level`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Aktif'),
(3, 'manajemen', '19b51f1cbb6146adcacbce46d5bdc3f2', 'management', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak`
--

CREATE TABLE `rak` (
  `kode_rak` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rak`
--

INSERT INTO `rak` (`kode_rak`, `nama`) VALUES
('RK125', 'Monkey'),
('RK136', 'Super alldie'),
('RK148', 'Rak Alldie');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `kode_brg` varchar(10) NOT NULL,
  `jml_brg` int(11) NOT NULL,
  `rak` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`kode_brg`, `jml_brg`, `rak`) VALUES
('BR01323618', 0, 'rk88'),
('BR83236589', 22, 'rk009');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `kode_supp` varchar(10) NOT NULL,
  `nama_supp` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`kode_supp`, `nama_supp`, `alamat`) VALUES
('0', 'PT. Suka Maju', 'Jl.suka mundur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp`
--

CREATE TABLE `tmp` (
  `id` int(11) NOT NULL,
  `kode_brg` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `serial` varchar(20) NOT NULL,
  `kode_kategori` varchar(20) NOT NULL,
  `nama_brg` varchar(20) NOT NULL,
  `detail_brg` varchar(20) NOT NULL,
  `file` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tmp`
--

INSERT INTO `tmp` (`id`, `kode_brg`, `jumlah`, `serial`, `kode_kategori`, `nama_brg`, `detail_brg`, `file`) VALUES
(1, 'BR83236589', 0, 'SN58983236', '0', 'Baju batik', 'KD136273', 'file1483917304.jpg'),
(2, 'BR83236589', 0, 'SN58983236', '0', 'Baju batik', 'KD136273', 'file1483917496.jpg'),
(3, 'BR83236589', 0, 'SN58983236', '0', 'Baju batik', 'KD136273', 'file1483917504.jpg'),
(4, 'BR83236589', 0, 'SN58983236', '0', 'Baju batik', 'KD136273', 'file1483917586.jpg');

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
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`kode_rak`);

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
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `detail_brgmasuk`
--
ALTER TABLE `detail_brgmasuk`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
