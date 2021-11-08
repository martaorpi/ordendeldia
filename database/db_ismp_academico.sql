-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2021 a las 15:02:43
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_ismp_academico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `careers`
--

CREATE TABLE `careers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `available_space` int(11) NOT NULL,
  `ws_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `status` enum('Abierta','Cerrada') COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `careers`
--

INSERT INTO `careers` (`id`, `title`, `short_name`, `amount`, `available_space`, `ws_id`, `duration`, `status`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Trabajo Social', 'Trabajo Social', 8000, 4, 1, 4, 'Abierta', 'Trabajo-Social', NULL, NULL, NULL),
(2, 'Técnico Superior en Hemoterapia', 'Hemoterapia', 8000, 30, 2, 3, 'Abierta', 'Hemoterapia', NULL, NULL, NULL),
(3, 'Técnico Superior en Laboratorio', 'Laboratorio', 8000, 40, 3, 3, 'Abierta', 'Laboratorio', NULL, NULL, NULL),
(4, 'Técnico Superior en Instrumentación Quirúrgica', 'Instrumentación Quirúrgica', 9000, 50, 4, 3, 'Abierta', 'Instrumentación-Quirúrgica', NULL, NULL, NULL),
(5, 'Técnico Superior en Radiología', 'Radiología', 9000, 60, 5, 3, 'Abierta', 'Radiologia', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `career_user`
--

CREATE TABLE `career_user` (
  `career_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `description`, `province_id`, `created_at`, `updated_at`) VALUES
(0, 'Sin determinar', 0, NULL, NULL),
(1, 'Aguirre', 1, NULL, NULL),
(2, 'Alberdi', 1, NULL, NULL),
(3, 'Atamisqui', 1, NULL, NULL),
(4, 'Avellaneda', 1, NULL, NULL),
(5, 'Banda', 1, NULL, NULL),
(6, 'Belgrano', 1, NULL, NULL),
(7, 'Capital', 1, NULL, NULL),
(8, 'Choya', 1, NULL, NULL),
(9, 'Copo', 1, NULL, NULL),
(10, 'Figueroa', 1, NULL, NULL),
(11, 'Gral. Taboada', 1, NULL, NULL),
(12, 'Guasayán', 1, NULL, NULL),
(13, 'Jiménez', 1, NULL, NULL),
(14, 'J. F. Ibarra', 1, NULL, NULL),
(15, 'Loreto', 1, NULL, NULL),
(16, 'Mitre', 1, NULL, NULL),
(17, 'Moreno', 1, NULL, NULL),
(18, 'Ojo de Agua', 1, NULL, NULL),
(19, 'Pellegrini', 1, NULL, NULL),
(20, 'Quebrachos', 1, NULL, NULL),
(21, 'Río Hondo', 1, NULL, NULL),
(22, 'Rivadavia', 1, NULL, NULL),
(23, 'Robles', 1, NULL, NULL),
(24, 'Salavina', 1, NULL, NULL),
(25, 'San Martin', 1, NULL, NULL),
(26, 'Sarmiento', 1, NULL, NULL),
(27, 'Silípica', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentations`
--

CREATE TABLE `documentations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `status` enum('Solicitado','Aprobado','Rechazado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam_student`
--

CREATE TABLE `exam_student` (
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `locations`
--

INSERT INTO `locations` (`id`, `description`, `department_id`, `created_at`, `updated_at`) VALUES
(0, 0, 0, 0, 0),
(2, 0, 7, 0, 0),
(3, 0, 7, 0, 0),
(4, 0, 7, 0, 0),
(5, 0, 7, 0, 0),
(6, 0, 7, 0, 0),
(7, 0, 7, 0, 0),
(8, 0, 2, 0, 0),
(9, 0, 7, 0, 0),
(10, 0, 7, 0, 0),
(11, 0, 7, 0, 0),
(12, 0, 20, 0, 0),
(13, 0, 13, 0, 0),
(14, 0, 7, 0, 0),
(15, 0, 7, 0, 0),
(16, 0, 9, 0, 0),
(17, 0, 7, 0, 0),
(18, 0, 14, 0, 0),
(19, 0, 7, 0, 0),
(20, 0, 2, 0, 0),
(21, 0, 7, 0, 0),
(22, 0, 19, 0, 0),
(23, 0, 9, 0, 0),
(24, 0, 26, 0, 0),
(25, 0, 7, 0, 0),
(26, 0, 7, 0, 0),
(27, 0, 7, 0, 0),
(28, 0, 18, 0, 0),
(29, 0, 7, 0, 0),
(30, 25, 20, 0, 0),
(31, 9, 25, 0, 0),
(32, 0, 8, 0, 0),
(33, 0, 5, 0, 0),
(34, 0, 13, 0, 0),
(35, 0, 17, 0, 0),
(36, 0, 9, 0, 0),
(37, 0, 10, 0, 0),
(38, 0, 12, 0, 0),
(39, 0, 21, 0, 0),
(40, 0, 8, 0, 0),
(41, 0, 8, 0, 0),
(42, 0, 8, 0, 0),
(43, 0, 12, 0, 0),
(44, 0, 8, 0, 0),
(45, 0, 8, 0, 0),
(46, 0, 8, 0, 0),
(47, 0, 8, 0, 0),
(48, 0, 17, 0, 0),
(49, 0, 7, 0, 0),
(50, 0, 14, 0, 0),
(51, 0, 20, 0, 0),
(52, 0, 4, 0, 0),
(53, 0, 25, 0, 0),
(54, 0, 5, 0, 0),
(55, 0, 14, 0, 0),
(56, 0, 24, 0, 0),
(57, 0, 10, 0, 0),
(58, 0, 19, 0, 0),
(59, 0, 15, 0, 0),
(60, 0, 20, 0, 0),
(61, 0, 2, 0, 0),
(62, 0, 17, 0, 0),
(63, 0, 23, 0, 0),
(64, 0, 14, 0, 0),
(65, 0, 7, 0, 0),
(66, 0, 4, 0, 0),
(67, 0, 8, 0, 0),
(68, 0, 13, 0, 0),
(69, 0, 8, 0, 0),
(70, 0, 8, 0, 0),
(71, 3, 19, 0, 0),
(72, 0, 20, 0, 0),
(73, 0, 12, 0, 0),
(74, 0, 19, 0, 0),
(75, 0, 2, 0, 0),
(76, 0, 19, 0, 0),
(77, 0, 12, 0, 0),
(78, 0, 12, 0, 0),
(79, 0, 12, 0, 0),
(80, 0, 12, 0, 0),
(81, 0, 12, 0, 0),
(82, 0, 27, 0, 0),
(83, 0, 5, 0, 0),
(84, 0, 17, 0, 0),
(85, 0, 12, 0, 0),
(86, 0, 2, 0, 0),
(87, 0, 5, 0, 0),
(88, 0, 27, 0, 0),
(89, 0, 25, 0, 0),
(90, 0, 2, 0, 0),
(91, 0, 27, 0, 0),
(92, 0, 27, 0, 0),
(93, 0, 27, 0, 0),
(94, 0, 27, 0, 0),
(95, 0, 21, 0, 0),
(96, 0, 2, 0, 0),
(97, 0, 21, 0, 0),
(98, 0, 21, 0, 0),
(99, 0, 25, 0, 0),
(100, 0, 21, 0, 0),
(101, 0, 21, 0, 0),
(102, 0, 21, 0, 0),
(103, 0, 21, 0, 0),
(104, 0, 21, 0, 0),
(105, 0, 21, 0, 0),
(106, 0, 21, 0, 0),
(107, 0, 21, 0, 0),
(108, 0, 21, 0, 0),
(109, 0, 18, 0, 0),
(110, 0, 21, 0, 0),
(112, 0, 9, 0, 0),
(113, 0, 2, 0, 0),
(114, 0, 21, 0, 0),
(115, 0, 2, 0, 0),
(116, 0, 21, 0, 0),
(117, 0, 21, 0, 0),
(118, 0, 20, 0, 0),
(119, 0, 21, 0, 0),
(120, 0, 21, 0, 0),
(121, 0, 21, 0, 0),
(122, 0, 21, 0, 0),
(123, 0, 21, 0, 0),
(124, 0, 17, 0, 0),
(125, 0, 21, 0, 0),
(126, 0, 21, 0, 0),
(127, 0, 21, 0, 0),
(128, 0, 21, 0, 0),
(129, 0, 21, 0, 0),
(130, 0, 21, 0, 0),
(131, 0, 5, 0, 0),
(132, 0, 5, 0, 0),
(133, 0, 5, 0, 0),
(134, 0, 5, 0, 0),
(135, 0, 18, 0, 0),
(136, 0, 5, 0, 0),
(137, 0, 5, 0, 0),
(138, 0, 5, 0, 0),
(139, 0, 5, 0, 0),
(140, 0, 5, 0, 0),
(141, 0, 5, 0, 0),
(142, 0, 5, 0, 0),
(143, 0, 8, 0, 0),
(144, 0, 5, 0, 0),
(145, 0, 22, 0, 0),
(146, 0, 5, 0, 0),
(147, 0, 5, 0, 0),
(148, 0, 5, 0, 0),
(149, 0, 23, 0, 0),
(150, 0, 19, 0, 0),
(151, 0, 5, 0, 0),
(152, 0, 5, 0, 0),
(153, 0, 5, 0, 0),
(154, 0, 5, 0, 0),
(155, 0, 5, 0, 0),
(156, 3, 5, 0, 0),
(157, 0, 21, 0, 0),
(158, 0, 5, 0, 0),
(159, 0, 19, 0, 0),
(160, 0, 5, 0, 0),
(161, 0, 5, 0, 0),
(162, 0, 15, 0, 0),
(163, 0, 15, 0, 0),
(164, 0, 5, 0, 0),
(165, 0, 5, 0, 0),
(166, 0, 5, 0, 0),
(167, 0, 15, 0, 0),
(168, 0, 2, 0, 0),
(169, 0, 5, 0, 0),
(170, 0, 2, 0, 0),
(171, 3, 10, 0, 0),
(172, 0, 5, 0, 0),
(173, 0, 1, 0, 0),
(174, 0, 6, 0, 0),
(175, 0, 10, 0, 0),
(176, 0, 10, 0, 0),
(177, 0, 23, 0, 0),
(178, 0, 10, 0, 0),
(179, 0, 10, 0, 0),
(180, 0, 5, 0, 0),
(181, 0, 10, 0, 0),
(182, 0, 5, 0, 0),
(183, 0, 10, 0, 0),
(184, 0, 5, 0, 0),
(185, 0, 5, 0, 0),
(186, 0, 10, 0, 0),
(187, 0, 5, 0, 0),
(188, 0, 19, 0, 0),
(189, 0, 10, 0, 0),
(190, 0, 13, 0, 0),
(191, 0, 10, 0, 0),
(192, 0, 13, 0, 0),
(193, 0, 10, 0, 0),
(194, 0, 10, 0, 0),
(195, 0, 10, 0, 0),
(196, 3, 13, 0, 0),
(197, 0, 13, 0, 0),
(198, 0, 19, 0, 0),
(199, 0, 13, 0, 0),
(200, 0, 13, 0, 0),
(201, 0, 15, 0, 0),
(202, 0, 2, 0, 0),
(203, 0, 8, 0, 0),
(204, 0, 16, 0, 0),
(205, 0, 19, 0, 0),
(206, 0, 5, 0, 0),
(207, 0, 9, 0, 0),
(208, 0, 19, 0, 0),
(209, 0, 19, 0, 0),
(210, 0, 13, 0, 0),
(211, 0, 19, 0, 0),
(212, 0, 19, 0, 0),
(213, 0, 10, 0, 0),
(214, 0, 16, 0, 0),
(215, 0, 19, 0, 0),
(216, 0, 19, 0, 0),
(217, 0, 2, 0, 0),
(218, 0, 19, 0, 0),
(219, 0, 19, 0, 0),
(220, 0, 19, 0, 0),
(221, 0, 9, 0, 0),
(222, 0, 19, 0, 0),
(223, 0, 11, 0, 0),
(224, 0, 10, 0, 0),
(225, 0, 19, 0, 0),
(226, 0, 19, 0, 0),
(227, 0, 19, 0, 0),
(228, 0, 5, 0, 0),
(229, 0, 19, 0, 0),
(230, 0, 2, 0, 0),
(231, 0, 20, 0, 0),
(232, 0, 19, 0, 0),
(233, 0, 25, 0, 0),
(234, 0, 23, 0, 0),
(235, 0, 23, 0, 0),
(236, 0, 13, 0, 0),
(237, 0, 23, 0, 0),
(238, 0, 23, 0, 0),
(239, 0, 5, 0, 0),
(240, 0, 23, 0, 0),
(241, 0, 24, 0, 0),
(242, 0, 17, 0, 0),
(243, 0, 14, 0, 0),
(244, 0, 23, 0, 0),
(245, 0, 23, 0, 0),
(246, 9, 26, 0, 0),
(247, 0, 26, 0, 0),
(248, 0, 26, 0, 0),
(249, 0, 26, 0, 0),
(250, 0, 26, 0, 0),
(251, 0, 1, 0, 0),
(252, 0, 26, 0, 0),
(253, 3, 1, 0, 0),
(254, 0, 1, 0, 0),
(255, 0, 1, 0, 0),
(256, 0, 1, 0, 0),
(257, 0, 1, 0, 0),
(258, 0, 11, 0, 0),
(259, 0, 1, 0, 0),
(260, 0, 1, 0, 0),
(261, 0, 9, 0, 0),
(262, 0, 1, 0, 0),
(263, 0, 4, 0, 0),
(264, 0, 4, 0, 0),
(265, 0, 13, 0, 0),
(266, 0, 4, 0, 0),
(267, 0, 4, 0, 0),
(268, 0, 4, 0, 0),
(269, 0, 4, 0, 0),
(270, 0, 4, 0, 0),
(271, 0, 4, 0, 0),
(272, 0, 24, 0, 0),
(274, 3, 6, 0, 0),
(275, 0, 6, 0, 0),
(276, 0, 6, 0, 0),
(277, 0, 6, 0, 0),
(278, 0, 6, 0, 0),
(279, 0, 6, 0, 0),
(281, 0, 19, 0, 0),
(282, 0, 16, 0, 0),
(283, 0, 16, 0, 0),
(284, 0, 22, 0, 0),
(285, 0, 22, 0, 0),
(286, 0, 22, 0, 0),
(287, 0, 22, 0, 0),
(288, 0, 11, 0, 0),
(289, 0, 11, 0, 0),
(290, 0, 11, 0, 0),
(291, 0, 11, 0, 0),
(292, 0, 11, 0, 0),
(293, 0, 17, 0, 0),
(294, 0, 5, 0, 0),
(295, 0, 11, 0, 0),
(296, 0, 11, 0, 0),
(297, 0, 11, 0, 0),
(298, 0, 11, 0, 0),
(299, 0, 11, 0, 0),
(300, 0, 22, 0, 0),
(301, 0, 11, 0, 0),
(302, 0, 11, 0, 0),
(303, 0, 11, 0, 0),
(304, 0, 11, 0, 0),
(305, 0, 14, 0, 0),
(306, 0, 4, 0, 0),
(307, 0, 4, 0, 0),
(308, 0, 4, 0, 0),
(309, 0, 4, 0, 0),
(310, 0, 9, 0, 0),
(311, 0, 4, 0, 0),
(312, 0, 24, 0, 0),
(313, 0, 17, 0, 0),
(314, 0, 14, 0, 0),
(315, 0, 2, 0, 0),
(316, 0, 21, 0, 0),
(317, 0, 2, 0, 0),
(318, 0, 17, 0, 0),
(319, 0, 2, 0, 0),
(320, 0, 19, 0, 0),
(321, 0, 27, 0, 0),
(322, 0, 2, 0, 0),
(323, 0, 24, 0, 0),
(324, 0, 2, 0, 0),
(325, 0, 14, 0, 0),
(326, 3, 9, 0, 0),
(327, 0, 17, 0, 0),
(328, 0, 18, 0, 0),
(329, 0, 13, 0, 0),
(330, 0, 9, 0, 0),
(331, 0, 9, 0, 0),
(332, 0, 4, 0, 0),
(333, 0, 7, 0, 0),
(334, 0, 9, 0, 0),
(335, 0, 15, 0, 0),
(336, 0, 9, 0, 0),
(337, 0, 9, 0, 0),
(338, 0, 8, 0, 0),
(339, 0, 9, 0, 0),
(340, 0, 23, 0, 0),
(341, 0, 14, 0, 0),
(342, 0, 14, 0, 0),
(343, 0, 25, 0, 0),
(344, 0, 14, 0, 0),
(345, 0, 14, 0, 0),
(346, 0, 14, 0, 0),
(347, 0, 17, 0, 0),
(348, 0, 17, 0, 0),
(349, 0, 23, 0, 0),
(350, 0, 14, 0, 0),
(351, 0, 17, 0, 0),
(352, 0, 17, 0, 0),
(353, 0, 9, 0, 0),
(354, 0, 9, 0, 0),
(355, 0, 9, 0, 0),
(356, 0, 9, 0, 0),
(357, 0, 17, 0, 0),
(358, 0, 17, 0, 0),
(359, 0, 17, 0, 0),
(360, 0, 17, 0, 0),
(361, 0, 17, 0, 0),
(362, 0, 2, 0, 0),
(363, 0, 17, 0, 0),
(364, 0, 17, 0, 0),
(365, 0, 17, 0, 0),
(366, 0, 3, 0, 0),
(367, 0, 3, 0, 0),
(368, 0, 3, 0, 0),
(369, 0, 10, 0, 0),
(370, 0, 3, 0, 0),
(371, 0, 3, 0, 0),
(372, 0, 3, 0, 0),
(373, 0, 3, 0, 0),
(374, 0, 3, 0, 0),
(375, 0, 14, 0, 0),
(376, 0, 15, 0, 0),
(377, 0, 15, 0, 0),
(378, 0, 15, 0, 0),
(379, 0, 15, 0, 0),
(380, 0, 15, 0, 0),
(381, 0, 15, 0, 0),
(382, 0, 18, 0, 0),
(383, 0, 18, 0, 0),
(384, 0, 13, 0, 0),
(385, 0, 18, 0, 0),
(386, 0, 18, 0, 0),
(387, 0, 18, 0, 0),
(389, 0, 21, 0, 0),
(390, 0, 18, 0, 0),
(391, 0, 18, 0, 0),
(392, 0, 16, 0, 0),
(393, 0, 20, 0, 0),
(394, 0, 20, 0, 0),
(395, 0, 20, 0, 0),
(396, 0, 20, 0, 0),
(397, 0, 20, 0, 0),
(398, 0, 20, 0, 0),
(399, 0, 20, 0, 0),
(400, 0, 20, 0, 0),
(401, 0, 20, 0, 0),
(402, 0, 5, 0, 0),
(403, 0, 20, 0, 0),
(404, 0, 20, 0, 0),
(405, 0, 25, 0, 0),
(406, 0, 3, 0, 0),
(407, 0, 25, 0, 0),
(408, 0, 25, 0, 0),
(409, 0, 25, 0, 0),
(410, 0, 25, 0, 0),
(411, 0, 25, 0, 0),
(412, 0, 25, 0, 0),
(413, 0, 15, 0, 0),
(414, 0, 24, 0, 0),
(415, 0, 24, 0, 0),
(416, 0, 24, 0, 0),
(417, 0, 24, 0, 0),
(418, 0, 7, 0, 0),
(419, 0, 24, 0, 0),
(420, 0, 24, 0, 0),
(421, 0, 24, 0, 0),
(422, 0, 24, 0, 0),
(423, 0, 24, 0, 0),
(424, 0, 24, 0, 0),
(425, 0, 24, 0, 0),
(426, 0, 21, 0, 0),
(427, 0, 15, 0, 0),
(428, 0, 13, 0, 0),
(429, 0, 8, 0, 0),
(430, 0, 21, 0, 0),
(431, 0, 1, 0, 0),
(432, 0, 2, 0, 0),
(433, 0, 22, 0, 0),
(434, 0, 13, 0, 0),
(435, 0, 10, 0, 0),
(436, 0, 8, 0, 0),
(437, 0, 5, 0, 0),
(438, 0, 26, 0, 0),
(439, 0, 13, 0, 0),
(440, 0, 11, 0, 0),
(441, 0, 5, 0, 0),
(442, 0, 13, 0, 0),
(443, 0, 22, 0, 0),
(444, 0, 24, 0, 0),
(445, 0, 22, 0, 0),
(446, 0, 20, 0, 0),
(447, 0, 14, 0, 0),
(448, 0, 2, 0, 0),
(449, 0, 12, 0, 0),
(450, 0, 15, 0, 0),
(451, 0, 12, 0, 0),
(452, 0, 22, 0, 0),
(453, 0, 20, 0, 0),
(454, 0, 25, 0, 0),
(455, 0, 6, 0, 0),
(456, 0, 11, 0, 0),
(457, 0, 10, 0, 0),
(458, 0, 16, 0, 0),
(459, 0, 23, 0, 0),
(460, 0, 5, 0, 0),
(461, 0, 15, 0, 0),
(462, 0, 16, 0, 0),
(463, 0, 5, 0, 0),
(464, 0, 5, 0, 0),
(465, 0, 5, 0, 0),
(466, 0, 18, 0, 0),
(467, 0, 23, 0, 0),
(468, 0, 24, 0, 0),
(469, 0, 5, 0, 0),
(470, 0, 5, 0, 0),
(471, 0, 12, 0, 0),
(472, 0, 7, 0, 0),
(473, 0, 19, 0, 0),
(474, 0, 12, 0, 0),
(475, 0, 13, 0, 0),
(476, 0, 10, 0, 0),
(477, 0, 10, 0, 0),
(478, 0, 11, 0, 0),
(479, 0, 14, 0, 0),
(480, 0, 5, 0, 0),
(481, 0, 10, 0, 0),
(482, 0, 13, 0, 0),
(483, 0, 5, 0, 0),
(484, 0, 18, 0, 0),
(485, 0, 17, 0, 0),
(486, 0, 5, 0, 0),
(487, 0, 25, 0, 0),
(488, 0, 5, 0, 0),
(489, 0, 5, 0, 0),
(490, 0, 9, 0, 0),
(491, 0, 9, 0, 0),
(492, 0, 17, 0, 0),
(493, 0, 5, 0, 0),
(494, 0, 9, 0, 0),
(495, 0, 18, 0, 0),
(496, 0, 9, 0, 0),
(497, 0, 23, 0, 0),
(498, 0, 21, 0, 0),
(499, 0, 21, 0, 0),
(500, 0, 8, 0, 0),
(501, 0, 5, 0, 0),
(502, 0, 19, 0, 0),
(503, 0, 23, 0, 0),
(504, 0, 5, 0, 0),
(505, 0, 5, 0, 0),
(506, 0, 2, 0, 0),
(507, 0, 16, 0, 0),
(508, 0, 24, 0, 0),
(509, 0, 19, 0, 0),
(510, 0, 21, 0, 0),
(511, 0, 21, 0, 0),
(512, 0, 21, 0, 0),
(513, 0, 10, 0, 0),
(514, 0, 10, 0, 0),
(515, 0, 13, 0, 0),
(516, 0, 21, 0, 0),
(517, 0, 7, 0, 0),
(519, 0, 13, 0, 0),
(520, 0, 13, 0, 0),
(521, 0, 7, 0, 0),
(522, 0, 7, 0, 0),
(523, 0, 7, 0, 0),
(524, 0, 21, 0, 0),
(525, 0, 21, 0, 0),
(526, 0, 21, 0, 0),
(527, 0, 21, 0, 0),
(528, 0, 21, 0, 0),
(529, 0, 21, 0, 0),
(530, 0, 21, 0, 0),
(531, 0, 21, 0, 0),
(532, 0, 21, 0, 0),
(533, 0, 21, 0, 0),
(534, 0, 21, 0, 0),
(535, 0, 21, 0, 0),
(536, 0, 21, 0, 0),
(537, 0, 21, 0, 0),
(538, 0, 21, 0, 0),
(539, 0, 21, 0, 0),
(540, 0, 21, 0, 0),
(541, 0, 21, 0, 0),
(542, 0, 21, 0, 0),
(543, 0, 21, 0, 0),
(544, 0, 21, 0, 0),
(545, 0, 21, 0, 0),
(546, 0, 21, 0, 0),
(547, 0, 21, 0, 0),
(548, 0, 21, 0, 0),
(549, 0, 12, 0, 0),
(550, 0, 13, 0, 0),
(551, 0, 21, 0, 0),
(552, 0, 21, 0, 0),
(553, 0, 21, 0, 0),
(554, 0, 21, 0, 0),
(555, 0, 5, 0, 0),
(556, 0, 7, 0, 0),
(557, 0, 13, 0, 0),
(558, 0, 13, 0, 0),
(559, 0, 7, 0, 0),
(560, 0, 25, 0, 0),
(561, 0, 17, 0, 0),
(562, 0, 10, 0, 0),
(563, 0, 9, 0, 0),
(564, 0, 5, 0, 0),
(565, 0, 5, 0, 0),
(566, 0, 5, 0, 0),
(567, 0, 5, 0, 0),
(568, 0, 13, 0, 0),
(569, 0, 17, 0, 0),
(570, 0, 17, 0, 0),
(571, 0, 17, 0, 0),
(572, 0, 5, 0, 0),
(573, 0, 5, 0, 0),
(574, 0, 3, 0, 0),
(575, 0, 7, 0, 0),
(576, 0, 21, 0, 0),
(577, 0, 10, 0, 0),
(578, 0, 19, 0, 0),
(579, 0, 7, 0, 0),
(580, 0, 19, 0, 0),
(581, 0, 7, 0, 0),
(582, 0, 13, 0, 0),
(583, 0, 5, 0, 0),
(584, 0, 10, 0, 0),
(586, 0, 27, 0, 0),
(587, 0, 19, 0, 0),
(588, 0, 19, 0, 0),
(589, 0, 13, 0, 0),
(590, 0, 23, 0, 0),
(591, 0, 5, 0, 0),
(592, 0, 23, 0, 0),
(593, 0, 23, 0, 0),
(594, 0, 23, 0, 0),
(595, 0, 23, 0, 0),
(596, 0, 15, 0, 0),
(597, 0, 5, 0, 0),
(598, 0, 5, 0, 0),
(599, 0, 23, 0, 0),
(600, 0, 10, 0, 0),
(601, 1, 18, 0, 0),
(602, 0, 10, 0, 0),
(603, 0, 2, 0, 0),
(604, 0, 1, 0, 0),
(605, 0, 1, 0, 0),
(606, 0, 5, 0, 0),
(607, 0, 10, 0, 0),
(608, 0, 5, 0, 0),
(609, 0, 5, 0, 0),
(610, 0, 11, 0, 0),
(611, 0, 17, 0, 0),
(612, 0, 10, 0, 0),
(613, 0, 21, 0, 0),
(614, 0, 21, 0, 0),
(615, 0, 21, 0, 0),
(616, 0, 21, 0, 0),
(617, 0, 26, 0, 0),
(618, 0, 5, 0, 0),
(619, 0, 5, 0, 0),
(620, 0, 5, 0, 0),
(621, 0, 5, 0, 0),
(622, 0, 21, 0, 0),
(623, 0, 14, 0, 0),
(624, 0, 5, 0, 0),
(625, 0, 7, 0, 0),
(626, 0, 5, 0, 0),
(627, 0, 23, 0, 0),
(628, 0, 5, 0, 0),
(629, 0, 21, 0, 0),
(630, 0, 23, 0, 0),
(631, 0, 23, 0, 0),
(632, 0, 3, 0, 0),
(633, 0, 15, 0, 0),
(634, 0, 15, 0, 0),
(635, 0, 15, 0, 0),
(636, 0, 25, 0, 0),
(637, 0, 15, 0, 0),
(638, 0, 5, 0, 0),
(639, 0, 5, 0, 0),
(640, 0, 5, 0, 0),
(641, 0, 21, 0, 0),
(642, 0, 14, 0, 0),
(643, 0, 14, 0, 0),
(644, 0, 17, 0, 0),
(645, 0, 10, 0, 0),
(646, 0, 19, 0, 0),
(647, 0, 19, 0, 0),
(648, 0, 19, 0, 0),
(649, 0, 19, 0, 0),
(650, 0, 19, 0, 0),
(651, 0, 13, 0, 0),
(652, 0, 21, 0, 0),
(653, 0, 23, 0, 0),
(654, 0, 21, 0, 0),
(655, 0, 21, 0, 0),
(656, 0, 21, 0, 0),
(657, 0, 10, 0, 0),
(658, 0, 10, 0, 0),
(659, 0, 21, 0, 0),
(660, 0, 7, 0, 0),
(661, 0, 5, 0, 0),
(662, 0, 15, 0, 0),
(663, 0, 8, 0, 0),
(664, 0, 10, 0, 0),
(665, 0, 7, 0, 0),
(666, 0, 21, 0, 0),
(667, 0, 15, 0, 0),
(668, 0, 15, 0, 0),
(669, 0, 15, 0, 0),
(670, 0, 23, 0, 0),
(671, 0, 23, 0, 0),
(672, 0, 13, 0, 0),
(673, 0, 21, 0, 0),
(674, 0, 21, 0, 0),
(675, 0, 21, 0, 0),
(676, 0, 21, 0, 0),
(677, 0, 21, 0, 0),
(678, 0, 21, 0, 0),
(679, 0, 25, 0, 0),
(680, 0, 15, 0, 0),
(681, 0, 12, 0, 0),
(682, 0, 15, 0, 0),
(683, 0, 15, 0, 0),
(684, 0, 25, 0, 0),
(685, 0, 15, 0, 0),
(686, 0, 15, 0, 0),
(687, 0, 19, 0, 0),
(688, 0, 14, 0, 0),
(689, 0, 14, 0, 0),
(690, 0, 25, 0, 0),
(691, 0, 25, 0, 0),
(692, 0, 13, 0, 0),
(693, 0, 23, 0, 0),
(694, 0, 23, 0, 0),
(695, 0, 23, 0, 0),
(696, 0, 23, 0, 0),
(697, 0, 21, 0, 0),
(698, 0, 21, 0, 0),
(699, 0, 23, 0, 0),
(700, 0, 21, 0, 0),
(701, 0, 21, 0, 0),
(702, 0, 23, 0, 0),
(703, 0, 25, 0, 0),
(704, 40, 17, 0, 0),
(705, 0, 13, 0, 0),
(706, 0, 13, 0, 0),
(707, 0, 13, 0, 0),
(708, 0, 10, 0, 0),
(709, 0, 25, 0, 0),
(710, 0, 25, 0, 0),
(711, 0, 25, 0, 0),
(712, 0, 15, 0, 0),
(713, 0, 15, 0, 0),
(714, 0, 15, 0, 0),
(715, 0, 3, 0, 0),
(716, 0, 3, 0, 0),
(717, 0, 3, 0, 0),
(718, 0, 3, 0, 0),
(719, 0, 7, 0, 0),
(720, 0, 15, 0, 0),
(721, 0, 7, 0, 0),
(722, 0, 17, 0, 0),
(723, 0, 3, 0, 0),
(724, 0, 3, 0, 0),
(725, 0, 3, 0, 0),
(726, 0, 25, 0, 0),
(727, 0, 15, 0, 0),
(728, 0, 21, 0, 0),
(729, 0, 21, 0, 0),
(730, 0, 21, 0, 0),
(731, 0, 15, 0, 0),
(732, 0, 14, 0, 0),
(733, 0, 23, 0, 0),
(734, 0, 8, 0, 0),
(735, 0, 17, 0, 0),
(2053, 0, 1, 0, 0),
(4093, 0, 7, 0, 0),
(4094, 0, 0, 0, 0),
(4095, 0, 1, 0, 0),
(4098, 0, 1, 0, 0),
(4099, 0, 1, 0, 0),
(4100, 0, 7, 0, 0),
(4106, 0, 7, 0, 0),
(4111, 0, 18, 0, 0),
(4114, 0, 7, 0, 0),
(4117, 0, 1, 0, 0),
(4119, 0, 2, 0, 0),
(4120, 0, 21, 0, 0),
(4121, 0, 5, 0, 0),
(4122, 0, 5, 0, 0),
(4123, 0, 17, 0, 0),
(4128, 0, 5, 0, 0),
(4129, 0, 0, 0, 0),
(4132, 0, 7, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `lft` int(10) UNSIGNED DEFAULT NULL,
  `rgt` int(10) UNSIGNED DEFAULT NULL,
  `depth` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_05_05_115641_create_menu_items_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_11_01_194856_create_permission_tables', 1),
(7, '2021_11_03_145327_create_students_table', 1),
(8, '2021_11_03_145328_create_documentations_table', 1),
(9, '2021_11_03_145329_create_nationalities_table', 1),
(10, '2021_11_03_145330_create_provinces_table', 1),
(11, '2021_11_03_145331_create_locations_table', 1),
(12, '2021_11_03_145332_create_careers_table', 1),
(13, '2021_11_03_145333_create_exams_table', 1),
(14, '2021_11_03_145334_create_personals_table', 1),
(15, '2021_11_03_145335_create_exam_student_table', 1),
(16, '2021_11_03_145336_create_career_user_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nationalities`
--

CREATE TABLE `nationalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nationalities`
--

INSERT INTO `nationalities` (`id`, `description`, `created_at`, `updated_at`) VALUES
(0, 'Sin determinar', NULL, NULL),
(1, 'Argentina', NULL, NULL),
(2, 'Paraguaya', NULL, NULL),
(3, 'Chilena', NULL, NULL),
(4, 'Boliviana', NULL, NULL),
(5, 'Peruana', NULL, NULL),
(6, 'Brasileña', NULL, NULL),
(7, 'Ecuatoriana', NULL, NULL),
(8, 'Colombiana', NULL, NULL),
(9, 'Venezolana', NULL, NULL),
(10, 'Uruguaya', NULL, NULL),
(11, 'Mexicana', NULL, NULL),
(12, 'Guatemalteca', NULL, NULL),
(13, 'Salvadoreña', NULL, NULL),
(14, 'Hondureña', NULL, NULL),
(15, 'Nicaragüense', NULL, NULL),
(16, 'Costarricense', NULL, NULL),
(17, 'Panameña', NULL, NULL),
(18, 'Puertorriqueña', NULL, NULL),
(19, 'Cubana', NULL, NULL),
(20, 'Dominicana', NULL, NULL),
(21, 'Española', NULL, NULL),
(22, 'Estadounidense', NULL, NULL),
(23, 'Canadiense', NULL, NULL),
(24, 'Jamaiquina', NULL, NULL),
(25, 'Haitiana', NULL, NULL),
(26, 'Australiana', NULL, NULL),
(27, 'Neozelandesa', NULL, NULL),
(28, 'Alemana', NULL, NULL),
(29, 'Armenia', NULL, NULL),
(30, 'Austríaca', NULL, NULL),
(31, 'Belga', NULL, NULL),
(32, 'Búlgara', NULL, NULL),
(33, 'Checa', NULL, NULL),
(34, 'Bosnia', NULL, NULL),
(35, 'Croata', NULL, NULL),
(36, 'Danesa', NULL, NULL),
(37, 'Escocesa', NULL, NULL),
(38, 'Eslovaca', NULL, NULL),
(39, 'Eslovena', NULL, NULL),
(40, 'Finlandesa', NULL, NULL),
(41, 'Francesa', NULL, NULL),
(42, 'Griega', NULL, NULL),
(43, 'Holandesa', NULL, NULL),
(44, 'Húngara', NULL, NULL),
(45, 'Británica', NULL, NULL),
(46, 'Irlandesa', NULL, NULL),
(47, 'Italiana', NULL, NULL),
(48, 'Noruega', NULL, NULL),
(49, 'Polaca', NULL, NULL),
(50, 'Portuguesa', NULL, NULL),
(51, 'Rumana', NULL, NULL),
(52, 'Rusa', NULL, NULL),
(53, 'Serbia', NULL, NULL),
(54, 'Montenegrina', NULL, NULL),
(55, 'Sueca', NULL, NULL),
(56, 'Suiza', NULL, NULL),
(57, 'Turca', NULL, NULL),
(58, 'Ucraniana', NULL, NULL),
(59, 'argelia', NULL, NULL),
(60, 'Camerunesa', NULL, NULL),
(61, 'Etíope', NULL, NULL),
(62, 'Egipcia', NULL, NULL),
(63, 'Liberiana', NULL, NULL),
(64, 'Libia', NULL, NULL),
(65, 'Marroquí', NULL, NULL),
(66, 'Nigeriana', NULL, NULL),
(67, 'Namibia', NULL, NULL),
(68, 'Senegalesa', NULL, NULL),
(69, 'Sudafricana', NULL, NULL),
(70, 'Togolesa', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personals`
--

CREATE TABLE `personals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` int(11) NOT NULL,
  `status` enum('Activo','Inactivo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provinces`
--

INSERT INTO `provinces` (`id`, `description`, `created_at`, `updated_at`) VALUES
(0, 'Sin determinar', NULL, NULL),
(1, 'Santiago del Estero', NULL, NULL),
(2, 'Buenos Aires', NULL, NULL),
(3, 'Catamarca', NULL, NULL),
(4, 'Chaco', NULL, NULL),
(5, 'Chubut', NULL, NULL),
(6, 'Cordoba', NULL, NULL),
(7, 'Corrientes', NULL, NULL),
(8, 'Entre Ríos', NULL, NULL),
(9, 'Formosa', NULL, NULL),
(10, 'Jujuy', NULL, NULL),
(11, 'La Pampa', NULL, NULL),
(12, 'La Rioja', NULL, NULL),
(13, 'Mendoza', NULL, NULL),
(14, 'Misiones', NULL, NULL),
(15, 'Neuquén', NULL, NULL),
(16, 'Río Negro', NULL, NULL),
(17, 'Salta', NULL, NULL),
(18, 'San Juan', NULL, NULL),
(19, 'San Luis', NULL, NULL),
(20, 'Santa Cruz', NULL, NULL),
(21, 'Santa Fe', NULL, NULL),
(22, 'Tierra del Fuego', NULL, NULL),
(23, 'Tucumán', NULL, NULL),
(24, 'Ciudad Autonoma de B', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `career_id` bigint(20) UNSIGNED NOT NULL,
  `nationality_id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `location_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` int(11) NOT NULL,
  `year_income` int(11) DEFAULT NULL,
  `address_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_number` int(11) DEFAULT NULL,
  `address_flat` int(11) DEFAULT NULL,
  `address_departament` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_cp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Solicitado','Aprobado','Inscripto','Rechazado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Solicitado',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Marta orpi', 'martich82@gmail.com', '2021-11-04 22:33:52', '$2y$10$5iyo35wd0HUPrw8JlEqCze249Xvw5W7X4sy6WdhmJsJT6bFhrFi8i', NULL, '2021-11-07 01:28:05', '2021-11-07 01:28:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_admin`
--

CREATE TABLE `users_admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users_admin`
--

INSERT INTO `users_admin` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '2021-11-08 05:34:55', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IVTF9ipWUs', '2021-11-08 05:34:55', '2021-11-08 05:34:55');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `careers_ws_id_unique` (`ws_id`),
  ADD UNIQUE KEY `careers_slug_unique` (`slug`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentations`
--
ALTER TABLE `documentations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documentations_student_id_foreign` (`student_id`);

--
-- Indices de la tabla `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_subject_id_foreign` (`subject_id`),
  ADD KEY `exams_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personals`
--
ALTER TABLE `personals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personals_dni_unique` (`dni`),
  ADD KEY `personals_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_dni_unique` (`dni`),
  ADD UNIQUE KEY `students_slug_unique` (`slug`),
  ADD KEY `students_user_id_foreign` (`user_id`),
  ADD KEY `students_career_id_foreign` (`career_id`),
  ADD KEY `students_nationality_id_foreign` (`nationality_id`),
  ADD KEY `students_province_id_foreign` (`province_id`),
  ADD KEY `students_location_id_foreign` (`location_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `users_admin`
--
ALTER TABLE `users_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `careers`
--
ALTER TABLE `careers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `documentations`
--
ALTER TABLE `documentations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4133;

--
-- AUTO_INCREMENT de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personals`
--
ALTER TABLE `personals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users_admin`
--
ALTER TABLE `users_admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documentations`
--
ALTER TABLE `documentations`
  ADD CONSTRAINT `documentations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
