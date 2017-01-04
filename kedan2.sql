-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2017 at 05:12 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kedan`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `img_brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `brand`, `img_brand`) VALUES
(1, 'Kaos Medan Bah', '\\kedan\\img\\brand-logo'),
(2, 'Maidani', '\\kedan\\img\\brand-logo'),
(3, 'Ulos', '\\kedan\\img\\brand-logo'),
(4, 'Kaiu', '\\kedan\\img\\brand-logo'),
(5, 'Medan Napoleon', '\\kedan\\img\\brand-logo'),
(6, 'Gasbilo', '\\kedan\\img\\brand-logo'),
(7, 'tumpeng medan', '\\kedan\\img\\brand-logo'),
(8, 'Pawica', '\\kedan\\img\\brand-logo');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nm_kategori` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nm_kategori`, `parent`) VALUES
(1, 'Fashion Wanita', 0),
(2, 'Fashion Pria', 0),
(3, 'Rumah & Dekorasi', 0),
(4, 'Makanan', 0),
(5, 'Baju', 1),
(6, 'Celana', 1),
(7, 'Sepatu', 1),
(8, 'Baju', 2),
(9, 'Celana', 2),
(10, 'Sepatu', 2),
(19, 'jajanan', 4),
(20, 'Hiasan Dinding', 3),
(21, 'aksesoris', 2),
(22, 'aksesoris', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nm_produk` varchar(225) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `list_harga` decimal(10,0) DEFAULT NULL,
  `brand` int(11) NOT NULL,
  `produk_kategori` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `ukuran` text NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nm_produk`, `harga`, `list_harga`, `brand`, `produk_kategori`, `image`, `deskripsi`, `featured`, `ukuran`, `deleted`) VALUES
(1, 'Baju Ulos', '565000', '499000', 3, '5', '\\kedan\\img\\product\\bajuulos.jpg', 'baju ulos asli batak ini memiliki desain dan corak khas yang membuat sisapa saja menggunakannya terasa seperti muda lagi.... ', 1, 'S:5,M:2,L:7,XL:1', 0),
(2, 'Kaos Medan Bah 2', '65000', '50000', 1, '8', '/kedan/img/product/medansekitar.jpg', 'Baju yang terbuat dari bahan cotton lebut dan nyaman digunakan desain trendi dan gokillll. wajib coba deh....', 1, 'S:4,M:5,L:6,XL:3', 0),
(3, 'Bolu Napoleon', '75000', '70000', 5, '19', '/kedan/img/product/napoleon.jpg', 'bolu khas medan yang kekinian enak banget dan gak nyesel deh', 1, '', 0),
(4, 'Nasi Tumpeng', '250000', NULL, 7, '19', '/kedan/img/product/barnes.jpg', 'nasi tumpeng yang enak ini cocok disajikan untuk acara keluarga ataupun peresmian suatu gedung', 1, '', 0),
(5, 'Jam Customm Wood', '90000', NULL, 8, '21', '/kedan/img/product/pawica.jpg', 'jam dinding handycraft dari kayu ini cocok  untuk ruang tamu anda yang sederhana dan menawan..........', 0, '', 0),
(6, 'Dodol Pulut Ria', '15000', NULL, 9, '19', '/kedan/img/product/dodolria.jpg', 'dodol bengkel yang enak, nyum nyum nyum', 0, '', 0),
(7, 'makannana halal', '5', '5', 5, '19', '/kedan/img/product/66ebc533392c6a8a0377fab6b9d6a663.jpg', '&lt;b&gt;makanan halal bold&lt;/b&gt;&lt;br&gt;\r\n&lt;i&gt;makanan halal italic&lt;/i&gt;    					            			', 0, 'sedang:5,', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
