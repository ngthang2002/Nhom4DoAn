-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 05, 2023 lúc 04:16 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `furniture-shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `image`, `email`, `password`) VALUES
(1, 'admin', '', 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `cust_id`, `product_id`, `quantity`) VALUES
(86, 4, 42, 3),
(87, 4, 40, 1),
(88, 4, 41, 1),
(89, 4, 37, 1),
(97, 1, 42, 3),
(98, 1, 43, 4),
(99, 1, 39, 1),
(103, 1, 33, 1),
(108, 8, 42, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(2, 'Dining set'),
(3, 'Chairs'),
(4, 'Table'),
(5, 'Sofa'),
(6, 'cupboard'),
(9, 'abc'),
(10, 'q?');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`cust_id`, `name`, `email`, `password`, `address`, `city`, `phone`) VALUES
(4, 'Hamza Mughal', 'mhamzaq869@gmail.com', '123', 'h#3,St#62,area dar ul islam', 'lahore', '03077087412'),
(6, 'nam', 'phanvannam03030@gmail.com', '123', '185 Lê Duẩn', 'dn', '1234567890'),
(7, 'nam', 'phanvannam03030@gmail.com', '123', '185 Lê Duẩn', 'dn', '1234567890'),
(8, 'nam124313', 'nam@gmail.com', '123', 'dn2323', 'dn', '123456789'),
(9, 'nam', 'phanvannam03030@gmail.com', '123', '185 Lê Duẩn', 'dn', '1234567890'),
(11, 'TN', 'demo@gmail.com', '123', 'Trieu Khuc', 'Hà Nội', '0904876465'),
(12, 'TN', 'demo1@gmail.com', '123', 'Thanh Xuân', 'Hà Nội', '904876466');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_order`
--

CREATE TABLE `customer_order` (
  `order_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantily` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `cust_id`, `product_id`, `quantily`, `date`, `status`) VALUES
(65, 4, 4, 1, '11-08-2020', 'verified'),
(66, 4, 4, 1, '18-08-2020', 'delivered'),
(67, 4, 5, 1, '18-08-2020', 'verified'),
(68, 4, 41, 1, '21-08-2020', 'delivered'),
(69, 4, 35, 1, '21-08-2020', 'delivered'),
(70, 4, 34, 1, '21-08-2020', 'delivered'),
(71, 5, 39, 2, '23-08-2020', 'verified'),
(72, 5, 32, 1, '23-08-2020', 'pending'),
(73, 5, 34, 1, '23-08-2020', 'pending'),
(74, 6, 42, 1, '10-11-2022', 'delivered'),
(75, 7, 42, 2, '10-11-2022', 'delivered'),
(76, 8, 42, 1, '10-11-2022', 'delivered'),
(77, 9, 42, 1, '05-12-2022', 'pending'),
(78, 5, 42, 1, '05-12-2023', 'pending'),
(79, 5, 40, 1, '05-12-2023', 'pending'),
(80, 5, 42, 1, '05-12-2023', 'pending'),
(81, 12, 43, 1, '05-12-2023', 'pending'),
(82, 12, 43, 4, '05-12-2023', 'delivered');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `furniture_product`
--

CREATE TABLE `furniture_product` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `category` int(11) NOT NULL,
  `detail` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `furniture_product`
--

INSERT INTO `furniture_product` (`id`, `title`, `category`, `detail`, `price`, `image`, `date`, `status`) VALUES
(31, 'Mocca Double Bed', 1, '<p>A haven of peace, comfort, and durability, Haven makes its hard to get up in the morning. The soothing appeal that comes off with the fine upholstery in white, it simply takes you to heaven!</p>\r\n', 68500, '36_60ec496a-a99e-4f51-bd5a-d33c003218ad_1024x1024.jpg', '21-08-2020', 'publish'),
(32, 'Spruce Double Bed', 1, '<p>This elegant bed is a simple yet aesthetic design that would make a gorgeous choice for your bedroom. </p>\r\n', 65000, '32aaaaa_1024x1024.jpg', '21-08-2020', 'publish'),
(33, 'Meyer Bed Set', 1, '<p>Leatheriod Kikar wood +MDF (without mattress)</p>\r\n', 92250, '10_c3e2fbce-3ef1-4566-a44e-2d53c7be4cf5_1024x1024.webp', '21-08-2020', 'publish'),
(34, 'Aurore Dining Table', 2, '<p>Material:Dining Table glass top size 4.5x2.5 legs made of solid wood with black polish. Hieght: 30 Inches Width: 31 Inches Length: 53.5 Inches</p>\r\n', 14600565, 'AURORE_9646f9ee-7510-406a-b2c4-72b8bfb62501_1024x1024.webp', '21-08-2020', 'publish'),
(35, 'Raimi Dining Set', 2, '<p>Table Height: 29 inchesWidth: 36 inchesMaterial: Melamine faced water and heat resistant MDF and iron legsChair Height: 27 inchesWidth: 16 inches</p>\r\n', 54050, 'raimi_2_14e717a7-b66f-471c-9f7d-70d564968d3e_1024x1024.webp', '21-08-2020', 'publish'),
(36, 'Tapert Dining Set-Black', 2, '<p>Table Height: 30 inchesWidth: 34 inchesMaterial: Melamine faced water and heat resistant MDF and beechwood legsChair Height: 39 inchesWidth: 19 inchesMaterial: Beechwood legs, Foam padded PU leather upholstery.</p>\r\n', 54550, 'tapert_black_3_148f8213-457b-491d-9434-6cd40cc16471_1024x1024.webp', '21-08-2020', 'publish'),
(37, 'Tapert Dining Set-White', 2, '<p>Table Height: 30 inchesWidth: 34 inchesMaterial: Melamine faced water and heat resistant MDF and beechwood legsChair Height: 39 inchesWidth: 19 inchesMaterial: Beechwood legs, Foam padded PU leather upholstery.</p>\r\n', 57000, 'tapert_a5df0f6b-6717-4707-abe7-da623cdcdf2c_1024x1024.webp', '21-08-2020', 'publish'),
(38, 'Sienna Table', 2, '<p>Height: 31 inchesLength: 48 inchesWidth: 24 inches</p>\r\n', 27150, 'SIENNA_3c7d4f3f-9d24-4fa2-93f3-4430ca022f8b_1024x1024.webp', '21-08-2020', 'publish'),
(39, 'Lorenzo Table', 4, '<p>Top made of MDF covered with PVC paper having four stools, frame made of MS pipe powder coated black color.</p>\r\n', 24900, 'coffee-table-design-glass-and-wood-scandinavian-fiord-l-110xp60xh45cm.jpg', '21-08-2020', 'publish'),
(40, 'Estela Table', 4, '<p>Height: 4 inches. Width: 20 inches. Length: 5.5 inches.Top made of printed tempered glass, legs made of MS pipe powder coated black color.</p>\r\n', 12400, 'aza_1024x1024.jpg', '21-08-2020', 'publish'),
(42, 'Erico Table', 4, '<p>Height: 4 inches. Width: 20 inches. Length: 5.5 inches.Top made of printed tempered glass, legs made of MS pipe powder coated black color.</p>\r\n', 12050, 'sads_1024x1024.jpg', '21-08-2020', 'publish'),
(43, '1', 3, '<p>ewtegsrhrhrsthsh</p>\r\n', 222222, 'sads_1024x1024.jpg', '10-11-2022', 'publish');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Chỉ mục cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`cust_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `furniture_product`
--
ALTER TABLE `furniture_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `furniture_product`
--
ALTER TABLE `furniture_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
