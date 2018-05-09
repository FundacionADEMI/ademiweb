<?php

/// CREATE TABLE IF NOT EXISTS `emprendedores` (
///  `id` int(11) NOT NULL AUTO_INCREMENT,
///  `nombre` char(255) DEFAULT NULL,
///  `apellido` char(255) DEFAULT NULL,
///  `rubro` char(255) DEFAULT NULL,
///  `correo` char(255) DEFAULT NULL,
///  `telefono` bigint(20) DEFAULT NULL,
///  `direccion` char(255) DEFAULT NULL,
///  `nombref` char(255) DEFAULT NULL,
///  `cuit` bigint(20) DEFAULT NULL,
///  `latitud` char(255) DEFAULT NULL,
///  `longitud` char(255) DEFAULT NULL,
///  PRIMARY KEY (`id`)
///) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;




	$conect=@mysql_connect("localhost","cl000468_geo","fi14doGOwa") or die("Error en el servidor de base de datos de tudexagames");
    mysql_select_db("cl000468_geo",$conect) or die("Error con la conexion de base de datos");

?>