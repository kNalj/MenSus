-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2016 at 07:38 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mensus`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `classCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `program` text COLLATE utf8_unicode_ci NOT NULL,
  `ECTS` int(11) NOT NULL,
  `semRedovni` int(11) NOT NULL,
  `semVanredni` int(11) NOT NULL,
  `izborni` enum('da','ne') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `created_at`, `updated_at`, `name`, `classCode`, `program`, `ECTS`, `semRedovni`, `semVanredni`, `izborni`) VALUES
(1, '2016-07-12 22:17:56', '2016-07-13 18:47:16', 'Programiranje na internetu', 'PIN', 'Ovo cu samo napisat nesto bezveze da vidin kako izgleda kad neki od predmeta ima program pa mi je cilj da ima par linija teksta cisto ono da vidin na sta lici.', 6, 5, 5, 'da'),
(2, '2016-07-12 22:17:56', '2016-07-12 22:17:56', 'Programiranje u JAVA-i', 'PUJ', '', 6, 5, 5, 'da'),
(3, '2016-07-12 22:17:56', '2016-07-12 22:17:56', 'Strukture podataka i algoritmi', 'SPA', '', 6, 4, 4, 'da'),
(4, '2016-07-12 22:17:56', '2016-07-12 22:17:56', 'Oblikovanje web stranica', 'OWS', '', 6, 6, 6, 'da'),
(5, '2016-07-12 22:17:56', '2016-07-12 22:17:56', 'Analiza 2', 'AN2', '', 6, 5, 5, 'da');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_07_06_184317_create_users_table', 1),
('2016_07_06_184338_create_classes_table', 1),
('2016_07_06_184426_create_users_classes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('student','mentor','admin') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('none','redovni','vanredni') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `email`, `password`, `role`, `status`, `remember_token`) VALUES
(1, '2016-07-12 22:17:56', '2016-07-16 19:20:31', 'admin', '$2y$10$V8jknifo2VbFiHMuqAeNaOK6SwuJwby8mh/kmLDv62lW2WCoz1CQK', 'admin', 'none', 'edPjzyfLgOuhAoT27AsoLWW4eOgQkcubdp5Ac8QmiUVT7z2PlKO3rEuhWhCH'),
(2, '2016-07-12 22:17:57', '2016-07-17 14:58:23', 'ab123@oss.unist.hr', '$2y$10$0O4JOJKJyK7.vjECiSlZ9OYivTFp96RYWkvqpVg./MxpMawtKzO.m', 'student', 'redovni', 'llBlU0IW4dnKMkp1SKEoGJw6luFi36xluURto8AjBJwaKgU04WtJhEFzWQOg'),
(3, '2016-07-12 22:17:57', '2016-07-15 18:44:36', 'ba321@oss.unist.hr', '$2y$10$YRNe37OH3HWQlY4eestbOe66Ka.19pLww7vs40hvPvpsNsE/QOYmy', 'mentor', 'none', 'b9CYkeZLkiwh3oAnpx8QUWBDnbafPtESDX7e5lk0FI0EWdMZsRErHXjXivkp'),
(4, '2016-07-14 19:06:48', '2016-07-17 15:26:09', 'novi@oss.unist.hr', '$2y$10$/OfjgWu0jINKjXaEUDAGk.V1MXs6vlBDFaphxFQ6IHSZrxnSyeo6C', 'student', 'vanredni', 'I3g1poOAlcjNWeWrolB5qBli290fhf3rKAvSzjh7YWpZsrvXHtbHH146nD72'),
(5, '2016-07-14 19:08:25', '2016-07-14 20:46:42', 'novi1@oss.unist.hr', '$2y$10$UIRPKcz3BPmnPYjEaPRjY./NnEC0cK0WTaYccGkh6QpsTWq2V9pZ.', 'student', 'vanredni', NULL),
(6, '2016-07-14 19:09:25', '2016-07-14 20:41:25', 'najnoviji@oss.unist.hr', '$2y$10$3pBROX5IUqVzjoJDpAKGQ.nxr5rLvqd3QWyNgmS04IRs3BJkNQY82', 'student', 'redovni', 'nQc6JYisqF4GwoUblQoTGWGriVNoAs1HZHwaRihjXsQPbYoTS5bIMZUkPhsm');

-- --------------------------------------------------------

--
-- Table structure for table `users_classes`
--

CREATE TABLE IF NOT EXISTS `users_classes` (
  `users_id` int(11) NOT NULL,
  `classes_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_classes`
--

INSERT INTO `users_classes` (`users_id`, `classes_id`, `status`) VALUES
(2, 1, 'nije polozeno'),
(4, 5, ''),
(4, 4, ''),
(2, 2, 'polozeno');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
