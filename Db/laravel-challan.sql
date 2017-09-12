-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2017 at 03:57 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-challan`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_items`
--

CREATE TABLE `delivery_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `delivery_note_id` int(11) UNSIGNED NOT NULL,
  `description` text,
  `hsn_code` varchar(50) DEFAULT NULL,
  `uom` varchar(50) DEFAULT NULL,
  `qty` int(11) UNSIGNED NOT NULL,
  `rate` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `c_percentage` varchar(50) DEFAULT NULL,
  `c_amount` varchar(50) DEFAULT NULL,
  `s_percentage` varchar(50) DEFAULT NULL,
  `s_amount` varchar(50) DEFAULT NULL,
  `i_percentage` varchar(50) DEFAULT NULL,
  `i_amount` varchar(50) DEFAULT NULL,
  `sub_total` varchar(50) DEFAULT NULL,
  `cgst_total` varchar(50) DEFAULT NULL,
  `sgst_total` varchar(50) DEFAULT NULL,
  `igst_total` varchar(50) DEFAULT NULL,
  `all_gst_total` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_items`
--

INSERT INTO `delivery_items` (`id`, `delivery_note_id`, `description`, `hsn_code`, `uom`, `qty`, `rate`, `total`, `c_percentage`, `c_amount`, `s_percentage`, `s_amount`, `i_percentage`, `i_amount`, `sub_total`, `cgst_total`, `sgst_total`, `igst_total`, `all_gst_total`) VALUES
(1, 1, 'Description 1', 'Testing', '23', 4, '5', '20.00', '', '0.00', '', '0.00', '', '0.00', '62.00', '0.00', '0.00', '0.00', '62.00'),
(2, 1, 'Description 2', 'Testing', '31', 7, '6', '42.00', '', '0.00', '', '0.00', '', '0.00', '62.00', '0.00', '0.00', '0.00', '62.00'),
(3, 2, 'Description 1', 'HSN', '24', 6, '7', '42.00', '', '0.00', '', '0.00', '', '0.00', '52.00', '0.00', '0.00', '0.00', '52.00'),
(4, 2, 'Description 2', 'HSN Code', '31', 2, '5', '10.00', '', '0.00', '', '0.00', '', '0.00', '52.00', '0.00', '0.00', '0.00', '52.00'),
(5, 3, 'Description 1', 'HSN code', '24', 6, '3', '18.00', '4', '0.72', '', '0.00', '', '0.00', '74.00', '0.72', '0.00', '0.00', '74.72'),
(6, 3, 'Description 2', 'HSN Code 2', '31', 8, '7', '56.00', '', '0.00', '', '0.00', '', '0.00', '74.00', '0.72', '0.00', '0.00', '74.72'),
(7, 4, 'Description 1', 'HSN Code', '31', 2, '3', '6.00', '', '0.00', '', '0.00', '', '0.00', '6.00', '0.00', '0.00', '0.00', '6.00'),
(8, 5, 'Description 1', 'HSN code', '23', 4, '4', '16.00', '', '0.00', '', '0.00', '', '0.00', '46.00', '0.00', '0.00', '0.00', '46.00'),
(9, 5, 'Description 2', 'HSN code', '31', 5, '6', '30.00', '', '0.00', '', '0.00', '', '0.00', '46.00', '0.00', '0.00', '0.00', '46.00'),
(10, 6, 'Description 1', '3', '23', 3, '4', '12.00', '', '0.00', '', '0.00', '', '0.00', '32.00', '0.00', '0.00', '0.00', '32.00'),
(11, 6, 'Description 2', '3', '24', 5, '4', '20.00', '', '0.00', '', '0.00', '', '0.00', '32.00', '0.00', '0.00', '0.00', '32.00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_notes`
--

CREATE TABLE `delivery_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `challan_date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `financial_year` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mat_will_come_back` enum('Returnable','Non Returnable','Delivery Note') COLLATE utf8_unicode_ci NOT NULL,
  `carrier_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vechile_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `challan_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `return_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendor_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `indentor_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `matl_belongs_to_bkn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insured` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery_notes`
--

INSERT INTO `delivery_notes` (`id`, `challan_date`, `financial_year`, `mat_will_come_back`, `carrier_name`, `place`, `vechile_number`, `challan_number`, `return_date`, `vendor_id`, `department_id`, `indentor_id`, `matl_belongs_to_bkn`, `insured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '16-08-2017', '2017-18', 'Non Returnable', 'Bank IT Department', 'Coimbatore', 'Tn 38 B 8976', '001', '', '21', '4', '10', 'Yes', 'No', '2017-08-16 06:40:33', '2017-08-16 06:40:33', NULL),
(2, '16-08-2017', '2017-18', 'Returnable', 'Bank', 'coimbatore', 'TN 38 BM 9877', '002', '2017-08-16', '23', '2', '3', 'Yes', 'No', '2017-08-16 06:44:47', '2017-08-16 06:44:47', NULL),
(3, '16-08-2017', '2017-18', 'Delivery Note', 'IT Department', 'Maniyakaran Palayam', 'TN 38 BM 9867', 'N-003', '', '24', NULL, NULL, '', '', '2017-08-16 06:54:00', '2017-08-16 06:54:00', NULL),
(4, '16-08-2017', '2017-18', 'Non Returnable', 'Bank', 'it department', 'TN 38 B 9987', '004', '', '23', '4', '10', 'Yes', 'No', '2017-08-16 07:03:06', '2017-08-16 07:03:06', NULL),
(5, '16-08-2017', '2017-18', 'Non Returnable', 'Bank', 'CBE', 'TN 38 B 9987', '005', '', '23', '4', '10', 'Yes', 'No', '2017-08-16 07:05:52', '2017-08-16 07:05:52', NULL),
(6, '16-08-2017', '2017-18', 'Returnable', 'Yahoo', 'Pappanaicken Palayam', 'TN 38 B 9987', '006', '2017-08-16', '24', '1', '10', 'Yes', 'No', '2017-08-16 07:11:37', '2017-08-16 07:11:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_types`
--

CREATE TABLE `delivery_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `delivery_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 'Developement', '2017-08-14 05:01:34', '2017-08-14 05:01:34'),
(2, 'IT Solution', '2017-08-14 05:02:15', '2017-08-14 05:02:15'),
(3, 'Department', '2017-08-14 05:03:14', '2017-08-14 05:03:37'),
(4, 'Engineering And Development', '2017-08-15 23:50:06', '2017-08-15 23:50:20'),
(9, 'moulding', '2017-08-16 03:14:13', '2017-08-16 03:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `indentors`
--

CREATE TABLE `indentors` (
  `id` int(10) UNSIGNED NOT NULL,
  `indentor_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `indentors`
--

INSERT INTO `indentors` (`id`, `indentor_name`, `created_at`, `updated_at`) VALUES
(1, 'Indentor', '2017-08-14 04:58:38', '2017-08-14 04:58:38'),
(2, 'Arun Kumars', '2017-08-14 05:00:43', '2017-08-14 05:00:58'),
(3, 'Arun Kumar', '2017-08-14 05:01:08', '2017-08-14 05:01:08'),
(4, 'abcbv', '2017-08-14 07:20:54', '2017-08-14 07:21:12'),
(10, 'ajay k', '2017-08-16 03:13:53', '2017-08-16 03:13:53');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_07_30_054117_create_department_table', 2),
(4, '2017_07_30_093543_create_uom_table', 3),
(5, '2017_07_30_094319_create_delivery_types_table', 3),
(6, '2017_08_01_073649_create_indentor_table', 4),
(8, '2017_08_03_084211_create_vendor_table', 5),
(9, '2017_08_03_095544_create_state_table', 5);

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
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `state_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`) VALUES
(1, 'Andaman and Nicobar Islands'),
(2, 'Andhra Pradesh'),
(3, 'Arunachal Pradesh'),
(4, 'Assam'),
(5, 'Bihar'),
(6, 'Chandigarh'),
(7, 'Chhattisgarh'),
(8, 'Dadra and Nagar Haveli'),
(9, 'Daman and Diu'),
(10, 'Delhi'),
(11, 'Goa'),
(12, 'Gujarat'),
(13, 'Haryana'),
(14, 'Himachal Pradesh'),
(15, 'Jammu and Kashmir'),
(16, 'Jharkhand'),
(17, 'Karnataka'),
(18, 'Kenmore'),
(19, 'Kerala'),
(20, 'Lakshadweep'),
(21, 'Madhya Pradesh'),
(22, 'Maharashtra'),
(23, 'Manipur'),
(24, 'Meghalaya'),
(25, 'Mizoram'),
(26, 'Nagaland'),
(27, 'Narora'),
(28, 'Natwar'),
(29, 'Odisha'),
(30, 'Paschim Medinipur'),
(31, 'Pondicherry'),
(32, 'Punjab'),
(33, 'Rajasthan'),
(34, 'Sikkim'),
(35, 'Tamil Nadu'),
(36, 'Telangana'),
(37, 'Tripura'),
(38, 'Uttar Pradesh'),
(39, 'Uttarakhand'),
(40, 'Vaishali'),
(41, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `id` int(10) UNSIGNED NOT NULL,
  `uom_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`id`, `uom_name`, `created_at`, `updated_at`) VALUES
(23, 'CM', '2017-08-14 06:16:01', '2017-08-14 06:16:01'),
(24, 'Inches', '2017-08-14 06:16:16', '2017-08-14 06:16:16'),
(25, 'Uom', '2017-08-14 06:16:27', '2017-08-14 06:16:59'),
(26, 'millimeters', '2017-08-16 00:10:06', '2017-08-16 00:10:12'),
(27, 'millimetrers', '2017-08-16 00:10:55', '2017-08-16 00:11:12'),
(28, 'milli', '2017-08-16 00:46:18', '2017-08-16 00:46:18'),
(31, 'grams', '2017-08-16 03:16:44', '2017-08-16 03:16:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Rangasamy', 'rangasamy@gmail.com', '$2y$10$1efEGRNsgfrh144yvCD90uG9ufOBrDQQmatVHBpI.zzVJVeHZXuzC', 'rbNbnDb1OPMHkRV0q7oX6rffBaKuQA7spwIiTZtaoyD8L34HsVX3NL8amW5L', '2017-08-14 04:54:55', '2017-08-14 04:54:55'),
(4, 'prithivirajan', 'prithvi.k@agnaindia.com', '$2y$10$bj1I31CvN9Ae9egb7Z66C.l1UlsdnX142ib3iOzvVvlDuZrTOANIa', 'zDbZyk34gQGqwj8b4lJoxYzFcxrayDmEtj7WqDOX5blXL8ryhkMHEh7ZJRDS', '2017-08-15 23:48:12', '2017-08-15 23:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_code` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_line_1` text COLLATE utf8_unicode_ci,
  `address_line_2` text COLLATE utf8_unicode_ci,
  `city` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_code` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gst_number` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_name`, `vendor_code`, `address_line_1`, `address_line_2`, `city`, `postal_code`, `state_id`, `state_code`, `gst_number`, `created_at`, `updated_at`) VALUES
(21, 'Agna application', NULL, '62,Saibaba colony, 2nd Street, Coimbatore', '', '', '641001', '1', '45', 'GST123456654878', '2017-08-14 05:58:36', '2017-08-14 06:11:44'),
(22, 'Praveen', 'Ven001', 'Bharthi nagar,coimbatore', 'Cbe Bus Stand', 'coimbatore', '641002', '35', '44', 'GST123456543534', '2017-08-14 06:13:02', '2017-08-14 06:15:39'),
(23, 'lakshmi metals', NULL, '22 test data', '', '', '641302', '11', '', '852632532322232', '2017-08-16 00:00:44', '2017-08-16 00:01:40'),
(24, 'kannan blue metals', NULL, '22 test data', '', '', '641302', '11', '', '889552225222222', '2017-08-16 00:07:54', '2017-08-16 00:07:54'),
(25, 'raman metals', NULL, '22 test data', '', '', '641302', '6', '', '123456789123456', '2017-08-16 00:08:58', '2017-08-16 00:08:58'),
(29, 'sri vinayaka', NULL, '22 test data', '', '', '', '', '', '895632222211222', '2017-08-16 03:14:46', '2017-08-16 03:14:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_items`
--
ALTER TABLE `delivery_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_notes`
--
ALTER TABLE `delivery_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_types`
--
ALTER TABLE `delivery_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indentors`
--
ALTER TABLE `indentors`
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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_items`
--
ALTER TABLE `delivery_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `delivery_notes`
--
ALTER TABLE `delivery_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `delivery_types`
--
ALTER TABLE `delivery_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `indentors`
--
ALTER TABLE `indentors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
