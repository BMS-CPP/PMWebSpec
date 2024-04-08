-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 08:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_based_spec_ci_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `approve_request`
--

CREATE TABLE `approve_request` (
  `app_id` int(11) NOT NULL,
  `spec_id` text NOT NULL,
  `approver_name` varchar(255) NOT NULL,
  `recipient` text NOT NULL,
  `message` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `request_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinical_data`
--

CREATE TABLE `clinical_data` (
  `spec_id` varchar(100) DEFAULT NULL,
  `version_id` int(11) DEFAULT NULL,
  `study` text DEFAULT NULL,
  `statistician` text DEFAULT NULL,
  `level0` text DEFAULT NULL,
  `level1` text DEFAULT NULL,
  `level2` text DEFAULT NULL,
  `format` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dataset_general`
--

CREATE TABLE `dataset_general` (
  `spec_id` varchar(100) DEFAULT NULL,
  `version_id` int(11) DEFAULT NULL,
  `dataset_number` int(11) DEFAULT NULL,
  `dataset_name` text DEFAULT NULL,
  `dataset_description` text DEFAULT NULL,
  `dataset_path` text DEFAULT NULL,
  `dataset_due_date` text DEFAULT NULL,
  `dataset_label` text DEFAULT NULL,
  `dataset_multiple_record` text DEFAULT NULL,
  `dataset_inclusion` text DEFAULT NULL,
  `dataset_sort` text DEFAULT NULL,
  `dataset_dev_path` text DEFAULT NULL,
  `dataset_qc_path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dataset_structure`
--

CREATE TABLE `dataset_structure` (
  `spec_id` varchar(100) DEFAULT NULL,
  `version_id` int(11) DEFAULT NULL,
  `var_name` text DEFAULT NULL,
  `var_label` text DEFAULT NULL,
  `var_units` text DEFAULT NULL,
  `var_type` text DEFAULT NULL,
  `var_rounding` text DEFAULT NULL,
  `var_missing_value` text DEFAULT NULL,
  `var_notes` text DEFAULT NULL,
  `var_source` text DEFAULT NULL,
  `required` int(11) DEFAULT NULL,
  `nameChange` int(11) DEFAULT NULL,
  `labelChange` int(11) DEFAULT NULL,
  `unitChange` int(11) DEFAULT NULL,
  `typeChange` int(11) DEFAULT NULL,
  `roundChange` int(11) DEFAULT NULL,
  `missValChange` int(11) DEFAULT NULL,
  `noteChange` int(11) DEFAULT NULL,
  `sourceChange` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dataset_structure`
--
-- --------------------------------------------------------

--
-- Table structure for table `derivations`
--

CREATE TABLE `derivations` (
  `spec_id` varchar(100) DEFAULT NULL,
  `version_id` int(11) DEFAULT NULL,
  `field` text DEFAULT NULL,
  `algorithm` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `derivations`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `spec_id` varchar(100) DEFAULT NULL,
  `confirmed` text DEFAULT NULL,
  `documents` blob NOT NULL,
  `name` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_transfer`
--

CREATE TABLE `file_transfer` (
  `file_id` int(11) NOT NULL,
  `spec_id` varchar(100) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `source_path` varchar(200) NOT NULL,
  `target_path` varchar(200) NOT NULL,
  `status` varchar(25) NOT NULL,
  `error_message` varchar(1000) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `transfer_date` datetime DEFAULT NULL,
  `transfer_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `file_transfer`
--
-- --------------------------------------------------------

--
-- Table structure for table `flag`
--

CREATE TABLE `flag` (
  `spec_id` varchar(100) DEFAULT NULL,
  `version_id` int(11) DEFAULT NULL,
  `flag_number` int(11) DEFAULT NULL,
  `flag_comment` text DEFAULT NULL,
  `flag_notes` text DEFAULT NULL,
  `required` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `flag`
--
-- --------------------------------------------------------

--
-- Table structure for table `formula`
--

CREATE TABLE `formula` (
  `sr_no` int(11) NOT NULL,
  `field` varchar(255) NOT NULL,
  `algorithm` text NOT NULL,
  `isactive` int(2) NOT NULL DEFAULT 1 COMMENT '1 for active \r\n0 for deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formula`
--

-- --------------------------------------------------------

--
-- Table structure for table `missing_outlier`
--

CREATE TABLE `missing_outlier` (
  `spec_id` varchar(100) DEFAULT NULL,
  `version_id` int(11) DEFAULT NULL,
  `outlier` text DEFAULT NULL,
  `missing` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `missing_outlier`
--
-- --------------------------------------------------------

--
-- Table structure for table `pkms_path`
--

CREATE TABLE `pkms_path` (
  `spec_id` varchar(100) DEFAULT NULL,
  `version_id` int(11) DEFAULT NULL,
  `libname` text DEFAULT NULL,
  `libpath` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pk_data`
--

CREATE TABLE `pk_data` (
  `spec_id` varchar(100) DEFAULT NULL,
  `version_id` int(11) DEFAULT NULL,
  `study` varchar(50) DEFAULT NULL,
  `study_type` varchar(50) DEFAULT NULL,
  `lock_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE `signature` (
  `spec_id` varchar(200) DEFAULT NULL,
  `image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spec_general`
--

CREATE TABLE `spec_general` (
  `spec_id` varchar(100) DEFAULT NULL,
  `version_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `project_name` text DEFAULT NULL,
  `modification_date` text DEFAULT NULL,
  `pk_scientist` text DEFAULT NULL,
  `pm_scientist` text DEFAULT NULL,
  `statistician` text DEFAULT NULL,
  `ds_programmer` text DEFAULT NULL,
  `changes_made` text DEFAULT NULL,
  `revised_by` text DEFAULT NULL,
  `islocked` int(2) NOT NULL DEFAULT 0 COMMENT '0 - Not Locked\r\n1 - Locked',
  `lockedby` varchar(255) NOT NULL,
  `spec_status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `study`
--

CREATE TABLE `study` (
  `spec_id` varchar(100) DEFAULT NULL,
  `version_id` int(11) DEFAULT NULL,
  `study` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `sample_size` text DEFAULT NULL,
  `sampling_schedule` text DEFAULT NULL,
  `protocol` text DEFAULT NULL,
  `protocol_date` text DEFAULT NULL,
  `protocol_version` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_spec`
--

CREATE TABLE `user_spec` (
  `user_id` char(8) DEFAULT NULL,
  `spec_id` varchar(100) NOT NULL,
  `created_by` text DEFAULT NULL,
  `compound` varchar(15) DEFAULT NULL,
  `indication` text DEFAULT NULL,
  `creation_date` text DEFAULT NULL,
  `approved` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `approved_by` varchar(100) NOT NULL,
  `removed` int(11) NOT NULL,
  `removed_by` text NOT NULL,
  `removed_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_spec`
--
--
-- Indexes for dumped tables
--

--
-- Indexes for table `approve_request`
--
ALTER TABLE `approve_request`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `clinical_data`
--
ALTER TABLE `clinical_data`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `dataset_general`
--
ALTER TABLE `dataset_general`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `dataset_structure`
--
ALTER TABLE `dataset_structure`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `derivations`
--
ALTER TABLE `derivations`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `file_transfer`
--
ALTER TABLE `file_transfer`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `flag`
--
ALTER TABLE `flag`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `formula`
--
ALTER TABLE `formula`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `missing_outlier`
--
ALTER TABLE `missing_outlier`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `pkms_path`
--
ALTER TABLE `pkms_path`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `pk_data`
--
ALTER TABLE `pk_data`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `signature`
--
ALTER TABLE `signature`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `spec_general`
--
ALTER TABLE `spec_general`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `study`
--
ALTER TABLE `study`
  ADD KEY `spec_id` (`spec_id`);

--
-- Indexes for table `user_spec`
--
ALTER TABLE `user_spec`
  ADD PRIMARY KEY (`spec_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approve_request`
--
ALTER TABLE `approve_request`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `file_transfer`
--
ALTER TABLE `file_transfer`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `formula`
--
ALTER TABLE `formula`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clinical_data`
--
ALTER TABLE `clinical_data`
  ADD CONSTRAINT `clinical_data_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `dataset_general`
--
ALTER TABLE `dataset_general`
  ADD CONSTRAINT `dataset_general_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `dataset_structure`
--
ALTER TABLE `dataset_structure`
  ADD CONSTRAINT `dataset_structure_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `derivations`
--
ALTER TABLE `derivations`
  ADD CONSTRAINT `derivations_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `flag`
--
ALTER TABLE `flag`
  ADD CONSTRAINT `flag_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `missing_outlier`
--
ALTER TABLE `missing_outlier`
  ADD CONSTRAINT `missing_outlier_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `pkms_path`
--
ALTER TABLE `pkms_path`
  ADD CONSTRAINT `pkms_path_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `pk_data`
--
ALTER TABLE `pk_data`
  ADD CONSTRAINT `pk_data_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `signature`
--
ALTER TABLE `signature`
  ADD CONSTRAINT `signature_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `spec_general`
--
ALTER TABLE `spec_general`
  ADD CONSTRAINT `spec_general_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);

--
-- Constraints for table `study`
--
ALTER TABLE `study`
  ADD CONSTRAINT `study_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `user_spec` (`spec_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
