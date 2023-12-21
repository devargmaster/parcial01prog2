-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-12-2023 a las 02:23:30
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
-- Base de datos: `decotutti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `carrito_guid` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `fecha`, `usuario_id`, `estado`, `producto_id`, `cantidad`, `precio`, `carrito_guid`) VALUES
(19, '2023-12-14 00:00:00', 2, 1, 2, 1, 19500, '39DDD07D-7E94-41A3-829A-5BA45DEA0771'),
(20, '2023-12-14 00:00:00', 2, 1, 1, 1, 29500, '39DDD07D-7E94-41A3-829A-5BA45DEA0771'),
(21, '2023-12-14 00:00:00', 1, 1, 1, 1, 29500, '806DC622-D39D-42B9-9743-3A270699AE70'),
(22, '2023-12-14 00:00:00', 1, 1, 2, 1, 19500, '806DC622-D39D-42B9-9743-3A270699AE70'),
(23, '2023-12-14 00:00:00', 1, 1, 3, 1, 81300, '806DC622-D39D-42B9-9743-3A270699AE70'),
(24, '2023-12-16 00:00:00', 2, 1, 2, 1, 19500, '4AE24A70-808A-4FD1-81E5-0B2685ACDFB3'),
(25, '2023-12-19 00:00:00', 1, 1, 1, 1, 39500, '6D6FF5AC-5B20-4130-90CA-66F0EAFAC881'),
(26, '2023-12-19 00:00:00', 1, 1, 2, 1, 19500, '6D6FF5AC-5B20-4130-90CA-66F0EAFAC881'),
(27, '2023-12-19 00:00:00', 1, 1, 7, 1, 107900, '6D6FF5AC-5B20-4130-90CA-66F0EAFAC881'),
(28, '2023-12-20 00:00:00', 4, 1, 1, 1, 39500, '79ADA872-0E17-433E-9D61-8DF086C28C98'),
(29, '2023-12-20 00:00:00', 4, 1, 2, 1, 19500, '224EF8AD-FED5-4B27-99E8-1C4EFAC155B1'),
(30, '2023-12-20 19:11:09', 1, 1, 3, 1, 81300, 'B75629A5-2338-4508-B40C-7313EF3A5ADC'),
(31, '2023-12-20 20:20:18', 1, 1, 1, 1, 39500, 'FB99F351-B939-4D3E-81DE-A604965491E5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `habilitada` int(11) DEFAULT 0,
  `es_menu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='tabla que contiene la categoria de productos';

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `habilitada`, `es_menu`) VALUES
(1, 'Home', 'home', 1, 0),
(2, 'Catálogo', 'catalogo', 1, 0),
(3, 'Bazar', 'bazar', 1, 0),
(4, 'Comedor', 'comedor', 1, 0),
(5, 'Decor', 'decor', 1, 0),
(6, 'Iluminación', 'iluminacion', 1, 0),
(7, 'Mis Datos', 'datos_alumno', 1, 1),
(8, 'Contactanos!', 'contacto', 1, 1),
(9, 'Carrito', 'carrito', 1, 1),
(10, 'Usuario', 'usuario', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_adicional`
--

CREATE TABLE `informacion_adicional` (
  `id` int(11) NOT NULL,
  `medidas` varchar(200) DEFAULT NULL,
  `peso` varchar(250) DEFAULT NULL,
  `material` varchar(250) DEFAULT NULL,
  `origen` varchar(250) DEFAULT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `informacion_adicional`
--

INSERT INTO `informacion_adicional` (`id`, `medidas`, `peso`, `material`, `origen`, `producto_id`) VALUES
(1, '18 x 18 x 30 cm', '2,5 kg', 'Vidrio', 'China', 13),
(2, '18 x 18 x 50 cm', '1,5 kg', 'Vidrio', 'China', 14),
(3, '', '', '', '', 15),
(4, '', '', '', '', 16),
(5, '25 x 32 x 32 cm', '3,7 kg', 'Vidrio', 'China', 17),
(6, '45x22x22CM', '3,5 kg', 'Vidrio', 'China', 18),
(24, '9 x 13 x 20 cm', '1,5 kg', 'Vidrio', 'China', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `marca_titulo` varchar(250) DEFAULT NULL,
  `marca_descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `marca_titulo`, `marca_descripcion`) VALUES
(1, 'Floreros ChinaTown', 'Los mejores floreros!'),
(3, 'BazarBest', 'Mejores Productos de Bazar'),
(11, 'DecoraTutti', 'Marca Propia'),
(12, 'Mueblin', 'Telefono:');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `oferta_descripcion` varchar(500) DEFAULT NULL,
  `oferta_titulo` varchar(250) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `oferta_descripcion`, `oferta_titulo`, `producto_id`) VALUES
(11, 'descuento sobre la segunda unidad!', '2 x 1', 1),
(13, 'Super Oferta vigente de diciembre 2023 a enero 2024', 'Super Oferta!', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL COMMENT 'id de tabla',
  `producto_nombre` varchar(200) DEFAULT NULL,
  `producto_precio` double DEFAULT NULL,
  `producto_descripcion` varchar(500) DEFAULT NULL,
  `producto_imagen` varchar(100) DEFAULT NULL,
  `producto_stock` int(11) NOT NULL DEFAULT 0,
  `producto_destacado` tinyint(1) DEFAULT 0,
  `producto_nuevo` tinyint(1) DEFAULT 1,
  `marca_id` int(11) DEFAULT NULL,
  `producto_fecha` datetime DEFAULT current_timestamp(),
  `producto_estado` tinyint(1) DEFAULT 0,
  `fecha_upd` datetime DEFAULT NULL,
  `usuario_upd` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `producto_nombre`, `producto_precio`, `producto_descripcion`, `producto_imagen`, `producto_stock`, `producto_destacado`, `producto_nuevo`, `marca_id`, `producto_fecha`, `producto_estado`, `fecha_upd`, `usuario_upd`) VALUES
(1, 'Florero Tarff Ambar', 39500, 'Espléndido por su forma y por su efecto tipo carey, nuestro florero Tarff está hecho en vidrio en color ámbar. Su diseño, sin dudas, logrará un acento en la decoración de su hogar, ya sea en mesas bajas o mesas de comedor. Disponible en dos tonalidades. Conoce toda nuestra línea de floreros.', '1700676177.webp', 10, 1, 1, 1, '2023-11-22 00:00:00', 1, NULL, NULL),
(2, 'Florero Thay - Small', 19500, 'Florero contemporáneo, hecho íntegramente en liso vidrio transparente en color ámbar. Su forma lo hace perfecto para mostrar un ramo de flores frescas, y sirve a su vez, como elemento decorativo para toda sala de estar o comedor. Disponible en dos medidas. Conoce toda nuestra línea de floreros.', '1700676976.webp', 10, 0, 1, 1, '2023-11-22 00:00:00', 1, NULL, NULL),
(3, 'Florero Leoti - Small', 81300, 'De diseño llamativo, gracias a su patrón rítmico, este florero resaltará la decoración en cualquier hogar aportando mucho estilo y originalidad. Nuestro impresionante florero de vidrio tallado utiliza una forma cilíndrica con base lisa en color café. Los materiales y las formas simples, pero con gran presencia visual facilitan la decoración de mesas y consolas. Disponible en dos medidas. Conoce toda nuestra línea de floreros.', '1700677095.webp', 10, 0, 1, 1, '2023-11-22 00:00:00', 1, NULL, NULL),
(4, 'Florero Oxbo Medium', 81300, 'De diseño llamativo, gracias a su patrón rítmico, este florero resaltará la decoración en cualquier hogar aportando mucho estilo y originalidad. Nuestro impresionante florero de vidrio tallado utiliza una forma cilíndrica con base lisa en color café. Los materiales y las formas simples, pero con gran presencia visual facilitan la decoración de mesas y consolas. Disponible en dos medidas. Conoce toda nuestra línea de floreros.', '1700677150.webp', 10, 1, 1, 1, '2023-11-22 00:00:00', 1, NULL, NULL),
(5, 'Florero Abill', 150000, 'Centrándose en las sutilezas de las formas, nuestro florero Abill está elaborado en vidrio en color blanco opaco. Esta pieza original y sofisticada está pensada para la exhibición de flores o como adorno decorativo en mesas bajas y consolas de espacios modernos. Conoce toda nuestra línea de floreros.', '1700677253.webp', 10, 0, 1, 1, '2023-11-22 00:00:00', 1, NULL, NULL),
(7, 'Alhajero Insecto Acrilico', 107900, 'Inspirado en la naturaleza exótica, nuestro alhajero rectangular con incrustación de insecto dorado está elaborado en resina y caja de acrílico transparente. Diseñado para exhibir artículos personales u objetos pequeños, es un elemento ideal para el tocador, sala de estar o dormitorio.', '1700681931.webp', 2, 1, 1, 3, '2023-11-22 00:00:00', 1, NULL, NULL),
(8, 'Frasco Rocabar Tapa De Metal', 176900, 'Diseñado para contener y almacenar cualquier tipo de elemento, este frasco está elaborado en vidrio tallado con un patrón geométrico de cuadrícula y tapa de bronce opaco. Con reminiscencia a accesorios utilizados en antiguos boticarios, aportará un característico toque vintage con aire moderno a toda decoración. Disponible en dos medidas.', '1700682140.webp', 10, 1, 1, 3, '2023-11-22 00:00:00', 1, NULL, NULL),
(10, 'Mesa De Comedor Chimay', 794000, 'Mesa de comder Chimay que combina la rusticidad de la madera de roble natural autóctono con pátina negra con el brillo del acero pulido de su estructura, creando un contraste de texturas único. Ideal para otorgar un toque rústico a un comedor sofisticado.', '1700682593.webp', 10, 0, 1, 12, '2023-11-22 00:00:00', 1, NULL, NULL),
(12, 'Porta Utensilios Lines', 150000, 'Con su practicidad característica, nuestro porta utensilios a rayas está hecho en mármol pulido en colores blanco y negro. Este organizador de bazar es perfecto para mantener la cocina ordenada de forma elegante y con estilo sofisticado, conteniendo utensilios prácticos para la hora de cocinar. Combina este porta utensilios con nuestra tabla de la misma colección. Las variaciones en el veteado natural hacen que cada pieza de mármol sea única.', '1700682850.webp', 12, 1, 1, 3, '2023-11-22 00:00:00', 1, NULL, NULL),
(13, 'Individual Bouro', 17500, 'Celebrando la belleza de un delicado tejido hecho a mano en seagrass, nuestro individual rico en textura agrega una rusticidad y calidez acogedora a toda mesa de comedor. Conozca todos nuestros individuales confeccionados en fibras naturales.', '1700683016.webp', 10, 1, 1, 3, '2023-11-22 00:00:00', 1, NULL, NULL),
(14, 'Individual Povoa Black', 11000, 'Individual redondo de carácter rústico y moderno. Celebrando la belleza de un delicado tejido hecho a mano en seagrass en color negro, nuestro individual rico en textura agrega una rusticidad y calidez acogedora a toda mesa de comedor. Conozca todos nuestros individuales confeccionados en fibras naturales.', '1700683131.webp', 10, 1, 1, 3, '2023-11-22 00:00:00', 1, NULL, NULL),
(15, 'Canvas Crown', 10500, 'Esta impresión en lienzo es una reproducción de la partitura de Crown Diamonds..', '1700683327.webp', 1, 1, 1, 1, '2023-11-22 00:00:00', 1, NULL, NULL),
(16, 'Salero y Pimentero Nagpu', 69000, 'Nuestro set de salero y pimentero agrega un toque de estilo a lo   esencial de todos los días. Hecho de acero inoxidable, franjas blancas y negras de nácar aportan un diseño atemporal y elegante a cualquier mesa. Incluye caja decorativa perfecta para mantenerlos ordenados o como regalo.', '1700702395.webp', 10, 1, 1, 3, '2023-11-22 00:00:00', 1, NULL, NULL),
(17, 'Posavasos Teak con Caja', 60400, 'Hechos de acero pulido y madera natural de teca, nuestro set de posavasos moderno y atemporal', '1700702410.webp', 10, 1, 1, 3, '2023-11-22 00:00:00', 1, NULL, NULL),
(18, 'Lampara De Mesa Ontario Three', 224100, 'Nuestra lámpara de mesa vintage y encanto industrial aporta distinción a cualquier ambiente con su apariencia tradicional y estilo contemporáneo. La campana de vidrio se apoya en una base que muestra bombillas de filamento estilo Edison generando un ambiente de luz tenue y haciendo una declaración refinada y llamativa en la sala de estar, entrada, dormitorio u oficina. Incluye focos tipo vintage; la forma de este puede variar respecto a las imágenes mostradas. Disponible en diferentes medidas', '1700703870.webp', 10, 1, 1, 1, '2023-11-22 00:00:00', 1, NULL, NULL),
(36, 'Silla Buri Grey', 123000, 'Silla de ratán sintético circular inspirada en el modernismo clásico de mediados de siglo. Perfecta para combinar con una gran mesa de madera y artículos escandinavos o mezclar con diferentes colores para crear una apariencia única. Diseño abierto y estructura de hierro negro. Disponible también en otros colores.', '1703115256.webp', 10, 0, 1, 12, '2023-12-20 20:34:16', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_carrito`
--

CREATE TABLE `productos_carrito` (
  `producto_id` int(11) DEFAULT NULL,
  `carrito_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_categorias`
--

CREATE TABLE `productos_categorias` (
  `producto_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_categorias`
--

INSERT INTO `productos_categorias` (`producto_id`, `categoria_id`, `id`) VALUES
(13, 3, 1),
(14, 3, 2),
(15, 5, 3),
(16, 3, 4),
(17, 3, 5),
(3, 5, 6),
(1, 5, 7),
(2, 5, 8),
(4, 5, 9),
(5, 5, 10),
(7, 5, 12),
(8, 5, 13),
(10, 4, 16),
(12, 3, 17),
(18, 6, 18),
(36, 4, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_categorias_subcategorias`
--

CREATE TABLE `productos_categorias_subcategorias` (
  `producto_id` int(11) DEFAULT NULL,
  `subcategoria_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_categorias_subcategorias`
--

INSERT INTO `productos_categorias_subcategorias` (`producto_id`, `subcategoria_id`, `id`) VALUES
(7, 7, 6),
(17, 13, 8),
(16, 13, 9),
(13, 2, 15),
(14, 2, 16),
(12, 13, 17),
(4, 17, 42),
(18, 11, 48),
(1, 17, 50),
(8, 7, 56),
(3, 17, 61),
(2, 17, 64),
(10, 9, 65),
(36, 8, 66),
(15, 6, 89),
(15, 12, 90),
(5, 17, 91);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `esmenu` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `nombre`, `descripcion`, `categoria_id`, `esmenu`) VALUES
(1, 'Utensillos', 'utensillos', 3, 0),
(2, 'Textiles', 'textiles', 3, 0),
(4, 'Ingresar', 'login', 10, 1),
(5, 'Salir', 'logout', 10, 1),
(6, 'Cuadros', 'cuadros', 5, 0),
(7, 'Almacenaje', 'almacenaje', 5, 0),
(8, 'Sillas', 'sillas', 4, 0),
(9, 'Mesas', 'mesas', 4, 0),
(10, 'Iluminacion de pie', 'iluminacion_pie', 6, 0),
(11, 'Iluminación de Mesa', 'iluminacion_mesa', 6, 0),
(12, 'Carteles', 'carteles', 5, 0),
(13, 'Accesorios', 'accesorios', 3, 0),
(17, 'Floreros', 'floreros', 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `apellido` varchar(250) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `usuario` varchar(250) DEFAULT NULL,
  `clave` varchar(250) DEFAULT NULL,
  `rol` varchar(150) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `domicilio` varchar(100) DEFAULT 'Siempre Viva 744',
  `telefono` int(11) DEFAULT NULL,
  `codigopostal` varchar(8) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT 'Buenos Aires'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `usuario`, `clave`, `rol`, `estado`, `domicilio`, `telefono`, `codigopostal`, `ciudad`) VALUES
(1, 'Walter', 'Arce', 'walter.arce@davinci.edu.ar', 'warce2', '$2y$10$t9ebat3Ioe0g38zM3td40uroHuvCSS9ozIhWNqqetjQD1bsEZBGCu', 'administrador', 1, 'Siempre Viva 744', 11555666, '1319', 'Buenos Aires'),
(2, 'Walter', 'Arce', 'walterarce@gmail.com', 'warce', '$2y$10$fi.RBksNtVNk8qz.YX.M6erIZ5HgHCXE9IXSmVJfl1RnkDONs8CCq', 'usuario', 1, 'Siempre Viva 744', 11555666, 'AW1766WE', 'Buenos Aires'),
(3, 'Usuario', 'Usuario', 'walter.arce@davinci.edu.ar', 'demoUsuario', '$2y$10$ZtiwtGz6x4T/Wujx4tIC9Obd9pq5kEiZaBtxWIaT8N1PAedDZueX6', 'usuario', 1, 'Siempre Viva 744', 11555666, '2288', 'Buenos Aires'),
(4, 'Walter Javier', 'Arce', 'walterarce@gmail.com', 'demo2', '$2y$10$rFF5a72m4DHgva/jgpsMV.kqAmdpHpMdNWjJkWn2wkwM6fn4xvo3K', 'usuario', 1, 'Panama 920', 12323123, '1877', 'CABA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrito_usuario_id_index` (`usuario_id`),
  ADD KEY `carrito_productos_id_fk` (`producto_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `informacion_adicional`
--
ALTER TABLE `informacion_adicional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informacion_adicional_productos_id_fk` (`producto_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ofertas_productos_id_fk` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_marcas_id_fk` (`marca_id`);

--
-- Indices de la tabla `productos_carrito`
--
ALTER TABLE `productos_carrito`
  ADD KEY `productos_carrito_carrito_id_fk` (`carrito_id`),
  ADD KEY `productos_carrito_productos_id_fk` (`producto_id`);

--
-- Indices de la tabla `productos_categorias`
--
ALTER TABLE `productos_categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_categorias_categorias_id_fk` (`categoria_id`),
  ADD KEY `productos_categorias_productos_id_fk` (`producto_id`);

--
-- Indices de la tabla `productos_categorias_subcategorias`
--
ALTER TABLE `productos_categorias_subcategorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_categorias_subcategorias_productos_id_fk` (`producto_id`),
  ADD KEY `productos_categorias_subcategorias_subcategorias_id_fk` (`subcategoria_id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategorias_categorias_id_fk` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `informacion_adicional`
--
ALTER TABLE `informacion_adicional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de tabla', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `productos_categorias`
--
ALTER TABLE `productos_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `productos_categorias_subcategorias`
--
ALTER TABLE `productos_categorias_subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_productos_id_fk` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `informacion_adicional`
--
ALTER TABLE `informacion_adicional`
  ADD CONSTRAINT `informacion_adicional_productos_id_fk` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_productos_id_fk` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_marcas_id_fk` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos_carrito`
--
ALTER TABLE `productos_carrito`
  ADD CONSTRAINT `productos_carrito_carrito_id_fk` FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_carrito_productos_id_fk` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos_categorias`
--
ALTER TABLE `productos_categorias`
  ADD CONSTRAINT `productos_categorias_categorias_id_fk` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_categorias_productos_id_fk` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos_categorias_subcategorias`
--
ALTER TABLE `productos_categorias_subcategorias`
  ADD CONSTRAINT `productos_categorias_subcategorias_productos_id_fk` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_categorias_subcategorias_subcategorias_id_fk` FOREIGN KEY (`subcategoria_id`) REFERENCES `subcategorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_categorias_id_fk` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
