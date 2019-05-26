-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-05-2019 a las 10:43:33
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
-- Base de datos: `sw2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprados`
--

CREATE TABLE `comprados` (
  `id` int(11) UNSIGNED NOT NULL,
  `idUsuario` int(11) UNSIGNED NOT NULL,
  `idObjeto` int(11) UNSIGNED NOT NULL,
  `tipo` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `precio` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumibles`
--

CREATE TABLE `consumibles` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `categoria` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fuerza` int(11) UNSIGNED NOT NULL,
  `habilidad` int(11) UNSIGNED NOT NULL,
  `vida` int(11) UNSIGNED NOT NULL,
  `precio` int(11) UNSIGNED NOT NULL,
  `rutaImagen` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `w` int(10) DEFAULT NULL,
  `h` int(10) DEFAULT NULL,
  `tipo` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `consumibles`
--

INSERT INTO `consumibles` (`id`, `nombre`, `categoria`, `fuerza`, `habilidad`, `vida`, `precio`, `rutaImagen`, `w`, `h`, `tipo`) VALUES
(1, 'Poción 1', 'salud', 20, 10, 0, 10, 'img/pngZork/pocion1.png', 80, 120, 'consumible'),
(2, 'Poción 2', 'salud', 20, 10, 15, 15, 'img/pngZork/pocion2.png', 80, 120, 'consumible'),
(3, 'Escudo azul', 'defensa', 20, 40, 70, 50, 'img/pngZork/Recurso2.png', 80, 120, 'consumible'),
(4, 'Escudo rojo', 'defensa', 40, 30, 50, 60, 'img/pngZork/Recurso4.png', 80, 120, 'consumible'),
(5, 'Hacha', 'ataque', 80, 20, 10, 40, 'img/pngZork/Recurso3.png', 80, 120, 'consumible'),
(6, 'Espada Oro', 'ataque', 50, 40, 20, 50, 'img/pngZork/Recurso5.png', 80, 120, 'consumible'),
(7, 'Espada Plata', 'ataque', 40, 30, 30, 60, 'img/pngZork/Recurso6.png', 80, 120, 'consumible'),
(8, 'Lllave', 'key', 0, 0, 0, 0, 'img/pngZork/LlavePlata1.png', 70, 70, 'consumible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enemigo`
--

CREATE TABLE `enemigo` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fuerza` int(11) UNSIGNED NOT NULL,
  `habilidad` int(11) UNSIGNED NOT NULL,
  `vida` int(11) UNSIGNED NOT NULL,
  `precio` int(11) UNSIGNED NOT NULL,
  `rutaImagen` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `w` int(10) DEFAULT NULL,
  `h` int(10) DEFAULT NULL,
  `tipo` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `enemigo`
--

INSERT INTO `enemigo` (`id`, `nombre`, `fuerza`, `habilidad`, `vida`, `precio`, `rutaImagen`, `w`, `h`, `tipo`) VALUES
(1, 'Esqueleto', 20, 30, 100, 30, 'img/pngZork/cala.png', 123, 220, 'enemigo'),
(2, 'Dragón', 100, 70, 100, 60, 'img/pngZork/dragon.png', 123, 220, 'enemigo'),
(3, 'Fantasma', 10, 60, 100, 50, 'img/pngZork/fantasma.png', 123, 220, 'enemigo'),
(4, 'Zombie', 40, 20, 100, 60, 'img/pngZork/fran.png', 123, 220, 'enemigo'),
(5, 'Momia', 40, 30, 100, 40, 'img/pngZork/momia.png', 123, 220, 'enemigo'),
(6, 'Muerte', 80, 60, 100, 80, 'img/pngZork/muerte.png', 123, 220, 'enemigo'),
(7, 'Vampiro', 80, 70, 100, 80, 'img/pngZork/vamp.png', 123, 220, 'enemigo'),
(8, 'Anciana', 0, 0, 100, 20, 'img/pngZork/anciana.png', 123, 220, 'ayuda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) UNSIGNED NOT NULL,
  `tamaño` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `tamaño`) VALUES
(1, 10),
(2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventariocontiene`
--

CREATE TABLE `inventariocontiene` (
  `idInventario` int(11) UNSIGNED NOT NULL,
  `idConsumible` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventariopartida`
--

CREATE TABLE `inventariopartida` (
  `id` int(11) UNSIGNED NOT NULL,
  `IdObjeto` int(11) UNSIGNED NOT NULL,
  `categoria` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usado-superado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapacontiene`
--

CREATE TABLE `mapacontiene` (
  `idMapa` int(11) UNSIGNED NOT NULL,
  `idMazmorra` int(11) UNSIGNED NOT NULL,
  `mazmorraNorte` int(11) UNSIGNED DEFAULT NULL,
  `mazmorraEste` int(11) UNSIGNED DEFAULT NULL,
  `mazmorraSur` int(11) UNSIGNED DEFAULT NULL,
  `mazmorraOeste` int(11) UNSIGNED DEFAULT NULL,
  `mazmorraInicial` tinyint(1) NOT NULL,
  `mazmorraFinal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas`
--

CREATE TABLE `mapas` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `dificultad` int(11) NOT NULL,
  `precio` int(11) UNSIGNED NOT NULL,
  `numMazmorras` int(11) NOT NULL DEFAULT '0',
  `recompensa` int(11) NOT NULL DEFAULT '0',
  `propietario` int(11) UNSIGNED NOT NULL,
  `rutaImagen` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `valoracion` float NOT NULL DEFAULT '0',
  `numJugado` int(11) NOT NULL DEFAULT '0',
  `terminadoCreado` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mapas`
--

INSERT INTO `mapas` (`id`, `nombre`, `dificultad`, `precio`, `numMazmorras`, `recompensa`, `propietario`, `rutaImagen`, `descripcion`, `valoracion`, `numJugado`, `terminadoCreado`) VALUES
(1, 'Calabozo', 3, 20, 6, 20, 1, 'img/calabozo.png', 'Muy guay', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mazmorraconsumibles`
--

CREATE TABLE `mazmorraconsumibles` (
  `idMazmorra` int(11) UNSIGNED NOT NULL,
  `idConsumible` int(11) UNSIGNED NOT NULL,
  `x` int(2) UNSIGNED NOT NULL,
  `y` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mazmorraconsumibles`
--

INSERT INTO `mazmorraconsumibles` (`idMazmorra`, `idConsumible`, `x`, `y`) VALUES
(1, 5, 350, 250),
(3, 1, 350, 250),
(5, 8, 250, 250);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mazmorraenemigo`
--

CREATE TABLE `mazmorraenemigo` (
  `idMazmorra` int(11) UNSIGNED NOT NULL,
  `idEnemigo` int(11) UNSIGNED NOT NULL,
  `x` int(2) UNSIGNED NOT NULL,
  `y` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mazmorraenemigo`
--

INSERT INTO `mazmorraenemigo` (`idMazmorra`, `idEnemigo`, `x`, `y`) VALUES
(2, 1, 440, 150),
(3, 8, 440, 150),
(4, 4, 440, 150),
(6, 6, 440, 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mazmorras`
--

CREATE TABLE `mazmorras` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `numSalidas` int(11) UNSIGNED NOT NULL,
  `numEnemigos` int(11) UNSIGNED NOT NULL,
  `recompensa` int(11) UNSIGNED NOT NULL,
  `rutaImagen` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `historia` varchar(1000) COLLATE utf8mb4_spanish_ci NOT NULL,
  `x` int(10) NOT NULL,
  `y` int(10) NOT NULL,
  `w` int(10) NOT NULL,
  `h` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mazmorras`
--

INSERT INTO `mazmorras` (`id`, `nombre`, `numSalidas`, `numEnemigos`, `recompensa`, `rutaImagen`, `historia`, `x`, `y`, `w`, `h`) VALUES
(1, 'inicio', 2, 0, 2, 'img/mazmorras/calabozo.png', 'Esta oscuro, hace frio y ves una luz al <b>norte</b> se oye el sonido del agua al <b>oeste</b>', 0, 0, 720, 410),
(2, 'room1', 3, 0, 3, 'img/mazmorras/lab.png', 'Estas en una habitacion con mas luz, ves una gran sala al <b>norte</b> y un extrano olor proviene del <b>este</b>', 0, 0, 720, 410),
(3, 'gransala', 2, 0, 2, 'img/mazmorras/sala.png', 'Estas en una gran sala, al fondo una anciana abre una puerta . Que haces?', 0, 0, 720, 410),
(4, 'trolls', 1, 2, 3, 'img/mazmorras/comedor.png', 'Llegas a otra habitacion, algunos trolls estan asando comida, no te han visto todavia, Que haces?', 0, 0, 720, 410),
(5, 'room2', 2, 0, 2, 'img/mazmorras/pasilloArmadura.png', 'Por la ventana al <b>oeste</b> se ve un puente que parece que da a la salida de esto.', 0, 0, 720, 410),
(6, 'room3', 1, 1, 5, 'img/mazmorras/salaDestruida.png', 'Al intentar cruzar la habitacion, la muerte salta y te ataca, Que haces?', 0, 0, 720, 410);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mazmorrassuperadas`
--

CREATE TABLE `mazmorrassuperadas` (
  `idMapa` int(11) UNSIGNED NOT NULL,
  `idMazmorra` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `usuario` int(11) UNSIGNED NOT NULL,
  `mensaje` varchar(140) COLLATE utf8mb4_spanish_ci NOT NULL,
  `idMensajePadre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetosusados`
--

CREATE TABLE `objetosusados` (
  `id` int(11) UNSIGNED NOT NULL,
  `idPartida` int(11) UNSIGNED NOT NULL,
  `idMapa` int(11) UNSIGNED NOT NULL,
  `idMazmorra` int(11) UNSIGNED NOT NULL,
  `idUsuario` int(11) UNSIGNED NOT NULL,
  `idObjeto` int(11) UNSIGNED NOT NULL,
  `tipoObjeto` varchar(30) NOT NULL,
  `fuerzaPj` int(11) UNSIGNED DEFAULT NULL,
  `habilidadPj` int(11) UNSIGNED DEFAULT NULL,
  `vidaPj` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `idPartida` int(11) UNSIGNED NOT NULL,
  `idUsuario` int(11) UNSIGNED NOT NULL,
  `idMapa` int(11) UNSIGNED NOT NULL,
  `idPersonaje` int(11) UNSIGNED NOT NULL,
  `fechaComienzo` date NOT NULL,
  `fechaUltimoAcceso` date NOT NULL,
  `posX` int(10) DEFAULT NULL,
  `posY` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`idPartida`, `idUsuario`, `idMapa`, `idPersonaje`, `fechaComienzo`, `fechaUltimoAcceso`, `posX`, `posY`) VALUES
(1, 1, 1, 2, '0000-00-00', '0000-00-00', NULL, NULL),
(2, 1, 1, 1, '0000-00-00', '0000-00-00', NULL, NULL),
(3, 1, 1, 1, '0000-00-00', '0000-00-00', NULL, NULL),
(4, 1, 1, 1, '0000-00-00', '0000-00-00', NULL, NULL),
(5, 1, 1, 1, '0000-00-00', '0000-00-00', NULL, NULL),
(6, 1, 1, 1, '0000-00-00', '0000-00-00', NULL, NULL),
(7, 1, 1, 1, '0000-00-00', '0000-00-00', NULL, NULL),
(8, 1, 1, 1, '0000-00-00', '0000-00-00', NULL, NULL),
(9, 1, 1, 2, '0000-00-00', '0000-00-00', NULL, NULL),
(10, 1, 1, 2, '0000-00-00', '0000-00-00', NULL, NULL),
(11, 1, 1, 2, '0000-00-00', '0000-00-00', NULL, NULL),
(12, 1, 1, 2, '0000-00-00', '0000-00-00', NULL, NULL),
(13, 1, 1, 2, '0000-00-00', '0000-00-00', NULL, NULL),
(14, 1, 1, 2, '0000-00-00', '0000-00-00', NULL, NULL),
(15, 1, 1, 2, '0000-00-00', '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personaje`
--

CREATE TABLE `personaje` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fuerza` int(11) UNSIGNED NOT NULL,
  `habilidad` int(11) UNSIGNED NOT NULL,
  `vida` int(11) UNSIGNED NOT NULL,
  `precio` int(11) UNSIGNED NOT NULL,
  `idInventario` int(11) UNSIGNED NOT NULL,
  `rutaImagen` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `w` int(10) DEFAULT NULL,
  `h` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `personaje`
--

INSERT INTO `personaje` (`id`, `nombre`, `fuerza`, `habilidad`, `vida`, `precio`, `idInventario`, `rutaImagen`, `w`, `h`) VALUES
(1, 'Anciana', 70, 50, 50, 60, 1, 'img/pngZork/anciana.png', NULL, NULL),
(2, 'Caballero', 80, 70, 100, 60, 2, 'img/pngZork/personaje1.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolesusuario`
--

CREATE TABLE `rolesusuario` (
  `usuario` int(11) UNSIGNED NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `rolesusuario`
--

INSERT INTO `rolesusuario` (`usuario`, `rol`) VALUES
(1, 1),
(2, 2),
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `contraseña` varchar(70) COLLATE utf8mb4_spanish_ci NOT NULL,
  `monedas` int(11) NOT NULL DEFAULT '100',
  `puntos` int(11) NOT NULL DEFAULT '0',
  `rutaImagen` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `bloqueado` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`, `monedas`, `puntos`, `rutaImagen`, `bloqueado`) VALUES
(1, 'user', 'user@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 100, 0, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', b'0'),
(2, 'admin', 'admin@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 100, 0, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', b'0'),
(3, 'prueba', 'prueba@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 100, 0, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', b'0'),
(4, '1234', '1234@example.org', '$2y$10$crE/87D6eqLr6A6/Vmt4zuDS7/igGThgX6t.ZWwvtyatT4E5gDqgm', 100, 0, NULL, b'0'),
(5, 'prueba', 'prueba@example.com', '$2y$10$6o18GzEFiT53FYy8sYM19.Nb2/hyVPQkPYeaSfnUndLNPBwsFYs8.', 100, 0, NULL, b'0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comprados`
--
ALTER TABLE `comprados`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `comprados_ibfk_5` (`idObjeto`),
  ADD KEY `comprados_ibfk_1` (`idUsuario`);

--
-- Indices de la tabla `consumibles`
--
ALTER TABLE `consumibles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre` (`nombre`,`categoria`);

--
-- Indices de la tabla `enemigo`
--
ALTER TABLE `enemigo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventariocontiene`
--
ALTER TABLE `inventariocontiene`
  ADD PRIMARY KEY (`idInventario`,`idConsumible`),
  ADD KEY `objetos` (`idConsumible`);

--
-- Indices de la tabla `inventariopartida`
--
ALTER TABLE `inventariopartida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IdObjeto` (`IdObjeto`);

--
-- Indices de la tabla `mapacontiene`
--
ALTER TABLE `mapacontiene`
  ADD PRIMARY KEY (`idMapa`,`idMazmorra`),
  ADD KEY `idMapa` (`idMapa`),
  ADD KEY `idMazmorra` (`idMazmorra`),
  ADD KEY `mazmorraEste` (`mazmorraEste`),
  ADD KEY `mazmorraSur` (`mazmorraSur`),
  ADD KEY `mazmorraOeste` (`mazmorraOeste`),
  ADD KEY `mazmorraNorte` (`mazmorraNorte`);

--
-- Indices de la tabla `mapas`
--
ALTER TABLE `mapas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propietario` (`propietario`);
ALTER TABLE `mapas` ADD FULLTEXT KEY `nombre` (`nombre`);

--
-- Indices de la tabla `mazmorraconsumibles`
--
ALTER TABLE `mazmorraconsumibles`
  ADD PRIMARY KEY (`idMazmorra`,`idConsumible`),
  ADD KEY `idMazmorra` (`idMazmorra`),
  ADD KEY `idConsumible` (`idConsumible`);

--
-- Indices de la tabla `mazmorraenemigo`
--
ALTER TABLE `mazmorraenemigo`
  ADD PRIMARY KEY (`idMazmorra`,`idEnemigo`),
  ADD KEY `enemigo` (`idEnemigo`);

--
-- Indices de la tabla `mazmorras`
--
ALTER TABLE `mazmorras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mazmorrassuperadas`
--
ALTER TABLE `mazmorrassuperadas`
  ADD PRIMARY KEY (`idMapa`,`idMazmorra`),
  ADD KEY `idenMazmorras` (`idMazmorra`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `idMensajePadre` (`idMensajePadre`);

--
-- Indices de la tabla `objetosusados`
--
ALTER TABLE `objetosusados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idMapa` (`idMapa`),
  ADD KEY `idPartida` (`idPartida`),
  ADD KEY `idMazmorra` (`idMazmorra`),
  ADD KEY `idObjeto` (`idObjeto`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`idPartida`),
  ADD KEY `idMapa` (`idMapa`),
  ADD KEY `idPersonaje` (`idPersonaje`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `personaje`
--
ALTER TABLE `personaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idInventario` (`idInventario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `rolesusuario`
--
ALTER TABLE `rolesusuario`
  ADD PRIMARY KEY (`usuario`,`rol`),
  ADD KEY `rol` (`rol`),
  ADD KEY `usuario_3` (`usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `nombre` (`nombre`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comprados`
--
ALTER TABLE `comprados`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consumibles`
--
ALTER TABLE `consumibles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `enemigo`
--
ALTER TABLE `enemigo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventariopartida`
--
ALTER TABLE `inventariopartida`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mapas`
--
ALTER TABLE `mapas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mazmorras`
--
ALTER TABLE `mazmorras`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `idPartida` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comprados`
--
ALTER TABLE `comprados`
  ADD CONSTRAINT `comprados_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `inventariocontiene`
--
ALTER TABLE `inventariocontiene`
  ADD CONSTRAINT `inventario` FOREIGN KEY (`idInventario`) REFERENCES `inventario` (`id`),
  ADD CONSTRAINT `objetos` FOREIGN KEY (`idConsumible`) REFERENCES `consumibles` (`id`);

--
-- Filtros para la tabla `inventariopartida`
--
ALTER TABLE `inventariopartida`
  ADD CONSTRAINT `inventariopartida_ibfk_1` FOREIGN KEY (`IdObjeto`) REFERENCES `consumibles` (`id`);

--
-- Filtros para la tabla `mapacontiene`
--
ALTER TABLE `mapacontiene`
  ADD CONSTRAINT `idMazmorra` FOREIGN KEY (`idMazmorra`) REFERENCES `mazmorras` (`id`),
  ADD CONSTRAINT `mapacontiene_ibfk_1` FOREIGN KEY (`idMapa`) REFERENCES `mapas` (`id`),
  ADD CONSTRAINT `mapacontiene_ibfk_2` FOREIGN KEY (`mazmorraNorte`) REFERENCES `mazmorras` (`id`),
  ADD CONSTRAINT `mapacontiene_ibfk_3` FOREIGN KEY (`mazmorraEste`) REFERENCES `mazmorras` (`id`),
  ADD CONSTRAINT `mapacontiene_ibfk_4` FOREIGN KEY (`mazmorraSur`) REFERENCES `mazmorras` (`id`),
  ADD CONSTRAINT `mapacontiene_ibfk_5` FOREIGN KEY (`mazmorraOeste`) REFERENCES `mazmorras` (`id`);

--
-- Filtros para la tabla `mapas`
--
ALTER TABLE `mapas`
  ADD CONSTRAINT `propietario` FOREIGN KEY (`propietario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mazmorraconsumibles`
--
ALTER TABLE `mazmorraconsumibles`
  ADD CONSTRAINT `mazmorraconsumibles_ibfk_1` FOREIGN KEY (`idMazmorra`) REFERENCES `mazmorras` (`id`),
  ADD CONSTRAINT `mazmorraconsumibles_ibfk_2` FOREIGN KEY (`idConsumible`) REFERENCES `consumibles` (`id`);

--
-- Filtros para la tabla `mazmorraenemigo`
--
ALTER TABLE `mazmorraenemigo`
  ADD CONSTRAINT `enemigo` FOREIGN KEY (`idEnemigo`) REFERENCES `enemigo` (`id`),
  ADD CONSTRAINT `mazmorra` FOREIGN KEY (`idMazmorra`) REFERENCES `mazmorras` (`id`);

--
-- Filtros para la tabla `mazmorrassuperadas`
--
ALTER TABLE `mazmorrassuperadas`
  ADD CONSTRAINT `idenMazmorras` FOREIGN KEY (`idMazmorra`) REFERENCES `mazmorras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mazmorrassuperadas_ibfk_1` FOREIGN KEY (`idMapa`) REFERENCES `mapas` (`id`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `Mensajes_mensaje` FOREIGN KEY (`idMensajePadre`) REFERENCES `mensajes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Mensajes_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `objetosusados`
--
ALTER TABLE `objetosusados`
  ADD CONSTRAINT `objetosusados_ibfk_2` FOREIGN KEY (`idMapa`) REFERENCES `mapas` (`id`),
  ADD CONSTRAINT `objetosusados_ibfk_3` FOREIGN KEY (`idMazmorra`) REFERENCES `mazmorras` (`id`),
  ADD CONSTRAINT `objetosusados_ibfk_4` FOREIGN KEY (`idUsuario`) REFERENCES `partida` (`idUsuario`),
  ADD CONSTRAINT `objetosusados_ibfk_5` FOREIGN KEY (`idObjeto`) REFERENCES `consumibles` (`id`),
  ADD CONSTRAINT `objetosusados_ibfk_6` FOREIGN KEY (`idPartida`) REFERENCES `partida` (`idPartida`);

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partida_ibfk_2` FOREIGN KEY (`idMapa`) REFERENCES `mapas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partida_ibfk_3` FOREIGN KEY (`idPersonaje`) REFERENCES `personaje` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personaje`
--
ALTER TABLE `personaje`
  ADD CONSTRAINT `idInventario` FOREIGN KEY (`idInventario`) REFERENCES `inventario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rolesusuario`
--
ALTER TABLE `rolesusuario`
  ADD CONSTRAINT `rolesusuario_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `rolesusuario_ibfk_2` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
