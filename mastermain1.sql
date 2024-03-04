-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2024 a las 02:11:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mastermain`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `id` int(11) NOT NULL,
  `departamento` varchar(150) DEFAULT NULL,
  `codigo_colaborador` varchar(50) DEFAULT NULL,
  `nombre_colaborador` varchar(150) DEFAULT NULL,
  `comision` decimal(11,2) DEFAULT NULL,
  `bonificacion` decimal(11,2) DEFAULT NULL,
  `honorarios` decimal(11,2) DEFAULT NULL,
  `vale` decimal(11,2) DEFAULT NULL,
  `stat` int(1) DEFAULT NULL,
  `fecha_log` timestamp NULL DEFAULT current_timestamp(),
  `id_user_register` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comisiones`
--

INSERT INTO `comisiones` (`id`, `departamento`, `codigo_colaborador`, `nombre_colaborador`, `comision`, `bonificacion`, `honorarios`, `vale`, `stat`, `fecha_log`, `id_user_register`) VALUES
(5, 'RETAIL', '002471', 'ACOSTA, KIARA', 0.01, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(6, 'RETAIL', '001997', 'AMAYA S., SAUL ELIAS', 12.00, 17.00, NULL, 20.00, 1, '2024-03-03 22:49:38', 1),
(7, 'RETAIL', '001212', 'BARTLEY E., SIRIA I.', 5.00, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(8, 'RETAIL', '002366', NULL, NULL, NULL, 50.00, NULL, 1, '2024-03-03 22:49:38', 1),
(9, 'RETAIL', '002432', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(10, 'RETAIL', '001888', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(11, 'RETAIL', '001006', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(12, 'RETAIL', '002472', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(13, 'RETAIL', '002420', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(14, 'RETAIL', '001350', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(15, 'RETAIL', '001021', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(16, 'RETAIL', '002405', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(17, 'RETAIL', '002312', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(18, 'RETAIL', '002017', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(19, 'RETAIL', '001647', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(20, 'RETAIL', '002449', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(21, 'RETAIL', '002137', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(22, 'RETAIL', '001122', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(23, 'RETAIL', '002393', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(24, 'RETAIL', '001519', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(25, 'RETAIL', '002270', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(26, 'RETAIL', '002242', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(27, 'RETAIL', '002448', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(28, 'RETAIL', '002032', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(29, 'RETAIL', '002197', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(30, 'RETAIL', '002508', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(31, 'RETAIL', '002513', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(32, 'RETAIL', '002504', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(33, 'RETAIL', '002509', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(34, 'RETAIL', '002515', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1),
(35, 'RETAIL', '002398', NULL, NULL, NULL, NULL, NULL, 1, '2024-03-03 22:49:38', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones_colaboradores`
--

CREATE TABLE `comisiones_colaboradores` (
  `id` int(11) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `stat` int(1) NOT NULL,
  `fecha_log` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comisiones_colaboradores`
--

INSERT INTO `comisiones_colaboradores` (`id`, `codigo`, `nombre_completo`, `genero`, `departamento`, `stat`, `fecha_log`) VALUES
(2, '001744', 'GISELA, CHAMORRO', 'F', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(3, '002418', 'OMAYRA, CRUZ', 'F', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(4, '002450', 'YISARA ELIZABETH, CACERES', 'F', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(5, '002481', 'JOSELIN TARINA, URRIOLA HERRERA', 'F', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(6, 'HP001', 'CLAUDIA COULSON', 'M', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(7, '001207', 'YAMILETH ESTELA, RODRIGUEZ', 'F', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(8, '002321', 'OMAR, CARRILLO ORO', 'M', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(9, '001082', 'JORGE JUAN, DE LA GUARDIA', 'M', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(10, '001232', 'GABRIEL, JURADO', 'M', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(11, '001368', 'MANUEL, CABRERA', 'M', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(12, '002124', 'FABIO, TROTMAN', 'M', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(13, '001093', 'JORGE JAVIER, SOTO NAVARRO', 'M', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(14, '001544', 'NELSON, ABREGO', 'M', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(15, '001007', 'SHARON, BARNABAS', 'F', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(16, '001023', 'MARILIN SANTOS', 'F', 'ADMINISTRACION', 1, '2024-03-03 20:43:04'),
(17, '001590', 'RODOLFO G., VERNAZA T.', 'M', 'COBROS', 1, '2024-03-03 20:43:04'),
(18, '002455', 'EDWIN, SANCHEZ', 'M', 'COBROS', 1, '2024-03-03 20:43:04'),
(19, '002015', 'IVETTE CONCEPCION, ROMERO AGUILAR', 'F', 'COBROS', 1, '2024-03-03 20:43:04'),
(20, '001498', 'DUNIA OFELIA, CEDEÑO CRUZ', 'F', 'COBROS', 1, '2024-03-03 20:43:04'),
(21, '001794', 'MARILUZ MILENA, RIVERA PINEDA', 'F', 'COBROS', 1, '2024-03-03 20:43:04'),
(22, '002037', 'MELISSA, SOLIS CORDOBA', 'F', 'COBROS', 1, '2024-03-03 20:43:04'),
(23, '002047', 'MARIA EUGENIA, BARRIOS', 'F', 'COBROS', 1, '2024-03-03 20:43:04'),
(24, '001336', 'GRACIELA, MORA', 'F', 'COBROS', 1, '2024-03-03 20:43:04'),
(25, '002467', 'ITALO DE JESUS, CANDANEDO', 'M', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(26, '002408', 'MARIA CLARA, BARES ARAUZ', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(27, '002438', 'AIDA LISETH, JAEN RODRIGUEZ', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(28, '001109', 'MOYRA, CARRERA', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(29, '001289', 'PATRICIA, FADUL', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(30, '001345', 'MERLY, DE CASANOVA', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(31, '002500', 'SANDRA GABRIELA, FLORES LOPEZ', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(32, '002505', 'ANDREA VICTORIA', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(33, '0005', 'JONATHAN DELGADO', 'M', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(34, '002099', 'DASHKA, VAZ', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(35, '002193', 'ARELIS, MAURE', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(36, '003', 'ESTRELLA CARRILLO', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(37, '002470', 'DARLENE SARAY, BERNAL PITTY', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(38, '002276', 'ANA, MOCK', 'M', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(39, '001142', 'MICHELLE, DE LA GUARDIA', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(40, '001921', 'YASBETHE I., CROCAMO C.', 'F', 'COMPRAS', 1, '2024-03-03 20:43:04'),
(41, '001849', 'DWIGHT DEER, GARCIAS PINEDA', 'M', 'COMPRAS', 1, '2024-03-03 20:43:04'),
(42, '002001', 'IRVING, TREJOS CACERES', 'M', 'COMPRAS', 1, '2024-03-03 20:43:04'),
(43, '002138', 'VANESSA, HERNANDEZ', 'F', 'COMPRAS', 1, '2024-03-03 20:43:04'),
(44, '001046', 'LOURDES, MARTINEZ', 'F', 'COMPRAS', 1, '2024-03-03 20:43:04'),
(45, '002192', 'DANIEL, ARAUJO', 'M', 'COMPRAS', 1, '2024-03-03 20:43:04'),
(46, '0004', 'GIOVANNI COULUCCI', 'F', 'COMERCIAL', 1, '2024-03-03 20:43:04'),
(47, '002323', 'CARLOS, RAMOS', 'M', 'MINA', 1, '2024-03-03 20:43:04'),
(48, '001926', 'JONATHAN, PINZON V.', 'M', 'MINA', 1, '2024-03-03 20:43:04'),
(49, '001534', 'ELOY, ZARATE', 'M', 'MINA', 1, '2024-03-03 20:43:04'),
(50, '001877', 'HECTOR A., GIL', 'M', 'MINA', 1, '2024-03-03 20:43:04'),
(51, '002326', 'ELIAS, CEDEÑO', 'M', 'MINA', 1, '2024-03-03 20:43:04'),
(52, '002399', 'DALBERG ORLANDO, RUIZ HIDALGO', 'M', 'MINA', 1, '2024-03-03 20:43:04'),
(53, '002249', 'ANDREA, CHANIS', 'F', 'MINA', 1, '2024-03-03 20:43:04'),
(54, '002466', 'ANTHONY, ALMANZA RODRIGUEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(55, '002510', 'JONATHAN SIMITI', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(56, '002506', 'LISNA PETERSON', 'F', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(57, '002501', 'MARGARET CRISTAL, RINGROSE', 'F', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(58, '002436', 'KIMBERLY, GONZALEZ', 'F', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(59, '001022', 'FRANCISCO, ORTEGA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(60, '001217', 'FIDELINO, TORRES', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(61, '001225', 'JORGE  ALBERTO, SANCHEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(62, '001280', 'JOBA, DUARTE', 'F', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(63, '001322', 'LUIS, PIMENTEL', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(64, '001769', 'VIDAL, MORAN', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(65, '002036', 'ALAIN, BREMNER GARRIDO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(66, '002118', 'ROLANDO, RAMOS', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(67, '002134', 'HENRY, WARREN', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(68, '002165', 'JUSTIN, NUÑEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(69, '002194', 'LEONARDO, NAVARRO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(70, '002253', 'ILDEFONSO, BRACHO FLORES', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(71, '002279', 'DIEGO, MARIN', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(72, '002288', 'EDWIN, VERGARA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(73, '002358', 'JAVIER, CUBILLA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(74, '002372', 'JOSE EMANUEL, TUNON MENESES', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(75, '002402', 'VICTOR ENRIQUE, GOMEZ SANCHEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(76, '002412', 'JOEL, DIAZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(77, '002421', 'LISANDRO, TROYA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(78, '002423', 'JOSE ANTONIO, MORENO GONZALEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(79, '002425', 'WILLIAM JAIR, DIXON MORALES', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(80, '002428', 'APOLONIO, ARIAS', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(81, '002429', 'MARLON LEONEL, PALMA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(82, '002440', 'CRISTHIAN, MARIN', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(83, '002442', 'HARTBREING, DELGADO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(84, '002447', 'ROLANDO  ALBERTO, LLERENA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(85, '002451', 'ANDY, ACOSTA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(86, '002454', 'HUGO, CARRERA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(87, '002460', 'JULIO, TORRES NAVARRO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(88, '002461', 'SANTOS ABDIEL, SANCHEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(89, '002478', 'CRISTOBAL MANUEL, RUIZ CARRION', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(90, '002479', 'EDDY ALEXANDER, BERRIO MUESES', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(91, '002487', 'CESAR PAULINO, SALAZAR GUEVARA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(92, '002488', 'HABINSON, MURILLO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(93, '002520', 'RAFAEL PEREZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(94, '002519', 'JONATHAN MARTINEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(95, '002518', 'NELVIN VERGARA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(96, '002516', 'SAUL ORTEGA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(97, '002529', 'ELIECER JAVIER RODRIGUEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(98, '002105', 'FRANCISCO, QUINTERO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(99, '001946', 'JOEL ALBERTO, GUTIERREZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(100, '001950', 'MARIO ALEXANDER, SANCHEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(101, '002132', 'JUAN CARLOS, MELGAREJO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(102, '002163', 'LUIS, PEREA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(103, '002254', 'HENRY ABDUL, OTERO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(104, '002258', 'ANTHONY EMIR, MORENO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(105, '002006', 'LUIS ALBERTO, PINILLA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(106, '002074', 'LUIS, REYES', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(107, '002275', 'ANDREA CAROLINA, SUAREZ REVEROL', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(108, '002385', 'LESLIE MARIBEL, CEDENO GONZALEZ', 'F', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(109, '002388', 'RAUL EDGARDO, FLORES FLOREZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(110, '002463', 'KEVIN, BATISTA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(111, '001886', 'LIONICIO, VASQUEZ C.', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(112, '002060', 'PAULINO, HENRIQUEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(113, '002457', 'HERMINDA  JANETH, SANCHEZ', 'F', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(114, '002416', 'RIGOBERTO, LOPEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(115, '001814', 'ALVARO, MENDOZA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(116, '001841', 'VIOLA C., CLAIR RAMOS', 'F', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(117, '002089', 'JAIME, CEDEÑO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(118, '002317', 'JORGE CRISTOBAL, LEREN', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(119, '001790', 'RUBEN DARIO, SAGEL DOMINGUEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(120, '002146', 'ERNESTO, HURTADO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(121, '002246', 'OCTAVIO, QUIJADA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(122, '002322', 'LUIS ALBERTO, MARTINEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(123, '002331', 'GIL ROLANDO, SHAIKN CASTILLO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(124, '002158', 'TERESIN, CASTILLO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(125, '002252', 'JHONNY MARTIN, VARGAS CERRUD', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(126, '002294', 'ALEXIS, GONZALEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(127, '002348', 'ALEXANDER, BATISTA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(128, '002349', 'WILLIAMS, ORTEGA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(129, '002350', 'JESUS, AVILA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(130, '002384', 'MILCIADES, MARTINEZ GONZALEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(131, '002397', 'ANTONIO ARIEL, VALENCIA SALDANA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(132, '002413', 'ALEXANDER ORIEL, PEREZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(133, '002435', 'ERICK ALBERTO, ARCIA PINEDA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(134, '002458', 'MANUEL, RIVERA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(135, '002502', 'FRANKIE EDILBERTO, RODRIGUEZ GIL', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(136, '002503', 'ALBERTO ENRIQUE, RIVERA PINEDA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(137, '002259', 'JASSON JOEL, ROJAS', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(138, '001168', 'MARIO AUGUSTO, LAWRENCE', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(139, '001502', 'BENJAMIN, ORTIZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(140, '001724', 'JAVIER, MIRANDA AVILES', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(141, '001881', 'ALEX, AGRAZAL', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(142, '001901', 'ABDIEL A., ARAUZ B.', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(143, '001947', 'CARLOS VICENTE, HOOKER MURGAS', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(144, '001969', 'ALGIS ARIEL, DE LA CRUZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(145, '002291', 'YUVERT, HURTADO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(146, '002311', 'DAVID ENRIQUE, JORDAN', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(147, '002190', 'JUAN, ZAPATA', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(148, '001164', 'ARISTIDES ENRIQUE, PEREZ ALVEO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(149, '002109', 'LUIS, GONZALEZ', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(150, '002494', 'JOHN  FREDY, CRUZ BRICEÑO', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(151, '002260', 'JHOZIEL ROLANDO, GIL', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(152, 'HP002', 'CESAR DURUFOUR', 'M', 'OPERACIONES', 1, '2024-03-03 20:43:04'),
(153, '001006', 'DIANA, GARCIA DE CONCEPC', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(154, '001122', 'VICTOR, TORRES CORREA', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(155, '001212', 'SIRIA I., BARTLEY E.', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(156, '001350', 'ROSARIO, HIDALGO', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(157, '001647', 'OSCAR, MORALES', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(158, '001997', 'SAUL ELIAS, AMAYA S.', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(159, '002011', 'LUISANA MILAGRO, PEREZ ARAUJO', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(160, '002017', 'KATHIUSKA DASMEL, MELENDEZ MEJIA', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(161, '002032', 'LOURDES, WATSON', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(162, '002137', 'DARIO, SALAZAR', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(163, '002242', 'ERIKA ISOLDA, VASQUEZ', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(164, '002312', 'CINDY PAOLA, LUNA', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(165, '002366', 'DANELLYS, BETHANCOURT', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(166, '002398', 'SINDY MAOLI, CERRUD ATENCIO', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(167, '002420', 'LIZETH  MILENA, GONZALEZ', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(168, '002432', 'BIBIANA LIZBETH, DIAZ', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(169, '002448', 'ASHTON, WAITHE RIOS', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(170, '002449', 'ANA JUDITH, MOSQUERA ORTEGA', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(171, '002471', 'KIARA LINOSCA, ACOSTA DE LA LAST', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(172, '002472', 'GILBERTO JOSEPH, GONZALEZ', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(173, '002504', 'MARIELYS, RIVERA', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(174, '002508', 'EYLEEN CASTRO', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(175, '002509', 'WILMER VALDES', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(176, '002513', 'MILTON RIVERA', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(177, '002393', 'KYRA NAYITZA, TRISTAN CASIS', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(178, '002405', 'LEYLA MARIBEL, JORDAN RODRIGUEZ', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(179, '002515', 'ARAMIS AVERZA', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(180, '002270', 'LUIS VALVERDE', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(181, '002197', 'TATIANA, ZAPATA', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(182, '001519', 'GUSTAVO LEONEL, URRUTIA', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(183, '001888', 'EDWING, EDWARDS', 'M', 'RETAIL', 1, '2024-03-03 20:43:04'),
(184, '001021', 'MARTA, JIMENEZ', 'F', 'RETAIL', 1, '2024-03-03 20:43:04'),
(185, '001404', 'YISSELL, PEREZ', 'F', 'RRHH', 1, '2024-03-03 20:43:04'),
(186, '002410', 'YARIBETH, ORTIZ', 'F', 'RRHH', 1, '2024-03-03 20:43:04'),
(187, '001558', 'AGBIRIENY, PINEDA', 'F', 'RRHH', 1, '2024-03-03 20:43:04'),
(188, '001688', 'SOFIA, MACIAS', 'F', 'RRHH', 1, '2024-03-03 20:43:04'),
(189, '002411', 'YORLENIS, GUZMAN', 'F', 'TECNOLOGIA', 1, '2024-03-03 20:43:04'),
(190, '002468', 'CESAR ANTONIO, ASPRILLA GONZALEZ', 'M', 'TECNOLOGIA', 1, '2024-03-03 20:43:04'),
(191, '002475', 'PEDRO DAVID, ARRIETA', 'M', 'TECNOLOGIA', 1, '2024-03-03 20:43:04'),
(192, '002129', 'ISIDRO, MARTINEZ', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(193, '002490', 'ESPERANZA, BRAVO MOJICA', 'F', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(194, '002507', 'GENESIS CASTILLO', 'F', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(195, '002218', 'PAOLA, ERAZO', 'F', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(196, '001694', 'CHRISTIAN, RUIZ', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(197, '002268', 'ARIEL ANTONIO, ACEVEDO', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(198, '002473', 'DARIO ENRIQUE, JIMENEZ LOZADA', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(199, '002482', 'JONATHAN, QUINTERO', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(200, '002483', 'JUAN, ESTRADA MUIR', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(201, '002200', 'CARLOS CHAMORRO', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(202, '002081', 'ANGEL PINEDA', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(203, '002188', 'CARLOS CALVO', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(204, '002525', 'JETZHABEL VELASQUEZ', 'F', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(205, '002526', 'YERICK ALBERTO TROYA', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(206, '002236', 'KATIBEL JULISSA, SAA', 'F', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(207, '002485', 'DENIA VICTORIA, MOSCOSO CASTILLO', 'F', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(208, '002521', 'MARTINA SANCHEZ', 'F', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(209, '002462', 'WENDY GISSELL, PALOMO RATTRY DE', 'F', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(210, '1326', 'RICARDO, DE LA GUARDIA', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(211, '002409', 'JAKELINE, CARVAJAL', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(212, '002404', 'CHRISTIAN JAVIER, MORAN SUAREZ', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(213, '002369', 'DIANA MICHEL, RICO HERNANDEZ', 'M', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(214, '002486', 'JOEL ALBERTO, DE LEON GALVEZ', 'F', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04'),
(215, '002465', 'ITZEL DEL CARMEN, RODRIGUEZ BARRIOS', 'F', 'VENTAS DE AUTOS', 1, '2024-03-03 20:43:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jos`
--

CREATE TABLE `jos` (
  `id` int(11) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `stat` int(1) NOT NULL,
  `date_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `titulo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jos`
--

INSERT INTO `jos` (`id`, `departamento`, `descripcion`, `stat`, `date_log`, `titulo`) VALUES
(1, 'RRHH', 'Subir coimisiones', 1, '2024-03-03 18:30:31', 'Comisiones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `stat` int(11) NOT NULL,
  `fecha_log` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `pass`, `tipo_usuario`, `stat`, `fecha_log`) VALUES
(1, 'casco', 'casco@casco.com', '$2y$10$bJYGg5SVPojt2w9I9xhRqO1.bVfvfrQf5kWHi8z.FzJqIefGkdBZ6', 'admin', 0, '2024-01-11 20:14:57'),
(3, 'tayronbus', 'pedro.arrieta@grupopcr.com.pa', '$2y$10$a6NxUBPxRWK43YvdXYZws.aag7B4TMJg0T1u0hDlAfEQjfxp33/3m', 'admin', 0, '2024-01-11 21:05:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comisiones_colaboradores`
--
ALTER TABLE `comisiones_colaboradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jos`
--
ALTER TABLE `jos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `comisiones_colaboradores`
--
ALTER TABLE `comisiones_colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT de la tabla `jos`
--
ALTER TABLE `jos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
