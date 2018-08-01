-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-08-2018 a las 20:54:57
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
-- Estructura de tabla para la tabla `Consulta`
--

DROP TABLE IF EXISTS `Consulta`;
CREATE TABLE `Consulta` (
  `pk_consulta` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `fk_espacio` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Consulta`
--

INSERT INTO `Consulta` (`pk_consulta`, `fecha`, `fk_espacio`, `fk_usuario`) VALUES
(0, 2147483647, 1, 1),
(0, 2147483647, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Espacio`
--

DROP TABLE IF EXISTS `Espacio`;
CREATE TABLE `Espacio` (
  `pk_espacio` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `limite` int(11) NOT NULL,
  `calle` text NOT NULL,
  `numero` text NOT NULL,
  `colonia` text NOT NULL,
  `municipio` text NOT NULL,
  `estado` text NOT NULL,
  `telefono` text NOT NULL,
  `precio_minimo` float NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  `fecha_publicacion` tinyint(4) NOT NULL,
  `fk_propietario` int(11) NOT NULL,
  `categoria` text NOT NULL,
  `horario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Espacio`
--

INSERT INTO `Espacio` (`pk_espacio`, `nombre`, `limite`, `calle`, `numero`, `colonia`, `municipio`, `estado`, `telefono`, `precio_minimo`, `latitud`, `longitud`, `fecha_publicacion`, `fk_propietario`, `categoria`, `horario`) VALUES
(1, 'Finca Esperanza', 200, 'Lisboa ', '5', 'Tejalpa', 'jiutepec', 'Morelos', '777743109213', 10000, 134, 123, 1, 1, '1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Imagen`
--

DROP TABLE IF EXISTS `Imagen`;
CREATE TABLE `Imagen` (
  `pk_imagen` int(11) NOT NULL,
  `ruta` text NOT NULL,
  `fk_espacio` int(11) NOT NULL,
  `fecha_subida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Imagen`
--

INSERT INTO `Imagen` (`pk_imagen`, `ruta`, `fk_espacio`, `fecha_subida`) VALUES
(1, 'localhost://asdkfad//aklsdjfkasf', 1, '2018-07-18'),
(2, 'Localhost://jasdlfkjasdk//akñdsjflkads', 1, '2018-07-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pago`
--

DROP TABLE IF EXISTS `Pago`;
CREATE TABLE `Pago` (
  `pk_pago` int(11) NOT NULL,
  `fk_propietario` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `validado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Paquete`
--

DROP TABLE IF EXISTS `Paquete`;
CREATE TABLE `Paquete` (
  `pk_paquete` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `personas` int(11) NOT NULL,
  `precio` float NOT NULL,
  `fk_espacio` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Paquete`
--

INSERT INTO `Paquete` (`pk_paquete`, `nombre`, `descripcion`, `personas`, `precio`, `fk_espacio`, `fecha_creacion`) VALUES
(1, 'asdf', 'asdfasdf', 120, 1234120, 2147483647, '0000-00-00'),
(2, 'asdf', 'asdfasdf', 120, 1234120, 0, '0000-00-00'),
(3, 'asdf', 'asdfasdf', 120, 1234120, 1, '2018-07-31'),
(4, 'asdf', 'asdfasdf', 120, 1234120, 1, '2018-07-31'),
(5, 'asdf', 'asdfasdf', 120, 1234120, 1, '2018-07-31'),
(6, 'asdf', 'asdfasdf', 120, 1234120, 1, '2018-07-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Propietario`
--

DROP TABLE IF EXISTS `Propietario`;
CREATE TABLE `Propietario` (
  `pk_propietario` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido_pat` text NOT NULL,
  `apellido_mat` text NOT NULL,
  `telefono` text NOT NULL,
  `correo` text NOT NULL,
  `pass` text NOT NULL,
  `fecha_union` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Volcado de datos para la tabla `Reservacion`
--

INSERT INTO `Reservacion` (`pk_reservacion`, `fecha`, `fk_espacio`) VALUES
(3, '0000-00-00', 1),
(4, '0000-00-00', 1),
(5, '0000-00-00', 1),
(6, '0000-00-00', 1),
(7, '0000-00-00', 1);

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
(1, 'user', 'prueba@gmail.com', '123', 'visitante', '33d7104ad8fe9339903c29eb3e8e53a0546a4c5e'),
(2, 'prueba', 'nuevo@gmail.com', '123', 'registrado', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Espacio`
--
ALTER TABLE `Espacio`
  ADD PRIMARY KEY (`pk_espacio`);

--
-- Indices de la tabla `Imagen`
--
ALTER TABLE `Imagen`
  ADD PRIMARY KEY (`pk_imagen`);

--
-- Indices de la tabla `Pago`
--
ALTER TABLE `Pago`
  ADD PRIMARY KEY (`pk_pago`);

--
-- Indices de la tabla `Paquete`
--
ALTER TABLE `Paquete`
  ADD PRIMARY KEY (`pk_paquete`);

--
-- Indices de la tabla `Propietario`
--
ALTER TABLE `Propietario`
  ADD PRIMARY KEY (`pk_propietario`);

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
-- AUTO_INCREMENT de la tabla `Espacio`
--
ALTER TABLE `Espacio`
  MODIFY `pk_espacio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Imagen`
--
ALTER TABLE `Imagen`
  MODIFY `pk_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Pago`
--
ALTER TABLE `Pago`
  MODIFY `pk_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Paquete`
--
ALTER TABLE `Paquete`
  MODIFY `pk_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `Propietario`
--
ALTER TABLE `Propietario`
  MODIFY `pk_propietario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Reservacion`
--
ALTER TABLE `Reservacion`
  MODIFY `pk_reservacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `pk_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
