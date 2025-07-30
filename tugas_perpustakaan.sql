-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20250718.d42db65a1e
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2025 at 06:48 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci,
  `draft` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `content`, `draft`, `created_at`, `updated_at`) VALUES
(1, 'Welcome to CodeIgniter 4', 'welcome-to-codeigniter-4', 'CodeIgniter 4 is a PHP framework that helps you build web applications faster with clean, simple syntax.', 0, '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(2, 'Learning CRUD Operations', 'learning-crud-operations', 'CRUD stands for Create, Read, Update, and Delete, which are the basic operations for managing data in applications.', 0, '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(3, 'Form Validation in CodeIgniter', 'form-validation-in-codeigniter', 'Form validation is important to ensure data integrity and security in web applications.', 1, '2025-07-25 02:18:47', '2025-07-25 02:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `isbn` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `year_published` int NOT NULL,
  `pages` int NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `stock` int NOT NULL DEFAULT '1',
  `cover_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `digital_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('available','borrowed','maintenance') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'available',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `publisher`, `year_published`, `pages`, `category`, `description`, `stock`, `cover_image`, `digital_file`, `status`, `created_at`, `updated_at`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', '978-0-7432-7356-5', 'Scribner', 1925, 180, 'Classic Literature', 'A classic American novel set in the Jazz Age about the mysterious millionaire Jay Gatsby and his obsession with the beautiful Daisy Buchanan.', 5, NULL, NULL, 'available', '2025-07-25 02:18:47', '2025-07-25 02:41:04'),
(2, 'To Kill a Mockingbird', 'Harper Lee', '978-0-06-112008-4', 'J.B. Lippincott & Co.', 1960, 376, 'Classic Literature', 'A powerful story of racial injustice and childhood innocence in the American South.', 3, NULL, NULL, 'available', '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(3, 'Introduction to Algorithms', 'Thomas H. Cormen', '978-0-262-03384-8', 'MIT Press', 2009, 1292, 'Computer Science', 'Comprehensive introduction to algorithms and data structures, widely used in computer science education.', 7, NULL, NULL, 'available', '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(4, 'Clean Code', 'Robert C. Martin', '978-0-13-235088-4', 'Prentice Hall', 2008, 464, 'Software Engineering', 'A handbook of agile software craftsmanship that teaches how to write clean, maintainable code.', 4, NULL, NULL, 'available', '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(5, 'The Design of Everyday Things', 'Don Norman', '978-0-465-05065-9', 'Basic Books', 2013, 368, 'Design', 'A powerful primer on how design serves as the communication between object and user.', 2, NULL, NULL, 'borrowed', '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(6, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', '978-0-06-231609-7', 'Harper', 2015, 443, 'History', 'A narrative of humanity\'s creation and evolution, exploring how we organized ourselves in cities, states, and kingdoms.', 6, NULL, NULL, 'available', '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(7, 'The Pragmatic Programmer', 'David Thomas', '978-0-201-61622-4', 'Addison-Wesley', 1999, 352, 'Software Engineering', 'A practical guide to software development that examines the core process of writing maintainable code.', 3, NULL, NULL, 'available', '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(8, 'Atomic Habits', 'James Clear', '978-0-7352-1129-2', 'Avery', 2018, 320, 'Self-Help', 'A comprehensive guide to breaking bad habits and building good ones through small changes.', 4, NULL, NULL, 'available', '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(9, 'Thinking, Fast and Slow', 'Daniel Kahneman', '978-0-374-27563-1', 'Farrar, Straus and Giroux', 2011, 499, 'Psychology', 'A groundbreaking exploration of the two systems that drive the way we think and make decisions.', 5, NULL, NULL, 'available', '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(10, 'The Power of Now', 'Eckhart Tolle', '978-1-57731-152-2', 'New World Library', 1997, 236, 'Spirituality', 'A guide to spiritual enlightenment through living in the present moment.', 1, NULL, NULL, 'maintenance', '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(11, 'JavaScript: The Good Parts', 'Douglas Crockford', '978-0-596-51774-8', 'O\'Reilly Media', 2008, 176, 'Programming', 'A concise guide to JavaScript that focuses on the language\'s most useful features.', 8, NULL, NULL, 'available', '2025-07-25 02:18:47', '2025-07-25 02:18:47'),
(12, 'Eloquent JavaScript', 'Marijn Haverbeke', '978-1-59327-584-6', 'No Starch Press', 2014, 472, 'Programming', 'A modern introduction to programming using JavaScript, covering both the language and web development.', 6, NULL, NULL, 'available', '2025-07-25 02:18:47', '2025-07-25 02:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'John Doe', 'john@example.com', 'Great website! I love the clean design and easy navigation.', '2025-07-25 02:18:47'),
(2, 'Jane Smith', 'jane@example.com', 'I found the article about form validation very useful. Thanks for sharing your knowledge!', '2025-07-25 02:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-06-20-000001', 'App\\Database\\Migrations\\CreateArticlesTable', 'default', 'App', 1753409877, 1),
(2, '2025-06-20-000002', 'App\\Database\\Migrations\\CreateFeedbackTable', 'default', 'App', 1753409877, 1),
(3, '2025-06-21-000003', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1753409877, 1),
(4, '2025-07-16-000001', 'App\\Database\\Migrations\\CreateBooksTable', 'default', 'App', 1753409877, 1),
(5, '2025-07-23-000001', 'App\\Database\\Migrations\\AddProfileFieldsToUsers', 'default', 'App', 1753409877, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `birth_date` date DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_general_ci,
  `role` enum('admin','librarian','member') COLLATE utf8mb4_general_ci DEFAULT 'member',
  `status` enum('active','inactive','suspended') COLLATE utf8mb4_general_ci DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `profile_picture`, `phone`, `address`, `birth_date`, `gender`, `bio`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$pgxCfAk2/wvyvFWDgGlJMO26UMBQzP6UDgiqr8prBBSNhqizN2ZV.', 'admin@example.com', 'Administrator', '1753510860_c9f3ac03a3142470da29.png', '082117707445', '', '0000-00-00', 'male', '', 'member', 'active', '2025-07-25 02:18:47', '2025-07-26 06:21:00'),
(2, 'user', '$2y$10$KwuzgDBA6r3NEneLNWSj0evfF92/6q7.lbJfsDGi0.HNEN5KEGCeS', 'user@example.com', 'Regular User', NULL, NULL, NULL, NULL, NULL, NULL, 'member', 'active', '2025-07-25 02:18:47', '2025-07-25 02:18:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `title` (`title`),
  ADD KEY `author` (`author`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
