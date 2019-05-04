-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2019 a las 19:03:03
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aw`
--

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`, `monedas`, `puntos`, `rutaFoto`, `bloqueado`) VALUES
(1, 'user', 'user@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 100, 0, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', b'0'),
(2, 'admin', 'admin@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 100, 0, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', b'0'),
(3, 'prueba', 'prueba@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 100, 0, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', b'0'),
(4, '1234', '1234@example.org', '$2y$10$crE/87D6eqLr6A6/Vmt4zuDS7/igGThgX6t.ZWwvtyatT4E5gDqgm', 100, 0, NULL, b'0'),
(5, 'prueba', 'prueba@example.com', '$2y$10$6o18GzEFiT53FYy8sYM19.Nb2/hyVPQkPYeaSfnUndLNPBwsFYs8.', 100, 0, NULL, b'0');
COMMIT;

--
-- Volcado de datos para la tabla `mapas`
--

INSERT INTO `mapas` (`id`, `nombre`, `dificultad`, `precio`, `numMazmorras`, `recompensa`, `mazmorrasSuperadas`, `propietario`, `rutaImagen`, `descripcion`, `valoracion`, `numJugado`, `terminadoCreado`) VALUES
(1, 'Castillo', 3, 15, 5, 0, '', 1, 'castillo.jpg', NULL, 5, 1, 1),
(2, 'Cuevas', 4, 16, 4, 0, '', 1, 'fondo.jpg', NULL, 3, 2, 1),
(3, 'Bosque Oscuro', 5, 30, 6, 0, '', 1, 'bosque.png', NULL, 0, 0, 1);

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'user'),
(2, 'admin');

--
-- Volcado de datos para la tabla `rolesusuario`
--

INSERT INTO `rolesusuario` (`usuario`, `rol`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1);

--
-- Volcado de datos para la tabla `consumibles`
--

INSERT INTO `consumibles` (`id`, `nombre`, `categoria`, `fuerza`, `habilidad`, `vida`, `precio`, `rutaImagen`) VALUES
(1, 'Hacha', 'Armas', 70, 40, 0, 60, 'axe.png');


--
-- Volcado de datos para la tabla `enemigo`
--

INSERT INTO `enemigo` (`id`, `nombre`, `fuerza`, `habilidad`, `vida`, `precio`, `rutaImagen`) VALUES
(1, 'Pringoso', 50, 20, 80, 40, 'monstruo.jpg'),
(2, 'Volador', 20, 80, 40, 30, 'monstruo2.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
