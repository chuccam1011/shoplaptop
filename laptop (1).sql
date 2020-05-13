-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 05:49 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laptop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `phone`, `password`, `email`) VALUES
(10, 'chuc', 4, 'c4ca4238a0b923820dcc509a6f75849b', 'fd@d');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(111) NOT NULL,
  `name` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `img` varchar(3000) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `img`) VALUES
(9, 'HP', '1587203956hp.png'),
(10, 'Dell', '1587204202dell.png'),
(11, 'Lenovo', '1587379245download_(1).png'),
(12, 'Asus', '1588086780download.png'),
(13, 'acer', '1588696995acer.png'),
(15, 'MSI', '1588697047msi.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `level` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `level`, `parent_id`) VALUES
(1, 'Work Staytions', 0, NULL),
(2, 'Giá rẻ', 0, NULL),
(3, 'Laptop Gaming', 0, NULL),
(4, 'Học tập - văn phòng', 0, NULL),
(5, 'Đồ họa', 0, NULL),
(6, 'Cao Cấp', 0, NULL),
(7, 'Laptop Mới', 0, NULL),
(8, 'Laptop Cũ', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cate_product`
--

CREATE TABLE `cate_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `cate_product`
--

INSERT INTO `cate_product` (`id`, `product_id`, `cate_id`) VALUES
(4, 18, 3),
(5, 18, 0),
(6, 18, 7),
(7, 2, 2),
(8, 2, 5),
(9, 2, 7),
(10, 3, 2),
(11, 7, 4),
(12, 3, 0),
(13, 6, 1),
(14, 6, 5),
(15, 6, 0),
(16, 7, 0),
(17, 7, 5),
(18, 7, 7),
(19, 9, 2),
(20, 9, 5),
(21, 9, 7),
(22, 10, 2),
(23, 10, 4),
(24, 10, 0),
(25, 11, 0),
(26, 11, 5),
(27, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img` varchar(300) COLLATE utf32_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf32_unicode_ci NOT NULL,
  `title` varchar(300) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id`, `product_id`, `img`, `content`, `title`) VALUES
(1, 7, '15874518544838_unnamed1.png', '', ''),
(2, 7, '15874518544838_unnamed.png', '', ''),
(3, 7, '15874518544838_pastedimage0.png', 'Laptop HP Pavilion Gaming 15-dk0231TX (8DS89PA) được trang bị màn hình 15,6 inch, viền mỏng 4 cạnh cùng độ phân giải Full HD 1080 mang đến góc nhìn rộng và trải nghiệm hình ảnh sắc nét. \r\n\r\nHơn thế nữa, loa kép được tích hợp ngay cạnh trên bàn phím cùng công nghệ khuếch âm HP Audio Boost và âm thanh B&O PLAY mang đến trải nghiệm âm thanh sống động, game thủ thỏa sức chìm đắm trong những âm thanh sống động', 'Laptop HP Pavilion '),
(4, 2, '15874518544838_unnamed1.png', 'Laptop HP Pavilion Gaming 15-dk0231TX (8DS89PA) được trang bịmàn hình 15,6 inch, viền mỏng 4 cạnh cùng độ phân giải Full HD 1080 mang đến góc nhìn rộng và trải nghiệm y cạnh trên bàn phím cùng công nghệ khuếch âm HP Audio Boost và âm thanh B&O PLAY mang đến trải nghiệm âm thanh sống động, game thủ thỏa sức chìm đắm trong những âm thanh sống động', 'Laptop'),
(5, 2, '15874518544838_unnamed.png', 'Laptop HP Pavilion Gaming 15-dk0231TX (8DS89PA) được trang bị màn hình 15,6 inch, viền mỏng 4 cạnh cùng độ phân giải Full HD 1080 mang đến góc nhìn rộng và trải nghiệm hình ảnh sắc nét.   Hơn thế nữa, loa kép được tích hợp ngay cạnh trên bàn phím cùng công nghệ khuếch âm HP Audio Boost và âm thanh B&O PLAY mang đến trải nghiệm âm thanh sống động, game thủ thỏa sức chìm đắm trong những âm thanh sống động', ' Pavilion '),
(6, 2, '15874518544838_pastedimage0.png', 'Laptop HP Pavilion Gaming 15-dk0231TX (8DS89PA) được trang bị màn hình 15,6 inch, viền mỏng 4 cạnh cùng độ phân giải Full HD 1080 mang đến góc nhìn rộng và trải nghiệm hình ảnh sắc nét. \r\n\r\nHơn thế nữa, loa kép được tích hợp ngay cạnh trên bàn phím cùng công nghệ khuếch âm HP Audio Boost và âm thanh B&O PLAY mang đến trải nghiệm âm thanh sống động, game thủ thỏa sức chìm đắm trong những âm thanh sống động', 'Laptop HP Pavilion ');

-- --------------------------------------------------------

--
-- Table structure for table `img`
--

CREATE TABLE `img` (
  `id` int(11) NOT NULL,
  `img` varchar(300) COLLATE utf32_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `img`
--

INSERT INTO `img` (`id`, `img`, `product_id`) VALUES
(3, '120_5124_66ivqp2kqx9tqw6w_setting_fff_1_90_end_500 - Copy.jpg', 2),
(4, '120_5124_ft1vxujv74rgmdho_setting_fff_1_90_end_500.jpg', 2),
(5, '120_5124_kg4f3lkoxwcogxv4_setting_fff_1_90_end_500.jpg', 2),
(6, '120_5124_kg4f3lkoxwcogxv4_setting_fff_1_90_end_500.jpg', 3),
(7, '2541_dell_precision_m6800_4.png', 3),
(8, '2541_dell_precision_m6800_5.png', 3),
(9, '4518_artboard_2.png', 4),
(10, '4518_artboard_3.png', 4),
(11, '4518_artboard_6.png', 4),
(12, 'download.png', 4),
(13, '2514_dsc00558_copy.jpg', 5),
(14, '2514_dsc00562_copy.jpg', 5),
(15, '2514_dsc00564_copy.jpg', 5),
(16, '120_5183_msi_gf63_thin_9sc_400vn_3.jpg', 6),
(17, '5183_msi_gf63_thin_9sc_400vn_4.jpg', 6),
(18, '120_5183_msi_gf63_thin_9sc_400vn_3.jpg', 7),
(19, '4838_pastedimage0.png', 7),
(20, '4838_unnamed.png', 7),
(21, '120_5124_66ivqp2kqx9tqw6w_setting_fff_1_90_end_500 - Copy.jpg', 8),
(22, '120_5124_ft1vxujv74rgmdho_setting_fff_1_90_end_500.jpg', 8),
(23, '120_5124_kg4f3lkoxwcogxv4_setting_fff_1_90_end_500.jpg', 8),
(24, '120_5124_kg4f3lkoxwcogxv4_setting_fff_1_90_end_500.jpg', 9),
(25, '2541_dell_precision_m6800_4.png', 9),
(26, '2541_dell_precision_m6800_5.png', 9),
(27, '4518_artboard_2.png', 10),
(28, '4518_artboard_3.png', 10),
(29, '4518_artboard_6.png', 10),
(30, 'download.png', 11),
(31, '2514_dsc00558_copy.jpg', 11),
(32, '2514_dsc00562_copy.jpg', 11),
(33, '2514_dsc00564_copy.jpg', 12),
(34, '120_5183_msi_gf63_thin_9sc_400vn_3.jpg', 12),
(35, '5183_msi_gf63_thin_9sc_400vn_4.jpg', 12),
(36, '120_5183_msi_gf63_thin_9sc_400vn_3.jpg', 13),
(37, '4838_pastedimage0.png', 13),
(38, '4838_unnamed.png', 13),
(39, '5153_acer_predator_helios_ph315_52_75r6_4.jpg', 14),
(40, 'acer.png', 14),
(41, '5153_acer_predator_helios_ph315_52_75r6_4.jpg', 15),
(42, 'acer.png', 15),
(43, '5153_acer_predator_helios_ph315_52_75r6_4.jpg', 16),
(44, 'acer.png', 16),
(45, 'acer.png', 17),
(46, 'acer.png', 18);

-- --------------------------------------------------------

--
-- Table structure for table `ordered`
--

CREATE TABLE `ordered` (
  `id` int(11) NOT NULL,
  `time` date NOT NULL,
  `status` int(11) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `notes` varchar(300) COLLATE utf32_unicode_ci NOT NULL,
  `extra_address` varchar(300) COLLATE utf32_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `ordered`
--

INSERT INTO `ordered` (`id`, `time`, `status`, `user_id`, `notes`, `extra_address`) VALUES
(11, '2020-05-01', 2, 12, '', ''),
(12, '2020-05-01', 2, 12, 'dahjldhaildhjiopạuwipo  ', ''),
(13, '2020-05-13', 2, 13, '', ''),
(14, '2020-05-13', 2, 13, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `brand_id` int(11) NOT NULL,
  `keyword` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `short_desc` varchar(300) COLLATE utf32_unicode_ci NOT NULL COMMENT 'vd : LÀM VIỆC HIỆU QUẢ, GIẢI TRÍ THẢ GA',
  `status` int(11) NOT NULL COMMENT 'mois hay cu',
  `model` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `chip` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `ram` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `card` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `drive` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `display` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `connect` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `vantay` int(11) NOT NULL,
  `operation` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `pin` int(5) NOT NULL,
  `weight` float NOT NULL,
  `size` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `discount` int(5) DEFAULT 0,
  `selled` int(10) DEFAULT 0,
  `time_add` date NOT NULL,
  `quantity_product` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `brand_id`, `keyword`, `short_desc`, `status`, `model`, `chip`, `ram`, `card`, `drive`, `display`, `connect`, `vantay`, `operation`, `pin`, `weight`, `size`, `discount`, `selled`, `time_add`, `quantity_product`) VALUES
(2, '[Mới 100% Full Box] Laptop Asus Pro P1440FA-FQ0934', 120000, 9, '[Mới 100% Full Box] ', 'Chính hãng Asus, SIÊU BỀN đạt tiêu chuẩn quân sự Mỹ, chip đời 8, GIÁ RẺ, bảo hành 24 tháng', 1, 'P1440FA-FQ0934 ', 'Intel Core i3 - 8145U', '5', 'Card onboard Intel UHD Graphics 620', 'HDD 500GB + SSD 180GB (Quà tặng)', '14 Inch HD', 'jack tai nghe, VGA port, Type-A USB2.0, 3xType-A USB 3.2 (Gen 1), RJ45 LAN jack for LAN insert, HDMI, SD Card, Cổng sạc', 1, 'win 10', 5, 2, '20*30*50', 0, 0, '2020-04-20', 5),
(3, 'Laptop Cũ Dell Precision M6800 Intel Core i7 MQ', 14500000, 10, 'Laptop Cũ ', 'Tặng thẻ Gold Member trị giá 3.000.000 đồng', 1, 'M6800', 'Intel Core i7 - 4800MQ', '8', 'AMD FirePro M6100M', ' SSD 120GB +', '17,3 Inch Full HD', 'wifi, bt 5.0', 0, 'WIN 10', 3, 3, '50*50*30', 0, 0, '2020-04-05', 80),
(4, '[Mới 100% Full box] Lenovo Legion Y540 15IRH 81SY0', 19990000, 11, '[Mới 100% Full box]', 'Laptop gaming chính hãng Lenovo Việt Nam. Cấu hình khủng: Intel Core i5 9300H, RAM 8GB DDR4, Card đồ họa NVidia GTX 1650 4GB', 1, 'Y540 15IRH 81SY0037VN', 'Intel Core i5 9300H', '8', 'Nvidia GTX 1650 4GB', 'SSD NVMe 128GB + HDD 1TB', '15.6 Inch Full HD', 'Wifi 802.11 AC + Bluetooth®4.2', 0, 'Win 10', 6, 4, '30*60*20', 0, 3, '2020-04-05', 1),
(6, '[Mới 100% Full box] Laptop MSI GF63 Thin 9SC 400VN', 19990000, 11, '[Mới 100% Full box]', 'Laptop gaming mỏng, nhẹ, cấu hình cao Card rời 1650Ti MaxQ Ti. Giá tốt', 1, ' GF63 Thin 9SC 400VN ', 'Intel Core i5 9300H', '8', ' GTX 1650 MaxQ 4GB', 'SSD 256GB NVMe', '15.6 Inch Full HD', 'co', 0, 'Win 10', 10, 4, '30*60*50', 2, 2, '2020-04-12', 5),
(7, '[Mới 100% Full Box] Laptop Gaming HP PAVILION GAMI', 20000000, 9, 'Laptop Gaming', 'HP Gaming 2019 giá tốt, card 1650. Tản siêu MÁT Tặng thẻ Gold Member trị giá 3.000.000đ', 1, 'HP PAVILION GAMING 15-DK0231TX', 'Intel Core i5 9300H', '8', 'NVidia GTX 1650 4GB', 'SSD 512GB NVMe (Miễn phí nâng cấp từ HDD 1TB)', '15.6 InchFull HD', 'dadda', 1, '10', 3, 2, '30*30*60', 3, 0, '2020-04-06', 5),
(8, '[Mới 100% Full Box] Laptop Asus Pro P1440FA-FQ0934', 120000, 9, '[Mới 100% Full Box] ', 'Chính hãng Asus, SIÊU BỀN đạt tiêu chuẩn quân sự Mỹ, chip đời 8, GIÁ RẺ, bảo hành 24 tháng', 1, 'P1440FA-FQ0934 ', 'Intel Core i3 - 8145U', '5', 'Card onboard Intel UHD Graphics 620', 'HDD 500GB + SSD 180GB (Quà tặng)', '14 Inch HD', 'jack tai nghe, VGA port, Type-A USB2.0, 3xType-A USB 3.2 (Gen 1), RJ45 LAN jack for LAN insert, HDMI, SD Card, Cổng sạc', 1, 'win 10', 5, 2, '20*30*50', 0, 0, '2020-04-20', 5),
(9, 'Laptop Cũ Dell Precision M6800 Intel Core i7 MQ', 14500000, 10, 'Laptop Cũ ', 'Tặng thẻ Gold Member trị giá 3.000.000 đồng', 1, 'M6800', 'Intel Core i7 - 4800MQ', '8', 'AMD FirePro M6100M', ' SSD 120GB +', '17,3 Inch Full HD', 'wifi, bt 5.0', 0, 'WIN 10', 3, 3, '50*50*30', 0, 0, '2020-04-05', 5),
(10, '[Mới 100% Full box] Lenovo Legion Y540 15IRH 81SY0', 19990000, 11, '[Mới 100% Full box]', 'Laptop gaming chính hãng Lenovo Việt Nam. Cấu hình khủng: Intel Core i5 9300H, RAM 8GB DDR4, Card đồ họa NVidia GTX 1650 4GB', 1, 'Y540 15IRH 81SY0037VN', 'Intel Core i5 9300H', '8', 'Nvidia GTX 1650 4GB', 'SSD NVMe 128GB + HDD 1TB', '15.6 Inch Full HD', 'Wifi 802.11 AC + Bluetooth®4.2', 0, 'Win 10', 6, 4, '30*60*20', 12, 3, '2020-04-05', 5),
(11, 'Laptop Gaming HP Omen 15 - Intel Core i7', 18900000, 10, 'Laptop Gaming ', 'Laptop gaming tầm trung tới từ HP Bảo hành 6 tháng', 1, 'Omen 15', 'Intel Core i7 7700HQ', '8', 'Card rời Nvidia GTX 1050 Ti', 'HDD 500GB + SSD 180GB', '15.6 Inch Full HD', 'bt,wifi', 1, 'Win 10', 7, 3, '20*30*55', 0, 1, '2020-04-24', 5),
(12, '[Mới 100% Full box] Laptop MSI GF63 Thin 9SC 400VN', 19990000, 11, '[Mới 100% Full box]', 'Laptop gaming mỏng, nhẹ, cấu hình cao Card rời 1650Ti MaxQ Ti. Giá tốt', 1, ' GF63 Thin 9SC 400VN ', 'Intel Core i5 9300H', '8', ' GTX 1650 MaxQ 4GB', 'SSD 256GB NVMe', '15.6 Inch Full HD', 'co', 0, 'Win 10', 10, 4, '30*60*50', 2, 2, '2020-04-12', 5),
(13, '[Mới 100% Full Box] Laptop Gaming HP PAVILION GAMI', 20000000, 9, 'Laptop Gaming', 'HP Gaming 2019 giá tốt, card 1650. Tản siêu MÁT Tặng thẻ Gold Member trị giá 3.000.000đ', 1, 'HP PAVILION GAMING 15-DK0231TX', 'Intel Core i5 9300H', '8', 'NVidia GTX 1650 4GB', 'SSD 512GB NVMe (Miễn phí nâng cấp từ HDD 1TB)', '15.6 InchFull HD', 'dadda', 1, '10', 3, 2, '30*30*60', 3, 0, '2020-04-06', 5);

-- --------------------------------------------------------

--
-- Table structure for table `products_orders`
--

CREATE TABLE `products_orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(10) NOT NULL COMMENT 'quntity of product'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `products_orders`
--

INSERT INTO `products_orders` (`id`, `product_id`, `order_id`, `quantity`) VALUES
(24, 3, 11, 10),
(25, 4, 11, 1),
(26, 8, 12, 1),
(27, 12, 13, 1),
(28, 7, 13, 1),
(29, 11, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `tittle` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `img` varchar(300) COLLATE utf32_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `tittle`, `img`, `product_id`) VALUES
(3, 'Laptop MSI GF63 Thin 10SCXR 074VN - Intel Core i7', '15877259134838_pastedimage0.png', 2),
(4, 'Laptop MSI GF63 Thin 10SCXR 074VN - Intel Core i5', '15877259255183_msi_gf63_thin_9sc_400vn_4.jpg', 8),
(5, ' Laptop Acer Predator Helios PH315-52-75R6 - Intel Core i7', '15886973365153_acer_predator_helios_ph315_52_75r6_4.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf32_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf32_unicode_ci DEFAULT 'unknow',
  `city` varchar(300) COLLATE utf32_unicode_ci DEFAULT 'unknow',
  `dob` varchar(300) COLLATE utf32_unicode_ci DEFAULT '2020-04-25',
  `phone` varchar(300) COLLATE utf32_unicode_ci DEFAULT 'unknow',
  `full_name` varchar(300) COLLATE utf32_unicode_ci DEFAULT 'unknow',
  `email` varchar(200) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `address`, `city`, `dob`, `phone`, `full_name`, `email`) VALUES
(12, 'chuc', 'c4ca4238a0b923820dcc509a6f75849b', 'HH VN', 'HN', '20-2-2', '032151', 'cam vanw chuwsdddddddd', 'c@d'),
(13, 'cam', 'c4ca4238a0b923820dcc509a6f75849b', 'AS, CC,CV', 'HCM', '10/11/1997', '0382155564', 'cam van chuc', 'cam@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cate_product`
--
ALTER TABLE `cate_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered`
--
ALTER TABLE `ordered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_orders`
--
ALTER TABLE `products_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cate_product`
--
ALTER TABLE `cate_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `img`
--
ALTER TABLE `img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `ordered`
--
ALTER TABLE `ordered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products_orders`
--
ALTER TABLE `products_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
