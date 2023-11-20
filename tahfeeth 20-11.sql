-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 06:00 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tahfeeth`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password_reset` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `phone`, `email_verified_at`, `password_reset`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Samir', 'admin@admin.com', 'storage/admin/WUFpF8IHpZgjUSvnAIOQK2s8eRcLum8e6l9eGSJO.png', '01026638997', NULL, NULL, '$2y$10$6x3eDqY3JQZp2fF5JdCgHOg0FBCjoebFoo7xfaKg38QilIUvv.1me', NULL, NULL, '2023-05-19 14:37:26'),
(6, 'admin', 'admin2@admin.com', 'storage/admin/WUFpF8IHpZgjUSvnAIOQK2s8eRcLum8e6l9eGSJO.png', '01026638997', NULL, NULL, '$2y$10$/W9CrlJEyDd9K.9YBNqFVuWcH/XiKfDNoKq2qvPi6akwNWt4QP38.', NULL, NULL, '2022-10-29 18:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `permission_id`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, NULL),
(2, 2, 6, NULL, NULL),
(3, 3, 6, NULL, NULL),
(4, 4, 6, NULL, NULL),
(55, 1, 1, '2023-05-19 14:37:26', '2023-05-19 14:37:26'),
(56, 2, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(57, 3, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(58, 4, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(59, 5, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(60, 7, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(61, 9, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(62, 10, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(63, 11, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(64, 13, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(65, 16, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(66, 80, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(67, 81, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(68, 82, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(69, 83, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(70, 84, 1, '2023-05-19 14:37:27', '2023-05-19 14:37:27'),
(71, 19, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(72, 20, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(73, 21, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(74, 22, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(75, 85, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(76, 86, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(77, 39, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(78, 40, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(79, 41, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(80, 42, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(81, 23, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(82, 24, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(83, 25, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(84, 26, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(85, 51, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(86, 60, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(87, 61, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(88, 62, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(89, 63, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(90, 64, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(91, 65, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(92, 66, 1, '2023-05-19 14:37:28', '2023-05-19 14:37:28'),
(93, 67, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(94, 68, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(95, 69, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(96, 70, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(97, 71, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(98, 72, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(99, 73, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(100, 74, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(101, 75, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(102, 76, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(103, 77, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(104, 78, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29'),
(105, 79, 1, '2023-05-19 14:37:29', '2023-05-19 14:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `type` enum('complaint','suggestion','question') DEFAULT 'complaint',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `phone`, `message`, `type`, `created_at`, `updated_at`) VALUES
(1, 'ahmed samir', 'a@a.com', 'complition message', NULL, 'test complition message', 'complaint', '2023-11-13 19:29:09', '2023-11-13 19:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(1024) DEFAULT NULL,
  `answer` varchar(1024) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'ما هو المسار التاهيللى', 'المسار التاهيللى يساعدك على ضبط القرائة برواية حفص عن عاصم', NULL, '2023-11-13 17:58:19'),
(2, 'ما هو مسار الحافظ الجديد', 'مسار الحافظ الجديد يساعدك على حفظ القران الكريم كاملا و المتابعة معك', NULL, '2023-11-13 17:59:27'),
(3, 'ما هو مسار الخاتمين', 'مسار الخاتمين يساعدك على مراجعة القران الكريم كاملا و المتابعة معك', NULL, '2023-11-13 18:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_08_10_201958_create_users_table', 1),
(3, '2023_09_10_194141_create_tests_table', 1),
(4, '2023_09_11_084042_create_questions_table', 1),
(5, '2023_09_11_084236_create_answers_table', 1),
(6, '2023_09_11_085545_create_reports_table', 1),
(7, '2023_09_11_085617_create_recitation_reports_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `section_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'عرض', NULL, NULL),
(2, 1, 'تعديل', NULL, NULL),
(3, 1, 'حذف', NULL, NULL),
(4, 1, 'اضافة', NULL, NULL),
(5, 2, 'عرض', NULL, NULL),
(7, 2, 'حذف', NULL, NULL),
(9, 2, 'تغيير الحالة', NULL, NULL),
(10, 2, 'حظر', NULL, NULL),
(11, 3, 'عرض', NULL, NULL),
(13, 3, 'حذف', NULL, NULL),
(16, 3, 'حظر', NULL, NULL),
(19, 5, 'عرض', NULL, NULL),
(20, 5, 'حظر', NULL, NULL),
(21, 5, 'حذف', NULL, NULL),
(22, 6, 'تعديل', NULL, NULL),
(23, 14, 'عرض', NULL, NULL),
(24, 14, 'تعديل', NULL, NULL),
(25, 14, 'حذف', NULL, NULL),
(26, 14, 'اضافة', NULL, NULL),
(39, 11, 'عرض', NULL, NULL),
(40, 11, 'حذف', NULL, NULL),
(41, 11, 'تغيير الحالة', NULL, NULL),
(42, 12, 'اضافة', NULL, NULL),
(51, 15, 'عرض', NULL, NULL),
(60, 17, 'عرض', NULL, NULL),
(61, 17, 'تعديل', NULL, NULL),
(62, 17, 'حذف', NULL, NULL),
(63, 17, 'اضافة', NULL, NULL),
(64, 18, 'عرض', NULL, NULL),
(65, 18, 'تعديل', NULL, NULL),
(66, 18, 'حذف', NULL, NULL),
(67, 18, 'اضافة', NULL, NULL),
(68, 19, 'عرض', NULL, NULL),
(69, 19, 'تعديل', NULL, NULL),
(70, 19, 'حذف', NULL, NULL),
(71, 19, 'اضافة', NULL, NULL),
(72, 20, 'عرض', NULL, NULL),
(73, 20, 'تعديل', NULL, NULL),
(74, 20, 'حذف', NULL, NULL),
(75, 20, 'اضافة', NULL, NULL),
(76, 21, 'عرض', NULL, NULL),
(77, 21, 'تعديل', NULL, NULL),
(78, 21, 'حذف', NULL, NULL),
(79, 21, 'اضافة', NULL, NULL),
(80, 4, 'عرض', NULL, NULL),
(81, 4, 'تعديل', NULL, NULL),
(82, 4, 'حذف', NULL, NULL),
(83, 4, 'اضافة', NULL, NULL),
(84, 4, 'حظر', NULL, NULL),
(85, 7, 'عرض', NULL, NULL),
(86, 7, 'حذف', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_sections`
--

CREATE TABLE `permission_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_sections`
--

INSERT INTO `permission_sections` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'المشرفين', NULL, NULL),
(2, 'المستخدمين', NULL, NULL),
(3, 'المندوبين', NULL, NULL),
(4, 'المطاعم', NULL, NULL),
(5, 'رسائل التواصل', NULL, NULL),
(6, 'الاعدادات', NULL, NULL),
(7, 'المساعدة والدعم', NULL, NULL),
(11, 'الطلبات', NULL, NULL),
(12, 'الاشعارات', NULL, NULL),
(14, 'المنتجات', NULL, NULL),
(15, 'احصائيات الرئيسية', NULL, NULL),
(17, 'الاقسام', NULL, NULL),
(18, 'اقسام الاضافات', NULL, NULL),
(19, 'الاضافات', NULL, NULL),
(20, 'صور العرض', NULL, NULL),
(21, 'الكوبونات', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `created_at`, `updated_at`) VALUES
(13, '<p><span style=\"font-size:16px\">﴿عَبَسَ وَتَوَلّى۝أَن جاءَهُ الأَعمى۝وَما يُدريكَ لَعَلَّهُ يَزَّكّى۝أَو يَذَّكَّرُ فَتَنفَعَهُ الذِّكرى۝أَمّا مَنِ استَغنى۝فَأَنتَ لَهُ تَصَدّى۝وَما عَلَيكَ أَلّا يَزَّكّى۝وَأَمّا مَن جاءَكَ يَسعى۝وَهُوَ يَخشى۝فَأَنتَ عَنهُ تَلَهّى۝كَلّا إِنَّها تَذكِرَةٌ۝فَمَن شاءَ ذَكَرَهُ۝في صُحُفٍ مُكَرَّمَةٍ۝مَرفوعَةٍ مُطَهَّرَةٍ۝بِأَيدي سَفَرَةٍ۝كِرامٍ بَرَرَةٍ۝قُتِلَ الإِنسانُ ما أَكفَرَهُ۝مِن أَيِّ شَيءٍ خَلَقَهُ۝مِن نُطفَةٍ خَلَقَهُ فَقَدَّرَهُ۝ثُمَّ السَّبيلَ يَسَّرَهُ۝ثُمَّ أَماتَهُ فَأَقبَرَهُ۝ثُمَّ إِذا شاءَ أَنشَرَهُ۝كَلّا لَمّا يَقضِ ما أَمَرَهُ﴾&nbsp;[عبس:&nbsp;١-٢٣]</span></p>', '2023-10-30 11:00:48', '2023-10-30 11:00:48'),
(14, '<p><span style=\"font-size:16px\">﴿۞ لَّیۡسَ ٱلۡبِرَّ أَن تُوَلُّوا۟ وُجُوهَكُمۡ قِبَلَ ٱلۡمَشۡرِقِ وَٱلۡمَغۡرِبِ وَلَـٰكِنَّ ٱلۡبِرَّ مَنۡ ءَامَنَ بِٱللَّهِ وَٱلۡیَوۡمِ ٱلۡـَٔاخِرِ وَٱلۡمَلَـٰۤىِٕكَةِ وَٱلۡكِتَـٰبِ وَٱلنَّبِیِّـۧنَ وَءَاتَى ٱلۡمَالَ عَلَىٰ حُبِّهِۦ ذَوِی ٱلۡقُرۡبَىٰ وَٱلۡیَتَـٰمَىٰ وَٱلۡمَسَـٰكِینَ وَٱبۡنَ ٱلسَّبِیلِ وَٱلسَّاۤىِٕلِینَ وَفِی ٱلرِّقَابِ وَأَقَامَ ٱلصَّلَوٰةَ وَءَاتَى ٱلزَّكَوٰةَ وَٱلۡمُوفُونَ بِعَهۡدِهِمۡ إِذَا عَـٰهَدُوا۟ۖ وَٱلصَّـٰبِرِینَ فِی ٱلۡبَأۡسَاۤءِ وَٱلضَّرَّاۤءِ وَحِینَ ٱلۡبَأۡسِۗ أُو۟لَـٰۤىِٕكَ ٱلَّذِینَ صَدَقُوا۟ۖ وَأُو۟لَـٰۤىِٕكَ هُمُ ٱلۡمُتَّقُونَ﴾ [البقرة 177].</span></p>', '2023-10-30 11:00:48', '2023-10-30 11:00:48'),
(15, '<p><span style=\"font-size:16px\">﴿كَانَ ٱلنَّاسُ أُمَّةࣰ وَ ٰ⁠حِدَةࣰ فَبَعَثَ ٱللَّهُ ٱلنَّبِیِّـۧنَ مُبَشِّرِینَ وَمُنذِرِینَ وَأَنزَلَ مَعَهُمُ ٱلۡكِتَـٰبَ بِٱلۡحَقِّ لِیَحۡكُمَ بَیۡنَ ٱلنَّاسِ فِیمَا ٱخۡتَلَفُوا۟ فِیهِۚ وَمَا ٱخۡتَلَفَ فِیهِ إِلَّا ٱلَّذِینَ أُوتُوهُ مِنۢ بَعۡدِ مَا جَاۤءَتۡهُمُ ٱلۡبَیِّنَـٰتُ بَغۡیَۢا بَیۡنَهُمۡۖ فَهَدَى ٱللَّهُ ٱلَّذِینَ ءَامَنُوا۟ لِمَا ٱخۡتَلَفُوا۟ فِیهِ مِنَ ٱلۡحَقِّ بِإِذۡنِهِۦۗ وَٱللَّهُ یَهۡدِی مَن یَشَاۤءُ إِلَىٰ صِرَ ٰ⁠طࣲ مُّسۡتَقِیمٍ﴾ [البقرة 213].</span></p>', '2023-10-30 11:00:48', '2023-10-30 11:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `recitation_reports`
--

CREATE TABLE `recitation_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `recitation` varchar(191) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `new` varchar(191) DEFAULT NULL,
  `prev` varchar(191) DEFAULT NULL,
  `old` varchar(191) DEFAULT NULL,
  `repeats` varchar(191) DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `whatsapp` varchar(191) DEFAULT NULL,
  `group_limit` int(11) DEFAULT 0,
  `group_number` int(11) DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `fav_icon` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `whatsapp`, `group_limit`, `group_number`, `start_date`, `end_date`, `logo`, `fav_icon`, `created_at`, `updated_at`) VALUES
(1, '01004834728', 70, 20, '2023-10-08', '2023-10-18', 'uploads/setting/18081699736176.png', 'uploads/setting/49541699736176.png', NULL, '2023-11-11 18:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `record` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `user_id`, `record`, `created_at`, `updated_at`) VALUES
(14, 22, 'Uploads/Records/19771699478464.mp3', '2023-11-08 19:21:04', '2023-11-08 19:21:04'),
(15, 22, 'Uploads/Records/53381699478464.mp3', '2023-11-08 19:21:04', '2023-11-08 19:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `username` varchar(191) DEFAULT NULL,
  `phone_code` int(11) DEFAULT NULL,
  `phone` int(15) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `code` int(8) DEFAULT NULL,
  `code_created_at` datetime DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `nationality` varchar(191) DEFAULT NULL,
  `residation` varchar(191) DEFAULT NULL,
  `identification` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `track` enum('beginner','mid_level','high_level') DEFAULT NULL,
  `role` enum('user','admin','teacher') NOT NULL DEFAULT 'user',
  `status` enum('pending','active','inactive') NOT NULL DEFAULT 'pending',
  `stage` enum('dabt','taahhud','isnad','qiraat') NOT NULL DEFAULT 'dabt',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `phone_code`, `phone`, `email`, `password`, `code`, `code_created_at`, `birth_date`, `nationality`, `residation`, `identification`, `image`, `gender`, `track`, `role`, `status`, `stage`, `created_at`, `updated_at`) VALUES
(1, 'ahmed test', 'test_ahmed', 966, 1234567, 'a@a.com3a', '$2y$10$zbYz/EyIIsKaBr4RdyrEPeRCPCNxyAGiqLdUwojto.FWSBvDDtFNi', NULL, '2023-09-27 19:37:56', '0000-00-00', 'egypt', 'test', '12345', 'Uploads/User/68981696581187.jpg', 'female', 'mid_level', 'teacher', 'pending', 'dabt', '2023-09-11 17:07:24', '2023-10-06 08:33:07'),
(2, 'ahmed test', 'test2', 20, 12345, 'a@a.com2', '$2y$10$fErYg4ojI6.Cxdtz9EETLOmBtvbJW3yozbDSCV156RGafvWaHIrRK', NULL, NULL, '0000-00-00', 'egypt', 'test', '1234', 'Uploads/User/54091694464075.jpg', 'male', 'beginner', 'teacher', 'pending', 'dabt', '2023-09-11 17:27:55', '2023-09-11 17:27:55'),
(3, 'ahmed test', 'test3', 20, 123456, 'a@a.com3', '$2y$10$LMpT/PSYxTfN1CtllXYJcuG6N5SjlmZtLFGukn9UPNlS4lL.hfK5G', NULL, NULL, '0000-00-00', 'egypt', 'test', '1234', 'Uploads/User/62641694464143.jpg', 'male', 'beginner', 'admin', 'pending', 'dabt', '2023-09-11 17:29:03', '2023-09-11 17:29:03'),
(4, 'abdalla ayman abdalla ali', 'abdalla', 249, 118845445, 'abdallaaymanshandi3@gmal.com', '$2y$10$3Xuo1b00VNmonhioFNi6auwApgAszUKlLf2rKoGTv.c5H65ElfJBW', NULL, NULL, '0000-00-00', 'السودان', 'السودان', NULL, NULL, 'male', 'mid_level', 'user', 'pending', 'dabt', '2023-09-20 05:30:11', '2023-09-20 05:30:11'),
(5, 'مازن عثمان يوسف احمد', 'مازن عثمان', 966, 501872698, 'mazinabusalma@hotmail.com', '$2y$10$99g82vEfAQW8vXLPW5XDGuKmPSjGmsVbC/dCzUXJqQXyWt4LW2pGy', NULL, '2023-09-29 18:43:50', '2010-10-12', 'السودان', 'المملكة العربية السعودية', '1234567890', 'Uploads/User/67971697000250.webp', 'male', 'high_level', 'user', 'pending', 'dabt', '2023-09-20 11:25:17', '2023-10-11 10:43:52'),
(6, 'abdal', '1abdalla', 852, 1188454451, 'abdalla@ff.com', '$2y$10$lt9KKli76kpnqTYIpRj0c.4Q6CWU7sTF6jagePpT5szTCZG1VEbHK', NULL, NULL, '0000-00-00', 'الامارات العربية المتحدة', 'ألبانيا', NULL, NULL, 'male', 'mid_level', 'user', 'pending', 'dabt', '2023-09-21 09:09:35', '2023-09-21 09:09:35'),
(7, 'abdal', '1abdallaa', 852, 1188454454, 'aabdalla@ff.com', '$2y$10$Ux1xfEOqvEPhRpV7aAlYKuzuMCyL06TK3UyjfwSxMPLCclstg8yDe', NULL, NULL, '0000-00-00', 'أفغانستان', 'ألبانيا', NULL, NULL, 'male', 'mid_level', 'user', 'pending', 'dabt', '2023-09-21 09:18:45', '2023-09-21 09:18:45'),
(8, 'abdal', '11abdallaa', 852, 1188454452, '1aabdalla@ff.com', '$2y$10$tM8cV6rLXm/cl7QKzzwuNOkHqulzPfhg9cIrrZqcMis.J7mqpTAH6', NULL, NULL, '0000-00-00', 'أفغانستان', 'ألبانيا', NULL, NULL, 'male', 'mid_level', 'user', 'pending', 'dabt', '2023-09-21 09:20:14', '2023-09-21 09:20:14'),
(9, 'abdal', '111abdallaa', 852, 1188454453, '1aa2bdalla@ff.com', '$2y$10$TFNyJBI8SkPZ2rR9iV39T.8vMBHS2Cmh1OMsKJlSiwy.H/Sw3yo36', NULL, NULL, '0000-00-00', 'أفغانستان', 'ألبانيا', NULL, NULL, 'male', 'mid_level', 'user', 'pending', 'dabt', '2023-09-21 09:21:25', '2023-09-21 09:21:25'),
(10, 'عبدالله ايمن عبدالله علي', 'abdo123', 249, 998024710, 'abdallaayman75@gmail.com', '$2y$10$VZwirssrLpqMLGrPHCfJsOoHfogG6Xxaw50Rhm5Fy.VNhsMskgoo6', NULL, NULL, '2022-10-14', 'السودان', 'السودان', 'P34457', 'Uploads/User/7061697965564.jpg', 'male', 'mid_level', 'user', 'pending', 'dabt', '2023-09-21 09:24:04', '2023-10-22 09:06:04'),
(11, 'مقارئ السفرة تحفيظ', 'مقارئ السفرة', 249, 912153727, 'Maqaresafarah@gmail.com', '$2y$10$5Ljy4oNqo7eQvCRrAZ5qlelgc5qfo.x/VgwgJJYBHS/ept7KVpvwS', NULL, NULL, '0000-00-00', 'السودان', 'المملكة العربية السعودية', '1234567890', NULL, 'male', 'mid_level', 'teacher', 'pending', 'dabt', '2023-09-24 12:11:10', '2023-10-11 05:11:23'),
(12, 'ahmed abdelrahman', 'ahmedjmd', 249, 126414252, 'ahmedabdalrahman706@gmail.com', '$2y$10$QSAWnjNas7lKARfQUB09mOKQWPFtVOpjMIbrWTW9X0cONPQyFKFfS', NULL, '2023-10-13 19:04:04', '2000-12-21', 'السودان', 'السودان', 'sudan', 'Uploads/User/35811696884358.jpeg', 'male', 'beginner', 'user', 'pending', 'taahhud', '2023-09-24 12:55:42', '2023-11-11 18:47:26'),
(13, 'محمد وليد محمد طه', 'محمد وليد محمد طه', 249, 912301613, 'mohamedwaleedtravel@hotmail.com', '$2y$10$pM.tI6V61yQqT1PbWHBmdeiCipK94J/rgzp8Cd7y/192i5b8ZEKUq', NULL, NULL, '0000-00-00', 'السودان', 'السودان', NULL, NULL, 'male', 'mid_level', 'teacher', 'pending', 'dabt', '2023-09-25 03:34:31', '2023-09-25 03:36:55'),
(14, 'أحمد جمال الدين عبد السلام عبد القادر', 'أحمد جمال', 249, 908480420, 'ahmdjamal21@gmail.com', '$2y$10$Xc0nCmAyAuyr0eOTnfDDMeO7l31gQG9/NdqIdWvv88yZJKXkzlSHq', 999300, NULL, '0000-00-00', 'السودان', 'السودان', NULL, NULL, 'male', 'mid_level', 'teacher', 'pending', 'dabt', '2023-09-25 04:02:26', '2023-09-25 08:57:17'),
(15, 'عيسى محمدالحسن محمد علي', 'عيسى ابو احمد', 249, 112217441, 'eisajadaa@gmail.com', '$2y$10$6QqkmPRlDMg4HToCTCZIm.1EvT73Y83UsI4LE62K3KYri/7RfFAWO', NULL, NULL, '0000-00-00', 'السودان', 'السودان', NULL, NULL, 'male', 'mid_level', 'teacher', 'pending', 'dabt', '2023-09-25 05:51:18', '2023-09-25 05:51:18'),
(16, 'محمد ربيع حسن عبد الدائم', 'محمد ربيع', 966, 566790973, 'mohmmedrabeie200140@gmail.com', '$2y$10$k8AM1YyF6lu9m5tSjlUcauA0H0OPsQY23uYUeR7LCrrWrJZ7RSe1W', NULL, NULL, '0000-00-00', 'السودان', 'المملكة العربية السعودية', NULL, NULL, 'male', 'mid_level', 'teacher', 'pending', 'dabt', '2023-09-25 11:56:56', '2023-09-25 11:56:56'),
(17, 'عبدالحق علي عبدالله يوسف', 'عبدالحق', 249, 902701207, 'abdalhg.ali@gmail.com', '$2y$10$OUV7s6an7d5HTRZes3CSSer6VAbz8bvx3bqHtZ9S3gxT7GGK25kXe', NULL, NULL, '0000-00-00', 'السودان', 'السودان', NULL, NULL, 'male', 'high_level', 'user', 'active', 'isnad', '2023-09-26 22:03:40', '2023-11-11 18:48:50'),
(18, 'عبدالله ايمن عبدالله علي', 'abdalla123', 249, 912713571, 'abdallaaymanshandi3@gmail.com', '$2y$10$ZRSl5TujCEAudhXDd3RqnOj4h.oKJm.gTRDNkcqCYjRy12yiJeptS', NULL, NULL, '0000-00-00', 'السودان', 'السودان', NULL, NULL, 'male', 'beginner', 'teacher', 'pending', 'dabt', '2023-09-27 15:33:55', '2023-09-27 15:33:55'),
(19, 'ahmed test', 'test4', 20, 1234569, 'a@a.com31', '$2y$10$iN3XIpyeRKlGDxeL6QrjPeYHJVjKn859yo/2suPqZh/cFaQRueQ3K', NULL, NULL, '2000-05-05', 'egypt', 'test', '1234', NULL, 'male', 'beginner', 'admin', 'pending', 'dabt', '2023-10-07 16:13:46', '2023-10-07 16:13:46'),
(20, 'ahmed test', 'test_ahmed1', 966, 12345678, 'a@a.com3a5', '$2y$10$WPw3B4MNo5pa6i1sRAbtNOga60uemC5P.dBp29tfQ9WjkrHIZzWBa', NULL, NULL, '2000-05-05', 'egypt', 'test', '12345', 'Uploads/User/28731697661542.png', 'male', 'high_level', 'admin', 'pending', 'dabt', '2023-10-07 16:15:21', '2023-10-22 16:14:22'),
(21, 'ahmed test', 'test51', 20, 123456971, 'a@a.com321', '$2y$10$PbHcXTE/cRxQaQiJkgRzUOKx6mQ70OPyRgvZ0o3.GKecUnZaeDxvC', NULL, NULL, '2000-05-05', 'egypt', 'test', '1234', NULL, 'male', 'beginner', 'admin', 'pending', 'dabt', '2023-10-07 20:27:51', '2023-10-07 20:27:51'),
(22, 'منذر', 'monzer', 90, 535769701, 'monzeridris01@gmail.com', '$2y$10$uyL2OWwJg3Z/fLYgevw07OxJru56c0uvtQnRjKO//KQJrXGGOPVqe', NULL, NULL, '2000-02-26', 'تركيا', 'تركيا', NULL, 'Uploads/User/88801697988622.jpg', 'male', 'mid_level', 'user', 'inactive', 'dabt', '2023-10-16 15:04:17', '2023-11-11 18:41:13'),
(23, 'ahmed test', 'test52', 20, 123456972, 'a@a.com322', '$2y$10$1BESocUrz7w3f4FrEpK1hubQDe2l4XrSogzafrGq10Hi28T0zslE6', NULL, NULL, '2000-05-05', 'egypt', 'test', '1234', NULL, 'male', NULL, 'admin', 'active', 'dabt', '2023-10-22 16:16:11', '2023-10-24 15:25:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_Per_per` (`permission_id`),
  ADD KEY `ad_per_admin_ID16` (`admin_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `per_sec_id` (`section_id`);

--
-- Indexes for table `permission_sections`
--
ALTER TABLE `permission_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recitation_reports`
--
ALTER TABLE `recitation_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recitation_reports_user_id_foreign` (`user_id`),
  ADD KEY `recitation_reports_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`),
  ADD KEY `reports_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tests_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `permission_sections`
--
ALTER TABLE `permission_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `recitation_reports`
--
ALTER TABLE `recitation_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD CONSTRAINT `ad_Per_per` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ad_per_admin_ID16` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `per_sec_id` FOREIGN KEY (`section_id`) REFERENCES `permission_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recitation_reports`
--
ALTER TABLE `recitation_reports`
  ADD CONSTRAINT `recitation_reports_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recitation_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
