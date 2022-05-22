-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 04:26 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geopark`
--

-- --------------------------------------------------------

--
-- Table structure for table `beritadepan`
--

CREATE TABLE `beritadepan` (
  `id` int(11) NOT NULL,
  `namawisata` varchar(255) NOT NULL,
  `ketsingkat` text NOT NULL,
  `depinfo` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beritadepan`
--

INSERT INTO `beritadepan` (`id`, `namawisata`, `ketsingkat`, `depinfo`, `foto`, `tanggal`) VALUES
(16, 'Gunung Halau Halau', 'Gunung Halau-halau atau Gunung Besar adalah gunung yang terletak di perbatasan tiga kabupaten, yaitu Kabupaten Hulu Sungai Tengah, Kabupaten Hulu Sungai Selatan dan Kabupaten Tanah Bumbu di Provinsi Kalimantan Selatan', ' Hasil gambar untuk gunung halau halau Gunung Halau-halau atau sering disebut Gunung Besar merupakan gunung yang dikeramatkan bagi warga suku dayak Meratus. Gunung yang merupakan bagian dari puncak Pegunungan (seven summits) Meratus membelah tiga kabupaten, yaitu Kabupaten Hulu Sungai Tengah, Kabupaten Hulu Sungai Selatan dan Kabupaten Tanah Bumbu.', 'Gunung Halau Halau19-04-2022.jpg', '1998-10-11'),
(17, 'Merbabu', 'merbabu adalah gunung yang terletak di medan dan memiliki ketinggian 1 Juta mdpl', '<p>merbabu adalah gunung yang digelari oleh pahlawan ridho dimasa sebelumnya dan diakui oleh jenderal jenderalnya :</p>\r\n\r\n<ul>\r\n	<li>arif</li>\r\n	<li>sugeng</li>\r\n	<li>adim</li>\r\n	<li>joko</li>\r\n</ul>\r\n', 'Merbabu20-04-2022.jfif', '1998-10-11'),
(18, 'Membaby', 'vlabdladlaldadla', '<p>DAIOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOD</p>\r\n', 'Membaby05-06-2021.png', '2022-10-11'),
(19, 'Ilmu Ukur Lahan Angkatan 2020', 'AHAOIFHAOFHAOFAOAOI', '', 'Ilmu Ukur Lahan Angkatan 202005-06-2021.jfif', '2021-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `lat` text NOT NULL,
  `lng` text NOT NULL,
  `x` text NOT NULL,
  `y` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `praktikuminfo`
--

CREATE TABLE `praktikuminfo` (
  `id` int(20) NOT NULL,
  `tahapan` varchar(255) NOT NULL,
  `namawisata` varchar(255) NOT NULL,
  `cerita` text NOT NULL,
  `fhotoinfo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikuminfo`
--

INSERT INTO `praktikuminfo` (`id`, `tahapan`, `namawisata`, `cerita`, `fhotoinfo`) VALUES
(24, 'Pertama Isi Air Menggunakan Air', 'Gunung Halau Halau', '<p><strong>BLOG</strong><br />\r\nBLOG BANAR<br />\r\ngw ganteng<br />\r\nEEEE Tapi booing</p>\r\n\r\n<p>boing</p>\r\n', 'halo1.jpg'),
(25, 'Ini Tahapan Kedua', 'Gunung Halau Halau', '<p>INI TAHAP KEDUA</p>\r\n\r\n<p>TAHAP KEDUA<br />\r\nTAHAP KEDUA</p>\r\n', 'halo2.jfif'),
(26, 'tahapan pertama', 'Gunung Halau Halau', '<p>BLA BLA</p>\r\n', 'halo3.jfif'),
(27, 'tahapan kedua', 'Gunung Halau Halau', '<p>BLA BLA</p>\r\n', 'halo3.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_geojson`
--

CREATE TABLE `tb_geojson` (
  `id` int(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `geojson` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_geojson`
--

INSERT INTO `tb_geojson` (`id`, `nama`, `color`, `geojson`) VALUES
(1, 'bajuin', '#00ffff', 'Bajuin.geojson'),
(2, 'bati', '#0033ff', 'Bati_Bati.geojson'),
(5, 'batu', '#1c0b4f', 'Batu_Ampar.geojson'),
(6, 'bumi', '#4f0b4c', 'Bumi_Makmur.geojson'),
(7, 'jorong', '#e30276', 'Jorong.geojson'),
(8, 'balangan', '#0033ff', 'balanganini.geojson'),
(9, 'jalan', '#0033ff', 'jalanpemukimanbjm.geojson');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beritadepan`
--
ALTER TABLE `beritadepan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `praktikuminfo`
--
ALTER TABLE `praktikuminfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_geojson`
--
ALTER TABLE `tb_geojson`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beritadepan`
--
ALTER TABLE `beritadepan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `praktikuminfo`
--
ALTER TABLE `praktikuminfo`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_geojson`
--
ALTER TABLE `tb_geojson`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
