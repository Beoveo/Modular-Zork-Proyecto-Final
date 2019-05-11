--
-- Volcado de datos para la tabla `mapas`
--

INSERT INTO `mapas` (`id`, `nombre`, `dificultad`, `precio`, `numMazmorras`, `recompensa`, `mazmorrasSuperadas`, `propietario`, `rutaImagen`, `descripcion`, `valoracion`, `numJugado`, `terminadoCreado`) VALUES
(1, 'Castillo', 3, 15, 5, 0, '', 1, 'castillo.jpg', NULL, 5, 1, 1),
(2, 'Cuevas', 4, 16, 4, 0, '', 1, 'fondo.jpg', NULL, 3, 2, 1),
(3, 'Bosque Oscuro', 5, 30, 6, 0, '', 1, 'bosque.png', NULL, 0, 0, 1),
(11, 'map1', 1, 1, 2, 10, '', 1, 'mapa.jpg', 'Mapa 1', 5, 0, 0);
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
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`, `monedas`, `puntos`, `rutaFoto`, `bloqueado`) VALUES
(1, 'user', 'user@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 100, 0, 'bea.png',0),
(2, 'admin', 'admin@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 100, 0,'agu.png',0),
(3, 'prueba', 'prueba@example.org', '$2y$10$0eR.KhfTH5ybn/jlB86hwe/1nQeCKXk2RcLEjBscJbpUaF504kSOi', 100, 0,'bea.png',0),
(4, '1234', '1234@example.org', '$2y$10$crE/87D6eqLr6A6/Vmt4zuDS7/igGThgX6t.ZWwvtyatT4E5gDqgm', 100, 0,'bea.png',0);


INSERT INTO `enemigo` (`id`, `nombre`, `fuerza`, `habilidad`, `vida`, `precio`, `rutaImagen`) VALUES
(1, 'troll', 10, 10, 10, 10, 'monstruo.jpg');

INSERT INTO `consumibles` (`id`, `nombre`, `categoria`, `fuerza`, `habilidad`, `vida`, `precio`, `rutaImagen`) VALUES
(1, 'hacha', 'armas', 10, 10, 10, 10, 'hacha.jpg');

INSERT INTO `inventario` (`id`, `tamaño`) VALUES
(1, 10);

INSERT INTO `inventariocontiene` (`idInventario`, `idConsumible`) VALUES
(1, 1);

INSERT INTO `mazmorraconsumibles` (`idMazmorra`, `idConsumible`) VALUES
(1, 1);

INSERT INTO `mazmorras` (`id`, `nombre`, `numSalidas`, `numEnemigos`, `recompensa`, `rutaImagen`, `historia`) VALUES
(1, 'm1', 1, 1, 5, 'mapa.jpg', 'Bienvenido a la mazmorra 1'),
(2, 'm2', 1, 0, 5, 'mapa.jpg', 'Bienvenido a la mazmorra 2');









/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
