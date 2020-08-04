-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 04, 2020 lúc 04:56 AM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `database`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Phòng trọ cho thuê', 'phong-tro-cho-thue', NULL, NULL),
(2, 'Ở ghép', 'o-ghep', NULL, NULL),
(3, 'Nhà nguyên căn', 'nha-nguyen-can', NULL, NULL),
(4, 'Chung cư', 'chung-cu', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `districts`
--

INSERT INTO `districts` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Ba Đình', 'ba-dinh', NULL, NULL),
(2, 'Bắc Từ Liêm', 'bac-tu-liem', NULL, NULL),
(3, 'Cầu Giấy', 'cau-giay', NULL, NULL),
(4, 'Đống Đa', 'dong-da', NULL, NULL),
(5, 'Hà Đông', 'ha-dong', NULL, NULL),
(6, 'Hai Bà Trưng', 'hai-ba-trung', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_03_11_083541_create_table_motel_rooms', 1),
(4, '2018_03_11_085624_create_table_districts', 1),
(5, '2018_03_11_085744_create_table_categories', 1),
(6, '2018_04_22_122641_add_column__status_for_user', 1),
(7, '2018_04_22_152143_add_ondelete_cascade_for_motelroom', 1),
(8, '2018_05_06_030849_add_col_phone_for__motelroom_table', 1),
(9, '2018_05_12_063610_add_column_approve_for_motelroom', 1),
(10, '2018_05_13_064120_add_table_report', 1),
(11, '2018_05_19_033745_add_column_slug_table_motelroom', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `motelrooms`
--

CREATE TABLE `motelrooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `count_view` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latlng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `utilities` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approve` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `motelrooms`
--

INSERT INTO `motelrooms` (`id`, `title`, `description`, `price`, `area`, `count_view`, `address`, `latlng`, `images`, `user_id`, `category_id`, `district_id`, `utilities`, `status`, `created_at`, `updated_at`, `phone`, `approve`, `slug`) VALUES
(10, 'lolllll', 'ki', 120000, 15, 28, 'soo2, Lê Quang Đạo, Mễ Trì, Từ Liêm, Hà Nội, Việt Nam', '{\"0\":\"21.018088280337526\",\"1\":\"105.76606556054688\"}', '{\"0\":\"phongtro-Ng5Yq-99113346_993522711066669_5445303268949360640_n.jpg\"}', 6, 1, 1, '{\"0\":\"C\\u00f3 g\\u00e1c l\\u1eedng\",\"1\":\"Gi\\u1edd gi\\u1ea5c t\\u1ef1 do\",\"2\":\"V\\u1ec7 sinh chung\"}', 0, '2020-07-16 00:33:01', '2020-07-21 02:29:10', '09877313', 1, 'lolllll'),
(11, 'qx', '12', 1121212, 1212, 0, '12 Ngõ 144 Mai Dịch, Mai Dịch, Cầu Giấy, Hà Nội, Việt Nam', '{\"0\":\"21.04404494421805\",\"1\":\"105.77636524316407\"}', '{\"0\":\"phongtro-EnUrp-fd6cd73f097fe021b96e.jpg\"}', 10, 1, 3, '{\"0\":\"T\\u1ee7 + gi\\u01b0\\u1eddng\",\"1\":\"Gi\\u1edd gi\\u1ea5c t\\u1ef1 do\"}', 1, '2020-07-16 03:20:11', '2020-07-16 03:20:42', '12121212', 0, 'qx'),
(12, '123', 'ko', 121212, 12, 0, '1 Bắc Sơn, Điện Bàn, Ba Đình, Hà Nội, Việt Nam', '{\"0\":\"21.03571366830523\",\"1\":\"105.8385066616211\"}', '{\"0\":\"phongtro-wpEbm-photo-1518020382113-a7e8fc38eac9.jpg\"}', 6, 4, 1, '{\"0\":\"C\\u00f3 g\\u00e1c l\\u1eedng\",\"1\":\"Chung ch\\u1ee7\",\"2\":\"V\\u1ec7 sinh ri\\u00eang\"}', 0, '2020-07-21 02:30:30', '2020-07-21 02:30:30', '1212121', 1, '123'),
(13, 'đống da', 'ju', 100000, 121212, 0, '183 Hồng Mai, Quỳnh Lôi, Hai Bà Trưng, Hà Nội, Việt Nam', '{\"0\":\"20.998938338642898\",\"1\":\"105.8555440532837\"}', '{\"0\":\"phongtro-5dTMK-78926361_2590799391242668_5693325806248394752_n.jpg\"}', 6, 1, 4, '{\"0\":\"C\\u00f3 g\\u00e1c l\\u1eedng\",\"1\":\"Chung ch\\u1ee7\"}', 0, '2020-07-21 02:36:30', '2020-07-21 02:38:09', '12121212', 1, 'dong-da');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rating`
--

CREATE TABLE `rating` (
  `id` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_motel` int(10) NOT NULL,
  `rate` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rating`
--

INSERT INTO `rating` (`id`, `id_user`, `id_motel`, `rate`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(5, 6, 7, 0, '123', 0, '2020-07-16 09:44:18', '2020-07-16 09:44:18'),
(6, 6, 2, 4, 'đa', 0, '2020-07-16 09:46:08', '2020-07-16 09:46:08'),
(7, 6, 2, 3, 'nóng', 0, '2020-07-16 09:47:00', '2020-07-16 09:47:00'),
(8, 6, 2, 2, 'ok', 0, '2020-07-16 09:47:55', '2020-07-16 09:47:55'),
(9, 9, 10, 3, 'kj', 0, '2020-07-19 04:18:58', '2020-07-16 10:04:31'),
(10, 9, 2, 0, '123', 1, '2020-07-16 10:10:04', '2020-07-16 10:05:56'),
(12, 10, 2, 5, 'good', 0, '2020-07-19 04:21:44', '2020-07-19 04:21:44'),
(13, 1, 2, 4, 'ok', 1, '2020-07-19 16:27:31', '2020-07-19 16:26:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_motelroom` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reports`
--

INSERT INTO `reports` (`id`, `ip_address`, `id_motelroom`, `status`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 7, 2, '2018-05-19 01:30:32', '2018-05-19 01:30:32'),
(2, '127.0.0.1', 7, 1, '2018-05-24 07:24:17', '2018-05-24 07:24:17'),
(3, '127.0.0.1', 1, 2, '2018-05-24 07:24:33', '2018-05-24 07:24:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `right` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-avatar.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tinhtrang` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `right`, `phone`, `avatar`, `remember_token`, `status`, `created_at`, `updated_at`, `tinhtrang`) VALUES
(1, 'Thành Trung', 'admin', 'thanhtrungit.dev@gmail.com', '$2y$10$0U/rTGgDXcZFEz0VCRAX2umuSMpYCIWCfBj8WdPx6wj1eCf20P9ga', 1, NULL, 'avatar-admin-1526708699.jpg', 'NRwQx67cNhuCY0Zs92qKRusGZmYMA40QB0RrOdroYDLcMZOSnqDVrBJPUCRJ', 1, '2018-05-18 22:44:01', '2018-05-18 22:44:59', 1),
(2, 'Tất Nhạc', 'tatnhac', 'tatnhac@gmail.com', '$2y$10$w68K356705u4SR1HUmzchOBR1nklo6yDvZ/VzvG0bhQRB9j4QFzwK', 0, NULL, 'no-avatar.jpg', 'j4m9NmrzLAKw6E6MxKE067XbMQegswMBoAjuC5PvnUcAjrF7FpZcPkfrqLbR', 1, '2018-05-19 00:50:52', '2018-05-19 00:50:52', 1),
(3, 'Văn Phúc', 'vanphuc', 'vanphuc@gmail.com', '$2y$10$Dbd1QmmlWGV.uYqi9KpTVuD2yKMgqs5fbHVNn5jMeOReaqh79T7gq', 0, NULL, 'no-avatar.jpg', 'BxvBGC60U40Wu1TADa2zk3MrPujWPoaymjboNSoCk9jQethQp2TXEXWO9EbG', 1, '2018-05-19 01:02:17', '2018-05-19 01:02:17', 1),
(4, 'Bảo Ngọc', 'baongoc', 'baongoc@gmail.com', '$2y$10$eMiGI1HA.u0IWJpLT1Wjlec3ojGbDhAmmnITN5Erga6t/GUpzjex.', 0, NULL, 'avatar-baongoc-1526717688.png', 'o9qTtYf2aoyY3imWqUmqLBkNoR7luVz3qoD3JslTmVpQyfapdx6JnZ0r3A9e', 1, '2018-05-19 01:11:11', '2018-05-19 01:14:48', 1),
(5, 'chien', 'chien', 'chien@gmail.com', '698d51a19d8a121ce581499d7b701668', 0, NULL, 'no-avatar.jpg', NULL, 1, NULL, NULL, 1),
(6, 'nqc', 'quangchien', 'chienictu@gmail.com', '$2y$10$b6Uwpwpb/7D5TSFbE5jQlu7pMtWuugy56k.jLc8rXFaAaJW/8OjQm', 0, NULL, 'avatar-quangchien-1594892302.jpg', 'RMqmRKELW4CzOxbl06NxezRQ3rp2hPXiZUFDQDTUFw0xsx6ZZbX7HK828Axj', 1, '2020-07-15 20:18:49', '2020-07-16 02:38:22', 1),
(7, 'admin', 'admin', 'admin', '$2y$10$b6Uwpwpb/7D5TSFbE5jQlu7pMtWuugy56k.jLc8rXFaAaJW/8OjQm', 1, NULL, 'no-avatar.jpg', 'RMqmRKELW4CzOxbl06NxezRQ3rp2hPXiZUFDQDTUFw0xsx6ZZbX7HK828Axj', 1, NULL, NULL, 1),
(8, '123', '123456', '123@g.b', '$2y$10$b6Uwpwpb/7D5TSFbE5jQlu7pMtWuugy56k.jLc8rXFaAaJW/8OjQm', 0, NULL, 'no-avatar.jpg', NULL, 1, '2020-07-16 02:56:08', '2020-07-16 02:56:08', 2),
(9, '2222222', '2222222', '2222222@s.c', '$2y$10$qNiZnX4D6bIkmcfu8PPgoOcaPbtauH6h9RqE5PIYrkFqsB7MNmQt6', 0, NULL, 'no-avatar.jpg', '4gx8jvaqpTwx2h06ed17wt6bHfqTmipEeREu9Cku3W5yFfsEaFau9FgGI4z7', 1, '2020-07-16 02:58:29', '2020-07-16 03:21:44', 1),
(10, '666666', '666666', 'quangchienicty@gmail.com', '$2y$10$w2HIYr.42v5zTAq3lDyACenLpMlSQMMtRVKK2YkRQGYDkKxpdwHU2', 1, NULL, 'no-avatar.jpg', '96rW773OroHp8Ro2sCATAWPw0cBixX9IZnPOk9QF2QcwNLJfqLtxuJtGpeD2', 1, '2020-07-16 03:17:53', '2020-07-16 03:17:53', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `motelrooms`
--
ALTER TABLE `motelrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motelrooms_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `motelrooms`
--
ALTER TABLE `motelrooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `motelrooms`
--
ALTER TABLE `motelrooms`
  ADD CONSTRAINT `motelrooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
