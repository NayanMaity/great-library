-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 05:38 PM
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
-- Database: `great_library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_show` enum('0','1') NOT NULL DEFAULT '1',
  `create_author_data` varchar(255) DEFAULT NULL,
  `update_author_data` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_show`, `create_author_data`, `update_author_data`) VALUES
(1, 'Karel Appel', '1', '24-05-16 23:42:39', '24-05-17 00:27:47'),
(2, 'Thomas Erl', '1', '24-05-16 23:44:13', '24-05-17 00:30:35'),
(3, 'Brian W. Kernighan', '1', '24-05-17 19:40:59', '24-05-17 19:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_desc` varchar(255) NOT NULL,
  `book_img` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `book_show` enum('0','1') NOT NULL DEFAULT '1',
  `create_book_data` varchar(255) DEFAULT NULL,
  `update_book_data` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_title`, `book_desc`, `book_img`, `author_id`, `cate_id`, `book_show`, `create_book_data`, `update_book_data`) VALUES
(1, 'Karel Appel 1', '   Retrospective 1945-2005   ', 'book_1716385478_Art_5_art-1.jpg', 1, 1, '1', '24-05-17 19:36:08', '24-05-22 19:14:38'),
(2, 'Le langage C Norne ANSI 2e éd.', ' Very well known, classic introduction to the C Programming Language. Both a text for learning, a reference, and, to some, the definition of proper C language features and use. ', 'book_1716385605_Computer_5_com-1.jpg', 3, 3, '1', '24-05-17 19:42:07', '24-05-22 19:16:45'),
(3, 'Karel Appel 2', ' The complete sculptures, 1936-1990 ', 'book_1716385520_Art_5_art-2.jpg', 1, 1, '1', '24-05-17 19:43:39', '24-05-22 19:15:20'),
(4, 'Data and Computer Communications', ' With Operating Systems - Internals and Design Principles Ie with C Programming Language ', 'book_1716385619_Computer_5_com-2.jpg', 3, 3, '1', '24-05-17 19:45:42', '24-05-22 19:16:59'),
(5, 'Cloud Computing: Concepts, Technology And Architecture', ' Cloud Computing: Concepts, Technology and Architecture is the result of years of research and analysis of the commercial cloud computing industry, cloud computing vendor platforms and further innovation and contributions made by cloud computing industry ', 'book_1716385629_Computer_5_com-3.jpg', 2, 3, '1', '24-05-17 19:48:31', '24-05-22 19:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(255) NOT NULL,
  `cate_desc` varchar(255) NOT NULL,
  `cate_show` enum('0','1') NOT NULL DEFAULT '1',
  `create_cate_data` varchar(255) DEFAULT NULL,
  `update_cate_data` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `cate_name`, `cate_desc`, `cate_show`, `create_cate_data`, `update_cate_data`) VALUES
(1, 'Art', 'Art is art', '1', '24-05-16 14:54:19', '24-05-16 22:23:30'),
(2, 'Science', 'Science is science', '1', '24-05-16 14:55:26', '24-05-16 14:55:26'),
(3, 'Computer', 'Computer is computer', '1', '24-05-16 15:11:20', '24-05-16 15:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `issue_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `issue_status` enum('not return','return') NOT NULL DEFAULT 'not return',
  `issue_show` enum('0','1') NOT NULL DEFAULT '1',
  `issue_date` varchar(255) DEFAULT NULL,
  `return_date` varchar(255) DEFAULT NULL,
  `returned_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`issue_id`, `book_id`, `user_id`, `issue_status`, `issue_show`, `issue_date`, `return_date`, `returned_at`) VALUES
(1, 1, 11, 'not return', '1', '22/05/24', '01/06/24', NULL),
(2, 4, 12, 'return', '1', '22/05/24', '01/06/24', '23/05/24'),
(3, 5, 9, 'not return', '1', '22/05/24', '01/06/24', NULL),
(4, 4, 11, 'not return', '1', '24/05/24', '03/06/24', NULL),
(5, 5, 11, 'not return', '1', '24/05/24', '03/06/24', NULL),
(6, 2, 11, 'return', '1', '24/05/24', '03/06/24', '24/05/24'),
(7, 3, 11, 'return', '1', '24/05/24', '03/06/24', '24/05/24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_avatar` varchar(255) DEFAULT NULL,
  `user_role` enum('user','admin') NOT NULL DEFAULT 'user',
  `user_show` enum('0','1') NOT NULL DEFAULT '1',
  `token` int(11) DEFAULT NULL,
  `create_user_data` varchar(255) DEFAULT NULL,
  `update_user_data` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_avatar`, `user_role`, `user_show`, `token`, `create_user_data`, `update_user_data`) VALUES
(9, 'Nayan', 'nayanmaity369@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1715625967_Nayan_Maity_avatar_9.png', 'user', '1', NULL, '24-05-14 00:16:07', '24-05-16 17:25:33'),
(10, 'Admin', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1715678462_Admin_avatar_2.png', 'admin', '1', 0, '24-05-14 00:18:14', '24-05-14 14:51:02'),
(11, 'Demo Some', 'demo@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1715668389_Demo_avatar_12.png', 'user', '1', 0, '24-05-14 00:18:42', '24-05-14 13:02:44'),
(12, 'Rahul', 'rahul@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'user', '1', 0, '24-05-14 00:18:51', '24-05-14 00:18:51'),
(13, 'Robi', 'robi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1715700380_Robi_avatar_11.png', 'user', '1', 0, '24-05-14 20:56:20', '24-05-14 20:56:20'),
(15, 'Shyam', 'shyam@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1715710342_Shyam_avatar_1.png', 'user', '1', 0, '24-05-14 23:42:22', '24-05-14 23:42:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `book_author` (`author_id`),
  ADD KEY `book_category` (`cate_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`issue_id`),
  ADD KEY `issue_book` (`book_id`),
  ADD KEY `issue_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`),
  ADD CONSTRAINT `book_category` FOREIGN KEY (`cate_id`) REFERENCES `category` (`cate_id`);

--
-- Constraints for table `issue`
--
ALTER TABLE `issue`
  ADD CONSTRAINT `issue_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `issue_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
