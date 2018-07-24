-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-07-2018 a las 19:48:55
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `EventSearch`
--
CREATE DATABASE IF NOT EXISTS `EventSearch` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `EventSearch`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reservacion`
--

DROP TABLE IF EXISTS `Reservacion`;
CREATE TABLE `Reservacion` (
  `pk_reservacion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fk_espacio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
CREATE TABLE `Usuario` (
  `pk_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`pk_usuario`, `nombre`, `correo`, `pass`, `categoria`, `token`) VALUES
(1, 'user', 'prueba@gmail.com', '123', 'visitante', '7c54ab56533a92c1f05599c453015e306fd34682');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Reservacion`
--
ALTER TABLE `Reservacion`
  ADD PRIMARY KEY (`pk_reservacion`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`pk_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Reservacion`
--
ALTER TABLE `Reservacion`
  MODIFY `pk_reservacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `pk_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
