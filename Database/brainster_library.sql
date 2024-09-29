-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 09:06 PM
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
-- Database: `brainster_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `short_bio` varchar(255) NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `first_name`, `last_name`, `short_bio`, `deleted_at`) VALUES
(1, 'J.K.', 'Rowling', 'British author, best known for the Harry Potter series.', '0000-00-00 00:00:00'),
(2, 'George', 'Orwell', 'English novelist, famous for \"1984\" and \"Animal Farm\".', '0000-00-00 00:00:00'),
(3, 'J.R.R.', 'Tolkien', 'English writer, known for \"The Lord of the Rings\".', '0000-00-00 00:00:00'),
(4, 'Jane', 'Austen', 'English novelist, known for \"Pride and Prejudice\".', '0000-00-00 00:00:00'),
(5, 'F. Scott', 'Fitzgerald', 'American novelist, best known for \"The Great Gatsby\".', '0000-00-00 00:00:00'),
(6, 'Harper', 'Lee', 'American novelist, famous for \"To Kill a Mockingbird\".', '0000-00-00 00:00:00'),
(7, 'Mark', 'Twain', 'American writer, known for \"The Adventures of Tom Sawyer\".', '0000-00-00 00:00:00'),
(8, 'Charles', 'Dickens', 'English writer, famous for \"A Tale of Two Cities\".', '0000-00-00 00:00:00'),
(9, 'Leo', 'Tolstoy', 'Russian author, known for \"War and Peace\".', '0000-00-00 00:00:00'),
(10, 'Herman', 'Melville', 'American novelist, famous for \"Moby-Dick\".', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` bigint(20) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_publish_year` varchar(255) NOT NULL,
  `book_pages` varchar(255) NOT NULL,
  `book_image` varchar(255) NOT NULL,
  `author_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `book_title`, `book_publish_year`, `book_pages`, `book_image`, `author_id`, `category_id`) VALUES
(1, 'Harry Potter and the Philosopher\'s Stone', '  1997  ', '223', 'https://m.media-amazon.com/images/I/818FB6bF4aL._SL1500_.jpg', 1, 1),
(2, '1984', '1949', '328', 'https://m.media-amazon.com/images/I/61ZewDE3beL._SL1200_.jpg', 2, 2),
(3, 'The Fellowship of the Ring', '1954', '423', 'https://m.media-amazon.com/images/I/A1Nv8Uz0fKL._SL1500_.jpg', 3, 1),
(4, 'Pride and Prejudice', '1813', '279', 'https://m.media-amazon.com/images/I/91AFXQGcPVL._SL1500_.jpg', 4, 4),
(5, 'The Great Gatsby', '1925', '180', 'https://m.media-amazon.com/images/I/61OTNorhqVS._AC_SL1024_.jpg', 5, 5),
(6, 'To Kill a Mockingbird', '1960', '281', 'https://m.media-amazon.com/images/I/71FxgtFKcQL._SL1500_.jpg', 6, 5),
(7, 'The Adventures of Tom Sawyer', '1876', '274', 'https://m.media-amazon.com/images/I/41fK2D8MUjL.jpg', 7, 3),
(8, 'A Tale of Two Cities', '1859', '489', 'https://m.media-amazon.com/images/I/91C0MECqJ+L._SL1500_.jpg', 8, 6),
(9, 'War and Peace', '1869', '1225', 'https://m.media-amazon.com/images/I/71wXZB-VtBL._SL1200_.jpg', 9, 10),
(10, 'Moby-Dick', '1851', '635', 'https://m.media-amazon.com/images/I/81LfTuC-66L._SL1500_.jpg', 10, 9),
(11, 'Harry Potter and the Prisoner of Azkaban', '1999', '317', 'https://m.media-amazon.com/images/I/714hT0XFZpL._SL1200_.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) NOT NULL,
  `category_type` varchar(255) NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_type`, `deleted_at`) VALUES
(1, 'Fantasy', '0000-00-00 00:00:00'),
(2, 'Dystopian', '0000-00-00 00:00:00'),
(3, 'Adventure', '0000-00-00 00:00:00'),
(4, 'Romance', '0000-00-00 00:00:00'),
(5, 'Classic', '0000-00-00 00:00:00'),
(6, 'Historical', '0000-00-00 00:00:00'),
(7, 'Literary Fiction', '0000-00-00 00:00:00'),
(8, 'Satire', '0000-00-00 00:00:00'),
(9, 'Psychological Fiction', '0000-00-00 00:00:00'),
(10, 'Epic', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `text` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `book_id` bigint(20) NOT NULL,
  `admin_verified` int(11) NOT NULL,
  `in_queue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text`, `user_id`, `book_id`, `admin_verified`, `in_queue`) VALUES
(1, 'A masterpiece of storytelling.', 2, 1, 1, 0),
(2, 'The dystopian world really made me think.', 3, 2, 0, 0),
(3, 'I couldn\'t put it down!', 4, 3, 1, 0),
(4, 'Beautifully written.', 5, 4, 1, 0),
(5, 'This book was life-changing for me.', 6, 5, 1, 0),
(6, 'An adventure from start to finish!', 7, 7, 1, 0),
(7, 'Too slow for my taste.', 8, 9, 0, 0),
(8, 'Couldn\'t relate to the characters.', 9, 10, 1, 0),
(9, 'Amazing world-building!', 10, 3, 0, 0),
(10, 'Felt a little outdated, but still a good read.', 2, 6, 0, 1),
(11, 'My favourite!!!!', 11, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `book_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `text`, `user_id`, `book_id`) VALUES
(1, 'Started Reading', 'Just started the book, really excited!', 2, 3),
(2, 'Chapter 1 Thoughts', 'The first chapter was intriguing, looking forward to more.', 3, 2),
(3, 'Halfway Through', 'I\'ve reached the middle, and it’s getting better.', 4, 5),
(4, 'Slow Start', 'The beginning is a bit slow, but I\'m still interested.', 1, 1),
(5, 'Page 75', 'I am on page 75, and the plot is thickening.', 2, 4),
(6, 'Interesting Concept', 'The book introduces some interesting ideas on page 100.', 3, 7),
(7, 'Excited for the Ending', 'I\'m close to the end, and it’s been a thrilling ride!', 4, 6),
(8, 'Great Book', 'One of the best!!!', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`id`, `username`, `email`, `password`, `user_type_id`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$o9EAu5dCVBAI3ZA8QHGtv.CewQtgfV3o9OVwEcR9VV..Epxmgjr9C', 1),
(2, 'janedoe', 'jane.doe@example.com', '$2y$10$AjQ7Vb71TPNiKhVUn0Hsu.i/Bg6nZjHsh7NS6/g5Id/AXvi7I5f/e', 2),
(3, 'johndoe', 'john.doe@example.com', '$2y$10$Uk587RTbRgZuTjBqxdB1UecpwttqribUnQsG73ROYuSQUh/rSaX0W', 2),
(4, 'alexsmith', 'alex.smith@example.com', '$2y$10$VzHHHA6hh.i6gK5VEJt7selrVVjflp0PjV2iLn9Fn5jmjKu4pfJlO', 2),
(5, 'emilydavis', 'emily.davis@example.com', '$2y$10$3Jfe8Q5jBzJguUHV0kvJTupKUuwHWR6QcgC7fSifHEH6uohf20VFS', 2),
(6, 'michaelbrown', 'michael.brown@example.com', '$2y$10$74kFZ1bYpN9oinfQMzL72OjoysQV5m2wKVPn2I0rX2VLWb0Cg7vlW', 2),
(7, 'sarahjohnson', 'sarah.johnson@example.com', '$2y$10$FhvzAtIv1KzSwvI.En0AouPva2UpgDOde84bH1MlSFlURYdEVbDem', 2),
(8, 'davidwilson', 'david.wilson@example.com', '$2y$10$HoRbwc8OZTEbPQ/Cq/d.zeWr.Qp1i3SeJ.Q0.PG.wahk/sZLOB6je', 2),
(9, 'sophiamartinez', 'sophia.martinez@example.com', '$2y$10$f3ehzDCssv7TdPcHF/w/0u4lGtX2QeFnlFyp6kdeNOSnhkMJktatS', 2),
(10, 'jamesanderson', 'james.anderson@example.com', '$2y$10$zfN5Pmhh5p9Bm.Uvzt9XVOUW6PqsKoy1u9JtTkEtVGrWqq0HS4UsG', 2),
(11, 'dusanhv', 'dusan@gmail.com', '$2y$10$/X2PpB9.fCz37FjkzYSPROVtGaSNLvVc7vVIS9zgdJGs2SAXPg2BG', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` bigint(20) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registered_users`
--
ALTER TABLE `registered_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
