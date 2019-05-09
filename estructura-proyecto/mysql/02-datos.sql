-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2019 a las 17:19:04
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
-- Base de datos: `sw`
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

--
-- Volcado de datos para la tabla `consumibles`
--

INSERT INTO `consumibles` (`id`, `nombre`, `categoria`, `fuerza`, `habilidad`, `vida`, `precio`, `rutaImagen`) VALUES
(1, 'Poción 1', 'salud', 20, 10, 0, 10, 'pngZork/pocion1.png'),
(2, 'Poción 2', 'salud', 20, 10, 15, 15, 'pngZork/pocion2.png'),
(3, 'Escudo azul', 'defensa', 20, 40, 70, 50, 'pngZork/Recurso2.png'),
(4, 'Escudo rojo', 'defensa', 40, 30, 50, 60, 'pngZork/Recurso4.png'),
(5, 'Hacha', 'ataque', 80, 20, 10, 40, 'pngZork/Recurso3.png'),
(6, 'Espada Oro', 'ataque', 50, 40, 20, 50, 'pngZork/Recurso5.png'),
(7, 'Espada Plata', 'ataque', 40, 30, 30, 60, 'pngZork/Recurso6.png');

--
-- Volcado de datos para la tabla `enemigo`
--

INSERT INTO `enemigo` (`id`, `nombre`, `fuerza`, `habilidad`, `vida`, `precio`, `rutaImagen`) VALUES
(1, 'Esqueleto', 20, 30, 20, 30, 'pngZork/cala.png'),
(2, 'Dragón', 100, 70, 50, 60, 'pngZork/dragon.png'),
(3, 'Fantasma', 10, 60, 100, 50, 'pngZork/fantasma.png'),
(4, 'Zombie', 40, 20, 70, 60, 'pngZork/fran.png'),
(5, 'Momia', 40, 30, 80, 40, 'pngZork/momia.png'),
(6, 'Muerte', 80, 60, 90, 80, 'pngZork/muerte.png'),
(7, 'Vampiro', 80, 70, 60, 80, 'pngZork/vamp.png');

--
-- Volcado de datos para la tabla `mapas`
--

INSERT INTO `mapas` (`id`, `nombre`, `dificultad`, `precio`, `numMazmorras`, `recompensa`, `propietario`, `rutaImagen`, `descripcion`, `valoracion`, `numJugado`, `terminadoCreado`) VALUES
(1, 'Calabozo', 3, 20, 6, 20, 1, 'rooms/calabozo.png', 'Muy guay', 0, 0, 1);

--
-- Volcado de datos para la tabla `mazmorras`
--

INSERT INTO `mazmorras` (`id`, `nombre`, `numSalidas`, `numEnemigos`, `recompensa`, `rutaImagen`, `historia`) VALUES
(1, 'inicio', 2, 0, 2, 'rooms/calabozo.png', 'Esta oscuro, hace frio y ves una luz al <b>north</b> se oye el sonido del agua al <b>east</b>'),
(2, 'room1', 3, 0, 3, 'rooms/calabozo.png', 'Estas en una habitacion con mas luz, ves una gran sala al <b>north</b> y un extrano olor proviene del <b>east</b>'),
(3, 'gransala', 2, 0, 2, 'rooms/mazmorra.png', 'Estas en una gran sala, al fondo una anciana abre una puerta . Que haces?'),
(4, 'trolls', 1, 2, 3, 'rooms/mazmorra.png', 'Llegas a otra habitacion, algunos trolls estan asando comida, no te han visto todavia, Que haces?'),
(5, 'room2', 2, 0, 2, 'rooms/mazmorra.png', 'Por la ventana al <b>west</b> se ve un puente que parece que da a la salida de esto.'),
(6, 'room3', 1, 1, 5, 'rooms/mazmorra.png', 'Al intentar cruzar la habitacion, un troll escondido salta y te ataca, Que haces?');


--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `tamaño`) VALUES
(1, 10),
(2, 5);

--
-- Volcado de datos para la tabla `mapacontiene`
--

INSERT INTO `mapacontiene` (`idMapa`, `idMazmorra`, `mazmorraNorte`, `mazmorraEste`, `mazmorraSur`, `mazmorraOeste`, `mazmorraInicial`, `mazmorraFinal`) VALUES
(1, 1, 2, NULL, NULL, 5, 1, 0),
(1, 2, 3, 4, 1, NULL, 0, 0),
(1, 3, NULL, NULL, 2, NULL, 0, 0),
(1, 4, NULL, NULL, NULL, 2, 0, 0),
(1, 5, NULL, 1, NULL, 6, 0, 0),
(1, 6, NULL, 5, NULL, NULL, 0, 1);


--
-- Volcado de datos para la tabla `personaje`
--

INSERT INTO `personaje` (`id`, `nombre`, `fuerza`, `habilidad`, `vida`, `precio`, `idInventario`, `rutaImagen`) VALUES
(1, 'Anciana', 70, 50, 50, 60, 1, 'pngZork/anciana.png'),
(2, 'Caballero', 80, 70, 100, 60, 2, 'pngZork/personaje1.png');

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
(2, 2),
(3, 1),
(4, 1),
(5, 1);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
