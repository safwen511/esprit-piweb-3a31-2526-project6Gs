-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2026 at 08:32 PM
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
-- Database: `integration`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoptionrequest`
--

CREATE TABLE `adoptionrequest` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `client_compte_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoptionrequest`
--

INSERT INTO `adoptionrequest` (`id`, `animal_id`, `client_compte_id`, `message`, `phone`, `address`, `status`, `created_at`) VALUES
(1, 8, 8, 'please give me this dog', '24558193', 'dummy address', 'PENDING', '2026-03-05 13:32:19'),
(2, 8, 8, 'Custom adoption request', '20101010', 'Tunis', 'APPROVED', '2026-02-15 08:22:06'),
(3, 8, 9, 'Custom adoption request', '20101010', 'Tunis', 'PENDING', '2026-02-19 17:57:25'),
(4, 3, 6, 'Custom adoption request', '20101010', 'Tunis', 'APPROVED', '2026-02-15 14:50:09'),
(5, 2, 6, 'Custom adoption request', '20101010', 'Tunis', 'APPROVED', '2026-02-14 14:03:26'),
(6, 8, 6, 'hiehhioz', '473821740', 'dummy address', 'PENDING', '2026-03-05 11:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `adoption_request`
--

CREATE TABLE `adoption_request` (
  `id` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('PENDING','APPROVED','REJECTED') DEFAULT 'PENDING',
  `animal_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption_request`
--

INSERT INTO `adoption_request` (`id`, `request_date`, `status`, `animal_id`, `client_id`) VALUES
(1, '2026-03-05 13:32:19', 'PENDING', 8, 8),
(2, '2026-02-15 08:22:06', 'APPROVED', 8, 8),
(3, '2026-02-19 17:57:25', 'PENDING', 8, 9),
(4, '2026-02-15 14:50:09', 'APPROVED', 3, 6);

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
  `gender` enum('MALE','FEMALE') DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('AVAILABLE','ADOPTED','UNAVAILABLE') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `owner_compte_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`idAnimal`, `name`, `species`, `breed`, `age`, `gender`, `description`, `status`, `image`, `owner_compte_id`) VALUES
(2, 'azezae', 'dog', 'husky', 545, 'FEMALE', 'This female husky dog named azezae is 545 years old and very friendly.\nThis female dog is gentle, loyal and calm and waiting for a loving adopter.', 'AVAILABLE', NULL, 1),
(3, 'Nala', 'Dog', 'Labrador', 1, 'MALE', 'Custom seeded pet Nala', 'ADOPTED', 'seed_animal_1.jpg', 5),
(4, 'Milo', 'Cat', 'Siamese', 2, 'FEMALE', 'Custom seeded pet Milo', 'AVAILABLE', 'seed_animal_2.jpg', 5),
(5, 'Luna', 'Dog', 'Labrador', 3, 'MALE', 'Custom seeded pet Luna', 'AVAILABLE', 'seed_animal_3.jpg', 6),
(6, 'Rocky', 'Cat', 'Siamese', 4, 'FEMALE', 'Custom seeded pet Rocky', 'AVAILABLE', 'seed_animal_4.jpg', 6),
(7, 'Bella', 'Dog', 'Labrador', 5, 'MALE', 'Custom seeded pet Bella', 'AVAILABLE', 'seed_animal_5.jpg', 3),
(8, 'Leo', 'Cat', 'Siamese', 6, 'FEMALE', 'Custom seeded pet Leo', 'ADOPTED', 'seed_animal_6.jpg', 5),
(9, 'Simba', 'Dog', 'Labrador', 1, 'MALE', 'Custom seeded pet Simba', 'AVAILABLE', 'seed_animal_7.jpg', 6),
(10, 'Max', 'Cat', 'Siamese', 2, 'FEMALE', 'Custom seeded pet Max', 'AVAILABLE', 'seed_animal_8.jpg', 6),
(11, 'kiki', 'Cat', 'Ragdoll', 8, 'FEMALE', 'kiki is a wonderful Ragdoll cat. At 8 years old, this female is ready to join a caring family.\nThis female cat is calm, sweet and comforting and waiting for a loving adopter.', 'AVAILABLE', '1772711058066_cat.jpg', 6);

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
,`body` text
,`status` enum('ACTIVE','HIDDEN','DELETED')
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `api_post`
-- (See below for the actual view)
--
CREATE TABLE `api_post` (
`id` bigint(20)
,`author_id` int(11)
,`caption` text
,`media_type` enum('NONE','IMAGE','VIDEO')
,`media_path` varchar(500)
,`thumbnail_path` varchar(500)
,`duration_seconds` int(11)
,`likes_count` int(11)
,`dislikes_count` int(11)
,`shares_count` int(11)
,`comments_count` int(11)
,`visibility` enum('PUBLIC','FRIENDS','PRIVATE')
,`status` enum('ACTIVE','HIDDEN','DELETED')
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `api_user`
-- (See below for the actual view)
--
CREATE TABLE `api_user` (
`id_user` int(11)
,`name` varchar(241)
,`email` varchar(180)
,`phone` varchar(20)
,`password_hash` binary(0)
,`password` varchar(255)
,`role` varchar(20)
,`active` tinyint(1)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `client_gestion`
--

CREATE TABLE `client_gestion` (
  `id` int(11) NOT NULL,
  `full_name` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `city` varchar(80) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_gestion`
--

INSERT INTO `client_gestion` (`id`, `full_name`, `email`, `phone`, `city`, `status`) VALUES
(1, 'Safwen Yahyaoui', 'safwenyahyaoui047@gmail.com', '0473821736', 'Tunis', 'ACTIVE'),
(2, 'Youssef Tounsi', 'Youssef.Tounsi@esprit.tn', '0473821736', 'Tunis', 'ACTIVE'),
(3, 'Joumena Turki', 'joumena.turki@esprit.tn', '0473821736', 'Sfax', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `author_id` int(11) NOT NULL,
  `parent_comment_id` bigint(20) DEFAULT NULL,
  `body` text NOT NULL,
  `status` enum('ACTIVE','HIDDEN','DELETED') NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `author_id`, `parent_comment_id`, `body`, `status`, `created_at`) VALUES
(6, 1, 6, NULL, 'hii', 'ACTIVE', '2026-03-05 04:42:34'),
(17, 1, 6, NULL, 'aaaa', 'ACTIVE', '2026-03-05 07:39:33'),
(18, 1, 5, 6, 'dzdzd', 'ACTIVE', '2026-03-05 07:39:59'),
(19, 1, 6, 18, 'eaze', 'ACTIVE', '2026-03-05 07:40:53'),
(20, 2, 7, NULL, 'Custom comment 1', 'ACTIVE', '2026-02-10 09:11:25'),
(21, 3, 1, NULL, 'Custom comment 2', 'ACTIVE', '2026-02-13 12:44:33'),
(22, 1, 9, NULL, 'Custom comment 3', 'ACTIVE', '2026-03-01 16:54:05'),
(23, 3, 1, NULL, 'Custom comment 4', 'ACTIVE', '2026-02-05 18:09:01'),
(24, 4, 7, NULL, 'Custom comment 5', 'ACTIVE', '2026-02-04 15:59:46'),
(25, 3, 8, NULL, 'Custom comment 6', 'ACTIVE', '2026-03-05 11:16:22'),
(26, 5, 6, NULL, 'hello', 'ACTIVE', '2026-03-05 11:33:01'),
(27, 5, 6, 26, 'hi', 'ACTIVE', '2026-03-05 11:33:06'),
(28, 3, 6, NULL, '12345', 'ACTIVE', '2026-03-05 11:33:23');

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
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `id_compte` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('CLIENT','ADMIN','MANAGER','VET','HOTEL') NOT NULL,
  `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`id_compte`, `user_id`, `username`, `password`, `role`, `status`) VALUES
(1, 5, 'zarrouk.zakaria@esprit.tn', '', 'VET', 'ACTIVE'),
(2, 1, 'hamza', '0473821736sS', 'ADMIN', 'ACTIVE'),
(3, 6, 'saf', '0473821736sS', 'CLIENT', 'ACTIVE'),
(4, 7, 'zak', '0473821736sS', 'ADMIN', 'ACTIVE'),
(5, 8, 'youssef', '0473821736sS', 'CLIENT', 'ACTIVE'),
(6, 9, 'djo', '0473821736sS', 'CLIENT', 'ACTIVE'),
(7, 10, 'ilef', '0473821736s', 'VET', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `disponibilite`
--

CREATE TABLE `disponibilite` (
  `id_disponibilite` int(11) NOT NULL,
  `vet_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disponibilite`
--

INSERT INTO `disponibilite` (`id_disponibilite`, `vet_id`, `start_time`, `end_time`, `is_available`) VALUES
(1, 10, '09:00:00', '10:30:00', 1),
(2, 10, '10:00:00', '11:30:00', 1),
(3, 10, '11:00:00', '12:30:00', 1),
(4, 10, '12:00:00', '13:30:00', 1),
(5, 10, '08:00:00', '10:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `id` bigint(20) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`id`, `user1_id`, `user2_id`, `created_at`) VALUES
(1, 2, 3, '2026-03-01 21:06:54'),
(2, 1, 2, '2026-03-02 05:03:54'),
(3, 1, 5, '2026-03-03 21:21:23'),
(4, 5, 6, '2026-03-05 04:43:13'),
(5, 1, 6, '2026-02-01 08:31:52'),
(6, 6, 7, '2026-01-29 14:24:51'),
(7, 6, 8, '2026-02-07 10:33:51'),
(8, 6, 9, '2026-01-05 18:29:10'),
(9, 6, 10, '2026-01-23 08:00:26'),
(10, 1, 7, '2026-02-08 18:16:53'),
(11, 8, 9, '2026-03-05 10:20:37'),
(12, 7, 9, '2026-03-05 11:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE `friend_request` (
  `id` bigint(20) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `status` enum('PENDING','ACCEPTED','DECLINED','CANCELLED') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`id`, `sender_id`, `receiver_id`, `status`, `created_at`) VALUES
(1, 3, 2, 'ACCEPTED', '2026-03-01 21:06:19'),
(2, 1, 2, 'ACCEPTED', '2026-03-02 05:03:54'),
(3, 1, 5, 'DECLINED', '2026-03-03 21:20:03'),
(4, 5, 1, 'ACCEPTED', '2026-03-03 21:21:04'),
(5, 5, 3, 'PENDING', '2026-03-05 02:34:44'),
(6, 6, 5, 'ACCEPTED', '2026-03-05 04:42:44'),
(7, 6, 1, 'ACCEPTED', '2026-02-08 08:51:06'),
(8, 6, 7, 'ACCEPTED', '2026-02-27 16:30:42'),
(9, 6, 8, 'ACCEPTED', '2026-02-19 12:08:46'),
(10, 6, 9, 'ACCEPTED', '2026-02-24 09:52:53'),
(11, 8, 9, 'ACCEPTED', '2026-03-05 10:20:19'),
(12, 9, 7, 'ACCEPTED', '2026-03-05 11:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `address`, `manager_id`, `capacity`, `created_at`) VALUES
(1, 'Conrad', '102 North End Avenue, New York', 1, 0, '2026-03-02 06:44:41'),
(2, 'The Frederick Hotel', 'New York', 1, 0, '2026-03-02 06:44:41'),
(3, 'Latham', '4 East 28th Street, New York', 1, 0, '2026-03-02 06:44:42'),
(4, 'Mandarin Oriental', '80 Columbus Circle, New York', 1, 0, '2026-03-02 06:44:42'),
(5, 'The Standard, East Village', '25 Cooper Square, New York', 1, 0, '2026-03-02 06:44:42'),
(6, 'Tempo by Hilton New York Times Square', '1568 Broadway, New York', 1, 0, '2026-03-02 06:44:43'),
(7, 'Clarion Hotel Park Avenue', 'New York', 1, 0, '2026-03-02 06:44:43'),
(8, 'Fitzpatrick Grand Central Hotel', '141 East 44th Street, New York', 1, 0, '2026-03-02 06:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `manager_account`
--

CREATE TABLE `manager_account` (
  `id` bigint(20) NOT NULL,
  `manager_id` varchar(64) NOT NULL,
  `display_name` varchar(128) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_salt` varchar(255) NOT NULL,
  `password_iterations` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager_account`
--

INSERT INTO `manager_account` (`id`, `manager_id`, `display_name`, `password_hash`, `password_salt`, `password_iterations`, `is_active`, `created_at`) VALUES
(1, 'seed_manager_1', 'Seed Manager', 'seed_hash', 'seed_salt', 12000, 1, '2026-03-05 10:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint(20) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `type` enum('POST_LIKE','POST_DISLIKE','POST_COMMENT','COMMENT_REPLY','COMMENT_LIKE') NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `comment_id` bigint(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `recipient_id`, `actor_id`, `type`, `post_id`, `comment_id`, `message`, `is_read`, `created_at`) VALUES
(33, 1, 6, 'POST_COMMENT', 11, NULL, 'commented on your post', 0, '2026-03-05 10:15:30'),
(34, 8, 7, 'POST_LIKE', 10, NULL, 'liked your post', 1, '2026-03-05 10:15:30'),
(35, 7, 8, 'POST_LIKE', 9, NULL, 'liked your post', 1, '2026-03-05 10:15:30'),
(36, 1, 9, 'POST_COMMENT', 8, NULL, 'commented on your post', 1, '2026-03-05 10:15:30'),
(37, 6, 10, 'POST_LIKE', 6, NULL, 'liked your post', 0, '2026-03-05 10:15:30'),
(38, 6, 1, 'POST_LIKE', 5, NULL, 'liked your post', 1, '2026-03-05 10:15:30'),
(39, 5, 6, 'POST_COMMENT', 4, NULL, 'commented on your post', 0, '2026-03-05 10:15:30'),
(40, 5, 7, 'POST_LIKE', 3, NULL, 'liked your post', 1, '2026-03-05 10:15:30'),
(41, 5, 8, 'POST_LIKE', 2, NULL, 'liked your post', 1, '2026-03-05 10:15:30'),
(42, 4, 9, 'POST_COMMENT', 1, NULL, 'commented on your post', 1, '2026-03-05 10:15:30'),
(43, 5, 6, 'POST_COMMENT', 3, 28, 'New comment on your post', 1, '2026-03-05 11:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `total_amount` double NOT NULL,
  `transaction_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `customer_email`, `total_amount`, `transaction_id`) VALUES
(1, '2026-03-03 23:28:27.776424', 'safwenyahyaoui047@gmail.com', 20, '498c0b6a-84b5-4b8f-80fd-8edf6566a49b'),
(2, '2026-03-04 23:37:53.091137', 'safwenyahyaoui047@gmail.com', 49.41, '52af70ec-6f58-4e4f-8944-f15256bdd40d'),
(3, '2026-03-04 23:44:42.538632', 'safwenyahyaoui047@gmail.com', 22.5, '563f77a7-b1ca-44dc-97e5-582127d694e8'),
(4, '2026-03-04 23:50:33.841669', 'safwenyahyaoui047@gmail.com', 22.5, '3bd5851b-aac0-458c-8cf3-a692f1bf48a5'),
(5, '2026-03-05 12:30:09.414965', 'youssef.tounsi@esprit.tn', 30.73, 'a60d2f46-491c-412d-920f-74e610c9c49d');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `totalP` double NOT NULL,
  `totalt` double NOT NULL,
  `qty` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`id`, `idProduit`, `title`, `totalP`, `totalt`, `qty`, `client_id`) VALUES
(20, 12, 'Comfort Carrier', 72, 6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_type` varchar(31) NOT NULL,
  `id` bigint(20) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `confirmation_code` varchar(255) DEFAULT NULL,
  `confirmation_expires_at` datetime(6) DEFAULT NULL,
  `created_at` datetime(6) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `provider_name` varchar(32) DEFAULT NULL,
  `provider_payment_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_type`, `id`, `amount`, `confirmation_code`, `confirmation_expires_at`, `created_at`, `customer_email`, `customer_name`, `status`, `transaction_id`, `provider_name`, `provider_payment_id`) VALUES
('CARD', 2, 20.00, '302220', '2026-03-03 23:00:50.945252', '2026-03-03 22:50:50.945252', 'smoke@example.com', 'Smoke User', 'PENDING', 'd6eec768-b749-4483-a66d-55f303c4065d', NULL, NULL),
('PAYPAL', 3, 64.80, '619046', '2026-03-03 23:05:05.330381', '2026-03-03 22:55:05.330381', 'safwenyahyaoui047@gmail.com', 'safwen', 'PENDING', 'ef7cbf5d-8a09-4443-9d32-00d953529f2d', NULL, NULL),
('PAYPAL', 4, 35.91, '512958', '2026-03-04 21:30:10.526720', '2026-03-04 21:20:10.526720', 'safwenyahyaoui047@gmail.com', 'safwen', 'PENDING', '4374926f-22af-4291-97d5-832694656dd0', NULL, NULL),
('STRIPE', 5, 49.41, NULL, NULL, '2026-03-04 22:26:50.760331', 'safwenyahyaoui047@gmail.com', 'safwen', 'PENDING', 'ab602d64-48a6-4a27-84ae-71f0d65d4723', 'STRIPE', 'cs_test_a193sQkaID9JT4PFjCwx68RDeDLUtGHC8xMwl7WI99EHcMYo7lrokL89sB'),
('STRIPE', 6, 49.41, NULL, NULL, '2026-03-04 22:30:14.390936', 'safwenyahyaoui047@gmail.com', 'safwen', 'PENDING', '55c1539f-fbe4-4145-9698-e1803e8528e1', 'STRIPE', 'cs_test_a1CtEEQSnWEczAdeMGYEP34XdB6ZzYknYi1Iil5BhN1UEpjO0iL80KBFYf'),
('STRIPE', 7, 49.41, NULL, NULL, '2026-03-04 22:33:44.031512', 'safwenyahyaoui047@gmail.com', 'safwen', 'PENDING', '8043c0b1-66a7-4aba-b10a-2a1dfc59aa37', 'STRIPE', 'cs_test_a1BN4yAsWYM8TvmjR898h6DepSL22TAfNnGdx9ogLAXCXIerCjbIQ2HxdD'),
('STRIPE', 8, 49.41, NULL, NULL, '2026-03-04 22:37:22.338799', 'safwenyahyaoui047@gmail.com', 'safwen', 'SUCCESS', '52af70ec-6f58-4e4f-8944-f15256bdd40d', 'STRIPE', 'cs_test_a1w8b1LYES4iM2vzcagYiNlYx0di2ezFmA7zRc22yJVMYeTZQez1mOS61d'),
('STRIPE', 9, 22.50, NULL, NULL, '2026-03-04 22:43:52.378835', 'safwenyahyaoui047@gmail.com', 'safwen', 'SUCCESS', '563f77a7-b1ca-44dc-97e5-582127d694e8', 'STRIPE', 'cs_test_a1WK3KV5Rcwuj9OKFpT4J1eHeES4Yr6Mr0hEBzixtQZSeP73VILfMpQFxV'),
('STRIPE', 10, 22.50, NULL, NULL, '2026-03-04 22:49:09.781254', 'safwenyahyaoui047@gmail.com', 'safwen', 'SUCCESS', '3bd5851b-aac0-458c-8cf3-a692f1bf48a5', 'STRIPE', 'cs_test_a1A8DaTzXw1cQUUgGftNp7l4uHZN7CbPacsZWjNlKP2BVDreJzED0udHau'),
('STRIPE', 11, 445.41, NULL, NULL, '2026-03-05 10:07:01.603176', 'safwenyahyaoui047@gmail.com', 'safwen', 'PENDING', '049c5d37-cd2d-4390-96b9-99be352d9f89', 'STRIPE', 'cs_test_a1VU4wtcg4PgAQKxuY9rsNKDVF44JkN63f6gAv44bedCyZJEneN2fyGJnt'),
('PAYPAL', 12, 30.73, '499810', '2026-03-05 11:37:21.295966', '2026-03-05 11:27:21.295966', 'yousse.tounsi@esprit.tn', 'YOUSSEF', 'PENDING', '61a93630-c0d2-40fe-a4e2-0a3f6dba34fa', NULL, NULL),
('PAYPAL', 13, 30.73, NULL, NULL, '2026-03-05 11:28:29.177493', 'youssef.tounsi@esprit.tn', 'YOUSSEF', 'SUCCESS', 'a60d2f46-491c-412d-920f-74e610c9c49d', NULL, NULL),
('STRIPE', 14, 64.80, NULL, NULL, '2026-03-05 11:39:57.806297', 'safwenyahyaoui047@gmail.com', 'safwen', 'PENDING', '086623b4-9ad0-420a-912a-95a25065b99a', 'STRIPE', 'cs_test_a1M96sOTvjSRjqucKBGnh4dpfKPDSaTtehbPD02OJuQWB7qgi4swVeHz92');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(20) NOT NULL,
  `author_id` int(11) NOT NULL,
  `caption` text DEFAULT NULL,
  `media_type` enum('NONE','IMAGE','VIDEO') NOT NULL DEFAULT 'NONE',
  `media_path` varchar(500) DEFAULT NULL,
  `thumbnail_path` varchar(500) DEFAULT NULL,
  `duration_seconds` int(11) DEFAULT NULL,
  `likes_count` int(11) NOT NULL DEFAULT 0,
  `dislikes_count` int(11) NOT NULL DEFAULT 0,
  `shares_count` int(11) NOT NULL DEFAULT 0,
  `comments_count` int(11) NOT NULL DEFAULT 0,
  `visibility` enum('PUBLIC','FRIENDS','PRIVATE') NOT NULL DEFAULT 'PUBLIC',
  `status` enum('ACTIVE','HIDDEN','DELETED') NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `author_id`, `caption`, `media_type`, `media_path`, `thumbnail_path`, `duration_seconds`, `likes_count`, `dislikes_count`, `shares_count`, `comments_count`, `visibility`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'test integration', 'IMAGE', 'C:\\Users\\safwe\\Downloads\\myimg.jpeg', NULL, NULL, 1, 0, 0, 5, 'PUBLIC', 'ACTIVE', '2026-03-02 07:42:21', '2026-03-05 10:14:33'),
(2, 5, 'private post', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot 2024-10-07 093130.png', NULL, NULL, 1, 1, 0, 1, 'PRIVATE', 'ACTIVE', '2026-03-05 02:43:56', '2026-03-05 11:34:26'),
(3, 5, 'davaieee', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot 2025-11-23 171357.png', NULL, NULL, 1, 0, 1, 4, 'FRIENDS', 'ACTIVE', '2026-03-05 02:44:25', '2026-03-05 11:33:23'),
(4, 5, 'eazeaz', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot 2024-10-11 103436.png', NULL, NULL, 1, 0, 2, 1, 'PRIVATE', 'ACTIVE', '2026-03-05 04:15:58', '2026-03-05 10:15:30'),
(5, 6, 'ezeze', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot (1).png', NULL, NULL, 0, 1, 1, 2, 'PRIVATE', 'ACTIVE', '2026-03-05 04:59:16', '2026-03-05 11:33:06'),
(6, 6, 'ayo', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot 2025-05-12 143251.png', NULL, NULL, 1, 0, 1, 0, 'PUBLIC', 'ACTIVE', '2026-03-05 06:58:28', '2026-03-05 10:14:33'),
(8, 1, 'First walk of the day with my pet.', 'NONE', NULL, NULL, NULL, 1, 0, 0, 0, 'PUBLIC', 'ACTIVE', '2026-02-10 07:05:21', '2026-03-05 10:15:30'),
(9, 7, 'Healthy breakfast for my companion.', 'NONE', NULL, NULL, NULL, 1, 0, 0, 0, 'PUBLIC', 'ACTIVE', '2026-02-02 14:52:39', '2026-03-05 10:15:30'),
(10, 8, 'Adoption weekend update from FurHope.', 'NONE', NULL, NULL, NULL, 1, 0, 1, 0, 'PUBLIC', 'ACTIVE', '2026-02-12 07:18:57', '2026-03-05 10:15:30'),
(11, 1, 'Vet check completed and all good.', 'NONE', NULL, NULL, NULL, 0, 1, 0, 0, 'PUBLIC', 'ACTIVE', '2026-02-03 11:17:10', '2026-03-05 10:15:30'),
(12, 9, 'azeazezae', 'NONE', NULL, NULL, NULL, 0, 0, 0, 0, 'PUBLIC', 'ACTIVE', '2026-03-05 10:17:10', NULL),
(13, 6, 'eze', 'IMAGE', 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot (1).png', NULL, NULL, 0, 0, 0, 0, 'FRIENDS', 'ACTIVE', '2026-03-05 11:32:35', NULL),
(14, 1, '55555555', 'IMAGE', 'uploads/social/thumb-1920-1267145-69d15910d914f1.32129924.png', NULL, NULL, 0, 1, 0, 0, 'PUBLIC', 'ACTIVE', '2026-04-04 18:31:44', '2026-04-04 18:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `post_reaction`
--

CREATE TABLE `post_reaction` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `reaction` enum('LIKE','DISLIKE') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_reaction`
--

INSERT INTO `post_reaction` (`id`, `post_id`, `user_id`, `reaction`, `created_at`) VALUES
(22, 11, 1, 'DISLIKE', '2026-03-05 10:15:30'),
(23, 10, 6, 'LIKE', '2026-03-05 10:15:30'),
(24, 9, 7, 'LIKE', '2026-03-05 10:15:30'),
(25, 8, 8, 'LIKE', '2026-03-05 10:15:30'),
(26, 6, 9, 'LIKE', '2026-03-05 10:15:30'),
(27, 5, 10, 'DISLIKE', '2026-03-05 10:15:30'),
(28, 4, 1, 'LIKE', '2026-03-05 10:15:30'),
(29, 3, 6, 'LIKE', '2026-03-05 10:15:30'),
(30, 2, 7, 'LIKE', '2026-03-05 10:15:30'),
(31, 1, 8, 'LIKE', '2026-03-05 10:15:30'),
(32, 2, 5, 'DISLIKE', '2026-03-05 11:34:22'),
(33, 14, 1, 'DISLIKE', '2026-04-04 18:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `post_report`
--

CREATE TABLE `post_report` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `reporter_user_id` bigint(20) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_report`
--

INSERT INTO `post_report` (`id`, `post_id`, `reporter_user_id`, `reason`, `created_at`) VALUES
(1, 17, 1, 'bad', '2026-02-28 22:38:49'),
(2, 17, 2, 'bad', '2026-02-28 22:48:48'),
(3, 23, 1, 'integration-check', '2026-03-02 05:03:28'),
(4, 3, 6, 'aaa', '2026-03-05 07:26:39'),
(5, 1, 8, 'Spam', '2026-02-26 13:20:10'),
(6, 2, 6, 'Spam', '2026-03-02 16:01:29'),
(7, 4, 10, 'Spam', '2026-02-26 13:18:05'),
(8, 1, 7, 'Spam', '2026-02-21 16:59:04'),
(9, 2, 7, 'Spam', '2026-02-26 08:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `post_share`
--

CREATE TABLE `post_share` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_share`
--

INSERT INTO `post_share` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(4, 23, 1, '2026-03-02 05:03:28'),
(5, 6, 1, '2026-02-20 10:37:38'),
(6, 4, 7, '2026-02-25 10:00:15'),
(7, 4, 6, '2026-03-01 10:45:28'),
(8, 3, 7, '2026-03-03 07:27:24'),
(9, 5, 6, '2026-02-14 18:28:49'),
(10, 10, 10, '2026-03-03 11:38:53');

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
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id`, `title`, `category`, `price`, `tva`, `image`, `description`, `stock`) VALUES
(5, 'Medical Care Kit', 'medical', 39.9, 4.5, 'pet-medical.png', 'First-aid essentials for minor pet care emergencies.', 302),
(6, 'Accessory Pack', 'medical', 15, 1.5, 'pet-accessory.png', 'Leash, bowl, and grooming accessories in one pack.', 69),
(9, 'Pet Food Premium', 'medical', 25, 3, 'pet-food.png', 'Healthy dry food with balanced vitamins for daily nutrition.', 60),
(10, 'Interactive Pet Toy', 'medical', 18.5, 2, 'pet-toy.png', 'Soft, durable toy for playtime and mental stimulation.', 45),
(11, 'aze', 'medical', 45245, 4545, 'C:\\Users\\safwe\\Pictures\\Screenshots\\screen.png', 'hgfhf', 57),
(12, 'Comfort Carrier', 'medical', 72, 6, 'pet-carrier.png', 'Travel carrier with ventilation and reinforced frame.', 21),
(13, 'eaze', 'medical', 455, 454, 'C:\\Users\\safwe\\Pictures\\Screenshots\\Screenshot 2024-10-07 094155.png', 'def', 54),
(14, 'Seed Product 1', 'medical', 10, 19, 'seed_prod_1.jpg', 'Custom seeded product', 22),
(15, 'Seed Product 2', 'medical', 13, 19, 'seed_prod_2.jpg', 'Custom seeded product', 24),
(16, 'Seed Product 3', 'medical', 16, 19, 'seed_prod_3.jpg', 'Custom seeded product', 24),
(17, 'aaaaa', 'clothing', 5, 1, 'uploads/products/aaaaa-fea8a9d82a52.jpg', '5654', 2);

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount_percent` double NOT NULL,
  `expiration_date` datetime(6) NOT NULL,
  `usage_limit` int(11) NOT NULL,
  `used_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `code`, `discount_percent`, `expiration_date`, `usage_limit`, `used_count`) VALUES
(1, 'azerty', 10, '2026-04-02 23:27:14.907832', 100, 12),
(2, 'SEED100', 5, '2026-03-25 11:14:33.833000', 50, 0),
(3, 'SEED101', 7, '2026-04-04 11:14:33.833000', 50, 1),
(4, 'SEED102', 9, '2026-04-14 11:14:33.835000', 50, 2),
(5, 'SEED103', 11, '2026-04-24 11:14:33.836000', 50, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reclamation`
--

CREATE TABLE `reclamation` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `sujet` varchar(180) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'OPEN',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reclamation`
--

INSERT INTO `reclamation` (`id`, `client_id`, `sujet`, `description`, `status`, `created_at`) VALUES
(2, 2, 'test', 'i have problem', 'OPEN', '2026-02-15 08:55:49'),
(3, 1, 'problemtechnique', 'there is problems in your website pleasecheck', 'OPEN', '2026-02-15 11:59:29'),
(4, 8, 'Custom issue 1', 'Custom seeded complaint', 'OPEN', '2026-03-04 09:11:06'),
(5, 8, 'Custom issue 2', 'Custom seeded complaint', 'OPEN', '2026-02-27 10:29:30'),
(6, 9, 'Custom issue 3', 'Custom seeded complaint', 'OPEN', '2026-02-15 16:54:51'),
(7, 9, 'Custom issue 4', 'Custom seeded complaint', 'OPEN', '2026-03-01 16:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `id_rdv` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` varchar(30) DEFAULT 'pending',
  `description` text DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `vet_id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `disponibilite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rendezvous`
--

INSERT INTO `rendezvous` (`id_rdv`, `appointment_date`, `appointment_time`, `status`, `description`, `client_id`, `vet_id`, `animal_id`, `disponibilite_id`) VALUES
(1, '2026-03-06', '10:00:00', 'pending', 'Custom seeded rendezvous', 8, 10, 7, 1),
(2, '2026-03-07', '11:00:00', 'pending', 'Custom seeded rendezvous', 9, 10, 6, 1),
(3, '2026-03-08', '12:00:00', 'pending', 'Custom seeded rendezvous', 9, 10, 7, 1),
(4, '2026-03-09', '13:00:00', 'pending', 'Custom seeded rendezvous', 6, 10, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `reclamation_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender_id` int(11) DEFAULT NULL,
  `sender_type` varchar(16) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reponse`
--

INSERT INTO `reponse` (`id`, `reclamation_id`, `admin_id`, `message`, `created_at`, `sender_id`, `sender_type`, `rating`) VALUES
(1, 2, 1, 'dear user we will look into the problems', '2026-02-15 08:57:09', 1, 'ADMIN', NULL),
(2, 2, 7, 'Custom seeded reply', '2026-02-24 15:00:43', 1, 'ADMIN', 4),
(3, 7, 7, 'Custom seeded reply', '2026-02-25 14:46:03', 7, 'ADMIN', 4),
(4, 6, 1, 'Custom seeded reply', '2026-02-24 12:04:14', 1, 'ADMIN', 4),
(5, 2, 7, 'Custom seeded reply', '2026-02-28 12:50:20', 7, 'ADMIN', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(16) NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reservation_date` date NOT NULL,
  `guest_count` int(11) NOT NULL DEFAULT 1,
  `nightly_rate` decimal(10,2) NOT NULL DEFAULT 85.00,
  `total_price` decimal(10,2) NOT NULL DEFAULT 85.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `client_id`, `animal_id`, `hotel_id`, `start_date`, `end_date`, `status`, `created_at`, `reservation_date`, `guest_count`, `nightly_rate`, `total_price`) VALUES
(1, 4, 2, 8, '2026-03-06', '2026-03-18', 'PENDING', '2026-03-05 09:55:01', '2026-03-05', 1, 189.00, 2869.08);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `vet_id` int(11) NOT NULL,
  `rdv_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `client_id`, `vet_id`, `rdv_id`, `rating`, `commentaire`, `created_at`) VALUES
(1, 8, 10, 2, 4, 'Custom seeded review', '2026-03-03 07:13:39'),
(2, 8, 10, 1, 5, 'Custom seeded review', '2026-02-25 13:33:54'),
(3, 8, 10, 4, 4, 'Custom seeded review', '2026-03-02 18:32:09');

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
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `profile_image_path` varchar(1024) DEFAULT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `phone_number` varchar(30) DEFAULT NULL,
  `profile_image_url` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_veteran_applicant` tinyint(1) NOT NULL DEFAULT 0,
  `is_veteran_approved` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `city`, `role`, `active`, `created_at`, `id_user`, `name`, `profile_image_path`, `roles`, `phone_number`, `profile_image_url`, `is_verified`, `is_active`, `is_veteran_applicant`, `is_veteran_approved`, `updated_at`) VALUES
(1, 'Hamza', 'Benyahia', 'hamza.benyahia@esprit.tn', '$2y$13$FNrM37Ta3fQVP62pILdjJe4EmPkpMaUPNObnHYAJAdcdqnGTV6SdS', '53035155', 'Tunis', 'Tunis', 'ADMIN', 1, '2026-02-14 09:16:04', 1, 'Hamza Benyahia', 'C:\\Users\\safwe\\Desktop\\equipe\\hamza.jpeg', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '53035155', 'C:\\Users\\safwe\\Desktop\\equipe\\hamza.jpeg', 1, 1, 0, 0, '2026-04-04 20:27:58'),
(2, 'hamza', 'benyahia', 'donniedarko@gmail.com', '$2y$13$e5J1.4e2Hj0MgWmXNhLVkugWAcouOnAHinB5jBSfv8Z9p6jO4xWAe', '53035155', '23ruedeliberte', 'megrine', 'VETERINAIRE', 1, '2026-02-14 11:14:14', 2, 'hamza benyahia', NULL, '[\"ROLE_USER\"]', '53035155', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39'),
(3, 'fzef', 'fzaazf', 'hjbhjazdf@gmail.com', '$2y$13$9GZ9Tvyp9d5OeEMmFrH2gu9857BpNbb40W9HFPKb1lE.VGgdzJuuC', '74852963', 'zarrouk', 'zak', 'VETERINAIRE', 1, '2026-02-14 16:42:14', 3, 'fzef fzaazf', NULL, '[\"ROLE_USER\"]', '74852963', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39'),
(4, 'adem', 'ziri', 'ziriadem33@gmail.com', '$2y$13$2HV5SdwsJ5rp24ZS2Wt3XuXZbkc/UR1cAAEp9PGTjLACnrlWhPCiK', '27938446', '23rueelbassa', 'haydrebek', 'VETERINAIRE', 1, '2026-02-15 11:09:08', 4, 'adem ziri', NULL, '[\"ROLE_USER\"]', '27938446', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39'),
(5, 'zakaria', 'zarouk', 'zarrouk.zakaria@esprit.tn', '$2y$13$Cphy8B/8LAmDbPvYX3sHSuG3gZjFXQBsk5gmYZNTrhJTRjY6i0e6W', '74859123', 'nahjelkouki', 'houkouma', 'VETERINAIRE', 1, '2026-02-15 11:57:54', 5, 'zakaria zarouk', NULL, '[\"ROLE_USER\"]', '74859123', NULL, 1, 1, 0, 0, '2026-04-04 20:26:39'),
(6, 'Safwen', 'Yahyaoui', 'safwenyahyaoui047@gmail.com', '$2y$13$bK9lMOLfaou.Lx24ARpoq.b.TKmymq.CgTjc0q2lsm6V55g9bcpLa', '0473821736', 'Tunis', 'Tunis', 'CLIENT', 1, '2026-03-05 04:41:57', 6, 'Safwen Yahyaoui', 'C:\\Users\\safwe\\Desktop\\equipe\\saf.jpeg', '[\"ROLE_USER\"]', '0473821736', 'C:\\Users\\safwe\\Desktop\\equipe\\saf.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39'),
(7, 'Zakaria', 'Zarrouk', 'zakaria.zarrouk@esprit.tn', '$2y$13$v0m5DNnI2EXeTKzUbp0YK.FF2sFzSkZZ3cPcMAQe.r8rz6NNsgYPu', '0473821738', 'Tunis', 'Tunis', 'ADMIN', 1, '2026-03-05 10:14:33', 7, 'Zakaria Zarrouk', 'C:\\Users\\safwe\\Desktop\\equipe\\zak.jpeg', '[\"ROLE_ADMIN\", \"ROLE_USER\"]', '0473821738', 'C:\\Users\\safwe\\Desktop\\equipe\\zak.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39'),
(8, 'Youssef', 'Tounsi', 'youssef.tounsi@esprit.tn', '$2y$13$xtnmZEuZuSUyZVcNGsuXR.dVKXp0G3VcAEMOF75zxAl6h87dGuF6q', '0473821739', 'Tunis', 'Tunis', 'CLIENT', 1, '2026-03-05 10:14:33', 8, 'Youssef Tounsi', 'C:\\Users\\safwe\\Desktop\\equipe\\youssef.jpeg', '[\"ROLE_USER\"]', '0473821739', 'C:\\Users\\safwe\\Desktop\\equipe\\youssef.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39'),
(9, 'Joumena', 'Turki', 'joumena.turki@esprit.tn', '$2y$13$.hzj1GuXTv9tTK/oaJhTYuxmX3KJwk8L6prA/uIWg0t68dOaBDcMu', '0473821740', 'Tunis', 'Tunis', 'CLIENT', 1, '2026-03-05 10:14:33', 9, 'Joumena Turki', 'C:\\Users\\safwe\\Desktop\\equipe\\djo.jpeg', '[\"ROLE_USER\"]', '0473821740', 'C:\\Users\\safwe\\Desktop\\equipe\\djo.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39'),
(10, 'Ilef', 'Ben Chouchane', 'ilef.benchouchane@esprit.tn', '$2y$13$CCX.YvSt4TYWiJDrsk6gSuW.5hF.QzcQVebUyXXvsBW1JCPQe1Shi', '0473821741', 'Tunis', 'Tunis', 'VETERINAIRE', 1, '2026-03-05 10:14:33', 10, 'Ilef Ben Chouchane', 'C:\\Users\\safwe\\Desktop\\equipe\\ilef.jpeg', '[\"ROLE_USER\"]', '0473821741', 'C:\\Users\\safwe\\Desktop\\equipe\\ilef.jpeg', 1, 1, 0, 0, '2026-04-04 20:26:39'),
(11, 'youssef', 'tounsi', 'youssef.tounsi@gmail.com', '$2y$13$z7YR0XXk1CXtxjyRyoeyD.Qd4nr3qjt3BSeFf9yUxUBwCKTfEQVJe', NULL, NULL, NULL, 'ADMIN', 1, '2026-04-04 17:52:30', NULL, NULL, NULL, '[]', '15478596', 'uploads/profiles/cv-69d151453da95.png', 0, 1, 0, 0, '2026-04-04 19:58:29');

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
-- Indexes for table `adoptionrequest`
--
ALTER TABLE `adoptionrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adoption_request`
--
ALTER TABLE `adoption_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `fk_adoption_client` (`client_id`);

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`idAnimal`);

--
-- Indexes for table `client_gestion`
--
ALTER TABLE `client_gestion`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id_compte`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD PRIMARY KEY (`id_disponibilite`),
  ADD KEY `vet_id` (`vet_id`);

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
  ADD UNIQUE KEY `uq_friendship_pair` (`user1_id`,`user2_id`),
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
  ADD KEY `fk_hotel_manager` (`manager_id`);

--
-- Indexes for table `manager_account`
--
ALTER TABLE `manager_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `manager_id` (`manager_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UKxwcsepu5t1hoe04v5i8xhk5y` (`transaction_id`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduit` (`idProduit`),
  ADD KEY `fk_panier_client` (`client_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UKlryndveuwa4k5qthti0pkmtlx` (`transaction_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UKj9mo0xgfs34t6e3c17anidd83` (`code`);

--
-- Indexes for table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reclamation_client` (`client_id`);

--
-- Indexes for table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`id_rdv`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `disponibilite_id` (`disponibilite_id`);

--
-- Indexes for table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reponse_reclamation` (`reclamation_id`),
  ADD KEY `fk_reponse_admin` (`admin_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reservation_client` (`client_id`),
  ADD KEY `fk_reservation_animal` (`animal_id`),
  ADD KEY `fk_reservation_hotel` (`hotel_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_review_vet` (`vet_id`),
  ADD KEY `idx_review_rdv` (`rdv_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoptionrequest`
--
ALTER TABLE `adoptionrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `adoption_request`
--
ALTER TABLE `adoption_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `idAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client_gestion`
--
ALTER TABLE `client_gestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `disponibilite`
--
ALTER TABLE `disponibilite`
  MODIFY `id_disponibilite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `manager_account`
--
ALTER TABLE `manager_account`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `id_rdv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `adoption_request_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`idAnimal`),
  ADD CONSTRAINT `fk_adoption_client` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`);

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
-- Constraints for table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD CONSTRAINT `disponibilite_ibfk_1` FOREIGN KEY (`vet_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `fk_hotel_manager` FOREIGN KEY (`manager_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `fk_panier_client` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `fk_reclamation_client` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `rendezvous_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `rendezvous_ibfk_2` FOREIGN KEY (`vet_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `rendezvous_ibfk_3` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`idAnimal`),
  ADD CONSTRAINT `rendezvous_ibfk_4` FOREIGN KEY (`disponibilite_id`) REFERENCES `disponibilite` (`id_disponibilite`);

--
-- Constraints for table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `fk_reponse_admin` FOREIGN KEY (`admin_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reponse_reclamation` FOREIGN KEY (`reclamation_id`) REFERENCES `reclamation` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_animal` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`idAnimal`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reservation_client` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reservation_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
