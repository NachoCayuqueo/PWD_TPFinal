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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestado`
--

CREATE TABLE `compraestado` (
  `idcompraestado` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cefechafin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraitem`
--

CREATE TABLE `compraitem` (
  `idcompraitem` bigint(20) UNSIGNED NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(7, 'nuevo', 'kkkkk', NULL, NULL),
(8, 'nuevo', 'kkkkk', NULL, NULL),
(9, 'nuevo', 'kkkkk', 7, NULL),
(10, 'nuevo', 'kkkkk', NULL, NULL),
(11, 'nuevo', 'kkkkk', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menurol`
--

CREATE TABLE `menurol` (
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL,
  `pronombre` varchar(50) NOT NULL,
  `proprecio` int(20) NOT NULL,
  `prodetalle` JSON NOT NULL, 
  `procantstock` int(11) NOT NULL,
  `espropopular` boolean NOT NULL DEFAULT false,
  `espronuevo` boolean NOT NULL DEFAULT false

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `producto` (`idproducto`, `pronombre`,`proprecio`,`prodetalle`, `procantstock`,`espropopular`,`espronuevo`) VALUES
(1, 'Comedero bebedero',3610,
  '{"descripcion":"Comedero Acero Inoxidable Antideslizante",
    "tipo":"accesorio",
    "masInfo":[
      "Es un bebedero de acero inoxidable, de gran resistencia",
      "Presenta un molde de goma que evita deslizamientos mientras se usa"
      ],
    "imagen":"comedero-bebedero.jpg"
    }',
    100,false,false),
(2, 'Comedero doble',15000,
    '{"descripcion":"Comedero acero inoxidable doble",
      "tipo":"accesorio",
      "masInfo":[
        "Incluye 2 tazones de acero inoxidable 750 ml. con soporte de metal negro",
        "El protector antideslizante garantiza que la taza no se moverá ni se volcará fácilmente durante el uso"
        ],
        "imagen" : "comedero-doble.jpg"
      }',
      100,true,false),
(3, 'Comedero doble regulable',40000,
    '{"descripcion":"Comedero doble con pie regulable de acero inoxidable",
      "tipo":"accesorio",
      "masInfo":[
        "Medida: 59 x 33 x 55",
        "Medida de cada plato: 21 Cm Diámetro",
        "Material: Acero inoxidable de primera calidad"
        ],
        "imagen" : "comedero-doble-regulable.jpg"
      }',
      100,true,false),
(4, 'Comedero plegable de silicona',3450,
    '{"descripcion":"Práctico comedero/bebedero para llevar en tus paseos o viajes con tu mascota",
      "tipo":"accesorio",
      "masInfo":[
        "De silicona",
        "Antideslizante, plegable y portátil",
        "Incluye mosquetón para enganchar en cualquier lado"
        ],
        "imagen" : "comedero-plegable-de-silicona.jpg"
      }',
      100,false,true),
(5, 'Funda de auto palta',60000,
    '{"descripcion":"Funda para los asientos de los autos y tambien para el baul",
      "tipo":"accesorio",
      "masInfo":[
        "Impermeable",
        "Antidesgarro",
        "No se pegan los pelos",
        "Faciles de limpiar",
        "Medidas: 1,30mts x 1,50 mts"
        ],
        "imagen" : "funda-auto-palta.jpg"
      }',
      100,true,false),
(6, 'Funda de auto Paris',60000,
    '{"descripcion":"Funda para los asientos de los autos y tambien para el baul",
      "tipo":"accesorio",
      "masInfo":[
        "Impermeable",
        "Antidesgarro",
        "No se pegan los pelos",
        "Faciles de limpiar",
        "Medidas: 1,30mts x 1,50 mts"
        ],
        "imagen" : "funda-auto-paris.jpg"
      }',
      100,false,true),
(7, 'Arnes Fucsia',23000,
    '{"descripcion":"Arnés regulable en pecho y cuello",
      "tipo":"accesorio",
      "masInfo":[
        "Impermeable",
        "Manija de sujeción con hebilla de acero inoxidable para colocar correa",
        "Banda Reflectiva para la noche"
        ],
        "imagen" : "arnes-fucsia.jpg"
      }',
      100,false,false),
(8, 'Arnes Superman',8500,
    '{"descripcion":"Proporcionan comodidad y confort a tu perro",
      "tipo":"accesorio",
      "masInfo":[
        "Facil de colocar y retirar",
        "Contienen una cinta regulable en el pecho que se ajusta con un broche reforzado"
        ],
        "imagen" : "arnes-superman.jpg"
      }',
      100,false,false),
(9, 'Action baseball con manija de soga',8700,
    '{"descripcion":"Soga Action con pelota dental",
      "tipo":"juguete",
      "masInfo":[
        "Ideal para cuidar su salud bucal mientras juega"
        ],
        "imagen" : "baseball-sola.jpg"
      }',
      100,false,false),
(10, 'Campana dispenser de snacks',10000,
    '{"descripcion":"Juego de ingenio contenedor de alimento",
      "tipo":"juguete",
      "masInfo":[
        "Sin información extra"
        ],
        "imagen" : "campana-dispenser-snack.jpg"
      }',
      100,true,false),
(11, 'Dona',5300,
    '{"descripcion":"Dona con chifle",
      "tipo":"juguete",
      "masInfo":[
        "No son tóxicos",
        "Son lavables y durables",
        "Ideales para perros chicos o poco mordedores"
        ],
        "imagen" : "dona-chifle.jpg"
      }',
      100,false,true),
(12, 'Mordillo',8600,
    '{"descripcion":"Hueso Mordillo Ice",
      "tipo":"juguete",
      "masInfo":[
        "Hecho de goma TPR no tóxica",
        "Juguete refrescante, resistente, seguro y extremadamente duradero",
        "Ideal para cachorros de dentición"
        ],
        "imagen" : "hueso-mordillo-ice.jpg"
      }',
      100,true,false),
(13, 'Pelota Squiki',7500,
    '{"descripcion":"Pelota squiki para snacks",
      "tipo":"juguete",
      "masInfo":[
        "Diseñada para la diversión y la salud dental de tu perro",
        "Son 100% resistentes y sus dientitos de goma ayudan a cuidar la salud bucal de tus mascotas mientras juegan",
        "Es ideal para rellenarla con alimentos y estimular el ingenio de tu mascota brindándole máxima diversión y entretenimiento"
        ],
        "imagen" : "pelota-squiki-snacks.jpg"
      }',
      100,false,true),
(14, 'Soga 2 nudos',2500,
    '{"descripcion":"Soga de tela con 2 nudos",
      "tipo":"juguete",
      "masInfo":[
        "Se diseñó para que tu mascota libere su stress mientras juega",
        "También se usan para que el perro los pueda morder y realizar tareas de entrenamiento con él"
        ],
        "imagen" : "soga-2-nudos.jpg"
      }',
      100,false,false),
(15, 'Agility perro adulto 20 kilos',37500,
    '{"descripcion":"Alimento balanceado para perros adultos de 1 a 7 años",
      "tipo":"alimento",
      "masInfo":[
        "Los perros adultos necesitan una alimentación completa y equilibrada que cubra sus requerimientos nutricionales y les brinde salud y vitalidad",
        "Agility Adultos es una fórmula exclusivamente diseñada con ingredientes de alta calidad"
        ],
        "imagen" : "agility-adulto.jpg"
      }',
      100,false,false),
(16, 'Balanced adulto razas medianas',11500,
    '{"descripcion":"Indicado para perros adultos de raza mediana de 12 meses hasta 7 años",
      "tipo":"alimento",
      "masInfo":[
        "Modulación de defensas",
        "Músculos fuertes",
        "Control de sarro y la halitosis",
        "Cuidado óseo"
        ],
        "imagen" : "balanced-adulto.jpg"
      }',
      100,true,false),
(17, 'ROYAL CANIN MINI ADULTO',21600,
    '{"descripcion":"Alimento para perros adultos de talla pequeña (peso adulto hasta 10 kg). De 10 meses a 8 años de edad",
      "tipo":"alimento",
      "masInfo":[
        "Ayuda a mantener un peso saludable en perros de talla pequeña",
        "Esta fórmula contiene nutrientes que ayuda a mantener una piel y un pelaje saludable"
        ],
        "imagen" : "royal-mini-adulto.jpg"
      }',
      100,true,false),
(18, 'Sieger perro adulto',13700,
    '{"descripcion":"Sieger perro adulto mordida pequeña",
      "tipo":"alimento",
      "masInfo":[
        "Sin información extra"
        ],
        "imagen" : "sieger-adulto-pequeño.jpg"
      }',
      100,false,false),
(19, 'Sieger criadores',56500,
    '{"descripcion":"Sieger criadores 20 Kg",
      "tipo":"alimento",
      "masInfo":[
        "Criadores posee una fórmula exclusiva que brinda una adecuada alimentación durante todas las etapas madurativas de la vida del perro"
        ],
        "imagen" : "sieger-adulto.jpg"
      }',
      100,false,false),
(20, 'Eukanuba perro adulto',14550,
    '{"descripcion":"Eukanuba perro adulto razas pequeñas",
      "tipo":"alimento",
      "masInfo":[
        "Recomendado para perros adultos mayores a 12 meses de edad",
        "Alimento balanceado completo para perros adultos de raza pequeña que pesan menos de 10 kg"
        ],
        "imagen" : "eukanuba.jpg"
      }',
      100,false,true); 
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `rodescripcion` varchar(50) NOT NULL
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
-- se cambio idusuario,uspass y se agrego usactive
CREATE TABLE `usuario` (
  `idusuario`       bigint(20) NOT NULL AUTO_INCREMENT,
  `usnombre`        varchar(50) NOT NULL,
  `uspass`          varchar(50) NOT NULL,
  `usmail`          varchar(50) NOT NULL,
  `usdeshabilitado` timestamp NULL DEFAULT NULL,
  `usActive`        boolean NOT NULL DEFAULT false,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usActive`) VALUES
(1, 'Nacho', 'admin103149', 'adminNacho@gmail.com',true),
(2, 'Pablo', 'admin114550', 'adminPablo@gmail.com',true),
(3, 'Elias', 'deposito123456', 'deposito@gmail.com',false),
(4, 'Miriam', 'cliente000001', 'miriam@gmail.com',false),
(5, 'Gisela', 'cliente000002', 'gisela@gmail.com',false);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

CREATE TABLE `usuariorol` (
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuariorol`
--

INSERT INTO `usuariorol` (`idusuario`, `idrol`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 3),
(5, 3);

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
-- Filtros para la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
