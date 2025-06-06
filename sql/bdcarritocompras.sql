-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-10-2018 a las 23:12:45
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcarritocompras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL,
  `cofecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idusuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idcompra`,`cofecha`, `idusuario`) 
VALUES 
(1,'2024-02-09 10:00:00', 4),
(2,'2024-02-10 11:00:00', 5),
(3,'2024-02-11 12:00:00', 6),
(4,'2024-02-15 12:00:00', 6),
(5,'2024-02-16 12:00:00', 7),
(6,'2024-02-17 12:00:00', 7),
(7,'2024-02-18 12:00:00', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestado`
--

CREATE TABLE `compraestado` (
  `idcompraestado` bigint(20) NOT NULL,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cefechafin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestado`
--

INSERT INTO `compraestado` (`idcompraestado`,`idcompra`, `idcompraestadotipo`, `cefechaini`,`cefechafin`)
VALUES 
-- Compra 1
(1,1, 1, '2024-02-09 10:00:00','2024-02-09 11:00:00'), -- Estado inicial: carrito
(2,1, 2, '2024-02-09 11:00:00','2024-02-09 12:00:00'), -- Estado siguiente: iniciada
(3,1, 3, '2024-02-09 12:00:00','2024-02-09 13:00:00'), -- Estado siguiente: aceptada
(4,1, 4, '2024-02-09 13:00:00','2024-02-09 14:00:00'), -- Estado siguiente: enviada
-- Compra 2
(5,2, 1, '2024-02-10 11:00:00','2024-02-10 12:00:00'), -- Estado inicial: carrito
(6,2, 2, '2024-02-10 12:00:00','2024-02-10 13:00:00'), -- Estado siguiente: iniciada
(7,2, 5, '2024-02-10 13:00:00','2024-02-10 14:00:00'), -- Estado siguiente: cancelada
-- Compra 3
(8,3, 1, '2024-02-11 12:00:00','2024-02-15 12:00:00'), -- Estado inicial: carrito
(9,3, 2, '2024-02-15 12:00:00',null), -- Estado siguiente: iniciada
-- Compra 4
(10,4, 1, '2024-02-15 13:00:00',null), -- Estado inicial: carrito
-- Compra 5
(11,5, 1, '2024-02-16 10:00:00','2024-02-16 11:00:00'), -- Estado inicial: carrito
(12,5, 2, '2024-02-16 11:00:00','2024-02-16 12:00:00'), -- Estado siguiente: iniciada
(13,5, 3, '2024-02-16 12:00:00','2024-02-16 13:00:00'), -- Estado siguiente: aceptada
(14,5, 5, '2024-02-16 13:00:00','2024-02-16 14:00:00'), -- Estado siguiente: cancelada
-- Compra 6
(15,6, 1, '2024-02-17 11:00:00','2024-02-17 12:00:00'), -- Estado inicial: carrito
(16,6, 2, '2024-02-17 12:00:00','2024-02-17 13:00:00'), -- Estado siguiente: iniciada
(17,6, 5, '2024-02-17 13:00:00','2024-02-17 14:00:00'), -- Estado siguiente: cancelada
-- Compra 7
(18,7, 1, '2024-02-18 10:00:00','2024-02-18 11:00:00'), -- Estado inicial: carrito
(19,7, 2, '2024-02-18 11:00:00','2024-02-18 12:00:00'), -- Estado siguiente: iniciada
(20,7, 3, '2024-02-18 12:00:00','2024-02-18 13:00:00'), -- Estado siguiente: aceptada
(21,7, 4, '2024-02-18 13:00:00','2024-02-18 14:00:00'); -- Estado siguiente: enviada
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestadotipo`
--

CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'carrito','cuando el usuario: cliente agrego productos al carrito'),
(2, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(3, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 2 '),
(4, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =3 '),
(5, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraitem`
--

CREATE TABLE `compraitem` (
  `idcompraitem` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestado`
--

INSERT INTO `compraitem` (`idcompraitem`,`idproducto`, `idcompra`, `cicantidad`)
VALUES 
(1,1, 1, 2), -- Dos productos en la compra 1
(2,3, 1, 1), -- Un producto en la compra 1
(3,2, 2, 3), -- Tres productos en la compra 2
(4,5, 3, 1), -- Un producto en la compra 3
(5,6, 3, 2), -- Dos productos en la compra 3
(6,15, 4, 1), -- Un producto en la compra 4
(7,20, 4, 2), -- Dos productos en la compra 4
(8,6, 5, 1), -- Un producto en la compra 5
(9,19, 5, 1), -- Un producto en la compra 5
(10,11, 6, 2), -- Dos productos en la compra 6
(11,7, 6, 1), -- Un producto en la compra 6
(12,12, 7, 2), -- Dos productos en la compra 7
(13,20, 7, 1); -- Un producto en la compra 7
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `idmenu` bigint(20) NOT NULL,
  `menombre` varchar(50) NOT NULL COMMENT 'Nombre del item del menu',
  `medescripcion` varchar(124) NOT NULL COMMENT 'Descripcion mas detallada del item del menu',
  `idpadre` bigint(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem',
  `medeshabilitado` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
(1, 'Admin', 'menu padre del usuario administrador', NULL, NULL),
(2, 'Deposito', 'menu padre del usuario deposito', NULL, NULL),
(3, 'Cliente', 'menu padre del usuario cliente', NULL, NULL),
(4, 'Usuario', 'menu selector del usuario administrador', 1, NULL), -- usuario Administrador selector
(5, 'Crear Usuario', 'admin/createUser.php', 4, NULL), -- usuario Administrador
(6, 'Mostrar Usuarios', 'admin/dashboard.php', 4, NULL), -- usuario Administrador
(7, 'Roles', 'admin/roleList.php', 1,NULL), -- usuario Administrador
(8, 'Administrar Menu', 'admin/manageMenu.php', 1,NULL), -- usuario Administrador
(9, 'Compras', 'admin/manageShopping.php', 1,NULL), -- usuario Administrador
(10, 'Listar Productos', 'deposit/dashboard.php', 2,NULL), -- usuario Deposito
(11, 'Crear Producto', 'deposit/newProduct.php', 2,NULL), -- usuario Deposito
(12, 'Productos', 'menu selector del usuario cliente', 3, NULL), -- usuario Cliente selector
(13, 'Accesorios', 'customer/similarProducts.php?type=accessories', 12,NULL), -- usuario Cliente
(14, 'Juguetes', 'customer/similarProducts.php?type=toys',12,NULL), -- usuario Cliente
(15, 'Alimentos', 'customer/similarProducts.php?type=food',12,NULL), -- usuario Cliente
(16, 'Productos Favoritos', 'customer/similarProducts.php?type=favorite', 3,NULL), -- usuario Cliente
(17, 'Productos Nuevos', 'customer/similarProducts.php?type=new', 3,NULL), -- usuario Cliente
(18, 'Mis Compras', 'customer/shoppingSummary.php', 3,NULL), -- usuario Cliente
(19, 'Carrito', '#', 3,NULL); -- usuario Cliente

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menurol`
--

CREATE TABLE `menurol` (
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menurol`
--
INSERT INTO `menurol` (`idmenu`, `idrol`) VALUES
(1, 1),
(2, 2),
(3, 3);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL,
  `pronombre` varchar(50) NOT NULL,
  `proprecio` int(20) NOT NULL,
  `protipo` varchar(50) NOT NULL,
  `prodescripcion` varchar(100) NOT NULL,
  `promasinfo`   varchar(500) NULL,
  `proimagen` varchar(50) NOT NULL,
  `procantstock` int(11) NOT NULL,
  `esprodestacado` boolean NOT NULL DEFAULT false,
  `espronuevo` boolean NOT NULL DEFAULT false

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `pronombre`,`proprecio`,`protipo`,`prodescripcion`,`promasinfo`,`proimagen`, `procantstock`,`esprodestacado`,`espronuevo`) VALUES
(1, 'Comedero bebedero',3610,'accessories','Comedero Acero Inoxidable Antideslizante',
 'Es un bebedero de acero inoxidable, de gran resistencia. Presenta un molde de goma que evita deslizamientos mientras se usa',
  'comedero-bebedero.jpg',6,false,false),
(2, 'Comedero doble',15000,'accessories','Comedero acero inoxidable doble',
  'Incluye 2 tazones de acero inoxidable 750 ml. con soporte de metal negro. El protector antideslizante garantiza que la taza no se moverá ni se volcará fácilmente durante el uso',
  'comedero-doble.jpg',10,true,false),
(3, 'Comedero doble regulable',40000,'accessories','Comedero doble con pie regulable de acero inoxidable',
  'Medida: 59 x 33 x 55. Medida de cada plato: 21 Cm Diámetro. Material: Acero inoxidable de primera calidad',
  'comedero-doble-regulable.jpg',5,true,false),
(4, 'Comedero plegable de silicona',3450,'accessories','Práctico comedero/bebedero para llevar en tus paseos o viajes con tu mascota',
    'De silicona. Antideslizante, plegable y portátil. Incluye mosquetón para enganchar en cualquier lado',
    'comedero-plegable-de-silicona.jpg',2,false,true),
(5, 'Funda de auto palta',60000,'accessories','Funda para los asientos de los autos y tambien para el baul',
    'Impermeable. Antidesgarro. No se pegan los pelos. Faciles de limpiar. Medidas: 1,30mts x 1,50 mts',
    'funda-auto-palta.jpg',5,true,false),
(6, 'Funda de auto Paris',60000,'accessories','Funda para los asientos de los autos y tambien para el baul',
    'Impermeable. Antidesgarro. No se pegan los pelos. Faciles de limpiar. Medidas: 1,30mts x 1,50 mts',
    'funda-auto-paris.jpg',1,false,true),
(7, 'Arnes Fucsia',23000,'accessories','Arnés regulable en pecho y cuello',
    'Impermeable. Manija de sujeción con hebilla de acero inoxidable para colocar correa. Banda Reflectiva para la noche',
    'arnes-fucsia.jpg',0,false,false),
(8, 'Arnes Superman',8500,'accessories','Proporcionan comodidad y confort a tu perro',
    'Facil de colocar y retirar. Contienen una cinta regulable en el pecho que se ajusta con un broche reforzado',
    'arnes-superman.jpg',5,false,false),
(9, 'Action baseball con manija de soga',8700,'toys','Soga Action con pelota dental',
    'Ideal para cuidar su salud bucal mientras juega',
    'baseball-soga.jpg',2,false,false),
(10, 'Campana dispenser de snacks',10000,'toys','Juego de ingenio contenedor de alimento',
     'Sin información extra',
     'campana-dispenser-snack.jpg',10,true,false),
(11, 'Dona',5300,'toys','Dona con chifle',
     'No son tóxicos. Son lavables y durables. Ideales para perros chicos o poco mordedores',
     'dona-chifle.jpg',0,false,true),
(12, 'Mordillo',8600,'toys','Hueso Mordillo Ice',
     'Hecho de goma TPR no tóxica. Juguete refrescante, resistente, seguro y extremadamente duradero. Ideal para cachorros de dentición',
     'hueso-mordillo-ice.jpg',5,true,false),
(13, 'Pelota Squiki',7500,'toys','Pelota squiki para snacks',
     'Diseñada para la diversión y la salud dental de tu perro. Son 100% resistentes y sus dientitos de goma ayudan a cuidar la salud bucal de tus mascotas mientras juegan. Es ideal para rellenarla con alimentos y estimular el ingenio de tu mascota brindándole máxima diversión y entretenimiento',
     'pelota-squiki-snacks.jpg',12,false,true),
(14, 'Soga 2 nudos',2500,'toys','Soga de tela con 2 nudos',
     'Se diseñó para que tu mascota libere su stress mientras juega. También se usan para que el perro los pueda morder y realizar tareas de entrenamiento con él',
     'soga-2-nudos.jpg' ,8,false,false),
(15, 'Agility perro adulto 20 kilos',37500,'food','Alimento balanceado para perros adultos de 1 a 7 años',
     'Los perros adultos necesitan una alimentación completa y equilibrada que cubra sus requerimientos nutricionales y les brinde salud y vitalidad. Agility Adultos es una fórmula exclusivamente diseñada con ingredientes de alta calidad',
     'agility-adulto.jpg',0,false,false),
(16, 'Balanced adulto razas medianas',11500,'food','Indicado para perros adultos de raza mediana de 12 meses hasta 7 años',
     'Modulación de defensas. Músculos fuertes. Control de sarro y la halitosis. Cuidado óseo',
     'balanced-adulto.jpg',10,true,false),
(17, 'ROYAL CANIN MINI ADULTO',21600,'food','Alimento para perros adultos de talla pequeña (peso adulto hasta 10 kg)',
     'De 10 meses a 8 años de edad. Ayuda a mantener un peso saludable en perros de talla pequeña. Esta fórmula contiene nutrientes que ayuda a mantener una piel y un pelaje saludable',
     'royal-mini-adulto.jpg',1,true,false),
(18, 'Sieger perro adulto',13700,'food','Sieger perro adulto mordida pequeña',
     'Sin información extra',
     'sieger-adulto-pequeño.jpg',10,false,false),
(19, 'Sieger criadores',56500,'food','Sieger criadores 20 Kg',
     'Criadores posee una fórmula exclusiva que brinda una adecuada alimentación durante todas las etapas madurativas de la vida del perro',
     'sieger-adulto.jpg',0,false,false),
(20, 'Eukanuba perro adulto',14550,'food','Eukanuba perro adulto razas pequeñas',
     'Recomendado para perros adultos mayores a 12 meses de edad. Alimento balanceado completo para perros adultos de raza pequeña que pesan menos de 10 kg',
     'eukanuba.jpg',8,false,true); 

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion_producto`
--

CREATE TABLE `valoracionproducto` (
  `idvaloracion` bigint(20) NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  `ranking` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Volcado de datos para la tabla `valoracion_producto`
--

INSERT INTO `valoracionproducto` (`idvaloracion`,`idproducto`, `idusuario`, `ranking`, `descripcion`) VALUES
(1,2,4, 5, '¡Excelente producto, altamente recomendado!'),
(2,2,5, 4, 'Muy buen producto, cumple con lo esperado.'),
(3,2,6, 5, '¡Increíble calidad y diseño! Me encanta.'),
(4,3,7, 4, 'Buen producto, fácil de usar y de gran calidad.'),
(5,3,8, 5, '¡El mejor comedero que he tenido!'),
(6,3,9, 3, 'Buen producto, aunque un poco caro para mi gusto.'),
(7,5,10, 5, '¡Fantástica funda de auto! Se adapta perfectamente.'),
(8,5,4, 4, 'Muy útil y práctica. La recomiendo.'),
(9,5,5, 5, '¡Excelente calidad, superó mis expectativas!'),
(10,7,6, 3, 'Buena calidad, pero el tamaño no es el adecuado para mi perro.'),
(11,7,7, 4, 'Arnés resistente y cómodo. Ideal para paseos.'),
(12,7,8, 5, '¡Me encanta este arnés! Muy seguro y fácil de ajustar.'),
(13,10,9, 5, 'Juguete muy divertido y entretenido para mi perro.'),
(14,10,10, 4, 'Me gusta mucho este producto, mi perro lo disfruta mucho.'),
(15,10,4, 3, 'Bien, pero esperaba un poco más de calidad.'),
(16,13,5, 5, '¡Pelota perfecta para juegos al aire libre!'),
(17,13,6, 5, 'Muy resistente y durable. ¡Mi perro la adora!'),
(18,13,7, 4, 'Excelente juguete para mantener activo a mi perro.'),
(19,15,8, 4, 'Alimento de buena calidad, mi perro lo disfruta.'),
(20,15,9, 5, '¡Muy bueno! Mi perro se siente genial después de comerlo.'),
(21,15,10, 5, '¡El alimento perfecto para mi mascota! Lo recomiendo.'),
(22,16,4, 5, 'Mi perro ama este alimento, le ha sentado muy bien.'),
(23,16,5, 4, 'Buen producto, cumple con las expectativas.'),
(24,16,6, 5, 'Excelente calidad, mi perro está feliz y saludable.');

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `rodescripcion` varchar(50) NOT NULL,
  `rofechaeliminacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rodescripcion`) VALUES
(1, 'admin'),
(2, 'deposito'),
(3, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario`       bigint(20) NOT NULL,
  `usnombre`        varchar(50) NOT NULL,
  `uspass`          varchar(50) NOT NULL,
  `usmail`          varchar(50) NOT NULL,
  `usdeshabilitado` timestamp NULL DEFAULT NULL,
  `usactivo`        boolean NOT NULL DEFAULT false
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Volcado de datos para la tabla `usuario`
--
INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usactivo`) VALUES
(1, 'Nacho', '81bf209201c06b67bfbc4cb9faa3bb56', 'adminNacho@gmail.com',true),
(2, 'Pablo', 'b38f66d321c9b38bc3c168decae0d09e', 'adminPablo@gmail.com',true),
(3, 'Elias', 'b7990ca3fb4f3052715c23ef64afc726', 'deposito@gmail.com',true),
(4, 'Miriam', '217903b25bc43eed22d78616623fe994', 'miriam@gmail.com',true),
(5, 'Gisela', 'f559ffd0188ddb9ecbebb5c23ca35ccc', 'gisela@gmail.com',true),
(6, 'Marcos', 'a1058a18f8b346d33d71f635f8108af9', 'marcos@gmail.com',false),
(7, 'Luis', 'a5288be6ab6b21d8447dcee5d9dfb62a', 'luis@gmail.com',true),
(8, 'Cesar', '2d6bc6df8011336535d75156d32d05ef', 'cesar@gmail.com',false),
(9, 'Paula', '0c7931bc1693c95acb5268cd0ce0d304', 'paula@gmail.com',true),
(10, 'Marcela', '04526085da70159df77941897a3575c5', 'marcela@gmail.com',false);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

CREATE TABLE `usuariorol` (
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL,
  `rolactivo` boolean NOT NULL DEFAULT false 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuariorol`
--
INSERT INTO `usuariorol` (`idusuario`, `idrol`,`rolactivo`) VALUES
(1, 1,1),
(2, 1,1),
(3, 2,1),
(4, 3,1),
(5, 3,1),
(6, 3,1),
(7, 3,1),
(8, 3,1),
(9, 3,1),
(10, 3,1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD UNIQUE KEY `idcompra` (`idcompra`),
  ADD KEY `fkcompra_1` (`idusuario`);

--
-- Indices de la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD PRIMARY KEY (`idcompraestado`),
  ADD UNIQUE KEY `idcompraestado` (`idcompraestado`),
  ADD KEY `fkcompraestado_1` (`idcompra`),
  ADD KEY `fkcompraestado_2` (`idcompraestadotipo`);

--
-- Indices de la tabla `compraestadotipo`
--
ALTER TABLE `compraestadotipo`
  ADD PRIMARY KEY (`idcompraestadotipo`);

--
-- Indices de la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idcompraitem`),
  ADD UNIQUE KEY `idcompraitem` (`idcompraitem`),
  ADD KEY `fkcompraitem_1` (`idcompra`),
  ADD KEY `fkcompraitem_2` (`idproducto`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `fkmenu_1` (`idpadre`);

--
-- Indices de la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD PRIMARY KEY (`idmenu`,`idrol`),
  ADD KEY `fkmenurol_2` (`idrol`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `valoracionproducto`
  ADD PRIMARY KEY (`idvaloracion`),
  ADD UNIQUE KEY `idvaloracion` (`idvaloracion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idrol` (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuario`,`idrol`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compraestado`
--
ALTER TABLE `compraestado`
  MODIFY `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compraitem`
--
ALTER TABLE `compraitem`
  MODIFY `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `valoracionproducto`
--
ALTER TABLE `valoracionproducto`
  MODIFY `idvaloracion` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fkmenu_1` FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoracionproducto`
--
ALTER TABLE `valoracionproducto`
  ADD CONSTRAINT `fkvaloracionproducto_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkvaloracionproducto_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
