-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2024 a las 22:51:15
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `videoclub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `idalquiler` int(100) NOT NULL,
  `dni_cliente` varchar(8) NOT NULL,
  `id_pelicula` int(20) NOT NULL,
  `id_copia` int(2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bono`
--

CREATE TABLE `bono` (
  `id_bono` bigint(20) NOT NULL,
  `credito` int(2) NOT NULL,
  `credito_disponible` int(2) NOT NULL,
  `periodo` int(2) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `dni_cliente` varchar(8) NOT NULL,
  `dni_personal` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dni` varchar(8) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copias`
--

CREATE TABLE `copias` (
  `id_pelicula` int(20) NOT NULL,
  `id_copia` int(2) NOT NULL,
  `disponibilidad` int(1) NOT NULL,
  `cuit_proveedor` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id_pedido` int(15) NOT NULL,
  `id_detalle` int(15) NOT NULL,
  `nro_ejemplares` int(2) NOT NULL,
  `id_pelicula` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `iddevolucion` int(100) NOT NULL,
  `dni_cliente` varchar(8) NOT NULL,
  `id_pelicula` int(20) NOT NULL,
  `id_copia` int(2) NOT NULL,
  `fecha_devolucion_max` date NOT NULL,
  `estado` varchar(1) NOT NULL,
  `sancion` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(20) NOT NULL,
  `monton` int(4) NOT NULL,
  `estado` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `cuit_proveedor` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(20) NOT NULL,
  `monton` decimal(4,0) NOT NULL,
  `dni_personal` varchar(8) DEFAULT NULL,
  `id_factura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(15) NOT NULL,
  `dni_personal` varchar(8) DEFAULT NULL,
  `cuit_proveedor` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_pelicula` int(20) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `year` varchar(4) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `cant_copias` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `dni` varchar(8) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `cargo` varchar(15) NOT NULL,
  `contrasena` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `cuit` varchar(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `telefono` bigint(10) NOT NULL,
  `direccion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`idalquiler`),
  ADD KEY `dni_cliente` (`dni_cliente`),
  ADD KEY `alquileres_ibfk_2` (`id_pelicula`,`id_copia`);

--
-- Indices de la tabla `bono`
--
ALTER TABLE `bono`
  ADD PRIMARY KEY (`id_bono`),
  ADD KEY `bono_ibfk_1` (`dni_cliente`),
  ADD KEY `bono_ibfk_2` (`dni_personal`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `copias`
--
ALTER TABLE `copias`
  ADD PRIMARY KEY (`id_pelicula`,`id_copia`),
  ADD KEY `copias_ibfk_1` (`cuit_proveedor`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id_pedido`,`id_detalle`),
  ADD KEY `id_pelicula` (`id_pelicula`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`iddevolucion`),
  ADD KEY `devoluciones_ibfk_2` (`dni_cliente`),
  ADD KEY `devoluciones_ibfk_3` (`id_pelicula`,`id_copia`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `facturas_ibfk_2` (`cuit_proveedor`),
  ADD KEY `facturas_ibfk_1` (`id_pedido`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `pagos_ibfk_2` (`id_factura`),
  ADD KEY `pagos_ibfk_1` (`dni_personal`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `pedidos_ibfk_2` (`cuit_proveedor`),
  ADD KEY `pedidos_ibfk_1` (`dni_personal`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_pelicula`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`cuit`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `idalquiler` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bono`
--
ALTER TABLE `bono`
  MODIFY `id_bono` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `iddevolucion` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(20) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `alquileres_ibfk_2` FOREIGN KEY (`id_pelicula`,`id_copia`) REFERENCES `copias` (`id_pelicula`, `id_copia`) ON DELETE CASCADE,
  ADD CONSTRAINT `alquileres_ibfk_3` FOREIGN KEY (`dni_cliente`) REFERENCES `clientes` (`dni`) ON DELETE CASCADE;

--
-- Filtros para la tabla `bono`
--
ALTER TABLE `bono`
  ADD CONSTRAINT `bono_ibfk_1` FOREIGN KEY (`dni_cliente`) REFERENCES `clientes` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `bono_ibfk_2` FOREIGN KEY (`dni_personal`) REFERENCES `personal` (`dni`) ON DELETE SET NULL;

--
-- Filtros para la tabla `copias`
--
ALTER TABLE `copias`
  ADD CONSTRAINT `copias_ibfk_1` FOREIGN KEY (`cuit_proveedor`) REFERENCES `proveedores` (`cuit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `copias_ibfk_2` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`);

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `devoluciones_ibfk_2` FOREIGN KEY (`dni_cliente`) REFERENCES `clientes` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `devoluciones_ibfk_3` FOREIGN KEY (`id_pelicula`,`id_copia`) REFERENCES `copias` (`id_pelicula`, `id_copia`) ON DELETE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`cuit_proveedor`) REFERENCES `proveedores` (`cuit`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`dni_personal`) REFERENCES `personal` (`dni`) ON DELETE SET NULL,
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`dni_personal`) REFERENCES `personal` (`dni`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`cuit_proveedor`) REFERENCES `proveedores` (`cuit`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
