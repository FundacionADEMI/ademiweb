<?php
	$conect=@mysql_connect("localhost","cl000468_geo","fi14doGOwa") or die("Error en el servidor de base de datos de tudexagames");
    mysql_select_db("cl000468_geo",$conect) or die("Error con la conexion de base de datos");

?>

INSERT INTO emprendedores (nombre,apellido,rubro,correo,telefono,direccion,nombref,cuit,latitud,longitud) 
('$nombre', '$apellido','$rubro','$correo','$telefono','$direccion','$nombref','$cuit','$latitud','$longitud'); 