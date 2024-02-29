-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-12-2023 a las 13:41:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `elnombrequequiero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ate_profesor`
--

CREATE TABLE `ate_profesor` (
  `id` int(10) UNSIGNED NOT NULL,
  `NIF` varchar(9) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `ciudad` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ate_profesor`
--

INSERT INTO `ate_profesor` (`id`, `NIF`, `nombre`, `apellido1`, `apellido2`, `ciudad`) VALUES
(1, '26902806M', 'Salvador', 'Sánchez', 'Pérez', 'Almería'),
(2, '89542419S', 'Juan', 'Saez', 'Vega', 'Almería'),
(3, '11105554G', 'Zoe', 'Ramirez', 'Gea', 'Almería'),
(4, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería'),
(5, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(6, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(7, '97258166K', 'Ismael', 'Strosin', 'Turcotte', 'Almería'),
(8, '79503962T', 'Cristina', 'Lemke', 'Rutherford', 'Almería'),
(9, '82842571K', 'Ramón', 'Herzog', 'Tremblay', 'Almería'),
(10, '61142000L', 'Esther', 'Spencer', 'Lakin', 'Almería'),
(11, '46900725E', 'Daniel', 'Herman', 'Pacocha', 'Almería'),
(12, '85366986W', 'Carmen', 'Streich', 'Hirthe', 'Almería'),
(13, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería'),
(14, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(15, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(16, '97258166K', 'Ismael', 'Strosin', 'Turcotte', 'Almería'),
(17, '79503962T', 'Cristina', 'Lemke', 'Rutherford', 'Almería'),
(18, '82842571K', 'Ramón', 'Herzog', 'Tremblay', 'Almería'),
(19, '61142000L', 'Esther', 'Spencer', 'Lakin', 'Almería'),
(20, '46900725E', 'Daniel', 'Herman', 'Pacocha', 'Almería'),
(21, '26902806M', 'Salvador', 'Sánchez', 'Pérez', 'Almería'),
(22, '89542419S', 'Juan', 'Saez', 'Vega', 'Almería'),
(23, '11105554G', 'Zoe', 'Ramirez', 'Gea', 'Almería'),
(24, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería'),
(25, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(26, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(27, '97258166K', 'Ismael', 'Strosin', 'Turcotte', 'Almería'),
(28, '79503962T', 'Cristina', 'Lemke', 'Rutherford', 'Almería'),
(29, '82842571K', 'Ramón', 'Herzog', 'Tremblay', 'Almería'),
(30, '61142000L', 'Esther', 'Spencer', 'Lakin', 'Almería'),
(31, '46900725E', 'Daniel', 'Herman', 'Pacocha', 'Almería'),
(32, '85366986W', 'Carmen', 'Streich', 'Hirthe', 'Almería'),
(33, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería'),
(34, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(35, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(36, '97258166K', 'Ismael', 'Strosin', 'Turcotte', 'Almería'),
(37, '79503962T', 'Cristina', 'Lemke', 'Rutherford', 'Almería'),
(38, '82842571K', 'Ramón', 'Herzog', 'Tremblay', 'Almería'),
(39, '61142000L', 'Esther', 'Spencer', 'Lakin', 'Almería'),
(40, '46900725E', 'Daniel', 'Herman', 'Pacocha', 'Almería'),
(41, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(42, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(43, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería'),
(44, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(45, '89542419S', 'Juan', 'Saez', 'Vega', 'Almería'),
(46, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(47, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(48, '89542419S', 'Juan', 'Saez', 'Vega', 'Almería'),
(49, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(50, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(51, '89542419S', 'Juan', 'Saez', 'Vega', 'Almería'),
(52, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería'),
(53, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(54, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(55, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería'),
(56, '89542419S', 'Juan', 'Saez', 'Vega', 'Almería'),
(57, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(58, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(59, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería'),
(60, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(61, '89542419S', 'Juan', 'Saez', 'Vega', 'Almería'),
(62, '89542419S', 'Juan', 'Saez', 'Vega', 'Almería'),
(63, '11105554G', 'Zoe', 'Ramirez', 'Gea', 'Almería'),
(64, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería'),
(65, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(66, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(67, '97258166K', 'Ismael', 'Strosin', 'Turcotte', 'Almería'),
(68, '79503962T', 'Cristina', 'Lemke', 'Rutherford', 'Almería'),
(69, '82842571K', 'Ramón', 'Herzog', 'Tremblay', 'Almería'),
(70, '61142000L', 'Esther', 'Spencer', 'Lakin', 'Almería'),
(71, '46900725E', 'Daniel', 'Herman', 'Pacocha', 'Almería'),
(72, '85366986W', 'Carmen', 'Streich', 'Hirthe', 'Almería'),
(73, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería'),
(74, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería'),
(75, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería'),
(76, '97258166K', 'Ismael', 'Strosin', 'Turcotte', 'Almería'),
(77, '79503962T', 'Cristina', 'Lemke', 'Rutherford', 'Almería'),
(78, '82842571K', 'Ramón', 'Herzog', 'Tremblay', 'Almería'),
(79, '61142000L', 'Esther', 'Spencer', 'Lakin', 'Almería'),
(80, '46900725E', 'Daniel', 'Herman', 'Pacocha', 'Almería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `at_cliente`
--

CREATE TABLE `at_cliente` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `categoria` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `at_cliente`
--

INSERT INTO `at_cliente` (`id`, `nombre`, `apellido1`, `apellido2`, `ciudad`, `categoria`) VALUES
(1, 'Aarón', 'Rivero', 'Gómez', 'Almería', 100),
(2, 'Adela', 'Salas', 'Díaz', 'Granada', 200),
(3, 'Adolfo', 'Rubio', 'Flores', 'Sevilla', 125),
(4, 'Adrián', 'Suárez', NULL, 'Jaén', 300),
(5, 'Marcos', 'Loyola', 'Méndez', 'Almería', 200),
(6, 'María', 'Santana', 'Moreno', 'Cádiz', 100),
(7, 'Pilar', 'Ruiz', NULL, 'Sevilla', 300),
(8, 'Pepe', 'Ruiz', 'Santana', 'Huelva', 200),
(9, 'Guillermo', 'López', 'Gómez', 'Granada', 225),
(10, 'Daniel', 'Santana', 'Loyola', 'Sevilla', 125),
(11, 'Daniel', 'Sáez', 'Vega', 'Zaragoza', 150),
(12, 'Juan', 'Gómez', 'López', 'Huelva', 200),
(13, 'Diego', 'Flores', 'Salas', 'Zaragoza', 150),
(14, 'Marta', 'Herrera', 'Vega', 'Bilbao', 125),
(15, 'Antonio', 'Carretero', 'Ortega', 'Huelva', 150),
(16, 'Manuel', 'Domínguez', 'Hernández', 'Zaragoza', 125),
(17, 'Antonio', 'Vega', 'Hernández', 'Bilbao', 125),
(18, 'Alfredo', 'Ruiz', 'Flores', 'Huelva', 200),
(19, 'Marcos', 'Loyola', 'Méndez', 'Zaragoza', 150),
(20, 'María', 'Santana', 'Moreno', 'Bilbao', 125),
(21, 'Pepe', 'Ruiz', 'Santana', 'Huelva', 200),
(22, 'Guillermo', 'López', 'Gómez', 'Zaragoza', 150),
(23, 'Daniel', 'Santana', 'Loyola', 'Bilbao', 125),
(24, 'Pilar', 'Ruiz', 'Ruiz', 'Zaragoza', 200),
(25, 'Antonio', 'Loyola', 'Ortega', 'Zaragoza', 150),
(26, 'Juan', 'Vega', 'Vega', 'Huelva', 125),
(27, 'Aarón', 'Rivero', 'Gómez', 'Almería', 125),
(28, 'Adela', 'Hernández', 'Díaz', 'Cádiz', 125),
(29, 'Adolfo', 'Rubio', 'Flores', 'Almería', 150),
(30, 'Adrián', 'Suárez', NULL, 'Cádiz', 200),
(31, 'Marcos', 'Vega', 'Méndez', 'Huelva', 125),
(32, 'María', 'Santana', 'Moreno', 'Cádiz', 150),
(33, 'Pilar', 'Ruiz', NULL, 'Almería', 200),
(34, 'Pepe', 'Vega', 'Santana', 'Cádiz', 125),
(35, 'Juan', 'Gómez', 'López', 'Almería', 150),
(36, 'Diego', 'Flores', 'Salas', 'Cádiz', 200),
(37, 'Marta', 'Herrera', 'Gil', 'Almería', 200),
(38, 'Irene', 'Salas', 'Flores', 'Cádiz', 150),
(39, 'Juan Antonio', 'Sáez', 'Guerrero', 'Cádiz', NULL),
(40, 'Aarón', 'Rivero', 'Gómez', 'Almería', 150),
(41, 'Adela', 'Salas', 'Díaz', 'Granada', 200),
(42, 'Adolfo', 'Rubio', 'Flores', 'Sevilla', 125),
(43, 'Adrián', 'Hernández', NULL, 'Jaén', 300),
(44, 'Marcos', 'Loyola', 'Méndez', 'Almería', 200),
(45, 'María', 'Santana', 'Moreno', 'Cádiz', 100),
(46, 'Pilar', 'Hernández', 'Hernández', 'Sevilla', 300),
(47, 'Pepe', 'Ruiz', 'Santana', 'Huelva', 200),
(48, 'Guillermo', 'López', 'Suárez', 'Granada', 225),
(49, 'Daniel', 'Santana', 'Loyola', 'Sevilla', 125),
(50, 'Daniel', 'Hernández', 'Vega', 'Granada', 200),
(51, 'Juan', 'Hernández', 'López', 'Sevilla', 125),
(52, 'Diego', 'Flores', 'Salas', 'Granada', 200),
(53, 'Marta', 'Hernández', 'Suárez', 'Sevilla', 125),
(54, 'Antonio', 'Carretero', 'Ortega', 'Granada', 125),
(55, 'Manuel', 'Domínguez', 'Suárez', 'Sevilla', 200),
(56, 'Antonio', 'Vega', 'Hernández', 'Granada', 125),
(57, 'Alfredo', 'Ruiz', 'Suárez', 'Sevilla', 150),
(58, 'Aarón', 'Rivero', 'Gómez', 'Almería', 100),
(59, 'Adela', 'Salas', 'Díaz', 'Granada', 200),
(60, 'Adolfo', 'Rubio', 'Flores', 'Sevilla', 125),
(61, 'Adrián', 'Suárez', NULL, 'Jaén', 300),
(62, 'Marcos', 'Loyola', 'Méndez', 'Almería', 200),
(63, 'María', 'Santana', 'Moreno', 'Cádiz', 100),
(64, 'Pilar', 'Ruiz', NULL, 'Sevilla', 300),
(65, 'Pepe', 'Ruiz', 'Santana', 'Huelva', 200),
(66, 'Guillermo', 'López', 'Gómez', 'Granada', 225),
(67, 'Daniel', 'Santana', 'Loyola', 'Sevilla', 125),
(68, 'Daniel', 'Sáez', 'Vega', 'Zaragoza', 150),
(69, 'Juan', 'Gómez', 'López', 'Huelva', 200),
(70, 'Diego', 'Flores', 'Salas', 'Zaragoza', 150),
(71, 'Marta', 'Herrera', 'Vega', 'Bilbao', 125),
(72, 'Antonio', 'Carretero', 'Ortega', 'Huelva', 150),
(73, 'Manuel', 'Domínguez', 'Hernández', 'Zaragoza', 125),
(74, 'Antonio', 'Vega', 'Hernández', 'Bilbao', 125),
(75, 'Alfredo', 'Ruiz', 'Flores', 'Huelva', 200),
(76, 'Marcos', 'Loyola', 'Méndez', 'Zaragoza', 150),
(77, 'María', 'Santana', 'Moreno', 'Bilbao', 125),
(78, 'Pepe', 'Ruiz', 'Santana', 'Huelva', 200),
(79, 'Guillermo', 'López', 'Gómez', 'Zaragoza', 150),
(80, 'Daniel', 'Santana', 'Loyola', 'Bilbao', 125),
(81, 'Pilar', 'Ruiz', 'Ruiz', 'Zaragoza', 200),
(82, 'Antonio', 'Loyola', 'Ortega', 'Zaragoza', 150),
(83, 'Juan', 'Vega', 'Vega', 'Huelva', 125),
(84, 'Aarón', 'Rivero', 'Gómez', 'Almería', 125),
(85, 'Adela', 'Hernández', 'Díaz', 'Cádiz', 125),
(86, 'Adolfo', 'Rubio', 'Flores', 'Almería', 150),
(87, 'Adrián', 'Suárez', NULL, 'Cádiz', 200),
(88, 'Marcos', 'Vega', 'Méndez', 'Huelva', 125),
(89, 'María', 'Santana', 'Moreno', 'Cádiz', 150),
(90, 'Pilar', 'Ruiz', NULL, 'Almería', 200),
(91, 'Pepe', 'Vega', 'Santana', 'Cádiz', 125),
(92, 'Juan', 'Gómez', 'López', 'Almería', 150),
(93, 'Diego', 'Flores', 'Salas', 'Cádiz', 200),
(94, 'Marta', 'Herrera', 'Gil', 'Almería', 200),
(95, 'Irene', 'Salas', 'Flores', 'Cádiz', 150),
(96, 'Juan Antonio', 'Sáez', 'Guerrero', 'Almería', NULL),
(97, 'Aarón', 'Rivero', 'Gómez', 'Almería', 150),
(98, 'Adela', 'Salas', 'Díaz', 'Granada', 200),
(99, 'Adolfo', 'Rubio', 'Flores', 'Sevilla', 125),
(100, 'Adrián', 'Hernández', NULL, 'Jaén', 300),
(101, 'Marcos', 'Loyola', 'Méndez', 'Almería', 200),
(102, 'María', 'Santana', 'Moreno', 'Cádiz', 100),
(103, 'Pilar', 'Hernández', 'Hernández', 'Sevilla', 300),
(104, 'Pepe', 'Ruiz', 'Santana', 'Huelva', 200),
(105, 'Guillermo', 'López', 'Suárez', 'Granada', 225),
(106, 'Daniel', 'Santana', 'Loyola', 'Sevilla', 125),
(107, 'Daniel', 'Hernández', 'Vega', 'Granada', 200),
(108, 'Juan', 'Hernández', 'López', 'Sevilla', 125),
(109, 'Diego', 'Flores', 'Salas', 'Granada', 200),
(110, 'Marta', 'Hernández', 'Suárez', 'Sevilla', 125),
(111, 'Antonio', 'Carretero', 'Ortega', 'Granada', 125),
(112, 'Manuel', 'Domínguez', 'Suárez', 'Sevilla', 200),
(113, 'Antonio', 'Vega', 'Hernández', 'Granada', 125),
(114, 'Alfredo', 'Ruiz', 'Suárez', 'Sevilla', 150),
(115, 'Aarón', 'Rivero', 'Gómez', 'Almería', 100),
(116, 'Adela', 'Salas', 'Díaz', 'Granada', 200),
(117, 'Adolfo', 'Rubio', 'Flores', 'Sevilla', 125),
(118, 'Adrián', 'Suárez', NULL, 'Jaén', 300),
(119, 'Marcos', 'Loyola', 'Méndez', 'Almería', 200),
(120, 'María', 'Santana', 'Moreno', 'Cádiz', 100),
(121, 'Pilar', 'Ruiz', NULL, 'Sevilla', 300),
(122, 'Pepe', 'Ruiz', 'Santana', 'Huelva', 200),
(123, 'Guillermo', 'López', 'Gómez', 'Granada', 225),
(124, 'Daniel', 'Santana', 'Loyola', 'Sevilla', 125),
(125, 'Daniel', 'Sáez', 'Vega', 'Zaragoza', 150),
(126, 'Juan', 'Gómez', 'López', 'Huelva', 200),
(127, 'Diego', 'Flores', 'Salas', 'Zaragoza', 150),
(128, 'Marta', 'Herrera', 'Vega', 'Bilbao', 125),
(129, 'Antonio', 'Carretero', 'Ortega', 'Huelva', 150),
(130, 'Manuel', 'Domínguez', 'Hernández', 'Zaragoza', 125),
(131, 'Antonio', 'Vega', 'Hernández', 'Bilbao', 125),
(132, 'Alfredo', 'Ruiz', 'Flores', 'Huelva', 200),
(133, 'Marcos', 'Loyola', 'Méndez', 'Zaragoza', 150),
(134, 'María', 'Santana', 'Moreno', 'Bilbao', 125),
(135, 'Pepe', 'Ruiz', 'Santana', 'Huelva', 200),
(136, 'Guillermo', 'López', 'Gómez', 'Zaragoza', 150),
(137, 'Daniel', 'Santana', 'Loyola', 'Bilbao', 125),
(138, 'Pilar', 'Ruiz', 'Ruiz', 'Zaragoza', 200),
(139, 'Antonio', 'Loyola', 'Ortega', 'Zaragoza', 150),
(140, 'Juan', 'Vega', 'Vega', 'Huelva', 125),
(141, 'Aarón', 'Rivero', 'Gómez', 'Almería', 125),
(142, 'Adela', 'Hernández', 'Díaz', 'Cádiz', 125),
(143, 'Adolfo', 'Rubio', 'Flores', 'Almería', 150),
(144, 'Adrián', 'Suárez', NULL, 'Cádiz', 200),
(145, 'Marcos', 'Vega', 'Méndez', 'Huelva', 125),
(146, 'María', 'Santana', 'Moreno', 'Cádiz', 150),
(147, 'Pilar', 'Ruiz', NULL, 'Almería', 200),
(148, 'Pepe', 'Vega', 'Santana', 'Cádiz', 125),
(149, 'Juan', 'Gómez', 'López', 'Almería', 150),
(150, 'Diego', 'Flores', 'Salas', 'Cádiz', 200),
(151, 'Marta', 'Herrera', 'Gil', 'Almería', 200),
(152, 'Irene', 'Salas', 'Flores', 'Cádiz', 150),
(153, 'Juan Antonio', 'Sáez', 'Guerrero', 'Almería', NULL),
(154, 'Aarón', 'Rivero', 'Gómez', 'Almería', 150),
(155, 'Adela', 'Salas', 'Díaz', 'Granada', 200),
(156, 'Adolfo', 'Rubio', 'Flores', 'Sevilla', 125),
(157, 'Adrián', 'Hernández', NULL, 'Jaén', 300),
(158, 'Marcos', 'Loyola', 'Méndez', 'Almería', 200),
(159, 'María', 'Santana', 'Moreno', 'Cádiz', 100),
(160, 'Pilar', 'Hernández', 'Hernández', 'Sevilla', 300),
(161, 'Pepe', 'Ruiz', 'Santana', 'Huelva', 200),
(162, 'Guillermo', 'López', 'Suárez', 'Granada', 225),
(163, 'Daniel', 'Santana', 'Loyola', 'Sevilla', 125),
(164, 'Daniel', 'Hernández', 'Vega', 'Granada', 200),
(165, 'Juan', 'Hernández', 'López', 'Sevilla', 125),
(166, 'Diego', 'Flores', 'Salas', 'Granada', 200),
(167, 'Marta', 'Hernández', 'Suárez', 'Sevilla', 125),
(168, 'Antonio', 'Carretero', 'Ortega', 'Granada', 125),
(169, 'Manuel', 'Domínguez', 'Suárez', 'Sevilla', 200),
(170, 'Antonio', 'Vega', 'Hernández', 'Granada', 125),
(171, 'Alfredo', 'Ruiz', 'Suárez', 'Sevilla', 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `categoría` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido1`, `apellido2`, `ciudad`, `categoría`) VALUES
(1, 'Aarón', 'Rivero', 'Gómez', 'Almería', 100),
(2, 'Adela', 'Salas', 'Díaz', 'Granada', 200),
(3, 'Adolfo', 'Rubio', 'Flores', 'Sevilla', NULL),
(4, 'Adrián', 'Suárez', NULL, 'Jaén', 300),
(5, 'Marcos', 'Loyola', 'Méndez', 'Almería', 200),
(6, 'María', 'Santana', 'Moreno', 'Cádiz', 100),
(7, 'Pilar', 'Ruiz', NULL, 'Sevilla', 300),
(8, 'Pepe', 'Ruiz', 'Santana', 'Huelva', 200),
(9, 'Guillermo', 'López', 'Gómez', 'Granada', 225),
(10, 'Daniel', 'Santana', 'Loyola', 'Sevilla', 125);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datospersonales`
--

CREATE TABLE `datospersonales` (
  `id` int(10) UNSIGNED NOT NULL,
  `clave_hash` varchar(255) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidoPaterno` varchar(255) DEFAULT NULL,
  `apellidoMaterno` varchar(255) DEFAULT NULL,
  `correoElectronico` varchar(255) DEFAULT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fechaNacimiento` date DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datospersonales`
--

INSERT INTO `datospersonales` (`id`, `clave_hash`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `correoElectronico`, `fechaCreacion`, `fechaNacimiento`, `telefono`) VALUES
(1, 'hash1', 'Juan', 'Gómez', 'López', 'juan@example.com', '2023-10-20 10:00:00', '1990-05-15', '1234567890'),
(2, 'hash2', 'Ana', 'Martínez', 'Sánchez', 'ana@example.com', '2023-10-20 12:30:00', '1985-08-25', '9876543210'),
(3, 'hash3', 'Pedro', 'Rodríguez', 'Fernández', 'pedro@example.com', '2023-10-21 07:15:00', '1995-03-10', '5555555555'),
(4, 'hash4', 'María', 'López', 'González', 'maria@example.com', '2023-10-21 09:45:00', '2000-12-03', '9999999999');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nif`, `nombre`, `apellido1`, `apellido2`) VALUES
(1, '32481596F', 'Aarón ', 'Rivero', 'Gómez'),
(2, 'Y5575632D', 'Adela', 'Salas', 'Díaz'),
(3, 'R6970642B', 'Adolfo', 'Rubio', 'Flores'),
(4, '77705545E', 'Adrián', 'Suárez', 'Floresss'),
(6, '38382980M', 'Marías', 'Santana', 'Moreno'),
(7, '80576669X', 'Pilar', 'Ruiz', 'Flores'),
(8, '71651431Z', 'Pepe', 'Ruiz', 'Santana'),
(9, '56399183D', 'Juan', 'Gómez', 'López'),
(10, '46384486H', 'Diego', 'Flores', 'Salas'),
(11, '67389283A', 'Marta', 'Herrera', 'Gil'),
(12, '41234836R', 'Irene', 'Salas', 'Flores'),
(13, '82635162B', 'Juan Antonio', 'Sáez', 'Guerreros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_departamento`
--

CREATE TABLE `emp_departamento` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `presupuesto` double UNSIGNED NOT NULL,
  `gastos` double UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `emp_departamento`
--

INSERT INTO `emp_departamento` (`id`, `nombre`, `presupuesto`, `gastos`) VALUES
(1, 'Desarrollo', 120000, 6000),
(2, 'Sistemas', 150000, 21000),
(3, 'Recursos Humanos', 280000, 25000),
(4, 'Contabilidad', 110000, 3000),
(5, 'I+D', 375000, 380000),
(6, 'Proyectos', 0, 0),
(7, 'Publicidad', 0, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_empleado`
--

CREATE TABLE `emp_empleado` (
  `id` int(10) UNSIGNED NOT NULL,
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `fk_departamento` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `emp_empleado`
--

INSERT INTO `emp_empleado` (`id`, `nif`, `nombre`, `apellido1`, `apellido2`, `fk_departamento`) VALUES
(1, '32481596F', 'Aarón', 'Rivero', 'Gómez', 1),
(2, 'Y5575632D', 'Adela', 'Salas', 'Díaz', 2),
(3, 'R6970642B', 'Adolfo', 'Rubio', 'Flores', 3),
(4, '77705545E', 'Adrián', 'Suárez', NULL, 4),
(5, '17087203C', 'Marcos', 'Loyola', 'Méndez', 5),
(6, '38382980M', 'María', 'Santana', 'Moreno', 1),
(7, '80576669X', 'Pilar', 'Ruiz', NULL, 2),
(8, '71651431Z', 'Pepe', 'Ruiz', 'Santana', 3),
(9, '56399183D', 'Juan', 'Gómez', 'López', 2),
(10, '46384486H', 'Diego', 'Flores', 'Salas', 5),
(11, '67389283A', 'Marta', 'Herrera', 'Gil', 1),
(12, '41234836R', 'Irene', 'Salas', 'Flores', NULL),
(13, '82635162B', 'Juan Antonio', 'Sáez', 'Guerrero', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_empl`
--

CREATE TABLE `examen_empl` (
  `id` int(10) UNSIGNED NOT NULL,
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `examen_empl`
--

INSERT INTO `examen_empl` (`id`, `nif`, `nombre`, `apellido1`, `apellido2`) VALUES
(1, '32481596F', 'Aarón', 'Rivero', 'Gómez'),
(2, 'Y5575632D', 'Adela', 'Salas', 'Díaz'),
(3, 'R6970642B', 'Adolfo', 'Rubio', 'Flores'),
(4, '77705545E', 'Adrián', 'Suárez', NULL),
(5, '17087203C', 'Marcos', 'Loyola', 'Méndez'),
(6, '38382980M', 'María', 'Santana', 'Moreno'),
(7, '80576669X', 'Pilar', 'Ruiz', NULL),
(8, '71651431Z', 'Pepe', 'Ruiz', 'Santana'),
(9, '56399183D', 'Juan', 'Gómez', 'López'),
(10, '46384486H', 'Diego', 'Flores', 'Salas'),
(11, '67389283A', 'Marta', 'Herrera', 'Gil'),
(12, '41234836R', 'Irene', 'Salas', 'Flores'),
(13, '82635162B', 'Juan Antonio', 'Sáez', 'Guerrero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ex_fabricante`
--

CREATE TABLE `ex_fabricante` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ex_fabricante`
--

INSERT INTO `ex_fabricante` (`id`, `nombre`) VALUES
(1, 'Asus'),
(2, 'Lenovo'),
(3, 'Hewlett-Packard'),
(4, 'Samsung'),
(5, 'Seagate'),
(6, 'Crucial'),
(7, 'Gigabyte'),
(8, 'Huawei'),
(9, 'Xiaomi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ex_producto`
--

CREATE TABLE `ex_producto` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` double NOT NULL,
  `fk_fabricante` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ex_producto`
--

INSERT INTO `ex_producto` (`id`, `nombre`, `precio`, `fk_fabricante`) VALUES
(1, 'Disco duro SATA3 1TB', 86.99, 5),
(2, 'Memoria RAM DDR4 8GB', 120, 6),
(3, 'Disco SSD 1 TB', 150.99, 4),
(4, 'GeForce GTX 1050Ti', 185, 7),
(5, 'GeForce GTX 1080 Xtreme', 755, 6),
(6, 'Monitor 24 LED Full HD', 202, 1),
(7, 'Monitor 27 LED Full HD', 245.99, 1),
(8, 'Portátil Yoga 520', 559, 2),
(9, 'Portátil Ideapd 320', 444, 2),
(10, 'Impresora HP Deskjet 3720', 59.99, 3),
(11, 'Impresora HP Laserjet Pro M26nw', 180, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lib_editorial`
--

CREATE TABLE `lib_editorial` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lib_editorial`
--

INSERT INTO `lib_editorial` (`id`, `nombre`) VALUES
(1, 'STARBOOK\r\n'),
(2, 'RA-MA'),
(3, 'RBA'),
(4, 'AKRON'),
(5, 'JVLIUS'),
(6, 'CRUCIAL'),
(7, 'ANAYA'),
(8, 'HUMVS'),
(9, 'PARANINFO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lib_libreria`
--

CREATE TABLE `lib_libreria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` double NOT NULL,
  `fk_editorial` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lib_libreria`
--

INSERT INTO `lib_libreria` (`id`, `nombre`, `precio`, `fk_editorial`) VALUES
(1, 'La sombra del viento', 86.99, 5),
(2, 'Cuando ya no sea yo', 20, 6),
(3, 'Todo va a mejorar', 50.99, 4),
(4, 'El viento conoce mi nombre', 18, 7),
(5, 'El poder de confiar en tí', 55, 6),
(6, 'El señor de los anillos', 20, 1),
(7, 'Cien años de soledad', 45.99, 1),
(8, 'El principito', 55, 2),
(9, 'Un mundo feliz', 44, 2),
(10, 'Orgullo y Prejuicio', 50.99, 3),
(11, 'Crimen y castigo', 18, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `titulo` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `enlace` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `titulo`, `enlace`) VALUES
(1, 'Inicio', 'index.php'),
(2, 'Noticias', 'noticias.php'),
(3, 'Nosotros', 'nosotros.php'),
(4, 'Contacto', 'contacto.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `usuario` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(32) NOT NULL,
  `edicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `usuario`, `pass`, `edicion`) VALUES
(1, 'fermin', '926e27eecdbc7a18858b3798ba99bddd', 0),
(6, 'luis', '926e27eecdbc7a18858b3798ba99bddd', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`) VALUES
(1, 'Disco duro SATA3 1TB', 86.99),
(2, 'Memoria RAM DDR4 8GB', 120),
(3, 'Disco SSD 1 TB', 150.99),
(4, 'GeForce GTX 1050Ti', 185),
(5, 'GeForce GTX 1080 Xtreme', 755),
(6, 'Monitor 24 LED Full HD', 202),
(7, 'Monitor 27 LED Full HD', 245.99),
(8, 'Portátil Yoga 520', 559),
(9, 'Portátil Ideapd 320', 444),
(10, 'Impresora HP Deskjet 3720', 59.99),
(11, 'Impresora HP Laserjet Pro M26nw', 180);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sb_comercial`
--

CREATE TABLE `sb_comercial` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `comisión` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sb_comercial`
--

INSERT INTO `sb_comercial` (`id`, `nombre`, `apellido1`, `apellido2`, `comisión`) VALUES
(1, 'Daniel', 'Sáez', 'Vega', 0.15),
(2, 'Juan', 'Gómez', 'López', 0.13),
(3, 'Diego', 'Flores', 'Salas', 0.11),
(4, 'Marta', 'Herrera', 'Gil', 0.14),
(5, 'Antonio', 'Carretero', 'Ortega', 0.12),
(6, 'Manuel', 'Domínguez', 'Hernández', 0.13),
(7, 'Antonio', 'Vega', 'Hernández', 0.11),
(8, 'Alfredo', 'Ruiz', 'Flores', 0.05),
(9, 'Marcos', 'Loyola', 'Méndez', 0.11),
(10, 'María', 'Santana', 'Moreno', 0.04),
(11, 'Pepe', 'Ruiz', 'Santana', 0.07),
(12, 'Guillermo', 'López', 'Gómez', 0.07),
(13, 'Daniel', 'Santana', 'Loyola', 0.06),
(14, 'Pilar', 'Ruiz', 'Ruiz', 0.05),
(15, 'Antonio', 'Loyola', 'Ortega', 0.08),
(16, 'Juan', 'Gil', 'Vega', 0.15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tien_fabricante`
--

CREATE TABLE `tien_fabricante` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tien_fabricante`
--

INSERT INTO `tien_fabricante` (`id`, `nombre`) VALUES
(1, 'Asus'),
(2, 'Lenovo'),
(3, 'Hewlett-Packard'),
(4, 'Samsung'),
(5, 'Seagate'),
(6, 'Crucial'),
(7, 'Gigabyte'),
(8, 'Huawei'),
(9, 'Xiaomi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tien_producto`
--

CREATE TABLE `tien_producto` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` double NOT NULL,
  `fk_fabricante` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tien_producto`
--

INSERT INTO `tien_producto` (`id`, `nombre`, `precio`, `fk_fabricante`) VALUES
(1, 'Disco duro\r\nSATA3 1TB', 86.99, 5),
(2, 'Memoria RAM DDR4 8GB', 120, 6),
(3, 'Disco SSD 1 TB', 150.99, 4),
(4, 'GeForce GTX\r\n1050Ti', 185, 7),
(5, 'GeForce GTX 1080 Xtreme', 755, 6),
(6, 'Monitor 24 LED Full HD', 202, 1),
(7, 'Monitor 27 LED\r\nFull HD', 245.99, 1),
(8, 'Portátil Yoga 520', 559, 2),
(9, 'Altavoces', 70, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uni_asignatura`
--

CREATE TABLE `uni_asignatura` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `creditos` float UNSIGNED NOT NULL,
  `cuatrimestre` tinyint(3) UNSIGNED NOT NULL,
  `fk_profesor` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `uni_asignatura`
--

INSERT INTO `uni_asignatura` (`id`, `nombre`, `creditos`, `cuatrimestre`, `fk_profesor`) VALUES
(1, 'Álgebra lineal y matemática discreta', 4.8, 1, 3),
(2, 'Cálculo', 4, 1, 12),
(3, 'Física para informática', 4.8, 1, 11),
(4, 'Introducción a la programación', 5, 1, 10),
(5, 'Organización y gestión de empresas', 6.4, 1, 9),
(6, 'Estadística', 4.8, 2, 8),
(7, 'Estructura y tecnología de computadores', 4.8, 2, 7),
(8, 'cálculo algebraico', 6.4, 2, 6),
(9, 'Lógica y algorítmica', 6, 2, 5),
(10, 'Metodología de la programación', 5, 2, 4),
(11, 'Arquitectura de Computadores', 4.8, 1, 3),
(12, 'Estructura de Datos y Algoritmos I', 4.8, 1, 2),
(13, 'Ingeniería del Software', 5.8, 1, 1),
(14, 'Sistemas Inteligentes', 6.6, 1, 3),
(15, 'Sistemas Operativos', 4.8, 1, 12),
(16, 'Bases de Datos', 6.4, 2, 12),
(17, 'Estructura de Datos y Algoritmos II', 5, 2, 11),
(18, 'Fundamentos de Redes de Computadores', 4.8, 2, 3),
(19, 'Planificación y Gestión de Proyectos Informáticos', 6, 2, 4),
(20, 'Programación de Servicios Software', 4.8, 2, 10),
(21, 'Desarrollo de interfaces de usuario', 6.6, 1, 9),
(22, 'Algebra Diferencial', 5.8, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uni_profesor`
--

CREATE TABLE `uni_profesor` (
  `id` int(10) UNSIGNED NOT NULL,
  `NIF` varchar(9) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `ciudad` varchar(25) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `uni_profesor`
--

INSERT INTO `uni_profesor` (`id`, `NIF`, `nombre`, `apellido1`, `apellido2`, `ciudad`, `direccion`, `telefono`) VALUES
(1, '26902806M', 'Salvador', 'Sánchez', 'Pérez', 'Almería', 'C/ Real\r\ndel barrio alto', '950254837'),
(2, '89542419S', 'Juan', 'Saez', 'Vega', 'Almería', 'C/ Mercurio', '618253876'),
(3, '11105554G', 'Zoe', 'Ramirez', 'Gea', 'Almería', 'C/ Marte', '618223876'),
(4, '17105885A', 'Pedro', 'Heller', 'Pagac', 'Almería', 'C/\r\nEstrella fugaz', NULL),
(5, '38223286T', 'David', 'Schmidt', 'Fisher', 'Almería', 'C/\r\nVenus', '678516294'),
(6, '04233869Y', 'José', 'Koss', 'Bayer', 'Almería', 'C/ Júpiter', '628349590'),
(7, '97258166K', 'Ismael', 'Strosin', 'Turcotte', 'Almería', 'C/\r\nNeptuno', NULL),
(8, '79503962T', 'Cristina', 'Lemke', 'Rutherford', 'Almería', 'C/\r\nSaturno', '669162534'),
(9, '82842571K', 'Ramón', 'Herzog', 'Tremblay', 'Almería', 'C/\r\nUrano', '626351429'),
(10, '61142000L', 'Esther', 'Spencer', 'Lakin', 'Almería', 'C/\r\nPlutón', NULL),
(11, '46900725E', 'Daniel', 'Herman', 'Pacocha', 'Almería', 'C/\r\nAndarax', '679837625'),
(12, '85366986W', 'Carmen', 'Streich', 'Hirthe', 'Almería', 'C/\r\nAlmanzora', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_grupo` int(10) UNSIGNED NOT NULL,
  `clave_hash` varchar(255) NOT NULL,
  `clave_foranea_hash` varchar(255) NOT NULL,
  `luser` varchar(255) NOT NULL,
  `lontrasenia` varchar(255) NOT NULL,
  `logokey` varchar(255) NOT NULL,
  `leyenda` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_grupo`, `clave_hash`, `clave_foranea_hash`, `luser`, `lontrasenia`, `logokey`, `leyenda`) VALUES
(1, 1, 'clave_hash_usuario1', 'clave_foranea_hash_usuario1', 'rodolfo@docora.zon', '$2y$12$uHbuE6MB7ECnh3UAy1yMnetulkbiMbWpLq6pCmmSxxqnk./koBBw2', 'logokey_usuario1', 'leyenda_usuario1'),
(2, 2, 'clave_hash_usuario2', 'clave_foranea_hash_usuario2', 'Ana', 'lontrasenia_usuario2', 'logokey_usuario2', 'leyenda_usuario2'),
(3, 3, 'clave_hash_usuario3', 'clave_foranea_hash_usuario3', 'Pedro', 'lontrasenia_usuario3', 'logokey_usuario3', 'leyenda_usuario3'),
(4, 4, 'clave_hash_usuario4', 'clave_foranea_hash_usuario4', 'María', 'lontrasenia_usuario4', 'logokey_usuario4', 'leyenda_usuario4');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ate_profesor`
--
ALTER TABLE `ate_profesor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `at_cliente`
--
ALTER TABLE `at_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datospersonales`
--
ALTER TABLE `datospersonales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- Indices de la tabla `emp_departamento`
--
ALTER TABLE `emp_departamento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `emp_empleado`
--
ALTER TABLE `emp_empleado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- Indices de la tabla `examen_empl`
--
ALTER TABLE `examen_empl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- Indices de la tabla `ex_fabricante`
--
ALTER TABLE `ex_fabricante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ex_producto`
--
ALTER TABLE `ex_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lib_editorial`
--
ALTER TABLE `lib_editorial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lib_libreria`
--
ALTER TABLE `lib_libreria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sb_comercial`
--
ALTER TABLE `sb_comercial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tien_fabricante`
--
ALTER TABLE `tien_fabricante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tien_producto`
--
ALTER TABLE `tien_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `uni_asignatura`
--
ALTER TABLE `uni_asignatura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `uni_profesor`
--
ALTER TABLE `uni_profesor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ate_profesor`
--
ALTER TABLE `ate_profesor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `at_cliente`
--
ALTER TABLE `at_cliente`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `datospersonales`
--
ALTER TABLE `datospersonales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `emp_departamento`
--
ALTER TABLE `emp_departamento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `emp_empleado`
--
ALTER TABLE `emp_empleado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `examen_empl`
--
ALTER TABLE `examen_empl`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ex_fabricante`
--
ALTER TABLE `ex_fabricante`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ex_producto`
--
ALTER TABLE `ex_producto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `lib_editorial`
--
ALTER TABLE `lib_editorial`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `lib_libreria`
--
ALTER TABLE `lib_libreria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sb_comercial`
--
ALTER TABLE `sb_comercial`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tien_fabricante`
--
ALTER TABLE `tien_fabricante`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tien_producto`
--
ALTER TABLE `tien_producto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `uni_asignatura`
--
ALTER TABLE `uni_asignatura`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `uni_profesor`
--
ALTER TABLE `uni_profesor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `datospersonales` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
