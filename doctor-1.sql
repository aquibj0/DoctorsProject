-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 02:17 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor-1`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `addrLine_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addrLine_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addrCity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addrDistrict` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addrPincode` int(11) NOT NULL,
  `addrState` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addrCountry` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intuId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salutation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `alternatePhoneNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addressLine1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addressLine2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `intuId`, `firstName`, `lastName`, `phoneNo`, `degree`, `category`, `gender`, `salutation`, `department`, `dob`, `alternatePhoneNo`, `addressLine1`, `addressLine2`, `city`, `district`, `state`, `country`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'User', '9576477595', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aquib_j@yahoo.com', '$2y$10$A9rmxAAprlIXANXPlAiswOy856XdRdKNo58o2MFEd7XXczqQDAHp2', NULL, '2020-07-06 04:15:23', '2020-07-06 04:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `ask_a_question`
--

CREATE TABLE `ask_a_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_req_id` bigint(20) UNSIGNED NOT NULL,
  `aaqPatientBackground` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aaqQuestionText` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aaqDocResponse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aaqDocResponseUploaded` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ask_a_question`
--

INSERT INTO `ask_a_question` (`id`, `service_req_id`, `aaqPatientBackground`, `aaqQuestionText`, `aaqDocResponse`, `aaqDocResponseUploaded`, `created_at`, `updated_at`) VALUES
(22, 22, 'Hi, My name is ANik Mandal', 'I\'m over weight, How do I lose weight?', NULL, 'N', '2020-07-10 14:20:57', '2020-07-10 14:20:57'),
(23, 23, 'lorem psum', 'Lorem psum', NULL, 'N', '2020-07-10 14:25:06', '2020-07-10 14:25:06'),
(24, 24, 'Hello World', 'I need to know about this.', NULL, 'N', '2020-07-11 05:31:26', '2020-07-11 05:31:26'),
(25, 25, 'This is patient Background.', 'This is patient question', NULL, 'N', '2020-07-11 05:46:13', '2020-07-11 05:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clinicType` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinicName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinicMobileNo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinicLandLineNo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clinicAddressId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `drFirstName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drLastName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drEmail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drPhone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `drDegree` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drSalutation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drAlternateNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal_user`
--

CREATE TABLE `internal_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `intuId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intuUserCategory` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intuGender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intuSalutation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intuDegree` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intuDept` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intuDob` date NOT NULL,
  `intuAlternateNo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intuAddressId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `internal_user_role`
--

CREATE TABLE `internal_user_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inturRoleId` int(11) NOT NULL,
  `inturUserId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2020_06_24_155541_create_user_roles_table', 1),
(3, '2020_06_25_073441_create_services_table', 1),
(4, '2020_06_25_075339_create_users_table', 1),
(5, '2020_06_25_075605_create_patient_details_table', 1),
(6, '2020_07_02_142340_create_patient_documents_table', 1),
(7, '2020_06_30_102345_create_service_request_table', 2),
(8, '2020_06_30_103834_create_internal_user_table', 3),
(9, '2020_06_30_104327_create_internal_user_role_table', 3),
(10, '2020_06_30_105125_create_clinic_table', 4),
(11, '2020_06_30_105438_create_ask_a_question_table', 4),
(13, '2020_07_03_232416_create_payments_table', 5),
(14, '2020_07_04_094446_create_address_table', 6),
(15, '2020_07_04_104010_create_doctors_table', 6),
(16, '2020_07_05_204616_create_admins_table', 7),
(17, '2020_07_06_152743_create_contact_us_table', 8),
(19, '2020_07_08_093805_create_patient_documents_table', 9),
(20, '2020_07_08_121037_add_address_to_patient_table', 10),
(21, '2020_07_08_201249_create_jobs_table', 11),
(22, '2020_07_10_122440_add_signature_to_payments_table', 12),
(23, '2020_07_10_192029_add_payment_status_to_service_request_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `patFirstName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patLastName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patGender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patAge` int(11) NOT NULL,
  `patMobileCC` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patMobileNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patEmail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patAddrId` int(11) DEFAULT NULL,
  `patBackground` text COLLATE utf8mb4_unicode_ci,
  `patPhotoFileNameLink` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `patAddrLine1` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patAddrLine2` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patCity` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patDistrict` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patState` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patPincode` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patCountry` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `patId`, `user_id`, `patFirstName`, `patLastName`, `patGender`, `patAge`, `patMobileCC`, `patMobileNo`, `patEmail`, `patAddrId`, `patBackground`, `patPhotoFileNameLink`, `created_at`, `updated_at`, `patAddrLine1`, `patAddrLine2`, `patCity`, `patDistrict`, `patState`, `patPincode`, `patCountry`) VALUES
(15, 'UID5-15', 5, 'Anik', 'Mandal', 'Male', 25, '91', '7003192491', 'aquib_aj@yahoo.com', NULL, 'Hi, My name is ANik Mandal', NULL, '2020-07-10 14:20:57', '2020-07-10 14:20:57', 'Kalyani', '102/346', 'Kalyani', 'Malda', 'West Bengal', NULL, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `patient_documents`
--

CREATE TABLE `patient_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `documentType` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentDescription` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documentDate` date NOT NULL,
  `documentFileName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentUploadDate` date NOT NULL,
  `documentUploadedBy` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_request_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_documents`
--

INSERT INTO `patient_documents` (`id`, `documentType`, `documentDescription`, `documentDate`, `documentFileName`, `documentUploadDate`, `documentUploadedBy`, `service_request_id`, `created_at`, `updated_at`) VALUES
(6, 'Prescription', 'Prescription', '2020-07-01', 'documentFileName/wWd3VlKfVnjhFSaS6KegNGpEAgmprVCaoi9fXSSQ.png', '2020-07-11', '5', 25, '2020-07-11 05:49:18', '2020-07-11 05:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_req_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `service_req_id`, `user_id`, `payment_transaction_id`, `payment_amount`, `created_at`, `updated_at`, `order_id`, `signature`) VALUES
(7, 22, 5, 'pay_FCp8j52FTxjZmU', '500.00', '2020-07-10 14:21:23', '2020-07-10 14:21:23', 'order_FCp8WNDB6juuN1', '42ba1b9c4841c3780756e052a33a7e912bde637b243e11db9d696e0825e4cc90'),
(8, 25, 5, 'pay_FD4uVnmFGteZKh', '500.00', '2020-07-11 05:46:59', '2020-07-11 05:46:59', 'order_FD4trqOJy8rvAF', '0c207657daf177c5163a118a4dfb1d706f12b10ecdb700e88a185d5c04e8af50');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `srvcName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `srvcShortName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `srvcPrice` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `srvcName`, `srvcShortName`, `srvcPrice`, `created_at`, `updated_at`) VALUES
(1, 'Ask a question', 'AAQ', '500.00', NULL, NULL),
(2, 'Video Consultaion', 'VC', '700.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_request`
--

CREATE TABLE `service_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `srId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `srRecievedDateTime` datetime NOT NULL,
  `srDueDateTime` datetime NOT NULL,
  `srResponseDateTime` datetime DEFAULT NULL,
  `srDepartment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `srAssignedIntUserId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `srConfirmationSentByAdmin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `srMailSmsSent` datetime DEFAULT NULL,
  `srConfMailSent` datetime DEFAULT NULL,
  `srStatus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `srDocumentUploadedFlag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `srAppmntId` int(11) DEFAULT NULL,
  `srCancelFlag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paymentStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_request`
--

INSERT INTO `service_request` (`id`, `srId`, `service_id`, `patient_id`, `user_id`, `srRecievedDateTime`, `srDueDateTime`, `srResponseDateTime`, `srDepartment`, `srAssignedIntUserId`, `srConfirmationSentByAdmin`, `srMailSmsSent`, `srConfMailSent`, `srStatus`, `srDocumentUploadedFlag`, `srAppmntId`, `srCancelFlag`, `created_at`, `updated_at`, `paymentStatus`) VALUES
(22, 'SR22AAQ', 1, 15, 5, '2020-07-10 19:50:57', '2020-07-11 19:50:57', NULL, 'Value 1', NULL, 'N', '2020-07-10 19:50:57', NULL, 'NEW', 'N', NULL, NULL, '2020-07-10 14:20:57', '2020-07-10 14:21:23', 1),
(23, 'SR23AAQ', 1, 15, 5, '2020-07-10 19:55:06', '2020-07-11 19:55:06', NULL, 'value 2', NULL, 'N', '2020-07-10 19:55:06', NULL, 'NEW', 'N', NULL, NULL, '2020-07-10 14:25:06', '2020-07-10 14:25:06', NULL),
(24, 'SR24AAQ', 1, 15, 5, '2020-07-11 11:01:26', '2020-07-12 11:01:26', NULL, 'Value 1', NULL, 'N', '2020-07-11 11:01:26', NULL, 'NEW', 'N', NULL, NULL, '2020-07-11 05:31:26', '2020-07-11 05:31:26', NULL),
(25, 'SR25AAQ', 1, 15, 5, '2020-07-11 11:16:13', '2020-07-12 11:16:13', NULL, 'Value 1', NULL, 'N', '2020-07-11 11:16:13', NULL, 'NEW', 'N', NULL, NULL, '2020-07-11 05:46:13', '2020-07-11 05:46:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userType` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userFirstName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userLastName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userEmail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `userPassword` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userMobileNo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userStatus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userLandLineNo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userId`, `userType`, `userFirstName`, `userLastName`, `userEmail`, `email_verified_at`, `userPassword`, `userMobileNo`, `userStatus`, `userLandLineNo`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'UID5', 'E', 'Aquib', 'Jawed', 'aquib_j@yahoo.com', NULL, '$2y$10$4hp8BqkQChUtStr3ywAsx.ustFisPfOpjilV4b65exClXXMFky9JG', '9576477595', NULL, NULL, NULL, '2020-07-10 14:18:45', '2020-07-10 14:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_phoneno_unique` (`phoneNo`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `ask_a_question`
--
ALTER TABLE `ask_a_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ask_a_question_service_req_id_foreign` (`service_req_id`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_address_id_foreign` (`address_id`);

--
-- Indexes for table `internal_user`
--
ALTER TABLE `internal_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internal_user_role`
--
ALTER TABLE `internal_user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

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
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patient_patid_unique` (`patId`),
  ADD KEY `patient_user_id_foreign` (`user_id`);

--
-- Indexes for table `patient_documents`
--
ALTER TABLE `patient_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_documents_service_request_id_foreign` (`service_request_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_service_req_id_foreign` (`service_req_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_request`
--
ALTER TABLE `service_request`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_request_srid_unique` (`srId`),
  ADD KEY `service_request_service_id_foreign` (`service_id`),
  ADD KEY `service_request_patient_id_foreign` (`patient_id`),
  ADD KEY `service_request_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_useremail_unique` (`userEmail`),
  ADD UNIQUE KEY `users_usermobileno_unique` (`userMobileNo`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_roles_role_unique` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ask_a_question`
--
ALTER TABLE `ask_a_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internal_user`
--
ALTER TABLE `internal_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internal_user_role`
--
ALTER TABLE `internal_user_role`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patient_documents`
--
ALTER TABLE `patient_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_request`
--
ALTER TABLE `service_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ask_a_question`
--
ALTER TABLE `ask_a_question`
  ADD CONSTRAINT `ask_a_question_service_req_id_foreign` FOREIGN KEY (`service_req_id`) REFERENCES `service_request` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_documents`
--
ALTER TABLE `patient_documents`
  ADD CONSTRAINT `patient_documents_service_request_id_foreign` FOREIGN KEY (`service_request_id`) REFERENCES `service_request` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_service_req_id_foreign` FOREIGN KEY (`service_req_id`) REFERENCES `service_request` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_request`
--
ALTER TABLE `service_request`
  ADD CONSTRAINT `service_request_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_request_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_request_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
