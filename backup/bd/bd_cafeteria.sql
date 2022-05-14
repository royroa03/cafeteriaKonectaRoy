-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2022 a las 17:46:41
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_cafeteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `id_acceso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ip` varchar(240) DEFAULT NULL,
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id_acceso`, `id_usuario`, `ip`, `feregistro`) VALUES
(1, 2, '::1', '2022-05-14 13:54:59'),
(2, 2, '::1', '2022-05-14 13:55:23'),
(3, 1, '::1', '2022-05-14 13:56:01'),
(4, 2, '::1', '2022-05-14 14:07:45'),
(5, 1, '::1', '2022-05-14 14:07:53'),
(6, 2, '::1', '2022-05-14 14:17:15'),
(7, 2, '::1', '2022-05-14 14:17:22'),
(8, 1, '::1', '2022-05-14 14:17:37'),
(9, 2, '::1', '2022-05-14 14:34:24'),
(10, 1, '::1', '2022-05-14 14:35:07'),
(11, 2, '::1', '2022-05-14 14:38:43'),
(12, 1, '::1', '2022-05-14 14:41:44'),
(13, 2, '::1', '2022-05-14 14:51:49'),
(14, 1, '::1', '2022-05-14 15:12:32'),
(15, 2, '::1', '2022-05-14 15:25:53'),
(16, 1, '::1', '2022-05-14 15:29:15'),
(17, 4, '::1', '2022-05-14 15:29:25'),
(18, 4, '::1', '2022-05-14 15:29:52'),
(19, 2, '::1', '2022-05-14 15:31:58'),
(20, 1, '::1', '2022-05-14 15:33:24'),
(21, 2, '::1', '2022-05-14 15:45:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `monto_inicial` decimal(10,2) DEFAULT NULL,
  `fecha_apertura` date NOT NULL,
  `feregistro_apertura` timestamp NULL DEFAULT NULL,
  `fecha_cierre` date NOT NULL,
  `feregistro_cierre` timestamp NULL DEFAULT NULL,
  `id_moneda` int(11) DEFAULT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '	0: Activo // 1: Inactivo // 2: Aperturado // 3:Cerrado',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `id_usuario`, `monto_inicial`, `fecha_apertura`, `feregistro_apertura`, `fecha_cierre`, `feregistro_cierre`, `id_moneda`, `flestado`, `feregistro`) VALUES
(1, 2, '100.00', '2022-05-14', '2022-05-14 21:34:38', '2022-12-31', NULL, 1, 2, '2022-05-14 14:34:02'),
(2, 3, NULL, '2022-05-14', NULL, '2022-12-31', NULL, NULL, 0, '2022-05-14 14:34:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `flestado`, `feregistro`) VALUES
(1, 'Lácteo', 0, '2019-08-25 06:10:53'),
(2, 'Golosina', 0, '2019-08-25 06:11:01'),
(3, 'Tecnología', 0, '2019-08-25 06:11:13'),
(4, 'Avícola', 0, '2019-08-28 06:13:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `tipo_doc` int(11) NOT NULL COMMENT '1: DNI // 2: RUC',
  `nro_doc` varchar(20) NOT NULL,
  `razon_social` varchar(240) DEFAULT NULL,
  `nombres` varchar(200) DEFAULT NULL,
  `apellido_paterno` varchar(200) DEFAULT NULL,
  `apellido_materno` varchar(200) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL COMMENT '1: Masculino // 2: Femenino',
  `telefono1` varchar(50) DEFAULT NULL,
  `telefono2` varchar(50) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `referencia` varchar(200) DEFAULT NULL,
  `correo` varchar(240) DEFAULT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `tipo_doc`, `nro_doc`, `razon_social`, `nombres`, `apellido_paterno`, `apellido_materno`, `sexo`, `telefono1`, `telefono2`, `direccion`, `referencia`, `correo`, `flestado`, `feregistro`) VALUES
(1, 1, '12345678', '', 'Cliente', 'Konecta', '01', NULL, '', '', '', '', '', 0, '2022-05-14 13:45:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_proveedor` int(11) NOT NULL,
  `id_mediopago` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `conversion` decimal(10,2) NOT NULL,
  `efectivo` decimal(10,2) NOT NULL,
  `vuelto` decimal(10,2) NOT NULL,
  `flestado` int(11) NOT NULL COMMENT '0: Pagado // 1: Pendiente // 2: Anulado',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `feregistro_anular` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compradetalle`
--

CREATE TABLE `compradetalle` (
  `id_compradetalle` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `id_comprobante` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `descripcion` varchar(240) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`id_comprobante`, `codigo`, `descripcion`, `flestado`, `feregistro`) VALUES
(1, 'BO', 'Boleta', 0, '2019-08-23 23:07:24'),
(2, 'FA', 'Factura', 0, '2019-08-24 03:42:55'),
(3, 'TK', 'Ticket', 0, '2019-09-23 19:57:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditocliente`
--

CREATE TABLE `creditocliente` (
  `id_creditocliente` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `deuda` decimal(10,2) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Pendiente // 1: Pagado // 2: Anulado',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditoclientedetalle`
--

CREATE TABLE `creditoclientedetalle` (
  `id_creditoclientedetalle` int(11) NOT NULL,
  `id_creditocliente` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditoproveedor`
--

CREATE TABLE `creditoproveedor` (
  `id_creditoproveedor` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `deuda` decimal(10,2) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Pendiente // 1: Pagado // 2: Anulado',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditoproveedordetalle`
--

CREATE TABLE `creditoproveedordetalle` (
  `id_creditoproveedordetalle` int(11) NOT NULL,
  `id_creditoproveedor` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `feregistro` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `tipo_doc` int(11) NOT NULL,
  `nro_doc` varchar(20) NOT NULL,
  `razon_social` varchar(240) NOT NULL,
  `telefono1` varchar(50) NOT NULL,
  `telefono2` varchar(50) NOT NULL,
  `direccion` varchar(240) NOT NULL,
  `referencia` varchar(240) NOT NULL,
  `ruta_imagen` varchar(240) NOT NULL,
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `tipo_doc`, `nro_doc`, `razon_social`, `telefono1`, `telefono2`, `direccion`, `referencia`, `ruta_imagen`, `feregistro`) VALUES
(1, 2, '10727037964', 'Grupo Konecta', '917919003', '', 'Lima', '', 'c81698ba44ac66954667c48eabecccc8.png', '2019-09-25 15:35:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id_kardex` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `concepto` varchar(240) NOT NULL,
  `observacion` varchar(240) NOT NULL,
  `cantentrada` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantsalida` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantsaldo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `id_compra` int(11) DEFAULT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_merma` int(11) DEFAULT NULL,
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`id_kardex`, `id_producto`, `concepto`, `observacion`, `cantentrada`, `cantsalida`, `cantsaldo`, `id_compra`, `id_venta`, `id_merma`, `feregistro`) VALUES
(1, 4, 'Por venta', 'Sin observación', '0.00', '3.00', '7.00', NULL, 1, NULL, '2022-05-14 15:11:06'),
(2, 6, 'Por venta', 'Sin observación', '0.00', '4.00', '6.00', NULL, 1, NULL, '2022-05-14 15:11:06'),
(3, 7, 'Por venta', 'Sin observación', '0.00', '1.00', '9.00', NULL, 1, NULL, '2022-05-14 15:11:06'),
(4, 6, 'Por venta', 'Sin observación', '0.00', '6.00', '0.00', NULL, 2, NULL, '2022-05-14 15:11:51'),
(5, 11, 'Por venta', 'Sin observación', '0.00', '2.00', '8.00', NULL, 2, NULL, '2022-05-14 15:11:51'),
(6, 9, 'Por venta', 'Sin observación', '0.00', '3.00', '7.00', NULL, 2, NULL, '2022-05-14 15:11:51'),
(7, 5, 'Por venta', 'Sin observación', '0.00', '2.00', '8.00', NULL, 3, NULL, '2022-05-14 15:12:18'),
(8, 7, 'Por venta', 'Sin observación', '0.00', '1.00', '8.00', NULL, 3, NULL, '2022-05-14 15:12:18'),
(9, 8, 'Por venta', 'Sin observación', '0.00', '1.00', '9.00', NULL, 3, NULL, '2022-05-14 15:12:18'),
(10, 10, 'Por venta', 'Sin observación', '0.00', '1.00', '9.00', NULL, 3, NULL, '2022-05-14 15:12:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mediopago`
--

CREATE TABLE `mediopago` (
  `id_mediopago` int(11) NOT NULL,
  `nombre` varchar(240) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '	0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mediopago`
--

INSERT INTO `mediopago` (`id_mediopago`, `nombre`, `flestado`, `feregistro`) VALUES
(1, 'Efectivo', 0, '2019-09-05 02:47:55'),
(2, 'Crédito', 0, '2019-09-05 02:48:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `merma`
--

CREATE TABLE `merma` (
  `id_merma` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `observacion` varchar(240) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0,
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `id_moneda` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `simbolo` varchar(50) NOT NULL,
  `iso` varchar(50) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`id_moneda`, `nombre`, `simbolo`, `iso`, `flestado`, `feregistro`) VALUES
(1, 'Sol', 'S/', 'PEN', 0, '2019-08-24 14:18:27'),
(2, 'Dolar Americano', '$', 'USD', 0, '2019-08-25 02:36:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre`, `flestado`, `feregistro`) VALUES
(1, 'Administrador', 0, '2019-08-23 07:06:19'),
(2, 'Cajero', 0, '2019-08-25 08:17:03'),
(3, 'Almacén', 0, '2019-08-25 08:20:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_personal` int(11) NOT NULL,
  `tipo_doc` int(11) NOT NULL COMMENT '1: DNI // 2: RUC',
  `nro_doc` varchar(20) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellido_paterno` varchar(200) NOT NULL,
  `apellido_materno` varchar(200) NOT NULL,
  `sexo` int(11) NOT NULL COMMENT '1: Masculino // 2: Femenino',
  `telefono1` varchar(50) NOT NULL,
  `telefono2` varchar(50) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `referencia` varchar(200) DEFAULT NULL,
  `id_ubigeo` int(11) DEFAULT NULL,
  `ruta_foto` varchar(240) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `tipo_doc`, `nro_doc`, `nombres`, `apellido_paterno`, `apellido_materno`, `sexo`, `telefono1`, `telefono2`, `direccion`, `referencia`, `id_ubigeo`, `ruta_foto`, `id_empresa`, `flestado`, `feregistro`) VALUES
(1, 1, '72703796', 'Roy', 'Roa', 'Sánchez', 1, '917919003', '', '', '', NULL, '2c21f2a4a9c4092bdf690cdde50d2c93.jpg', 1, 0, '2019-08-23 07:07:14'),
(2, 1, '11223344', 'Personal', 'Konecta', '02', 1, '998877665', '', '', '', NULL, 'a2c1d3e44c758d5b378f227368d40ec1.png', 1, 0, '2019-08-25 09:18:13'),
(3, 1, '99887766', 'Personal', 'Konecta', '03', 2, '887766554', '', '', '', NULL, 'f003f8830bd2bff87f2b1b725d8e4f00.png', 1, 0, '2019-08-25 09:28:31'),
(4, 1, '98765432', 'Personal', 'Konecta', '03', 1, '--', '', '', '', NULL, '09d2ee39ebe52dd599c8a4cc72dc310d.png', 1, 0, '2019-09-13 03:53:48'),
(5, 1, '23456789', 'Usuario4', 'Bitlogy', 'Bitlogy', 1, '12121212', '', '', '', NULL, '', 1, 0, '2019-09-25 17:26:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(240) NOT NULL,
  `ruta_imagen` varchar(240) NOT NULL,
  `descripcion` varchar(240) DEFAULT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `ruta_imagen`, `descripcion`, `cantidad`, `id_unidad`, `precio_unitario`, `id_categoria`, `id_moneda`, `flestado`, `feregistro`) VALUES
(1, 'Leche Gloria 410g', '5f49743e608d64d4388ff9e0ea52dcdb.jpg', 'Leche Gloria 410g', '1.00', 3, '3.20', 1, 1, 0, '2019-08-25 07:33:18'),
(2, 'Milanesa de Pollo 240g', '2f4e3f10daf7bfaf53dd39f44ac180c2.jpg', 'Milanesa de Pollo 240g', '1.00', 3, '2.00', 4, 1, 0, '2019-08-28 06:14:26'),
(3, 'Leche Ideal Amanecer 240g', '4c1952a44b19b7212d3961a799fd2775.jpg', 'Leche Ideal Amanecer 240g', '1.00', 3, '2.20', 1, 1, 0, '2019-08-30 07:17:28'),
(4, 'Pollo Entero', '55069113badc8594e8eb8e87402811d5.jpg', 'Pollo Entero', '1.00', 1, '5.50', 4, 1, 0, '2019-09-05 04:37:29'),
(5, 'Gallina Entera', '7db9cc75dc0f28adaa4a000b7b21af00.jpg', 'Gallina Entera', '1.00', 1, '12.50', 4, 1, 0, '2019-09-05 04:37:57'),
(6, 'Chancho Entero', '22d50c87a07a141fa6ab45b5521d9679.jpg', 'Chancho Entero', '1.00', 1, '10.00', 4, 1, 0, '2019-09-05 04:38:21'),
(7, 'Hígado de Pollo', '3dbc82a4cdc9247a5bfc6d30d44c8e6d.jpg', 'Hígado de Pollo', '1.00', 1, '5.00', 4, 1, 0, '2019-09-05 04:38:58'),
(8, 'Galleta Tentación 310g', '0dd567803f7db7910827b59ea2bca730.jpg', 'Galleta Tentación 310g', '1.00', 3, '3.50', 2, 1, 0, '2019-09-08 06:34:37'),
(9, 'Galleta Oreo 405g', '179ec4caa065eb12d3c5feb997eb69b5.jpeg', 'Galleta Oreo 405g', '1.00', 3, '4.00', 2, 1, 0, '2019-09-08 06:34:58'),
(10, 'USB Hyundai 3.0 16Gbs', '0d98f0c6b61a7a46ba7a21410ba4dfd4.jpg', 'USB Hyundai 3.0 16Gbs', '1.00', 3, '25.00', 3, 1, 0, '2019-09-08 06:35:20'),
(11, 'Leche Pura Vida 400g', 'b8e88a1bee00fd010217a035b5219a75.jpg', 'Leche Pura Vida 400g', '1.00', 3, '1.50', 1, 1, 0, '2019-09-12 03:53:28'),
(12, 'Mouse Amazon Basics', '5668bd480900151bdb157b1a0c446021.jpg', 'Mouse Amazon Basics', '1.00', 3, '80.00', 3, 1, 0, '2019-09-23 21:08:25'),
(13, 'Audífono Bluetooth', '075ec601a23380f78492e5d787c548c2.png', 'Audífono Bluetooth', '1.00', 3, '150.00', 3, 1, 0, '2022-05-14 14:26:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `tipo_doc` int(11) NOT NULL COMMENT '1: DNI // 2: RUC',
  `nro_doc` varchar(20) NOT NULL,
  `razon_social` varchar(240) NOT NULL,
  `telefono1` varchar(50) NOT NULL,
  `telefono2` varchar(50) DEFAULT NULL,
  `direccion` varchar(240) NOT NULL,
  `referencia` varchar(240) DEFAULT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `tipo_doc`, `nro_doc`, `razon_social`, `telefono1`, `telefono2`, `direccion`, `referencia`, `flestado`, `feregistro`) VALUES
(1, 2, '107799887743', 'Servicios Roy Roa S.A.C', '919191913', '', 'Calle ABC ', '', 0, '2019-08-23 19:38:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantactual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantreserva` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantdisponible` decimal(10,2) NOT NULL DEFAULT 0.00,
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `id_producto`, `cantactual`, `cantreserva`, `cantdisponible`, `feregistro`) VALUES
(1, 1, '0.00', '0.00', '0.00', '2019-09-12 03:53:59'),
(2, 2, '25.00', '0.00', '25.00', '2019-09-12 03:59:53'),
(3, 3, '80.00', '0.00', '80.00', '2019-09-12 03:59:53'),
(4, 4, '7.00', '0.00', '7.00', '2019-09-12 04:00:01'),
(5, 5, '8.00', '0.00', '8.00', '2019-09-12 04:00:01'),
(6, 6, '0.00', '0.00', '0.00', '2019-09-12 04:00:08'),
(7, 7, '8.00', '0.00', '8.00', '2019-09-12 04:00:08'),
(8, 8, '9.00', '0.00', '9.00', '2019-09-12 04:00:23'),
(9, 9, '7.00', '0.00', '7.00', '2019-09-12 04:00:23'),
(10, 10, '9.00', '0.00', '9.00', '2019-09-12 04:00:33'),
(11, 11, '8.00', '0.00', '8.00', '2019-09-12 04:00:33'),
(12, 12, '30.00', '0.00', '30.00', '2019-09-23 21:08:25'),
(13, 13, '0.00', '0.00', '0.00', '2022-05-14 14:26:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `id_unidad` int(11) NOT NULL,
  `abreviatura` varchar(10) NOT NULL,
  `nombre` varchar(240) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`id_unidad`, `abreviatura`, `nombre`, `flestado`, `feregistro`) VALUES
(1, 'Kg', 'Kilogramos', 0, '2019-08-25 06:11:53'),
(2, 'Mt', 'Metros', 0, '2019-08-25 06:11:58'),
(3, 'Und', 'Unidad', 0, '2019-08-25 06:33:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_personal` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `contrasena` char(32) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_personal`, `login`, `contrasena`, `id_perfil`, `flestado`, `feregistro`) VALUES
(1, 1, '72703796', '494da5d0740bdcf7c7ae020911336300', 1, 0, '2019-08-23 18:55:38'),
(2, 2, '11223344', 'd88d8b5f68df34118949998858f4d1d0', 2, 0, '2019-08-25 09:24:41'),
(3, 3, '99887766', '9ca3af320cab33677510b4a92e907a4b', 2, 0, '2019-09-10 22:04:54'),
(4, 4, '98765432', '434bdd43cf9f925435db116529c176f6', 3, 0, '2019-09-13 03:57:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cliente` int(11) NOT NULL,
  `id_mediopago` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `conversion` decimal(10,2) NOT NULL,
  `efectivo` decimal(10,2) NOT NULL,
  `vuelto` decimal(10,2) NOT NULL,
  `flestado` int(11) NOT NULL COMMENT '0: Pagado // 1: Pendiente // 2: Anulado',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `feregistro_anular` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_caja`, `fecha`, `id_cliente`, `id_mediopago`, `id_comprobante`, `id_usuario`, `subtotal`, `descuento`, `total`, `id_moneda`, `conversion`, `efectivo`, `vuelto`, `flestado`, `feregistro`, `feregistro_anular`) VALUES
(1, 1, '2022-05-14 15:11:06', 1, 1, 1, 2, '61.50', '0.00', '61.50', 1, '0.00', '65.00', '3.50', 0, '2022-05-14 15:11:06', NULL),
(2, 1, '2022-05-14 15:11:51', 1, 1, 1, 2, '75.00', '0.00', '75.00', 1, '0.00', '100.00', '25.00', 0, '2022-05-14 15:11:51', NULL),
(3, 1, '2022-05-14 15:12:18', 1, 1, 1, 2, '58.50', '5.00', '53.50', 1, '0.00', '60.00', '6.50', 0, '2022-05-14 15:12:18', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventadetalle`
--

CREATE TABLE `ventadetalle` (
  `id_ventadetalle` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `flestado` int(11) NOT NULL DEFAULT 0 COMMENT '0: Activo // 1: Inactivo',
  `feregistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventadetalle`
--

INSERT INTO `ventadetalle` (`id_ventadetalle`, `id_venta`, `item`, `id_producto`, `id_unidad`, `cantidad`, `precio`, `total`, `flestado`, `feregistro`) VALUES
(1, 1, 0, 4, 1, '3.00', '5.50', '16.50', 0, '2022-05-14 15:11:06'),
(2, 1, 1, 6, 1, '4.00', '10.00', '40.00', 0, '2022-05-14 15:11:06'),
(3, 1, 2, 7, 1, '1.00', '5.00', '5.00', 0, '2022-05-14 15:11:06'),
(4, 2, 0, 6, 1, '6.00', '10.00', '60.00', 0, '2022-05-14 15:11:51'),
(5, 2, 1, 11, 3, '2.00', '1.50', '3.00', 0, '2022-05-14 15:11:51'),
(6, 2, 2, 9, 3, '3.00', '4.00', '12.00', 0, '2022-05-14 15:11:51'),
(7, 3, 0, 5, 1, '2.00', '12.50', '25.00', 0, '2022-05-14 15:12:18'),
(8, 3, 1, 7, 1, '1.00', '5.00', '5.00', 0, '2022-05-14 15:12:18'),
(9, 3, 2, 8, 3, '1.00', '3.50', '3.50', 0, '2022-05-14 15:12:18'),
(10, 3, 3, 10, 3, '1.00', '25.00', '25.00', 0, '2022-05-14 15:12:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`id_acceso`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`) USING BTREE;

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `compradetalle`
--
ALTER TABLE `compradetalle`
  ADD PRIMARY KEY (`id_compradetalle`);

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`id_comprobante`);

--
-- Indices de la tabla `creditocliente`
--
ALTER TABLE `creditocliente`
  ADD PRIMARY KEY (`id_creditocliente`);

--
-- Indices de la tabla `creditoclientedetalle`
--
ALTER TABLE `creditoclientedetalle`
  ADD PRIMARY KEY (`id_creditoclientedetalle`);

--
-- Indices de la tabla `creditoproveedor`
--
ALTER TABLE `creditoproveedor`
  ADD PRIMARY KEY (`id_creditoproveedor`);

--
-- Indices de la tabla `creditoproveedordetalle`
--
ALTER TABLE `creditoproveedordetalle`
  ADD PRIMARY KEY (`id_creditoproveedordetalle`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id_kardex`);

--
-- Indices de la tabla `mediopago`
--
ALTER TABLE `mediopago`
  ADD PRIMARY KEY (`id_mediopago`);

--
-- Indices de la tabla `merma`
--
ALTER TABLE `merma`
  ADD PRIMARY KEY (`id_merma`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`id_moneda`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_personal`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`id_unidad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- Indices de la tabla `ventadetalle`
--
ALTER TABLE `ventadetalle`
  ADD PRIMARY KEY (`id_ventadetalle`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
  MODIFY `id_acceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compradetalle`
--
ALTER TABLE `compradetalle`
  MODIFY `id_compradetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `id_comprobante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `creditocliente`
--
ALTER TABLE `creditocliente`
  MODIFY `id_creditocliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `creditoclientedetalle`
--
ALTER TABLE `creditoclientedetalle`
  MODIFY `id_creditoclientedetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `creditoproveedor`
--
ALTER TABLE `creditoproveedor`
  MODIFY `id_creditoproveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `creditoproveedordetalle`
--
ALTER TABLE `creditoproveedordetalle`
  MODIFY `id_creditoproveedordetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `mediopago`
--
ALTER TABLE `mediopago`
  MODIFY `id_mediopago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `merma`
--
ALTER TABLE `merma`
  MODIFY `id_merma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id_unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventadetalle`
--
ALTER TABLE `ventadetalle`
  MODIFY `id_ventadetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
