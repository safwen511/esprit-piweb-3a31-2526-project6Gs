-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2026 at 10:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finale`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoption_request`
--

CREATE TABLE `adoption_request` (
  `id` int(11) NOT NULL,
  `request_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `client_id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption_request`
--

INSERT INTO `adoption_request` (`id`, `request_date`, `status`, `client_id`, `animal_id`) VALUES
(1, '2026-04-17 10:08:00', 'REJECTED', 15, 3),
(2, '2026-04-17 12:31:00', 'APPROVED', 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `idAnimal` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `species` varchar(50) NOT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `owner_compte_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`idAnimal`, `name`, `species`, `breed`, `age`, `gender`, `description`, `status`, `image`, `owner_compte_id`) VALUES
(1, 'osc', 'Chat', NULL, NULL, NULL, NULL, 'AVAILABLE', NULL, 15),
(3, 'mako', 'Dog', 'berger suisse', 5, 'MALE', 'mljdvmlsjjkSD', 'AVAILABLE', 'uploads/animals/22adfad7-bd65-70f4-6983-929be4217158-min-275ad247dae5.jpg', 15),
(4, 'garfield', 'Cat', 'orange', 7, 'MALE', 'lkjsndcnùksdncùpdzlj', 'AVAILABLE', 'uploads/animals/orange-cat-in-cardboard-box-38bf54a019e1.png', 22),
(5, 'kiki', 'cat', 'siamese', 2, 'FEMALE', 'kjfdbknfkjzpofpoe', 'AVAILABLE', 'uploads/animals/everything-you-need-to-know-about-siamese-cats-8fb62b53965c.jpg', 22),
(6, 'typeC', 'cat', 'ragdoll', 15, 'FEMALE', 'typeC is a female cat (ragdoll) estimated at 15 months. typeC was safely found and is now looking for a caring home with a responsible adopter.', 'AVAILABLE', 'uploads/animals/ragdoll-7646166daf8d.jpg', 22);

-- --------------------------------------------------------

--
-- Stand-in structure for view `api_comment`
-- (See below for the actual view)
--
CREATE TABLE `api_comment` (
`id` bigint(20)
,`post_id` bigint(20)
,`author_id` int(11)
,`parent_comment_id` bigint(20)
,`body` longtext
,`status` varchar(10)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `author_id` int(11) NOT NULL,
  `parent_comment_id` bigint(20) DEFAULT NULL,
  `body` longtext NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `author_id`, `parent_comment_id`, `body`, `status`, `created_at`) VALUES
(6, 1, 6, NULL, 'hii', 'ACTIVE', '2026-03-05 05:42:34'),
(17, 1, 6, NULL, 'aaaa', 'ACTIVE', '2026-03-05 08:39:33'),
(18, 1, 5, 6, 'dzdzd', 'ACTIVE', '2026-03-05 08:39:59'),
(19, 1, 6, 18, 'eaze', 'ACTIVE', '2026-03-05 08:40:53'),
(20, 2, 7, NULL, 'Custom comment 1', 'ACTIVE', '2026-02-10 10:11:25'),
(21, 3, 1, NULL, 'Custom comment 2', 'ACTIVE', '2026-02-13 13:44:33'),
(22, 1, 9, NULL, 'Custom comment 3', 'ACTIVE', '2026-03-01 17:54:05'),
(23, 3, 1, NULL, 'Custom comment 4', 'ACTIVE', '2026-02-05 19:09:01'),
(24, 4, 7, NULL, 'Custom comment 5', 'ACTIVE', '2026-02-04 16:59:46'),
(25, 3, 8, NULL, 'Custom comment 6', 'ACTIVE', '2026-03-05 12:16:22'),
(26, 5, 6, NULL, 'hello', 'ACTIVE', '2026-03-05 12:33:01'),
(27, 5, 6, 26, 'hi', 'ACTIVE', '2026-03-05 12:33:06'),
(28, 3, 6, NULL, '12345', 'ACTIVE', '2026-03-05 12:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `comment_reaction`
--

CREATE TABLE `comment_reaction` (
  `comment_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `reaction` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_reaction`
--

INSERT INTO `comment_reaction` (`comment_id`, `user_id`, `reaction`) VALUES
(6, 5, 'LIKE'),
(6, 7, 'LIKE'),
(17, 10, 'LIKE'),
(18, 1, 'LIKE'),
(18, 5, 'LIKE'),
(18, 6, 'LIKE'),
(19, 5, 'LIKE'),
(21, 1, 'LIKE'),
(22, 7, 'LIKE'),
(25, 7, 'LIKE');

-- --------------------------------------------------------

--
-- Table structure for table `disponibilite`
--

CREATE TABLE `disponibilite` (
  `id_disponibilite` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_available` tinyint(4) NOT NULL,
  `vet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disponibilite`
--

INSERT INTO `disponibilite` (`id_disponibilite`, `date`, `start_time`, `end_time`, `is_available`, `vet_id`) VALUES
(1, '2026-04-17', '08:23:00', '12:24:00', 0, 14),
(2, '2026-04-18', '14:55:00', '18:55:00', 0, 18),
(3, '2026-04-24', '11:53:00', '19:53:00', 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260321120352', '2026-04-16 00:25:19', 364),
('DoctrineMigrations\\Version20260322110000', '2026-04-16 00:25:19', 178),
('DoctrineMigrations\\Version20260324123000', '2026-04-16 00:25:19', 135),
('DoctrineMigrations\\Version20260417110000', '2026-04-17 20:27:06', 126),
('DoctrineMigrations\\Version20260417123000', '2026-04-17 20:34:01', 68);

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `id` bigint(20) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`id`, `user1_id`, `user2_id`, `created_at`) VALUES
(1, 2, 3, '2026-03-01 22:06:54'),
(2, 1, 2, '2026-03-02 06:03:54'),
(3, 1, 5, '2026-03-03 22:21:23'),
(4, 5, 6, '2026-03-05 05:43:13'),
(5, 1, 6, '2026-02-01 09:31:52'),
(6, 6, 7, '2026-01-29 15:24:51'),
(7, 6, 8, '2026-02-07 11:33:51'),
(8, 6, 9, '2026-01-05 19:29:10'),
(9, 6, 10, '2026-01-23 09:00:26'),
(10, 1, 7, '2026-02-08 19:16:53'),
(11, 8, 9, '2026-03-05 11:20:37'),
(12, 7, 9, '2026-03-05 12:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE `friend_request` (
  `id` bigint(20) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `status` varchar(16) NOT NULL DEFAULT 'PENDING',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`id`, `sender_id`, `receiver_id`, `status`, `created_at`) VALUES
(1, 3, 2, 'ACCEPTED', '2026-03-01 22:06:19'),
(2, 1, 2, 'ACCEPTED', '2026-03-02 06:03:54'),
(3, 1, 5, 'DECLINED', '2026-03-03 22:20:03'),
(4, 5, 1, 'ACCEPTED', '2026-03-03 22:21:04'),
(5, 5, 3, 'PENDING', '2026-03-05 03:34:44'),
(6, 6, 5, 'ACCEPTED', '2026-03-05 05:42:44'),
(7, 6, 1, 'ACCEPTED', '2026-02-08 09:51:06'),
(8, 6, 7, 'ACCEPTED', '2026-02-27 17:30:42'),
(9, 6, 8, 'ACCEPTED', '2026-02-19 13:08:46'),
(10, 6, 9, 'ACCEPTED', '2026-02-24 10:52:53'),
(11, 8, 9, 'ACCEPTED', '2026-03-05 11:20:19'),
(12, 9, 7, 'ACCEPTED', '2026-03-05 12:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint(20) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `comment_id` bigint(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `recipient_id`, `actor_id`, `type`, `post_id`, `comment_id`, `message`, `is_read`, `created_at`) VALUES
(33, 1, 6, 'POST_COMMENT', 11, NULL, 'commented on your post', 0, '2026-03-05 11:15:30'),
(34, 8, 7, 'POST_LIKE', 10, NULL, 'liked your post', 1, '2026-03-05 11:15:30'),
(35, 7, 8, 'POST_LIKE', 9, NULL, 'liked your post', 1, '2026-03-05 11:15:30'),
(36, 1, 9, 'POST_COMMENT', 8, NULL, 'commented on your post', 1, '2026-03-05 11:15:30'),
(37, 6, 10, 'POST_LIKE', 6, NULL, 'liked your post', 0, '2026-03-05 11:15:30'),
(38, 6, 1, 'POST_LIKE', 5, NULL, 'liked your post', 1, '2026-03-05 11:15:30'),
(39, 5, 6, 'POST_COMMENT', 4, NULL, 'commented on your post', 0, '2026-03-05 11:15:30'),
(40, 5, 7, 'POST_LIKE', 3, NULL, 'liked your post', 1, '2026-03-05 11:15:30'),
(41, 5, 8, 'POST_LIKE', 2, NULL, 'liked your post', 1, '2026-03-05 11:15:30'),
(42, 4, 9, 'POST_COMMENT', 1, NULL, 'commented on your post', 1, '2026-03-05 11:15:30'),
(43, 5, 6, 'POST_COMMENT', 3, 28, 'New comment on your post', 1, '2026-03-05 12:33:23'),
(44, 1, 12, 'POST_LIKE', 14, NULL, 'ilef ben chouchen liked your post.', 0, '2026-04-15 23:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `totalP` double NOT NULL,
  `totalt` double NOT NULL,
  `qty` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`id`, `title`, `totalP`, `totalt`, `qty`, `idProduit`, `client_id`) VALUES
(10, 'letsgooo', 55, 2, 1, 19, 11);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(20) NOT NULL,
  `author_id` int(11) NOT NULL,
  `caption` longtext DEFAULT NULL,
  `media_type` varchar(10) NOT NULL DEFAULT 'NONE',
  `media_path` varchar(500) DEFAULT NULL,
  `thumbnail_path` varchar(500) DEFAULT NULL,
  `duration_seconds` int(11) DEFAULT NULL,
  `likes_count` int(11) NOT NULL DEFAULT 0,
  `dislikes_count` int(11) NOT NULL DEFAULT 0,
  `shares_count` int(11) NOT NULL DEFAULT 0,
  `comments_count` int(11) NOT NULL DEFAULT 0,
  `visibility` varchar(10) NOT NULL DEFAULT 'PUBLIC',
  `status` varchar(10) NOT NULL DEFAULT 'ACTIVE',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `author_id`, `caption`, `media_type`, `media_path`, `thumbnail_path`, `duration_seconds`, `likes_count`, `dislikes_count`, `shares_count`, `comments_count`, `visibility`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'test integration', 'IMAGE', 'C:\\Users\\safwe\\Downloads\\myimg.jpeg', NULL, NULL, 1, 0, 0, 5, 'PUBLIC', 'ACTIVE', '2026-03-02 08:42:21', '2026-03-05 10:14:33'),
(2, 5, 'private post', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot 2024-10-07 093130.png', NULL, NULL, 1, 1, 0, 1, 'PRIVATE', 'ACTIVE', '2026-03-05 03:43:56', '2026-03-05 11:34:26'),
(3, 5, 'davaieee', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot 2025-11-23 171357.png', NULL, NULL, 1, 0, 1, 4, 'FRIENDS', 'ACTIVE', '2026-03-05 03:44:25', '2026-03-05 11:33:23'),
(4, 5, 'eazeaz', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot 2024-10-11 103436.png', NULL, NULL, 1, 0, 2, 1, 'PRIVATE', 'ACTIVE', '2026-03-05 05:15:58', '2026-03-05 10:15:30'),
(5, 6, 'ezeze', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot (1).png', NULL, NULL, 0, 1, 1, 2, 'PRIVATE', 'ACTIVE', '2026-03-05 05:59:16', '2026-03-05 11:33:06'),
(6, 6, 'ayo', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot 2025-05-12 143251.png', NULL, NULL, 1, 0, 1, 0, 'PUBLIC', 'ACTIVE', '2026-03-05 07:58:28', '2026-03-05 10:14:33'),
(8, 1, 'First walk of the day with my pet.', 'NONE', NULL, NULL, NULL, 1, 0, 0, 0, 'PUBLIC', 'ACTIVE', '2026-02-10 08:05:21', '2026-03-05 10:15:30'),
(9, 7, 'Healthy breakfast for my companion.', 'NONE', NULL, NULL, NULL, 1, 0, 0, 0, 'PUBLIC', 'ACTIVE', '2026-02-02 15:52:39', '2026-03-05 10:15:30'),
(10, 8, 'Adoption weekend update from FurHope.', 'NONE', NULL, NULL, NULL, 1, 0, 1, 0, 'PUBLIC', 'ACTIVE', '2026-02-12 08:18:57', '2026-03-05 10:15:30'),
(11, 1, 'Vet check completed and all good.', 'NONE', NULL, NULL, NULL, 0, 1, 0, 0, 'PUBLIC', 'ACTIVE', '2026-02-03 12:17:10', '2026-03-05 10:15:30'),
(12, 9, 'azeazezae', 'NONE', NULL, NULL, NULL, 0, 0, 0, 0, 'PUBLIC', 'ACTIVE', '2026-03-05 11:17:10', NULL),
(13, 6, 'eze', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot (1).png', NULL, NULL, 0, 0, 0, 0, 'FRIENDS', 'ACTIVE', '2026-03-05 12:32:35', NULL),
(14, 1, '55555555', 'IMAGE', 'uploads/social/thumb-1920-1267145-69d15910d914f1.32129924.png', NULL, NULL, 1, 1, 0, 0, 'PUBLIC', 'ACTIVE', '2026-04-04 19:31:44', '2026-04-15 21:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `post_reaction`
--

CREATE TABLE `post_reaction` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `reaction` varchar(16) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_reaction`
--

INSERT INTO `post_reaction` (`id`, `post_id`, `user_id`, `reaction`, `created_at`) VALUES
(22, 11, 1, 'DISLIKE', '2026-03-05 11:15:30'),
(23, 10, 6, 'LIKE', '2026-03-05 11:15:30'),
(24, 9, 7, 'LIKE', '2026-03-05 11:15:30'),
(25, 8, 8, 'LIKE', '2026-03-05 11:15:30'),
(26, 6, 9, 'LIKE', '2026-03-05 11:15:30'),
(27, 5, 10, 'DISLIKE', '2026-03-05 11:15:30'),
(28, 4, 1, 'LIKE', '2026-03-05 11:15:30'),
(29, 3, 6, 'LIKE', '2026-03-05 11:15:30'),
(30, 2, 7, 'LIKE', '2026-03-05 11:15:30'),
(31, 1, 8, 'LIKE', '2026-03-05 11:15:30'),
(32, 2, 5, 'DISLIKE', '2026-03-05 12:34:22'),
(33, 14, 1, 'DISLIKE', '2026-04-04 19:31:59'),
(34, 14, 12, 'LIKE', '2026-04-15 23:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `post_report`
--

CREATE TABLE `post_report` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `reporter_user_id` bigint(20) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_report`
--

INSERT INTO `post_report` (`id`, `post_id`, `reporter_user_id`, `reason`, `created_at`) VALUES
(1, 17, 1, 'bad', '2026-02-28 23:38:49'),
(2, 17, 2, 'bad', '2026-02-28 23:48:48'),
(3, 23, 1, 'integration-check', '2026-03-02 06:03:28'),
(4, 3, 6, 'aaa', '2026-03-05 08:26:39'),
(5, 1, 8, 'Spam', '2026-02-26 14:20:10'),
(6, 2, 6, 'Spam', '2026-03-02 17:01:29'),
(7, 4, 10, 'Spam', '2026-02-26 14:18:05'),
(8, 1, 7, 'Spam', '2026-02-21 17:59:04'),
(9, 2, 7, 'Spam', '2026-02-26 09:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `post_share`
--

CREATE TABLE `post_share` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_share`
--

INSERT INTO `post_share` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(4, 23, 1, '2026-03-02 06:03:28'),
(5, 6, 1, '2026-02-20 11:37:38'),
(6, 4, 7, '2026-02-25 11:00:15'),
(7, 4, 6, '2026-03-01 11:45:28'),
(8, 3, 7, '2026-03-03 08:27:24'),
(9, 5, 6, '2026-02-14 19:28:49'),
(10, 10, 10, '2026-03-03 12:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'medical',
  `price` double NOT NULL,
  `tva` double NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id`, `title`, `category`, `price`, `tva`, `image`, `description`, `stock`, `owner_id`) VALUES
(2, 'ugv', 'medical', 55, 5, 'uploads/products/ugv-9f17338933ef.jpg', 'khyvhj', 55, 1),
(4, 'dazd', 'clothing', 51, 2, 'uploads/products/dazd-95bb2e1446d3.png', 'dzad', 55, 1),
(5, 'uuu', 'food', 45, 4, 'uploads/products/uuu-453c1c2f69d6.jpg', '', 88, 1),
(6, 'Test Harness', 'medical', 28.5, 3.5, 'uploads/products/ugv-9f17338933ef.jpg', 'Diagnostic test product for pagination and filter checks.', 18, 1),
(7, 'Travel Bowl', 'food', 19.9, 1.9, 'uploads/products/yy-04ec2ad51968.jpg', 'Portable bowl for trips and outdoor feeding.', 24, 1),
(8, 'Cozy Blanket', 'clothing', 42, 4.2, 'uploads/products/dazd-95bb2e1446d3.png', 'Warm blanket for cats and small dogs.', 12, 1),
(9, 'Dental Chews', 'food', 15.75, 1.25, 'uploads/products/aaaaa-fea8a9d82a52.jpg', 'Daily chewing sticks that support dental hygiene.', 40, 1),
(10, 'Rain Jacket', 'clothing', 54, 5, 'uploads/products/ugv-f0d3a3997f07.jpg', 'Lightweight rain jacket with reflective trim.', 9, 1),
(11, 'Smart Collar', 'medical', 88, 8, 'uploads/products/uuu-453c1c2f69d6.jpg', 'Activity-ready collar with secure fit and comfort padding.', 16, 1),
(12, 'Feather Teaser', 'toys', 12.5, 0.9, 'uploads/products/dazd-95bb2e1446d3.png', 'Interactive feather toy for energetic play.', 31, 1),
(13, 'Training Treats', 'food', 22.4, 2, 'uploads/products/yy-04ec2ad51968.jpg', 'Small training bites with salmon flavor.', 27, 1),
(14, 'Winter Hoodie', 'clothing', 47.8, 4.1, 'uploads/products/ugv-9f17338933ef.jpg', 'Soft hoodie designed for cool evening walks.', 14, 1),
(15, 'First Aid Kit', 'medical', 63.3, 6.3, 'uploads/products/aaaaa-fea8a9d82a52.jpg', 'Compact first aid essentials for pets on the move.', 11, 1),
(16, 'Puzzle Bone', 'toys', 26, 2.1, 'uploads/products/ugv-f0d3a3997f07.jpg', 'Reward-based puzzle toy for mental stimulation.', 20, 1),
(17, 'Cooling Mat', 'medical', 39.95, 3.45, 'uploads/products/uuu-453c1c2f69d6.jpg', 'Cooling mat that helps pets stay comfortable in warm weather.', 17, 1),
(19, 'letsgooo2', 'medical', 55, 2, 'uploads/products/letsgooo-7ff2203983e3.jpg', 'letsgooo2 is a medical product that fits a care-oriented routine for pets that need reliable support items. azeaz The current visible price is 53.00 TND. It is currently available with 55 items in stock.', 55, 1),
(20, 'hfh', 'medical', 66, 6, 'uploads/products/hfh-ef3f4c683e51.png', 'sghgfh', 88, 1),
(21, 'test', 'clothing', 55, 5, 'uploads/products/test-b028b54ad261.jpg', 'zadazdazd', 80, 11),
(22, 'daaaaaa', 'clothing', 40, 4, 'uploads/products/daaaaaa-f529c85c65ed.png', 'azdazd', 55, 11),
(23, 'f yesss', 'food', 74, 7, 'uploads/products/f-yesss-bd7c9e37e602.jpg', 'aaaaaaaaa', 50, 1),
(25, 'chewing toy', 'toys', 44, 4, 'uploads/products/chewing-toy-1901217a095c.jpg', 'chewing toy is a toys product that adds enrichment and play to a pet\'s daily routine. It is presented as a straightforward choice for pet owners looking for a dependable shop item. The product photo suggests a green and blue plastic toothbrush with the words yy. The current visible price is 40.00 TND. It is currently available with 555 items in stock.', 555, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promo_code`
--

CREATE TABLE `promo_code` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `code` varchar(40) NOT NULL,
  `discount_percentage` double NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `used_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `max_uses` int(11) DEFAULT NULL,
  `used_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_code`
--

INSERT INTO `promo_code` (`id`, `user_id`, `product_id`, `code`, `discount_percentage`, `created_at`, `expires_at`, `used_at`, `max_uses`, `used_count`) VALUES
(22, NULL, NULL, 'WELCOME15', 15, '2026-04-17 20:40:42', NULL, NULL, NULL, 0),
(23, NULL, NULL, 'PROMO10', 10, '2026-04-17 20:40:42', NULL, NULL, NULL, 0),
(24, NULL, NULL, 'AZERTY', 10, '2026-04-17 20:40:42', NULL, NULL, NULL, 0),
(25, NULL, NULL, 'SHOP20', 20, '2026-04-17 20:40:42', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `id_rdv` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` varchar(30) NOT NULL,
  `description` longtext DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `vet_id` int(11) DEFAULT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `disponibilite_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rendezvous`
--

INSERT INTO `rendezvous` (`id_rdv`, `appointment_date`, `appointment_time`, `status`, `description`, `client_id`, `vet_id`, `animal_id`, `disponibilite_id`) VALUES
(1, '2026-04-17', '10:23:00', 'confirmed', 'je veux faire une operation de fracture pour mon chat', 15, 14, 1, 1),
(2, '2026-04-17', '09:23:00', 'confirmed', 'fracture au niveau du patte ', 15, 14, 1, 1),
(3, '2026-04-18', '17:55:00', 'confirmed', 'vaccin', 15, 18, 2, 2),
(4, '2026-04-24', '13:53:00', 'pending', 'Appointment request for osc (Cat). Main reason: vaccin', 15, 14, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(16) NOT NULL,
  `created_at` datetime NOT NULL,
  `reservation_date` date NOT NULL,
  `guest_count` int(11) NOT NULL,
  `nightly_rate` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `vet_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `note`, `commentaire`, `created_at`, `vet_id`, `client_id`) VALUES
(1, 3, '', '2026-04-16 14:28:47', 14, 15),
(2, 5, '', '2026-04-16 14:59:01', 18, 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(120) NOT NULL,
  `last_name` varchar(120) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `phone_number` varchar(30) DEFAULT NULL,
  `profile_image_url` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(4) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_veteran_applicant` tinyint(4) NOT NULL,
  `is_veteran_approved` tinyint(4) NOT NULL,
  `updated_at` datetime NOT NULL,
  `signature` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `created_at`, `roles`, `phone_number`, `profile_image_url`, `is_verified`, `is_active`, `is_veteran_applicant`, `is_veteran_approved`, `updated_at`, `signature`) VALUES
(1, 'Hamza', 'Benyahia', 'hamza.benyahia@esprit.tn', '$2y$13$FNrM37Ta3fQVP62pILdjJe4EmPkpMaUPNObnHYAJAdcdqnGTV6SdS', '53035155', '2026-02-14 10:16:04', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '53035155', 'C:\\Users\\safwe\\Desktop\\equipe\\hamza.jpeg', 1, 1, 0, 0, '2026-04-04 20:27:58', NULL),
(2, 'hamza', 'benyahia', 'donniedarko@gmail.com', '$2y$13$e5J1.4e2Hj0MgWmXNhLVkugWAcouOnAHinB5jBSfv8Z9p6jO4xWAe', '53035155', '2026-02-14 12:14:14', '[\"ROLE_USER\"]', '53035155', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39', NULL),
(3, 'fzef', 'fzaazf', 'hjbhjazdf@gmail.com', '$2y$13$9GZ9Tvyp9d5OeEMmFrH2gu9857BpNbb40W9HFPKb1lE.VGgdzJuuC', '74852963', '2026-02-14 17:42:14', '[\"ROLE_USER\"]', '74852963', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39', NULL),
(4, 'adem', 'ziri', 'ziriadem33@gmail.com', '$2y$13$2HV5SdwsJ5rp24ZS2Wt3XuXZbkc/UR1cAAEp9PGTjLACnrlWhPCiK', '27938446', '2026-02-15 12:09:08', '[\"ROLE_USER\"]', '27938446', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39', NULL),
(5, 'zakaria', 'zarouk', 'zarrouk.zakaria@esprit.tn', '$2y$13$Cphy8B/8LAmDbPvYX3sHSuG3gZjFXQBsk5gmYZNTrhJTRjY6i0e6W', '74859123', '2026-02-15 12:57:54', '[\"ROLE_USER\"]', '74859123', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39', NULL),
(6, 'Safwen', 'Yahyaoui', 'safwenyahyaoui047@gmail.com', '$2y$13$bK9lMOLfaou.Lx24ARpoq.b.TKmymq.CgTjc0q2lsm6V55g9bcpLa', '0473821736', '2026-03-05 05:41:57', '[\"ROLE_USER\"]', '0473821736', 'C:\\Users\\safwe\\Desktop\\equipe\\saf.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39', NULL),
(7, 'Zakaria', 'Zarrouk', 'zakaria.zarrouk@esprit.tn', '$2y$13$v0m5DNnI2EXeTKzUbp0YK.FF2sFzSkZZ3cPcMAQe.r8rz6NNsgYPu', '0473821738', '2026-03-05 11:14:33', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '0473821738', 'C:\\Users\\safwe\\Desktop\\equipe\\zak.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39', NULL),
(8, 'Youssef', 'Tounsi', 'youssef.tounsi@esprit.tn', '$2y$13$xtnmZEuZuSUyZVcNGsuXR.dVKXp0G3VcAEMOF75zxAl6h87dGuF6q', '0473821739', '2026-03-05 11:14:33', '[\"ROLE_USER\"]', '0473821739', 'C:\\Users\\safwe\\Desktop\\equipe\\youssef.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39', NULL),
(9, 'Joumena', 'Turki', 'joumena.turki@esprit.tn', '$2y$13$.hzj1GuXTv9tTK/oaJhTYuxmX3KJwk8L6prA/uIWg0t68dOaBDcMu', '0473821740', '2026-03-05 11:14:33', '[\"ROLE_USER\"]', '0473821740', 'C:\\Users\\safwe\\Desktop\\equipe\\djo.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39', NULL),
(10, 'Ilef', 'Ben Chouchane', 'ilef.benchouchane@esprit.tn', '$2y$13$CCX.YvSt4TYWiJDrsk6gSuW.5hF.QzcQVebUyXXvsBW1JCPQe1Shi', '0473821741', '2026-03-05 11:14:33', '[\"ROLE_USER\"]', '0473821741', 'C:\\Users\\safwe\\Desktop\\equipe\\ilef.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39', NULL),
(11, 'youssef', 'tounsi', 'youssef.tounsi@gmail.com', '$2y$13$z7YR0XXk1CXtxjyRyoeyD.Qd4nr3qjt3BSeFf9yUxUBwCKTfEQVJe', NULL, '2026-04-04 18:52:30', '[]', '15478596', 'uploads/profiles/cv-69d151453da95.png', 0, 1, 0, 0, '2026-04-04 19:58:29', NULL),
(14, 'ilef', 'ben chouchen', 'ilefbenchouchane3@gmail.com', '$2y$13$JF8YgsnGwbSicTssaERsFuSpepFB0xzUQq7rTogqY/jtYRSzOKgLa', NULL, '2026-04-16 01:58:48', '[\"ROLE_USER\",\"ROLE_VETERINAIRE\"]', '95309296', NULL, 1, 1, 1, 1, '2026-04-16 20:51:43', '{\"version\":1,\"points\":[{\"x\":-0.176051,\"y\":-0.46304},{\"x\":-0.113595,\"y\":-0.440253},{\"x\":-0.051133,\"y\":-0.417484},{\"x\":0.011804,\"y\":-0.396059},{\"x\":0.070963,\"y\":-0.366168},{\"x\":0.128946,\"y\":-0.333641},{\"x\":0.185737,\"y\":-0.299191},{\"x\":0.240685,\"y\":-0.261763},{\"x\":0.296505,\"y\":-0.225745},{\"x\":0.353718,\"y\":-0.192117},{\"x\":0.404196,\"y\":-0.14885},{\"x\":0.446776,\"y\":-0.100541},{\"x\":0.467936,\"y\":-0.037646},{\"x\":0.490882,\"y\":0.024624},{\"x\":0.490873,\"y\":0.088887},{\"x\":0.470373,\"y\":0.151956},{\"x\":0.452039,\"y\":0.215731},{\"x\":0.416536,\"y\":0.27022},{\"x\":0.375689,\"y\":0.32249},{\"x\":0.339995,\"y\":0.378579},{\"x\":0.299183,\"y\":0.430876},{\"x\":0.255916,\"y\":0.481353},{\"x\":0.203707,\"y\":0.522032},{\"x\":0.13913,\"y\":0.531861},{\"x\":0.072843,\"y\":0.53696},{\"x\":0.013914,\"y\":0.508717},{\"x\":-0.046583,\"y\":0.481408},{\"x\":-0.102997,\"y\":0.447872},{\"x\":-0.156067,\"y\":0.408856},{\"x\":-0.213832,\"y\":0.379695},{\"x\":-0.26431,\"y\":0.336428},{\"x\":-0.303719,\"y\":0.283062},{\"x\":-0.338078,\"y\":0.226153},{\"x\":-0.372284,\"y\":0.169144},{\"x\":-0.394188,\"y\":0.106829},{\"x\":-0.400305,\"y\":0.040722},{\"x\":-0.432564,\"y\":-0.013789},{\"x\":-0.434128,\"y\":-0.079054},{\"x\":-0.436531,\"y\":-0.145282},{\"x\":-0.437082,\"y\":-0.210858},{\"x\":-0.411998,\"y\":-0.272428},{\"x\":-0.38375,\"y\":-0.332565},{\"x\":-0.344241,\"y\":-0.385537},{\"x\":-0.290885,\"y\":-0.422187},{\"x\":-0.229606,\"y\":-0.447947},{\"x\":-0.163559,\"y\":-0.442084},{\"x\":-0.097271,\"y\":-0.447183},{\"x\":-0.03359,\"y\":-0.46304}]}'),
(15, 'Admin', 'User', 'admin@furhope.com', '$2y$13$nO0./cEwFRB6Y/y5Kz9oA.j6069KgV4KhY3Hbax3j9WSqap7C2OVm', '+21695309296', '2026-04-16 02:01:02', '[\"ROLE_ADMIN\"]', NULL, NULL, 1, 1, 0, 0, '2026-04-16 13:57:30', NULL),
(16, 'Chak', 'chouka', 'ilefbenchouchane@gmail.com', '$2y$13$6Wp.XAuczTHMpk.mK6pYBuei65EX2Af9MCLZrmD.kiPu0kj0tZIfW', NULL, '2026-04-16 02:43:11', '[\"ROLE_USER\"]', NULL, NULL, 0, 1, 0, 0, '2026-04-16 02:43:11', NULL),
(17, 'mohamed', 'ahmed', 'mohamed@gmail.com', '$2y$13$O5mD4DFWi4W2tqpgwHgHaujAoTKE/oSSPnC66BGBgnZo1oFSbrlHe', NULL, '2026-04-16 14:30:13', '[\"ROLE_USER\",\"ROLE_VETERINAIRE\"]', NULL, NULL, 1, 1, 1, 1, '2026-04-16 14:37:08', NULL),
(18, 'halima', 'ha', 'halima@gmail.com', '$2y$13$ifrrgrAPOF0Y.2/z4C27y.AVJSFxsQnG9TjCmKHo.RamkjNXCpiYu', NULL, '2026-04-16 14:51:03', '[\"ROLE_USER\",\"ROLE_VETERINAIRE\"]', NULL, NULL, 1, 1, 1, 1, '2026-04-16 14:54:32', '{\"version\":1,\"points\":[{\"x\":0.05419,\"y\":-0.428698},{\"x\":0.072518,\"y\":-0.419534},{\"x\":0.059004,\"y\":-0.426291},{\"x\":0.128814,\"y\":-0.410632},{\"x\":0.185229,\"y\":-0.370229},{\"x\":0.246103,\"y\":-0.332741},{\"x\":0.31407,\"y\":-0.31466},{\"x\":0.380795,\"y\":-0.291313},{\"x\":0.445404,\"y\":-0.259009},{\"x\":0.487037,\"y\":-0.205845},{\"x\":0.478874,\"y\":-0.13952},{\"x\":0.472484,\"y\":-0.073069},{\"x\":0.4598,\"y\":-0.002331},{\"x\":0.453473,\"y\":0.068625},{\"x\":0.421168,\"y\":0.133234},{\"x\":0.388863,\"y\":0.197844},{\"x\":0.376139,\"y\":0.26533},{\"x\":0.328384,\"y\":0.318803},{\"x\":0.279802,\"y\":0.368015},{\"x\":0.218948,\"y\":0.406691},{\"x\":0.154065,\"y\":0.436492},{\"x\":0.083292,\"y\":0.434448},{\"x\":0.036876,\"y\":0.47324},{\"x\":-0.03536,\"y\":0.47324},{\"x\":-0.107595,\"y\":0.47324},{\"x\":-0.172636,\"y\":0.442763},{\"x\":-0.237246,\"y\":0.410458},{\"x\":-0.292424,\"y\":0.365068},{\"x\":-0.282633,\"y\":0.348977},{\"x\":-0.308738,\"y\":0.348728},{\"x\":-0.352079,\"y\":0.29094},{\"x\":-0.407472,\"y\":0.247592},{\"x\":-0.453797,\"y\":0.203987},{\"x\":-0.474061,\"y\":0.137133},{\"x\":-0.512963,\"y\":0.076427},{\"x\":-0.504053,\"y\":0.013927},{\"x\":-0.471748,\"y\":-0.050682},{\"x\":-0.439443,\"y\":-0.115291},{\"x\":-0.407139,\"y\":-0.179901},{\"x\":-0.367664,\"y\":-0.236244},{\"x\":-0.309649,\"y\":-0.271209},{\"x\":-0.251453,\"y\":-0.293925},{\"x\":-0.189585,\"y\":-0.325027},{\"x\":-0.117349,\"y\":-0.325027},{\"x\":-0.045114,\"y\":-0.325027},{\"x\":0.022169,\"y\":-0.339887},{\"x\":0.086673,\"y\":-0.370411},{\"x\":0.106026,\"y\":-0.428698}]}'),
(19, 'ilef', 'ilef', 'ilef@gmail.com', '$2y$13$WUPPX1ywDhXwHaUo3tJsQ.iLg1ZFIMsGO7jSOn56APtGwFNN.yKCa', NULL, '2026-04-16 17:27:33', '[\"ROLE_USER\"]', NULL, NULL, 0, 1, 1, 0, '2026-04-16 17:27:33', NULL),
(20, 'bata', 'batout', 'bata@gmail.com', '$2y$13$LjJCU1WBChfWKc.mSUgB/.TMrbP/z/BotlLsRQwvfOPy4595miqnq', NULL, '2026-04-16 20:25:33', '[\"ROLE_USER\"]', NULL, NULL, 0, 1, 1, 0, '2026-04-16 20:25:33', NULL),
(22, 'joumana', 'turki', 'joumenaturki@gmail.com', '$2y$13$VYEcRfyiF8ZfLrmZ0Os1ourdd7wjeteRE5iKId.iQdZl5R1c79ReC', NULL, '2026-04-17 00:04:02', '[\"ROLE_USER\"]', NULL, NULL, 0, 1, 0, 0, '2026-04-17 00:04:02', NULL),
(23, 'batata', 'hlowa', 'batata.hlawa@gmail.com', '$2y$13$t8EyfE.WmF9OcZ0WNSftb.11S3ytcGl.WvIvnWuQQHEn/MB1e.fDy', NULL, '2026-04-17 12:35:57', '[\"ROLE_USER\"]', NULL, NULL, 0, 1, 0, 0, '2026-04-17 12:35:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vet_planning_event`
--

CREATE TABLE `vet_planning_event` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `event_type` varchar(30) NOT NULL,
  `starts_at` datetime NOT NULL,
  `ends_at` datetime DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `vet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vet_planning_event`
--

INSERT INTO `vet_planning_event` (`id`, `title`, `event_type`, `starts_at`, `ends_at`, `description`, `vet_id`) VALUES
(1, 'repose', 'CONGE', '2026-04-25 01:37:00', '2026-04-26 01:37:00', NULL, 14);

-- --------------------------------------------------------

--
-- Structure for view `api_comment`
--
DROP TABLE IF EXISTS `api_comment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`safwen`@`localhost` SQL SECURITY DEFINER VIEW `api_comment`  AS SELECT `c`.`id` AS `id`, `c`.`post_id` AS `post_id`, `c`.`author_id` AS `author_id`, `c`.`parent_comment_id` AS `parent_comment_id`, `c`.`body` AS `body`, `c`.`status` AS `status`, `c`.`created_at` AS `created_at` FROM `comment` AS `c` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption_request`
--
ALTER TABLE `adoption_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_410896EE8E962C16` (`animal_id`);

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`idAnimal`),
  ADD KEY `IDX_6AAB231FF0BE1593` (`owner_compte_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `parent_comment_id` (`parent_comment_id`),
  ADD KEY `idx_comment_post` (`post_id`);

--
-- Indexes for table `comment_reaction`
--
ALTER TABLE `comment_reaction`
  ADD PRIMARY KEY (`comment_id`,`user_id`),
  ADD KEY `IDX_B99364F1F8697D13` (`comment_id`);

--
-- Indexes for table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD PRIMARY KEY (`id_disponibilite`),
  ADD KEY `IDX_2CBACE2F40369CAB` (`vet_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_friendship` (`user1_id`,`user2_id`),
  ADD KEY `fk_fs_u2` (`user2_id`);

--
-- Indexes for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_request` (`sender_id`,`receiver_id`),
  ADD KEY `fk_fr_receiver` (`receiver_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3535ED9783E3463` (`manager_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_recipient_read_time` (`recipient_id`,`is_read`,`created_at`),
  ADD KEY `fk_notif_actor` (`actor_id`),
  ADD KEY `fk_notif_post` (`post_id`),
  ADD KEY `fk_notif_comment` (`comment_id`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_24CC0DF2391C87D5` (`idProduit`),
  ADD KEY `IDX_24CC0DF219EB6921` (`client_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5A8A6C8DF675F31B` (`author_id`),
  ADD KEY `idx_post_feed` (`created_at`);

--
-- Indexes for table `post_reaction`
--
ALTER TABLE `post_reaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_post_user` (`post_id`,`user_id`);

--
-- Indexes for table `post_report`
--
ALTER TABLE `post_report`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_post_reporter` (`post_id`,`reporter_user_id`);

--
-- Indexes for table `post_share`
--
ALTER TABLE `post_share`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_post_user_share` (`post_id`,`user_id`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29A5EC277E3C61F9` (`owner_id`);

--
-- Indexes for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_promo_code_code` (`code`),
  ADD KEY `IDX_3A11F3BBA76ED395` (`user_id`),
  ADD KEY `IDX_3A11F3BB4584665A` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption_request`
--
ALTER TABLE `adoption_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `idAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `disponibilite`
--
ALTER TABLE `disponibilite`
  MODIFY `id_disponibilite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `friendship`
--
ALTER TABLE `friendship`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `post_reaction`
--
ALTER TABLE `post_reaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `post_report`
--
ALTER TABLE `post_report`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post_share`
--
ALTER TABLE `post_share`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `promo_code`
--
ALTER TABLE `promo_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption_request`
--
ALTER TABLE `adoption_request`
  ADD CONSTRAINT `FK_410896EE8E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`idAnimal`);

--
-- Constraints for table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `FK_6AAB231FF0BE1593` FOREIGN KEY (`owner_compte_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9474526CBF2AF943` FOREIGN KEY (`parent_comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `comment_reaction`
--
ALTER TABLE `comment_reaction`
  ADD CONSTRAINT `FK_B99364F1F8697D13` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD CONSTRAINT `FK_2CBACE2F40369CAB` FOREIGN KEY (`vet_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `FK_3535ED9783E3463` FOREIGN KEY (`manager_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_24CC0DF219EB6921` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_24CC0DF2391C87D5` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC277E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD CONSTRAINT `FK_3A11F3BB4584665A` FOREIGN KEY (`product_id`) REFERENCES `produit` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_3A11F3BBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
