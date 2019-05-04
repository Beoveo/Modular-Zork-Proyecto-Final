-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-05-2019 a las 13:46:47
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `game`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas`
--

CREATE TABLE `mapas` (
  `idMap` int(200) NOT NULL,
  `idRoom` int(200) NOT NULL,
  `inventario` varchar(200) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `mapas`
--

INSERT INTO `mapas` (`idMap`, `idRoom`, `inventario`) VALUES
(1, 1, 'espada , cuchillo, tenedor'),
(2, 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms`
--

CREATE TABLE `rooms` (
  `id` int(200) NOT NULL,
  `idRoom` int(200) NOT NULL,
  `nameRoom` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_bin NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `destino` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `consumibles` varchar(200) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`id`, `idRoom`, `nameRoom`, `description`, `direccion`, `destino`, `consumibles`) VALUES
(1, 1, 'inicio', 'Esta oscuro , hace frio y ves una luz al <b>north</b>\r\n     se oye el sonido del agua al <b>west</b>', 'north', 'room1', 'zork/juegoimg/p1/calabozoOscuro.png'),
(2, 1, 'room1', 'Estas en una habitacion con mas luz , ves una gran sala <b>north</b>\\\r\n     y un extraño olor proviene del <b>east</b>', 'south, north, east', 'inicio, gransala, trolls', 'zork/juegoimg/p1/calabozocerrado.png'),
(3, 1, 'gransala', 'Esta es la gran sala , al fondo , una anciana abre una puerta <b>anciana</b>\\¿Que haces?', 'south', 'room1', 'zork/juegoimg/p2/salaSupClabozo.png'),
(4, 1, 'room2', 'Por la ventana al <b>west</b> se ve una puente que parece que da a la salida de esto', 'east, west', 'inicio, room3', 'zork/juegoimg/p2/salaSupClabozoEsteSinOrco.png\"'),
(5, 1, 'room3', 'Al intentar cruzar la habitacion , un troll te salta y te ataca, ¿Que haces?', 'east', 'room2', 'zork/juegoimg/p2/salaSupClabozoEste.png'),
(6, 1, 'trolls', 'Llegas a otra habitacion, algunos trolls estan asando comida, atacar\\\r\nno te han visto todavia , ¿Que haces?', 'west', 'room1', 'zork/juegoimg/p2/salaSupClabozoEste.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms2`
--

CREATE TABLE `rooms2` (
  `idRoom` int(200) NOT NULL,
  `nivel` int(11) NOT NULL,
  `nameRoom` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `destino` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `rooms2`
--

INSERT INTO `rooms2` (`idRoom`, `nivel`, `nameRoom`, `description`, `direccion`, `destino`, `imagen`) VALUES
(1, 0, 'inicio', 'Esta oscuro , hace frio y ves una luz al <b>north</b>\r\n     se oye el sonido del agua al <b>west</b>', 'north, west', 'room1, room2', 'zork/juegoimg/p1/calabozoOscuro.png'),
(2, 0, 'room1', 'Estas en una habitacion con mas luz , ves una gran sala <b>north</b>\\y un extraño olor proviene del <b>east</b>', 'south , north , east', 'inicio , gransala , trolls', 'zork/juegoimg/p1/calabozocerrado.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mapas`
--
ALTER TABLE `mapas`
  ADD PRIMARY KEY (`idMap`);

--
-- Indices de la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rooms2`
--
ALTER TABLE `rooms2`
  ADD PRIMARY KEY (`idRoom`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mapas`
--
ALTER TABLE `mapas`
  MODIFY `idMap` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
