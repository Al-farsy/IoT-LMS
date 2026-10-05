-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 05, 2026 at 02:48 PM
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
-- Database: `library_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `registration_number` varchar(30) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `registration_number`, `gender`, `email`, `phone`, `password`, `user_id`) VALUES
(22, 'ROSE TINABO', NULL, 'Female', 'tinabo13@gmail.com', '0612632807', 'tinabo1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(150) NOT NULL,
  `author` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ISBN` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `author`, `created_at`, `ISBN`, `quantity`) VALUES
(1, 'Database Systems', 'Ramez Elmasri', '2026-09-28 12:16:00', 'ISBN001', 0),
(2, 'Introduction to software design', 'Gabriel Cormen', '2026-09-28 12:16:00', 'ISBN45456', 6),
(3, 'Computer Networks', 'Andrew Tanenbaum', '2026-09-28 12:16:00', 'ISBN003', 6),
(4, 'Operating System Concepts', 'Abraham Silberschatz', '2026-09-28 12:16:00', 'ISBN004', 4),
(5, 'Software Engineering', 'Ian Sommerville', '2026-09-28 12:16:00', 'ISBN005', 6),
(6, 'Clean Code', 'Robert Martin', '2026-09-28 12:16:00', 'ISBN006', 3),
(7, 'C Programming Language', 'Brian Kernighan', '2026-09-28 12:16:00', 'ISBN007', 5),
(8, 'Web Development Basics', 'Jon Duckett', '2026-09-28 12:16:00', 'ISBN008', 6),
(9, 'JavaScript Guide', 'David Flanagan', '2026-09-28 12:16:00', 'ISBN009', 4),
(10, 'PHP and MySQL', 'Luke Welling', '2026-09-28 12:16:00', 'ISBN010', 5),
(11, 'Computer Architecture', 'William Stallings', '2026-09-28 12:16:00', 'ISBN011', 3),
(12, 'Data Structures', 'Mark Allen Weiss', '2026-09-28 12:16:00', 'ISBN012', 4),
(13, 'System Analysis and Design', 'Alan Dennis', '2026-09-28 12:16:00', 'ISBN013', 4),
(14, 'Information Security', 'Mark Stamp', '2026-09-28 12:16:00', 'ISBN014', 5),
(15, 'Artificial Intelligence', 'Stuart Russell', '2026-09-28 12:16:00', 'ISBN015', 3),
(16, 'Python Programming', 'Mark Lutz', '2026-09-28 12:16:00', 'ISBN016', 7),
(17, 'Cloud Computing', 'Thomas Erl', '2026-09-28 12:16:00', 'ISBN017', 4),
(18, 'Mobile Application Development', 'John Horton', '2026-09-28 12:16:00', 'ISBN018', 1),
(19, 'Information Systems', 'Kenneth Laudon', '2026-09-28 12:16:00', 'ISBN019', 6),
(20, 'Discrete Mathematics', 'Kenneth Rosen', '2026-09-28 12:16:00', 'ISBN020', 4);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borrow_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrow_id`, `book_id`, `student_id`, `admin_id`, `borrow_date`, `return_date`, `status`) VALUES
(31, 10, 23, NULL, '0000-00-00', NULL, 'rejected'),
(32, 1, 23, 22, '0000-00-00', NULL, 'approved'),
(33, 1, 24, NULL, '0000-00-00', NULL, 'rejected'),
(34, 4, 24, 22, '0000-00-00', NULL, 'approved'),
(35, 12, 24, 22, '0000-00-00', NULL, 'approved'),
(36, 19, 24, NULL, '0000-00-00', NULL, 'rejected'),
(37, 18, 24, 22, '0000-00-00', NULL, 'approved'),
(38, 5, 25, 22, '0000-00-00', NULL, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `registration_number` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `registration_number`, `gender`, `course`, `email`, `phone`, `password`, `user_id`) VALUES
(23, 'SALEH SALEH', 'IMC/BIT/2522312', 'Male', 'Bachelor of Science in Information Technology', 'salehesalehe2025@gmail.com', '0679446081', 'alfarsy03', 4),
(24, 'esther', 'IMC/BIT/2523975', 'Female', 'Bachelor of Science in Information Technology', 'esther@gmail.com', '0699323052', '323051', 6),
(25, 'Alphonce James', 'IMC/BAC/2524313', 'Male', 'BAC', 'james@gmail.com', '0674265213', '2000', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(4, 'salehesalehe2025@gmail.com', 'alfarsy03', 'student'),
(5, 'tinabo13@gmail.com', 'tinabo1', 'admin'),
(6, 'esther@gmail.com', '323051', 'student'),
(7, 'james@gmail.com', '2000', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `registration_number` (`registration_number`),
  ADD KEY `fk_admin_user` (`user_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `fk_borrow_book` (`book_id`),
  ADD KEY `fk_borrow_student` (`student_id`),
  ADD KEY `fk_borrow_admin` (`admin_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_number` (`registration_number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_student_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `fk_borrow_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_borrow_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_borrow_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
