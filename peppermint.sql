-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 15, 2016 at 08:32 AM
-- Server version: 5.6.28
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peppermint`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_info` text COLLATE utf8_unicode_ci,
  `firm_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `billing_info`, `firm_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Zachary Aries', NULL, 1, 11, '2016-12-15 06:53:33', '2016-12-15 06:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `announced` datetime DEFAULT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `message`, `announced`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'Sed hendrerit tincidunt elit, sit amet imperdiet diam efficitur nec. Maecenas pulvinar ullamcorper ex eu aliquam. Nullam fringilla iaculis augue. Integer in imperdiet velit, sit amet euismod augue. Quisque id tortor at mauris viverra venenatis placerat a felis. Nam vitae dignissim magna. Nunc vel velit neque. Maecenas vestibulum felis nec accumsan hendrerit. Nulla a mauris vitae eros condimentum aliquam vel et ligula.', '2016-12-14 23:53:59', 1, '2016-12-15 06:53:59', '2016-12-15 06:53:59'),
(2, 'Sed hendrerit tincidunt elit, sit amet imperdiet diam efficitur nec. Maecenas pulvinar ullamcorper ex eu aliquam. Nullam fringilla iaculis augue. Integer in imperdiet velit, sit amet euismod augue. Quisque id tortor at mauris viverra venenatis placerat a felis. Nam vitae dignissim magna. Nunc vel velit neque. Maecenas vestibulum felis nec accumsan hendrerit. Nulla a mauris vitae eros condimentum aliquam vel et ligula.', '2016-12-14 23:54:05', 1, '2016-12-15 06:54:05', '2016-12-15 06:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sin` int(11) NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `wage` int(11) NOT NULL,
  `firm_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `sin`, `phone_number`, `address`, `wage`, `firm_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Clovis', 'Shields', 972063927, '1-404-216-8472 x5605', '52923 Hammes Pines Apt. 644\nMalindafort, IN 78978', 21, 1, 1, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(2, 'Jennie', 'Von', 235456108, '304-488-5391 x8322', '42327 Auer Haven Apt. 858\nNew Metaton, TN 95396', 82, 1, 2, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(3, 'Marco', 'Kuhlman', 246525508, '961-541-1303 x48246', '65174 Kling Estate Suite 257\nCharlesshire, PA 48152', 46, 1, 3, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(4, 'Vernie', 'Cummerata', 749441306, '(365) 860-2836', '1032 Blanda Roads Suite 330\nRitchiemouth, MN 78299-9980', 90, 1, 4, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(5, 'Bernardo', 'Bechtelar', 367654860, '(740) 565-9889 x929', '8940 Erdman Park Suite 319\nRalphside, NH 12035', 94, 1, 5, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(6, 'Millie', 'Ward', 43842841, '1-323-469-2177', '257 Eleanore Club\nFeestfurt, WA 30663-2589', 20, 1, 6, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(7, 'Nicholas', 'O\'Connell', 305529519, '720-749-6175 x61478', '5493 King Rest\nPort Manuelastad, LA 65132', 81, 1, 7, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(8, 'Lauryn', 'Abernathy', 634200123, '702-934-5235 x5445', '565 Abbott Island\nNew Gisselleside, NE 16727', 14, 1, 8, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(9, 'Jenifer', 'Hyatt', 689048512, '289-581-3919', '577 Deckow Row\nOlsonton, ND 94065-5887', 58, 1, 9, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(10, 'Shanon', 'Becker', 948718161, '865-431-5561', '216 Goyette Points\nAylinhaven, VT 43961-7357', 28, 1, 10, '2016-12-15 06:52:50', '2016-12-15 06:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `punched_in` datetime DEFAULT NULL,
  `punched_out` datetime DEFAULT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `start`, `end`, `punched_in`, `punched_out`, `employee_id`, `created_at`, `updated_at`) VALUES
(1, '2016-12-02 08:00:00', '2016-12-02 17:00:00', '2016-12-02 08:00:00', '2016-12-02 17:00:00', 5, '2016-12-15 07:09:01', '2016-12-15 07:09:01'),
(2, '2016-12-15 08:00:00', '2016-12-15 17:00:00', '2016-12-15 08:00:00', '2016-12-15 17:00:00', 5, '2016-12-15 07:09:23', '2016-12-15 07:09:23'),
(3, '2016-12-03 09:00:00', '2016-12-03 16:00:00', '2016-12-03 09:00:00', '2016-12-03 16:00:00', 8, '2016-12-15 07:09:59', '2016-12-15 07:09:59'),
(4, '2016-12-13 07:00:00', '2016-12-13 16:00:00', '2016-12-13 07:00:00', '2016-12-13 16:00:00', 8, '2016-12-15 07:10:20', '2016-12-15 07:10:20'),
(5, '2016-12-06 09:00:00', '2016-12-06 17:00:00', '2016-12-06 09:00:00', '2016-12-06 17:00:00', 3, '2016-12-15 07:10:43', '2016-12-15 07:10:43'),
(6, '2016-12-14 05:00:00', '2016-12-14 16:00:00', '2016-12-14 05:00:00', '2016-12-14 16:00:00', 3, '2016-12-15 07:11:17', '2016-12-15 07:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `firms`
--

CREATE TABLE `firms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `firms`
--

INSERT INTO `firms` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Peppermint', '2016-12-15 06:53:33', '2016-12-15 06:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount_billed` double(8,2) NOT NULL,
  `sent` datetime DEFAULT NULL,
  `received` datetime DEFAULT NULL,
  `firm_id` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `amount_billed`, `sent`, `received`, `firm_id`, `company_name`, `created_at`, `updated_at`) VALUES
(1, 1502.99, '2016-12-15 10:00:00', '2016-12-15 22:00:00', 1, 'Fake Co', '2016-12-15 07:06:12', '2016-12-15 07:06:12'),
(2, 123.42, '2016-12-01 00:12:00', '2016-12-02 00:12:00', 1, 'Acme Inc.', '2016-12-15 07:06:49', '2016-12-15 07:06:49'),
(3, 743.12, '2016-12-05 15:03:00', '2016-12-05 14:02:00', 1, 'Made Up Inc.', '2016-12-15 07:07:21', '2016-12-15 07:07:21'),
(4, 7812.44, '2016-12-08 00:12:00', '2016-12-11 12:41:00', 1, 'Microsoft', '2016-12-15 07:07:46', '2016-12-15 07:07:46'),
(5, 4182.93, '2016-12-14 03:33:00', '2016-12-15 14:03:00', 1, 'Amazon', '2016-12-15 07:08:14', '2016-12-15 07:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(300, '2014_10_12_000000_create_users_table', 1),
(301, '2014_10_12_100000_create_password_resets_table', 1),
(302, '2016_11_10_053037_create_firms_table', 1),
(303, '2016_11_10_062130_create_admins_table', 1),
(304, '2016_11_10_070347_create_employees_table', 1),
(305, '2016_11_10_185150_create_roles_table', 1),
(306, '2016_12_03_181115_create_supplies_table', 1),
(307, '2016_12_07_043629_create_invoices_table', 1),
(308, '2016_12_14_004116_create_announcements_table', 1),
(309, '2016_12_14_130123_create_events_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'sysadmin', '2016-12-15 06:52:48', '2016-12-15 06:52:48'),
(2, 'admin', '2016-12-15 06:52:48', '2016-12-15 06:52:48'),
(3, 'employee', '2016-12-15 06:52:48', '2016-12-15 06:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 3, 3),
(4, 3, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_stock` int(11) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `num_ordered` int(11) NOT NULL,
  `firm_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`id`, `type`, `total_stock`, `cost`, `in_stock`, `num_ordered`, `firm_id`, `created_at`, `updated_at`) VALUES
(1, 'Wood 2x4', 127, 5.25, 127, 0, 1, '2016-12-02 06:55:06', '2016-12-15 06:55:06'),
(2, 'Wood 4x4', 52, 8.93, 52, 0, 1, '2016-12-04 06:55:35', '2016-12-15 06:55:35'),
(3, 'Metal Screw', 241, 1.42, 241, 0, 1, '2016-12-09 06:55:52', '2016-12-15 06:55:52'),
(4, 'Staple Packs', 42, 6.21, 40, 2, 1, '2016-12-15 06:56:16', '2016-12-15 06:56:16'),
(5, 'Glue', 12, 42.12, 12, 0, 1, '2016-12-12 06:56:33', '2016-12-15 06:56:33'),
(6, 'Plywood Sheets', 21, 24.12, 21, 0, 1, '2016-12-03 06:56:59', '2016-12-15 06:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dheaney@example.org', '$2y$10$Lwe62L9Bk74TNXa2JTFi3OQ.JWM6DJGf59NcEBV/fIKHKJRo66ksy', NULL, '2016-12-15 06:52:48', '2016-12-15 06:52:48'),
(2, 'vsanford@example.com', '$2y$10$Eevtkww/yq66j6NViPqub.BG9YvYMGeLiJTbDD3S9nh2fgXFAm4YG', NULL, '2016-12-15 06:52:48', '2016-12-15 06:52:48'),
(3, 'nikolaus.leonie@example.net', '$2y$10$hvHT0U5zjxRdF4P5r4URG.BaOoxLsaXi3IybMGwvF5Nga19hHgzgi', NULL, '2016-12-15 06:52:48', '2016-12-15 06:52:48'),
(4, 'ebalistreri@example.org', '$2y$10$PHxI3KBsUAUtE5pRGdM/JebMeeUoIqTfzRox/QVVxXv3HL3SKIDzG', NULL, '2016-12-15 06:52:49', '2016-12-15 06:52:49'),
(5, 'elisabeth.bins@example.com', '$2y$10$DqLZRdUZRt4TuFIcMFZ7Iu/wJQlZmK.MCpBdPhj/a4pxyNe3r5M6K', 'nvaAEvZvZnA879lq25cGAeXsO7FFgQsRD7UsXqHWFfM9wYTfhF7D2OioBVDx', '2016-12-15 06:52:49', '2016-12-15 07:27:26'),
(6, 'katlyn78@example.org', '$2y$10$r7ucfJrWvQxGOTwcuTZCFOiHSyzsn8AX03itL7neYxOhd8aAwEdK6', NULL, '2016-12-15 06:52:49', '2016-12-15 06:52:49'),
(7, 'plarkin@example.com', '$2y$10$0rD8JZJYelH/JRj1bl/X1O/1OoVza.3LEs7T9YUkOV1LWpQ6y1XC2', NULL, '2016-12-15 06:52:49', '2016-12-15 06:52:49'),
(8, 'ruby02@example.org', '$2y$10$FYgN5rYPdKsUWb/RJBqWCevLJvEEBcR95QU8jQwHC/ZS0ZNRIS6GK', NULL, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(9, 'damian85@example.com', '$2y$10$K8TjPkPR75dJC2yG6xU4UOlKtjuK1T0modEGMkknF6RF61NA5ud0y', NULL, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(10, 'frida.grimes@example.com', '$2y$10$/vFbqrheyCnVgB5kDRLLMubQevr7RKU233dIRMWyn6dlM91kHrV1.', NULL, '2016-12-15 06:52:50', '2016-12-15 06:52:50'),
(11, 'zach.j.aries@gmail.com', '$2y$10$jN.Mc0Moj8cjxaPzs8ZdZe3/s4cT7UgkiGWEBHA0HlzrHwTurj/cK', '7cHnn0SyK7jRZnDdMOJzp81qXbZ1mFvGq8EA7avKcCYfsRtMVheby40I4yRh', '2016-12-15 06:53:33', '2016-12-15 07:16:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_firm_id_index` (`firm_id`),
  ADD KEY `admins_user_id_index` (`user_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_admin_id_index` (`admin_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_sin_unique` (`sin`),
  ADD KEY `employees_firm_id_index` (`firm_id`),
  ADD KEY `employees_user_id_index` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_employee_id_index` (`employee_id`);

--
-- Indexes for table `firms`
--
ALTER TABLE `firms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplies_firm_id_index` (`firm_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `firms`
--
ALTER TABLE `firms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
