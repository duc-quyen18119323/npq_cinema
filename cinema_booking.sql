-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 03:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Quản trị viên', 'admin', '$2y$12$b2TSRgX//EG8d1w5R4ewRORUzSEB3oOeW5yx/zWhzTtJ2zCNZBXTy', NULL, '2025-04-26 10:13:09', '2025-04-26 10:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `showtime_id` bigint(20) UNSIGNED NOT NULL,
  `seat_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_code` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `status` enum('unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `showtime_id`, `seat_id`, `ticket_code`, `customer_name`, `customer_phone`, `status`, `created_at`, `updated_at`) VALUES
(6, NULL, 14, 73, '', 'quyen', '32323232', 'unpaid', '2025-04-25 13:11:52', '2025-04-25 13:11:52'),
(7, NULL, 14, 74, '', 'quyen', '32323232', 'unpaid', '2025-04-25 13:11:52', '2025-04-25 13:11:52'),
(8, NULL, 14, 51, '', 'quyen', '32323232', 'unpaid', '2025-04-25 13:13:57', '2025-04-25 13:13:57'),
(9, NULL, 14, 21, '', 'quyen', '32323232', 'unpaid', '2025-04-25 13:14:29', '2025-04-25 13:14:29'),
(10, NULL, 14, 22, '', 'quyen', '32323232', 'unpaid', '2025-04-25 13:14:29', '2025-04-25 13:14:29'),
(11, NULL, 14, 72, '', 'quyen', '32323232', 'unpaid', '2025-04-25 13:14:43', '2025-04-25 13:14:43'),
(12, NULL, 14, 71, '', 'quyen', '32323232', 'unpaid', '2025-04-25 13:14:43', '2025-04-25 13:14:43'),
(13, NULL, 14, 52, 'VE2025042500013', 'quyen', '32323232', 'unpaid', '2025-04-25 13:29:05', '2025-04-25 13:29:05'),
(14, NULL, 14, 63, 'VE2025042600014', 'quyen', '32323232', 'unpaid', '2025-04-25 23:25:39', '2025-04-25 23:25:39'),
(15, NULL, 14, 54, 'VE2025042600015', 'quyen', '32323232', 'unpaid', '2025-04-25 23:46:01', '2025-04-25 23:46:01'),
(17, NULL, 14, 79, 'VE2025042600017', 'quyen', '32323232', 'unpaid', '2025-04-26 08:52:29', '2025-04-26 08:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_25_124503_create_movies_table', 1),
(5, '2025_04_25_124506_create_rooms_table', 1),
(6, '2025_04_25_124510_create_seats_table', 1),
(7, '2025_04_25_124513_create_showtimes_table', 1),
(8, '2025_04_25_124516_create_bookings_table', 1),
(9, '2025_04_25_124522_create_payments_table', 1),
(10, '2025_04_25_141111_add_is_admin_to_users_table', 1),
(11, '2025_04_26_193100_add_user_id_to_bookings_table', 2),
(12, '2025_04_26_000000_create_admins_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `trailer_url` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `status` enum('coming_soon','now_showing') NOT NULL DEFAULT 'coming_soon',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `trailer_url`, `duration`, `poster`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Black Panther: Wakanda Forever', 'Sau cái chết của T’Challa, Wakanda chiến đấu để bảo vệ vương quốc.', 'https://www.youtube.com/watch?v=5PSNL1qE6VY', 161, 'https://image.tmdb.org/t/p/w500/sv1xJUazXeYqALzczSZ3O6nkH75.jpg', 'now_showing', NULL, NULL),
(5, 'The Marvels', 'Carol Danvers, Kamala Khan và Monica Rambeau hợp lực chống lại một mối đe dọa vũ trụ.', 'https://www.youtube.com/watch?v=wS_qbDztgVY', 105, 'https://image.tmdb.org/t/p/w500/Ag3D9qXjhJ2FUkrlJ0Cv1pgx7Jc.jpg', 'coming_soon', NULL, NULL),
(6, 'The Flash', 'Barry Allen sử dụng tốc độ để thay đổi quá khứ, gây ra hậu quả nguy hiểm.', 'https://www.youtube.com/watch?v=hebWYacbdvc', 144, 'https://image.tmdb.org/t/p/w500/rktDFPbfHfUbArZ6OOOKsXcv0Bm.jpg', 'now_showing', NULL, NULL),
(7, 'Aquaman and the Lost Kingdom', 'Arthur phải bảo vệ Atlantis khỏi một mối đe dọa cổ đại.', 'https://www.youtube.com/watch?v=UGc5Acg4E2E', 123, 'https://image.tmdb.org/t/p/w500/xgGGinKRL8xeRkaAR9RMbtyk60y.jpg', 'coming_soon', NULL, NULL),
(8, 'The Batman', 'Bruce Wayne đối mặt với tên sát nhân bí ẩn trong thành phố Gotham.', 'https://www.youtube.com/watch?v=mqqft2x_Aa4', 176, 'https://image.tmdb.org/t/p/w500/74xTEgt7R36Fpooo50r9T25onhq.jpg', 'now_showing', NULL, NULL),
(9, 'Oppenheimer', 'Câu chuyện về cha đẻ của bom nguyên tử.', 'https://www.youtube.com/watch?v=uYPbbksJxIg', 180, 'https://image.tmdb.org/t/p/w500/ptpr0kGAckfQkJeJIt8st5dglvd.jpg', 'now_showing', NULL, NULL),
(10, 'Barbie', 'Barbie rời thế giới búp bê để khám phá thế giới thật.', 'https://www.youtube.com/watch?v=pBk4NYhWNMM', 114, 'https://image.tmdb.org/t/p/w500/iuFNMS8U5cb6xfzi51Dbkovj7vM.jpg', 'now_showing', NULL, NULL),
(11, 'Wonka', 'Câu chuyện khởi nguồn của Willy Wonka và nhà máy sô-cô-la.', 'https://www.youtube.com/watch?v=otNh9bTjXWg', 117, 'https://image.tmdb.org/t/p/w500/qhb1qOilapbapxWQn9jtRCMwXJF.jpg', 'coming_soon', NULL, NULL),
(12, 'Guardians of the Galaxy Vol. 3', 'Nhóm Vệ Binh thực hiện nhiệm vụ cuối cùng để bảo vệ vũ trụ.', 'https://www.youtube.com/watch?v=u3V5KDHRQvk', 150, 'https://image.tmdb.org/t/p/w500/r2J02Z2OpNTctfOSN1Ydgii51I3.jpg', 'now_showing', NULL, NULL),
(13, 'John Wick: Chapter 4', 'John Wick chiến đấu với các tổ chức sát thủ toàn cầu.', 'https://www.youtube.com/watch?v=qEVUtrk8_B4', 169, 'https://image.tmdb.org/t/p/w500/vZloFAK7NmvMGKE7VkF5UHaz0I.jpg', 'now_showing', NULL, NULL),
(14, 'Fast X', 'Gia đình Dominic Toretto đối đầu với một kẻ thù nguy hiểm.', 'https://www.youtube.com/watch?v=eoOaKN4qCKw', 141, 'https://image.tmdb.org/t/p/w500/fiVW06jE7z9YnO4trhaMEdclSiC.jpg', 'now_showing', NULL, NULL),
(15, 'Transformers: Rise of the Beasts', 'Autobots hợp lực với Maximals để cứu Trái Đất.', 'https://www.youtube.com/watch?v=itnqEauWQZM', 127, 'https://image.tmdb.org/t/p/w500/gPbM0MK8CP8A174rmUwGsADNYKD.jpg', 'now_showing', NULL, NULL),
(16, 'The Super Mario Bros. Movie', 'Mario và Luigi phiêu lưu vào vương quốc nấm.', 'https://www.youtube.com/watch?v=TnGl01FkMMo', 92, 'https://image.tmdb.org/t/p/w500/qNBAXBIQlnOThrVvA6mA2B5ggV6.jpg', 'now_showing', NULL, NULL),
(17, 'Mission: Impossible – Dead Reckoning Part One', 'Ethan Hunt đối đầu với mối đe dọa công nghệ toàn cầu.', 'https://www.youtube.com/watch?v=avz06PDqDbM', 163, 'https://image.tmdb.org/t/p/w500/NNxYkU70HPurnNCSiCjYAmacwm.jpg', 'now_showing', NULL, NULL),
(18, 'Elemental', 'Một thế giới nơi các nguyên tố sống động và tương tác.', 'https://www.youtube.com/watch?v=hXzcyx9V0xw', 102, 'https://image.tmdb.org/t/p/w500/4Y1WNkd88JXmGfhtWR7dmDAo1T2.jpg', 'coming_soon', NULL, NULL),
(19, 'Indiana Jones and the Dial of Destiny', 'Indiana quay lại trong một cuộc phiêu lưu cuối cùng.', 'https://www.youtube.com/watch?v=eQfMbSe7F2g', 154, 'https://image.tmdb.org/t/p/w500/Af4bXE63pVsb2FtbW8uYIyPBadD.jpg', 'now_showing', NULL, NULL),
(20, 'The Hunger Games: The Ballad of Songbirds and Snakes', 'Tiền truyện kể về Tổng thống Snow thời trẻ.', 'https://www.youtube.com/watch?v=RDE6Uz73A7g', 157, 'https://image.tmdb.org/t/p/w500/mBaXZ95R2OxueZhvQbcEWy2DqyO.jpg', 'coming_soon', NULL, NULL),
(21, 'The Creator', 'Cuộc chiến giữa loài người và trí tuệ nhân tạo.', 'https://www.youtube.com/watch?v=ex3C1-5Dhb8', 133, 'https://image.tmdb.org/t/p/w500/vBZ0qvaRxqEhZwl6LWmruJqWE8Z.jpg', 'now_showing', NULL, NULL),
(22, 'Killers of the Flower Moon', 'Vụ án mạng bí ẩn trong cộng đồng người da đỏ Osage.', 'https://www.youtube.com/watch?v=EP34Yoxs3FQ', 206, 'https://image.tmdb.org/t/p/w500/dB6Krk806zeqd0YNp2ngQ9zXteH.jpg', 'now_showing', NULL, NULL),
(23, 'Dungeons & Dragons: Honor Among Thieves', 'Nhóm trộm bất đắc dĩ vô tình giải thoát thế lực hắc ám.', 'https://www.youtube.com/watch?v=IiMinixSXII', 134, 'https://image.tmdb.org/t/p/w500/A7AoNT06aRAc4SV89Dwxj3EYAgC.jpg', 'now_showing', NULL, NULL),
(24, 'Napoleon', 'Napoleon Bonaparte chinh phục châu Âu.', 'https://www.youtube.com/watch?v=OAZWXUkrjPc', 158, 'https://image.tmdb.org/t/p/w500/4CcUgdiGe83MeqJW1NyJVmZg78Y.jpg', 'coming_soon', NULL, NULL),
(25, 'Blue Beetle', 'Một thiếu niên vô tình sở hữu sức mạnh siêu nhân ngoài hành tinh.', 'https://www.youtube.com/watch?v=vS3_72Gb-bI', 127, 'https://image.tmdb.org/t/p/w500/mXLOHHc1Zeuwsl4xYKjKh2280oL.jpg', 'coming_soon', NULL, NULL),
(26, 'Kraven the Hunter', 'Một kẻ săn mồi thành siêu nhân.', 'https://www.youtube.com/watch?v=rze8QYwWGMs', 110, 'https://image.tmdb.org/t/p/w500/cINdG7wGmkFjP9YxzUdTk4VtIk1.jpg', 'coming_soon', NULL, NULL),
(27, 'Wish', 'Một cô gái ước có sức mạnh để cứu vương quốc.', 'https://www.youtube.com/watch?v=oyRxxpD3yNw', 95, 'https://image.tmdb.org/t/p/w500/kdPMUMJzyYAc4roD52qavX0nLIC.jpg', 'coming_soon', NULL, NULL),
(28, 'Trolls Band Together', 'Trolls phiêu lưu trong một hành trình âm nhạc.', 'https://www.youtube.com/watch?v=Ft2Z6ZgoKxI', 92, 'https://image.tmdb.org/t/p/w500/bkpPTZUdq31UGDovmszsg2CchiI.jpg', 'coming_soon', NULL, NULL),
(29, 'Five Nights at Freddy\'s', 'Bảo vệ đêm đối mặt với linh hồn trong nhà hàng Freddy.', 'https://www.youtube.com/watch?v=0VH9WCFV6XQ', 109, 'https://image.tmdb.org/t/p/w500/A4j8S6moJS2zNtRR8oWF08gRnL5.jpg', 'now_showing', NULL, NULL),
(30, 'The Nun II', 'Ác quỷ Valak trở lại trong tu viện ma ám.', 'https://www.youtube.com/watch?v=QF-oyCwaArU', 110, 'https://image.tmdb.org/t/p/w500/5gzzkR7y3hnY8AD1wXjCnVlHba5.jpg', 'now_showing', NULL, NULL),
(31, 'Haunted Mansion', 'Gia đình khám phá bí mật kinh hoàng trong biệt thự.', 'https://www.youtube.com/watch?v=AjLKTz81bj8', 122, 'https://image.tmdb.org/t/p/w500/9n2tJBplPbgR2ca05hS5CKXwP2c.jpg', 'now_showing', NULL, NULL),
(32, 'Meg 2: The Trench', 'Cá mập khổng lồ trở lại từ vực sâu.', 'https://www.youtube.com/watch?v=dG91B3hHyY4', 116, 'https://image.tmdb.org/t/p/w500/4m1Au3YkjTsSd0YzN2QHZ6ZM6G0.jpg', 'now_showing', NULL, NULL),
(33, 'The Exorcist: Believer', 'Quỷ ám trở lại trong phần tiếp theo kinh điển.', 'https://www.youtube.com/watch?v=2avW7NO_p_o', 111, 'https://image.tmdb.org/t/p/w500/r9oTasGQofvkQY5vlUXglneF64Z.jpg', 'now_showing', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_time` timestamp NULL DEFAULT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_seats` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `total_seats`, `created_at`, `updated_at`) VALUES
(1, 'Phòng 1', 80, '2025-04-25 09:57:41', '2025-04-26 03:47:30'),
(2, 'Phòng 2', 80, '2025-04-25 09:57:41', '2025-04-26 03:47:37'),
(3, 'Phòng 3', 80, '2025-04-25 09:57:41', '2025-04-26 03:47:42'),
(4, 'Phòng 4', 80, '2025-04-25 09:57:41', '2025-04-26 03:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `row` char(1) DEFAULT NULL,
  `col` int(11) DEFAULT NULL,
  `seat_number` varchar(255) NOT NULL,
  `type` enum('thuong','vip','sweetbox','trungtam') DEFAULT 'thuong',
  `is_double` tinyint(1) DEFAULT 0,
  `price` int(11) DEFAULT 70000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `room_id`, `row`, `col`, `seat_number`, `type`, `is_double`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'A1', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(2, 1, NULL, NULL, 'A2', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(3, 1, NULL, NULL, 'A3', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(4, 1, NULL, NULL, 'A4', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(5, 1, NULL, NULL, 'A5', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(6, 1, NULL, NULL, 'A6', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(7, 1, NULL, NULL, 'A7', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(8, 1, NULL, NULL, 'A8', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(9, 1, NULL, NULL, 'A9', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(10, 1, NULL, NULL, 'A10', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(11, 1, NULL, NULL, 'B1', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(12, 1, NULL, NULL, 'B2', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(13, 1, NULL, NULL, 'B3', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(14, 1, NULL, NULL, 'B4', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(15, 1, NULL, NULL, 'B5', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(16, 1, NULL, NULL, 'B6', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(17, 1, NULL, NULL, 'B7', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(18, 1, NULL, NULL, 'B8', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(19, 1, NULL, NULL, 'B9', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(20, 1, NULL, NULL, 'B10', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(21, 1, NULL, NULL, 'C1', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(22, 1, NULL, NULL, 'C2', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(23, 1, NULL, NULL, 'C3', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(24, 1, NULL, NULL, 'C4', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(25, 1, NULL, NULL, 'C5', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(26, 1, NULL, NULL, 'C6', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(27, 1, NULL, NULL, 'C7', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(28, 1, NULL, NULL, 'C8', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(29, 1, NULL, NULL, 'C9', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(30, 1, NULL, NULL, 'C10', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(31, 1, NULL, NULL, 'D1', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(32, 1, NULL, NULL, 'D2', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(33, 1, NULL, NULL, 'D3', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(34, 1, NULL, NULL, 'D4', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(35, 1, NULL, NULL, 'D5', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(36, 1, NULL, NULL, 'D6', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(37, 1, NULL, NULL, 'D7', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(38, 1, NULL, NULL, 'D8', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(39, 1, NULL, NULL, 'D9', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(40, 1, NULL, NULL, 'D10', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(41, 1, NULL, NULL, 'E1', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(42, 1, NULL, NULL, 'E2', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(43, 1, NULL, NULL, 'E3', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(44, 1, NULL, NULL, 'E4', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(45, 1, NULL, NULL, 'E5', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(46, 1, NULL, NULL, 'E6', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(47, 1, NULL, NULL, 'E7', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(48, 1, NULL, NULL, 'E8', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(49, 1, NULL, NULL, 'E9', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(50, 1, NULL, NULL, 'E10', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(51, 1, NULL, NULL, 'F1', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(52, 1, NULL, NULL, 'F2', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(53, 1, NULL, NULL, 'F3', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(54, 1, NULL, NULL, 'F4', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(55, 1, NULL, NULL, 'F5', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(56, 1, NULL, NULL, 'F6', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(57, 1, NULL, NULL, 'F7', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(58, 1, NULL, NULL, 'F8', 'vip', 0, 100000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(59, 1, NULL, NULL, 'F9', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(60, 1, NULL, NULL, 'F10', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(61, 1, NULL, NULL, 'G1', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(62, 1, NULL, NULL, 'G2', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(63, 1, NULL, NULL, 'G3', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(64, 1, NULL, NULL, 'G4', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(65, 1, NULL, NULL, 'G5', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(66, 1, NULL, NULL, 'G6', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(67, 1, NULL, NULL, 'G7', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(68, 1, NULL, NULL, 'G8', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(69, 1, NULL, NULL, 'G9', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(70, 1, NULL, NULL, 'G10', 'thuong', 0, 70000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(71, 1, NULL, NULL, 'H1', 'sweetbox', 1, 125000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(72, 1, NULL, NULL, 'H2', 'sweetbox', 1, 125000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(73, 1, NULL, NULL, 'H3', 'sweetbox', 1, 125000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(74, 1, NULL, NULL, 'H4', 'sweetbox', 1, 125000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(75, 1, NULL, NULL, 'H5', 'sweetbox', 1, 125000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(76, 1, NULL, NULL, 'H6', 'sweetbox', 1, 125000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(77, 1, NULL, NULL, 'H7', 'sweetbox', 1, 125000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(78, 1, NULL, NULL, 'H8', 'sweetbox', 1, 125000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(79, 1, NULL, NULL, 'H9', 'sweetbox', 1, 125000, '2025-04-25 09:57:41', '2025-04-25 09:57:41'),
(80, 1, NULL, NULL, 'H10', 'sweetbox', 1, 125000, '2025-04-25 09:57:41', '2025-04-25 09:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('obQHkchXBKzB3kMgotSzsvWunzDNkwswXsZHwoJR', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMEtENTdCUEg1dnd1TkxPS0htWkh0SVpBeFBsbkJLV0pTZHA0QzZ5eCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZWF0cy9zaG93P3Nob3d0aW1lX2lkPTE2Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxODoiaXNfYWRtaW5fbG9nZ2VkX2luIjtiOjE7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1745697134);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `show_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`id`, `movie_id`, `room_id`, `show_date`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(12, 5, 1, '2025-04-27', '18:00:00', '20:00:00', '2025-04-25 17:18:16', '2025-04-25 17:18:16'),
(13, 6, 2, '2025-04-28', '20:30:00', '22:30:00', '2025-04-25 17:18:16', '2025-04-25 17:18:16'),
(14, 6, 1, '2025-04-27', '14:00:00', '16:00:00', '2025-04-25 17:18:16', '2025-04-25 17:18:16'),
(15, 7, 2, '2025-04-29', '16:30:00', '18:30:00', '2025-04-25 17:18:16', '2025-04-25 17:18:16'),
(16, 4, 2, '2025-04-26', '20:51:00', '22:10:00', '2025-04-26 03:49:07', '2025-04-26 03:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-04-25 09:57:42', '$2y$12$w6N0PEOzv7rcQ87xN1Y5Q.nE53829q6a75jtWvdAAiy/qXjOp36W2', 0, 'AeVG7StQlJ', '2025-04-25 09:57:42', '2025-04-25 09:57:42'),
(2, 'ducquyen', 'ducquyen202020@gmail.com', NULL, '$2y$12$He0.q/ZYe/fHGGje/3tdpOwcQZN5CL0vuJFPcmPqwuyNpi2uSdNYu', 0, 'gnFstjznYKNsFnMkT2ZtUHAbwhKMXZuKEIgynwiEUBuzHiVQXi7O0UVCaIkP', '2025-04-25 10:04:38', '2025-04-25 10:04:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_showtime_id_foreign` (`showtime_id`),
  ADD KEY `bookings_seat_id_foreign` (`seat_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seats_room_id_foreign` (`room_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `showtimes_movie_id_foreign` (`movie_id`),
  ADD KEY `showtimes_room_id_foreign` (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_showtime_id_foreign` FOREIGN KEY (`showtime_id`) REFERENCES `showtimes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `showtimes_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
