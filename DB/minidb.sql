-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2025 a las 08:07:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `minidb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `usuario`, `contrasena`, `created_at`) VALUES
(1, 'fer', '$2y$10$j5Op2yqIfkE4qn9D16Q9JuLmTw7cSUgQm4hefvaLZkok7Q4bz1X8e', '2025-01-10 05:52:49'),
(3, 'carlos ', '$2y$10$suaGNY1.nibQ94871esStOq.7NtGNQ9DrLhMpoc8Hgq3VWhTGbkbW', '2025-01-10 07:04:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre2` varchar(50) DEFAULT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `apellido_casada` varchar(50) DEFAULT NULL,
  `dpi` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `escolaridad` varchar(50) NOT NULL,
  `muestra_tecnica` enum('aprobó','no aprobó') NOT NULL,
  `entrevista_jefe` enum('✓','x') NOT NULL,
  `psicometria` enum('✓','x') NOT NULL,
  `dias_prueba` enum('✓','x') NOT NULL,
  `referencias` enum('✓','x') NOT NULL,
  `poligrafo` enum('✓','x') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `nombre2`, `apellido1`, `apellido2`, `apellido_casada`, `dpi`, `fecha_nacimiento`, `fecha_solicitud`, `escolaridad`, `muestra_tecnica`, `entrevista_jefe`, `psicometria`, `dias_prueba`, `referencias`, `poligrafo`, `created_at`) VALUES
(1, 'fernando', 'jose', 'vidal', 'roquel', '', '1231231231231231', '2025-01-08', '2025-01-29', 'universidad', 'no aprobó', 'x', 'x', '✓', 'x', '✓', '2025-01-10 06:08:18'),
(4, 'meliza', '', 'perez', 'rivas', '', '1254877658', '2016-04-07', '2025-01-10', 'universidad', 'no aprobó', '✓', 'x', 'x', 'x', '✓', '2025-01-10 07:06:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dpi` (`dpi`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
