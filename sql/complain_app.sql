-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 07:10 AM
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
-- Database: `complain_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-batest02@gmail.com|127.0.0.1', 'i:1;', 1754888732),
('laravel-cache-batest02@gmail.com|127.0.0.1:timer', 'i:1754888732;', 1754888732),
('laravel-cache-client@test.gmail.com|127.0.0.1', 'i:1;', 1754975765),
('laravel-cache-client@test.gmail.com|127.0.0.1:timer', 'i:1754975765;', 1754975765);

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Slow Delivery', '2025-08-05 11:21:26', '2025-08-05 11:21:26'),
(2, 'Technical Support', '2025-08-06 12:26:23', '2025-08-06 12:26:23'),
(3, 'Billing Issues', '2025-08-06 12:26:23', '2025-08-06 12:26:23'),
(4, 'Service Quality', '2025-08-06 12:26:23', '2025-08-06 12:26:23'),
(5, 'General Inquiry', '2025-08-06 12:26:23', '2025-08-06 12:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `client_complaints`
--

CREATE TABLE `client_complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `staff_id` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `complaint_title` varchar(255) DEFAULT NULL,
  `complaint_details` text NOT NULL,
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `status` enum('pending','in_progress','resolved','closed','rejected') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `solution` text DEFAULT NULL,
  `evidence_files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`evidence_files`)),
  `evidence_description` text DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `severity_score` int(11) DEFAULT NULL,
  `client_feedback` text DEFAULT NULL,
  `satisfaction_rating` int(11) DEFAULT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `contact_phone` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `follow_up_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `conversation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`conversation`)),
  `last_response_at` timestamp NULL DEFAULT NULL,
  `last_responder` enum('client','admin') DEFAULT NULL,
  `response_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_complaints`
--

INSERT INTO `client_complaints` (`id`, `client_name`, `client_email`, `nic`, `staff_id`, `category_id`, `complaint_title`, `complaint_details`, `priority`, `status`, `admin_notes`, `solution`, `evidence_files`, `evidence_description`, `assigned_to`, `assigned_at`, `resolved_at`, `closed_at`, `reference_number`, `severity_score`, `client_feedback`, `satisfaction_rating`, `is_anonymous`, `contact_phone`, `department`, `follow_up_notes`, `created_at`, `updated_at`, `conversation`, `last_response_at`, `last_responder`, `response_count`) VALUES
(1, 'Client', 'client@gmail.com', '200212548965', NULL, 1, 'Test 01 Title', 'Example test des', 'high', 'resolved', NULL, NULL, '[{\"original_name\":\"screencapture-127-0-0-1-8000-2025-08-04-17_00_47.png\",\"filename\":\"1754412858_6892373a204c6.png\",\"path\":\"complaints\\/evidence\\/1754412858_6892373a204c6.png\",\"size\":557596,\"mime_type\":\"image\\/png\"}]', 'exmaple evidane des', 1, '2025-08-11 03:44:35', NULL, NULL, 'CC-2025-000001', NULL, NULL, NULL, 0, '0778525115', NULL, NULL, '2025-08-05 11:24:18', '2025-08-12 00:57:15', '[{\"id\":1,\"message\":\"Hello, I submitted this complaint yesterday and wanted to check the status. This is regarding the poor service I received at your office.\",\"sender_type\":\"client\",\"sender_id\":null,\"sender_name\":\"Client\",\"created_at\":\"2025-08-10T06:27:15.998223Z\",\"timestamp\":\"2025-08-10T06:27:15.998860Z\"},{\"id\":2,\"message\":\"Thank you for contacting us. We have received your complaint and are currently reviewing the details. We will investigate this matter and get back to you within 24 hours with an update.\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"Admin Support\",\"created_at\":\"2025-08-11T06:27:15.998926Z\",\"timestamp\":\"2025-08-11T06:27:15.998976Z\",\"status_update\":\"in_progress\"},{\"id\":3,\"message\":\"Thank you for the update. I appreciate the quick response. Please let me know what actions will be taken to resolve this issue.\",\"sender_type\":\"client\",\"sender_id\":null,\"sender_name\":\"Client\",\"created_at\":\"2025-08-11T18:27:15.999032Z\",\"timestamp\":\"2025-08-11T18:27:15.999082Z\"},{\"id\":4,\"message\":\"We have completed our internal investigation. The issue has been identified and we have implemented corrective measures. We apologize for any inconvenience caused and have taken steps to prevent similar issues in the future.\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"Admin Support\",\"created_at\":\"2025-08-12T04:27:15.999126Z\",\"timestamp\":\"2025-08-12T04:27:15.999171Z\",\"status_update\":\"resolved\"}]', '2025-08-06 12:46:34', 'admin', 1),
(2, 'Client', 'client@gmail.com', '20035698746', NULL, 1, 'asdsad', 'asdsadasdsadsa', 'low', 'in_progress', 'gdf', 'same solution testing', '[{\"original_name\":\"2025_Fidenz Technologies \\u2013 Full Stack Assignment (1).pdf\",\"filename\":\"1754414312_68923ce8b9893.pdf\",\"path\":\"complaints\\/evidence\\/1754414312_68923ce8b9893.pdf\",\"size\":137660,\"mime_type\":\"application\\/pdf\"}]', 'sdasdsa', 1, '2025-08-11 23:10:32', NULL, NULL, 'CC-2025-000002', NULL, NULL, NULL, 0, '0778525115', NULL, NULL, '2025-08-05 11:48:32', '2025-08-11 23:10:32', '[{\"id\":1,\"message\":\"sadasdada\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-06T20:16:24.610074Z\",\"created_at\":\"2025-08-06 20:16:24\"},{\"id\":2,\"message\":\"sfdsfsdfsdf\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-06T20:16:42.636507Z\",\"created_at\":\"2025-08-06 20:16:42\"},{\"id\":3,\"message\":\"Okay\",\"sender_type\":\"client\",\"sender_id\":2,\"sender_name\":\"Client\",\"timestamp\":\"2025-08-06T20:57:00.458919Z\",\"created_at\":\"2025-08-06 20:57:00\"}]', NULL, NULL, 0),
(3, 'Client', 'client@gmail.com', '200212548965', NULL, 1, 'Test 01 Title', 'sadsadadasdsadasdsadasdasdasdasdasdsadasdasdasdsadasdsad', 'medium', 'in_progress', NULL, NULL, '[{\"original_name\":\"screencapture-127-0-0-1-8000-2025-08-04-17_00_47 (1).png\",\"filename\":\"1754416410_6892451a37a58.png\",\"path\":\"complaints\\/evidence\\/1754416410_6892451a37a58.png\",\"size\":557596,\"mime_type\":\"image\\/png\"}]', 'sadasd', NULL, '2025-08-11 23:08:27', NULL, NULL, 'CC-2025-000003', NULL, NULL, NULL, 0, '0778525115', NULL, NULL, '2025-08-05 12:23:31', '2025-08-11 23:08:27', NULL, NULL, NULL, 0),
(4, 'Client', 'client@gmail.com', '20035698746', NULL, 1, 'Test 02 Title', 'adas sadsa d sadasdsad sadasdsad asdsadasd sdasdsad', 'low', 'in_progress', NULL, NULL, '[{\"original_name\":\"Read-Me.docx\",\"filename\":\"1754416530_68924592882ad.docx\",\"path\":\"complaints\\/evidence\\/1754416530_68924592882ad.docx\",\"size\":7627,\"mime_type\":\"application\\/vnd.openxmlformats-officedocument.wordprocessingml.document\"}]', 'adsadasdasdasdasdasdasdasdsa', NULL, '2025-08-12 23:35:07', NULL, NULL, 'CC-2025-000004', NULL, NULL, NULL, 0, '123123123123', NULL, NULL, '2025-08-05 12:25:30', '2025-08-12 23:35:07', '[{\"id\":1,\"message\":\"sdsa\",\"sender_type\":\"client\",\"sender_id\":2,\"sender_name\":\"Client\",\"timestamp\":\"2025-08-07T19:16:22.764073Z\",\"created_at\":\"2025-08-07 19:16:22\"}]', NULL, NULL, 0),
(5, 'Test Client', 'test@example.com', '20035698746', NULL, 1, NULL, 'Second complaint from same NIC for testing multiple complaints feature', 'high', 'in_progress', NULL, NULL, NULL, NULL, 1, '2025-08-11 03:41:30', NULL, NULL, 'CC-2025-000005', NULL, NULL, NULL, 0, NULL, NULL, NULL, '2025-08-05 12:36:10', '2025-08-11 03:41:30', '[{\"id\":1,\"message\":\"fgfdgdgfd\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-06T20:16:57.712194Z\",\"created_at\":\"2025-08-06 20:16:57\"}]', NULL, NULL, 0),
(6, 'Test Client', 'client@test.com', '123456789V', NULL, 2, 'Website Login Issues', 'I am unable to log into my account. The website keeps showing an error message saying \"Invalid credentials\" even though I am sure my password is correct.', 'high', 'in_progress', 'sdasd', 'Thanks.I will do it', NULL, NULL, 1, '2025-08-11 04:31:17', NULL, NULL, 'COMP-2025-000001', NULL, NULL, NULL, 0, '+94771234567', NULL, NULL, '2025-08-06 12:26:24', '2025-08-11 05:45:36', '[{\"id\":\"6893974854d6b\",\"message\":\"Thank you for reporting this issue. We have received your complaint and are investigating the login problem. Our technical team will look into this within the next 24 hours.\",\"sender_type\":\"admin\",\"sender_name\":\"Admin User\",\"sender_id\":4,\"timestamp\":\"2025-08-06T17:56:24.347522Z\",\"created_at\":\"2025-08-06 17:56:24\"},{\"id\":\"6893974856e28\",\"message\":\"Thank you for the quick response. I tried clearing my browser cache as suggested, but the issue persists. Is there anything else I can try?\",\"sender_type\":\"client\",\"sender_name\":\"Test Client\",\"sender_id\":3,\"timestamp\":\"2025-08-06T17:56:24.355902Z\",\"created_at\":\"2025-08-06 17:56:24\"},{\"id\":\"6893974858d3e\",\"message\":\"We have identified the issue. There was a temporary problem with our authentication server. The issue has been resolved. Please try logging in again and let us know if you face any difficulties.\",\"sender_type\":\"admin\",\"sender_name\":\"Admin User\",\"sender_id\":4,\"timestamp\":\"2025-08-06T17:56:24.363860Z\",\"created_at\":\"2025-08-06 17:56:24\"},{\"id\":4,\"message\":\"your complain is closed.thank you for your response\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-06T20:20:56.318255Z\",\"created_at\":\"2025-08-06 20:20:56\"},{\"id\":5,\"message\":\"hfdfsdsfds\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-11T11:09:47.487936Z\",\"created_at\":\"2025-08-11 11:09:47\"},{\"id\":6,\"message\":\"tyyyu y gh vgvgvgvg gvgvgh gv gvgvgh vg gvvg\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-11T11:15:36.809374Z\",\"created_at\":\"2025-08-11 11:15:36\"}]', '2025-08-06 12:26:24', 'admin', 3),
(8, 'Another Client', 'anotherclient@test.com', '123456789V', NULL, 4, 'Poor Service Quality', 'The service provided was not up to the expected standards. Multiple issues occurred during the service period.', 'low', 'in_progress', 'sdasd', 'ghyujyjuj', NULL, NULL, 1, NULL, NULL, NULL, 'COMP-2025-000003', NULL, NULL, NULL, 0, '+94777654321', NULL, NULL, '2025-08-06 12:26:24', '2025-08-11 22:58:41', '[{\"id\":\"689397485f8d7\",\"message\":\"We have reviewed your complaint regarding service quality. We apologize for the inconvenience caused and have taken corrective measures to improve our service.\",\"sender_type\":\"admin\",\"sender_name\":\"Admin User\",\"sender_id\":4,\"timestamp\":\"2025-08-06T17:56:24.391395Z\",\"created_at\":\"2025-08-06 17:56:24\"},{\"id\":2,\"message\":\"sdsad sdsads sdsdsad sadsad\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-12T04:28:41.854929Z\",\"created_at\":\"2025-08-12 04:28:41\"}]', '2025-08-06 12:26:24', 'admin', 1),
(9, 'Client', 'client@gmail.com', '200121502978', NULL, 2, 'No consideration', 'Your compay do not consider much about low buget cleints..', 'high', 'in_progress', 'gdf', NULL, '[{\"original_name\":\"b_logo.png\",\"filename\":\"1754514019_6893c26384e66.png\",\"path\":\"complaints\\/evidence\\/1754514019_6893c26384e66.png\",\"size\":20363,\"mime_type\":\"image\\/png\"}]', 'your logo', 1, '2025-08-12 23:37:03', NULL, NULL, 'CC-2025-000008', NULL, NULL, NULL, 0, '0785421963', NULL, NULL, '2025-08-06 15:30:20', '2025-08-12 23:37:03', '[{\"id\":1,\"message\":\"i am very sorry for your convenience..I will make that issue faster,thank you\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-06T21:01:40.699871Z\",\"created_at\":\"2025-08-06 21:01:40\"},{\"id\":2,\"message\":\"Okay.Thank you\",\"sender_type\":\"client\",\"sender_id\":2,\"sender_name\":\"Client\",\"timestamp\":\"2025-08-06T21:02:32.171485Z\",\"created_at\":\"2025-08-06 21:02:32\"},{\"id\":3,\"message\":\"Thank you very Much\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-06T21:20:29.335549Z\",\"created_at\":\"2025-08-06 21:20:29\"},{\"id\":4,\"message\":\"sds\",\"sender_type\":\"client\",\"sender_id\":2,\"sender_name\":\"Client\",\"timestamp\":\"2025-08-07T19:16:15.614530Z\",\"created_at\":\"2025-08-07 19:16:15\"},{\"id\":5,\"message\":\"sdsad\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-12T05:17:00.464036Z\",\"created_at\":\"2025-08-12 05:17:00\"},{\"id\":6,\"message\":\"hj\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-12T05:18:17.392793Z\",\"created_at\":\"2025-08-12 05:18:17\"}]', NULL, NULL, 0),
(10, 'Client', 'client@gmail.com', '20035698746', NULL, 2, 'Test 02 Title', 'sdasadsadsad', 'high', 'in_progress', NULL, NULL, '[{\"original_name\":\"screencapture-127-0-0-1-8000-2025-08-04-17_00_47 (1).png\",\"filename\":\"1754594268_6894fbdc903db.png\",\"path\":\"complaints\\/evidence\\/1754594268_6894fbdc903db.png\",\"size\":557596,\"mime_type\":\"image\\/png\"}]', 'sadadasd', NULL, '2025-08-11 22:54:02', NULL, NULL, 'CC-2025-000009', NULL, NULL, NULL, 0, '123123123123', NULL, NULL, '2025-08-07 13:47:49', '2025-08-11 22:54:02', NULL, NULL, NULL, 0),
(11, 'Client', 'client@gmail.com', '200121562979', NULL, 2, 'asdsad', 'saxsaxds sadxasdsa sdasdsadsad multiple upload test', 'high', 'in_progress', 'dfsdf', NULL, '[{\"original_name\":\"b_logo.png\",\"filename\":\"1754595996_6895029c8ceb7.png\",\"path\":\"complaints\\/evidence\\/1754595996_6895029c8ceb7.png\",\"size\":20363,\"mime_type\":\"image\\/png\"},{\"original_name\":\"screencapture-127-0-0-1-8000-2025-08-04-17_00_47 (1).png\",\"filename\":\"1754595996_6895029c92bfc.png\",\"path\":\"complaints\\/evidence\\/1754595996_6895029c92bfc.png\",\"size\":557596,\"mime_type\":\"image\\/png\"},{\"original_name\":\"screencapture-127-0-0-1-8000-2025-08-04-17_00_47.png\",\"filename\":\"1754595996_6895029c952da.png\",\"path\":\"complaints\\/evidence\\/1754595996_6895029c952da.png\",\"size\":557596,\"mime_type\":\"image\\/png\"}]', 'asdsadsadasdsadasd', 1, '2025-08-11 10:56:52', NULL, NULL, 'CC-2025-000010', NULL, NULL, NULL, 0, '123123123123', NULL, NULL, '2025-08-07 14:16:36', '2025-08-12 00:01:23', '[{\"id\":1,\"message\":\"dfdsfsdf\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-12T05:31:23.876367Z\",\"created_at\":\"2025-08-12 05:31:23\"}]', NULL, NULL, 0),
(12, 'Test Client', 'client@test.com', '200121505698', NULL, 2, 'sad', 'juuisagg hhahs hsjahjdhsj jashjdh', 'high', 'pending', 'sdasd', NULL, '[{\"original_name\":\"Screenshot (68).png\",\"filename\":\"1754843824_6898cab0e2c85.png\",\"path\":\"complaints\\/evidence\\/1754843824_6898cab0e2c85.png\",\"size\":215612,\"mime_type\":\"image\\/png\"}]', 'sdasd sad asdas sadas sada asdas d sd sa sa d', 1, '2025-08-11 23:04:06', NULL, NULL, 'CC-2025-000011', NULL, NULL, NULL, 0, '0778545955', NULL, NULL, '2025-08-10 11:07:04', '2025-08-11 23:52:43', '[{\"id\":1,\"message\":\"please make it fast\",\"sender_type\":\"client\",\"sender_id\":3,\"sender_name\":\"Test Client\",\"timestamp\":\"2025-08-10T16:37:42.518294Z\",\"created_at\":\"2025-08-10 16:37:42\"},{\"id\":2,\"message\":\"ok.I will inqure it as soon as posiibel\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-10T16:38:34.640833Z\",\"created_at\":\"2025-08-10 16:38:34\"},{\"id\":3,\"message\":\"dsdfsfd\",\"sender_type\":\"client\",\"sender_id\":3,\"sender_name\":\"Test Client\",\"timestamp\":\"2025-08-11T09:38:39.769333Z\",\"created_at\":\"2025-08-11 09:38:39\"},{\"id\":4,\"message\":\"sadsad\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-11T09:48:24.473969Z\",\"created_at\":\"2025-08-11 09:48:24\"},{\"id\":5,\"message\":\"my\",\"sender_type\":\"client\",\"sender_id\":3,\"sender_name\":\"Test Client\",\"timestamp\":\"2025-08-12T05:17:31.980977Z\",\"created_at\":\"2025-08-12 05:17:31\"},{\"id\":6,\"message\":\"dasd\",\"sender_type\":\"admin\",\"sender_id\":1,\"sender_name\":\"admin\",\"timestamp\":\"2025-08-12T05:22:43.791998Z\",\"created_at\":\"2025-08-12 05:22:43\"}]', NULL, NULL, 0),
(13, 'Test Client', 'client@test.com', '200356987413', NULL, 3, 'Testing Admin mess', 'I need to make this function testing purpose', 'high', 'in_progress', 'dsad', NULL, '[{\"original_name\":\"Screenshot (67).png\",\"filename\":\"1754978844_689ada1c24582.png\",\"path\":\"complaints\\/evidence\\/1754978844_689ada1c24582.png\",\"size\":209789,\"mime_type\":\"image\\/png\"}]', 'No description', NULL, NULL, NULL, NULL, 'CC-2025-000012', NULL, NULL, NULL, 0, '0789636542', NULL, NULL, '2025-08-12 00:37:25', '2025-08-12 04:30:09', '[{\"id\":1,\"message\":\"Hellow can you give this more piority\",\"sender_type\":\"client\",\"sender_id\":3,\"sender_name\":\"Test Client\",\"timestamp\":\"2025-08-12T06:08:03.092931Z\",\"created_at\":\"2025-08-12 06:08:03\"},{\"message\":\"hhghgh\",\"sender_type\":\"admin\",\"created_at\":\"2025-08-12T09:59:44.272140Z\",\"status_update\":\"pending\"},{\"message\":\"sadasdsdsdsa\",\"sender_type\":\"admin\",\"created_at\":\"2025-08-12T10:00:09.920446Z\",\"status_update\":\"in_progress\"}]', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `complaint_assignments`
--

CREATE TABLE `complaint_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_complaint_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_to` bigint(20) UNSIGNED NOT NULL,
  `assigned_by` bigint(20) UNSIGNED NOT NULL,
  `status` enum('assigned','in_progress','pending_feedback','resolved','cancelled') NOT NULL DEFAULT 'assigned',
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `deadline` timestamp NULL DEFAULT NULL,
  `assignment_notes` text DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `resolution_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaint_assignments`
--

INSERT INTO `complaint_assignments` (`id`, `client_complaint_id`, `department_id`, `assigned_to`, `assigned_by`, `status`, `priority`, `deadline`, `assignment_notes`, `resolved_at`, `resolution_notes`, `created_at`, `updated_at`) VALUES
(1, 9, 9, 8, 1, 'cancelled', 'high', '2025-08-14 09:07:00', 'sadsad asdsad sad sad sd sa sad sad sa sad sdsa dsasa', NULL, NULL, '2025-08-11 03:38:15', '2025-08-12 04:58:58'),
(2, 5, 10, 11, 1, 'assigned', 'medium', '2025-08-13 09:11:00', 'test 01', NULL, NULL, '2025-08-11 03:41:30', '2025-08-11 03:41:30'),
(3, 1, 2, 11, 1, 'in_progress', 'high', '2025-08-27 02:17:00', 'test 02', NULL, NULL, '2025-08-11 03:44:35', '2025-08-11 10:57:35'),
(4, 1, 9, 8, 1, 'in_progress', 'high', '2025-08-27 02:17:00', 'test 02', NULL, NULL, '2025-08-11 03:44:35', '2025-08-11 04:22:30'),
(5, 1, 10, 11, 1, 'assigned', 'high', '2025-08-27 02:17:00', 'test 02', NULL, NULL, '2025-08-11 03:44:35', '2025-08-11 03:44:35'),
(6, 12, 10, 11, 1, 'assigned', 'urgent', '2025-08-28 01:54:00', 'Tetsing after test 02', NULL, NULL, '2025-08-11 04:21:14', '2025-08-11 04:21:14'),
(7, 3, 9, 8, 1, 'assigned', 'low', '2025-08-28 00:56:00', 'please find me', NULL, NULL, '2025-08-11 04:24:35', '2025-08-11 04:24:35'),
(8, 3, 10, 11, 1, 'assigned', 'low', '2025-08-28 00:56:00', 'please find me', NULL, NULL, '2025-08-11 04:24:35', '2025-08-11 04:24:35'),
(9, 6, 9, 8, 1, 'assigned', 'high', '2025-08-21 16:06:00', 'please test 03 QA', NULL, NULL, '2025-08-11 04:31:17', '2025-08-11 04:31:17'),
(10, 11, 10, 11, 1, 'assigned', 'high', '2025-08-21 15:31:00', 'jhjhjj jhjhj jhjhjhjhjhjhj', NULL, NULL, '2025-08-11 10:56:52', '2025-08-11 10:56:52'),
(11, 10, 9, 8, 1, 'assigned', 'medium', NULL, NULL, NULL, NULL, '2025-08-11 22:54:02', '2025-08-11 22:54:02'),
(12, 10, 10, 11, 1, 'assigned', 'medium', NULL, NULL, NULL, NULL, '2025-08-11 22:54:02', '2025-08-11 22:54:02'),
(13, 12, 12, 15, 1, 'assigned', 'medium', NULL, NULL, NULL, NULL, '2025-08-11 23:04:06', '2025-08-11 23:04:06'),
(14, 3, 12, 15, 1, 'assigned', 'high', '2025-08-29 04:38:00', 'Make mt it quick please', NULL, NULL, '2025-08-11 23:08:27', '2025-08-11 23:08:27'),
(15, 2, 9, 8, 1, 'pending_feedback', 'urgent', '2025-08-28 04:40:00', 'need to imaplemet this', NULL, NULL, '2025-08-11 23:10:32', '2025-08-12 00:40:41'),
(16, 2, 12, 15, 1, 'in_progress', 'urgent', '2025-08-28 04:40:00', 'need to imaplemet this', NULL, NULL, '2025-08-11 23:10:32', '2025-08-12 05:17:57'),
(17, 4, 9, 8, 1, 'assigned', 'high', '2025-08-27 05:11:00', 'sadsadsad', NULL, NULL, '2025-08-12 23:35:07', '2025-08-12 23:35:07'),
(18, 4, 10, 11, 1, 'assigned', 'high', '2025-08-27 05:11:00', 'sadsadsad', NULL, NULL, '2025-08-12 23:35:07', '2025-08-12 23:35:07'),
(19, 4, 12, 15, 1, 'assigned', 'high', '2025-08-27 05:11:00', 'sadsadsad', NULL, NULL, '2025-08-12 23:35:07', '2025-08-12 23:35:07'),
(20, 9, 9, 8, 1, 'in_progress', 'high', '2025-08-21 05:06:00', 'Please make it fast if not i will fire you', NULL, NULL, '2025-08-12 23:37:03', '2025-08-12 23:53:26'),
(21, 9, 10, 11, 1, 'assigned', 'high', '2025-08-21 05:06:00', 'Please make it fast if not i will fire you', NULL, NULL, '2025-08-12 23:37:03', '2025-08-12 23:37:03'),
(22, 9, 12, 15, 1, 'assigned', 'high', '2025-08-21 05:06:00', 'Please make it fast if not i will fire you', NULL, NULL, '2025-08-12 23:37:03', '2025-08-12 23:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_discussions`
--

CREATE TABLE `complaint_discussions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `complaint_assignment_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` enum('admin','department_head') NOT NULL,
  `message` text NOT NULL,
  `message_type` varchar(50) NOT NULL DEFAULT 'text',
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `is_confidential` tinyint(1) NOT NULL DEFAULT 0,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `read_at` timestamp NULL DEFAULT NULL,
  `is_important` tinyint(1) NOT NULL DEFAULT 0,
  `reply_to_message_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaint_discussions`
--

INSERT INTO `complaint_discussions` (`id`, `complaint_assignment_id`, `sender_id`, `sender_type`, `message`, `message_type`, `attachments`, `is_confidential`, `sent_at`, `read_at`, `is_important`, `reply_to_message_id`, `created_at`, `updated_at`) VALUES
(1, 9, 8, 'department_head', 'dasdsad', 'text', '[{\"original_name\":\"Screenshot (68).png\",\"stored_name\":\"1754907118_Screenshot (68).png\",\"path\":\"complaint_discussions\\/hnq9c0KqQD6f77hk3oNFU8Ca48oiIlJVzi2sYEHO.png\",\"size\":215612,\"mime_type\":\"image\\/png\"}]', 0, '2025-08-12 10:20:42', '2025-08-12 04:50:42', 0, NULL, '2025-08-11 04:41:58', '2025-08-12 04:50:42'),
(2, 1, 8, 'department_head', 'sd check this', 'text', '[{\"original_name\":\"Screenshot (68).png\",\"stored_name\":\"1754907340_Screenshot (68).png\",\"path\":\"complaint_discussions\\/eabqIsEO5j00YYt4LnWeft47GKwpZKFuRmExNL9j.png\",\"size\":215612,\"mime_type\":\"image\\/png\"}]', 0, '2025-08-13 05:07:10', '2025-08-12 23:37:10', 0, NULL, '2025-08-11 04:45:40', '2025-08-12 23:37:10'),
(3, 1, 8, 'department_head', 'check this pdf', 'text', '[{\"original_name\":\"2025_Fidenz Technologies \\u2013 Full Stack Assignment (1) (1).pdf\",\"stored_name\":\"1754907402_2025_Fidenz Technologies \\u2013 Full Stack Assignment (1) (1).pdf\",\"path\":\"complaint_discussions\\/raAdTAXY6NNt4VqKXnEhHLj1CXRRYQTzgNLgjs5N.pdf\",\"size\":137660,\"mime_type\":\"application\\/pdf\"}]', 0, '2025-08-13 05:07:10', '2025-08-12 23:37:10', 0, NULL, '2025-08-11 04:46:42', '2025-08-12 23:37:10'),
(4, 3, 11, 'department_head', 'zZ', 'text', '[]', 0, '2025-08-12 10:51:39', '2025-08-12 05:21:39', 0, NULL, '2025-08-11 22:55:53', '2025-08-12 05:21:39'),
(5, 15, 8, 'department_head', 'Check this screen shot and inqure the inspection after that', 'text', '[{\"original_name\":\"Screenshot (68) (3).png\",\"stored_name\":\"1754974098_Screenshot (68) (3).png\",\"path\":\"complaint_discussions\\/qqFUWeGEDgR2XGL0gs0KZRjmDmRcA6zj0cbhy7sa.png\",\"size\":215612,\"mime_type\":\"image\\/png\"}]', 0, '2025-08-12 10:51:53', '2025-08-12 05:21:53', 0, NULL, '2025-08-11 23:18:19', '2025-08-12 05:21:53'),
(6, 15, 8, 'department_head', 'hello test this', 'text', '[]', 0, '2025-08-12 10:51:53', '2025-08-12 05:21:53', 0, NULL, '2025-08-12 00:40:36', '2025-08-12 05:21:53'),
(7, 9, 1, 'admin', 'ok i will test it', 'text', NULL, 0, '2025-08-12 04:51:08', NULL, 0, NULL, '2025-08-12 04:51:08', '2025-08-12 04:51:08'),
(8, 9, 1, 'admin', 'Please check this again', 'image', '[{\"name\":\"Screenshot (70).png\",\"path\":\"complaint_discussions\\/mObKoxCvY3WLebUu4O4dghDlg1xsc5NIRW0QFSNn.png\",\"size\":29262,\"type\":\"image\",\"mime_type\":\"image\\/png\"}]', 0, '2025-08-12 04:51:30', NULL, 0, NULL, '2025-08-12 04:51:30', '2025-08-12 04:51:30'),
(9, 14, 15, 'department_head', 'Hellow I am form SE', 'text', '[{\"original_name\":\"QXFM37.png\",\"stored_name\":\"1754994786_QXFM37.png\",\"path\":\"complaint_discussions\\/YyFOSW0lJO6agL6l4tj0ioT8j0NHGMdwpoaytlQz.png\",\"size\":107027,\"mime_type\":\"image\\/png\"}]', 0, '2025-08-12 11:00:35', '2025-08-12 05:30:35', 0, NULL, '2025-08-12 05:03:06', '2025-08-12 05:30:35'),
(10, 3, 1, 'admin', 'sadsadsd', 'text', NULL, 0, '2025-08-12 05:21:47', NULL, 0, NULL, '2025-08-12 05:21:47', '2025-08-12 05:21:47'),
(11, 15, 1, 'admin', 'ok', 'text', NULL, 0, '2025-08-12 05:22:06', NULL, 0, NULL, '2025-08-12 05:22:06', '2025-08-12 05:22:06'),
(12, 1, 1, 'admin', 'ok I will consider it and say you the solution', 'text', NULL, 0, '2025-08-12 23:37:34', NULL, 0, NULL, '2025-08-12 23:37:34', '2025-08-12 23:37:34'),
(13, 20, 8, 'department_head', 'Ok give me one day please', 'text', '[]', 0, '2025-08-12 23:53:20', NULL, 0, NULL, '2025-08-12 23:53:20', '2025-08-12 23:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_messages`
--

CREATE TABLE `complaint_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `complaint_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` enum('client','admin') NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaint_messages`
--

INSERT INTO `complaint_messages` (`id`, `complaint_id`, `sender_type`, `sender_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 3, 'client', NULL, 'ok.I will try it', '2025-08-06 11:58:57', '2025-08-06 11:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `head_of_department` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `head_of_department`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Information Technology', 'Software development, system administration, and technical support', 7, 1, '2025-08-07 23:49:21', '2025-08-12 23:52:35'),
(2, 'Human Resources', 'Employee management, recruitment, and organizational development', 11, 1, '2025-08-07 23:49:21', '2025-08-11 01:22:15'),
(3, 'Finance & Accounting', 'Financial planning, accounting, and budget management', NULL, 1, '2025-08-07 23:49:21', '2025-08-07 23:49:21'),
(4, 'Marketing & Sales', 'Brand promotion, customer acquisition, and sales management', NULL, 1, '2025-08-07 23:49:21', '2025-08-07 23:49:21'),
(5, 'Operations', 'Daily operations, process management, and quality control', NULL, 1, '2025-08-07 23:49:21', '2025-08-07 23:49:21'),
(6, 'Design & Creative', 'Graphic design, UI/UX, and creative content development', NULL, 1, '2025-08-07 23:49:21', '2025-08-07 23:49:21'),
(7, 'Customer Support', 'Client assistance, complaint resolution, and customer satisfaction', NULL, 1, '2025-08-07 23:49:21', '2025-08-07 23:49:21'),
(9, 'QA', 'quality assuiring', 8, 1, '2025-08-08 00:57:42', '2025-08-11 01:22:15'),
(10, 'BA', 'bussiness Analysis', 11, 1, '2025-08-08 01:35:03', '2025-08-08 01:35:03'),
(11, 'Legal & Compliance', 'Legal affairs, regulatory compliance, and risk management', NULL, 1, '2025-08-11 01:55:44', '2025-08-11 01:55:44'),
(12, 'SE', 'softeware engineering', 15, 1, '2025-08-11 23:03:24', '2025-08-11 23:03:24');

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
(6, '0001_01_01_000000_create_users_table', 1),
(7, '0001_01_01_000001_create_cache_table', 1),
(8, '0001_01_01_000002_create_jobs_table', 1),
(9, '2025_08_05_083658_create_categories_table', 1),
(10, '2025_08_05_110747_create_client_complaints_table', 1),
(11, '2025_08_05_173915_remove_unique_constraint_from_nic_in_client_complaints', 2),
(12, '2025_08_05_174856_add_staff_id_to_client_complaints_table', 3),
(13, '2025_08_06_171516_create_complaint_messages_table', 4),
(14, '2025_08_06_174209_add_conversation_fields_to_client_complaints_table', 5),
(15, '2025_08_06_200100_add_conversation_to_client_complaints_table', 4),
(16, '2025_08_08_051740_create_staff_members_table', 6),
(17, '2025_08_08_051802_create_departments_table', 6),
(18, '2025_08_08_061305_modify_staff_members_table_add_department_id', 7),
(19, '2025_08_08_120203_create_staff_complaints_table', 8),
(20, '2025_08_08_122929_remove_category_id_from_staff_complaints_table', 9),
(23, '2025_08_10_170948_create_staff_complaint_conversations_table', 11),
(24, '2025_08_11_064106_create_complaint_assignments_table', 12),
(25, '2025_08_11_064115_create_complaint_discussions_table', 13),
(26, '2025_08_11_120002_create_complaint_assignments_table_v2', 14),
(27, '2025_08_11_120003_create_complaint_discussions_table_v2', 15),
(28, '2025_08_09_173339_add_department_responses_to_staff_complaints_table', 16),
(31, '2025_08_11_100934_fix_complaint_discussions_message_type', 17);

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
('10uF1b7vAPNDyVjdpRdYg1As8OPJ5JxV3Sjmszzf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidDNWb2tIRmJXcUFGRmpPa0VLdE91emhvOGRvNFQzcDhJSURCS1JBRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1755109878);

-- --------------------------------------------------------

--
-- Table structure for table `staff_complaints`
--

CREATE TABLE `staff_complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `staff_member_id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `staff_email` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `complaint_title` varchar(255) DEFAULT NULL,
  `complaint_details` text NOT NULL,
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `status` enum('pending','in_progress','resolved','closed','rejected') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `solution` text DEFAULT NULL,
  `evidence_files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`evidence_files`)),
  `evidence_description` text DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `severity_score` int(11) DEFAULT NULL,
  `staff_feedback` text DEFAULT NULL,
  `satisfaction_rating` int(11) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `follow_up_notes` text DEFAULT NULL,
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `review_notes` text DEFAULT NULL,
  `department_responses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`department_responses`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_complaints`
--

INSERT INTO `staff_complaints` (`id`, `user_id`, `staff_member_id`, `staff_id`, `staff_name`, `staff_email`, `department_id`, `category_id`, `complaint_title`, `complaint_details`, `priority`, `status`, `admin_notes`, `solution`, `evidence_files`, `evidence_description`, `assigned_to`, `assigned_at`, `resolved_at`, `closed_at`, `reference_number`, `severity_score`, `staff_feedback`, `satisfaction_rating`, `contact_phone`, `follow_up_notes`, `reviewed_by`, `reviewed_at`, `review_notes`, `department_responses`, `created_at`, `updated_at`) VALUES
(1, 9, 2, 'EM0012', 'staff check', 'cs@gmail.com', 9, 0, 'sad', 'asdsadsadsad sadsadsadsad sadsadsa', 'high', 'resolved', NULL, 'sdsadsa', '[{\"original_name\":\"Screenshot (68).png\",\"file_path\":\"staff_complaints_evidence\\/OvW52cv2KbcSjFVnHvv5dBjVQm4enTJfv19ULdSL.png\",\"file_size\":215612,\"mime_type\":\"image\\/png\"}]', 'sadsadsadsad sadsad', NULL, NULL, NULL, NULL, 'STAFF-9WOGTJ61-2025', NULL, 'sadsad', 5, '0785421963', NULL, 8, '2025-08-12 05:01:19', NULL, '[{\"id\":1,\"message\":\"sdsadsa\",\"responded_by\":8,\"responder_name\":\"QA Head\",\"status_set\":\"resolved\",\"created_at\":\"2025-08-12T10:31:19.897845Z\",\"formatted_date\":\"Aug 12, 2025 10:31 AM\"}]', '2025-08-08 06:53:00', '2025-08-13 00:57:29'),
(2, 9, 2, 'EM0012', 'staff check', 'cs@gmail.com', 9, 0, 'sadsadsad sadas', 'sadsadsad sadsad sadsad sadsa sadsa sadas sad sa', 'high', 'in_progress', NULL, 'sadsadsad', '[{\"original_name\":\"Screenshot (67).png\",\"file_path\":\"staff_complaints_evidence\\/C26AeTia6f8p5QJUw5U3z0s8uaNFNKC3H1tQoVnC.png\",\"file_size\":209789,\"mime_type\":\"image\\/png\"}]', 'sadsadasd sadasd sadasd', NULL, NULL, NULL, NULL, 'STAFF-ZBERQSOE-2025', NULL, NULL, NULL, '0778525115', NULL, 8, '2025-08-13 12:38:55', NULL, '[{\"id\":1,\"message\":\"sadsadsad\",\"responded_by\":8,\"responder_name\":\"QA Head\",\"status_set\":\"in_progress\",\"created_at\":\"2025-08-13T18:08:55.928451Z\",\"formatted_date\":\"Aug 13, 2025 06:08 PM\"}]', '2025-08-08 07:06:15', '2025-08-13 12:38:55'),
(3, 12, 4, 'BA0002', 'BA test user', 'batest@gmail.com', 10, 0, 'Test 02 Title', 'sadd sdsa sadsa  sdadsadhghs shdha', 'high', 'resolved', NULL, 'Test last reponse', '[{\"original_name\":\"Screenshot (67).png\",\"file_path\":\"staff_complaints_evidence\\/zzFY4JeNJWrJI1PtwjXHVevDGbytuE55aHJPAGQi.png\",\"file_size\":209789,\"mime_type\":\"image\\/png\"}]', 'sdsadsa sdsadasds', NULL, NULL, NULL, NULL, 'STAFF-SVXLAO8C-2025', NULL, 'need to be tell', 3, '0778525115', NULL, 11, '2025-08-10 23:34:13', NULL, NULL, '2025-08-08 10:13:17', '2025-08-10 23:34:13'),
(4, 2, 1, 'EM0001', 'Client', 'client@gmail.com', 9, 0, 'asdsad', 'vfgdfz  hjfvgdfgdf cfgdfg', 'high', 'pending', NULL, NULL, '[{\"original_name\":\"Screenshot (68).png\",\"file_path\":\"staff_complaints_evidence\\/Mmj3y5zA8qjhp0mFe9ERWv2xIc9fWd0ODGaB2E8Q.png\",\"file_size\":215612,\"mime_type\":\"image\\/png\"}]', 'dcfgdfgdfgdfg gfdgd', NULL, NULL, NULL, NULL, 'STAFF-8OWGDAQR-2025', NULL, NULL, NULL, '123123123123', NULL, NULL, NULL, NULL, NULL, '2025-08-10 11:04:40', '2025-08-10 11:04:40'),
(5, 10, 3, 'Em0064', 'Nimesh', 'qatest@gmail.com', 9, 0, 'No consideration', 'afhmn fgf fgfd fdgfdg fg dfg', 'urgent', 'closed', NULL, 'colsed', '[{\"original_name\":\"Screenshot (68).png\",\"file_path\":\"staff_complaints_evidence\\/F5ogT2XJMRSHPXpFAQuPbgh4MLOAtOBs9xK2tgCa.png\",\"file_size\":215612,\"mime_type\":\"image\\/png\"}]', 'Obcaecati itaque ten', NULL, NULL, NULL, NULL, 'STAFF-DYKGNYZI-2025', NULL, 'ffdfdfdsf', 4, '0778525115', NULL, 8, '2025-08-10 23:58:10', NULL, NULL, '2025-08-10 23:53:45', '2025-08-12 00:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `staff_complaint_conversations`
--

CREATE TABLE `staff_complaint_conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_complaint_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` enum('staff','department_head') NOT NULL,
  `message` text NOT NULL,
  `status_update` enum('pending','in_review','resolved','rejected') DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_members`
--

CREATE TABLE `staff_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `nic_number` varchar(255) NOT NULL,
  `staff_id_image_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_members`
--

INSERT INTO `staff_members` (`id`, `user_id`, `user_name`, `user_email`, `staff_id`, `department_id`, `department`, `date_of_birth`, `nic_number`, `staff_id_image_path`, `status`, `reviewed_by`, `reviewed_at`, `rejection_reason`, `created_at`, `updated_at`) VALUES
(1, 2, 'Client', 'client@gmail.com', 'EM0001', 9, 'Information Technology', '2001-08-02', '200121502979', 'staff_id_images/1754630770_2_68958a72b9305.png', 'approved', 8, '2025-08-08 01:18:36', NULL, '2025-08-07 23:56:10', '2025-08-08 01:18:36'),
(2, 9, 'staff check', 'cs@gmail.com', 'EM0012', 9, 'QA', '2009-08-06', '245612548963', 'staff_id_images/1754635820_9_68959e2c03385.jpg', 'approved', 8, '2025-08-08 01:21:16', NULL, '2025-08-08 01:20:20', '2025-08-08 01:21:16'),
(3, 10, 'Nimesh', 'qatest@gmail.com', 'Em0064', 9, 'QA', '2009-08-04', '200456987489', 'staff_id_images/1754636602_10_6895a13a7b8e7.png', 'approved', 8, '2025-08-08 01:33:51', NULL, '2025-08-08 01:33:22', '2025-08-08 01:33:51'),
(4, 12, 'BA test user', 'batest@gmail.com', 'BA0002', 10, 'BA', '2005-06-08', '200165458973', 'staff_id_images/1754636784_12_6895a1f0180fa.png', 'rejected', 11, '2025-08-08 03:42:12', 'ghgh', '2025-08-08 01:36:24', '2025-08-08 03:42:12'),
(5, 13, 'BA example 02', 'batest02@gmail.com', 'BA456987', 10, 'BA', '2008-12-30', '200156458795', 'staff_id_images/1754645041_13_6895c23121a58.png', 'rejected', 11, '2025-08-08 04:00:43', 'fix', '2025-08-08 03:54:01', '2025-08-08 04:00:43'),
(6, 16, 'New Staff', 'test01staff@gmail.com', '456456', 9, 'QA', '2009-06-23', '200365987412', 'staff_id_images/1755069386_16_689c3bca05b70.png', 'approved', 8, '2025-08-13 02:14:54', NULL, '2025-08-13 01:46:26', '2025-08-13 02:14:54');

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
  `role` enum('client','staff_member','department_head','senior_board','md') NOT NULL DEFAULT 'client',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$TDRdEk93AF2GiORvt2M/5uFlheu5XtPS3pQdHrxqnK8aiW0E70plS', 'md', NULL, '2025-08-05 11:18:23', '2025-08-05 11:18:23'),
(2, 'Client', 'client@gmail.com', NULL, '$2y$12$9GnyCaBwtZBIu2N7V2G7iOAa8B1TJMHLwm1tNzwGOOojmiDiNYtUy', 'client', NULL, '2025-08-05 11:19:27', '2025-08-11 02:05:36'),
(3, 'Test Client', 'client@test.com', NULL, '$2y$12$c8/raUfF1173KOsKr8kb1.Hsq64B9K8CGdJlM5lltXqGDk6ZePUFa', 'client', NULL, '2025-08-06 12:26:24', '2025-08-06 12:26:24'),
(4, 'Admin User', 'admin@test.com', NULL, '$2y$12$SHv1Ow9.VOCQwLkeQbOJyu9SwcdOiXeQniZKwx00jt9yBoN/1Z8AK', 'staff_member', NULL, '2025-08-06 12:26:24', '2025-08-06 12:26:24'),
(7, 'Depa head', 'dphead@gmail.com', NULL, '$2y$12$1cjBxm8aV4hT5HsJBqWmpOcozkPLErzDe.lYduwgr8f6Zw4JP6n.O', 'department_head', NULL, '2025-08-08 00:13:37', '2025-08-08 00:13:37'),
(8, 'QA Head', 'qahead@gmail.com', NULL, '$2y$12$vFuWACWGBiMDaoHYjJcYYe/7FDCckJkn9bVXYNS5WuwfF42/XuPeW', 'department_head', NULL, '2025-08-08 00:57:42', '2025-08-08 00:57:42'),
(9, 'staff check', 'cs@gmail.com', NULL, '$2y$12$asoMu8e4zBkopwSYLR2/9eP/P7IKgcqMACO56AUYgNUWDYZp2qB1y', 'staff_member', NULL, '2025-08-08 01:19:49', '2025-08-08 01:30:39'),
(10, 'Nimesh', 'qatest@gmail.com', NULL, '$2y$12$9K9SD6ZYNdQk17Zl5Vi5fOfx7cscGmVrGbDqS8LrN5Kdh1KBgF9Zm', 'staff_member', NULL, '2025-08-08 01:32:43', '2025-08-08 01:33:51'),
(11, 'BA Head', 'bahead@gmail.com', NULL, '$2y$12$vNjvjH4Cn6VWTJ7t8bTKcu6mW0FQAHMCva2RRQD3B5KH0482HPsOS', 'department_head', NULL, '2025-08-08 01:35:03', '2025-08-08 01:35:03'),
(12, 'BA test user', 'batest@gmail.com', NULL, '$2y$12$LqKlUikyo6n7kquixXDi6uQ6waIqdrDuMGOhsJYVIej2VcQrnBq06', 'staff_member', NULL, '2025-08-08 01:35:51', '2025-08-08 03:42:05'),
(13, 'BA example 02', 'batest02@gmail.com', NULL, '$2y$12$7z9zgwEchPm3vx7gIVeAJ.Oj7eszc2tIxjuHwhIr9.uGPQQGx0jCe', 'staff_member', NULL, '2025-08-08 03:53:32', '2025-08-08 04:00:32'),
(14, 'Nimesh', 'example@gmail.com', NULL, '$2y$12$NQs2WJqM4JLLJKyQx1R7cuT8gxoUYQKT8bwcz13w11Q20SXPji9u6', 'client', NULL, '2025-08-11 04:12:04', '2025-08-11 04:12:04'),
(15, 'Se Head', 'sehead@gmail.com', NULL, '$2y$12$v6V4ypSBE0fFuwxSnKePZeLni9TQ5J7rRwdlVTmeLAEEET1wR05Zi', 'department_head', NULL, '2025-08-11 23:03:24', '2025-08-11 23:03:24'),
(16, 'New Staff', 'test01staff@gmail.com', NULL, '$2y$12$Mx6t6ej/LVD/oq7yT8gSe.8qPiIvNeXYVKQEb9k7q6NglTWRtRrIa', 'staff_member', NULL, '2025-08-13 01:28:47', '2025-08-13 01:28:47'),
(17, 'Staff Check 02', 'test02staff@gmail.com', NULL, '$2y$12$9frOgJlGXw2YhIb1B4wKo.k3Vhyvvc6z6byFaGBHJ7utaGjckQlCi', 'staff_member', NULL, '2025-08-13 02:25:55', '2025-08-13 02:25:55'),
(18, 'Staff check 023', 'test03staff@gmail.com', NULL, '$2y$12$HRBpj.6M4YfDuOTiZVtwSuZ8.4i/8a6fX/U6Q69/.ML1jKDHITK.u', 'staff_member', NULL, '2025-08-13 02:33:43', '2025-08-13 02:33:43'),
(19, 'staff check status', 'test05staff@gmail.com', NULL, '$2y$12$KTTcUWLYzEgyeZoA2Nu9mO1giFzIBnl3TajdhH.GIuUEyDXCfviQ6', 'staff_member', NULL, '2025-08-13 02:38:58', '2025-08-13 02:38:58');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

--
-- Indexes for table `client_complaints`
--
ALTER TABLE `client_complaints`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_complaints_reference_number_unique` (`reference_number`),
  ADD KEY `client_complaints_status_created_at_index` (`status`,`created_at`),
  ADD KEY `client_complaints_category_id_status_index` (`category_id`,`status`),
  ADD KEY `client_complaints_assigned_to_status_index` (`assigned_to`,`status`),
  ADD KEY `client_complaints_nic_index` (`nic`);

--
-- Indexes for table `complaint_assignments`
--
ALTER TABLE `complaint_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_assignments_assigned_by_foreign` (`assigned_by`),
  ADD KEY `complaint_assignments_client_complaint_id_status_index` (`client_complaint_id`,`status`),
  ADD KEY `complaint_assignments_assigned_to_status_index` (`assigned_to`,`status`),
  ADD KEY `complaint_assignments_department_id_status_index` (`department_id`,`status`),
  ADD KEY `complaint_assignments_deadline_index` (`deadline`);

--
-- Indexes for table `complaint_discussions`
--
ALTER TABLE `complaint_discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_discussions_reply_to_message_id_foreign` (`reply_to_message_id`),
  ADD KEY `complaint_discussions_complaint_assignment_id_sent_at_index` (`complaint_assignment_id`,`sent_at`),
  ADD KEY `complaint_discussions_sender_id_sender_type_index` (`sender_id`,`sender_type`),
  ADD KEY `complaint_discussions_sent_at_index` (`sent_at`);

--
-- Indexes for table `complaint_messages`
--
ALTER TABLE `complaint_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_messages_sender_id_foreign` (`sender_id`),
  ADD KEY `complaint_messages_complaint_id_created_at_index` (`complaint_id`,`created_at`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`),
  ADD KEY `departments_head_of_department_foreign` (`head_of_department`),
  ADD KEY `departments_is_active_index` (`is_active`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staff_complaints`
--
ALTER TABLE `staff_complaints`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_complaints_reference_number_unique` (`reference_number`),
  ADD KEY `staff_complaints_user_id_foreign` (`user_id`),
  ADD KEY `staff_complaints_reviewed_by_foreign` (`reviewed_by`),
  ADD KEY `staff_complaints_status_created_at_index` (`status`,`created_at`),
  ADD KEY `staff_complaints_department_id_status_index` (`department_id`,`status`),
  ADD KEY `staff_complaints_staff_member_id_status_index` (`staff_member_id`,`status`),
  ADD KEY `staff_complaints_assigned_to_status_index` (`assigned_to`,`status`),
  ADD KEY `staff_complaints_staff_id_index` (`staff_id`);

--
-- Indexes for table `staff_complaint_conversations`
--
ALTER TABLE `staff_complaint_conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_complaint_conversations_sender_id_foreign` (`sender_id`),
  ADD KEY `scc_complaint_created_index` (`staff_complaint_id`,`created_at`);

--
-- Indexes for table `staff_members`
--
ALTER TABLE `staff_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_members_staff_id_unique` (`staff_id`),
  ADD KEY `staff_members_reviewed_by_foreign` (`reviewed_by`),
  ADD KEY `staff_members_status_created_at_index` (`status`,`created_at`),
  ADD KEY `staff_members_department_status_index` (`department`,`status`),
  ADD KEY `staff_members_user_id_index` (`user_id`),
  ADD KEY `staff_members_department_id_index` (`department_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client_complaints`
--
ALTER TABLE `client_complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `complaint_assignments`
--
ALTER TABLE `complaint_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `complaint_discussions`
--
ALTER TABLE `complaint_discussions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `complaint_messages`
--
ALTER TABLE `complaint_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `staff_complaints`
--
ALTER TABLE `staff_complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_complaint_conversations`
--
ALTER TABLE `staff_complaint_conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_members`
--
ALTER TABLE `staff_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_complaints`
--
ALTER TABLE `client_complaints`
  ADD CONSTRAINT `client_complaints_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `client_complaints_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `complaint_assignments`
--
ALTER TABLE `complaint_assignments`
  ADD CONSTRAINT `complaint_assignments_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complaint_assignments_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complaint_assignments_client_complaint_id_foreign` FOREIGN KEY (`client_complaint_id`) REFERENCES `client_complaints` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complaint_assignments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `complaint_discussions`
--
ALTER TABLE `complaint_discussions`
  ADD CONSTRAINT `complaint_discussions_complaint_assignment_id_foreign` FOREIGN KEY (`complaint_assignment_id`) REFERENCES `complaint_assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complaint_discussions_reply_to_message_id_foreign` FOREIGN KEY (`reply_to_message_id`) REFERENCES `complaint_discussions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `complaint_discussions_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `complaint_messages`
--
ALTER TABLE `complaint_messages`
  ADD CONSTRAINT `complaint_messages_complaint_id_foreign` FOREIGN KEY (`complaint_id`) REFERENCES `client_complaints` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `complaint_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_head_of_department_foreign` FOREIGN KEY (`head_of_department`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `staff_complaints`
--
ALTER TABLE `staff_complaints`
  ADD CONSTRAINT `staff_complaints_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `staff_complaints_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_complaints_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `staff_complaints_staff_member_id_foreign` FOREIGN KEY (`staff_member_id`) REFERENCES `staff_members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_complaints_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_complaint_conversations`
--
ALTER TABLE `staff_complaint_conversations`
  ADD CONSTRAINT `staff_complaint_conversations_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_complaint_conversations_staff_complaint_id_foreign` FOREIGN KEY (`staff_complaint_id`) REFERENCES `staff_complaints` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff_members`
--
ALTER TABLE `staff_members`
  ADD CONSTRAINT `staff_members_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `staff_members_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `staff_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
