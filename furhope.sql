-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2026 at 02:16 PM
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
-- Database: `furhope`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adoption_request`
--

INSERT INTO `adoption_request` (`id`, `request_date`, `status`, `client_id`, `animal_id`) VALUES
(2, '2026-04-06 12:43:00', 'PENDING', 4, 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`idAnimal`, `name`, `species`, `breed`, `age`, `gender`, `description`, `status`, `image`, `owner_compte_id`) VALUES
(1, 'falfoul', 'cat', 'cheraa', 12, 'MALE', 'aaaaaaa', 'AVAILABLE', 'uploads/animals/chat-9d23b4fc8ea1.jpg', 1),
(2, 'sneaker', 'cat', 'siam', 24, 'MALE', NULL, 'AVAILABLE', 'uploads/animals/chattt-3aec22ab4b30.jpg', 4),
(3, 'Milo', 'dog', 'Golden Retriever', 18, 'MALE', 'Friendly young dog who loves fetch, long walks, and staying close to people.', 'AVAILABLE', 'https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&w=1200&q=80', 1),
(4, 'Luna', 'cat', 'British Shorthair', 10, 'FEMALE', 'Calm indoor cat with a sweet personality and a big love for window naps.', 'AVAILABLE', 'https://images.unsplash.com/photo-1511044568932-338cba0ad803?auto=format&fit=crop&w=1200&q=80', 8),
(5, 'Kiwi', 'bird', 'Budgerigar', 6, 'FEMALE', 'Bright and curious little bird that enjoys gentle interaction and a lively perch setup.', 'AVAILABLE', 'https://images.unsplash.com/photo-1444464666168-49d633b86797?auto=format&fit=crop&w=1200&q=80', 1),
(6, 'Coco', 'rabbit', 'Mini Lop', 8, 'FEMALE', 'Soft, quiet rabbit that does best in a calm home with room to hop and explore.', 'PENDING', 'https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?auto=format&fit=crop&w=1200&q=80', 2),
(7, 'Rocky', 'dog', 'Mixed Breed', 30, 'MALE', 'Confident companion with good leash manners and a playful, affectionate nature.', 'ADOPTED', 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=1200&q=80', 1),
(8, 'Nemo', 'fish', 'Clownfish', 12, 'MALE', 'Colorful aquarium fish suitable for a stable tank with attentive daily care.', 'AVAILABLE', 'https://images.unsplash.com/photo-1522069169874-c58ec4b76be5?auto=format&fit=crop&w=1200&q=80', 1);

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
-- Stand-in structure for view `api_post`
-- (See below for the actual view)
--
CREATE TABLE `api_post` (
`id` bigint(20)
,`author_id` int(11)
,`caption` longtext
,`media_type` varchar(10)
,`media_path` varchar(500)
,`thumbnail_path` varchar(500)
,`duration_seconds` int(11)
,`likes_count` int(11)
,`dislikes_count` int(11)
,`shares_count` int(11)
,`comments_count` int(11)
,`visibility` varchar(10)
,`status` varchar(10)
,`created_at` datetime
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `api_user`
-- (See below for the actual view)
--
CREATE TABLE `api_user` (
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
(28, 3, 6, NULL, '12345', 'ACTIVE', '2026-03-05 12:33:23'),
(29, 14, 1, NULL, 'daaaa', 'ACTIVE', '2026-04-06 13:40:51'),
(30, 14, 1, 29, 'daa', 'ACTIVE', '2026-04-06 13:41:01');

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
('DoctrineMigrations\\Version20260321120352', '2026-04-06 12:11:02', 224),
('DoctrineMigrations\\Version20260322110000', '2026-04-06 12:11:02', 96),
('DoctrineMigrations\\Version20260324123000', '2026-04-06 12:11:02', 98);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(43, 5, 6, 'POST_COMMENT', 3, 28, 'New comment on your post', 1, '2026-03-05 12:33:23');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(14, 1, '55555555', 'IMAGE', 'uploads/social/thumb-1920-1267145-69d15910d914f1.32129924.png', NULL, NULL, 0, 0, 0, 2, 'PUBLIC', 'ACTIVE', '2026-04-04 19:31:44', '2026-04-06 11:41:01'),
(15, 1, 'Morning shelter walk with Milo. He stayed close the whole time and made friends with everyone on the path.', 'IMAGE', 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=1200&q=80', NULL, NULL, 12, 0, 2, 1, 'PUBLIC', 'ACTIVE', '2026-04-06 13:12:32', '2026-04-06 12:12:32'),
(16, 2, 'Luna finally claimed the sunny corner by the window. Quiet days like this help shy cats settle in fast.', 'IMAGE', 'https://images.unsplash.com/photo-1511044568932-338cba0ad803?auto=format&fit=crop&w=1200&q=80', NULL, NULL, 8, 0, 1, 0, 'PUBLIC', 'ACTIVE', '2026-04-06 13:12:32', '2026-04-06 12:12:32'),
(17, 3, 'Coco had her habitat refreshed today with fresh hay, chew toys, and extra room to explore.', 'IMAGE', 'https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?auto=format&fit=crop&w=1200&q=80', NULL, NULL, 15, 1, 3, 2, 'PUBLIC', 'ACTIVE', '2026-04-06 13:12:32', '2026-04-06 12:12:32'),
(18, 4, 'Tiny victories matter. Kiwi stepped onto a hand perch for the first time this afternoon.', 'IMAGE', 'https://images.unsplash.com/photo-1444464666168-49d633b86797?auto=format&fit=crop&w=1200&q=80', NULL, NULL, 21, 0, 4, 5, 'PUBLIC', 'ACTIVE', '2026-04-06 13:12:32', '2026-04-06 12:12:32');

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
(32, 2, 5, 'DISLIKE', '2026-03-05 12:34:22');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id`, `title`, `category`, `price`, `tva`, `image`, `description`, `stock`, `owner_id`) VALUES
(1, 'tester11', 'medical', 34, 5, 'uploads/products/tester-2866866ec3ab.jpg', 'AAAA', 87, 1),
(2, 'Calming Paw Balm', 'medical', 14.9, 19, 'https://images.unsplash.com/photo-1583512603806-077998240c7a?auto=format&fit=crop&w=1200&q=80', 'A soothing balm for dry paws and noses, ideal after long walks or hot pavement days.', 25, 1),
(3, 'Reflective Dog Raincoat', 'clothing', 29.5, 19, 'https://images.unsplash.com/photo-1517849845537-4d257902454a?auto=format&fit=crop&w=1200&q=80', 'Lightweight waterproof coat with reflective trim to keep pets dry and visible during rainy walks.', 18, 3),
(4, 'Feather Chase Cat Wand', 'toys', 9.9, 19, 'https://images.unsplash.com/photo-1511044568932-338cba0ad803?auto=format&fit=crop&w=1200&q=80', 'Interactive teaser wand with soft feathers that encourages exercise and playful bonding time.', 40, 1),
(5, 'Grain-Free Puppy Kibble', 'food', 34, 7, 'https://images.unsplash.com/photo-1589924691995-400dc9ecc119?auto=format&fit=crop&w=1200&q=80', 'Nutritious grain-free kibble made for growing puppies, rich in protein and gentle on digestion.', 30, 4),
(6, 'Dental Care Treat Sticks', 'medical', 12.75, 7, 'https://images.unsplash.com/photo-1560743641-3914f2c45636?auto=format&fit=crop&w=1200&q=80', 'Daily chew sticks that help reduce plaque buildup while giving dogs a tasty reward.', 50, 2),
(7, 'Cozy Fleece Pet Hoodie', 'clothing', 24.9, 19, 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=1200&q=80', 'Soft fleece hoodie for chilly mornings with a snug fit and easy pull-on design.', 16, 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` datetime NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `phone_number` varchar(30) DEFAULT NULL,
  `profile_image_url` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(4) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_veteran_applicant` tinyint(4) NOT NULL,
  `is_veteran_approved` tinyint(4) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `roles`, `phone_number`, `profile_image_url`, `is_verified`, `is_active`, `is_veteran_applicant`, `is_veteran_approved`, `updated_at`) VALUES
(1, 'Hamza', 'Benyahia', 'hamza.benyahia@esprit.tn', '$2y$13$FNrM37Ta3fQVP62pILdjJe4EmPkpMaUPNObnHYAJAdcdqnGTV6SdS', '2026-02-14 10:16:04', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '53035155', 'C:\\Users\\safwe\\Desktop\\equipe\\hamza.jpeg', 1, 1, 0, 0, '2026-04-04 20:27:58'),
(2, 'hamza', 'benyahia', 'donniedarko@gmail.com', '$2y$13$e5J1.4e2Hj0MgWmXNhLVkugWAcouOnAHinB5jBSfv8Z9p6jO4xWAe', '2026-02-14 12:14:14', '[\"ROLE_USER\"]', '53035155', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39'),
(3, 'fzef', 'fzaazf', 'hjbhjazdf@gmail.com', '$2y$13$9GZ9Tvyp9d5OeEMmFrH2gu9857BpNbb40W9HFPKb1lE.VGgdzJuuC', '2026-02-14 17:42:14', '[\"ROLE_USER\"]', '74852963', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39'),
(4, 'adem', 'ziri', 'ziriadem33@gmail.com', '$2y$13$2HV5SdwsJ5rp24ZS2Wt3XuXZbkc/UR1cAAEp9PGTjLACnrlWhPCiK', '2026-02-15 12:09:08', '[\"ROLE_USER\"]', '27938446', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39'),
(5, 'zakaria', 'zarouk', 'zarrouk.zakaria@esprit.tn', '$2y$13$Cphy8B/8LAmDbPvYX3sHSuG3gZjFXQBsk5gmYZNTrhJTRjY6i0e6W', '2026-02-15 12:57:54', '[\"ROLE_USER\"]', '74859123', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39'),
(6, 'Safwen', 'Yahyaoui', 'safwenyahyaoui047@gmail.com', '$2y$13$bK9lMOLfaou.Lx24ARpoq.b.TKmymq.CgTjc0q2lsm6V55g9bcpLa', '2026-03-05 05:41:57', '[\"ROLE_USER\"]', '0473821736', 'C:\\Users\\safwe\\Desktop\\equipe\\saf.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39'),
(7, 'Zakaria', 'Zarrouk', 'zakaria.zarrouk@esprit.tn', '$2y$13$v0m5DNnI2EXeTKzUbp0YK.FF2sFzSkZZ3cPcMAQe.r8rz6NNsgYPu', '2026-03-05 11:14:33', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '0473821738', 'C:\\Users\\safwe\\Desktop\\equipe\\zak.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39'),
(8, 'Youssef', 'Tounsi', 'youssef.tounsi@esprit.tn', '$2y$13$xtnmZEuZuSUyZVcNGsuXR.dVKXp0G3VcAEMOF75zxAl6h87dGuF6q', '2026-03-05 11:14:33', '[\"ROLE_USER\"]', '0473821739', 'C:\\Users\\safwe\\Desktop\\equipe\\youssef.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39'),
(9, 'Joumena', 'Turki', 'joumena.turki@esprit.tn', '$2y$13$.hzj1GuXTv9tTK/oaJhTYuxmX3KJwk8L6prA/uIWg0t68dOaBDcMu', '2026-03-05 11:14:33', '[\"ROLE_USER\"]', '0473821740', 'C:\\Users\\safwe\\Desktop\\equipe\\djo.jpeg', 1, 1, 0, 0, '2026-04-06 12:35:05'),
(10, 'Ilef', 'Ben Chouchane', 'ilef.benchouchane@esprit.tn', '$2y$13$CCX.YvSt4TYWiJDrsk6gSuW.5hF.QzcQVebUyXXvsBW1JCPQe1Shi', '2026-03-05 11:14:33', '[\"ROLE_USER\"]', '0473821741', 'C:\\Users\\safwe\\Desktop\\equipe\\ilef.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39'),
(11, 'youssef', 'tounsi', 'youssef.tounsi@gmail.com', '$2y$13$z7YR0XXk1CXtxjyRyoeyD.Qd4nr3qjt3BSeFf9yUxUBwCKTfEQVJe', '2026-04-04 18:52:30', '[]', '15478596', 'uploads/profiles/cv-69d151453da95.png', 0, 1, 0, 0, '2026-04-04 19:58:29');

-- --------------------------------------------------------

--
-- Structure for view `api_comment`
--
DROP TABLE IF EXISTS `api_comment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`safwen`@`localhost` SQL SECURITY DEFINER VIEW `api_comment`  AS SELECT `c`.`id` AS `id`, `c`.`post_id` AS `post_id`, `c`.`author_id` AS `author_id`, `c`.`parent_comment_id` AS `parent_comment_id`, `c`.`body` AS `body`, `c`.`status` AS `status`, `c`.`created_at` AS `created_at` FROM `comment` AS `c` ;

-- --------------------------------------------------------

--
-- Structure for view `api_post`
--
DROP TABLE IF EXISTS `api_post`;

CREATE ALGORITHM=UNDEFINED DEFINER=`safwen`@`localhost` SQL SECURITY DEFINER VIEW `api_post`  AS SELECT `p`.`id` AS `id`, `p`.`author_id` AS `author_id`, `p`.`caption` AS `caption`, `p`.`media_type` AS `media_type`, `p`.`media_path` AS `media_path`, `p`.`thumbnail_path` AS `thumbnail_path`, `p`.`duration_seconds` AS `duration_seconds`, `p`.`likes_count` AS `likes_count`, `p`.`dislikes_count` AS `dislikes_count`, `p`.`shares_count` AS `shares_count`, `p`.`comments_count` AS `comments_count`, `p`.`visibility` AS `visibility`, `p`.`status` AS `status`, `p`.`created_at` AS `created_at`, `p`.`updated_at` AS `updated_at` FROM `post` AS `p` ;

-- --------------------------------------------------------

--
-- Structure for view `api_user`
--
DROP TABLE IF EXISTS `api_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`safwen`@`localhost` SQL SECURITY DEFINER VIEW `api_user`  AS SELECT `u`.`id` AS `id_user`, concat(`u`.`first_name`,' ',`u`.`last_name`) AS `name`, `u`.`email` AS `email`, `u`.`phone` AS `phone`, NULL AS `password_hash`, `u`.`password` AS `password`, `u`.`role` AS `role`, `u`.`active` AS `active`, `u`.`created_at` AS `created_at` FROM `user` AS `u` ;

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
  ADD PRIMARY KEY (`comment_id`,`user_id`);

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
  ADD KEY `idx_post_feed` (`created_at`),
  ADD KEY `IDX_5A8A6C8DF675F31B` (`author_id`);

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
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_42C8495519EB6921` (`client_id`),
  ADD KEY `IDX_42C849558E962C16` (`animal_id`),
  ADD KEY `IDX_42C849553243BB18` (`hotel_id`);

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
  MODIFY `idAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `friendship`
--
ALTER TABLE `friendship`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `post_reaction`
--
ALTER TABLE `post_reaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `post_report`
--
ALTER TABLE `post_report`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post_share`
--
ALTER TABLE `post_share`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`parent_comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_reaction`
--
ALTER TABLE `comment_reaction`
  ADD CONSTRAINT `fk_comment_reaction_comment` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC277E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C8495519EB6921` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_42C849553243BB18` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_42C849558E962C16` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`idAnimal`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
