-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 20, 2021 lúc 03:00 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlybanhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2021_04_04_120523_create_tbl_admin_table', 1),
(12, '2021_04_10_064819_create_tbl_category_product', 1),
(13, '2021_04_10_202124_create_tbl_brand_product', 1),
(14, '2021_04_10_212737_create_tbl_product', 1),
(15, '2021_04_18_102143_tbl_customer', 2),
(16, '2021_04_18_135146_tbl_shipping', 3),
(17, '2021_04_19_004917_tbl_payment', 4),
(18, '2021_04_19_005440_tbl_payment', 5),
(19, '2021_04_19_010426_tbl_order', 6),
(20, '2021_04_19_011533_tbl_order_detail', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Vu Nguyen', '123456789', NULL, NULL),
(2, 'linh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'linh DB', '085736536', NULL, NULL),
(3, 'ha@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'hà DB', '083575363', NULL, NULL),
(4, 'ha1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'hà DB', '083575363', NULL, NULL),
(5, 'ha1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'hà DB', '083575363', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_decs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `brand_decs`, `brand_status`, `created_at`, `updated_at`) VALUES
(1, '⭐', '⭐', 1, NULL, NULL),
(2, '⭐⭐', '⭐⭐', 1, NULL, NULL),
(3, '⭐⭐⭐', '⭐⭐⭐', 1, NULL, NULL),
(4, '⭐⭐⭐⭐', '⭐⭐⭐⭐', 1, NULL, NULL),
(5, '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category_product`
--

CREATE TABLE `tbl_category_product` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_decs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category_product`
--

INSERT INTO `tbl_category_product` (`category_id`, `category_name`, `category_decs`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 'trà sữa', 'trà sữa', 1, NULL, NULL),
(2, 'trà', 'trà', 1, NULL, NULL),
(3, 'đồ ăn vặt', 'đồ ăn vặt', 1, NULL, NULL),
(4, 'cà phê', 'cà phê', 1, NULL, NULL),
(5, 'sữa chua', 'sữa chua', 1, NULL, NULL),
(6, 'đá xay', 'đá xay', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customers`
--

INSERT INTO `tbl_customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_phone`, `created_at`, `updated_at`) VALUES
(5, 'ha', 'ha@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '035234534', NULL, NULL),
(6, 'vu', 'vu@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '0352123456', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `shipping_id`, `payment_id`, `order_total`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 1, '18,150.00', 'đang chờ xử lý', NULL, NULL),
(2, 4, 3, 2, '18,150.00', 'đang chờ xử lý', NULL, NULL),
(3, 4, 3, 3, '18,150.00', 'đang chờ xử lý', NULL, NULL),
(4, 4, 3, 4, '18,150.00', 'đang chờ xử lý', NULL, NULL),
(5, 4, 3, 5, '18,150.00', 'đang chờ xử lý', NULL, NULL),
(6, 4, 3, 6, '0.00', 'đang chờ xử lý', NULL, NULL),
(7, 4, 3, 7, '0.00', 'đang chờ xử lý', NULL, NULL),
(8, 4, 3, 8, '0.00', 'đang chờ xử lý', NULL, NULL),
(9, 4, 3, 9, '0.00', 'đang chờ xử lý', NULL, NULL),
(10, 5, 4, 10, '84.69', 'đang chờ xử lý', NULL, NULL),
(11, 5, 4, 11, '84.69', 'đang chờ xử lý', NULL, NULL),
(12, 5, 4, 12, '72.60', 'đang chờ xử lý', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `order_detail_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sales_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`order_detail_id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_sales_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 14, 'cơm', '15000', '1', NULL, NULL),
(2, 2, 14, 'cơm', '15000', '1', NULL, NULL),
(3, 3, 14, 'cơm', '15000', '1', NULL, NULL),
(4, 4, 14, 'cơm', '15000', '1', NULL, NULL),
(5, 5, 14, 'cơm', '15000', '1', NULL, NULL),
(6, 12, 18, 'Sản Phẩm 1', '20', '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(10) UNSIGNED NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, '1', 'đang chờ xử lý', NULL, NULL),
(2, '2', 'đang chờ xử lý', NULL, NULL),
(3, '2', 'đang chờ xử lý', NULL, NULL),
(4, '2', 'đang chờ xử lý', NULL, NULL),
(5, '2', 'đang chờ xử lý', NULL, NULL),
(6, '2', 'đang chờ xử lý', NULL, NULL),
(7, '2', 'đang chờ xử lý', NULL, NULL),
(8, '2', 'đang chờ xử lý', NULL, NULL),
(9, '2', 'đang chờ xử lý', NULL, NULL),
(10, '2', 'đang chờ xử lý', NULL, NULL),
(11, '2', 'đang chờ xử lý', NULL, NULL),
(12, '2', 'đang chờ xử lý', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_decs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_decs`, `product_content`, `product_price`, `product_image`, `product_status`, `created_at`, `updated_at`) VALUES
(1, 4, 5, 'Americano', 'Americano', 'Americano', '32000', 'americano32k66.jpg', 1, NULL, NULL),
(2, 4, 4, 'cà phê latte', 'cà phê latte', 'cà phê latte', '44000', 'cflatte44k49.jpg', 1, NULL, NULL),
(3, 3, 5, 'chân gà xì dầu', 'chân gà xì dầu', 'chân gà xì dầu', '8000', 'changaxidau8k82.jpeg', 1, NULL, NULL),
(4, 3, 3, 'cơm cháy chà bông', 'cơm cháy chà bông', 'cơm cháy chà bông', '14000', 'comchay14k90.jpeg', 1, NULL, NULL),
(5, 3, 4, 'hứng đưng vị dừa', 'hứng đưng vị dừa', 'hứng đưng vị dừa', '12000', 'đuonguongvidua12k86.jpeg', 1, NULL, NULL),
(6, 2, 4, 'hồng ngọc trà', 'hồng ngọc trà', 'hồng ngọc trà', '24000', 'hongngoctra24k11.jpg', 1, NULL, NULL),
(7, 2, 5, 'hồng trà kem dừa', 'hồng trà kem dừa', 'hồng trà kem dừa', '28000', 'hongtrakemdua28k6.jpg', 1, NULL, NULL),
(8, 4, 5, 'hồng trà kem vani', 'hồng trà kem vani', 'hồng trà kem vani', '28000', 'hongtrakemvani28k92.jpg', 1, NULL, NULL),
(9, 3, 4, 'khô bò xé sợi', 'khô bò xé sợi', 'khô bò xé sợi', '20000', 'khobo20k97.jpeg', 1, NULL, NULL),
(10, 3, 2, 'ngô sấy', 'ngô sấy', 'ngô sấy', '18000', 'ngosay18k52.jpeg', 1, NULL, NULL),
(11, 2, 1, 'trà ô long', 'trà ô long', 'trà ô long', '12000', 'ta_o_long31.jpg', 1, NULL, NULL),
(12, 2, 2, 'trà nhài', 'trà nhài', 'trà nhài', '24000', 'tranhai24k67.jpg', 1, NULL, NULL),
(13, 1, 3, 'trà sữa thiên thảo', 'trà sữa thiên thảo', 'trà sữa thiên thảo', '24000', 'ts_thien_thao48.jpg', 1, NULL, NULL),
(14, 5, 5, 'sữa chua việt quất', 'sữa chua việt quất', 'sữa chua việt quất', '32000', 'suachuavietquat32k77.jpeg', 1, NULL, NULL),
(15, 6, 5, 'mát cha kem dừa', 'mát cha kem dừa', 'mát cha kem dừa', '48000', 'matchakemdua48k85.jpg', 1, NULL, NULL),
(16, 5, 5, 'sữa chua nha dam', 'sữa chua nha dam', 'sữa chua nha dam', '32000', 'suachuavietquat32k52.jpeg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_shipping`
--

CREATE TABLE `tbl_shipping` (
  `shipping_id` int(10) UNSIGNED NOT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`shipping_id`, `shipping_name`, `shipping_address`, `shipping_phone`, `shipping_email`, `created_at`, `updated_at`) VALUES
(1, 'lữ minh hà', '52 hàm nghi', '0352957635', 'ha@gmail.com', NULL, NULL),
(2, 'lữ minh hà', '52 hàm nghi', '0352194151', 'ha@gmail.com', NULL, NULL),
(3, 'nguyễn văn linh', '52 hàm nghi', '0352999999', 'linh@gmail.com', NULL, NULL),
(4, 'lữ minh hà', '52 hàm nghi', '098735635', 'ha@gmail.com', NULL, NULL),
(5, 'nguyễn văn linh', '52 hàm nghi', '0352194151', 'linh@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Chỉ mục cho bảng `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `order_detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  MODIFY `shipping_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
