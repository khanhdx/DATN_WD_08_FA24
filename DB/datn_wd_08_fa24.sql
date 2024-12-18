-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2024 at 01:58 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datn_wd_08_fa24`
--

-- --------------------------------------------------------

--
-- Table structure for table `bannerhome1s`
--

CREATE TABLE `bannerhome1s` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` enum('main','intro','advertisement') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'advertisement',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Áo trắng có làm anh lo lắng? Lo cháy ví vì shop em sale 50% sập sàn, ghé ngay mua liền tay', 'images/wJCjXG5087vEycSCkV8uA7JuOprKZuF7CKhVLt5L.jpg', 1, 'main', '2024-12-16 13:37:49', '2024-12-16 13:37:49'),
(2, 'Muốn ăn no thì trồng khoai trồng lúa, Muốn làm công chúa thì ghé ngay Obito', 'images/vSybp7jkuQSNcFNiHmzFZMRoplOjDuHFYkmDm8a5.jpg', 1, 'main', '2024-12-16 13:37:49', '2024-12-16 13:37:49'),
(3, 'Nắng mưa là việc của trời Nay có deal hời mua liền chờ chi.', 'images/lRrqVSmVQrb51ML62OWoNv8u1K6M83TzeEGetPca.jpg', 1, 'main', '2024-12-16 13:37:49', '2024-12-16 13:37:49'),
(4, 'Ông trời tạo ra địa chấn Và chiếc đầm này của nhà em là điểm nhấn.', 'images/TIDslN3M5vmpKajoUJoA5IAA6ypMVd7ba3beHXeG.jpg', 1, 'advertisement', '2024-12-16 13:39:37', '2024-12-16 13:39:37'),
(5, 'Yêu nhau cởi áo cho nhau Về nhà mẹ hỏi áo này bao nhiêu?', 'images/avmCbVJgipINfhIYAiRw32GJbuj1TDwrEg0qXeNv.jpg', 1, 'advertisement', '2024-12-16 13:39:37', '2024-12-16 13:40:24'),
(6, 'Bỏ lỡ bình minh có thể ngắm vào ngày mai Bỏ lỡ em, chắc chắn không có lần hai.', 'images/U5wMTbYkgLHiCQZovYBgXApwdzXSE3WMc1CArTxz.jpg', 1, 'advertisement', '2024-12-16 13:39:37', '2024-12-16 13:40:34'),
(7, 'Cơm không ăn thì gạo còn đó Đồ sale không ngó thì khó mà ngủ yên.', 'images/1KDLlI9H44eZ8b0nQ0krzgB3NOhAqmJFGPg92Qav.jpg', 1, 'intro', '2024-12-16 13:41:01', '2024-12-16 13:41:01');

-- --------------------------------------------------------

--
-- Table structure for table `banner_home2s`
--

CREATE TABLE `banner_home2s` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocked_users`
--

CREATE TABLE `blocked_users` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `guest_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_items` json DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `guest_id`, `cart_items`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 13, '2024-12-16 13:41:58', '2024-12-16 13:41:58'),
(2, NULL, NULL, 14, '2024-12-16 13:42:19', '2024-12-16 13:42:19'),
(3, NULL, NULL, 15, '2024-12-16 13:42:53', '2024-12-16 13:42:53'),
(4, NULL, NULL, 11, '2024-12-16 13:44:38', '2024-12-16 13:44:38'),
(5, NULL, NULL, 16, '2024-12-16 14:07:55', '2024-12-16 14:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `quantity` bigint NOT NULL,
  `sub_total` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Man','Woman') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Áo nam', 'Man', NULL, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(2, 'Quần nam', 'Man', NULL, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(3, 'Set bộ nam', 'Man', NULL, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(4, 'Áo nữ', 'Woman', NULL, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(5, 'Quần nữ', 'Woman', NULL, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(6, 'Set bộ nữ', 'Woman', NULL, '2024-12-16 13:23:48', '2024-12-16 13:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `chat_rooms`
--

CREATE TABLE `chat_rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `last_message_time` datetime NOT NULL DEFAULT '2024-12-16 20:23:47',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_rooms`
--

INSERT INTO `chat_rooms` (`id`, `user_id`, `last_message_time`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(2, 2, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(3, 3, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(4, 4, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(5, 5, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(6, 6, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(7, 7, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(8, 8, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(9, 9, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(10, 10, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(11, 11, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(12, 12, '2024-12-16 20:23:47', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(13, 13, '2024-12-16 20:23:47', '2024-12-16 13:41:58', '2024-12-16 13:41:58'),
(14, 14, '2024-12-16 20:23:47', '2024-12-16 13:42:19', '2024-12-16 13:42:19'),
(15, 15, '2024-12-16 20:23:47', '2024-12-16 13:42:53', '2024-12-16 13:42:53'),
(16, 16, '2024-12-16 20:23:47', '2024-12-16 14:07:55', '2024-12-16 14:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code_color`, `created_at`, `updated_at`) VALUES
(1, 'Green', '#00FF00', '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(2, 'Blue', '#0000FF', '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(3, 'Yellow', '#FFFF00', '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(4, 'Cyan', '#00FFFF', '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(5, 'Black', '#000000', '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(6, 'White', '#FFFFFF', '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(7, 'Orange', '#FFA500', '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(8, 'Red', '#E81717', '2024-12-16 14:59:13', '2024-12-16 14:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `parent_id`, `is_approved`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 10, 'Cung cấp gợi ý về cách tạo nên các bộ trang phục phù hợp', NULL, 0, 'pending', '2024-12-16 13:53:42', '2024-12-16 13:53:42'),
(2, 13, 10, 'đánh giá về những mẫu quần áo nổi bật', NULL, 0, 'pending', '2024-12-16 13:54:26', '2024-12-16 13:54:26'),
(3, 13, 10, 'phù hợp r đấy', 1, 0, 'pending', '2024-12-16 13:54:45', '2024-12-16 13:54:45'),
(4, 13, 9, 'chất liệu và chất lượng', NULL, 0, 'pending', '2024-12-16 13:55:58', '2024-12-16 13:55:58'),
(5, 13, 8, 'bảo quản quần áo theo đúng cách', NULL, 0, 'pending', '2024-12-16 13:56:15', '2024-12-16 13:56:15'),
(6, 14, 7, 'xin chào bạn', NULL, 0, 'pending', '2024-12-16 13:56:38', '2024-12-16 13:56:38'),
(7, 14, 5, 'tôi có đầy đủ các bộ sưu tập', NULL, 0, 'pending', '2024-12-16 13:56:58', '2024-12-16 13:56:58'),
(8, 14, 9, 'tuyệt !', 4, 0, 'pending', '2024-12-16 13:57:30', '2024-12-16 13:57:30'),
(9, 14, 6, 'Tạo ra nội dung liên quan đến cộng đồng', NULL, 0, 'pending', '2024-12-16 13:57:50', '2024-12-16 13:57:50'),
(10, 14, 8, 'hợp lý', 5, 0, 'pending', '2024-12-16 13:58:02', '2024-12-16 13:58:02'),
(11, 14, 7, 'tôi muốn nhiều hơn', NULL, 0, 'pending', '2024-12-16 13:58:17', '2024-12-16 13:58:17'),
(12, 14, 9, 'xin chào các bạn ạ', NULL, 0, 'pending', '2024-12-16 13:58:47', '2024-12-16 13:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjec` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stocks`
--

CREATE TABLE `inventory_stocks` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED DEFAULT NULL,
  `stock_change` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'import: Nhập hàng, export: Xuất hàng, adjustment: Chỉnh sửa tồn kho, return: Trả hàng',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_stocks`
--

INSERT INTO `inventory_stocks` (`id`, `product_id`, `product_variant_id`, `stock_change`, `type`, `created_at`, `updated_at`) VALUES
(1, 31, 631, 23, 'Nhập hàng', '2024-12-16 14:58:13', '2024-12-16 14:58:13'),
(2, 31, 632, 45, 'Nhập hàng', '2024-12-16 14:58:13', '2024-12-16 14:58:13'),
(3, 31, 633, 12, 'Nhập hàng', '2024-12-16 14:58:40', '2024-12-16 14:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `location_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Mặc định','Phụ') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `user_id`, `location_name`, `user_name`, `phone_number`, `location_detail`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 'tam hưng-thanh oai-hà nội', 'user', '0333464071', 'Thành phố Hà Nội-Quận Nam Từ Liêm-Phường Cầu Diễn-số 12, ngõ 139, cầu diễn', 'Mặc định', '2024-12-16 13:44:24', '2024-12-16 13:44:24'),
(2, 13, 'tam hưng-thanh oai-hà nội', 'MInh Đức', '0345445247', 'Thành phố Hà Nội-Quận Đống Đa-Phường Cát Linh-ngõ 11, cát linh', 'Mặc định', '2024-12-16 13:47:44', '2024-12-16 13:47:44'),
(3, 14, 'Trịnh văn bô', 'xuân khánh', '0386249023', 'Thành phố Hà Nội-Quận Ba Đình-Phường Đội Cấn-ngõ 123, đội cấn', 'Mặc định', '2024-12-16 13:49:37', '2024-12-16 13:49:37'),
(4, 15, 'phương canh', 'khánh đẹp zai', '0987654321', 'Thành phố Hà Nội-Quận Nam Từ Liêm-Phường Phương Canh-ngõ 21, phương canh', 'Mặc định', '2024-12-16 13:51:20', '2024-12-16 13:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `chat_room_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_00_00_000000_create_websockets_statistics_entries_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_09_22_152740_create_posts_table', 1),
(7, '2024_09_23_135320_create_colors_table', 1),
(8, '2024_09_23_135330_create_sizes_table', 1),
(9, '2024_09_24_062303_create_locations_table', 1),
(10, '2024_09_25_070737_create_categories_table', 1),
(11, '2024_09_25_070943_create_products_table', 1),
(12, '2024_09_29_024544_create_product_variants_table', 1),
(13, '2024_10_01_032957_add_views_to_posts_table', 1),
(14, '2024_10_02_153616_create_product_images_table', 1),
(15, '2024_10_03_025427_create_vouchers_table', 1),
(16, '2024_10_03_050301_create_banners_table', 1),
(17, '2024_10_05_012021_add_delete_at_to_ptoducts_table', 1),
(18, '2024_10_09_082130_create_status_orders_table', 1),
(19, '2024_10_09_082313_create_shippers_table', 1),
(20, '2024_10_09_082500_create_orders_table', 1),
(21, '2024_10_09_083127_create_order_details_table', 1),
(22, '2024_10_10_083357_create_carts_table', 1),
(23, '2024_10_10_083613_create_cart_items_table', 1),
(24, '2024_10_10_163033_create_status_order_details_table', 1),
(25, '2024_10_10_164125_create_payments_table', 1),
(26, '2024_10_10_232633_create_refunds_table', 1),
(27, '2024_10_22_083600_create_vouchers_wares_table', 1),
(28, '2024_10_24_130803_create_contacts_table', 1),
(29, '2024_10_27_085947_create_inventory_stocks_table', 1),
(30, '2024_10_28_070434_create_bannerhome1s_table', 1),
(31, '2024_10_28_085804_create_banner_home2s_table', 1),
(32, '2024_10_30_035216_create_reviews_table', 1),
(33, '2024_10_30_114513_create_voucher_wares_table', 1),
(34, '2024_11_04_143737_create_wares_lists_table', 1),
(35, '2024_11_19_173744_create_chat_rooms_table', 1),
(36, '2024_11_19_173753_create_messages_table', 1),
(37, '2024_11_28_085749_create_blocked_users_table', 1),
(38, '2024_12_11_171006_create_comments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_fee` double DEFAULT NULL,
  `shipper_id` bigint UNSIGNED DEFAULT NULL,
  `voucher_id` bigint UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` double NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `slug`, `user_id`, `order_code`, `shipping_fee`, `shipper_id`, `voucher_id`, `date`, `user_name`, `email`, `phone_number`, `total_price`, `address`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Order-433720241216', NULL, 'LDMFRX', 20500, NULL, NULL, '2024-12-16 21:00:36', 'hòa', 'hoadz@gmail.com', '0368356298', 1126000, 'áp 9, long an', NULL, '2024-12-16 14:00:36', '2024-12-16 14:00:36'),
(2, 'Order-550520241216', NULL, 'LDMFRA', 22000, NULL, NULL, '2024-12-16 21:01:37', 'hòa', 'dangkhanh16012004@gmail.com', '0333464071', 747000, 'hà nội', NULL, '2024-12-10 14:01:37', '2024-12-16 14:01:37'),
(3, 'Order-392620241216', NULL, 'LDMFR8', 22000, NULL, NULL, '2024-12-16 21:02:32', 'huy', 'huy04@gmail.com', '0333464071', 867000, 'hà nội', NULL, '2024-12-14 14:02:32', '2024-12-16 14:02:32'),
(4, 'Order-280120241216', 16, 'LDMFMF', 22000, NULL, NULL, '2024-12-16 21:09:41', 'miumiu', 'meo@gmail.com', '0333464789', 817000, 'hà nội', NULL, '2024-12-09 14:09:41', '2024-12-16 14:09:41'),
(5, 'Order-489420241216', 11, 'LDMFMU', 22000, NULL, NULL, '2024-12-16 21:14:49', 'User', 'test@gmail.com', '0333464071', 3933000, 'hà nội', NULL, '2024-12-01 14:14:49', '2024-12-16 14:14:49'),
(6, 'Order-662020241216', 11, 'LDMFMC', 22000, NULL, NULL, '2024-12-16 21:18:24', 'User', 'test@gmail.com', '0333464071', 407000, 'hà nội', NULL, '2024-12-06 14:18:24', '2024-12-16 14:18:24'),
(7, 'Order-218820241216', 14, 'LDMFM9', 22000, NULL, NULL, '2024-12-16 21:21:43', 'khanhdx', 'dangkhanh16012004@gmail.com', '0398056789', 1702000, 'hà nội', NULL, '2024-11-29 14:21:43', '2024-12-16 14:21:43'),
(8, 'Order-803120241216', 14, 'LDMFMV', 22000, NULL, NULL, '2024-12-16 21:24:04', 'khanhdx', 'dangkhanh16012004@gmail.com', '0398056789', 125000, 'hà nội', 'ghjh', '2024-11-25 14:24:04', '2024-12-16 14:24:04'),
(9, 'Order-116720241216', 15, 'LDMFM6', 22000, NULL, NULL, '2024-12-16 21:27:06', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 885000, 'hà nội', 'fgh', '2024-11-19 14:27:06', '2024-12-16 14:27:06'),
(10, 'Order-870020241216', 15, 'LDMFMD', 22000, NULL, NULL, '2024-12-16 21:30:18', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 332000, 'hà nội', NULL, '2024-11-11 14:30:18', '2024-12-16 14:30:18'),
(11, 'Order-803020241216', 15, 'LDMFMP', 22000, NULL, NULL, '2024-12-16 21:31:36', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 195000, 'hà nội', NULL, '2024-10-16 14:31:36', '2024-12-16 14:31:36'),
(12, 'Order-651120241216', NULL, 'LDMFM4', 22000, NULL, NULL, '2024-12-16 21:47:51', 'Bình', 'binh@gmail.com', '0333464071', 125000, 'hà nội', 'sff', '2024-10-08 14:47:51', '2024-12-16 14:47:51'),
(13, 'Order-315420241216', 11, 'LDMFMK', 22000, NULL, 1, '2024-12-16 21:50:54', 'User', 'test@gmail.com', '0333464071', 25000, 'hà nội', NULL, '2024-10-24 14:50:54', '2024-12-16 14:50:54'),
(14, 'Order-947520241216', 11, 'LDMFMT', 22000, NULL, NULL, '2024-12-16 21:53:31', 'User', 'test@gmail.com', '0333464071', 407000, 'hà nội', NULL, '2024-10-06 14:53:31', '2024-12-16 14:53:31'),
(15, 'Order-355920241216', 16, 'LDM79P', 20500, NULL, NULL, '2024-12-16 23:32:43', 'miumiu', 'meo@gmail.com', '0333464789', 533000, 'an khanh', NULL, '2024-12-16 16:32:43', '2024-12-16 16:32:43'),
(16, 'Order-670620241216', 16, 'LDM79B', 20500, NULL, NULL, '2024-12-16 23:35:26', 'miumiu', 'meo@gmail.com', '0333464789', 735000, 'Phường 3', NULL, '2024-12-15 16:35:26', '2024-12-16 16:35:26'),
(17, 'Order-152220241216', 16, 'LDM793', 22000, NULL, NULL, '2024-12-16 23:38:20', 'miumiu', 'meo@gmail.com', '0333464789', 411000, 'hà nội', NULL, '2024-12-14 16:38:20', '2024-12-16 16:38:20'),
(18, 'Order-739320241216', 16, 'LDM794', 22000, NULL, NULL, '2024-12-16 23:39:29', 'miumiu', 'meo@gmail.com', '0333464789', 262000, 'hà nội', 'fgdhfd', '2024-12-13 16:39:29', '2024-12-16 16:39:29'),
(19, 'Order-293420241216', 16, 'LDM79K', 22000, NULL, NULL, '2024-12-16 23:41:13', 'miumiu', 'meo@gmail.com', '0333464789', 70000, 'hà nội', NULL, '2024-10-15 16:41:13', '2024-12-16 16:41:13'),
(20, 'Order-705220241216', 16, 'LDM79W', 22000, NULL, NULL, '2024-12-16 23:42:42', 'miumiu', 'meo@gmail.com', '0333464789', 70000, 'hà nội', NULL, '2024-10-14 16:42:42', '2024-12-16 16:42:42'),
(21, 'Order-881320241216', 14, 'LDM79H', 22000, NULL, NULL, '2024-12-16 23:43:50', 'khanhdx', 'dangkhanh16012004@gmail.com', '0398056789', 70000, 'hà nội', NULL, '2024-10-10 16:43:50', '2024-12-16 16:43:50'),
(22, 'Order-384520241216', 14, 'LDM79A', 22000, NULL, NULL, '2024-12-16 23:44:24', 'khanhdx', 'dangkhanh16012004@gmail.com', '0398056789', 70000, 'hà nội', NULL, '2024-11-05 16:44:24', '2024-12-16 16:44:24'),
(23, 'Order-816620241216', 14, 'LDM79Y', 22000, NULL, NULL, '2024-12-16 23:44:55', 'khanhdx', 'dangkhanh16012004@gmail.com', '0398056789', 173000, 'hà nội', NULL, '2024-11-06 16:44:55', '2024-12-16 16:44:55'),
(24, 'Order-550920241216', 14, 'LDM79R', 22000, NULL, NULL, '2024-12-16 23:45:39', 'khanhdx', 'dangkhanh16012004@gmail.com', '0398056789', 446000, 'hà nội', NULL, '2024-11-07 16:45:39', '2024-12-16 16:45:39'),
(25, 'Order-361520241216', 14, 'LDM79M', 22000, NULL, NULL, '2024-12-16 23:46:20', 'khanhdx', 'dangkhanh16012004@gmail.com', '0398056789', 204000, 'hà nội', NULL, '2024-11-09 16:46:20', '2024-12-16 16:46:20'),
(26, 'Order-802420241216', 14, 'LDM7VQ', 22000, NULL, NULL, '2024-12-16 23:46:47', 'khanhdx', 'dangkhanh16012004@gmail.com', '0398056789', 335000, 'hà nội', NULL, '2024-12-16 16:46:47', '2024-12-16 16:46:47'),
(27, 'Order-869220241216', 13, 'LDM7VL', 22000, NULL, NULL, '2024-12-16 23:48:11', 'Minh Đức', 'minhduc@gmail.com', '0345445247', 323000, 'hà nội', NULL, '2024-12-16 16:48:11', '2024-12-16 16:48:11'),
(28, 'Order-266720241216', 13, 'LDM7VF', 22000, NULL, NULL, '2024-12-16 23:48:57', 'Minh Đức', 'minhduc@gmail.com', '0345445247', 335000, 'hà nội', NULL, '2024-12-16 16:48:57', '2024-12-16 16:48:57'),
(29, 'Order-623220241216', 13, 'LDM7V7', 22000, NULL, NULL, '2024-12-16 23:49:47', 'Minh Đức', 'minhduc@gmail.com', '0345445247', 314000, 'hà nội', NULL, '2024-12-16 16:49:47', '2024-12-16 16:49:47'),
(30, 'Order-219720241216', 13, 'LDM7VU', 22000, NULL, NULL, '2024-12-16 23:50:15', 'Minh Đức', 'minhduc@gmail.com', '0345445247', 325000, 'hà nội', NULL, '2024-12-16 16:50:15', '2024-12-16 16:50:15'),
(31, 'Order-878020241216', 13, 'LDM7V9', 22000, NULL, NULL, '2024-12-16 23:51:13', 'Minh Đức', 'minhduc@gmail.com', '0345445247', 125000, 'hà nội', NULL, '2024-12-16 16:51:13', '2024-12-16 16:51:13'),
(32, 'Order-526120241216', 13, 'LDM7VV', 22000, NULL, NULL, '2024-12-16 23:51:45', 'Minh Đức', 'minhduc@gmail.com', '0345445247', 409000, 'hà nội', NULL, '2024-12-16 16:51:45', '2024-12-16 16:51:45'),
(33, 'Order-856820241216', 13, 'LDM7V6', 22000, NULL, NULL, '2024-12-16 23:52:14', 'Minh Đức', 'minhduc@gmail.com', '0345445247', 149000, 'hà nội', NULL, '2024-12-16 16:52:14', '2024-12-16 16:52:14'),
(34, 'Order-929820241216', 13, 'LDM7VD', 20500, NULL, NULL, '2024-12-16 23:52:38', 'Minh Đức', 'minhduc@gmail.com', '0345445247', 409000, 'hà nội', NULL, '2024-12-16 16:52:38', '2024-12-16 16:52:38'),
(35, 'Order-966720241216', 13, 'LDM7VP', 22000, NULL, NULL, '2024-12-16 23:53:03', 'Minh Đức', 'minhduc@gmail.com', '0345445247', 149000, 'hà nội', NULL, '2024-12-16 16:53:03', '2024-12-16 16:53:03'),
(36, 'Order-779720241216', 13, 'LDM7VB', 22000, NULL, NULL, '2024-12-16 23:54:03', 'Minh Đức', 'minhduc@gmail.com', '0345445247', 314000, 'hà nội', NULL, '2024-12-16 16:54:03', '2024-12-16 16:54:03'),
(37, 'Order-764020241216', 15, 'LDM7V3', 20500, NULL, NULL, '2024-12-16 23:56:41', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 446000, 'phường 7', NULL, '2024-12-16 16:56:41', '2024-12-16 16:56:41'),
(38, 'Order-426420241216', 15, 'LDM7V4', 22000, NULL, NULL, '2024-12-16 23:57:02', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 314000, 'hà nội', NULL, '2024-12-16 16:57:02', '2024-12-16 16:57:02'),
(39, 'Order-902120241216', 15, 'LDM7VK', 22000, NULL, NULL, '2024-12-16 23:57:30', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 314000, 'hà nội', NULL, '2024-12-16 16:57:30', '2024-12-16 16:57:30'),
(40, 'Order-415520241216', 15, 'LDM7VW', 22000, NULL, NULL, '2024-12-16 23:57:57', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 400000, 'hà nội', NULL, '2024-12-16 16:57:57', '2024-12-16 16:57:57'),
(41, 'Order-774220241216', 15, 'LDM7VT', 22000, NULL, NULL, '2024-12-16 23:58:22', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 400000, 'hà nội', NULL, '2024-12-16 16:58:22', '2024-12-16 16:58:22'),
(42, 'Order-154620241216', 11, 'LDM7VH', 22000, NULL, NULL, '2024-12-16 23:59:47', 'User', 'test@gmail.com', '0333464071', 432000, 'hà nội', NULL, '2024-12-16 16:59:47', '2024-12-16 16:59:47'),
(43, 'Order-568820241217', 11, 'LDM7VX', 22000, NULL, NULL, '2024-12-17 00:00:10', 'User', 'test@gmail.com', '0333464071', 70000, 'hà nội', NULL, '2024-12-16 17:00:10', '2024-12-16 17:00:10'),
(44, 'Order-895420241217', 15, 'LDM7VE', 22000, NULL, NULL, '2024-12-17 00:15:55', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 1698000, 'hà nội', 'giao nhanh giúp em nha', '2024-12-16 17:15:55', '2024-12-16 17:15:55'),
(45, 'Order-970020241217', 15, 'LDM76Q', 22000, NULL, NULL, '2024-12-17 00:19:40', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 532000, 'hà nội', NULL, '2024-12-16 17:19:40', '2024-12-16 17:19:40'),
(46, 'Order-564220241217', 15, 'LDM76L', 22000, NULL, NULL, '2024-12-17 00:21:32', 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 732000, 'hà nội', NULL, '2024-12-16 17:21:32', '2024-12-16 17:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `name_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` double NOT NULL,
  `quantity` int NOT NULL,
  `total_price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_variant_id`, `name_product`, `color`, `size`, `unit_price`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 18, 'Áo tanktop Base Jack Lane', 'White', 'S', 151000, 1, 151000, '2024-12-16 14:00:36', '2024-12-16 14:00:36'),
(2, 1, 2, 26, 'Áo khoác dạ Brook Obito', 'Blue', 'M', 268000, 1, 268000, '2024-12-16 14:00:36', '2024-12-16 14:00:36'),
(3, 1, 3, 56, 'Áo khoác dạ Nino Jack Lane', 'Orange', 'M', 325000, 1, 325000, '2024-12-16 14:00:36', '2024-12-16 14:00:36'),
(4, 1, 4, 69, 'Áo khoác Varsity Box Obito', 'Blue', 'S', 382000, 1, 382000, '2024-12-16 14:00:36', '2024-12-16 14:00:36'),
(5, 2, 12, 251, 'Quần Jeans Typo Obito', 'Yellow', 'M', 403000, 1, 403000, '2024-12-16 14:01:37', '2024-12-16 14:01:37'),
(6, 2, 11, 217, 'Áo len sweater Ralz Obito', 'Cyan', 'L', 82000, 1, 82000, '2024-12-16 14:01:37', '2024-12-16 14:01:37'),
(7, 2, 9, 176, 'Áo Polo Oversize WONDER', 'Cyan', 'M', 262000, 1, 262000, '2024-12-16 14:01:37', '2024-12-16 14:01:37'),
(8, 3, 29, 594, 'Quần nỉ dài Relax Pants Obito', 'Blue', 'S', 407000, 1, 407000, '2024-12-16 14:02:32', '2024-12-16 14:02:32'),
(9, 3, 30, 629, 'Set bộ Genne Obito', 'Yellow', 'M', 125000, 1, 125000, '2024-12-16 14:02:32', '2024-12-16 14:02:32'),
(10, 3, 23, 463, 'Áo sơ mi cộc tay original Obito', 'Black', 'L', 335000, 1, 335000, '2024-12-16 14:02:32', '2024-12-16 14:02:32'),
(11, 4, 30, 618, 'Set bộ Genne Obito', 'Cyan', 'S', 125000, 1, 125000, '2024-12-16 14:09:41', '2024-12-16 14:09:41'),
(12, 4, 29, 595, 'Quần nỉ dài Relax Pants Obito', 'Cyan', 'L', 407000, 1, 407000, '2024-12-16 14:09:41', '2024-12-16 14:09:41'),
(13, 4, 28, 587, 'Quần dài kẻ sọc ống rộng Striped Obito', 'Yellow', 'M', 285000, 1, 285000, '2024-12-16 14:09:41', '2024-12-16 14:09:41'),
(14, 5, 30, 624, 'Set bộ Genne Obito', 'Orange', 'S', 125000, 1, 125000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(15, 5, 29, 596, 'Quần nỉ dài Relax Pants Obito', 'Cyan', 'M', 407000, 1, 407000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(16, 5, 28, 575, 'Quần dài kẻ sọc ống rộng Striped Obito', 'Cyan', 'M', 285000, 1, 285000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(17, 5, 27, 558, 'Áo thun Striped Flower Obito', 'Green', 'S', 447000, 1, 447000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(18, 5, 26, 545, 'Áo thun Blue heart Obito', 'Yellow', 'M', 438000, 1, 438000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(19, 5, 21, 440, 'Áo Cardigan Nỉ Henry Obito', 'Yellow', 'M', 126000, 1, 126000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(20, 5, 20, 406, 'Set bộ Frank Obito', 'Cyan', 'L', 432000, 1, 432000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(21, 5, 19, 399, 'Quần dài Noah Obito', 'Yellow', 'S', 409000, 1, 409000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(22, 5, 18, 377, 'Quần Jeans Otis Obito', 'Yellow', 'M', 149000, 1, 149000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(23, 5, 16, 316, 'Quần Short lửng Fiin Obito', 'Black', 'L', 446000, 1, 446000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(24, 5, 15, 300, 'Quần short Light Obito', 'Blue', 'S', 125000, 1, 125000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(25, 5, 14, 293, 'Quần short Jeans lửng Jort Obito', 'Yellow', 'M', 70000, 1, 70000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(26, 5, 13, 268, 'Quần nỉ oversize Wided Pants Obito', 'White', 'L', 212000, 1, 212000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(27, 5, 9, 186, 'Áo Polo Oversize WONDER', 'White', 'S', 262000, 1, 262000, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(28, 6, 13, 272, 'Quần nỉ oversize Wided Pants Obito', 'Yellow', 'M', 212000, 1, 212000, '2024-12-16 14:18:24', '2024-12-16 14:18:24'),
(29, 6, 14, 274, 'Quần short Jeans lửng Jort Obito', 'Black', 'L', 70000, 1, 70000, '2024-12-16 14:18:24', '2024-12-16 14:18:24'),
(30, 6, 15, 315, 'Quần short Light Obito', 'Yellow', 'S', 125000, 1, 125000, '2024-12-16 14:18:24', '2024-12-16 14:18:24'),
(31, 7, 30, 612, 'Set bộ Genne Obito', 'Black', 'S', 125000, 1, 125000, '2024-12-16 14:21:43', '2024-12-16 14:21:43'),
(32, 7, 29, 593, 'Quần nỉ dài Relax Pants Obito', 'Blue', 'M', 407000, 1, 407000, '2024-12-16 14:21:43', '2024-12-16 14:21:43'),
(33, 7, 28, 580, 'Quần dài kẻ sọc ống rộng Striped Obito', 'Orange', 'L', 285000, 1, 285000, '2024-12-16 14:21:43', '2024-12-16 14:21:43'),
(34, 7, 27, 552, 'Áo thun Striped Flower Obito', 'Blue', 'S', 447000, 1, 447000, '2024-12-16 14:21:44', '2024-12-16 14:21:44'),
(35, 7, 26, 545, 'Áo thun Blue heart Obito', 'Yellow', 'M', 438000, 1, 438000, '2024-12-16 14:21:44', '2024-12-16 14:21:44'),
(36, 8, 30, 614, 'Set bộ Genne Obito', 'Blue', 'M', 125000, 1, 125000, '2024-12-16 14:24:04', '2024-12-16 14:24:04'),
(37, 9, 26, 532, 'Áo thun Blue heart Obito', 'Cyan', 'L', 438000, 1, 438000, '2024-12-16 14:27:06', '2024-12-16 14:27:06'),
(38, 9, 27, 559, 'Áo thun Striped Flower Obito', 'Orange', 'L', 447000, 1, 447000, '2024-12-16 14:27:06', '2024-12-16 14:27:06'),
(39, 10, 11, 230, 'Áo len sweater Ralz Obito', 'Yellow', 'M', 82000, 1, 82000, '2024-12-16 14:30:18', '2024-12-16 14:30:18'),
(40, 10, 10, 199, 'Áo polo cộc tay Knit Jack Lane', 'Green', 'L', 250000, 1, 250000, '2024-12-16 14:30:18', '2024-12-16 14:30:18'),
(41, 11, 14, 281, 'Quần short Jeans lửng Jort Obito', 'Cyan', 'M', 70000, 1, 70000, '2024-12-16 14:31:36', '2024-12-16 14:31:36'),
(42, 11, 15, 306, 'Quần short Light Obito', 'Green', 'S', 125000, 1, 125000, '2024-12-16 14:31:36', '2024-12-16 14:31:36'),
(43, 12, 30, 615, 'Set bộ Genne Obito', 'Blue', 'S', 125000, 1, 125000, '2024-12-16 14:47:51', '2024-12-16 14:47:51'),
(44, 13, 30, 615, 'Set bộ Genne Obito', 'Blue', 'S', 125000, 1, 125000, '2024-12-16 14:50:54', '2024-12-16 14:50:54'),
(45, 14, 29, 594, 'Quần nỉ dài Relax Pants Obito', 'Blue', 'S', 407000, 1, 407000, '2024-12-16 14:53:31', '2024-12-16 14:53:31'),
(46, 15, 1, 10, 'Áo tanktop Base Jack Lane', 'Green', 'L', 151000, 1, 151000, '2024-12-16 16:32:43', '2024-12-16 16:32:43'),
(47, 15, 4, 73, 'Áo khoác Varsity Box Obito', 'Green', 'L', 382000, 1, 382000, '2024-12-16 16:32:43', '2024-12-16 16:32:43'),
(48, 16, 10, 205, 'Áo polo cộc tay Knit Jack Lane', 'White', 'L', 250000, 1, 250000, '2024-12-16 16:35:27', '2024-12-16 16:35:27'),
(49, 16, 11, 231, 'Áo len sweater Ralz Obito', 'Yellow', 'S', 82000, 1, 82000, '2024-12-16 16:35:27', '2024-12-16 16:35:27'),
(50, 16, 12, 236, 'Quần Jeans Typo Obito', 'Blue', 'M', 403000, 1, 403000, '2024-12-16 16:35:27', '2024-12-16 16:35:27'),
(51, 17, 22, 445, 'Áo Khoác Phao Obito - Form boxy', 'Blue', 'L', 411000, 1, 411000, '2024-12-16 16:38:20', '2024-12-16 16:38:20'),
(52, 18, 9, 187, 'Áo Polo Oversize WONDER', 'Yellow', 'L', 262000, 1, 262000, '2024-12-16 16:39:30', '2024-12-16 16:39:30'),
(53, 19, 14, 282, 'Quần short Jeans lửng Jort Obito', 'Cyan', 'S', 70000, 1, 70000, '2024-12-16 16:41:13', '2024-12-16 16:41:13'),
(54, 20, 14, 283, 'Quần short Jeans lửng Jort Obito', 'Green', 'L', 70000, 1, 70000, '2024-12-16 16:42:42', '2024-12-16 16:42:42'),
(55, 21, 14, 283, 'Quần short Jeans lửng Jort Obito', 'Green', 'L', 70000, 1, 70000, '2024-12-16 16:43:50', '2024-12-16 16:43:50'),
(56, 22, 14, 283, 'Quần short Jeans lửng Jort Obito', 'Green', 'L', 70000, 1, 70000, '2024-12-16 16:44:24', '2024-12-16 16:44:24'),
(57, 23, 25, 508, 'Áo sơ mi dài tay Original Obito', 'Blue', 'L', 173000, 1, 173000, '2024-12-16 16:44:55', '2024-12-16 16:44:55'),
(58, 24, 16, 328, 'Quần Short lửng Fiin Obito', 'Orange', 'L', 446000, 1, 446000, '2024-12-16 16:45:39', '2024-12-16 16:45:39'),
(59, 25, 5, 105, 'Áo len cộc tay Grand Obito', 'Yellow', 'S', 204000, 1, 204000, '2024-12-16 16:46:20', '2024-12-16 16:46:20'),
(60, 26, 23, 471, 'Áo sơ mi cộc tay original Obito', 'Cyan', 'S', 335000, 1, 335000, '2024-12-16 16:46:47', '2024-12-16 16:46:47'),
(61, 27, 6, 111, 'Áo len Simon Jack Lane', 'Blue', 'S', 323000, 1, 323000, '2024-12-16 16:48:11', '2024-12-16 16:48:11'),
(62, 28, 23, 470, 'Áo sơ mi cộc tay original Obito', 'Cyan', 'M', 335000, 1, 335000, '2024-12-16 16:48:57', '2024-12-16 16:48:57'),
(63, 29, 17, 356, 'Quần dài Blackey Obito', 'Yellow', 'M', 314000, 1, 314000, '2024-12-16 16:49:47', '2024-12-16 16:49:47'),
(64, 30, 3, 50, 'Áo khoác dạ Nino Jack Lane', 'Cyan', 'M', 325000, 1, 325000, '2024-12-16 16:50:15', '2024-12-16 16:50:15'),
(65, 31, 30, 629, 'Set bộ Genne Obito', 'Yellow', 'M', 125000, 1, 125000, '2024-12-16 16:51:13', '2024-12-16 16:51:13'),
(66, 32, 19, 382, 'Quần dài Noah Obito', 'Blue', 'L', 409000, 1, 409000, '2024-12-16 16:51:45', '2024-12-16 16:51:45'),
(67, 33, 18, 363, 'Quần Jeans Otis Obito', 'Blue', 'S', 149000, 1, 149000, '2024-12-16 16:52:14', '2024-12-16 16:52:14'),
(68, 34, 19, 388, 'Quần dài Noah Obito', 'Green', 'L', 409000, 1, 409000, '2024-12-16 16:52:38', '2024-12-16 16:52:38'),
(69, 35, 18, 371, 'Quần Jeans Otis Obito', 'Orange', 'M', 149000, 1, 149000, '2024-12-16 16:53:03', '2024-12-16 16:53:03'),
(70, 36, 17, 338, 'Quần dài Blackey Obito', 'Black', 'M', 314000, 1, 314000, '2024-12-16 16:54:03', '2024-12-16 16:54:03'),
(71, 37, 16, 329, 'Quần Short lửng Fiin Obito', 'Orange', 'M', 446000, 1, 446000, '2024-12-16 16:56:41', '2024-12-16 16:56:41'),
(72, 38, 17, 346, 'Quần dài Blackey Obito', 'Green', 'L', 314000, 1, 314000, '2024-12-16 16:57:02', '2024-12-16 16:57:02'),
(73, 39, 17, 346, 'Quần dài Blackey Obito', 'Green', 'L', 314000, 1, 314000, '2024-12-16 16:57:30', '2024-12-16 16:57:30'),
(74, 40, 7, 127, 'Áo Jacket Denim Typo Obito', 'Black', 'L', 400000, 1, 400000, '2024-12-16 16:57:57', '2024-12-16 16:57:57'),
(75, 41, 7, 131, 'Áo Jacket Denim Typo Obito', 'Blue', 'M', 400000, 1, 400000, '2024-12-16 16:58:22', '2024-12-16 16:58:22'),
(76, 42, 20, 419, 'Set bộ Frank Obito', 'Yellow', 'M', 432000, 1, 432000, '2024-12-16 16:59:47', '2024-12-16 16:59:47'),
(77, 43, 14, 283, 'Quần short Jeans lửng Jort Obito', 'Green', 'L', 70000, 1, 70000, '2024-12-16 17:00:10', '2024-12-16 17:00:10'),
(78, 44, 30, 610, 'Set bộ Genne Obito', 'Black', 'L', 125000, 2, 250000, '2024-12-16 17:15:55', '2024-12-16 17:15:55'),
(79, 44, 30, 627, 'Set bộ Genne Obito', 'White', 'S', 125000, 1, 125000, '2024-12-16 17:15:55', '2024-12-16 17:15:55'),
(80, 44, 27, 554, 'Áo thun Striped Flower Obito', 'Cyan', 'M', 447000, 1, 447000, '2024-12-16 17:15:55', '2024-12-16 17:15:55'),
(81, 44, 26, 543, 'Áo thun Blue heart Obito', 'White', 'S', 438000, 2, 876000, '2024-12-16 17:15:55', '2024-12-16 17:15:55'),
(82, 45, 30, 625, 'Set bộ Genne Obito', 'White', 'L', 125000, 1, 125000, '2024-12-16 17:19:40', '2024-12-16 17:19:40'),
(83, 45, 29, 591, 'Quần nỉ dài Relax Pants Obito', 'Black', 'S', 407000, 1, 407000, '2024-12-16 17:19:40', '2024-12-16 17:19:40'),
(84, 46, 27, 548, 'Áo thun Striped Flower Obito', 'Black', 'M', 447000, 1, 447000, '2024-12-16 17:21:32', '2024-12-16 17:21:32'),
(85, 46, 28, 569, 'Quần dài kẻ sọc ống rộng Striped Obito', 'Black', 'M', 285000, 1, 285000, '2024-12-16 17:21:32', '2024-12-16 17:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `amount` double NOT NULL,
  `transaction_type` tinyint NOT NULL COMMENT ' 0 Loại A, 1 Loại B',
  `payment_method` enum('COD','VnPAY','zaloPay') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL COMMENT '0 Chưa thanh toán 1 Đã thanh toán',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `user_id`, `amount`, `transaction_type`, `payment_method`, `status`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1126000, 0, 'COD', 1, NULL, '2024-12-16 14:00:36', '2024-12-16 14:00:36'),
(2, 2, NULL, 747000, 0, 'COD', 1, NULL, '2024-12-16 14:01:37', '2024-12-16 14:01:37'),
(3, 3, NULL, 867000, 0, 'COD', 1, NULL, '2024-12-16 14:02:32', '2024-12-16 14:02:32'),
(4, 4, 16, 817000, 0, 'COD', 1, NULL, '2024-12-16 14:09:41', '2024-12-16 14:09:41'),
(5, 5, 11, 3933000, 0, 'COD', 1, NULL, '2024-12-16 14:14:49', '2024-12-16 14:14:49'),
(6, 6, 11, 407000, 0, 'COD', 1, NULL, '2024-12-16 14:18:24', '2024-12-16 14:18:24'),
(7, 7, 14, 1702000, 0, 'COD', 1, NULL, '2024-12-16 14:21:44', '2024-12-16 14:21:44'),
(8, 8, 14, 125000, 0, 'COD', 1, NULL, '2024-12-16 14:24:04', '2024-12-16 14:24:04'),
(9, 9, 15, 885000, 0, 'COD', 1, NULL, '2024-12-16 14:27:06', '2024-12-16 14:27:06'),
(10, 10, 15, 332000, 0, 'COD', 0, NULL, '2024-12-16 14:30:18', '2024-12-16 14:30:18'),
(11, 11, 15, 195000, 0, 'COD', 0, NULL, '2024-12-16 14:31:36', '2024-12-16 14:31:36'),
(12, 12, NULL, 125000, 0, 'COD', 1, NULL, '2024-12-16 14:47:51', '2024-12-16 14:47:51'),
(13, 13, 11, 47000, 1, 'zaloPay', 1, 'Thanh toán thành công qua zaloPay.', '2024-12-16 14:51:29', '2024-12-16 14:51:29'),
(14, 14, 11, 407000, 0, 'COD', 1, NULL, '2024-12-16 14:53:31', '2024-12-16 14:53:31'),
(15, 15, 16, 533000, 0, 'COD', 1, NULL, '2024-12-16 16:32:43', '2024-12-16 16:32:43'),
(16, 16, 16, 735000, 0, 'COD', 1, NULL, '2024-12-16 16:35:27', '2024-12-16 16:35:27'),
(17, 17, 16, 411000, 0, 'COD', 1, NULL, '2024-12-16 16:38:20', '2024-12-16 16:38:20'),
(18, 18, 16, 262000, 0, 'COD', 1, NULL, '2024-12-16 16:39:30', '2024-12-16 16:39:30'),
(19, 19, 16, 70000, 0, 'COD', 1, NULL, '2024-12-16 16:41:13', '2024-12-16 16:41:13'),
(20, 20, 16, 70000, 0, 'COD', 0, NULL, '2024-12-16 16:42:42', '2024-12-16 16:42:42'),
(21, 21, 14, 70000, 0, 'COD', 0, NULL, '2024-12-16 16:43:50', '2024-12-16 16:43:50'),
(22, 22, 14, 70000, 0, 'COD', 0, NULL, '2024-12-16 16:44:24', '2024-12-16 16:44:24'),
(23, 23, 14, 173000, 0, 'COD', 0, NULL, '2024-12-16 16:44:55', '2024-12-16 16:44:55'),
(24, 24, 14, 446000, 0, 'COD', 0, NULL, '2024-12-16 16:45:39', '2024-12-16 16:45:39'),
(25, 25, 14, 204000, 0, 'COD', 0, NULL, '2024-12-16 16:46:20', '2024-12-16 16:46:20'),
(26, 26, 14, 335000, 0, 'COD', 0, NULL, '2024-12-16 16:46:47', '2024-12-16 16:46:47'),
(27, 27, 13, 323000, 0, 'COD', 0, NULL, '2024-12-16 16:48:11', '2024-12-16 16:48:11'),
(28, 28, 13, 335000, 0, 'COD', 0, NULL, '2024-12-16 16:48:57', '2024-12-16 16:48:57'),
(29, 29, 13, 314000, 0, 'COD', 0, NULL, '2024-12-16 16:49:47', '2024-12-16 16:49:47'),
(30, 30, 13, 325000, 0, 'COD', 0, NULL, '2024-12-16 16:50:15', '2024-12-16 16:50:15'),
(31, 31, 13, 125000, 0, 'COD', 0, NULL, '2024-12-16 16:51:13', '2024-12-16 16:51:13'),
(32, 32, 13, 409000, 0, 'COD', 0, NULL, '2024-12-16 16:51:45', '2024-12-16 16:51:45'),
(33, 33, 13, 149000, 0, 'COD', 0, NULL, '2024-12-16 16:52:14', '2024-12-16 16:52:14'),
(34, 34, 13, 409000, 0, 'COD', 0, NULL, '2024-12-16 16:52:38', '2024-12-16 16:52:38'),
(35, 35, 13, 149000, 0, 'COD', 0, NULL, '2024-12-16 16:53:03', '2024-12-16 16:53:03'),
(36, 36, 13, 314000, 0, 'COD', 0, NULL, '2024-12-16 16:54:03', '2024-12-16 16:54:03'),
(37, 37, 15, 446000, 0, 'COD', 0, NULL, '2024-12-16 16:56:41', '2024-12-16 16:56:41'),
(38, 38, 15, 314000, 0, 'COD', 0, NULL, '2024-12-16 16:57:02', '2024-12-16 16:57:02'),
(39, 39, 15, 314000, 0, 'COD', 0, NULL, '2024-12-16 16:57:30', '2024-12-16 16:57:30'),
(40, 40, 15, 400000, 0, 'COD', 0, NULL, '2024-12-16 16:57:57', '2024-12-16 16:57:57'),
(41, 41, 15, 400000, 0, 'COD', 0, NULL, '2024-12-16 16:58:22', '2024-12-16 16:58:22'),
(42, 42, 11, 432000, 0, 'COD', 0, NULL, '2024-12-16 16:59:47', '2024-12-16 16:59:47'),
(43, 43, 11, 70000, 0, 'COD', 0, NULL, '2024-12-16 17:00:10', '2024-12-16 17:00:10'),
(44, 44, 15, 1698000, 0, 'COD', 0, NULL, '2024-12-16 17:15:55', '2024-12-16 17:15:55'),
(45, 45, 15, 532000, 0, 'COD', 1, NULL, '2024-12-16 17:19:40', '2024-12-16 17:19:40'),
(46, 46, 15, 732000, 0, 'COD', 1, NULL, '2024-12-16 17:21:32', '2024-12-16 17:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `views` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author`, `image`, `publish_date`, `created_at`, `updated_at`, `views`) VALUES
(5, 'Các bộ sưu tập đặc biệt', 'Với sự phát triển của ngành công nghiệp thời trang Việt Nam, việc sử dụng nội dung chất lượng cao như content bán quần áo đã trở thành một cách hiệu quả để tiếp cận và thu hút khách hàng. Bằng cách cung cấp hướng dẫn mix đồ, chia sẻ xu hướng thời trang, và bí quyết chăm sóc quần áo, các shop thời trang có thể tạo dựng lòng tin và tăng doanh số bán hàng. Hãy tận dụng những xu hướng thời trang mùa Xuân Hè và mùa Thu Đông để tạo ra nội dung hấp dẫn, thu hút và phù hợp với nhu cầu người tiêu dùng\r\n\r\nBài viết về phong cách cá nhân: Tạo ra nội dung về cách tạo dựng phong cách cá nhân thông qua việc lựa chọn quần áo. Cung cấp gợi ý về cách kết hợp các mẫu quần áo để thể hiện phong cách và cá nhân của mỗi người.\r\nCác bộ sưu tập đặc biệt: Tạo ra các bộ sưu tập đặc biệt dành cho các dịp đặc biệt như mùa lễ, ngày kỷ niệm, hoặc các sự kiện đặc biệt. Chia sẻ thông tin và hình ảnh về các bộ sưu tập này để khách hàng có thể tìm kiếm và lựa chọn sản phẩm phù hợp.\r\nCập nhật về giá và khuyến mãi: Chia sẻ thông tin về các khuyến mãi, giảm giá và các chương trình ưu đãi đặc biệt mà bạn đang áp dụng cho sản phẩm quần áo của mình.', 'Admin', 'images/1Xyk6w45K7tsrL4HkH5vhrF1gs1LpBnSLYdpjTN7.jpg', '2024-12-16', '2024-12-16 13:23:49', '2024-12-16 13:33:51', 0),
(6, 'cộng đồng người sử dụn', 'Sự kiện và hợp tác: Tạo ra nội dung liên quan đến sự kiện, triển lãm, hoặc hợp tác đặc biệt mà thương hiệu quần áo của bạn tham gia. Chia sẻ thông tin về những hoạt động này, hậu trường, và những lợi ích mà khách hàng có thể nhận được từ việc tham gia.\r\nBài viết từ cộng đồng người sử dụng: Tạo ra nội dung liên quan đến cộng đồng người sử dụng quần áo của bạn. Có thể là chia sẻ hình ảnh, câu chuyện, hoặc trải nghiệm của khách hàng với sản phẩm của bạn. Tạo các cuộc thi hoặc thử thách để khuyến khích khách hàng chia sẻ trải nghiệm và hình ảnh với sản phẩm của bạn.', 'Admin', 'images/Ian3jOUUWtyqycT6Feq0qfYcgiTZIuGNkzxMB4vw.jpg', '2024-06-19', '2024-12-16 13:23:49', '2024-12-16 13:33:12', 0),
(7, 'Khám phá phong cách riêng', 'Đánh giá sản phẩm: Tạo ra các bài viết hoặc video đánh giá chi tiết về các mẫu quần áo cụ thể. Chia sẻ nhận xét về chất lượng, ý nghĩa thiết kế, và cách mặc của từng sản phẩm để giúp khách hàng có quyết định mua hàng tốt hơn.\r\nKhám phá phong cách riêng: Tạo ra nội dung về cách phối quần áo để tạo nên phong cách riêng của mỗi người. Chia sẻ gợi ý về cách tạo nên những bộ trang phục thể hiện cá nhân và phong cách riêng của khách hàng.', 'Admin', 'images/Vg48V58j1ub9YR5w7xr9U9K3y3E1qnscXiDIElti.jpg', '2024-09-05', '2024-12-16 13:23:49', '2024-12-16 13:32:23', 0),
(8, 'Bài viết về bảo quản và chăm sóc quần áo', 'Bài viết về bảo quản và chăm sóc quần áo: Tạo ra nội dung về cách bảo quản và chăm sóc quần áo để giúp khách hàng duy trì sự mới mẻ và độ bền của sản phẩm. Chia sẻ các bí quyết giặt, là ủi, và bảo quản quần áo theo đúng cách.', 'Admin', 'images/wSEhB4VzjY4LPjHNZCZ2265imOA3mHnGxVy7JAqm.jpg', '2024-10-23', '2024-12-16 13:23:49', '2024-12-16 13:31:27', 0),
(9, 'Bài viết về chất liệu và chất lượng', 'Bài viết về chất liệu và chất lượng: Viết các bài viết giới thiệu về các chất liệu quần áo phổ biến, giải thích về đặc tính và lợi ích của từng chất liệu. Điều này giúp khách hàng hiểu rõ hơn về chất lượng sản phẩm của bạn.\r\nCâu chuyện thương hiệu: Kể câu chuyện về thương hiệu quần áo của bạn, bao gồm lịch sử, giá trị cốt lõi, và sứ mệnh của công ty. Điều này giúp xây dựng sự kết nối và lòng tin tưởng với khách hàng.', 'Admin', 'images/JTcsCLO3C8kSgPj3Bkzls3YsCxfWJJVR8TiQ9dFi.jpg', '2024-11-13', '2024-12-16 13:23:49', '2024-12-16 13:30:24', 0),
(10, 'Hướng dẫn phối đồ.', 'Hướng dẫn phối đồ: Tạo ra các bài viết hoặc video hướng dẫn cách phối quần áo theo cách chuyên nghiệp. Cung cấp gợi ý về cách tạo nên các bộ trang phục phù hợp với từng dịp, loại hình công việc hoặc phong cách riêng của khách hàng.\r\nTư vấn về xu hướng thời trang: Cập nhật và chia sẻ thông tin về các xu hướng thời trang mới nhất. Viết bài viết hoặc tổ chức cuộc thăm dò ý kiến khách hàng về các xu hướng phổ biến hoặc tạo ra các bản đánh giá về những mẫu quần áo nổi bật.', 'admin', 'images/KE6JWJR9i11AxnRbhFyH0t1JpK5miJ2znEIl6DdR.jpg', '2024-11-28', '2024-12-16 13:23:49', '2024-12-16 13:29:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SKU` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_stock` bigint UNSIGNED NOT NULL DEFAULT '0',
  `price_regular` bigint UNSIGNED NOT NULL,
  `price_sale` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int NOT NULL DEFAULT '0',
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `SKU`, `base_stock`, `price_regular`, `price_sale`, `description`, `views`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Áo tanktop Base Jack Lane', 'OBM2M00000', 44, 251000, 151000, 'Vitae repellat voluptatem assumenda explicabo magni in. Eum rem minima qui ducimus. Voluptatem tempora recusandae et illum fugit repellat sint sit. Ut facere omnis atque ex et omnis qui harum.', 31, 'Aut eius omnis fuga expedita iste voluptas sed. Culpa voluptatem similique ex est quaerat. Quae voluptas corrupti aut cupiditate temporibus cupiditate quaerat quasi. Provident vel magnam modi qui aspernatur quis delectus. Labore impedit natus pariatur soluta repellat quo possimus. Magnam tempora quasi est cum pariatur ipsa. Beatae nostrum iure quae voluptate alias dolorum.', '2024-12-16 13:23:48', '2024-12-16 16:32:43', NULL),
(2, 1, 'Áo khoác dạ Brook Obito', 'OBVCU00001', 108, 447000, 268000, 'Expedita nesciunt ipsa possimus architecto nesciunt. Soluta laborum atque ut tenetur doloremque praesentium. Explicabo nisi pariatur eligendi commodi.', 23, 'Nobis ut veritatis numquam beatae est. Recusandae ad dolorem harum sequi quae nam accusantium perspiciatis. Ipsum consequatur sequi dolorem est voluptatem eos adipisci. Repudiandae quia quia repudiandae aut aut ut vero. Quo quo commodi numquam ad et non cumque. Et id itaque incidunt provident veniam et.', '2024-12-16 13:23:48', '2024-12-16 16:32:08', NULL),
(3, 1, 'Áo khoác dạ Nino Jack Lane', 'OBc7800002', 141, 542000, 325000, 'Eius ea vel fugit eaque non non nemo. Consequatur quae debitis nostrum illo veniam autem pariatur. Dolore occaecati fuga eos enim. Cupiditate eos autem nisi.', 30, 'Pariatur quibusdam repellat incidunt nihil facere. Illum harum ut mollitia alias. Ullam qui dolores aut voluptatum voluptatibus. Eligendi sunt sint maxime voluptatum consequatur. Fuga quas repellat iste. Quia rerum soluta cupiditate architecto esse aut. Nulla cupiditate et unde sit eligendi aperiam esse.', '2024-12-16 13:23:48', '2024-12-16 16:50:15', NULL),
(4, 1, 'Áo khoác Varsity Box Obito', 'OB00k00003', 435, 637000, 382000, 'Explicabo rerum tenetur inventore quia laudantium veniam. Ipsa adipisci nobis cupiditate. Quas quas voluptatum velit dolorem molestiae.', 30, 'Fugit aut eligendi autem libero aut sed suscipit unde. Necessitatibus dolorem voluptas maxime dolorem odit ex architecto. Ratione aut odit ad voluptatem mollitia et provident. Nam est quo sunt et aperiam consequatur enim. Nemo perspiciatis animi sed consequatur et et. Occaecati velit nihil optio sunt minima libero aliquam. Aut numquam esse porro assumenda non ducimus aut.', '2024-12-16 13:23:48', '2024-12-16 16:34:21', NULL),
(5, 1, 'Áo len cộc tay Grand Obito', 'OBgyu00004', 37, 340000, 204000, 'Enim corporis nostrum quo necessitatibus. Qui delectus incidunt ut nesciunt autem est aut. Consectetur nobis et deleniti et quae. Aut ipsam et doloremque odio adipisci.', 45, 'Magni dolorum voluptatem omnis et distinctio sed. Voluptatibus aliquid et alias ipsum. Voluptates maiores voluptate aut unde neque nulla exercitationem. Temporibus enim id rem dolores inventore. Iure est incidunt maxime placeat sed eum adipisci. Delectus vero voluptate hic neque exercitationem similique reprehenderit modi.', '2024-12-16 13:23:48', '2024-12-16 16:46:20', NULL),
(6, 1, 'Áo len Simon Jack Lane', 'OBSs700005', 492, 538000, 323000, 'Illo reprehenderit et doloribus velit eveniet. Sint voluptatum eum nobis cupiditate quia iure. Incidunt totam eligendi voluptatibus consequatur id totam et. Debitis inventore quo velit.', 16, 'Est minus qui voluptas autem facere. Beatae numquam ullam dolorem officiis. Et possimus explicabo mollitia sint. Voluptatem omnis culpa expedita voluptatum fuga incidunt. Et error sit sapiente. Repudiandae necessitatibus consequatur aut dicta debitis sequi. Ea cupiditate quisquam voluptas quo dolorum.', '2024-12-16 13:23:48', '2024-12-16 16:48:11', NULL),
(7, 1, 'Áo Jacket Denim Typo Obito', 'OBtPH00006', 194, 667000, 400000, 'Harum aut consequatur et voluptas dicta quod. Quo rerum illum sit cum est et libero incidunt. Nemo rerum aut eligendi fuga eaque.', 22, 'Perferendis voluptas cupiditate ex occaecati a minus. Blanditiis soluta provident suscipit ratione maiores repellendus cupiditate. Voluptatem beatae unde magnam eligendi. Magni laborum sed rerum quod qui. Ullam est molestiae sed voluptatem et. Et at totam quod magnam veritatis eos. Voluptatibus unde qui reiciendis reiciendis quia animi sit.', '2024-12-16 13:23:48', '2024-12-16 16:58:22', NULL),
(8, 1, 'Áo jacket len Oak Obito', 'OBcLe00007', 492, 387000, 232000, 'Eveniet non enim aut eaque et ipsum. Aut iusto ipsa nihil similique inventore. Sit laudantium vero magni atque eum in voluptates quasi.', 8, 'Corporis debitis modi dolorem dolores. Est quis nemo quis fugit minima quo. Cumque dolores sunt iure eveniet non eveniet et ipsa. Blanditiis labore ea unde qui non culpa est. Dignissimos magni eum possimus nulla. Quo commodi et iste consequuntur dolores corporis consectetur.', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(9, 1, 'Áo Polo Oversize WONDER', 'OBDW600008', 405, 437000, 262000, 'Tenetur repudiandae aut incidunt enim aut sint iste. Qui inventore accusantium similique temporibus earum. Atque id nostrum soluta et.', 48, 'Et hic quo ea cum. Est iusto id corporis accusamus et libero quam. Ullam eos enim eveniet velit vel. Aut est dolor doloremque itaque natus praesentium. Quis sint vel nemo quidem. Laudantium velit quia veritatis et. Sint aspernatur qui nisi quia rem non sunt. Repellendus rerum ea natus corrupti quia.', '2024-12-16 13:23:48', '2024-12-16 16:39:29', NULL),
(10, 1, 'Áo polo cộc tay Knit Jack Lane', 'OBVnt00009', 14, 417000, 250000, 'Distinctio delectus dolor voluptatibus natus tempora aliquam inventore. Aspernatur id ducimus perferendis. Est optio ullam dignissimos aut nemo. Saepe voluptas molestiae amet omnis illo et sit.', 23, 'Quia accusantium labore eligendi ut. Ea ad suscipit dolore tenetur. Nostrum nihil nemo sint ullam voluptatem. Vero sed nam corporis non in qui voluptas. Beatae blanditiis excepturi accusantium et laborum quasi praesentium cum. Hic suscipit ratione dicta in est velit minus a. Iste velit amet consequatur et tempora molestiae voluptatem.', '2024-12-16 13:23:48', '2024-12-16 16:35:27', NULL),
(11, 1, 'Áo len sweater Ralz Obito', 'OBLnH000010', 147, 136000, 82000, 'Laudantium corrupti modi sed similique doloribus nesciunt omnis. Et accusamus id enim praesentium eligendi. Alias quo et libero voluptate.', 89, 'Quis nostrum quam et. Rerum officia dolores ut aut. Reprehenderit illo aliquam ut dolore molestiae in. Voluptatibus itaque quisquam sapiente natus. Est dolore facilis dolor facere laudantium molestias sunt. Consequatur ut assumenda qui optio. Voluptate esse voluptas enim perferendis at.', '2024-12-16 13:23:48', '2024-12-16 16:35:27', NULL),
(12, 2, 'Quần Jeans Typo Obito', 'OBXxf000011', 220, 671000, 403000, 'Fuga deserunt modi eos voluptatem id. Cum reprehenderit consectetur repudiandae dolores autem ab. Fugiat nesciunt dolores omnis cupiditate quas aut ut.', 81, 'Omnis fuga sit veniam harum ipsum. Dolorem culpa illum est voluptate repudiandae quia. Sed ut nobis commodi accusantium et sequi doloribus. Odio officiis dolorum amet harum. Accusamus dolor esse saepe quam tempora sit culpa. Officia quia omnis est eaque quia quia. Voluptas temporibus ea possimus cumque minus quis.', '2024-12-16 13:23:48', '2024-12-16 16:35:27', NULL),
(13, 2, 'Quần nỉ oversize Wided Pants Obito', 'OB5vm000012', 76, 353000, 212000, 'Non voluptatem vero nihil consectetur minima consequatur. Sit suscipit asperiores nihil ea vitae vel animi. Iste harum iste eos cum expedita consequatur deserunt.', 67, 'Minus et sed rerum excepturi. Doloremque ipsa molestiae aut dolor quam eligendi enim. Quidem nostrum non dolorum omnis reprehenderit. Dolor veniam molestiae dignissimos quis. Molestias placeat corrupti natus nulla sit illum. Magni mollitia accusantium non corporis facilis similique.', '2024-12-16 13:23:48', '2024-12-16 14:18:24', NULL),
(14, 2, 'Quần short Jeans lửng Jort Obito', 'OB6j6000013', 305, 117000, 70000, 'Consequatur praesentium error esse et optio. Voluptatum dignissimos a mollitia ut. Ea deserunt et aut provident. Fuga sit earum amet aspernatur.', 67, 'Incidunt adipisci hic tempore. Autem qui omnis ducimus aut non hic neque perferendis. Non omnis provident illo voluptatem iste itaque. Dolorem delectus ea cupiditate. Commodi minima omnis quia.', '2024-12-16 13:23:48', '2024-12-16 17:07:02', NULL),
(15, 2, 'Quần short Light Obito', 'OBoFW000014', 200, 208000, 125000, 'Ut similique ullam distinctio reprehenderit sed. Eius neque deserunt facere reiciendis eos necessitatibus. Nisi qui sed a ut qui nihil. Id numquam qui est excepturi.', 61, 'Deserunt beatae dicta non quidem aperiam iste consectetur. Eaque quis aut dolores ipsam laudantium enim et. Adipisci aut laudantium similique. Et aspernatur esse quas. Totam quam possimus nesciunt tempore quia. Dolor et quibusdam et tempora. Rerum minima illum id dolorem amet delectus laboriosam consequatur.', '2024-12-16 13:23:48', '2024-12-16 14:31:36', NULL),
(16, 2, 'Quần Short lửng Fiin Obito', 'OBH14000015', 34, 744000, 446000, 'Et vero officiis modi suscipit molestiae nostrum dolorem quaerat. Deleniti soluta praesentium sed ipsa sint. Error laborum vel dolores quae quia rerum unde.', 101, 'Ullam unde qui dolore sit. Assumenda ut eum iure provident. Eveniet quaerat incidunt voluptas. Fugiat ut animi eaque. Vel dolorem architecto tenetur quae vel. Enim dolorem doloremque nesciunt ut atque modi enim aut. Mollitia placeat voluptatem vero error. Aut saepe repellendus id autem ipsum.', '2024-12-16 13:23:48', '2024-12-16 16:56:41', NULL),
(17, 2, 'Quần dài Blackey Obito', 'OBKFt000016', 176, 524000, 314000, 'Et ratione ab dolor cupiditate omnis est suscipit. Ea dolores excepturi et quis. Voluptas itaque recusandae minima quidem aut. Ducimus voluptates eligendi quia corporis magni.', 64, 'Possimus aut corporis minima est autem qui commodi optio. Commodi officia ab saepe aliquam ea esse blanditiis. Ipsum repellat quas vel qui consequatur. Autem debitis vitae ut maiores. Suscipit dolor quia nihil dicta dolorem aut. In asperiores ut aut occaecati rerum est ea.', '2024-12-16 13:23:48', '2024-12-16 16:57:30', NULL),
(18, 2, 'Quần Jeans Otis Obito', 'OBc1G000017', 92, 249000, 149000, 'Voluptate rerum eius dolor et. Quibusdam qui qui non earum voluptatibus qui. Aliquam eos voluptatem nulla aut quod. Quasi ratione porro in nemo impedit magnam quod.', 19, 'Esse commodi voluptas aliquid eos ducimus animi sapiente nostrum. Et iste tempore cupiditate veniam maiores. Temporibus in animi voluptas voluptates fuga qui. Aut eos consequuntur occaecati quia vitae itaque ad. Earum earum corrupti cupiditate in sit repudiandae. Dolore deserunt eos voluptatibus quasi voluptas.', '2024-12-16 13:23:48', '2024-12-16 16:53:03', NULL),
(19, 2, 'Quần dài Noah Obito', 'OBn4b000018', 360, 682000, 409000, 'Ut odio possimus tempore qui et. Numquam quia quia dolores qui pariatur molestiae consequatur et. Reiciendis rerum quas optio amet et. Ut a est voluptate dolore autem deserunt nam.', 15, 'Ut autem aut blanditiis rerum et atque. Aut dolorem quae cumque rerum omnis eum. Nisi vel cupiditate illo vero culpa et omnis. Maxime exercitationem dolores laboriosam modi vero. Earum autem assumenda quas aliquid qui omnis non. Sed laboriosam quidem eaque rerum. Harum pariatur perferendis quo illum. Fugit et harum repellat praesentium quis molestiae quaerat ex.', '2024-12-16 13:23:48', '2024-12-16 16:52:38', NULL),
(20, 3, 'Set bộ Frank Obito', 'OB6RC000019', 142, 720000, 432000, 'Velit veritatis maiores ut esse enim vero ut. Praesentium architecto exercitationem qui omnis et culpa recusandae quibusdam. Ea possimus dicta occaecati alias perferendis at.', 17, 'Mollitia laborum possimus voluptate placeat qui. Voluptas totam eligendi aspernatur et natus. Esse ipsum id harum hic natus. Error veritatis non voluptatem dolor consequuntur quam repellendus architecto.', '2024-12-16 13:23:48', '2024-12-16 16:59:47', NULL),
(21, 4, 'Áo Cardigan Nỉ Henry Obito', 'OBDlj00000', 46, 251000, 126000, 'Illum ipsam odio et sint minima. Vero occaecati omnis accusamus consequuntur. Placeat voluptatem labore alias sed ea eaque quidem quia. Libero sunt ut iusto.', 54, 'Libero at omnis sunt tempore praesentium ducimus. Voluptatem dolor eos blanditiis totam consequatur porro. Veniam ut sint quis. Ea et ullam vitae officiis distinctio ipsam ut ipsum. Corrupti qui eveniet modi accusamus. Magni ex quo nulla aut enim ut dolores. Ratione nostrum ad non ratione vel a.', '2024-12-16 13:23:48', '2024-12-16 14:14:49', NULL),
(22, 4, 'Áo Khoác Phao Obito - Form boxy', 'OBsQE00001', 361, 822000, 411000, 'Aliquam quisquam laborum illum fuga. Quas amet officia et id et accusantium iusto totam. Ut est minus consectetur accusantium voluptatem ut quia. Adipisci est est sit sit sapiente quis.', 12, 'Harum eaque nobis iusto rerum. Necessitatibus quis eum consequatur qui. Eos dolorum omnis consequatur non. Impedit beatae qui sed sint excepturi temporibus quis. Qui ratione a nostrum amet. Qui quasi in molestias sapiente neque.', '2024-12-16 13:23:48', '2024-12-16 16:38:20', NULL),
(23, 4, 'Áo sơ mi cộc tay original Obito', 'OBb2600002', 426, 670000, 335000, 'Accusamus vel perspiciatis ratione molestiae. Quae dolores ab quia possimus quo perspiciatis dolore. Delectus beatae voluptatem est. Recusandae dolore aperiam in consequatur non officiis.', 23, 'Blanditiis iure rem rerum quo porro. Autem quo consequatur porro incidunt est aspernatur dolores. Veritatis maiores distinctio architecto commodi rerum. Eos ipsum voluptatem doloremque voluptatem veniam sit. Voluptas id ullam deleniti et. Non error consequuntur sapiente nobis adipisci. Placeat nihil debitis dolores ex nisi. Numquam et non sint pariatur.', '2024-12-16 13:23:48', '2024-12-16 16:48:57', NULL),
(24, 4, 'Áo sơ mi cộc tay Type Obito', 'OB2Xd00003', 190, 821000, 411000, 'Perspiciatis quibusdam iste voluptatem eius sit. Ut in quibusdam error occaecati ut incidunt. Ducimus est repellendus odio.', 93, 'Facilis reprehenderit voluptate consectetur. Consequuntur quia quasi aperiam corrupti a cumque. Occaecati quibusdam nihil nam natus laboriosam ut aliquid. Et veritatis aut incidunt facere optio. Placeat dolor eum sit. Qui ut consequatur eum modi nemo. Doloribus aliquid corporis sunt qui possimus repellendus doloremque.', '2024-12-16 13:23:48', '2024-12-16 14:02:00', NULL),
(25, 4, 'Áo sơ mi dài tay Original Obito', 'OBjqM00004', 345, 345000, 173000, 'Sed minus unde veniam recusandae ea atque aut. Eaque ea adipisci id hic sit. Est voluptas quia non magni ipsa mollitia. Doloremque molestias quos ducimus hic molestiae.', 46, 'Alias voluptates velit excepturi velit porro nesciunt quas. Voluptate qui ullam magnam consequatur sit beatae. Deleniti fuga omnis autem et. Eveniet quia dolores beatae tempora porro nihil illum. Est quasi nisi deserunt voluptas facere laboriosam. Odit qui ut dolore iusto et quo velit. Non explicabo et corporis soluta quia dolorem deserunt.', '2024-12-16 13:23:48', '2024-12-16 17:06:53', NULL),
(26, 4, 'Áo thun Blue heart Obito', 'OB88300005', 395, 876000, 438000, 'Odit vel qui quia dolores enim voluptatem dolorum incidunt. Laudantium aut et aut provident cum aperiam. Voluptatem qui explicabo hic aut sint aut ut.', 31, 'Ipsam voluptas aut unde enim beatae perspiciatis. Ut inventore ut vero reiciendis et vel dignissimos. Dolor aliquam omnis illum aliquid qui sapiente. Necessitatibus eaque vel tempora. Quia in commodi voluptatem maiores vel dolore est iusto. Facere voluptatibus quas maxime. Eveniet cumque assumenda quidem expedita incidunt sint nobis.', '2024-12-16 13:23:48', '2024-12-16 17:15:55', NULL),
(27, 4, 'Áo thun Striped Flower Obito', 'OBjpD00006', 450, 894000, 447000, 'Nihil repellat neque vitae velit. Quis sequi nulla aut similique sed dolorum. Quod voluptas dolor odit vel et.', 76, 'Aliquid aut minus error dolores laudantium illum assumenda. Optio id nobis quod deserunt quasi. Fugit recusandae sit at excepturi enim nisi voluptas. Voluptatibus est autem in dolores nihil. Rerum dolorum quod ducimus nostrum vel consectetur sit fugit. Sunt iure enim quis voluptatem. Voluptas et in est aliquam autem.', '2024-12-16 13:23:48', '2024-12-16 17:21:32', NULL),
(28, 5, 'Quần dài kẻ sọc ống rộng Striped Obito', 'OB9Op00007', 285, 570000, 285000, 'Voluptatibus dignissimos eum perferendis. Officiis unde doloribus earum qui iste dolorem corporis. Sit est qui aut dolor et deleniti tempora.', 67, 'Et necessitatibus dolor quia hic nam. Provident temporibus voluptate hic. Similique error repudiandae autem minima repudiandae provident laboriosam. Ex omnis facilis ab laboriosam rerum rerum. Ex harum eum fugiat molestiae nihil.', '2024-12-16 13:23:48', '2024-12-16 17:21:32', NULL),
(29, 5, 'Quần nỉ dài Relax Pants Obito', 'OBbym00008', 164, 814000, 407000, 'Minus minus eum nemo ut. Est quam voluptas ut amet repudiandae ea. Nihil totam voluptatem veritatis doloribus voluptas quibusdam adipisci. Nihil quia accusantium consequatur ut suscipit modi alias.', 101, 'Asperiores aut voluptas sint exercitationem. Accusantium sapiente saepe alias quod mollitia eum nulla. Facere fugiat quia ut praesentium iusto voluptas. Itaque beatae minima enim provident. Voluptas veniam ad minus reiciendis eveniet labore. Qui numquam velit modi voluptatum ducimus earum ullam id. Repellendus minus eos excepturi facilis facilis quis laborum autem.', '2024-12-16 13:23:48', '2024-12-16 17:19:40', NULL),
(30, 6, 'Set bộ Genne Obito', 'OBZ7B00009', 440, 250000, 125000, 'Ullam fugiat totam in modi voluptas voluptas iure. Non provident consequatur voluptatem voluptates ut ut. Sed eos quia aliquam molestiae.', 75, 'Aut reiciendis libero temporibus est voluptate est et. In perspiciatis quae ut adipisci odio. Quam doloribus autem qui eius dolores. Accusantium enim deleniti ullam voluptas dolores illum earum. Nam natus deleniti ut. Minima voluptatem ea dignissimos. Pariatur ad quibusdam nihil cupiditate quis.', '2024-12-16 13:23:48', '2024-12-16 17:19:40', NULL),
(31, 1, 'áo phao béo', 'ph40331', 80, 700000, 550000, 'áo phao béo', 1, 'áo phao béo', '2024-12-16 14:58:12', '2024-12-16 17:14:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('main','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'products/Man/Áo tanktop Base Jack Lane/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(2, 2, 'products/Man/Áo khoác dạ Brook Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(3, 3, 'products/Man/Áo khoác dạ Nino Jack Lane/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(4, 4, 'products/Man/Áo khoác Varsity Box Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(5, 5, 'products/Man/Áo len cộc tay Grand Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(6, 6, 'products/Man/Áo len Simon Jack Lane/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(7, 7, 'products/Man/Áo Jacket Denim Typo Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(8, 8, 'products/Man/Áo jacket len Oak Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(9, 9, 'products/Man/Áo Polo Oversize WONDER/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(10, 10, 'products/Man/Áo polo cộc tay Knit Jack Lane/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(11, 11, 'products/Man/Áo len sweater Ralz Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(12, 12, 'products/Man/Quần Jeans Typo Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(13, 13, 'products/Man/Quần nỉ oversize Wided Pants Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(14, 14, 'products/Man/Quần short Jeans lửng Jort Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(15, 15, 'products/Man/Quần short Light Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(16, 16, 'products/Man/Quần Short lửng Fiin Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(17, 17, 'products/Man/Quần dài Blackey Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(18, 18, 'products/Man/Quần Jeans Otis Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(19, 19, 'products/Man/Quần dài Noah Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(20, 20, 'products/Man/Set bộ Frank Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(21, 21, 'products/Woman/Áo Cardigan Nỉ Henry Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(22, 22, 'products/Woman/Áo Khoác Phao Obito - Form boxy/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(23, 23, 'products/Woman/Áo sơ mi cộc tay original Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(24, 24, 'products/Woman/Áo sơ mi cộc tay Type Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(25, 25, 'products/Woman/Áo sơ mi dài tay Original Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(26, 26, 'products/Woman/Áo thun Blue heart Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(27, 27, 'products/Woman/Áo thun Striped Flower Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(28, 28, 'products/Woman/Quần dài kẻ sọc ống rộng Striped Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(29, 29, 'products/Woman/Quần nỉ dài Relax Pants Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(30, 30, 'products/Woman/Set bộ Genne Obito/main.jpeg', 'main', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(31, 31, 'uploads/product_images/kA8WT3eXXvnVvhZYEznSTndcebhICPTDwzbYXtZD.png', 'main', '2024-12-16 14:58:13', '2024-12-16 14:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `color_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED NOT NULL,
  `stock` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `color_id`, `size_id`, `stock`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 3, 49, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(2, 1, 5, 2, 21, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(3, 1, 5, 1, 26, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(4, 1, 2, 3, 35, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(5, 1, 2, 2, 8, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(6, 1, 2, 1, 47, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(7, 1, 4, 3, 10, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(8, 1, 4, 2, 34, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(9, 1, 4, 1, 36, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(10, 1, 1, 3, 11, 151000, '2024-12-16 13:23:48', '2024-12-16 16:32:43'),
(11, 1, 1, 2, 4, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(12, 1, 1, 1, 19, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(13, 1, 7, 3, 3, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(14, 1, 7, 2, 46, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(15, 1, 7, 1, 2, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(16, 1, 6, 3, 1, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(17, 1, 6, 2, 5, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(18, 1, 6, 1, 39, 151000, '2024-12-16 13:23:48', '2024-12-16 14:00:36'),
(19, 1, 3, 3, 16, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(20, 1, 3, 2, 6, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(21, 1, 3, 1, 14, 151000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(22, 2, 5, 3, 37, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(23, 2, 5, 2, 33, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(24, 2, 5, 1, 46, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(25, 2, 2, 3, 21, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(26, 2, 2, 2, 1, 268000, '2024-12-16 13:23:48', '2024-12-16 14:00:36'),
(27, 2, 2, 1, 9, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(28, 2, 4, 3, 1, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(29, 2, 4, 2, 8, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(30, 2, 4, 1, 27, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(31, 2, 1, 3, 19, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(32, 2, 1, 2, 22, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(33, 2, 1, 1, 37, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(34, 2, 7, 3, 7, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(35, 2, 7, 2, 19, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(36, 2, 7, 1, 39, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(37, 2, 6, 3, 9, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(38, 2, 6, 2, 26, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(39, 2, 6, 1, 12, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(40, 2, 3, 3, 27, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(41, 2, 3, 2, 6, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(42, 2, 3, 1, 0, 268000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(43, 3, 5, 3, 4, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(44, 3, 5, 2, 7, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(45, 3, 5, 1, 13, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(46, 3, 2, 3, 20, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(47, 3, 2, 2, 48, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(48, 3, 2, 1, 44, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(49, 3, 4, 3, 14, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(50, 3, 4, 2, 21, 325000, '2024-12-16 13:23:48', '2024-12-16 16:50:15'),
(51, 3, 4, 1, 19, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(52, 3, 1, 3, 49, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(53, 3, 1, 2, 28, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(54, 3, 1, 1, 8, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(55, 3, 7, 3, 31, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(56, 3, 7, 2, 24, 325000, '2024-12-16 13:23:48', '2024-12-16 14:00:36'),
(57, 3, 7, 1, 36, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(58, 3, 6, 3, 43, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(59, 3, 6, 2, 24, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(60, 3, 6, 1, 45, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(61, 3, 3, 3, 26, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(62, 3, 3, 2, 16, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(63, 3, 3, 1, 21, 325000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(64, 4, 5, 3, 0, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(65, 4, 5, 2, 24, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(66, 4, 5, 1, 48, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(67, 4, 2, 3, 2, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(68, 4, 2, 2, 49, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(69, 4, 2, 1, 13, 382000, '2024-12-16 13:23:48', '2024-12-16 14:00:36'),
(70, 4, 4, 3, 47, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(71, 4, 4, 2, 47, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(72, 4, 4, 1, 6, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(73, 4, 1, 3, 44, 382000, '2024-12-16 13:23:48', '2024-12-16 16:32:43'),
(74, 4, 1, 2, 11, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(75, 4, 1, 1, 15, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(76, 4, 7, 3, 38, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(77, 4, 7, 2, 1, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(78, 4, 7, 1, 19, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(79, 4, 6, 3, 19, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(80, 4, 6, 2, 3, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(81, 4, 6, 1, 44, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(82, 4, 3, 3, 32, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(83, 4, 3, 2, 35, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(84, 4, 3, 1, 44, 382000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(85, 5, 5, 3, 38, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(86, 5, 5, 2, 37, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(87, 5, 5, 1, 30, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(88, 5, 2, 3, 16, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(89, 5, 2, 2, 41, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(90, 5, 2, 1, 9, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(91, 5, 4, 3, 46, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(92, 5, 4, 2, 30, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(93, 5, 4, 1, 5, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(94, 5, 1, 3, 30, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(95, 5, 1, 2, 21, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(96, 5, 1, 1, 25, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(97, 5, 7, 3, 50, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(98, 5, 7, 2, 46, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(99, 5, 7, 1, 30, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(100, 5, 6, 3, 9, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(101, 5, 6, 2, 4, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(102, 5, 6, 1, 49, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(103, 5, 3, 3, 18, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(104, 5, 3, 2, 45, 204000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(105, 5, 3, 1, 32, 204000, '2024-12-16 13:23:48', '2024-12-16 16:46:20'),
(106, 6, 5, 3, 8, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(107, 6, 5, 2, 5, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(108, 6, 5, 1, 9, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(109, 6, 2, 3, 36, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(110, 6, 2, 2, 6, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(111, 6, 2, 1, 41, 323000, '2024-12-16 13:23:48', '2024-12-16 16:48:11'),
(112, 6, 4, 3, 2, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(113, 6, 4, 2, 27, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(114, 6, 4, 1, 3, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(115, 6, 1, 3, 35, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(116, 6, 1, 2, 37, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(117, 6, 1, 1, 14, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(118, 6, 7, 3, 12, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(119, 6, 7, 2, 10, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(120, 6, 7, 1, 18, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(121, 6, 6, 3, 39, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(122, 6, 6, 2, 41, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(123, 6, 6, 1, 24, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(124, 6, 3, 3, 27, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(125, 6, 3, 2, 26, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(126, 6, 3, 1, 17, 323000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(127, 7, 5, 3, 45, 400000, '2024-12-16 13:23:48', '2024-12-16 16:57:57'),
(128, 7, 5, 2, 48, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(129, 7, 5, 1, 0, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(130, 7, 2, 3, 13, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(131, 7, 2, 2, 41, 400000, '2024-12-16 13:23:48', '2024-12-16 16:58:22'),
(132, 7, 2, 1, 20, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(133, 7, 4, 3, 6, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(134, 7, 4, 2, 2, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(135, 7, 4, 1, 17, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(136, 7, 1, 3, 26, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(137, 7, 1, 2, 14, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(138, 7, 1, 1, 34, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(139, 7, 7, 3, 43, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(140, 7, 7, 2, 17, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(141, 7, 7, 1, 45, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(142, 7, 6, 3, 12, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(143, 7, 6, 2, 28, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(144, 7, 6, 1, 45, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(145, 7, 3, 3, 20, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(146, 7, 3, 2, 9, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(147, 7, 3, 1, 17, 400000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(148, 8, 5, 3, 22, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(149, 8, 5, 2, 13, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(150, 8, 5, 1, 43, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(151, 8, 2, 3, 14, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(152, 8, 2, 2, 34, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(153, 8, 2, 1, 49, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(154, 8, 4, 3, 45, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(155, 8, 4, 2, 14, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(156, 8, 4, 1, 6, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(157, 8, 1, 3, 9, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(158, 8, 1, 2, 10, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(159, 8, 1, 1, 8, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(160, 8, 7, 3, 2, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(161, 8, 7, 2, 28, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(162, 8, 7, 1, 35, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(163, 8, 6, 3, 3, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(164, 8, 6, 2, 2, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(165, 8, 6, 1, 16, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(166, 8, 3, 3, 33, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(167, 8, 3, 2, 41, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(168, 8, 3, 1, 23, 232000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(169, 9, 5, 3, 26, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(170, 9, 5, 2, 41, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(171, 9, 5, 1, 5, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(172, 9, 2, 3, 29, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(173, 9, 2, 2, 22, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(174, 9, 2, 1, 36, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(175, 9, 4, 3, 2, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(176, 9, 4, 2, 22, 262000, '2024-12-16 13:23:48', '2024-12-16 14:01:37'),
(177, 9, 4, 1, 33, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(178, 9, 1, 3, 17, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(179, 9, 1, 2, 23, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(180, 9, 1, 1, 44, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(181, 9, 7, 3, 32, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(182, 9, 7, 2, 40, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(183, 9, 7, 1, 11, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(184, 9, 6, 3, 17, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(185, 9, 6, 2, 9, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(186, 9, 6, 1, 23, 262000, '2024-12-16 13:23:48', '2024-12-16 14:14:49'),
(187, 9, 3, 3, 28, 262000, '2024-12-16 13:23:48', '2024-12-16 16:39:29'),
(188, 9, 3, 2, 30, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(189, 9, 3, 1, 0, 262000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(190, 10, 5, 3, 39, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(191, 10, 5, 2, 36, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(192, 10, 5, 1, 33, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(193, 10, 2, 3, 7, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(194, 10, 2, 2, 10, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(195, 10, 2, 1, 37, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(196, 10, 4, 3, 3, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(197, 10, 4, 2, 19, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(198, 10, 4, 1, 37, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(199, 10, 1, 3, 14, 250000, '2024-12-16 13:23:48', '2024-12-16 14:30:22'),
(200, 10, 1, 2, 20, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(201, 10, 1, 1, 7, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(202, 10, 7, 3, 18, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(203, 10, 7, 2, 50, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(204, 10, 7, 1, 39, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(205, 10, 6, 3, 6, 250000, '2024-12-16 13:23:48', '2024-12-16 16:35:26'),
(206, 10, 6, 2, 44, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(207, 10, 6, 1, 37, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(208, 10, 3, 3, 30, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(209, 10, 3, 2, 24, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(210, 10, 3, 1, 15, 250000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(211, 11, 5, 3, 16, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(212, 11, 5, 2, 22, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(213, 11, 5, 1, 0, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(214, 11, 2, 3, 14, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(215, 11, 2, 2, 33, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(216, 11, 2, 1, 19, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(217, 11, 4, 3, 43, 82000, '2024-12-16 13:23:48', '2024-12-16 14:01:37'),
(218, 11, 4, 2, 19, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(219, 11, 4, 1, 22, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(220, 11, 1, 3, 31, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(221, 11, 1, 2, 8, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(222, 11, 1, 1, 10, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(223, 11, 7, 3, 28, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(224, 11, 7, 2, 0, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(225, 11, 7, 1, 19, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(226, 11, 6, 3, 17, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(227, 11, 6, 2, 39, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(228, 11, 6, 1, 17, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(229, 11, 3, 3, 16, 82000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(230, 11, 3, 2, 15, 82000, '2024-12-16 13:23:48', '2024-12-16 14:30:22'),
(231, 11, 3, 1, 47, 82000, '2024-12-16 13:23:48', '2024-12-16 16:35:27'),
(232, 12, 5, 3, 43, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(233, 12, 5, 2, 24, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(234, 12, 5, 1, 33, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(235, 12, 2, 3, 24, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(236, 12, 2, 2, 25, 403000, '2024-12-16 13:23:48', '2024-12-16 16:35:27'),
(237, 12, 2, 1, 29, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(238, 12, 4, 3, 11, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(239, 12, 4, 2, 5, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(240, 12, 4, 1, 37, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(241, 12, 1, 3, 3, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(242, 12, 1, 2, 0, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(243, 12, 1, 1, 19, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(244, 12, 7, 3, 5, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(245, 12, 7, 2, 35, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(246, 12, 7, 1, 32, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(247, 12, 6, 3, 32, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(248, 12, 6, 2, 47, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(249, 12, 6, 1, 42, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(250, 12, 3, 3, 29, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(251, 12, 3, 2, 22, 403000, '2024-12-16 13:23:48', '2024-12-16 14:01:37'),
(252, 12, 3, 1, 11, 403000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(253, 13, 5, 3, 35, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(254, 13, 5, 2, 17, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(255, 13, 5, 1, 38, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(256, 13, 2, 3, 3, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(257, 13, 2, 2, 1, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(258, 13, 2, 1, 36, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(259, 13, 4, 3, 23, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(260, 13, 4, 2, 5, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(261, 13, 4, 1, 13, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(262, 13, 1, 3, 7, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(263, 13, 1, 2, 20, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(264, 13, 1, 1, 48, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(265, 13, 7, 3, 11, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(266, 13, 7, 2, 11, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(267, 13, 7, 1, 15, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(268, 13, 6, 3, 45, 212000, '2024-12-16 13:23:48', '2024-12-16 14:14:49'),
(269, 13, 6, 2, 8, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(270, 13, 6, 1, 13, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(271, 13, 3, 3, 43, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(272, 13, 3, 2, 12, 212000, '2024-12-16 13:23:48', '2024-12-16 14:18:24'),
(273, 13, 3, 1, 33, 212000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(274, 14, 5, 3, 0, 70000, '2024-12-16 13:23:48', '2024-12-16 14:18:24'),
(275, 14, 5, 2, 46, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(276, 14, 5, 1, 23, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(277, 14, 2, 3, 4, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(278, 14, 2, 2, 21, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(279, 14, 2, 1, 38, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(280, 14, 4, 3, 34, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(281, 14, 4, 2, 35, 70000, '2024-12-16 13:23:48', '2024-12-16 14:31:36'),
(282, 14, 4, 1, 19, 70000, '2024-12-16 13:23:48', '2024-12-16 16:41:13'),
(283, 14, 1, 3, 35, 70000, '2024-12-16 13:23:48', '2024-12-16 17:07:02'),
(284, 14, 1, 2, 31, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(285, 14, 1, 1, 18, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(286, 14, 7, 3, 23, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(287, 14, 7, 2, 39, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(288, 14, 7, 1, 44, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(289, 14, 6, 3, 30, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(290, 14, 6, 2, 25, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(291, 14, 6, 1, 12, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(292, 14, 3, 3, 1, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(293, 14, 3, 2, 36, 70000, '2024-12-16 13:23:48', '2024-12-16 14:14:49'),
(294, 14, 3, 1, 25, 70000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(295, 15, 5, 3, 0, 125000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(296, 15, 5, 2, 3, 125000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(297, 15, 5, 1, 17, 125000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(298, 15, 2, 3, 13, 125000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(299, 15, 2, 2, 12, 125000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(300, 15, 2, 1, 41, 125000, '2024-12-16 13:23:48', '2024-12-16 14:14:49'),
(301, 15, 4, 3, 12, 125000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(302, 15, 4, 2, 36, 125000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(303, 15, 4, 1, 32, 125000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(304, 15, 1, 3, 47, 125000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(305, 15, 1, 2, 11, 125000, '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(306, 15, 1, 1, 26, 125000, '2024-12-16 13:23:48', '2024-12-16 14:31:36'),
(307, 15, 7, 3, 34, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(308, 15, 7, 2, 25, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(309, 15, 7, 1, 43, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(310, 15, 6, 3, 48, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(311, 15, 6, 2, 20, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(312, 15, 6, 1, 36, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(313, 15, 3, 3, 19, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(314, 15, 3, 2, 13, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(315, 15, 3, 1, 42, 125000, '2024-12-16 13:23:49', '2024-12-16 14:18:24'),
(316, 16, 5, 3, 24, 446000, '2024-12-16 13:23:49', '2024-12-16 14:14:49'),
(317, 16, 5, 2, 31, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(318, 16, 5, 1, 10, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(319, 16, 2, 3, 4, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(320, 16, 2, 2, 43, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(321, 16, 2, 1, 41, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(322, 16, 4, 3, 1, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(323, 16, 4, 2, 13, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(324, 16, 4, 1, 9, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(325, 16, 1, 3, 40, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(326, 16, 1, 2, 50, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(327, 16, 1, 1, 20, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(328, 16, 7, 3, 16, 446000, '2024-12-16 13:23:49', '2024-12-16 16:45:39'),
(329, 16, 7, 2, 20, 446000, '2024-12-16 13:23:49', '2024-12-16 16:56:41'),
(330, 16, 7, 1, 5, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(331, 16, 6, 3, 0, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(332, 16, 6, 2, 32, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(333, 16, 6, 1, 46, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(334, 16, 3, 3, 28, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(335, 16, 3, 2, 14, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(336, 16, 3, 1, 7, 446000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(337, 17, 5, 3, 10, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(338, 17, 5, 2, 39, 314000, '2024-12-16 13:23:49', '2024-12-16 16:54:03'),
(339, 17, 5, 1, 12, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(340, 17, 2, 3, 43, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(341, 17, 2, 2, 7, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(342, 17, 2, 1, 50, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(343, 17, 4, 3, 21, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(344, 17, 4, 2, 44, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(345, 17, 4, 1, 7, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(346, 17, 1, 3, 39, 314000, '2024-12-16 13:23:49', '2024-12-16 16:57:30'),
(347, 17, 1, 2, 42, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(348, 17, 1, 1, 22, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(349, 17, 7, 3, 31, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(350, 17, 7, 2, 35, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(351, 17, 7, 1, 20, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(352, 17, 6, 3, 17, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(353, 17, 6, 2, 3, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(354, 17, 6, 1, 0, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(355, 17, 3, 3, 39, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(356, 17, 3, 2, 13, 314000, '2024-12-16 13:23:49', '2024-12-16 16:49:47'),
(357, 17, 3, 1, 27, 314000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(358, 18, 5, 3, 5, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(359, 18, 5, 2, 30, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(360, 18, 5, 1, 27, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(361, 18, 2, 3, 23, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(362, 18, 2, 2, 26, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(363, 18, 2, 1, 36, 149000, '2024-12-16 13:23:49', '2024-12-16 16:52:14'),
(364, 18, 4, 3, 18, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(365, 18, 4, 2, 24, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(366, 18, 4, 1, 25, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(367, 18, 1, 3, 38, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(368, 18, 1, 2, 28, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(369, 18, 1, 1, 22, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(370, 18, 7, 3, 7, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(371, 18, 7, 2, 27, 149000, '2024-12-16 13:23:49', '2024-12-16 16:53:03'),
(372, 18, 7, 1, 12, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(373, 18, 6, 3, 41, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(374, 18, 6, 2, 31, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(375, 18, 6, 1, 38, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(376, 18, 3, 3, 15, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(377, 18, 3, 2, 14, 149000, '2024-12-16 13:23:49', '2024-12-16 14:14:49'),
(378, 18, 3, 1, 38, 149000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(379, 19, 5, 3, 19, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(380, 19, 5, 2, 22, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(381, 19, 5, 1, 46, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(382, 19, 2, 3, 42, 409000, '2024-12-16 13:23:49', '2024-12-16 16:51:45'),
(383, 19, 2, 2, 49, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(384, 19, 2, 1, 28, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(385, 19, 4, 3, 1, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(386, 19, 4, 2, 45, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(387, 19, 4, 1, 3, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(388, 19, 1, 3, 13, 409000, '2024-12-16 13:23:49', '2024-12-16 16:52:38'),
(389, 19, 1, 2, 4, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(390, 19, 1, 1, 36, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(391, 19, 7, 3, 36, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(392, 19, 7, 2, 5, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(393, 19, 7, 1, 42, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(394, 19, 6, 3, 7, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(395, 19, 6, 2, 0, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(396, 19, 6, 1, 42, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(397, 19, 3, 3, 2, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(398, 19, 3, 2, 47, 409000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(399, 19, 3, 1, 42, 409000, '2024-12-16 13:23:49', '2024-12-16 14:14:49'),
(400, 20, 5, 3, 12, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(401, 20, 5, 2, 15, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(402, 20, 5, 1, 31, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(403, 20, 2, 3, 28, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(404, 20, 2, 2, 48, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(405, 20, 2, 1, 13, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(406, 20, 4, 3, 35, 432000, '2024-12-16 13:23:49', '2024-12-16 14:14:49'),
(407, 20, 4, 2, 34, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(408, 20, 4, 1, 13, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(409, 20, 1, 3, 16, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(410, 20, 1, 2, 17, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(411, 20, 1, 1, 32, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(412, 20, 7, 3, 9, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(413, 20, 7, 2, 50, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(414, 20, 7, 1, 26, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(415, 20, 6, 3, 14, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(416, 20, 6, 2, 37, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(417, 20, 6, 1, 25, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(418, 20, 3, 3, 9, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(419, 20, 3, 2, 15, 432000, '2024-12-16 13:23:49', '2024-12-16 16:59:47'),
(420, 20, 3, 1, 20, 432000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(421, 21, 5, 3, 40, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(422, 21, 5, 2, 30, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(423, 21, 5, 1, 17, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(424, 21, 2, 3, 5, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(425, 21, 2, 2, 1, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(426, 21, 2, 1, 13, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(427, 21, 4, 3, 37, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(428, 21, 4, 2, 13, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(429, 21, 4, 1, 48, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(430, 21, 1, 3, 24, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(431, 21, 1, 2, 8, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(432, 21, 1, 1, 42, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(433, 21, 7, 3, 11, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(434, 21, 7, 2, 31, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(435, 21, 7, 1, 46, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(436, 21, 6, 3, 33, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(437, 21, 6, 2, 25, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(438, 21, 6, 1, 0, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(439, 21, 3, 3, 25, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(440, 21, 3, 2, 23, 126000, '2024-12-16 13:23:49', '2024-12-16 14:14:49'),
(441, 21, 3, 1, 43, 126000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(442, 22, 5, 3, 19, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(443, 22, 5, 2, 20, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(444, 22, 5, 1, 38, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(445, 22, 2, 3, 23, 411000, '2024-12-16 13:23:49', '2024-12-16 16:38:20'),
(446, 22, 2, 2, 50, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(447, 22, 2, 1, 17, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(448, 22, 4, 3, 11, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(449, 22, 4, 2, 31, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(450, 22, 4, 1, 11, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(451, 22, 1, 3, 3, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(452, 22, 1, 2, 34, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(453, 22, 1, 1, 8, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(454, 22, 7, 3, 48, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(455, 22, 7, 2, 14, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(456, 22, 7, 1, 35, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(457, 22, 6, 3, 13, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(458, 22, 6, 2, 49, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(459, 22, 6, 1, 50, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(460, 22, 3, 3, 30, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(461, 22, 3, 2, 16, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(462, 22, 3, 1, 23, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(463, 23, 5, 3, 16, 335000, '2024-12-16 13:23:49', '2024-12-16 14:02:32'),
(464, 23, 5, 2, 47, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(465, 23, 5, 1, 0, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(466, 23, 2, 3, 23, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(467, 23, 2, 2, 20, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(468, 23, 2, 1, 15, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(469, 23, 4, 3, 18, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(470, 23, 4, 2, 31, 335000, '2024-12-16 13:23:49', '2024-12-16 16:48:57'),
(471, 23, 4, 1, 38, 335000, '2024-12-16 13:23:49', '2024-12-16 16:46:47'),
(472, 23, 1, 3, 26, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(473, 23, 1, 2, 12, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(474, 23, 1, 1, 50, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(475, 23, 7, 3, 3, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(476, 23, 7, 2, 16, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(477, 23, 7, 1, 38, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(478, 23, 6, 3, 29, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(479, 23, 6, 2, 8, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(480, 23, 6, 1, 24, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(481, 23, 3, 3, 10, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(482, 23, 3, 2, 45, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(483, 23, 3, 1, 2, 335000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(484, 24, 5, 3, 11, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(485, 24, 5, 2, 39, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(486, 24, 5, 1, 31, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(487, 24, 2, 3, 27, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(488, 24, 2, 2, 39, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(489, 24, 2, 1, 9, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(490, 24, 4, 3, 30, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(491, 24, 4, 2, 40, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(492, 24, 4, 1, 46, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(493, 24, 1, 3, 6, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(494, 24, 1, 2, 11, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(495, 24, 1, 1, 4, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(496, 24, 7, 3, 49, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(497, 24, 7, 2, 16, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(498, 24, 7, 1, 6, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(499, 24, 6, 3, 9, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(500, 24, 6, 2, 7, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(501, 24, 6, 1, 8, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(502, 24, 3, 3, 15, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(503, 24, 3, 2, 45, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(504, 24, 3, 1, 34, 411000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(505, 25, 5, 3, 40, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(506, 25, 5, 2, 21, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(507, 25, 5, 1, 5, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(508, 25, 2, 3, 19, 173000, '2024-12-16 13:23:49', '2024-12-16 17:06:53'),
(509, 25, 2, 2, 24, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(510, 25, 2, 1, 47, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(511, 25, 4, 3, 17, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(512, 25, 4, 2, 41, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(513, 25, 4, 1, 18, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(514, 25, 1, 3, 3, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(515, 25, 1, 2, 0, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(516, 25, 1, 1, 42, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(517, 25, 7, 3, 19, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(518, 25, 7, 2, 10, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(519, 25, 7, 1, 44, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(520, 25, 6, 3, 1, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(521, 25, 6, 2, 18, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(522, 25, 6, 1, 47, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(523, 25, 3, 3, 27, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(524, 25, 3, 2, 21, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(525, 25, 3, 1, 41, 173000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(526, 26, 5, 3, 14, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(527, 26, 5, 2, 12, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(528, 26, 5, 1, 1, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(529, 26, 2, 3, 23, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(530, 26, 2, 2, 29, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(531, 26, 2, 1, 11, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(532, 26, 4, 3, 34, 438000, '2024-12-16 13:23:49', '2024-12-16 14:27:06'),
(533, 26, 4, 2, 43, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(534, 26, 4, 1, 47, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(535, 26, 1, 3, 36, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(536, 26, 1, 2, 8, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(537, 26, 1, 1, 7, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(538, 26, 7, 3, 23, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(539, 26, 7, 2, 38, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(540, 26, 7, 1, 35, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(541, 26, 6, 3, 16, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(542, 26, 6, 2, 26, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(543, 26, 6, 1, 11, 438000, '2024-12-16 13:23:49', '2024-12-16 17:15:55'),
(544, 26, 3, 3, 17, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(545, 26, 3, 2, 23, 438000, '2024-12-16 13:23:49', '2024-12-16 14:21:44'),
(546, 26, 3, 1, 6, 438000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(547, 27, 5, 3, 41, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(548, 27, 5, 2, 33, 447000, '2024-12-16 13:23:49', '2024-12-16 17:21:32'),
(549, 27, 5, 1, 18, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(550, 27, 2, 3, 28, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(551, 27, 2, 2, 33, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(552, 27, 2, 1, 24, 447000, '2024-12-16 13:23:49', '2024-12-16 14:21:43'),
(553, 27, 4, 3, 13, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(554, 27, 4, 2, 35, 447000, '2024-12-16 13:23:49', '2024-12-16 17:15:55'),
(555, 27, 4, 1, 14, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(556, 27, 1, 3, 19, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(557, 27, 1, 2, 47, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(558, 27, 1, 1, 22, 447000, '2024-12-16 13:23:49', '2024-12-16 14:14:49'),
(559, 27, 7, 3, 45, 447000, '2024-12-16 13:23:49', '2024-12-16 14:27:06'),
(560, 27, 7, 2, 32, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(561, 27, 7, 1, 36, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(562, 27, 6, 3, 8, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(563, 27, 6, 2, 22, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(564, 27, 6, 1, 9, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(565, 27, 3, 3, 30, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(566, 27, 3, 2, 38, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(567, 27, 3, 1, 13, 447000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(568, 28, 5, 3, 44, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(569, 28, 5, 2, 9, 285000, '2024-12-16 13:23:49', '2024-12-16 17:21:32'),
(570, 28, 5, 1, 23, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(571, 28, 2, 3, 44, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(572, 28, 2, 2, 41, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(573, 28, 2, 1, 19, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(574, 28, 4, 3, 22, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(575, 28, 4, 2, 13, 285000, '2024-12-16 13:23:49', '2024-12-16 14:14:49'),
(576, 28, 4, 1, 11, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(577, 28, 1, 3, 40, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(578, 28, 1, 2, 18, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(579, 28, 1, 1, 6, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(580, 28, 7, 3, 45, 285000, '2024-12-16 13:23:49', '2024-12-16 14:21:43'),
(581, 28, 7, 2, 40, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(582, 28, 7, 1, 49, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(583, 28, 6, 3, 36, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(584, 28, 6, 2, 9, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(585, 28, 6, 1, 1, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(586, 28, 3, 3, 18, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(587, 28, 3, 2, 7, 285000, '2024-12-16 13:23:49', '2024-12-16 14:09:41'),
(588, 28, 3, 1, 26, 285000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(589, 29, 5, 3, 14, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(590, 29, 5, 2, 4, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(591, 29, 5, 1, 39, 407000, '2024-12-16 13:23:49', '2024-12-16 17:19:40'),
(592, 29, 2, 3, 31, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(593, 29, 2, 2, 25, 407000, '2024-12-16 13:23:49', '2024-12-16 14:21:43'),
(594, 29, 2, 1, 14, 407000, '2024-12-16 13:23:49', '2024-12-16 14:53:31'),
(595, 29, 4, 3, 37, 407000, '2024-12-16 13:23:49', '2024-12-16 14:09:41'),
(596, 29, 4, 2, 46, 407000, '2024-12-16 13:23:49', '2024-12-16 14:14:49'),
(597, 29, 4, 1, 27, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(598, 29, 1, 3, 5, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(599, 29, 1, 2, 36, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(600, 29, 1, 1, 8, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(601, 29, 7, 3, 24, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(602, 29, 7, 2, 27, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(603, 29, 7, 1, 10, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(604, 29, 6, 3, 8, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(605, 29, 6, 2, 49, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(606, 29, 6, 1, 6, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(607, 29, 3, 3, 0, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(608, 29, 3, 2, 34, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(609, 29, 3, 1, 47, 407000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(610, 30, 5, 3, 15, 125000, '2024-12-16 13:23:49', '2024-12-16 17:15:55'),
(611, 30, 5, 2, 24, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(612, 30, 5, 1, 15, 125000, '2024-12-16 13:23:49', '2024-12-16 14:21:43'),
(613, 30, 2, 3, 35, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(614, 30, 2, 2, 34, 125000, '2024-12-16 13:23:49', '2024-12-16 14:24:04'),
(615, 30, 2, 1, 16, 125000, '2024-12-16 13:23:49', '2024-12-16 14:50:54'),
(616, 30, 4, 3, 44, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(617, 30, 4, 2, 10, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(618, 30, 4, 1, 14, 125000, '2024-12-16 13:23:49', '2024-12-16 14:09:41'),
(619, 30, 1, 3, 7, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(620, 30, 1, 2, 35, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(621, 30, 1, 1, 33, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(622, 30, 7, 3, 42, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(623, 30, 7, 2, 42, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(624, 30, 7, 1, 30, 125000, '2024-12-16 13:23:49', '2024-12-16 14:14:49'),
(625, 30, 6, 3, 31, 125000, '2024-12-16 13:23:49', '2024-12-16 17:19:40'),
(626, 30, 6, 2, 16, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(627, 30, 6, 1, 3, 125000, '2024-12-16 13:23:49', '2024-12-16 17:15:55'),
(628, 30, 3, 3, 2, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(629, 30, 3, 2, 33, 125000, '2024-12-16 13:23:49', '2024-12-16 16:51:13'),
(630, 30, 3, 1, 6, 125000, '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(631, 31, 1, 1, 23, 550000, '2024-12-16 14:58:13', '2024-12-16 14:58:13'),
(632, 31, 2, 2, 45, 550000, '2024-12-16 14:58:13', '2024-12-16 14:58:13'),
(633, 31, 7, 3, 12, 500000, '2024-12-16 14:58:40', '2024-12-16 14:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint UNSIGNED NOT NULL,
  `product_variant_id` bigint UNSIGNED NOT NULL,
  `name_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` int NOT NULL,
  `total_price` double NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci,
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `order_id`, `rating`, `review`, `is_hidden`, `created_at`, `updated_at`) VALUES
(1, 16, 30, 4, 5, 'đẹp quá ạ', 0, '2024-12-16 14:11:52', '2024-12-16 14:11:52'),
(2, 16, 29, 4, 5, 'mong shop qua nhiều sản phẩm như thế này nha', 0, '2024-12-16 14:12:11', '2024-12-16 14:12:11'),
(3, 16, 28, 4, 5, 'rất đẹp', 0, '2024-12-16 14:12:29', '2024-12-16 14:12:29'),
(4, 11, 30, 5, 3, 'sản phẩm chưa ưng ý', 0, '2024-12-16 14:16:15', '2024-12-16 14:16:15'),
(6, 11, 28, 5, 5, '10đ cho chất lượng', 0, '2024-12-16 14:16:41', '2024-12-16 14:16:41'),
(7, 11, 13, 6, 5, 'số 1 cho chất lượng', 0, '2024-12-16 14:19:50', '2024-12-16 14:19:50'),
(8, 11, 14, 6, 5, 'sản phẩm tuyệt vời', 0, '2024-12-16 14:20:02', '2024-12-16 14:20:02'),
(9, 11, 15, 6, 5, '1 từ thôi tuyệt!', 0, '2024-12-16 14:20:24', '2024-12-16 14:20:24'),
(10, 14, 30, 7, 5, 'đẹp quá', 0, '2024-12-16 14:22:54', '2024-12-16 14:22:54'),
(11, 14, 29, 7, 5, 'đẹp quá', 0, '2024-12-16 14:22:59', '2024-12-16 14:22:59'),
(12, 14, 28, 7, 5, 'đẹp quá', 0, '2024-12-16 14:23:04', '2024-12-16 14:23:04'),
(13, 14, 27, 7, 5, 'đẹp quá', 0, '2024-12-16 14:23:10', '2024-12-16 14:23:10'),
(14, 14, 26, 7, 5, 'đẹp quá', 0, '2024-12-16 14:23:15', '2024-12-16 14:23:15'),
(15, 14, 30, 8, 5, 'Tôi đã mua hàng từ lần trc r quả thực là rất đẹp', 0, '2024-12-16 14:25:40', '2024-12-16 14:25:40'),
(16, 15, 26, 9, 5, 'đẹp vô cùng tận', 0, '2024-12-16 14:28:26', '2024-12-16 14:28:26'),
(17, 15, 27, 9, 5, 'ok', 0, '2024-12-16 14:28:32', '2024-12-16 14:28:32'),
(18, 11, 30, 13, 5, 'đẹp quá', 0, '2024-12-16 14:52:51', '2024-12-16 14:52:51'),
(19, 16, 1, 15, 4, 'Hết nước chấm', 0, '2024-12-16 16:33:58', '2024-12-16 16:33:58'),
(20, 16, 4, 15, 5, 'Tuyệt vời', 0, '2024-12-16 16:34:10', '2024-12-16 16:34:10'),
(21, 16, 10, 16, 5, 'dfgdfg', 0, '2024-12-16 16:36:31', '2024-12-16 16:36:31'),
(22, 16, 11, 16, 4, 'fdgh', 0, '2024-12-16 16:36:39', '2024-12-16 16:36:39'),
(23, 16, 12, 16, 5, 'hihi', 0, '2024-12-16 16:36:50', '2024-12-16 16:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `shippers`
--

CREATE TABLE `shippers` (
  `id` bigint UNSIGNED NOT NULL,
  `name_shipper` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone1` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'S', '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(2, 'M', '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(3, 'L', '2024-12-16 13:23:48', '2024-12-16 13:23:48'),
(4, 'XL', '2024-12-16 14:59:21', '2024-12-16 14:59:21');

-- --------------------------------------------------------

--
-- Table structure for table `status_orders`
--

CREATE TABLE `status_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `name_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_orders`
--

INSERT INTO `status_orders` (`id`, `name_status`, `created_at`, `updated_at`) VALUES
(1, 'pending', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(2, 'processing', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(3, 'picked', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(4, 'delivering', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(5, 'success', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(6, 'failed', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(7, 'completed', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(8, 'cancel', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(9, 'canceling', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(10, 'canceled', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(11, 'refunding', '2024-12-16 13:23:49', '2024-12-16 13:23:49'),
(12, 'refunded', '2024-12-16 13:23:49', '2024-12-16 13:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `status_order_details`
--

CREATE TABLE `status_order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `status_order_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_order_details`
--

INSERT INTO `status_order_details` (`id`, `status_order_id`, `order_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'COD', '2024-12-16 14:00:36', '2024-12-16 14:07:16'),
(2, 5, 2, 'COD', '2024-12-16 14:01:37', '2024-12-16 14:05:32'),
(3, 5, 3, 'COD', '2024-12-16 14:02:32', '2024-12-16 14:06:17'),
(5, 7, 4, 'completed', '2024-12-16 14:11:42', '2024-12-16 14:11:42'),
(7, 7, 5, 'completed', '2024-12-16 14:15:50', '2024-12-16 14:15:50'),
(9, 7, 6, 'completed', '2024-12-16 14:19:35', '2024-12-16 14:19:35'),
(11, 7, 7, 'completed', '2024-12-16 14:22:37', '2024-12-16 14:22:37'),
(13, 7, 8, 'completed', '2024-12-16 14:25:19', '2024-12-16 14:25:19'),
(15, 7, 9, 'completed', '2024-12-16 14:28:11', '2024-12-16 14:28:11'),
(17, 10, 10, 'canceled', '2024-12-16 14:30:22', '2024-12-16 14:30:22'),
(19, 10, 11, 'Đổi ý', '2024-12-16 14:34:48', '2024-12-16 14:34:52'),
(20, 5, 12, 'COD', '2024-12-16 14:47:51', '2024-12-16 14:49:13'),
(22, 7, 13, 'completed', '2024-12-16 14:52:41', '2024-12-16 14:52:41'),
(24, 12, 14, 'Hết nhu cầu sử dụng', '2024-12-16 14:54:22', '2024-12-16 14:54:33'),
(26, 7, 15, 'completed', '2024-12-16 16:33:30', '2024-12-16 16:33:30'),
(28, 7, 16, 'completed', '2024-12-16 16:36:20', '2024-12-16 16:36:20'),
(31, 7, 17, 'completed', '2024-12-16 16:39:37', '2024-12-16 16:39:37'),
(32, 7, 18, 'completed', '2024-12-16 16:40:06', '2024-12-16 16:40:06'),
(34, 7, 19, 'completed', '2024-12-16 16:41:53', '2024-12-16 16:41:53'),
(35, 1, 20, 'COD', '2024-12-16 16:42:42', '2024-12-16 16:42:42'),
(36, 4, 21, 'COD', '2024-12-16 16:43:50', '2024-12-16 17:30:46'),
(39, 3, 24, 'COD', '2024-12-16 16:45:39', '2024-12-16 17:30:47'),
(40, 4, 25, 'COD', '2024-12-16 16:46:20', '2024-12-16 17:30:47'),
(41, 3, 26, 'COD', '2024-12-16 16:46:47', '2024-12-16 17:30:47'),
(42, 1, 27, 'COD', '2024-12-16 16:48:11', '2024-12-16 16:48:11'),
(43, 1, 28, 'COD', '2024-12-16 16:48:57', '2024-12-16 16:48:57'),
(44, 1, 29, 'COD', '2024-12-16 16:49:47', '2024-12-16 16:49:47'),
(45, 1, 30, 'COD', '2024-12-16 16:50:15', '2024-12-16 16:50:15'),
(46, 1, 31, 'COD', '2024-12-16 16:51:13', '2024-12-16 16:51:13'),
(47, 1, 32, 'COD', '2024-12-16 16:51:45', '2024-12-16 16:51:45'),
(48, 1, 33, 'COD', '2024-12-16 16:52:14', '2024-12-16 16:52:14'),
(49, 1, 34, 'COD', '2024-12-16 16:52:38', '2024-12-16 16:52:38'),
(50, 2, 35, 'COD', '2024-12-16 16:53:03', '2024-12-16 17:07:39'),
(51, 2, 36, 'COD', '2024-12-16 16:54:03', '2024-12-16 17:07:37'),
(52, 2, 37, 'COD', '2024-12-16 16:56:41', '2024-12-16 17:07:31'),
(53, 2, 38, 'COD', '2024-12-16 16:57:02', '2024-12-16 17:07:24'),
(54, 2, 39, 'COD', '2024-12-16 16:57:30', '2024-12-16 17:02:06'),
(55, 2, 40, 'COD', '2024-12-16 16:57:57', '2024-12-16 17:02:04'),
(56, 4, 41, 'COD', '2024-12-16 16:58:22', '2024-12-16 17:30:51'),
(59, 10, 43, 'Đổi ý', '2024-12-16 17:02:43', '2024-12-16 17:06:32'),
(60, 10, 42, 'Đổi ý', '2024-12-16 17:02:48', '2024-12-16 17:06:34'),
(61, 10, 23, 'canceled', '2024-12-16 17:06:53', '2024-12-16 17:06:53'),
(62, 10, 22, 'canceled', '2024-12-16 17:07:02', '2024-12-16 17:07:02'),
(64, 10, 44, 'Đổi ý', '2024-12-16 17:18:50', '2024-12-16 17:18:55'),
(65, 5, 45, 'COD', '2024-12-16 17:19:40', '2024-12-16 17:20:38'),
(66, 5, 46, 'COD', '2024-12-16 17:21:32', '2024-12-16 17:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Khách hàng','Quản lý') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `user_image`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sydnee Yundt', 'kassandra.bayer@example.com', NULL, NULL, '2024-12-16 13:23:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Khách hàng', 'GnC3Al8OGi', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(2, 'Caterina Casper', 'qhill@example.com', NULL, NULL, '2024-12-16 13:23:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Khách hàng', 'hsFWr2mdvj', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(3, 'Mrs. Frederique Toy III', 'alfreda.streich@example.com', NULL, NULL, '2024-12-16 13:23:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Khách hàng', 'odON42Q0AF', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(4, 'Karl Schaefer DVM', 'brigitte.bartell@example.com', NULL, NULL, '2024-12-16 13:23:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Khách hàng', 'nClADAQE7a', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(5, 'Ardith Boyer', 'eileen78@example.com', NULL, NULL, '2024-12-16 13:23:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Khách hàng', 'xoGWpO4bWD', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(6, 'Zelda Terry DDS', 'alberta.parisian@example.net', NULL, NULL, '2024-12-16 13:23:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Khách hàng', 'iHrBkwsnwW', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(7, 'Ms. Josephine Renner DDS', 'delfina21@example.com', NULL, NULL, '2024-12-16 13:23:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Khách hàng', 'DWbLGXwq7P', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(8, 'Trudie Herman Sr.', 'mccullough.conrad@example.org', NULL, NULL, '2024-12-16 13:23:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Khách hàng', 'alhDEMxZiC', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(9, 'Miss Jazmyn Bahringer V', 'jordane.bogan@example.org', NULL, NULL, '2024-12-16 13:23:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Khách hàng', 'TbdQT7npmH', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(10, 'Kaylin Fay', 'jaeden44@example.net', NULL, NULL, '2024-12-16 13:23:48', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Khách hàng', '40vG2v2fy9', '2024-12-16 13:23:48', '2024-12-16 13:23:48', NULL),
(11, 'User', 'test@gmail.com', '0333464071', 'user_images/YaaLFamDE3HbHR48IfHDSgyiiVK8tZ5wUc8UHYFA.jpg', '2024-12-16 13:23:49', '$2y$10$Pfj.C66koJ73JrM2Ezfvle4z.h6wVQsp/xDgAbZ1hat/MAI5WbBq.', 'Khách hàng', 'G9zgxHMtKjNSi3KoGK4vVLEcilMYjkDDAtYbAtDajFU9J0Gr8ip4KCXd9bOm', '2024-12-16 13:23:49', '2024-12-16 13:45:58', NULL),
(12, 'Admin', 'admin@gmail.com', '0333464071', 'uploads/images/LwrscFrO3sHQfLQkUaMHqLldHsWcx3k7Qel9dgzk.jpg', '2024-12-16 13:23:49', '$2y$10$d1pdZDZGnTtN2Sf2zRQBrOZDPoyiJIVO67QCcVR42.oIXuApsd/LW', 'Quản lý', 'i9F9OavU7g', '2024-12-16 13:23:49', '2024-12-16 13:52:06', NULL),
(13, 'Minh Đức', 'minhduc@gmail.com', '0345445247', 'uploads/accounts/7OPjQRbrtrMk52bU2U9uGCXLjNr7kMm2i86F9lT3.jpg', NULL, '$2y$10$HuTwkWmiENvKmmlncaOkOOpLDyzH5c27HY4ZFsKo4Ob/ukdrsxlaq', 'Khách hàng', NULL, '2024-12-16 13:41:58', '2024-12-16 13:48:05', NULL),
(14, 'khanhdx', 'dangkhanh16012004@gmail.com', '0398056789', 'uploads/accounts/ZWeJAx69JD3spuo85Lhz1MExjopmHKPORzA3bcqo.jpg', NULL, '$2y$10$cq3jXQ.j0zpwLotrplSNz.j00qZwmKnZ3Uzmmc3vPWeIquecZhESq', 'Khách hàng', NULL, '2024-12-16 13:42:19', '2024-12-16 13:50:01', NULL),
(15, 'đặng xuân khánh', 'khanhdxph40331@fpt.edu.vn', '0987654321', 'uploads/accounts/MDGXVyCtc5V0oSY93CWRzK9b53uj6Kt0GLibqP8B.jpg', NULL, '$2y$10$gWaS8xCgoUP8A5MZDRKykOv51K.1LYPztKjLNkfzUiOyKN0PJs.1y', 'Khách hàng', NULL, '2024-12-16 13:42:53', '2024-12-16 13:51:41', NULL),
(16, 'miumiu', 'meo@gmail.com', '0333464789', 'user_images/tLv7Plqz2ui8qdchgBo8aV62lGi1Z55bQwUEXV68.jpg', NULL, '$2y$10$jNdvsZwZIJoaZYBkZnjj4uqa0EW3TowOagyWLh00YVVkEMW4AdD1a', 'Khách hàng', NULL, '2024-12-16 14:07:55', '2024-12-16 14:08:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voucher_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` enum('Phần trăm','Cố định') COLLATE utf8mb4_unicode_ci NOT NULL,
  `decreased_value` double(12,2) NOT NULL,
  `max_value` double(12,2) DEFAULT NULL,
  `quanlity` int NOT NULL,
  `remaini` int NOT NULL DEFAULT '0',
  `condition` double(12,2) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `type_code` enum('Cá nhân','Công khai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Chưa diễn ra','Đang diễn ra','Đã ngừng','Hết hàng') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `name`, `voucher_code`, `value`, `decreased_value`, `max_value`, `quanlity`, `remaini`, `condition`, `date_start`, `date_end`, `type_code`, `status`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tri ân khách hàng', 'TriAnKhachHang', 'Cố định', 100000.00, 100000.00, 1000, 999, 0.00, '2024-12-16', '2025-10-03', 'Công khai', 'Đang diễn ra', 'Tri ân khách hàng mới tham gia vào hệ thống.', '2024-12-16 13:23:49', '2024-12-16 14:50:54', NULL),
(2, 'Quà tặng người mới', 'QuaTangNguoiMoi', 'Phần trăm', 10.00, 1000000.00, 100, 100, 0.00, '2024-12-16', '2025-10-03', 'Công khai', 'Đang diễn ra', 'Quà tặng cho người dùng mới.', '2024-12-16 13:23:49', '2024-12-16 13:23:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers_wares`
--

CREATE TABLE `vouchers_wares` (
  `id` bigint UNSIGNED NOT NULL,
  `voucher_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers_wares`
--

INSERT INTO `vouchers_wares` (`id`, `voucher_id`, `order_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 11, '2024-12-16 14:50:54', '2024-12-16 14:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_wares`
--

CREATE TABLE `voucher_wares` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voucher_wares`
--

INSERT INTO `voucher_wares` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 13, '2024-12-16 13:41:58', '2024-12-16 13:41:58'),
(2, 14, '2024-12-16 13:42:19', '2024-12-16 13:42:19'),
(3, 15, '2024-12-16 13:42:53', '2024-12-16 13:42:53'),
(4, 16, '2024-12-16 14:07:55', '2024-12-16 14:07:55'),
(5, 11, '2024-12-16 14:50:04', '2024-12-16 14:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `wares_lists`
--

CREATE TABLE `wares_lists` (
  `id` bigint UNSIGNED NOT NULL,
  `vouchers_ware_id` bigint UNSIGNED NOT NULL,
  `voucher_id` bigint UNSIGNED NOT NULL,
  `status` enum('Đã sử dụng','Chưa sử dụng') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wares_lists`
--

INSERT INTO `wares_lists` (`id`, `vouchers_ware_id`, `voucher_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Đã sử dụng', '2024-12-16 14:50:04', '2024-12-16 14:50:54'),
(2, 5, 2, 'Chưa sử dụng', '2024-12-16 14:50:07', '2024-12-16 14:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int UNSIGNED NOT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int NOT NULL,
  `websocket_message_count` int NOT NULL,
  `api_message_count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bannerhome1s`
--
ALTER TABLE `bannerhome1s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_home2s`
--
ALTER TABLE `banner_home2s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blocked_users_user_id_foreign` (`user_id`),
  ADD KEY `blocked_users_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_guest_id_unique` (`guest_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chat_rooms_user_id_unique` (`user_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colors_name_unique` (`name`),
  ADD UNIQUE KEY `colors_code_color_unique` (`code_color`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory_stocks`
--
ALTER TABLE `inventory_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_stocks_product_id_foreign` (`product_id`),
  ADD KEY `inventory_stocks_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locations_user_id_foreign` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_chat_room_id_foreign` (`chat_room_id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_slug_unique` (`slug`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_shipper_id_foreign` (`shipper_id`),
  ADD KEY `orders_voucher_id_foreign` (`voucher_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`SKU`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`),
  ADD KEY `product_variants_color_id_foreign` (`color_id`),
  ADD KEY `product_variants_size_id_foreign` (`size_id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_product_variant_id_foreign` (`product_variant_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`);

--
-- Indexes for table `shippers`
--
ALTER TABLE `shippers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sizes_name_unique` (`name`);

--
-- Indexes for table `status_orders`
--
ALTER TABLE `status_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_order_details`
--
ALTER TABLE `status_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_order_details_status_order_id_foreign` (`status_order_id`),
  ADD KEY `status_order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers_wares`
--
ALTER TABLE `vouchers_wares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vouchers_wares_voucher_id_foreign` (`voucher_id`),
  ADD KEY `vouchers_wares_user_id_foreign` (`user_id`);

--
-- Indexes for table `voucher_wares`
--
ALTER TABLE `voucher_wares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_wares_user_id_foreign` (`user_id`);

--
-- Indexes for table `wares_lists`
--
ALTER TABLE `wares_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wares_lists_vouchers_ware_id_foreign` (`vouchers_ware_id`),
  ADD KEY `wares_lists_voucher_id_foreign` (`voucher_id`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bannerhome1s`
--
ALTER TABLE `bannerhome1s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `banner_home2s`
--
ALTER TABLE `banner_home2s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blocked_users`
--
ALTER TABLE `blocked_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_stocks`
--
ALTER TABLE `inventory_stocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=634;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `shippers`
--
ALTER TABLE `shippers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_orders`
--
ALTER TABLE `status_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `status_order_details`
--
ALTER TABLE `status_order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vouchers_wares`
--
ALTER TABLE `vouchers_wares`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voucher_wares`
--
ALTER TABLE `voucher_wares`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wares_lists`
--
ALTER TABLE `wares_lists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD CONSTRAINT `blocked_users_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blocked_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`);

--
-- Constraints for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD CONSTRAINT `chat_rooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory_stocks`
--
ALTER TABLE `inventory_stocks`
  ADD CONSTRAINT `inventory_stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `inventory_stocks_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_chat_room_id_foreign` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_rooms` (`id`),
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_shipper_id_foreign` FOREIGN KEY (`shipper_id`) REFERENCES `shippers` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_variants_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `status_order_details`
--
ALTER TABLE `status_order_details`
  ADD CONSTRAINT `status_order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `status_order_details_status_order_id_foreign` FOREIGN KEY (`status_order_id`) REFERENCES `status_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vouchers_wares`
--
ALTER TABLE `vouchers_wares`
  ADD CONSTRAINT `vouchers_wares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vouchers_wares_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `voucher_wares`
--
ALTER TABLE `voucher_wares`
  ADD CONSTRAINT `voucher_wares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wares_lists`
--
ALTER TABLE `wares_lists`
  ADD CONSTRAINT `wares_lists_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wares_lists_vouchers_ware_id_foreign` FOREIGN KEY (`vouchers_ware_id`) REFERENCES `voucher_wares` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
