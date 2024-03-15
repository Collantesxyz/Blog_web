-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 07:36 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `profile`) VALUES
(3, 'Aiyman', '3760ebb9e71703732b69dac15ed2d77d90d7d255', 'profile-img.png'),
(8, 'Ahil', '582f400deed5231caac22387b47da6d9bcc3845f', 'profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `admin_id`, `user_id`, `user_name`, `comment`, `date`) VALUES
(11, 12, 3, 6, 'mahi', 'Quo Tempore Odio Quidem Nihil Sed Accusantium Voluptas Harum Placeat Est Ipsa Quibusdam? Tenetur!', '2023-03-18'),
(12, 11, 3, 6, 'mahi', 'Sequi Quo Tempore Odio Quidem Nihil Sed Accusantium Voluptas Harum Placeat Est Ipsa Quibusdam? Tenetur!Sequi Quo Tempore Odio Quidem Nihil Sed Accusantium Voluptas Harum Placeat Est Ipsa Quibusdam? Tenetur!', '2023-03-18'),
(14, 12, 3, 2, 'selena', 'Voluptate Sequi Quo Tempore Odio Quidem Nihil Sed Accusantium Voluptas Harum Placeat Est Ipsa Quibusdam? Tenetur!', '2023-03-19'),
(15, 19, 3, 2, 'selena', ' Quo Tempore Odio Quidem Nihil Sed Accusantium Voluptas Harum Placeat Est Ipsa Quibusdam? Tenetur!', '2023-03-19');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `admin_id`, `post_id`) VALUES
(3, 6, 3, 9),
(4, 6, 3, 12),
(5, 6, 3, 10),
(6, 2, 3, 18),
(7, 2, 3, 19);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `admin_id`, `name`, `title`, `content`, `category`, `image`, `date`, `status`) VALUES
(9, 3, 'Aiyman', 'web design', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'movies and animations', 'pexels-photo-1170686.jpeg', '2023-03-17', 'active'),
(10, 3, 'Aiyman', 'web design', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'entertainment', '10.jpg', '2023-03-17', 'active'),
(11, 3, 'Aiyman', 'architecture', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'movies and animations', 'photographer-407068_1920.jpg', '2023-03-17', 'active'),
(12, 3, 'Aiyman', 'photography', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'travel', '0.jpeg', '2023-03-17', 'active'),
(13, 3, 'Aiyman', 'interior design', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'business', '6.jpg', '2023-03-17', 'active'),
(14, 3, 'Aiyman', 'beautiful house', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'travel', '4 (1).jpg', '2023-03-17', 'active'),
(15, 3, 'Aiyman', 'travel blog', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'travel', 'pexels-photo-338917.jpeg', '2023-03-17', 'active'),
(16, 3, 'Aiyman', 'night views', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'lifestyle', 'pexels-photo-872830.jpeg', '2023-03-17', 'active'),
(17, 3, 'Aiyman', 'healthy food', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'food and drinks', 'pexels-photo-1640777.jpeg', '2023-03-17', 'active'),
(18, 3, 'Aiyman', 'health is wealth', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'health and fitness', 'pexels-photo-347134.jpeg', '2023-03-17', 'active'),
(19, 3, 'Aiyman', 'health fruit salad', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'food and drinks', 'pexels-photo-1092730.jpeg', '2023-03-17', 'active'),
(20, 3, 'Aiyman', 'bussiness', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, similique ratione aperiam ipsum ut voluptate sequi quo tempore odio quidem nihil sed accusantium voluptas harum placeat est ipsa quibusdam? Tenetur!', 'business', 'pexels-photo-3182765.webp', '2023-03-17', 'active'),
(21, 8, 'Ahil', 'wild life', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?', 'travel', '1.jpeg', '2023-03-17', 'active'),
(22, 8, 'Ahil', 'road trip', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, cumque voluptate ipsam doloremque ex ipsa adipisci, praesentium saepe asperiores dolores, accusantium explicabo animi eligendi eveniet voluptatum. Delectus culpa quos placeat?', 'travel', '9.jpg', '2023-03-17', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile`) VALUES
(1, 'sara', 'saraanjum@gmail.com', 'dea04453c249149b5fc772d9528fe61afaf7441c', 'glitch.jpg'),
(2, 'selena', 'selenaAnsari@gmail.c', '3f354c4d88673d86f861d5aac7a7123aff9e3b91', '3.jpg'),
(6, 'mahi', 'mahinazir@gmail.com', '2630efc1492144f699ad471546ef20a2bd159aa6', 'post.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
