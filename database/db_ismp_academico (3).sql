-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2021 a las 14:06:31
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

--
-- Volcado de datos para la tabla `documentations`
--

INSERT INTO `documentations` (`id`, `student_id`, `description`, `src`, `created_at`, `updated_at`) VALUES
(7, 5, NULL, 'public/uploads/29376926/DEVWEB-ISMP.pdf', '2021-11-09 14:49:22', '2021-11-09 14:49:22'),
(8, 5, NULL, 'public/uploads/29376926/sin-sonido.png', '2021-11-09 14:49:22', '2021-11-09 14:49:22'),
(9, 5, NULL, 'public/uploads/29376926/party-popper.png', '2021-11-09 14:49:22', '2021-11-09 14:49:22');

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `locations`
--

INSERT INTO `locations` (`id`, `description`, `department_id`, `created_at`, `updated_at`) VALUES
(0, 'SIN DETERMINAR', 0, NULL, NULL),
(2, 'SANTIAGO DEL ESTERO', 7, NULL, NULL),
(3, 'LOS FLORES', 7, NULL, NULL),
(4, 'MACO', 7, NULL, NULL),
(5, 'PUESTITO DE SAN ANTONIO', 7, NULL, NULL),
(6, 'SAN PEDRO', 7, NULL, NULL),
(7, 'SANTA MARIA', 7, NULL, NULL),
(8, 'SANTA ROSA', 2, NULL, NULL),
(9, 'VUELTA DE LA BARRANCA', 7, NULL, NULL),
(10, 'EL ZANJON', 7, NULL, NULL),
(11, 'ALTA GRACIA', 7, NULL, NULL),
(12, 'EL BARRIAL', 20, NULL, NULL),
(13, 'EL CHURQUI', 13, NULL, NULL),
(14, 'EL DEAN', 7, NULL, NULL),
(15, 'LOS MOJONES', 7, NULL, NULL),
(16, 'NUEVA ESPERANZA', 9, NULL, NULL),
(17, 'PRADO VERDE', 7, NULL, NULL),
(18, 'SAN ANTONIO', 14, NULL, NULL),
(19, 'SAN MARCOS', 7, NULL, NULL),
(20, 'SOL DE MAYO', 2, NULL, NULL),
(21, 'BLANCO CORRAL', 7, NULL, NULL),
(22, 'EL MOJON', 19, NULL, NULL),
(23, 'MONTE QUEMADO', 9, NULL, NULL),
(24, 'PAMPA MUYOJ', 26, NULL, NULL),
(25, 'PAMPA MUYOJ', 7, NULL, NULL),
(26, 'REMES', 7, NULL, NULL),
(27, 'SAN LORENZO', 7, NULL, NULL),
(28, 'SANTO DOMINGO', 18, NULL, NULL),
(29, 'TUNAS PUNCO', 7, NULL, NULL),
(30, '25 DE MAYO', 20, NULL, NULL),
(31, '9 DE JULIO', 25, NULL, NULL),
(32, 'ANCAJAN', 8, NULL, NULL),
(33, 'LA BAJADA', 5, NULL, NULL),
(34, 'BAJO HONDO', 13, NULL, NULL),
(35, 'BAJO HONDO', 17, NULL, NULL),
(36, 'LA CAÑADA', 9, NULL, NULL),
(37, 'LA CAÑADA', 10, NULL, NULL),
(38, 'LOS CERRILLOS', 12, NULL, NULL),
(39, 'CHAÑAR POZO', 21, NULL, NULL),
(40, 'CHOYA', 8, NULL, NULL),
(41, 'FRIAS', 8, NULL, NULL),
(42, 'LAPRIDA', 8, NULL, NULL),
(43, 'LUJAN', 12, NULL, NULL),
(44, 'LA MARAVILLA', 8, NULL, NULL),
(45, 'LAS PEÑAS', 8, NULL, NULL),
(46, 'LA REPRESA', 8, NULL, NULL),
(47, 'EL SALVADOR', 8, NULL, NULL),
(48, 'SAN ANTONIO', 17, NULL, NULL),
(49, 'SAN ANTONIO', 7, NULL, NULL),
(50, 'SAN FELIPE', 14, NULL, NULL),
(51, 'SAN FRANCISCO', 20, NULL, NULL),
(52, 'SAN JOSE', 4, NULL, NULL),
(53, 'SAN JOSE', 25, NULL, NULL),
(54, 'SAN JOSE', 5, NULL, NULL),
(55, 'SAN MARTIN', 14, NULL, NULL),
(56, 'SAN NICOLAS', 24, NULL, NULL),
(57, 'SAN PABLO', 10, NULL, NULL),
(58, 'SAN RAMON', 19, NULL, NULL),
(59, 'SAN VICENTE', 15, NULL, NULL),
(60, 'SANTA ANA', 20, NULL, NULL),
(61, 'SANTA CRUZ', 2, NULL, NULL),
(62, 'SANTA LUCIA', 17, NULL, NULL),
(63, 'SANTO DOMINGO', 23, NULL, NULL),
(64, 'SIMBOLAR', 14, NULL, NULL),
(65, 'SOL DE MAYO', 7, NULL, NULL),
(66, 'TALA POZO', 4, NULL, NULL),
(67, 'TAPSO', 8, NULL, NULL),
(68, 'LA VERDE', 13, NULL, NULL),
(69, 'VILLA LA PUNTA', 8, NULL, NULL),
(70, 'LA VUELTA', 8, NULL, NULL),
(71, '3 FLORES', 19, NULL, NULL),
(72, 'BELGRANO', 20, NULL, NULL),
(73, 'DOÑA LUISA', 12, NULL, NULL),
(74, 'LA ESQUINA', 19, NULL, NULL),
(75, 'EL FISCO', 2, NULL, NULL),
(76, 'LA FLORIDA', 19, NULL, NULL),
(77, 'GUAMPACHA', 12, NULL, NULL),
(78, 'LAS JUNTAS', 12, NULL, NULL),
(79, 'LAVALLE', 12, NULL, NULL),
(80, 'LOMA DE YESO', 12, NULL, NULL),
(81, 'EL POZANCON', 12, NULL, NULL),
(82, 'PUESTO DEL MEDIO', 27, NULL, NULL),
(83, 'SAN JUAN ', 5, NULL, NULL),
(84, 'SAN MARTIN', 17, NULL, NULL),
(85, 'SANTA CATALINA', 12, NULL, NULL),
(86, 'SANTOS LUGARES', 2, NULL, NULL),
(87, 'EL SIMBOLAR', 5, NULL, NULL),
(88, 'ARRAGA', 27, NULL, NULL),
(89, 'LA HIGUERA', 25, NULL, NULL),
(90, 'HUACHANA', 2, NULL, NULL),
(91, 'MANOGASTA', 27, NULL, NULL),
(92, 'NUEVA FRANCIA', 27, NULL, NULL),
(93, 'SUMAMAO', 27, NULL, NULL),
(94, 'VILLA SILIPICA', 27, NULL, NULL),
(95, 'ACOS', 21, NULL, NULL),
(96, 'AHI VEREMOS', 2, NULL, NULL),
(97, 'AMICHA', 21, NULL, NULL),
(98, 'ARAGONES', 21, NULL, NULL),
(99, 'BREA POZO', 25, NULL, NULL),
(100, 'CAÑADA DE ROBLE', 21, NULL, NULL),
(101, 'CAÑADA DE TALA POZO', 21, NULL, NULL),
(102, 'CAÑADA DE LA COSTA', 21, NULL, NULL),
(103, 'LAS CEJAS', 21, NULL, NULL),
(104, 'CHAÑAR POCITO', 21, NULL, NULL),
(105, 'CHAÑAR POZO DE ABAJO', 21, NULL, NULL),
(106, 'CHAÑAR POZO DE ARRIBA', 21, NULL, NULL),
(107, 'CHAUCHILLAS', 21, NULL, NULL),
(108, 'COLONIA TINCO', 21, NULL, NULL),
(109, 'LOS CORBALANES', 18, NULL, NULL),
(110, 'DIQUE FRONTAL', 21, NULL, NULL),
(112, 'EL MANANTIAL', 9, NULL, NULL),
(113, 'MONTE RICO', 2, NULL, NULL),
(114, 'LOS NUÑEZ', 21, NULL, NULL),
(115, 'EL PORVENIR', 2, NULL, NULL),
(116, 'POZO DEL JUME', 21, NULL, NULL),
(117, 'POZUELOS', 21, NULL, NULL),
(118, 'QUEBRACHO', 20, NULL, NULL),
(119, 'LA RESERVA', 21, NULL, NULL),
(120, 'RINCON DE ATACAMA', 21, NULL, NULL),
(121, 'SALADILLO', 21, NULL, NULL),
(122, 'EL SAUZAL', 21, NULL, NULL),
(123, 'SOTELOS', 21, NULL, NULL),
(124, 'LAS TINAJAS', 17, NULL, NULL),
(125, 'VILLA BALNEARIA', 21, NULL, NULL),
(126, 'VILLA JIMENEZ', 21, NULL, NULL),
(127, 'VILLA RIO HONDO', 21, NULL, NULL),
(128, 'VINARA', 21, NULL, NULL),
(129, 'YUTU YACU', 21, NULL, NULL),
(130, 'EL BARRIALITO', 21, NULL, NULL),
(131, 'CAÑADA ESCOBAR', 5, NULL, NULL),
(132, 'CUATRO HORCONES', 5, NULL, NULL),
(133, 'GRAN PORVENIR', 5, NULL, NULL),
(134, 'HUAYCURU', 5, NULL, NULL),
(135, 'LA ISLA', 18, NULL, NULL),
(136, 'NUEVO LIBANO', 5, NULL, NULL),
(137, 'RUBIA MORENO', 5, NULL, NULL),
(138, 'TRAMO 16', 5, NULL, NULL),
(139, 'TRAMO 20', 5, NULL, NULL),
(140, 'LA BANDA', 5, NULL, NULL),
(141, 'EL AIBE', 5, NULL, NULL),
(142, 'ANTAJE', 5, NULL, NULL),
(143, 'SANTA CRUZ', 8, NULL, NULL),
(144, 'SEÑORA PUJIO', 5, NULL, NULL),
(145, 'LA VICTORIA', 22, NULL, NULL),
(146, 'LOS ACOSTA', 5, NULL, NULL),
(147, 'AGRICULTORES', 5, NULL, NULL),
(148, 'ARDILES', 5, NULL, NULL),
(149, 'LOS BANEGAS', 23, NULL, NULL),
(150, 'CAMPO GRANDE', 19, NULL, NULL),
(151, 'CHAUPI POZO', 5, NULL, NULL),
(152, 'LA DARSENA', 5, NULL, NULL),
(153, 'LOS DIAS GRANDES', 5, NULL, NULL),
(154, 'LA GUARIDA', 5, NULL, NULL),
(155, 'LOS QUIROGA', 5, NULL, NULL),
(156, '3 POCITOS', 5, NULL, NULL),
(157, 'ABRA DE LAS SALINAS', 21, NULL, NULL),
(158, 'LA AURORA', 5, NULL, NULL),
(159, 'EL CABAO', 19, NULL, NULL),
(160, 'CLODOMIRA', 5, NULL, NULL),
(161, 'HUYAMAMPA', 5, NULL, NULL),
(162, 'JUMI POZO', 15, NULL, NULL),
(163, 'LOMAS', 15, NULL, NULL),
(164, 'MARIA ELENA', 5, NULL, NULL),
(165, 'MISTOL PUESTO', 5, NULL, NULL),
(166, 'NEGRA MUERTA', 5, NULL, NULL),
(167, 'LA NORIA', 15, NULL, NULL),
(168, 'PALMITAS', 2, NULL, NULL),
(169, 'PAMPA MAYO', 5, NULL, NULL),
(170, 'LA UNION', 2, NULL, NULL),
(171, '3 CHAÑARES', 10, NULL, NULL),
(172, 'AGUAS COLORADAS', 5, NULL, NULL),
(173, 'EL AIBAL', 1, NULL, NULL),
(174, 'AVERIAS', 6, NULL, NULL),
(175, 'BANDERA BAJADA', 10, NULL, NULL),
(176, 'LA BREA', 10, NULL, NULL),
(177, 'COLONIA EL SIMBOLAR', 23, NULL, NULL),
(178, 'LA CRUZ', 10, NULL, NULL),
(179, 'LA GUARDIA', 10, NULL, NULL),
(180, 'LA INVERNADA', 5, NULL, NULL),
(181, 'JUMIAL GRANDE', 10, NULL, NULL),
(182, 'KILOMETRO 0', 5, NULL, NULL),
(183, 'KILOMETRO 30', 10, NULL, NULL),
(184, 'MACHAJUAY HUANCHINA', 5, NULL, NULL),
(185, 'EL PIRUCHO', 5, NULL, NULL),
(186, 'POZO DEL CASTAÑO', 10, NULL, NULL),
(187, 'EL QUEBRACHAL', 5, NULL, NULL),
(188, 'EL QUEMADO', 19, NULL, NULL),
(189, 'EL REMANCITO', 10, NULL, NULL),
(190, 'SAN FELIX', 13, NULL, NULL),
(191, 'LA TAPA', 10, NULL, NULL),
(192, 'TORO POZO', 13, NULL, NULL),
(193, 'VACA HUAÑUNA', 10, NULL, NULL),
(194, 'VACA MUERTA', 10, NULL, NULL),
(195, 'YACU HURMANA', 10, NULL, NULL),
(196, '3 CRUCES', 13, NULL, NULL),
(197, 'ABRA GRANDE', 13, NULL, NULL),
(198, 'BAJO ALEGRE', 19, NULL, NULL),
(199, 'POZO HONDO', 13, NULL, NULL),
(200, 'SAN GREGORIO', 13, NULL, NULL),
(201, 'SAN GREGORIO', 15, NULL, NULL),
(202, 'EL SIMBOL', 2, NULL, NULL),
(203, 'SOL DE MAYO', 8, NULL, NULL),
(204, 'LAS ABRAS', 16, NULL, NULL),
(205, 'AGUA AMARGA', 19, NULL, NULL),
(206, 'AHI VEREMOS', 5, NULL, NULL),
(208, 'AHI VEREMOS', 19, NULL, NULL),
(209, 'ALGARROBAL VIEJO', 19, NULL, NULL),
(210, 'EL ARENAL', 13, NULL, NULL),
(211, 'EL BALDE', 19, NULL, NULL),
(212, 'EL CAMBIADO', 19, NULL, NULL),
(213, 'LA CANDELARIA', 10, NULL, NULL),
(214, 'LAS DELICIAS', 16, NULL, NULL),
(215, 'LA FRAGUA', 19, NULL, NULL),
(216, 'HUACANA', 19, NULL, NULL),
(217, 'LA MANGA', 2, NULL, NULL),
(218, 'EL MISTOLAR', 19, NULL, NULL),
(219, 'NUEVA ESPERANZA', 19, NULL, NULL),
(220, 'EL OJITO', 19, NULL, NULL),
(221, 'PAAJ POZO', 9, NULL, NULL),
(222, 'POZO BETBEDER', 19, NULL, NULL),
(223, 'POZO HERRADO', 11, NULL, NULL),
(224, 'QUIMILIOJ', 10, NULL, NULL),
(225, 'RAPELLI', 19, NULL, NULL),
(226, 'EL SALADILLO', 19, NULL, NULL),
(227, 'SAN SERAFIN', 19, NULL, NULL),
(228, 'SAUCE BAJADA', 5, NULL, NULL),
(229, 'TACO BAJADA', 19, NULL, NULL),
(230, 'TACO POZO', 2, NULL, NULL),
(231, 'TACO POZO', 20, NULL, NULL),
(232, 'VILLA MERCEDES', 19, NULL, NULL),
(233, 'VILLA NUEVA', 25, NULL, NULL),
(234, 'AMPATA', 23, NULL, NULL),
(235, 'BELTRAN', 23, NULL, NULL),
(236, 'EL BOBADAL', 13, NULL, NULL),
(237, 'FERNANDEZ', 23, NULL, NULL),
(238, 'FORRES', 23, NULL, NULL),
(239, 'LOAJ', 5, NULL, NULL),
(240, 'LOMITAS', 23, NULL, NULL),
(241, 'EL MISTOL', 24, NULL, NULL),
(242, 'QUIMILI', 17, NULL, NULL),
(243, 'SAN ENRIQUE', 14, NULL, NULL),
(244, 'VILLA HIPOLITA', 23, NULL, NULL),
(245, 'VILLA ROBLES', 23, NULL, NULL),
(246, '9 MISTOLES', 26, NULL, NULL),
(247, 'COLONIA SIEGEL', 26, NULL, NULL),
(248, 'GARZA', 26, NULL, NULL),
(249, 'LA OVERA', 26, NULL, NULL),
(250, 'PAAJ RODEO', 26, NULL, NULL),
(251, 'QUEBRACHITO', 1, NULL, NULL),
(252, 'VILLA MATARA', 26, NULL, NULL),
(253, '3 POZOS', 1, NULL, NULL),
(254, 'ARGENTINA', 1, NULL, NULL),
(255, 'CAMPO CONTARDI', 1, NULL, NULL),
(256, 'CASARES', 1, NULL, NULL),
(257, 'LA CENTELLA', 1, NULL, NULL),
(258, 'LOTE 40', 11, NULL, NULL),
(259, 'MALBRAN', 1, NULL, NULL),
(260, 'EL OSO', 1, NULL, NULL),
(261, 'EL PALMAR', 9, NULL, NULL),
(262, 'PINTO', 1, NULL, NULL),
(263, 'AVE MARIA', 4, NULL, NULL),
(264, 'CALOJ', 4, NULL, NULL),
(265, 'GRAMILLA', 13, NULL, NULL),
(266, 'HERRERA', 4, NULL, NULL),
(267, 'LUGONES', 4, NULL, NULL),
(268, 'PERCAS', 4, NULL, NULL),
(269, 'SABAGASTA', 4, NULL, NULL),
(270, 'SAN ANTONIO DE COPO', 4, NULL, NULL),
(271, 'TOROPAN', 4, NULL, NULL),
(272, 'VACA HUMAN', 24, NULL, NULL),
(274, '3 LAGUNAS', 6, NULL, NULL),
(275, 'EL ASPIRANTE', 6, NULL, NULL),
(276, 'BANDERA', 6, NULL, NULL),
(277, 'CUATRO BOCAS', 6, NULL, NULL),
(278, 'FORTIN INCA', 6, NULL, NULL),
(279, 'GUARDIA ESCOLTA', 6, NULL, NULL),
(281, 'LAS DELICIAS', 19, NULL, NULL),
(282, 'LIMACHE', 16, NULL, NULL),
(283, 'LAS VIBORITAS', 16, NULL, NULL),
(284, 'EL AROMITO', 22, NULL, NULL),
(285, 'COLONIA ALPINA', 22, NULL, NULL),
(286, 'PALO NEGRO', 22, NULL, NULL),
(287, 'LOS PORONGOS', 22, NULL, NULL),
(288, 'AÑATUYA', 11, NULL, NULL),
(289, 'EL CUADRADO', 11, NULL, NULL),
(290, 'LOS JURIES', 11, NULL, NULL),
(291, 'LA LEÑERA', 11, NULL, NULL),
(292, 'LLAJTA MAUCA', 11, NULL, NULL),
(293, 'LOTE 2', 17, NULL, NULL),
(294, 'LOTE 2', 5, NULL, NULL),
(295, 'EL MALACARA', 11, NULL, NULL),
(296, 'MELERO', 11, NULL, NULL),
(297, 'MIEL DE PALO', 11, NULL, NULL),
(298, 'LA NENA', 11, NULL, NULL),
(299, 'OBRAJE MAILIN', 11, NULL, NULL),
(300, 'SELVA BLANCA', 22, NULL, NULL),
(301, 'LA SIMONA', 11, NULL, NULL),
(302, 'TACAÑITAS', 11, NULL, NULL),
(303, 'TOBAS', 11, NULL, NULL),
(304, 'TOMAS YOUNG', 11, NULL, NULL),
(305, 'EL 20', 14, NULL, NULL),
(306, 'BLANCA POZO', 4, NULL, NULL),
(307, 'COLONIA DORA', 4, NULL, NULL),
(308, 'LA COSTA', 4, NULL, NULL),
(309, 'ICAÑO', 4, NULL, NULL),
(310, 'LOTE 4', 9, NULL, NULL),
(311, 'REAL SAYANA', 4, NULL, NULL),
(312, 'EL 50', 24, NULL, NULL),
(313, 'ARBOL BLANCO', 17, NULL, NULL),
(314, 'CAMPO DEL CIELO', 14, NULL, NULL),
(315, 'CAMPO GALLO', 2, NULL, NULL),
(316, 'LA CURVA', 21, NULL, NULL),
(317, 'DONADEU', 2, NULL, NULL),
(318, 'LIBERTAD', 17, NULL, NULL),
(319, 'LA MELADA', 2, NULL, NULL),
(320, 'EL MORADITO', 19, NULL, NULL),
(321, 'EL SIMBOL', 27, NULL, NULL),
(322, 'TACANITAS', 2, NULL, NULL),
(323, 'TARUCA PAMPA', 24, NULL, NULL),
(324, 'EL VALLE', 2, NULL, NULL),
(325, 'YUCHAN', 14, NULL, NULL),
(326, '3 LUCES', 9, NULL, NULL),
(327, 'AEROLITO', 17, NULL, NULL),
(328, 'AGUA BLANCA', 18, NULL, NULL),
(329, 'EL BAGUAL', 13, NULL, NULL),
(330, 'EL CABURE', 9, NULL, NULL),
(331, 'COLOMBIA', 9, NULL, NULL),
(332, 'MAILIN', 4, NULL, NULL),
(333, 'LAS MERCEDES', 7, NULL, NULL),
(334, 'SAN JOSE DEL BOQUERON', 9, NULL, NULL),
(335, 'SAUCE SOLO', 15, NULL, NULL),
(336, 'LOS TIGRES', 9, NULL, NULL),
(337, 'URUTAU', 9, NULL, NULL),
(338, 'VILLA ANGELA', 8, NULL, NULL),
(339, 'VILLA MATOQUE', 9, NULL, NULL),
(340, 'VILMER', 23, NULL, NULL),
(341, 'MATARA', 14, NULL, NULL),
(342, 'PIRUAS BAJADA', 14, NULL, NULL),
(343, 'PUESTITO', 25, NULL, NULL),
(344, 'SUNCHO CORRAL', 14, NULL, NULL),
(345, 'TIUM PUNCO', 14, NULL, NULL),
(346, 'EL COLORADO', 14, NULL, NULL),
(347, 'OTUMPA', 17, NULL, NULL),
(348, 'ROVERSI', 17, NULL, NULL),
(349, 'TABIANITA', 23, NULL, NULL),
(350, 'VILELAS', 14, NULL, NULL),
(351, 'VILLA BRANA', 17, NULL, NULL),
(352, 'WEISBURD', 17, NULL, NULL),
(353, 'CORONEL M.L. DE RICO', 9, NULL, NULL),
(354, 'PAMPA DE LOS GUANACOS', 9, NULL, NULL),
(355, 'LOS PIRPINTOS', 9, NULL, NULL),
(356, 'SACHAYOJ', 9, NULL, NULL),
(357, 'ALHUAMPA', 17, NULL, NULL),
(358, 'AMAMA', 17, NULL, NULL),
(359, 'GRANADERO GATICA', 17, NULL, NULL),
(360, 'EL HOYO', 17, NULL, NULL),
(361, 'LILO VIEJO', 17, NULL, NULL),
(362, 'MILAGROS', 2, NULL, NULL),
(363, 'OCTAVIA', 17, NULL, NULL),
(364, 'EL PATAY', 17, NULL, NULL),
(365, 'TINTINA', 17, NULL, NULL),
(366, 'ANCOCHA', 3, NULL, NULL),
(367, 'VILLA ATAMISQUI', 3, NULL, NULL),
(368, 'ESTACION ATAMISQUI', 3, NULL, NULL),
(369, 'EL BOQUERON', 10, NULL, NULL),
(370, 'CHILCA LA LOMA', 3, NULL, NULL),
(371, 'HOYON', 3, NULL, NULL),
(372, 'JUANILLO', 3, NULL, NULL),
(373, 'MEDELLIN', 3, NULL, NULL),
(374, 'PUESTO DEL ROSARIO', 3, NULL, NULL),
(375, 'ROLDAN', 14, NULL, NULL),
(376, 'CHUÑA ALBARDON', 15, NULL, NULL),
(377, 'DIENTE DEL ARADO', 15, NULL, NULL),
(378, 'KILOMETRO 88', 15, NULL, NULL),
(379, 'LORETO', 15, NULL, NULL),
(380, 'POZO CIEGO', 15, NULL, NULL),
(381, 'VILLA VIEJA', 15, NULL, NULL),
(382, 'AMBARGASTA', 18, NULL, NULL),
(383, 'EL CACHI', 18, NULL, NULL),
(384, 'LAS CANTINAS', 13, NULL, NULL),
(385, 'KILOMETRO 49', 18, NULL, NULL),
(386, 'LOMITAS BLANCAS', 18, NULL, NULL),
(387, 'LA MAJADILLA', 18, NULL, NULL),
(389, 'LA PUERTA', 21, NULL, NULL),
(390, 'SUNCHAL', 18, NULL, NULL),
(391, 'VILLA JUANA', 18, NULL, NULL),
(392, 'EL ALBARDON', 16, NULL, NULL),
(393, 'CAMPO DEL CISNE', 20, NULL, NULL),
(394, 'LA CHICHARRA', 20, NULL, NULL),
(395, 'CUCHI CORRAL', 20, NULL, NULL),
(396, 'HORCOS TUCUCUNA', 20, NULL, NULL),
(397, 'PASO DE OSCARES', 20, NULL, NULL),
(398, 'EL PUEBLITO', 20, NULL, NULL),
(399, 'RAMA PASO', 20, NULL, NULL),
(400, 'RAMIREZ DE VELAZCO', 20, NULL, NULL),
(401, 'RIO VIEJO', 20, NULL, NULL),
(402, 'SACHA POZO', 5, NULL, NULL),
(403, 'SUMAMPA', 20, NULL, NULL),
(404, 'VILLA QUEBRACHO', 20, NULL, NULL),
(405, 'ATOJ POZO', 25, NULL, NULL),
(406, 'BARRANCA', 3, NULL, NULL),
(407, 'BARRANCA COLORADA', 25, NULL, NULL),
(408, 'DIASPA', 25, NULL, NULL),
(409, 'ESTACION ROBLES', 25, NULL, NULL),
(410, 'PERCHIL BAJO', 25, NULL, NULL),
(411, 'POZO MOSOJ', 25, NULL, NULL),
(412, 'SALBIAIOG', 25, NULL, NULL),
(413, 'TIO POZO', 15, NULL, NULL),
(414, 'ANGA', 24, NULL, NULL),
(415, 'EL CANDELARIO', 24, NULL, NULL),
(416, 'CARRETA PASO', 24, NULL, NULL),
(417, 'CHILCA JULIANA', 24, NULL, NULL),
(418, 'ESTANCIA VIEJA', 7, NULL, NULL),
(419, 'MALOTA', 24, NULL, NULL),
(420, 'LA PALIZA', 24, NULL, NULL),
(421, 'RUBIA PASO', 24, NULL, NULL),
(422, 'SALADILLO DEL ROSARIO', 24, NULL, NULL),
(423, 'SAN CLEMENTE', 24, NULL, NULL),
(424, 'VARAS CUCHUNA', 24, NULL, NULL),
(425, 'VILLA SALAVINA', 24, NULL, NULL),
(426, 'TERMAS DE RIO HONDO', 21, NULL, NULL),
(427, 'CAMPO AMOR', 15, NULL, NULL),
(428, 'CASHICO', 13, NULL, NULL),
(429, 'CERRO RICO', 8, NULL, NULL),
(430, 'CHAÑAR POZO DEL MEDIO', 21, NULL, NULL),
(431, 'COLONIA LIBARONA', 1, NULL, NULL),
(432, 'CORONEL RICO', 2, NULL, NULL),
(433, 'DOS PROVINCIAS', 22, NULL, NULL),
(434, 'EL CHARCO', 13, NULL, NULL),
(435, 'EL CRUCERO', 10, NULL, NULL),
(436, 'ESTACION LA PUNTA', 8, NULL, NULL),
(437, 'ESTACION SIMBOLAR', 5, NULL, NULL),
(438, 'GUAYPE', 26, NULL, NULL),
(439, 'ISCA YACU', 13, NULL, NULL),
(440, 'KILOMETRO 477', 11, NULL, NULL),
(441, 'LA CHEJCHILA', 5, NULL, NULL),
(442, 'LA COSTOSA', 13, NULL, NULL),
(443, 'LOS ENCANTOS', 22, NULL, NULL),
(444, 'LOS TELARES', 24, NULL, NULL),
(445, 'MACKINLAY', 22, NULL, NULL),
(446, 'ORATORIO', 20, NULL, NULL),
(447, 'POZO DEL TOBA', 14, NULL, NULL),
(448, 'POZO LIMPIO', 2, NULL, NULL),
(449, 'PUERTA CHIQUITA', 12, NULL, NULL),
(450, 'SAN JERONIMO', 15, NULL, NULL),
(451, 'SAN PEDRO DE GUASAYAN', 12, NULL, NULL),
(452, 'SELVA', 22, NULL, NULL),
(453, 'SOL DE JULIO', 20, NULL, NULL),
(454, 'TABOADA', 25, NULL, NULL),
(455, 'TRES LAGUNAS', 6, NULL, NULL),
(456, 'VILLA ABREGU', 11, NULL, NULL),
(457, 'VILLA FIGUEROA', 10, NULL, NULL),
(458, 'VILLA UNION', 16, NULL, NULL),
(459, 'EMPACHAO', 23, NULL, NULL),
(460, 'LA NUEVA TRINIDAD', 5, NULL, NULL),
(461, 'ISLA VERDE', 15, NULL, NULL),
(462, 'EL CUADRADO', 16, NULL, NULL),
(463, 'TOTORILLAS', 5, NULL, NULL),
(464, 'LUJAN', 5, NULL, NULL),
(465, 'EL ALBARDON', 5, NULL, NULL),
(466, 'VILLA OJO DE AGUA', 18, NULL, NULL),
(467, 'INGENIERO FORRES', 23, NULL, NULL),
(468, 'EL ALBARDON', 24, NULL, NULL),
(469, 'SAN FELIPE', 5, NULL, NULL),
(470, 'CASPI CORRAL', 5, NULL, NULL),
(471, 'LOMA YESO', 12, NULL, NULL),
(472, 'YANDA', 7, NULL, NULL),
(473, 'EL CORRALITO', 19, NULL, NULL),
(474, 'SAN JOSE', 12, NULL, NULL),
(475, 'TORO YACU', 13, NULL, NULL),
(476, 'LA INVERNADA', 10, NULL, NULL),
(477, 'SAN FELIPE', 10, NULL, NULL),
(478, 'CAMPO \"LA INES\"', 11, NULL, NULL),
(479, 'LAS LOMAS', 14, NULL, NULL),
(480, 'BAJO GRANDE', 5, NULL, NULL),
(481, 'EL SALADILLO', 10, NULL, NULL),
(482, 'FISCO DE FÁTIMA', 13, NULL, NULL),
(483, 'PUESTO LOS MARCOS', 5, NULL, NULL),
(484, 'SOL DE JULIO', 18, NULL, NULL),
(485, 'EL BRAGADO', 17, NULL, NULL),
(486, 'LAS TIJERAS', 5, NULL, NULL),
(487, 'TALA POCITO', 25, NULL, NULL),
(488, 'LAS CHESCHILAS', 5, NULL, NULL),
(489, 'EL CERCADO', 5, NULL, NULL),
(490, 'LAS CAPAS', 9, NULL, NULL),
(491, 'CAMPO ALEGRE', 9, NULL, NULL),
(492, 'PUNCO', 17, NULL, NULL),
(493, 'BAJADITA', 5, NULL, NULL),
(494, 'YASTA SUMAJ', 9, NULL, NULL),
(495, 'LA LAGUNA', 18, NULL, NULL),
(496, 'VASTA SUMAJ', 9, NULL, NULL),
(497, 'BUEY MUERTO', 23, NULL, NULL),
(498, 'EL PORVENIR', 21, NULL, NULL),
(499, 'NARANJITO', 21, NULL, NULL),
(500, 'SANTA CATALINA', 8, NULL, NULL),
(501, 'EL POLEAR', 5, NULL, NULL),
(502, 'LAS TOMAS', 19, NULL, NULL),
(503, 'TABOADA', 23, NULL, NULL),
(504, 'LA CAPILLA', 5, NULL, NULL),
(505, 'COLONIA MARIA ELENA', 5, NULL, NULL),
(506, 'PARAJE LAS AMERICAS', 2, NULL, NULL),
(507, 'MALBRAN', 16, NULL, NULL),
(508, 'TORO POZO', 24, NULL, NULL),
(509, 'LOTE 18', 19, NULL, NULL),
(510, 'GRAMILLA', 21, NULL, NULL),
(511, 'BOCA DEL TIGRE', 21, NULL, NULL),
(512, 'EL CHARCO', 21, NULL, NULL),
(513, 'ANGOLA', 10, NULL, NULL),
(514, 'SAN ROQUE', 10, NULL, NULL),
(515, 'TENENE VIEJO', 13, NULL, NULL),
(516, 'MANSUPA', 21, NULL, NULL),
(517, 'MAQUITO', 7, NULL, NULL),
(519, 'RINCON GRANDE', 13, NULL, NULL),
(520, 'SAN PEDRO', 13, NULL, NULL),
(521, 'LOS CARDOZO', 7, NULL, NULL),
(522, 'PUEBLO NUEVO', 7, NULL, NULL),
(523, 'ANTILO', 7, NULL, NULL),
(524, 'LA DONOSA', 21, NULL, NULL),
(525, 'SAN PABLO', 21, NULL, NULL),
(526, 'PUESTO LA SOLEDAD', 21, NULL, NULL),
(527, 'LA SOLEDAD', 21, NULL, NULL),
(528, 'EL PUESTITO', 21, NULL, NULL),
(529, 'ISLA DE LOS SOTELOS', 21, NULL, NULL),
(530, 'LOMA DEL MEDIO', 21, NULL, NULL),
(531, 'SOTELILLOS', 21, NULL, NULL),
(532, 'PUESTO LA LINDA', 21, NULL, NULL),
(533, 'CAÑADA DEL MONTE', 21, NULL, NULL),
(534, 'TAQUELLO', 21, NULL, NULL),
(535, 'TALA MUYO', 21, NULL, NULL),
(536, 'LOS RALOS', 21, NULL, NULL),
(537, 'LAS ABRAS', 21, NULL, NULL),
(539, 'LAS TINAJAS', 21, NULL, NULL),
(540, 'EL MANANTIAL', 21, NULL, NULL),
(541, 'CHAÑAR', 21, NULL, NULL),
(542, 'LOS OVEJEROS', 21, NULL, NULL),
(543, 'ISLA DE ARAGON', 21, NULL, NULL),
(544, 'HUNCOS', 21, NULL, NULL),
(545, 'LESCANO', 21, NULL, NULL),
(546, 'LA AGUADA', 21, NULL, NULL),
(547, 'BARRIALITO', 21, NULL, NULL),
(548, 'ISLA DE LOS CASTILLOS', 21, NULL, NULL),
(549, 'PARANA', 12, NULL, NULL),
(550, 'LOS TUNALES', 13, NULL, NULL),
(551, 'AGUAS DULCES', 21, NULL, NULL),
(552, 'BAHOMA', 21, NULL, NULL),
(553, 'PATILLO', 21, NULL, NULL),
(554, 'HABRA DEL MARTIRIZADO', 21, NULL, NULL),
(555, 'LOS SORIA', 5, NULL, NULL),
(556, 'LA ESTANCITA', 7, NULL, NULL),
(557, 'BAJO ALEGRE', 13, NULL, NULL),
(558, 'CORRAL QUEMADO', 13, NULL, NULL),
(559, 'DOLORES', 7, NULL, NULL),
(560, 'COLONIA PINTO', 25, NULL, NULL),
(561, 'LA ESPERANZA', 17, NULL, NULL),
(562, 'EL QUEBRACHAL OESTE', 10, NULL, NULL),
(563, 'PUESTO LAVALLE', 9, NULL, NULL),
(564, 'MARIA LUISA', 5, NULL, NULL),
(565, 'ASPA SINCHI', 5, NULL, NULL),
(567, 'LA GRANJA', 5, NULL, NULL),
(568, 'LAS DELICIAS', 13, NULL, NULL),
(569, 'VILELAS', 17, NULL, NULL),
(570, 'COLORADO', 17, NULL, NULL),
(571, 'CHACO', 17, NULL, NULL),
(572, 'COLONIA GAMARRA', 5, NULL, NULL),
(573, 'ISLA CORRAL', 5, NULL, NULL),
(574, 'SOCONCHO', 3, NULL, NULL),
(575, 'SANTA ROSA', 7, NULL, NULL),
(576, 'EL BAGUAL', 21, NULL, NULL),
(577, 'CARTAVIO', 10, NULL, NULL),
(578, 'MONTE QUEMADO', 19, NULL, NULL),
(579, 'LOS MORALES', 7, NULL, NULL),
(580, 'SANTO DOMINGO', 19, NULL, NULL),
(581, 'SAN BENITO', 7, NULL, NULL),
(582, 'LOS RANOS', 13, NULL, NULL),
(583, 'EL BARRIALITO', 5, NULL, NULL),
(584, 'SAN FELIX', 10, NULL, NULL),
(586, 'CAMPO ALEGRE', 27, NULL, NULL),
(587, 'LA COLONIA', 19, NULL, NULL),
(588, 'TORO HUMAN', 19, NULL, NULL),
(589, 'VITIACA', 13, NULL, NULL),
(590, 'Pje PALO BORRACHO', 23, NULL, NULL),
(591, 'SURI POZO', 5, NULL, NULL),
(592, 'LOS PEREYRA', 23, NULL, NULL),
(593, 'LOS ARIAS', 23, NULL, NULL),
(594, 'Pje CHILQUITA', 23, NULL, NULL),
(595, 'Pje CARA PUJIO', 23, NULL, NULL),
(596, 'KILOMETRO 100', 15, NULL, NULL),
(597, 'TRAMO 26', 5, NULL, NULL),
(598, 'LAS CHACRAS', 5, NULL, NULL),
(599, 'SAN ROQUE', 23, NULL, NULL),
(600, 'LUJAN', 10, NULL, NULL),
(601, '1° de Mayo', 18, NULL, NULL),
(602, 'EL DIQUE', 10, NULL, NULL),
(603, 'LA ENSENADA', 2, NULL, NULL),
(605, 'POZO HONDO', 1, NULL, NULL),
(607, 'invernada norte', 10, NULL, NULL),
(608, 'TRAMO 18', 5, NULL, NULL),
(609, 'TACOYOJ', 5, NULL, NULL),
(610, 'LOTE 7', 11, NULL, NULL),
(611, 'pampa charquina', 17, NULL, NULL),
(612, 'COLONIA SAN JUAN', 10, NULL, NULL),
(613, 'PUESTO RETIRO', 21, NULL, NULL),
(614, 'SURI YACU', 21, NULL, NULL),
(616, 'TENQUI TACU', 21, NULL, NULL),
(617, 'CORRAL GRANDE', 26, NULL, NULL),
(618, 'LA VICTORIA', 5, NULL, NULL),
(619, 'SANTA ELENA', 5, NULL, NULL),
(620, 'LOS ROMANOS', 5, NULL, NULL),
(621, 'LOS PALMARES', 5, NULL, NULL),
(622, 'MONTE RICO', 21, NULL, NULL),
(623, 'POZO GRANDE', 14, NULL, NULL),
(624, 'EL PERCHIL', 5, NULL, NULL),
(625, 'LOS QUIROGA', 7, NULL, NULL),
(626, 'Cara Pujio', 5, NULL, NULL),
(627, 'EL ROSARIO', 23, NULL, NULL),
(628, 'PJE SAUCE BAJADA', 5, NULL, NULL),
(629, 'ESTANCIA VIEJA', 21, NULL, NULL),
(630, 'Pje TUSCA POZO', 23, NULL, NULL),
(631, 'Pje LAS DELICIAS', 23, NULL, NULL),
(632, 'VENTURA PAMPA', 3, NULL, NULL),
(633, 'POZO VERDE', 15, NULL, NULL),
(634, 'LA DORMIDA', 15, NULL, NULL),
(635, 'LA MELEADA', 15, NULL, NULL),
(636, 'TALAPOCITO', 25, NULL, NULL),
(637, 'PUNUA', 15, NULL, NULL),
(638, 'JUMEALITO', 5, NULL, NULL),
(639, 'LOS VELIZ', 5, NULL, NULL),
(640, 'EL ALAMBRADO', 5, NULL, NULL),
(641, 'PUESTO SAN ANTONIO', 21, NULL, NULL),
(642, 'PUNCO', 14, NULL, NULL),
(643, 'MONTE TORO', 14, NULL, NULL),
(644, 'ALZA NUEVA', 17, NULL, NULL),
(646, 'EL TARTAGAL', 19, NULL, NULL),
(647, 'EL REMATE', 19, NULL, NULL),
(648, 'TACO POZO', 19, NULL, NULL),
(649, 'EL SIMBOLAR', 19, NULL, NULL),
(650, 'BAJO GRANDE', 19, NULL, NULL),
(651, 'LA GUANACA', 13, NULL, NULL),
(652, 'LOS PUESTOS', 21, NULL, NULL),
(653, 'TURENA', 23, NULL, NULL),
(654, 'POZO EL ARBOLITO', 21, NULL, NULL),
(655, 'LAS PALMITAS', 21, NULL, NULL),
(656, 'GALEANO', 21, NULL, NULL),
(657, 'POZO CABADO', 10, NULL, NULL),
(658, 'VINAL ISLA', 10, NULL, NULL),
(659, 'TRES CRUCES', 21, NULL, NULL),
(660, 'EL DEANCITO', 7, NULL, NULL),
(661, 'PUESTO EL MEDIO', 5, NULL, NULL),
(662, 'SAN AGUSTIN', 15, NULL, NULL),
(663, 'RUMI ESQUINA', 8, NULL, NULL),
(664, 'LA JULIANA', 10, NULL, NULL),
(665, 'RODEO DE SORIA', 7, NULL, NULL),
(666, 'ABRA DEL MARTIRIZADO', 21, NULL, NULL),
(667, 'MULATO', 15, NULL, NULL),
(668, 'KM 93', 15, NULL, NULL),
(669, 'TAQUETUYO', 15, NULL, NULL),
(670, 'Pje LA LOMA', 23, NULL, NULL),
(671, 'Pje MORCILLO', 23, NULL, NULL),
(672, 'Pje EL ALTO', 13, NULL, NULL),
(673, 'GRAMILLA VIEJA', 21, NULL, NULL),
(674, 'LAS PINAS', 21, NULL, NULL),
(675, 'Pje MANANTIAL DE TOLEDO', 21, NULL, NULL),
(676, 'PALMA REDONDA', 21, NULL, NULL),
(677, 'Pje ANJUCI', 21, NULL, NULL),
(678, 'Pje EL ALTO', 21, NULL, NULL),
(679, 'LOS GALLEGOS', 25, NULL, NULL),
(680, 'POZO EL BARRIAL', 15, NULL, NULL),
(681, 'SANTO DOMINGO', 12, NULL, NULL),
(682, 'EL ALBARDON', 15, NULL, NULL),
(683, 'LA RESBALOSA', 15, NULL, NULL),
(684, 'TUAMILLA', 25, NULL, NULL),
(685, 'QUIMILI BAJADA', 15, NULL, NULL),
(686, 'TACANAS', 15, NULL, NULL),
(687, 'LOS CERCOS', 19, NULL, NULL),
(688, 'CORRAL GRANDE', 14, NULL, NULL),
(689, 'EL TUSQUAL', 14, NULL, NULL),
(690, 'EL 25', 25, NULL, NULL),
(691, 'TILINGO', 25, NULL, NULL),
(692, 'EL PACARA', 13, NULL, NULL),
(693, 'Pje LOS ROMANOS', 23, NULL, NULL),
(694, 'Pje SAN RAMON', 23, NULL, NULL),
(695, 'Pje EL QUEMAO', 23, NULL, NULL),
(696, 'Pje LOAJ', 23, NULL, NULL),
(697, 'Pje ZONA DEL LAGO', 21, NULL, NULL),
(698, 'Pje SAN SERENO ESTACION TABOADA', 21, NULL, NULL),
(699, 'Pje SAN SERENO ESTACION TABOADA', 23, NULL, NULL),
(700, 'Pje ESTANCIA LAS DECIMAS', 21, NULL, NULL),
(702, 'Pje HIGUERA CHACRA', 23, NULL, NULL),
(703, 'LAS FLORES', 25, NULL, NULL),
(704, '40 viviendas', 17, NULL, NULL),
(705, 'EL AÑIL', 13, NULL, NULL),
(706, 'ESTANCIA SUNCHO PUJIO', 13, NULL, NULL),
(707, 'Pje CHAÑAR PUJIO', 13, NULL, NULL),
(708, 'Tuzca Pozo', 10, NULL, NULL),
(709, 'LA BAISSE', 25, NULL, NULL),
(710, 'POZO DE FRIAS', 25, NULL, NULL),
(711, 'PAMPA ATUN', 25, NULL, NULL),
(712, 'SANTA BARBARA', 15, NULL, NULL),
(713, 'MONTE REDONDO', 15, NULL, NULL),
(714, 'EL SALADILLO', 15, NULL, NULL),
(715, 'BOQUERON', 3, NULL, NULL),
(716, 'MATADERO', 3, NULL, NULL),
(718, 'YACU CHIRI', 3, NULL, NULL),
(719, 'El Puestito', 7, NULL, NULL),
(720, 'Ramadita', 15, NULL, NULL),
(721, 'CHURQUI', 7, NULL, NULL),
(722, 'San Simon', 17, NULL, NULL),
(723, 'Santa Isabel', 3, NULL, NULL),
(724, 'HUAJLA', 3, NULL, NULL),
(725, 'PUESTO DE DIAZ', 3, NULL, NULL),
(726, 'EL BAJO', 25, NULL, NULL),
(727, 'CAMPO GRANDE', 15, NULL, NULL),
(728, 'POZO JUMI', 21, NULL, NULL),
(729, 'LAS GALLINITAS', 21, NULL, NULL),
(730, 'AMJULI', 21, NULL, NULL),
(731, 'sportivo', 15, NULL, NULL),
(732, 'EL PUESTO', 14, NULL, NULL),
(733, 'EL QUEBRACHAL', 23, NULL, NULL),
(734, 'Pje SIN CHICAÑA', 8, NULL, NULL),
(735, 'SAN PABLO', 17, NULL, NULL);

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
  `cycle_id` bigint(20) NOT NULL,
  `nationality_id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `location_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` int(11) NOT NULL,
  `year_income` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`id`, `user_id`, `career_id`, `cycle_id`, `nationality_id`, `province_id`, `department_id`, `location_id`, `location_description`, `last_name`, `first_name`, `dni`, `year_income`, `address`, `address_street`, `address_number`, `address_flat`, `address_departament`, `address_cp`, `status`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 1, 2, 1, 1, 2, 7, 2, NULL, 'Orpi', 'Marta', 29376926, NULL, 'prueba', NULL, NULL, NULL, NULL, NULL, 'Solicitado', 'Marta Orpi', NULL, '2021-11-09 14:49:22', '2021-11-09 14:49:22');

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
  ADD KEY `students_location_id_foreign` (`location_id`),
  ADD KEY `cycle_id` (`cycle_id`),
  ADD KEY `department_id` (`department_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=737;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
