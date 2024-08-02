-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jul 27, 2024 at 03:42 PM
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
-- Database: `savoy_cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `movie` varchar(255) NOT NULL,
  `cinema` varchar(255) NOT NULL,
  `show_time` time NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `seat` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `date`, `movie`, `cinema`, `show_time`, `name`, `email`, `contact`, `seat`, `total_amount`, `created_at`) VALUES
(1, '0000-00-00', 'Movie 2', 'Cinema 1', '10:00:00', 'john', 'john123@gmail.com', '0983456786', 'A1, B2', 2000.00, '2024-07-17 13:27:17'),
(2, '2024-07-19', 'Twisters', 'Cinema 3', '13:00:00', 'john', 'john123@gmail.com', '0983456786', 'B4, C4', 2000.00, '2024-07-17 15:11:54'),
(3, '2024-07-18', 'The Garfield Movie (3D)', 'Cinema 1', '13:00:00', 'john', 'john123@gmail.com', '0983456786', 'D3, D4', 2000.00, '2024-07-17 15:47:13'),
(4, '2024-07-19', 'Despicable Me 4 (3D)', 'Cinema 3', '19:00:00', 'john', 'john123@gmail.com', '0983456786', 'c5, c6, E7', 3000.00, '2024-07-19 08:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `cinemas`
--

CREATE TABLE `cinemas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cinemas`
--

INSERT INTO `cinemas` (`id`, `name`, `description`, `image_url`) VALUES
(1, 'Cinema Hall 1', 'Located on the first floor, Cinema Hall 1 offers a comfortable and immersive movie-watching experience with the latest sound and projection technologies.', 'images/cinema1.jpg'),
(2, 'Cinema Hall 2', 'Experience the latest blockbuster hits in Cinema Hall 2, which features plush seating and state-of-the-art visuals for an unforgettable experience.', 'images/cinema2.jpg'),
(3, 'Cinema Hall 3', 'Cinema Hall 3 offers a cozy atmosphere with premium seating options and advanced projection systems for an enhanced movie-watching experience.', 'images/cinema3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submission_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `submission_time`) VALUES
(1, 'john', 'john123@gmail.com', '0987867567', 'General Inquiry', 'awesome', '2024-07-17 12:28:44'),
(2, 'john', 'john123@gmail.com', '0987867567', 'Movie Distribution', 'best', '2024-07-17 12:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` enum('now_showing','coming_soon') NOT NULL,
  `trailer_url` varchar(255) DEFAULT NULL,
  `tickets_url` varchar(255) DEFAULT NULL,
  `cinema_hall` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `image`, `category`, `trailer_url`, `tickets_url`, `cinema_hall`) VALUES
(15, 'The Garfield Movie (3D)', 'images/movie1-small.jpg', 'now_showing', 'https://youtu.be/S3XjsSvwSuU', 'tickets.html', 'C1'),
(16, 'Despicable Me 4 (3D)', 'images/movie2-small.jpg', 'now_showing', 'https://youtu.be/LtNYaH61dXY', 'tickets.html', 'C2'),
(17, 'Longlegs', 'images/movie3-small.jpg', 'now_showing', 'https://youtu.be/FXOtkvx25gI', 'tickets.html', 'C3'),
(18, 'A Quiet Place: Day One', 'images/movie4-small.jpg', 'now_showing', 'https://youtu.be/gjx-iHGXk9Q', 'tickets.html', 'C1'),
(19, 'Twisters', 'images/movie5-small.jpg', 'now_showing', 'https://youtu.be/Jm27YjLnPHc', 'tickets.html', 'C2'),
(20, 'Deadpool & Wolverine', 'images/movie6-small.jpg', 'coming_soon', 'https://youtu.be/73_1biulkYk', NULL, ''),
(21, 'Joker: Folie à Deux', 'images/movie7-small.jpg', 'coming_soon', 'https://youtu.be/xy8aJw1vYHo', NULL, 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `id` int(11) NOT NULL,
  `cinema_id` int(11) DEFAULT NULL,
  `movie_title` varchar(255) DEFAULT NULL,
  `showtime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`id`, `cinema_id`, `movie_title`, `showtime`) VALUES
(1, 1, 'The Garfield Movie (3D)', '10:00:00'),
(2, 1, 'Despicable Me 4 (3D)', '13:00:00'),
(3, 2, 'Longlegs', '12:00:00'),
(4, 2, 'A Quiet Place: Day One', '15:00:00'),
(5, 3, 'Twisters', '14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `showtimes_ticket`
--

CREATE TABLE `showtimes_ticket` (
  `id` int(11) NOT NULL,
  `movie` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `cinema` varchar(255) NOT NULL,
  `show_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showtimes_ticket`
--

INSERT INTO `showtimes_ticket` (`id`, `movie`, `date`, `cinema`, `show_time`) VALUES
(1, 'The Garfield Movie (3D)', '2024-07-18', 'Cinema 1', '10:00:00'),
(2, 'The Garfield Movie (3D)', '2024-07-18', 'Cinema 1', '13:00:00'),
(3, 'The Garfield Movie (3D)', '2024-07-19', 'Cinema 2', '16:00:00'),
(4, 'Despicable Me 4 (3D)', '2024-07-18', 'Cinema 1', '10:00:00'),
(5, 'Despicable Me 4 (3D)', '2024-07-18', 'Cinema 2', '13:00:00'),
(6, 'Despicable Me 4 (3D)', '2024-07-19', 'Cinema 3', '16:00:00'),
(7, 'The Garfield Movie (3D)', '2024-07-18', 'Cinema 1', '10:00:00'),
(8, 'The Garfield Movie (3D)', '2024-07-18', 'Cinema 1', '13:00:00'),
(9, 'The Garfield Movie (3D)', '2024-07-19', 'Cinema 2', '16:00:00'),
(10, 'Despicable Me 4 (3D)', '2024-07-18', 'Cinema 1', '16:00:00'),
(11, 'Despicable Me 4 (3D)', '2024-07-18', 'Cinema 2', '13:00:00'),
(12, 'Despicable Me 4 (3D)', '2024-07-19', 'Cinema 3', '19:00:00'),
(13, 'Longlegs', '2024-07-19', 'Cinema 1', '10:00:00'),
(14, 'Longlegs', '2024-07-19', 'Cinema 1', '13:00:00'),
(15, 'Longlegs', '2024-07-19', 'Cinema 1', '16:00:00'),
(16, 'A Quiet Place: Day One', '2024-07-19', 'Cinema 2', '10:00:00'),
(17, 'A Quiet Place: Day One', '2024-07-19', 'Cinema 2', '13:00:00'),
(18, 'A Quiet Place: Day One', '2024-07-19', 'Cinema 2', '16:00:00'),
(19, 'Twisters', '2024-07-19', 'Cinema 3', '10:00:00'),
(20, 'Twisters', '2024-07-19', 'Cinema 3', '13:00:00'),
(21, 'Twisters', '2024-07-19', 'Cinema 3', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'adminpass', 'admin'),
(2, 'staff', 'staffpass', 'staff'),
(3, 'user', 'userpass', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cinemas`
--
ALTER TABLE `cinemas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cinema_id` (`cinema_id`);

--
-- Indexes for table `showtimes_ticket`
--
ALTER TABLE `showtimes_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cinemas`
--
ALTER TABLE `cinemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `showtimes_ticket`
--
ALTER TABLE `showtimes_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_ibfk_1` FOREIGN KEY (`cinema_id`) REFERENCES `cinemas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
