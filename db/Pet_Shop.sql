-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2015 at 12:18 AM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Pet Shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `Detail Transaksi`
--

CREATE TABLE IF NOT EXISTS `Detail Transaksi` (
  `ID Transaksi` int(11) NOT NULL,
  `Kode Produk` char(6) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  KEY `Kode Produk` (`Kode Produk`),
  KEY `ID Transaksi` (`ID Transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Jabatan`
--

CREATE TABLE IF NOT EXISTS `Jabatan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Konsumen`
--

CREATE TABLE IF NOT EXISTS `Konsumen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Alamat` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Pegawai`
--

CREATE TABLE IF NOT EXISTS `Pegawai` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  `ID Jabatan` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID Jabatan` (`ID Jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Pesanan`
--

CREATE TABLE IF NOT EXISTS `Pesanan` (
  `Kode Produk` char(6) NOT NULL,
  `ID Supplier` int(11) NOT NULL,
  KEY `Kode Barang` (`Kode Produk`,`ID Supplier`),
  KEY `ID Supplier` (`ID Supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Pesanan`
--

INSERT INTO `Pesanan` (`Kode Produk`, `ID Supplier`) VALUES
('BR-001', 1),
('JS-001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Produk`
--

CREATE TABLE IF NOT EXISTS `Produk` (
  `Kode` char(6) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Jenis` varchar(50) NOT NULL,
  `Harga` double NOT NULL,
  `Stok` int(11) NOT NULL,
  PRIMARY KEY (`Kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Produk`
--

INSERT INTO `Produk` (`Kode`, `Nama`, `Jenis`, `Harga`, `Stok`) VALUES
('BR-001', 'Briter Bunny', 'Barang', 43000, 10),
('JS-001', 'Grooming', 'Jasa', 50000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `Supplier`
--

CREATE TABLE IF NOT EXISTS `Supplier` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Supplier`
--

INSERT INTO `Supplier` (`ID`, `Nama`) VALUES
(1, 'Bonita'),
(2, 'Sarimi');

-- --------------------------------------------------------

--
-- Table structure for table `Transaksi`
--

CREATE TABLE IF NOT EXISTS `Transaksi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID Konsumen` int(11) NOT NULL,
  `Tanggal` datetime NOT NULL,
  `Total` double NOT NULL,
  `ID Pegawai` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID Konsumen` (`ID Konsumen`),
  KEY `ID Pegawai` (`ID Pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Detail Transaksi`
--
ALTER TABLE `Detail Transaksi`
  ADD CONSTRAINT `Detail Transaksi_ibfk_1` FOREIGN KEY (`Kode Produk`) REFERENCES `Produk` (`Kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Detail Transaksi_ibfk_2` FOREIGN KEY (`Kode Produk`) REFERENCES `Produk` (`Kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Detail Transaksi_ibfk_3` FOREIGN KEY (`ID Transaksi`) REFERENCES `Transaksi` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_B` FOREIGN KEY (`Kode Produk`) REFERENCES `Produk` (`Kode`);

--
-- Constraints for table `Pegawai`
--
ALTER TABLE `Pegawai`
  ADD CONSTRAINT `Pegawai_ibfk_1` FOREIGN KEY (`ID Jabatan`) REFERENCES `Jabatan` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Pesanan`
--
ALTER TABLE `Pesanan`
  ADD CONSTRAINT `Pesanan_ibfk_3` FOREIGN KEY (`Kode Produk`) REFERENCES `Produk` (`Kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Pesanan_ibfk_2` FOREIGN KEY (`ID Supplier`) REFERENCES `Supplier` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Transaksi`
--
ALTER TABLE `Transaksi`
  ADD CONSTRAINT `Transaksi_ibfk_2` FOREIGN KEY (`ID Pegawai`) REFERENCES `Pegawai` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Transaksi_ibfk_1` FOREIGN KEY (`ID Konsumen`) REFERENCES `Konsumen` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
