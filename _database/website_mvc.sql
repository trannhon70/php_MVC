-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2022 at 04:05 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminid`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'nhon', 'nhon@gmail.com', 'nhonadmin', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

DROP TABLE IF EXISTS `tbl_brand`;
CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(255) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brandName`) VALUES
(8, 'Sam Sung'),
(3, 'Appo'),
(4, 'Iphone'),
(7, 'Dell');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cartid` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `hinhanh` varchar(200) NOT NULL,
  PRIMARY KEY (`cartid`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartid`, `productid`, `sid`, `productName`, `price`, `quantity`, `hinhanh`) VALUES
(44, 15, 'mi0k8gusrjo9n6k76152crhnpm', 'sam sung S11', '12000000', 4, '9b5a69403f.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(255) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catid`, `catName`) VALUES
(10, 'Äiá»‡n thoáº¡i');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compare`
--

DROP TABLE IF EXISTS `tbl_compare`;
CREATE TABLE IF NOT EXISTS `tbl_compare` (
  `compare_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `hinhanh` varchar(1000) NOT NULL,
  PRIMARY KEY (`compare_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES
(3, 'Tráº§n XuÃ¢n NhÆ¡n', 'Äá»©c hÃ²a ', 'Long an  a', 'vn', '60000 ', '0968222502', 'kevintran351996@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'huá»³nh hoa phong', 'Quáº­n 8 , THPCH', 'TPHCM', 'vn', '700000', '12122154654', 'nhontrau03@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Dinh Phuc Nguyen', 'Äá»©c hÃ²a 1', 'Long an 1', 'vn', '40000dsad', '+12454343000', 'dpnguyen@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `hinhanh` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `productid`, `productName`, `customer_id`, `quantity`, `price`, `hinhanh`, `status`, `date_order`) VALUES
(9, 11, 'dell113', 4, 3, '60000000', '1b9cf619f3.jpg', 1, '2021-12-28 15:39:56'),
(11, 15, 'sam sung S11', 4, 1, '12000000', '9b5a69403f.png', 1, '2021-12-29 02:18:22'),
(14, 13, 'sam sung S13', 4, 1, '20000000', 'bd0817d86b.png', 1, '2021-12-29 02:26:04'),
(18, 15, 'sam sung S11', 4, 2, '24000000', '9b5a69403f.png', 1, '2021-12-29 14:46:11'),
(16, 14, 'sam sung S11', 4, 1, '12000000', '81a0c46b43.png', 1, '2021-12-29 03:08:25'),
(17, 12, 'iphone 12', 4, 3, '60000000', '35eecf8c0a.png', 1, '2021-12-29 14:35:00'),
(19, 12, 'iphone 12', 4, 3, '60000000', '35eecf8c0a.png', 1, '2021-12-29 14:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `productName` tinytext NOT NULL,
  `catid` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `type1` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `hinhanh` varchar(1000) NOT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productid`, `productName`, `catid`, `brand_id`, `product_desc`, `type1`, `price`, `hinhanh`) VALUES
(12, 'iphone 12', 10, 4, '<p>sáº£n pháº©m má»›i cá»§a cá»­a h&agrave;ng ráº¥t tuyá»‡t</p>', 0, '20000000', '35eecf8c0a.png'),
(16, 'iphone 12', 10, 3, '<p>sao táº¥t cae ch&uacute;ng ta láº¡i vá» vá»›i nhau</p>', 1, '10000000', 'f5e2abd014.png'),
(15, 'sam sung S11', 10, 3, '<p>sao táº¥t cáº£ m&igrave;nh láº¡i vá» vá»›i nhau nhá»‰....</p>', 0, '12000000', '9b5a69403f.png'),
(14, 'sam sung S11', 10, 8, '<p>sao táº¥t cáº£ m&igrave;nh láº¡i vá» vá»›i nhau nhá»‰....</p>', 0, '12000000', '81a0c46b43.png'),
(11, 'dell113', 11, 7, '<p>sáº£n pháº©m má»›i cá»§a cá»­a h&agrave;ng ráº¥t tuyá»‡t</p>', 1, '20000000', '1b9cf619f3.jpg'),
(13, 'sam sung S13', 10, 8, '<p>sao táº¥t cáº£ m&igrave;nh láº¡i vá» vá»›i nhau hihi</p>', 0, '20000000', 'bd0817d86b.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

DROP TABLE IF EXISTS `tbl_slider`;
CREATE TABLE IF NOT EXISTS `tbl_slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_Name` varchar(255) NOT NULL,
  `slider_hinhanh` varchar(1000) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_Name`, `slider_hinhanh`, `type`) VALUES
(6, 'slider 3', '196337817c.jpg', 1),
(4, 'slider 1', '4008b01368.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

DROP TABLE IF EXISTS `tbl_wishlist`;
CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
  `wishlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `hinhanh` varchar(1000) NOT NULL,
  PRIMARY KEY (`wishlist_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`wishlist_id`, `customer_id`, `productid`, `productName`, `price`, `hinhanh`) VALUES
(1, 3, 15, 'sam sung S11', '12000000', '9b5a69403f.png'),
(3, 3, 12, 'iphone 12', '20000000', '35eecf8c0a.png'),
(5, 3, 14, 'sam sung S11', '12000000', '81a0c46b43.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
