-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 03:09 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stflairsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dandt` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `username`, `password`, `dandt`) VALUES
(1, 'Moses Iliya', 'info@stflairsglobals.com', '123456', '2019-01-03 02:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime NOT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `description`, `image`, `date_time_created`, `date_time_updated`, `date_deleted`) VALUES
(1, 'Medals', 'StFlairs is a master in the art of crafting prestigious medals that embody achievement and honor. With meticulous attention to detail, each medal is a symbol of excellence and a testament to hard-earned success. Trust StFlairs to deliver medals that not only commemorate accomplishments, but also inspire future greatness. Elevate your recognition ceremonies with StFlairs\' distinguished collection of finely crafted medals. ', 'medal2.jpg', '2023-10-24 09:06:40', '2023-10-24 09:06:40', NULL),
(2, 'Crystals', 'StFlairs is renowned for its exquisite crystal awards, meticulously designed to capture the essence of achievement. These stunning creations refract light, illuminating success with a brilliance that is unmatched. Elevate your moments of triumph with StFlairs\' meticulously crafted crystal plaques, a testament to excellence that will be cherished for a lifetime. ', 'crystal1.jpg', '2023-10-24 09:09:14', '2023-10-24 09:09:14', NULL),
(3, 'Trophies', 'StFlairs is your go-to destination for exceptional trophies that symbolize triumph and accomplishment. With unparalleled craftsmanship, these trophies stand as gleaming testaments to dedication and excellence. Elevate your achievements with StFlairs\' diverse range of meticulously designed trophies, each one a testament to success and a cherished keepsake for the ages. ', 'trophy1.jpg', '2023-10-24 09:09:50', '2023-10-24 09:09:50', NULL),
(4, 'Plaques', 'Stflairs specializes in crafting exquisite award plaques. With precision and artistry, they transform moments of achievement into timeless mementos. Each plaque speaks volumes, embodying excellence and celebrating success. Trust StFlairs to turn milestones into beautifully crafted memories. ', 'plaue1.jpg', '2023-10-24 09:48:51', '2023-10-24 09:48:51', NULL),
(5, 'Lapel Pins', '', 'lapelpins1.jpg', '2023-10-24 09:52:28', '2023-10-24 09:52:28', NULL),
(6, 'Promotional Award', 'StFlairs excels in providing top-notch promotional products that leave a lasting impression. From customizable merchandise to innovative giveaways, every item is designed to elevate your brand\'s presence. With StFlairs, you can expect quality, creativity, and a touch of flair in every product. Transform your marketing efforts with StFlairs\' extensive range of promotional solutions, tailored to leave a lasting mark on your audience. ', 'noimageyet.jpg', '2023-10-24 09:54:32', '2023-10-24 09:54:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `org_profile`
--

CREATE TABLE `org_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `facebook_hndl` varchar(100) NOT NULL,
  `twitter_hndl` varchar(100) NOT NULL,
  `instagram_hndl` varchar(100) NOT NULL,
  `logo_url` varchar(50) NOT NULL,
  `main_message` varchar(100) NOT NULL,
  `sub_message` text NOT NULL,
  `footer_text` text NOT NULL,
  `description` text NOT NULL,
  `no_years` int(11) NOT NULL,
  `active_volunteers` int(11) NOT NULL,
  `avail_countries` int(11) NOT NULL,
  `people_helped` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_profile`
--

INSERT INTO `org_profile` (`id`, `name`, `phone`, `email`, `facebook_hndl`, `twitter_hndl`, `instagram_hndl`, `logo_url`, `main_message`, `sub_message`, `footer_text`, `description`, `no_years`, `active_volunteers`, `avail_countries`, `people_helped`) VALUES
(1, 'St Flairs Awards', '+2349161549328', 'info@stflairsglobals.org', '', '', '', 'logo.png', 'New hope for <br />near future', 'Your small contribution means a lot. We connect with people across different sectors. <br> We take risks and we always keep learning..', '© Copyright 2022 Reserved by Availafrica.org. This Website was developed by Martsoft Technologies.', 'Nonprofit Charity Fundraising Organization for Children and women.', 2, 5, 10, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime NOT NULL,
  `date_time_deleted` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `title`, `image`, `added_by`, `date_time_created`, `date_time_updated`, `date_time_deleted`) VALUES
(1, 'SPC00001', 'Crystal1', 'crystal1.jpg', 'admin', '2023-10-25 01:47:41', '2023-10-25 01:47:41', NULL),
(2, 'SPC00002', 'Crystal 2', 'crystal2.jpg', 'admin', '2023-10-25 02:08:50', '2023-10-25 02:08:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `button_caption` varchar(20) NOT NULL,
  `button_url` varchar(200) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `date_time_created` datetime NOT NULL,
  `date_time_updated` datetime NOT NULL,
  `date_time_deleted` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `org_profile`
--
ALTER TABLE `org_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `org_profile`
--
ALTER TABLE `org_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
