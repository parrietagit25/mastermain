-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2024 a las 03:27:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mastermain`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jos`
--

CREATE TABLE `jos` (
  `id` int(11) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `stat` int(1) NOT NULL,
  `date_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `titulo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `stat` int(11) NOT NULL,
  `fecha_log` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `pass`, `tipo_usuario`, `stat`, `fecha_log`) VALUES
(1, 'casco', 'casco@casco.com', '$2y$10$bJYGg5SVPojt2w9I9xhRqO1.bVfvfrQf5kWHi8z.FzJqIefGkdBZ6', 'admin', 0, '2024-01-11 20:14:57'),
(3, 'tayronbus', 'pedro.arrieta@grupopcr.com.pa', '$2y$10$a6NxUBPxRWK43YvdXYZws.aag7B4TMJg0T1u0hDlAfEQjfxp33/3m', 'admin', 0, '2024-01-11 21:05:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jos`
--
ALTER TABLE `jos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jos`
--
ALTER TABLE `jos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
