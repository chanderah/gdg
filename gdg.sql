-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 16, 2022 at 03:32 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gdg`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_request_in`
--

CREATE TABLE `tb_request_in` (
  `id` int(11) NOT NULL,
  `dummy_id` varchar(255) NOT NULL,
  `no_sertif` varchar(255) DEFAULT NULL,
  `site_id` varchar(255) NOT NULL,
  `linked_with` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `the_insured` varchar(255) NOT NULL,
  `address_` varchar(255) NOT NULL,
  `destination_from` varchar(255) NOT NULL,
  `destination_to` varchar(255) NOT NULL,
  `sailing_date` varchar(255) NOT NULL,
  `amount_insured` varchar(255) DEFAULT NULL,
  `lampiran_BL` varchar(255) NOT NULL,
  `lampiran_LC` varchar(255) NOT NULL,
  `lampiran_invoice` varchar(255) NOT NULL,
  `lampiran_PL` varchar(255) NOT NULL,
  `lampiran_DO` varchar(255) NOT NULL,
  `conveyance` varchar(255) NOT NULL,
  `conveyance_type` varchar(255) NOT NULL,
  `conveyance_total` varchar(255) NOT NULL,
  `conveyance_policeno` varchar(255) NOT NULL,
  `conveyance_age` varchar(255) NOT NULL,
  `conveyance_driver` varchar(255) NOT NULL,
  `conveyance_ship_name` varchar(255) NOT NULL,
  `conveyance_ship_type` varchar(255) NOT NULL,
  `conveyance_ship_age` varchar(255) NOT NULL,
  `conveyance_ship_GRT` varchar(255) NOT NULL,
  `conveyance_plane_type` varchar(255) NOT NULL,
  `conveyance_plane_AWB` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_site_in`
--

CREATE TABLE `tb_site_in` (
  `id` int(11) NOT NULL,
  `dummy_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `site_id` varchar(255) NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `desa` varchar(255) DEFAULT NULL,
  `paket` varchar(255) DEFAULT NULL,
  `batch_` varchar(255) DEFAULT NULL,
  `ctrm` varchar(255) DEFAULT NULL,
  `ctsi` varchar(255) DEFAULT NULL,
  `amount_insured` varchar(255) DEFAULT NULL,
  `cmop` varchar(255) NOT NULL,
  `no_sertif` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `linked_with` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_site_in`
--

INSERT INTO `tb_site_in` (`id`, `dummy_id`, `created_at`, `site_id`, `region`, `provinsi`, `kabupaten`, `kecamatan`, `desa`, `paket`, `batch_`, `ctrm`, `ctsi`, `amount_insured`, `cmop`, `no_sertif`, `keterangan`, `linked_with`) VALUES
(1, 'AgcTLxRjuab719c3fca33fe577b4e93b068969166630f94972', '2022-02-14 16:30:41', 'JKT2022', 'Itaque proident occ', 'Rerum quis pariatur', 'Adipisci commodi con', 'Iusto nostrud debiti', 'Molestias laudantium', 'Excepturi molestiae ', 'Illum tempore tene', 'Consequatur Sunt f', 'Ut vitae qui volupta', '37', '0608032100003', NULL, '58 Site', ''),
(2, 'cGwnONXKCy258e09723384ce8148a6cda4e61c5577abf554d7', '2022-02-14 16:31:49', 'JKT2021', 'Eligendi nemo tempor', 'Molestiae nihil nece', 'Vel exercitationem d', 'Atque saepe asperior', 'Doloribus ratione do', 'Qui ea repellendus ', 'Molestias tempor fac', 'Magni tenetur natus ', 'Incididunt harum ea ', '69', '0608032100007', NULL, '236 Site', ''),
(3, 'ywYCgPSzpTd2b4bb6589efeb08ee3ee1c8743b4b3e778da537', '2022-02-14 16:32:41', 'JKT2020', 'Eligendi veritatis p', 'Est ea odit consequa', 'Dolore mollit est v', 'Eu itaque dicta elig', 'Dolorem vel eos quas', 'Eu voluptatem explic', 'Omnis velit laudanti', 'Deserunt sed fugiat ', 'Culpa exercitationem', '49', '0608032100006', NULL, '180 Site', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_site_items`
--

CREATE TABLE `tb_site_items` (
  `id` int(11) NOT NULL,
  `bill_id` varchar(100) NOT NULL,
  `dummy_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `count` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL,
  `site_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_site_out`
--

CREATE TABLE `tb_site_out` (
  `id` int(11) NOT NULL,
  `dummy_id` varchar(255) NOT NULL,
  `no_sertif` varchar(255) DEFAULT NULL,
  `site_id` varchar(255) NOT NULL,
  `linked_with` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `the_insured` varchar(255) NOT NULL,
  `address_` varchar(255) NOT NULL,
  `destination_from` varchar(255) NOT NULL,
  `destination_to` varchar(255) NOT NULL,
  `sailing_date` varchar(255) NOT NULL,
  `amount_insured` varchar(255) DEFAULT NULL,
  `lampiran_BL` varchar(255) NOT NULL,
  `lampiran_LC` varchar(255) NOT NULL,
  `lampiran_invoice` varchar(255) NOT NULL,
  `lampiran_PL` varchar(255) NOT NULL,
  `lampiran_DO` varchar(255) NOT NULL,
  `conveyance` varchar(255) NOT NULL,
  `conveyance_type` varchar(255) NOT NULL,
  `conveyance_total` varchar(255) NOT NULL,
  `conveyance_policeno` varchar(255) NOT NULL,
  `conveyance_age` varchar(255) NOT NULL,
  `conveyance_driver` varchar(255) NOT NULL,
  `conveyance_ship_name` varchar(255) NOT NULL,
  `conveyance_ship_type` varchar(255) NOT NULL,
  `conveyance_ship_age` varchar(255) NOT NULL,
  `conveyance_ship_GRT` varchar(255) NOT NULL,
  `conveyance_plane_type` varchar(255) NOT NULL,
  `conveyance_plane_AWB` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_upload_gambar_user`
--

CREATE TABLE `tb_upload_gambar_user` (
  `id` int(11) NOT NULL,
  `username_user` varchar(100) NOT NULL,
  `nama_file` varchar(220) NOT NULL,
  `ukuran_file` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_upload_gambar_user`
--

INSERT INTO `tb_upload_gambar_user` (`id`, `username_user`, `nama_file`, `ukuran_file`) VALUES
(1, 'zahidin', 'nopic5.png', '6.33'),
(2, 'test', 'nopic4.png', '6.33'),
(3, 'coba', 'logo_unsada1.jpg', '16.69'),
(4, 'admin', 'jis1.png', '16.36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(12) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `last_login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `last_login`) VALUES
(20, 'admin', 'admin@gmail.com', '$2y$10$3HNkMOtwX8X88Xb3DIveYuhXScTnJ9m16/rPDF1/VTa/VTisxVZ4i', 1, '16-03-2022 3:21'),
(22, 'user', 'user@gmail.com', '$2y$10$gl4HHqieIPcqQlHuahCf4OiBlC6pjxn85AYG.iRe6EqAn76GZGZCi', 0, '16-03-2022 1:22'),
(23, 'chanderah', 'chandrachansa@gmail.com', '$2y$10$lSmMczHY1JwRcoVegUVOlu8h/6s7Gjv9s/.uOdv7UdtMHVCDQPrNa', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_request_in`
--
ALTER TABLE `tb_request_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site_in`
--
ALTER TABLE `tb_site_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site_items`
--
ALTER TABLE `tb_site_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site_out`
--
ALTER TABLE `tb_site_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_upload_gambar_user`
--
ALTER TABLE `tb_upload_gambar_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_request_in`
--
ALTER TABLE `tb_request_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_site_in`
--
ALTER TABLE `tb_site_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_site_items`
--
ALTER TABLE `tb_site_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_site_out`
--
ALTER TABLE `tb_site_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_upload_gambar_user`
--
ALTER TABLE `tb_upload_gambar_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
