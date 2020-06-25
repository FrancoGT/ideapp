CREATE DATABASE `appidea`;
USE `appidea`;
CREATE TABLE `tbl_persona`
(
  `id_persona` INT(150) NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NULL,
  PRIMARY KEY (`id_persona`)
);
CREATE TABLE `tbl_proyecto_construccion`
(
  `id_proyecto_construccion` INT(150) NOT NULL AUTO_INCREMENT,
  `nombre_proyecto` VARCHAR(45) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NULL,
  `estado_proyecto` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_proyecto_construccion`)
);
CREATE TABLE `tbl_obra`
(
  `id_obra` INT(150) NOT NULL AUTO_INCREMENT,
  `tipo` TINYINT(1) NOT NULL, /* 1: Casco Gris, 2: Casco Rojo */
  `estado_obra` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_obra`)
);
CREATE TABLE `tbl_material`
(
  `id_material` INT(150) NOT NULL AUTO_INCREMENT,
  `nombre_material` VARCHAR(45) NOT NULL,
  `unidad` VARCHAR(45) NOT NULL,
  `estado_material` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_material`)
);
CREATE TABLE `tbl_costo`
(
  `id_costo` INT(150) NOT NULL AUTO_INCREMENT,
  `precio_unitario` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
  `cantidad` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
  `estado_costo` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_costo`)
);
CREATE TABLE `tbl_costo_adicional`
(
  `id_costo_adicional` INT(150) NOT NULL AUTO_INCREMENT,
  `precio` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
  `estado_costo_adicional` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_costo_adicional`)
);
CREATE TABLE `tbl_adelanto_semanal`
(
  `id_adelanto_semanal` INT(150) NOT NULL AUTO_INCREMENT,
  `monto_adelanto_semanal` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
  `fecha_adelanto_semanal` DATE NOT NULL,
  PRIMARY KEY (`id_adelanto_semanal`)
);
CREATE TABLE `tbl_control_horas`
(
  `id_control_horas` INT(150) NOT NULL AUTO_INCREMENT,
  `horas` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
  `fecha_control_horas` DATE NOT NULL,
  PRIMARY KEY (`id_control_horas`)
);
CREATE TABLE `tbl_area_cargo`
(
  `id_area_cargo` INT(150) NOT NULL AUTO_INCREMENT,
  `cod_area_cargo` VARCHAR(100),
  `area` VARCHAR(100) NOT NULL,
  `cargo` VARCHAR(100) NULL,
  `estado_area_cargo` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_area_cargo`)
);
/*Tablas con FK*/
CREATE TABLE `tbl_users`
(
  `id_user` INT(150) NOT NULL AUTO_INCREMENT,
  `id_persona` INT(150) NOT NULL,
  `username` VARCHAR(150) NOT NULL,
  `password` VARCHAR(150) NOT NULL,
  `tipo` TINYINT(1) NOT NULL,
  `estado_usuario` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_user`),
  FOREIGN KEY (`id_persona`) REFERENCES tbl_persona(`id_persona`)
);
CREATE TABLE `tbl_trabajador`
(
  `id_trabajador` INT(150) NOT NULL AUTO_INCREMENT,
  `cod_trabajador` VARCHAR(100),
  `id_persona` INT(150) NOT NULL,
  `id_area_cargo` INT(150),
  `estado_trabajador` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_trabajador`),
  FOREIGN KEY (`id_persona`) REFERENCES tbl_persona(`id_persona`),
  FOREIGN KEY (`id_area_cargo`) REFERENCES tbl_area_cargo(`id_area_cargo`),
  UNIQUE(`cod_trabajador`)
  
);
CREATE TABLE `tbl_proyecto_construccion_trabajador`
(
  `id_proyecto_construccion_trabajador` INT(150) NOT NULL AUTO_INCREMENT,
  `id_proyecto_construccion` INT(150) NOT NULL,
  `id_trabajador` INT(150) NOT NULL,
  PRIMARY KEY (`id_proyecto_construccion_trabajador`),
  FOREIGN KEY (`id_proyecto_construccion`) REFERENCES tbl_proyecto_construccion(`id_proyecto_construccion`),
  FOREIGN KEY (`id_trabajador`) REFERENCES tbl_trabajador(`id_trabajador`)
);
CREATE TABLE `tbl_detalle_proyecto_obra`
(
  `id_detalle_proyecto_obra` INT(150) NOT NULL AUTO_INCREMENT,
  `id_proyecto_construccion` INT(150) NOT NULL,
  `id_obra` INT(150) NOT NULL,
  PRIMARY KEY (`id_detalle_proyecto_obra`),
  FOREIGN KEY (`id_proyecto_construccion`) REFERENCES tbl_proyecto_construccion(`id_proyecto_construccion`),
  FOREIGN KEY (`id_obra`) REFERENCES tbl_obra(`id_obra`)
);
CREATE TABLE `tbl_sueldo_semanal`
(
  `id_sueldo_semanal` INT(150) NOT NULL AUTO_INCREMENT,
  `id_proyecto_construccion` INT(150) NOT NULL,
  `id_trabajador` INT(150) NOT NULL,
  `monto_sueldo_semanal` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_sueldo_semanal`),
  FOREIGN KEY (`id_proyecto_construccion`) REFERENCES tbl_proyecto_construccion(`id_proyecto_construccion`),
  FOREIGN KEY (`id_trabajador`) REFERENCES tbl_trabajador(`id_trabajador`)
);
CREATE TABLE `tbl_detalle_adelanto_semanal`
(
  `id_detalle_adelanto_semanal` INT(150) NOT NULL AUTO_INCREMENT,
  `id_proyecto_construccion` INT(150) NOT NULL,
  `id_adelanto_semanal` INT(150) NOT NULL,
  PRIMARY KEY (`id_detalle_adelanto_semanal`),
  FOREIGN KEY (`id_proyecto_construccion`) REFERENCES tbl_proyecto_construccion(`id_proyecto_construccion`),
  FOREIGN KEY (`id_adelanto_semanal`) REFERENCES tbl_adelanto_semanal(`id_adelanto_semanal`)
);
CREATE TABLE `tbl_control_horas_trabajador`
(
  `id_control_horas_trabajador` INT(150) NOT NULL AUTO_INCREMENT,
  `id_trabajador` INT(150) NOT NULL,
  `id_control_horas` INT(150) NOT NULL,
  PRIMARY KEY (`id_control_horas_trabajador`),
  FOREIGN KEY (`id_trabajador`) REFERENCES tbl_trabajador(`id_trabajador`),
  FOREIGN KEY (`id_control_horas`) REFERENCES tbl_control_horas(`id_control_horas`)
);
CREATE TABLE `tbl_material_obra_costo`
(
  `id_material_obra` INT(150) NOT NULL AUTO_INCREMENT,
  `id_obra` INT(150) NOT NULL,
  `id_material` INT(150) NOT NULL,
  `id_costo` INT(150) NOT NULL,
  `fecha_costo` DATE NOT NULL,
  `estado_material_obra_costo` TINYINT(1) NOT NULL,
  `id_costo_adicional` INT(150) NOT NULL,
  PRIMARY KEY (`id_material_obra`),
  FOREIGN KEY (`id_obra`) REFERENCES tbl_obra(`id_obra`),
  FOREIGN KEY (`id_material`) REFERENCES tbl_material(`id_material`),
  FOREIGN KEY (`id_costo`) REFERENCES tbl_costo(`id_costo`),
  FOREIGN KEY (`id_costo_adicional`) REFERENCES tbl_costo_adicional(`id_costo_adicional`)
);
CREATE TABLE `lottery_information`
(
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `amount` decimal(20,0) DEFAULT NULL,
  PRIMARY KEY(ID)
);



INSERT INTO `tbl_persona` (`id_persona`, `nombres`, `apellidos`) VALUES
(1, 'Percy', 'Delgado Tavera'),
(2, 'Franco Javier', 'Gutierrez Tamayo'),
(3, 'Willy', ''),
(4, 'Edilfonso', ''),
(5, 'Marcial', ''),
(6, 'Christian', ''),
(7, 'Richard', ''),
(8, 'Camilo', ''),
(9, 'Carlos', '');

INSERT INTO `tbl_area_cargo` (`id_area_cargo`, `cod_area_cargo`, `area`, `cargo`, `estado_area_cargo`) VALUES
(1, '00001', 'Obra', 'Obrero', 1);

INSERT INTO `tbl_users` (`id_user`, `id_persona`, `username`, `password`, `tipo`, `estado_usuario`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(2, 2, 'francogt', '21232f297a57a5a743894a0e4a801fc3', 1, 1);

INSERT INTO `tbl_proyecto_construccion` (`id_proyecto_construccion`, `nombre_proyecto`, `fecha_inicio`, `fecha_fin`, `estado_proyecto`) VALUES
(1,'obra para sr Pedro', '2019-01-24', '2019-12-31', 1); /* 1: Activo */

INSERT INTO `tbl_obra` (`id_obra`, `tipo`, `estado_obra`) VALUES
(1, 1, 1), /* CASCO GRIS */
(2, 2, 1); /* ACABADOS */

INSERT INTO `tbl_material` (`id_material`, `nombre_material`, `unidad`, `estado_material`) VALUES
(1, 'CEMENTO', 'kg', 1),
(2, 'ELIMINACION', 'kg', 1),
(3, 'HORAS MÁQUINA ', 'horas', 1),
(4, 'ARENA GRUESA VIAJES', 'kg', 1),
(5, 'PIEDRA CHANCADA (CASCAJO) VIAJES', 'kg', 1),
(6, 'PIEDRA MACHADA  6\" VIAJES', 'kg', 1),
(7, 'ARENA FINA VIAJES', 'kg', 1),
(8, 'FIERRO 1/4', 'm', 1),
(9, 'FIERRO 3/8', 'm', 1),
(10, 'FIERRO 1/2', 'm', 1),
(11, 'FIERRO 5/8', 'm', 1),
(12, 'FIERRO 3/4', 'm', 1),
(13, 'LADRILLOS H-10', 'kg', 1),
(14, 'PANDERETA', 'kg', 1),
(15, 'ECO DIAMANTE', 'kg', 1),
(16, 'HUECO 30 x 30 PARA TECHO', 'm', 1),
(17, 'ALAMBRE 8', 'm', 1),
(18, 'ALAMBRE 16', 'm', 1),
(19, 'CLAVOS KG', 'kg', 1),
(20, 'TECNOPOR', 'm', 1),
(21, 'OTROS YESO CAÑO TEFLON', 'kg', 1),
(22, 'PEGAMENTO OATEY', 'kg', 1),
(23, 'SIKA-CHEMA', 'kg', 1),
(24, 'TUBOS DE 4\"', 'm', 1),
(25, 'TUBOS DE 2\"', 'm', 1),
(26, 'TUBOS DE 3\"', 'm', 1),
(27, 'TUBO DE 1/2\" AGUA FRIA', 'm', 1),
(28, 'TUBO DE 1/2\" AGUA CALIENTE HIDRO H3', 'm', 1),
(29, 'TUBO DE 3/4\" AGUA FRIA', 'm', 1),
(30, 'TUBO DE 3/4\" AGUA CALIENTE HIDRO H3', 'm', 1),
(31, 'TEE DE 1/2\'\'', 'm', 1),
(32, 'CODOS DE 1/2\"', 'm', 1),
(33, 'CODOS DE 1/2\" A 45', 'm', 1),
(34, 'CODO INSERTO 1/2\"', 'm', 1),
(35, 'CODOS DE 3/4\"', 'm', 1),
(36, 'CEMENTO YURA', 'Kg', 0),
(37, 'TEE DE 3/4\"', 'm', 1),
(38, 'TEE DE 2\"', 'm', 1),
(39, 'YEE DE 2\"', 'm', 1),
(40, 'CODOS DE 2X90', 'm', 1),
(41, 'CODOS DE 2X45', 'm', 1),
(42, 'TEE  DE 4X4\"', 'm', 1),
(43, 'YEE DE 4X4\"', 'm', 1),
(44, 'TEE SANITARIA', 'm', 1),
(45, 'CODOS DE 4X90', 'm', 1),
(46, 'CODOS DE 4X45', 'm', 1),
(47, 'CODOS DE 4 A 2\"', 'm', 1),
(48, 'TEE DE 4 A 2\"', 'm', 1),
(49, 'YEE DE 4 A 2\"', 'm', 1),
(50, 'TUBOS DE LUZ 1/2\"', 'm', 1),
(51, 'TUBOS DE LUZ 3/4\"', 'm', 1),
(52, 'TUBOS DE LUZ 1\"', 'm', 1),
(53, 'CAJAS RECTANGULARES DE LUZ', 'kg', 1),
(54, 'CURVAS DE LUZ 1/2\"', 'm', 1),
(55, 'CURVAS DE LUZ 3/4\"', 'm', 1),
(56, 'LLAVE DE PASO 1/2\"', 'm', 1),
(57, 'UNIVERSALES DE 1/2\"', 'm', 1),
(58, 'NIPLES', 'm', 1),
(59, 'TAPONES MACHO', 'm', 1),
(60, 'TAPONES HEMBRA', 'm', 1),
(61, 'REDUCCIÓN DE 3/4\" A 1/2\"', 'm', 1),
(62, 'TARRAJAS DE 3/4\"', 'm', 1),
(63, 'TARRAJAS DE 1/2\"', 'm', 1),
(64, 'TABLERO PARA CUCHILLAS', 'm', 1),
(65, 'CAJAS METÁLICAS 25X25', 'm', 1),
(66, 'CAJAS PVC 20X20', 'kg', 1),
(67, 'CAJA DE PASO 15X15', 'kg', 1),
(68, 'CAJAS DE 2 1/2\"', 'kg', 1),
(69, 'ROLLO DE MALLA GALLINERO', 'm', 1),
(70, 'PASAMANOS', 'uni', 1),
(71, 'PUERTAS PRINCIPALES', 'uni', 1),
(72, 'PUERTA DE ESTACIONAMIENTO', 'uni', 1),
(73, 'PUERTAS INTERIORES', 'uni', 1),
(74, 'PUERTAS DE SERVICIO', 'uni', 1),
(75, 'PINTURA', 'l', 1),
(76, 'PASAJES', 'soles', 1);

INSERT INTO `tbl_costo` (`id_costo`, `precio_unitario`, `cantidad`, `estado_costo`) VALUES
(1, '20.30', '2.00', 1),
(2, '20.30', '4.00', 1),
(3, '20.30', '50.00', 1),
(4, '20.30', '100.00', 1),
(5, '20.30', '200.00', 1),
(6, '12.00', '60.00', 1),
(7, '120.00', '2.50', 1),
(8, '10.00', '1.00', 1),
(9, '37.00', '6.00', 1),
(10, '37.00', '30.00', 1),
(11, '37.00', '24.00', 1),
(12, '37.00', '18.00', 1),
(13, '37.00', '21.00', 1),
(14, '37.00', '6.00', 1),
(15, '37.00', '15.00', 1),
(16, '37.00', '6.00', 1),
(17, '170.00', '2.00', 1),
(18, '50.00', '6.00', 1),
(19, '50.00', '15.00', 1),
(20, '170.00', '4.00', 1),
(21, '170.00', '1.00', 1),
(22, '55.00', '6.00', 1),
(23, '6.00', '200.00', 1),
(24, '15.00', '300.00', 1),
(25, '15.00', '150.00', 1),
(26, '27.00', '100.00', 1),
(27, '27.00', '150.00', 1),
(28, '42.00', '100.00', 1),
(29, '42.00', '30.00', 1),
(30, '64.00', '10.00', 1),
(31, '1.15', '2000.00', 1),
(32, '2.70', '850.00', 1),
(33, '0.98', '1000.00', 1),
(34, '0.00', '0.00', 1),
(35, '3.80', '5.00', 1),
(36, '3.80', '100.00', 1),
(37, '3.80', '50.00', 1),
(38, '3.80', '60.53', 1),
(39, '3.80', '4.74', 1),
(40, '9.00', '1.00', 1),
(41, '27.00', '1.00', 1),
(42, '27.00', '2.00', 1),
(43, '28.00', '1.00', 1),
(44, '17.00', '1.00', 1),
(45, '16.00', '2.00', 1),
(46, '17.00', '10.00', 1),
(47, '7.50', '10.00', 1),
(48, '14.00', '10.00', 1),
(49, '3.50', '10.00', 1),
(50, '9.50', '2.00', 1),
(51, '9.50', '30.00', 1),
(52, '13.00', '30.00', 1),
(53, '1.00', '3.00', 1),
(54, '1.00', '80.00', 1),
(55, '20.00', '1.50', 1),
(56, '4.50', '2.00', 1),
(57, '10.00', '1.50', 1),
(58, '1.50', '50.00', 1),
(59, '8.00', '6.00', 1),
(60, '0.35', '300.00', 1),
(61, '9.50', '6.00', 1),
(62, '4.50', '6.00', 1),
(63, '4.50', '10.00', 1),
(64, '5.00', '15.00', 1),
(65, '6.00', '10.00', 1),
(66, '6.00', '50.00', 1),
(67, '1.00', '60.00', 1),
(68, '22.00', '12.00', 1),
(69, '1.00', '30.00', 1),
(70, '3.00', '30.00', 1),
(71, '1.00', '22.00', 1),
(72, '37.00', '1.00', 1),
(73, '23.00', '3.00', 1),
(74, '20.00', '2.00', 1),
(75, '7.00', '2.00', 1),
(76, '90.00', '1.00', 1),
(77, '1.15', '1000.00', 1),
(78, '3.80', '60.00', 1),
(79, '11.00', '10.00', 1),
(80, '11.00', '20.00', 1),
(81, '9.50', '1.00', 1),
(82, '175.00', '2.00', 1),
(83, '7.00', '10.00', 1),
(84, '35.00', '40.00', 1),
(85, '54.00', '25.00', 1),
(86, '1.00', '100.00', 1),
(87, '1.00', '20.00', 1),
(88, '7.00', '24.00', 1),
(89, '2.50', '30.00', 1),
(90, '2.50', '20.00', 1),
(91, '1.50', '20.00', 1),
(92, '1.50', '10.00', 1),
(93, '6.50', '10.00', 1),
(94, '2.50', '200.00', 1),
(95, '2.50', '100.00', 1),
(96, '0.50', '200.00', 1),
(97, '0.30', '50.00', 1),
(98, '22.00', '1.00', 1),
(99, '12.00', '2.00', 1),
(100, '25.00', '10.00', 1),
(101, '15.00', '1.00', 1);
INSERT INTO `tbl_costo_adicional` (`id_costo_adicional`, `precio`, `estado_costo_adicional`) VALUES
(1, '0.00', 1),
(2, '980.00', 1),
(3, '85.00', 1),
(4, '385.00', 1),
(5, '630.00', 1),
(6, '204.00', 1),
(7, '40.00', 1);

INSERT INTO `tbl_detalle_proyecto_obra` (`id_detalle_proyecto_obra`, `id_proyecto_construccion`, `id_obra`) VALUES
(1, 1, 1),
(2, 1, 2);

INSERT INTO `tbl_material_obra_costo` (`id_material_obra`, `id_obra`, `id_material`, `id_costo`, `fecha_costo`, `id_costo_adicional`, `estado_material_obra_costo`) VALUES
(NULL, 1, 76, 101, '2019-09-01', 1, 1),
(NULL, 1, 1, 1, '2019-09-19', 1, 1),
(NULL, 1, 1, 2, '2019-10-09', 1, 1),
(NULL, 1, 1, 3, '2019-10-17', 1, 1),
(NULL, 1, 1, 4, '2019-10-29', 1, 1),
(NULL, 1, 1, 4, '2019-11-04', 1, 1),
(NULL, 1, 1, 4, '2019-11-07', 1, 1),
(NULL, 1, 1, 4, '2019-11-14', 1, 1),
(NULL, 1, 1, 4, '2019-11-20', 1, 1),
(NULL, 1, 1, 4, '2019-11-25', 1, 1),
(NULL, 1, 1, 4, '2019-12-04', 2, 1),
(NULL, 1, 1, 4, '2019-12-17', 1, 1),
(NULL, 1, 2, 6, '2019-10-19', 1, 1),
(NULL, 1, 3, 7, '2019-10-17', 1, 1),
(NULL, 1, 4, 8, '2019-09-19', 1, 1),
(NULL, 1, 4, 9, '2019-10-17', 1, 1),
(NULL, 1, 4, 10, '2019-11-02', 1, 1),
(NULL, 1, 4, 11, '2019-11-09', 1, 1),
(NULL, 1, 4, 12, '2019-11-18', 1, 1),
(NULL, 1, 4, 13, '2019-11-23', 1, 1),
(NULL, 1, 4, 14, '2019-11-30', 1, 1),
(NULL, 1, 4, 15, '2019-12-07', 1, 1),
(NULL, 1, 4, 16, '2019-12-28', 1, 1),
(NULL, 1, 5, 17, '2019-11-02', 1, 1),
(NULL, 1, 5, 18, '2019-11-09', 1, 1),
(NULL, 1, 5, 19, '2019-11-23', 1, 1),
(NULL, 1, 5, 19, '2019-12-07', 1, 1),
(NULL, 1, 6, 17, '2019-11-02', 1, 1),
(NULL, 1, 6, 20, '2019-11-09', 1, 1),
(NULL, 1, 6, 21, '2019-11-18', 1, 1),
(NULL, 1, 7, 22, '2019-11-30', 1, 1),
(NULL, 1, 7, 22, '2019-12-07', 1, 1),
(NULL, 1, 7, 22, '2019-12-21', 1, 1),
(NULL, 1, 7, 22, '2019-12-28', 1, 1),
(NULL, 1, 8, 23, '2019-10-17', 1, 1),
(NULL, 1, 9, 24, '2019-10-17', 1, 1),
(NULL, 1, 9, 25, '2019-11-14', 1, 1),
(NULL, 1, 10, 26, '2019-10-17', 1, 1),
(NULL, 1, 10, 27, '2019-11-14', 1, 1),
(NULL, 1, 11, 28, '2019-10-17', 1, 1),
(NULL, 1, 11, 29, '2019-11-14', 1, 1),
(NULL, 1, 12, 30, '2019-11-14', 1, 1),
(NULL, 1, 13, 31, '2019-10-30', 1, 1),
(NULL, 1, 13, 31, '2019-11-11', 1, 1),
(NULL, 1, 13, 32, '2019-11-15', 1, 1),
(NULL, 1, 13, 31, '2019-11-21', 1, 1),
(NULL, 1, 13, 77, '2019-12-04', 1, 1),
(NULL, 1, 14, 33, '2019-11-21', 1, 1),
(NULL, 1, 14, 33, '2019-12-04', 1, 1),
(NULL, 1, 15, 34, '2019-09-01', 1, 1),
(NULL, 1, 16, 34, '2019-09-01', 1, 1),
(NULL, 1, 17, 35, '2019-10-09', 1, 1),
(NULL, 1, 17, 36, '2019-10-17', 1, 1),
(NULL, 1, 17, 36, '2019-11-14', 1, 1),
(NULL, 1, 17, 37, '2019-11-29', 1, 1),
(NULL, 1, 17, 37, '2019-12-04', 1, 1),
(NULL, 1, 18, 35, '2019-10-09', 1, 1),
(NULL, 1, 18, 36, '2019-10-17', 1, 1),
(NULL, 1, 18, 36, '2019-10-30', 1, 1),
(NULL, 1, 18, 36, '2019-11-14', 1, 1),
(NULL, 1, 18, 37, '2019-11-29', 1, 1),
(NULL, 1, 18, 37, '2019-12-04', 1, 1),
(NULL, 1, 19, 35, '2019-10-09', 1, 1),
(NULL, 1, 19, 78, '2019-10-17', 1, 1),
(NULL, 1, 19, 38, '2019-11-04', 1, 1),
(NULL, 1, 19, 39, '2019-11-15', 1, 1),
(NULL, 1, 20, 79, '2019-10-17', 1, 1),
(NULL, 1, 20, 80, '2019-11-07', 1, 1),
(NULL, 1, 20, 79, '2019-11-29', 1, 1),
(NULL, 1, 21, 34, '2019-09-30', 3, 1),
(NULL, 1, 21, 34, '2019-10-31', 4, 1),
(NULL, 1, 21, 34, '2019-11-30', 5, 1),
(NULL, 1, 21, 34, '2019-12-31', 6, 1),
(NULL, 1, 22, 40, '2019-10-09', 1, 1),
(NULL, 1, 22, 41, '2019-10-30', 1, 1),
(NULL, 1, 22, 42, '2019-11-16', 1, 1),
(NULL, 1, 22, 43, '2019-12-17', 1, 1),
(NULL, 1, 23, 82, '2019-11-19', 1, 1),
(NULL, 1, 24, 45, '2019-10-09', 1, 1),
(NULL, 1, 24, 46, '2019-10-30', 1, 1),
(NULL, 1, 25, 47, '2019-10-30', 1, 1),
(NULL, 1, 25, 83, '2019-11-25', 1, 1),
(NULL, 1, 26, 48, '2019-10-30', 1, 1),
(NULL, 1, 26, 49, '2019-11-25', 1, 1),
(NULL, 1, 27, 50, '2019-10-30', 1, 1),
(NULL, 1, 27, 51, '2019-12-17', 1, 1),
(NULL, 1, 28, 84, '2019-12-17', 1, 1),
(NULL, 2, 29, 52, '2019-12-17', 1, 0),
(NULL, 2, 30, 85, '2019-12-17', 1, 0),
(NULL, 1, 31, 53, '2019-10-09', 1, 1),
(NULL, 1, 31, 54, '2019-12-17', 1, 1),
(NULL, 1, 32, 86, '2019-12-17', 1, 1),
(NULL, 2, 33, 87, '2019-12-17', 1, 0),
(NULL, 2, 34, 88, '2019-12-17', 1, 0),
(NULL, 2, 35, 89, '2019-12-17', 1, 0),
(NULL, 2, 37, 90, '2019-12-17', 1, 0),
(NULL, 1, 38, 53, '2019-10-09', 1, 1),
(NULL, 1, 38, 91, '2019-11-16', 1, 1),
(NULL, 1, 39, 91, '2019-11-16', 1, 1),
(NULL, 1, 40, 56, '2019-10-09', 1, 1),
(NULL, 1, 40, 92, '2019-10-30', 1, 1),
(NULL, 1, 40, 58, '2019-11-16', 1, 1),
(NULL, 1, 41, 56, '2019-10-09', 1, 1),
(NULL, 1, 41, 91, '2019-11-16', 1, 1),
(NULL, 1, 42, 93, '2019-11-16', 1, 1),
(NULL, 1, 43, 56, '2019-10-09', 1, 1),
(NULL, 1, 43, 59, '2019-11-16', 1, 1),
(NULL, 1, 44, 60, '2019-11-15', 1, 1),
(NULL, 1, 44, 61, '2019-11-16', 1, 1),
(NULL, 1, 45, 56, '2019-10-09', 1, 1),
(NULL, 1, 45, 62, '2019-10-30', 1, 1),
(NULL, 1, 45, 63, '2019-11-16', 1, 1),
(NULL, 1, 46, 63, '2019-11-16', 1, 1),
(NULL, 1, 47, 56, '2019-10-09', 1, 1),
(NULL, 1, 47, 63, '2019-11-16', 1, 1),
(NULL, 1, 48, 34, '2019-09-01', 1, 1),
(NULL, 1, 49, 56, '2019-10-09', 1, 1),
(NULL, 1, 49, 64, '2019-11-16', 1, 1),
(NULL, 1, 50, 34, '2019-10-30', 1, 1),
(NULL, 1, 51, 95, '2019-11-07', 1, 1),
(NULL, 1, 51, 94, '2019-11-15', 1, 1),
(NULL, 1, 52, 65, '2019-11-07', 1, 1),
(NULL, 1, 52, 66, '2019-12-17', 1, 1),
(NULL, 1, 53, 96, '2019-11-15', 1, 1),
(NULL, 1, 54, 67, '2019-12-17', 1, 1),
(NULL, 2, 55, 97, '2019-12-17', 1, 0),
(NULL, 2, 56, 68, '2019-12-17', 1, 0),
(NULL, 2, 57, 70, '2019-12-17', 1, 0),
(NULL, 2, 58, 54, '2019-12-17', 1, 0),
(NULL, 2, 59, 69, '2019-12-17', 1, 0),
(NULL, 2, 60, 87, '2019-12-17', 1, 0),
(NULL, 2, 61, 70, '2019-12-17', 1, 0),
(NULL, 2, 62, 98, '2019-12-17', 1, 0),
(NULL, 2, 63, 99, '2019-12-17', 1, 0),
(NULL, 2, 64, 72, '2019-12-17', 1, 0),
(NULL, 2, 65, 100, '2019-12-17', 1, 0),
(NULL, 2, 66, 73, '2019-12-17', 1, 0),
(NULL, 2, 67, 74, '2019-12-17', 1, 1),
(NULL, 2, 68, 75, '2019-12-17', 1, 0),
(NULL, 2, 69, 76, '2019-12-17', 1, 0),
(NULL, 2, 70, 34, '2019-09-01', 1, 1),
(NULL, 2, 71, 34, '2019-09-01', 1, 1),
(NULL, 2, 72, 34, '2019-09-01', 1, 1),
(NULL, 2, 73, 34, '2019-09-01', 1, 1),
(NULL, 2, 74, 34, '2019-09-01', 1, 1),
(NULL, 2, 75, 34, '2019-09-01', 1, 1),
(NULL, 1, 8, 23, '2019-11-14', 1, 1);

INSERT INTO `tbl_trabajador` (`id_trabajador`, `cod_trabajador`, `id_persona`, `id_area_cargo`, `estado_trabajador`) VALUES
(1, '00001', 3, 1, 1),
(2, '00002', 4, 1, 1),
(3, '00003', 5, 1, 1),
(4, '00004', 6, 1, 1),
(5, '00005', 7, 1, 1),
(6, '00006', 8, 1, 1),
(7, '00007', 9, 1, 1);

INSERT INTO `tbl_proyecto_construccion_trabajador` (`id_proyecto_construccion_trabajador`, `id_proyecto_construccion`, `id_trabajador`) 
VALUES (NULL, '1', '1'),
(NULL, '1', '2'),
(NULL, '1', '3'),
(NULL, '1', '4'),
(NULL, '1', '5'),
(NULL, '1', '6'),
(NULL, '1', '7');

INSERT INTO `tbl_sueldo_semanal` (`id_sueldo_semanal`, `id_proyecto_construccion`, `id_trabajador`, `monto_sueldo_semanal`) 
VALUES (NULL, '1', '1', 720.00),
(NULL, '1', '2', 700.00),
(NULL, '1', '3', 700.00),
(NULL, '1', '4', 480.00),
(NULL, '1', '5', 480.00),
(NULL, '1', '6', 480.00),
(NULL, '1', '7', 480.00);

INSERT INTO `tbl_adelanto_semanal` (`id_adelanto_semanal`, `monto_adelanto_semanal`, `fecha_adelanto_semanal`) 
VALUES (1, '0.00', '2019-10-01'),
(2, '500.00', '2019-10-11'),
(3, '2500.00', '2019-10-19'),
(4, '2500.00', '2019-10-26'),
(5, '3000.00', '2019-11-02'),
(6, '3000.00', '2019-11-09'),
(7, '6200.00', '2019-11-16'),
(8, '5500.00', '2019-11-23'),
(9, '6500.00', '2019-11-30'),
(10, '5400.00', '2019-12-07'),
(11, '4500.00', '2019-12-14'),
(12, '4000.00', '2019-12-21'),
(13, '0.00', '2019-12-28');

INSERT INTO `tbl_detalle_adelanto_semanal` (`id_detalle_adelanto_semanal`, `id_proyecto_construccion`, `id_adelanto_semanal`) 
VALUES (NULL, '1', '1'),
(NULL, '1', '2'),
(NULL, '1', '3'),
(NULL, '1', '4'),
(NULL, '1', '5'),
(NULL, '1', '6'),
(NULL, '1', '7'),
(NULL, '1', '8'),
(NULL, '1', '9'),
(NULL, '1', '10'),
(NULL, '1', '11'),
(NULL, '1', '12'),
(NULL, '1', '13');

INSERT INTO `tbl_control_horas` (`id_control_horas`, `horas`, `fecha_control_horas`) 
VALUES (1, '8.00', '2019-11-04'),
(2, '8.00', '2019-11-05'),
(3, '8.00', '2019-11-06'),
(4, '8.00', '2019-11-07'),
(5, '8.00', '2019-11-08'),
(6, '8.00', '2019-11-09');

INSERT INTO `tbl_control_horas_trabajador` (`id_control_horas_trabajador`,  `id_trabajador`, `id_control_horas`) 
VALUES (NULL, 1, 1),
(NULL, 1, 2),
(NULL, 1, 3),
(NULL, 1, 4),
(NULL, 1, 5),
(NULL, 1, 6),
(NULL, 2, 1),
(NULL, 2, 2),
(NULL, 2, 3),
(NULL, 2, 4),
(NULL, 2, 5),
(NULL, 2, 6),
(NULL, 3, 1),
(NULL, 3, 2),
(NULL, 3, 3),
(NULL, 3, 4),
(NULL, 3, 5),
(NULL, 3, 6),
(NULL, 4, 1),
(NULL, 4, 2),
(NULL, 4, 3),
(NULL, 4, 4),
(NULL, 4, 5),
(NULL, 4, 6),
(NULL, 5, 1),
(NULL, 5, 2),
(NULL, 5, 3),
(NULL, 5, 4),
(NULL, 5, 5),
(NULL, 5, 6),
(NULL, 6, 1),
(NULL, 6, 2),
(NULL, 6, 3),
(NULL, 6, 4),
(NULL, 6, 5),
(NULL, 6, 6),
(NULL, 7, 1),
(NULL, 7, 2),
(NULL, 7, 3),
(NULL, 7, 4),
(NULL, 7, 5),
(NULL, 7, 6);