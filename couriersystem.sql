-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 12:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `couriersystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('ADMIN', 29, NULL),
('Branch_agent', 31, NULL),
('Branch_agent', 52, NULL),
('Branch_manager', 30, NULL),
('Branch_manager', 49, NULL),
('Branch_manager', 50, NULL),
('Branch_manager', 51, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('ADMIN', 1, 'User can perform all actions', NULL, NULL, NULL, NULL),
('Branch_agent', 1, 'Create customer, item , manifest', NULL, NULL, NULL, NULL),
('Branch_manager', 1, 'create branch agent, customer, item , status , and manifest.', NULL, NULL, NULL, NULL),
('Create_branch', 1, 'create branch', NULL, NULL, NULL, NULL),
('Create_customer', 1, 'create customer', NULL, NULL, NULL, NULL),
('Create_item', 1, 'create_item', NULL, NULL, NULL, NULL),
('Create_log', 1, 'create log', NULL, NULL, NULL, NULL),
('Create_manifest', 1, 'create manifest', NULL, NULL, NULL, NULL),
('Create_status', 1, 'create status', NULL, NULL, NULL, NULL),
('Create_subscription', 1, 'create_subscription', NULL, NULL, NULL, NULL),
('Create_subscriptionTypes', 1, 'create subscription types', NULL, NULL, NULL, NULL),
('Create_user', 1, 'create_user', NULL, NULL, NULL, NULL),
('Delete status', 1, 'delete status', NULL, NULL, NULL, NULL),
('Delete_branch', 1, 'delete branch', NULL, NULL, NULL, NULL),
('Delete_customer', 1, 'delete customer', NULL, NULL, NULL, NULL),
('Delete_item', 1, 'delete item', NULL, NULL, NULL, NULL),
('Delete_log', 1, 'delete log', NULL, NULL, NULL, NULL),
('Delete_manifest', 1, 'delete manifest', NULL, NULL, NULL, NULL),
('Delete_subscription', 1, 'delete subscription', NULL, NULL, NULL, NULL),
('Delete_subscriptionTypes', 1, 'delete subscription types', NULL, NULL, NULL, NULL),
('Delete_user', 1, 'delete user', NULL, NULL, NULL, NULL),
('Update_branch', 1, 'update branch', NULL, NULL, NULL, NULL),
('Update_customer', 1, 'update customer', NULL, NULL, NULL, NULL),
('Update_item', 1, 'update item', NULL, NULL, NULL, NULL),
('Update_log', 1, 'update log', NULL, NULL, NULL, NULL),
('Update_manifest', 1, 'update manifest', NULL, NULL, NULL, NULL),
('Update_status', 1, 'update status', NULL, NULL, NULL, NULL),
('Update_subscription', 1, 'update subscription', NULL, NULL, NULL, NULL),
('Update_subscriptionTypes', 1, 'update subscription types', NULL, NULL, NULL, NULL),
('Update_user', 1, 'update user', NULL, NULL, NULL, NULL),
('View_branch', 1, 'view branch', NULL, NULL, NULL, NULL),
('View_customer', 1, 'view customer', NULL, NULL, NULL, NULL),
('View_item', 1, 'view item', NULL, NULL, NULL, NULL),
('View_log', 1, 'view log', NULL, NULL, NULL, NULL),
('View_manifest', 1, 'view manifest', NULL, NULL, NULL, NULL),
('View_status', 1, 'view status', NULL, NULL, NULL, NULL),
('View_subscription', 1, 'view subscription', NULL, NULL, NULL, NULL),
('View_subscriptionTypes', 1, 'view Subscription types', NULL, NULL, NULL, NULL),
('View_user', 1, 'view user', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('ADMIN', 'Create_branch'),
('ADMIN', 'Create_customer'),
('ADMIN', 'Create_item'),
('ADMIN', 'Create_manifest'),
('ADMIN', 'Create_status'),
('ADMIN', 'Create_subscription'),
('ADMIN', 'Create_subscriptionTypes'),
('ADMIN', 'Create_user'),
('ADMIN', 'Delete status'),
('ADMIN', 'Delete_branch'),
('ADMIN', 'Delete_customer'),
('ADMIN', 'Delete_item'),
('ADMIN', 'Delete_log'),
('ADMIN', 'Delete_manifest'),
('ADMIN', 'Delete_subscription'),
('ADMIN', 'Delete_subscriptionTypes'),
('ADMIN', 'Delete_user'),
('ADMIN', 'Update_branch'),
('ADMIN', 'Update_customer'),
('ADMIN', 'Update_item'),
('ADMIN', 'Update_manifest'),
('ADMIN', 'Update_status'),
('ADMIN', 'Update_subscription'),
('ADMIN', 'Update_subscriptionTypes'),
('ADMIN', 'Update_user'),
('ADMIN', 'View_branch'),
('ADMIN', 'View_customer'),
('ADMIN', 'View_item'),
('ADMIN', 'View_log'),
('ADMIN', 'View_manifest'),
('ADMIN', 'View_status'),
('ADMIN', 'View_subscription'),
('ADMIN', 'View_subscriptionTypes'),
('ADMIN', 'View_user'),
('Branch_agent', 'Create_item'),
('Branch_agent', 'Create_manifest'),
('Branch_agent', 'Delete_item'),
('Branch_agent', 'Delete_manifest'),
('Branch_agent', 'Update_item'),
('Branch_agent', 'Update_manifest'),
('Branch_agent', 'View_item'),
('Branch_agent', 'View_manifest'),
('Branch_manager', 'Create_customer'),
('Branch_manager', 'Create_item'),
('Branch_manager', 'Create_manifest'),
('Branch_manager', 'Create_user'),
('Branch_manager', 'Delete_customer'),
('Branch_manager', 'Delete_item'),
('Branch_manager', 'Delete_manifest'),
('Branch_manager', 'Delete_user'),
('Branch_manager', 'Update_customer'),
('Branch_manager', 'Update_item'),
('Branch_manager', 'Update_manifest'),
('Branch_manager', 'Update_user'),
('Branch_manager', 'View_customer'),
('Branch_manager', 'View_item'),
('Branch_manager', 'View_manifest'),
('Branch_manager', 'View_user');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(225) NOT NULL,
  `branch_name` varchar(60) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `created_by` varchar(60) NOT NULL,
  `updated_at` varchar(60) NOT NULL,
  `updated_by` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(10, 'Kigali', '1676008925', 'Simplice', '1676008925', 'Simplice'),
(11, 'Muhanga', '1676008952', 'Simplice', '1676008952', 'Simplice');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(225) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `subscription` varchar(10) NOT NULL,
  `idn` varchar(16) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `created_at` varchar(60) NOT NULL,
  `created_by` varchar(60) NOT NULL,
  `updated_at` varchar(60) NOT NULL,
  `updated_by` varchar(60) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `fullname`, `subscription`, `idn`, `telephone`, `created_at`, `created_by`, `updated_at`, `updated_by`, `item_id`) VALUES
(13, 'Robert KIYOSAKI', 'No', '1196180095883329', '07834527384', '1676012567', 'Simplice', '1676012567', 'Simplice', 5);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(225) NOT NULL,
  `item_name` varchar(60) NOT NULL,
  `value` int(11) NOT NULL,
  `sender_name` varchar(60) NOT NULL,
  `sender_phone` varchar(15) NOT NULL,
  `sender_subscription` varchar(10) NOT NULL,
  `receiver_name` varchar(60) NOT NULL,
  `receiver_phone` varchar(15) NOT NULL,
  `receiver_id` varchar(16) NOT NULL,
  `departure` varchar(60) NOT NULL,
  `depature_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `destination` varchar(60) NOT NULL,
  `created_at` varchar(60) NOT NULL,
  `created_by` varchar(60) NOT NULL,
  `updated_at` varchar(60) NOT NULL,
  `updated_by` varchar(60) NOT NULL,
  `manifest_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `value`, `sender_name`, `sender_phone`, `sender_subscription`, `receiver_name`, `receiver_phone`, `receiver_id`, `departure`, `depature_date`, `departure_time`, `destination`, `created_at`, `created_by`, `updated_at`, `updated_by`, `manifest_id`) VALUES
(5, 'Rich Dad, Poor Dad book', 20000, 'Robert KIYOSAKI', '0789443899', 'Monthly', 'Simplice', '0723438222', '1199998003456665', 'KIGALI', '2023-02-10', '12:30:00', 'MUHANGA', '1676012533', 'Simplice', '1676012533', 'Simplice', NULL),
(6, 'The Musical Human: a history of life on earth', 25000, 'Michael Spitzer', '0789443899', 'Monthly', 'Simplice', '0723438222', '1999800233448903', 'KIGALI', '2023-01-31', '13:15:00', 'MUHANGA', '1676631760', 'Simplice', '1676631760', 'Simplice', NULL),
(7, 'HP pavilion', 800000, 'Robert KIYOSAKI', '0789443899', 'Monthly', 'Eulade', '0723438222', '19998002334455', 'KIGALI', '2023-02-10', '12:30:00', 'MUHANGA', '1678763026', 'Simplice', '1678763026', 'Simplice', NULL),
(8, 'Introduction to Algorithms', 30000, 'Ronald Rivest', '0789443899', 'Monthly', 'Honore', '0723438222', '1199980014748347', 'KIGALI', '2023-03-17', '15:21:00', 'MUHANGA', '1679054622', 'Simplice', '1679054622', 'Simplice', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(225) NOT NULL,
  `done_by` varchar(60) NOT NULL,
  `comment` varchar(225) NOT NULL,
  `done_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `done_by`, `comment`, `done_at`) VALUES
(1, 'Simplice', 'New status created', 1679374991),
(2, 'Simplice', 'New status created', 1679374994),
(3, 'Simplice', 'New type of subscription is created', 1679375008),
(8, 'Simplice', 'Updated customer details ', 1679382209),
(9, 'Simplice', 'Updated customer details ', 1679382235);

-- --------------------------------------------------------

--
-- Table structure for table `manifest`
--

CREATE TABLE `manifest` (
  `manifest_id` int(225) NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `plate_number` varchar(15) NOT NULL,
  `driver` varchar(60) NOT NULL,
  `created_at` varchar(60) NOT NULL,
  `created_by` varchar(60) NOT NULL,
  `updated_at` varchar(60) NOT NULL,
  `updated_by` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manifest`
--

INSERT INTO `manifest` (`manifest_id`, `departure_date`, `departure_time`, `plate_number`, `driver`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '2023-02-20', '15:45:00', 'RAC 123 B', 'KALISA ', '1676977354', 'Simplice', '1676977354', 'Simplice'),
(2, '2023-02-20', '16:00:00', 'RAC 123 B', 'KALISA ', '1676977322', 'Simplice', '1676977322', 'Simplice');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1675705789),
('m140506_102106_rbac_init', 1676357427),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1676357428),
('m180523_151638_rbac_updates_indexes_without_prefix', 1676357429),
('m200409_110543_rbac_update_mssql_trigger', 1676357430);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(225) NOT NULL,
  `status_name` varchar(225) NOT NULL,
  `status_value` int(11) NOT NULL,
  `created_at` varchar(60) NOT NULL,
  `created_by` varchar(60) NOT NULL,
  `updated_at` varchar(60) NOT NULL,
  `updated_by` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`, `status_value`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Pending', 1, '1676012549', 'Simplice', '1676012549', 'Simplice'),
(2, 'Sent', 2, '1679374991', 'Simplice', '1679374991', 'Simplice'),
(3, 'Received', 3, '1679374994', 'Simplice', '1679374994', 'Simplice');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(225) NOT NULL,
  `customer` varchar(225) NOT NULL,
  `subscription_type` varchar(60) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` varchar(60) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` varchar(60) NOT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscription_id`, `customer`, `subscription_type`, `amount`, `created_at`, `created_by`, `updated_at`, `updated_by`, `customer_id`) VALUES
(6, 'Robert KIYOSAKI', 'Unlimited usage subscription', 0, 1676012545, 'Simplice', 1676012545, 'Simplice', 13);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_type`
--

CREATE TABLE `subscription_type` (
  `id` int(225) NOT NULL,
  `name` varchar(60) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` varchar(60) NOT NULL,
  `payment_way` varchar(60) NOT NULL,
  `created_by` varchar(60) NOT NULL,
  `updated_by` varchar(60) NOT NULL,
  `updated_at` varchar(60) NOT NULL,
  `subscription_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription_type`
--

INSERT INTO `subscription_type` (`id`, `name`, `amount`, `created_at`, `payment_way`, `created_by`, `updated_by`, `updated_at`, `subscription_id`) VALUES
(2, 'Volume based subscription', 0, '1676012552', 'cash', 'Simplice', 'Simplice', '1676012552', 6),
(3, 'Fixed usage Subscription', 20000, '1679375035', 'Cash', 'Simplice', 'Simplice', '1679375035', NULL),
(5, 'Unlimited usage subscription', 40000, '1679374999', 'Cash', 'Simplice', 'Simplice', '1679374999', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_fullname` varchar(224) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(40) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(225) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `branche_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_fullname`, `username`, `role`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `telephone`, `branche_id`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(29, 'NIYONZIMA Simplice', 'Simplice', 'ADMIN', '5nxBnw-i45H5bmG447FI761AGGXK-Gpw', '$2y$13$Q8jlImIG3uLDMXtilbtoJOzVvUXKuX1iflQQWNqZhD0ffjMVXkKpa', NULL, 'nsimplice0@gmail.com', '0723438222', 10, 10, 1676008924, 1676008924, 'OLhFX-503mtUsImhVK_tO0srhT2eBArZ'),
(30, 'MUPENZI Espoir', 'Espoir', 'MANAGER', '2psJA9dEjtPtoLiOuHTcHGEOc0fszJ9P', '$2y$13$vuGkGF6UWxzIlPCu4P9fn.RlvXXvQIqHIgw/gJ9Ra9cQolTGLTLMe', NULL, 'muespoir@gmail.com', '0782040963', 11, 10, 1676361767, 1676361767, 'q2wuStfwA_FUQKG6JAtJPKuIXvelVdTv'),
(31, 'MUNANIRA Elissa', 'Elissa', 'BRANCH AGENT', 'xFqfTC1W3GV2GFI4JSYbDtPW4teznVEb', '$2y$13$8VAT9e2vWZpUPofQFuthNeyHUy77NuPiN8f1t7W6ccuVKzoXRqv0S', NULL, 'elmunanira@gmail.com', '0791010234', 11, 10, 1676365363, 1676365363, 'TNdsdlpGuulQ5OMcCNFaCC_jxx9Zs4an'),
(48, 'HATEGIKIMANA Callixte', 'Callixte', 'Branch_agent', '2TUmFlqAGFj2bCDBlm2arBpSDx1MCS1X', '$2y$13$zWHkVKaU/0mgvQDtG/JXCebF0CqAZHiZbyoN8pIAjFfJSWPwvUhwi', NULL, 'callixte2@gmail.com', '0784657583', 10, 10, 1676797328, 1676797328, 'WaGmAFjglp-7KQh3aRCEJjhPaGQzgJs4'),
(50, 'NIYITANGA Aime de Dieu', 'Toptech', 'Branch_manager', 'hLBcVKJSocqMBDbFG7fkBzErlx4EVK5R', '$2y$13$EF5Rp7Bl1gAV5TQPz5E4pOYFrGLqVfXwUL7SbrTtLX/UiYXC42npi', NULL, 'niyitangaaime0@gmail.com', '0723438223', 10, 10, 1676797328, 1676797328, 'GqVdutmIBaMKFdwMc8otnvqUEdT91r5g'),
(52, 'KIMENYI Honore', 'Honore', 'Branch_agent', '_AngHvBkwiXgBUV9_NwLcyQcydvBvIBC', '$2y$13$CFOxaJnckZVfERFBq/PVPe2q4zuQcO.QrXxhJPdJcA3kftfiNHl1y', NULL, 'honore.kimenyi@gmail.com', '0784657583', 11, 10, 1679382235, 1679382235, 'e-mmQ2CmGlXVVvh1t7z9982sMyq4CQyA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `manifest_id` (`manifest_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `manifest`
--
ALTER TABLE `manifest`
  ADD PRIMARY KEY (`manifest_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `subscription_type`
--
ALTER TABLE `subscription_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_id` (`subscription_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `branche_id` (`branche_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `manifest`
--
ALTER TABLE `manifest`
  MODIFY `manifest_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscription_type`
--
ALTER TABLE `subscription_type`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`manifest_id`) REFERENCES `manifest` (`manifest_id`);

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `subscription_type`
--
ALTER TABLE `subscription_type`
  ADD CONSTRAINT `subscription_type_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`subscription_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`branche_id`) REFERENCES `branch` (`branch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
