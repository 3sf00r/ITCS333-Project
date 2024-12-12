-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 05:12 AM
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
-- Database: `booking_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_email` varchar(150) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` enum('booked','canceled') DEFAULT 'booked',
  `comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `user_email`, `room_id`, `start_time`, `end_time`, `status`, `comment`) VALUES
(56, 10, 'sff@uob.edu.bh', 1, '2025-01-01 01:00:00', '2025-01-01 02:40:00', 'booked', ''),
(57, 10, 'sff@uob.edu.bh', 5, '2025-01-01 01:00:00', '2025-01-01 01:50:00', 'canceled', ''),
(58, 10, 'sff@uob.edu.bh', 1, '2024-01-02 01:00:00', '2024-01-02 02:15:00', 'booked', ''),
(59, 3, 'ali@stu.uob.edu.bh', 5, '2026-01-01 01:00:00', '2026-01-01 02:15:00', 'booked', ''),
(60, 2, 'test@stu.uob.edu.bh', 1, '2027-01-01 01:00:00', '2027-01-01 02:40:00', 'booked', ''),
(61, 2, 'test@stu.uob.edu.bh', 1, '2027-01-01 01:00:00', '2027-01-01 02:40:00', 'booked', ''),
(62, 4, 'bs@uob.edu.bh', 1, '2025-01-01 04:03:00', '2025-01-01 05:18:00', 'booked', ''),
(63, 4, 'bs@uob.edu.bh', 1, '2025-01-01 04:03:00', '2025-01-01 05:18:00', 'booked', ''),
(64, 6, '123@stu.uob.edu.bh', 1, '2025-01-01 01:00:00', '2025-01-01 01:50:00', 'booked', ''),
(65, 6, '123@stu.uob.edu.bh', 1, '2025-01-01 01:00:00', '2025-01-01 01:50:00', 'booked', ''),
(66, 2, 'test@stu.uob.edu.bh', 2, '2028-01-07 01:00:00', '2028-01-07 02:40:00', 'booked', ''),
(67, 2, 'test@stu.uob.edu.bh', 2, '2028-01-07 01:00:00', '2028-01-07 02:40:00', 'booked', ''),
(68, 10, 'sff@uob.edu.bh', 1, '2023-01-01 01:00:00', '2023-01-01 02:40:00', 'booked', ''),
(69, 10, 'sff@uob.edu.bh', 1, '2023-01-01 01:00:00', '2023-01-01 02:40:00', 'canceled', ''),
(70, 3, 'ali@stu.uob.edu.bh', 1, '2025-01-01 13:00:00', '2025-01-01 14:40:00', 'canceled', ''),
(71, 3, 'ali@stu.uob.edu.bh', 1, '2020-01-01 01:00:00', '2020-01-01 02:40:00', 'canceled', ''),
(72, 2, 'test@stu.uob.edu.bh', 2, '2024-01-01 01:00:00', '2024-01-01 02:40:00', 'booked', ''),
(73, 10, 'sff@uob.edu.bh', 1, '2024-01-01 01:00:00', '2024-01-01 02:40:00', 'canceled', ''),
(74, 2, 'test@stu.uob.edu.bh', 1, '2024-03-01 01:00:00', '2024-03-01 02:15:00', 'booked', ''),
(75, 10, 'sff@uob.edu.bh', 1, '2025-01-12 08:47:00', '2025-01-12 10:02:00', 'canceled', ''),
(76, 2, 'test@stu.uob.edu.bh', 5, '2026-01-12 08:54:00', '2026-01-12 09:44:00', 'booked', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `room_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `admin_response` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `booking_id`, `user_id`, `user_email`, `room_id`, `comment`, `admin_response`, `created_at`) VALUES
(5, 60, 2, 'test@stu.uob.edu.bh', 1, 'dzssdff', NULL, '2024-12-11 22:25:33'),
(6, 67, 2, 'test@stu.uob.edu.bh', 2, 'bla bvla bla', NULL, '2024-12-11 22:27:35'),
(7, 60, 2, 'test@stu.uob.edu.bh', 1, 'zdfgdfg', NULL, '2024-12-11 22:29:38'),
(8, 75, 10, 'sff@uob.edu.bh', 1, 'bmn bn', NULL, '2024-12-12 03:47:40'),
(9, 57, 10, 'sff@uob.edu.bh', 5, 'dasdfasf', NULL, '2024-12-12 04:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'IS'),
(2, 'CS'),
(3, 'CE');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL,
  `equipment` text DEFAULT NULL,
  `type` enum('class','lab') DEFAULT 'class'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `department_id`, `name`, `capacity`, `equipment`, `type`) VALUES
(1, 1, '1011', 40, 'books', 'class'),
(2, 2, '1047', 30, 'books', 'class'),
(3, 3, '2087', 40, 'books', 'class'),
(5, 1, '1001', 25, 'pc and projector', 'lab');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `profile_picture`) VALUES
(2, 'test', 'test@stu.uob.edu.bh', '$2y$10$ONmW8E1E8BtnansL0Uis2ujMAdHCn9/wODYK8DgPtV7uR3X1Ph0ii', 'user', '../uploads/logo.png'),
(3, 'aaaaaaa', 'ali@stu.uob.edu.bh', '$2y$10$NOs7r.cxrC8N4Ocxk7HZ2.3YTqGQfYA34wvVHoiiul2vmJHRqXo5O', 'admin', '../uploads/logo.png'),
(4, 'binsaloom', 'bs@uob.edu.bh', '$2y$10$wRdNX6CGiND2bDtL7156ROFu67TVuB3abThtv3tJg/I6iFcCwq1UO', 'user', '../uploads/logo.png'),
(6, 'an', '123@stu.uob.edu.bh', '$2y$10$wkqmLTyqEWdQhyH63tcBWeMxw3qice2K/0TPUfoECbGGEdOSLnkCG', 'user', '../uploads/logo.png'),
(10, 'ronaldo', 'sff@uob.edu.bh', '$2y$10$aziHF9EAo6V5w0c7ak9GXOFQVFwE4xjJLW1hMkvvbIEt4/u8MCIuu', 'user', '../uploads/logo.png'),
(11, 'ttt', '1123@stu.uob.edu.bh', '$2y$10$I4YQNvAGG0g3yyfkCwqo7.BwvFIkJXg83.Pbb3HccntvV9rXCZbA6', 'user', '../uploads/logo.png'),
(12, 'name', '2222@stu.uob.edu.bh', '$2y$10$qKiaGLbayjpw1DhzCEUjKev0cnz7aa0y2AhaivMCOWLqnswmlUqBC', 'user', '../uploads/blackboard-paint.jpg'),
(14, 'sdfsad', '22212@stu.uob.edu.bh', '$2y$10$etvfT67gni.wltVIg1AnouBtTP535SEt9qqLynmB6wkLCOPWeZpwu', 'user', '../uploads/logo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_booking` (`booking_id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_room` (`room_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `department_id` (`department_id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_booking` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `fk_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
