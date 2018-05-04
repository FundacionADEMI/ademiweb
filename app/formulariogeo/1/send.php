<?php
//avellaneda alejandro 2017 @aleavellaneda1
include 'conexion.php';
//Nota. Cuerpo o contenido del mensaje. 

$nombre= $_POST["nombre"];
$apellido= $_POST["apellido"];
$correo=$_POST["correo"];
$telefono=$_POST["telefono"];
$localidad=$_POST["localidad"];
$direccion=$_POST["direccion"];
$cuit=$_POST["cuit"];
$nombref=$_POST["nombref"];
$latitud=$_POST["latitud"];
$longitud=$_POST["longitud"];


  mysql_query(" INSERT INTO emprendedores (nombre,apellido,correo,telefono,localidad,direccion,cuit,nombref,latitud,longitud) VALUES ('$nombre', '$apellido','$correo','$telefono','$localidad','$direccion','$cuit','$nombref','$latitud','$longitud'); ") or die("Error en:" . mysql_error());

				

$cuerpo .= "Nombre: " . $_POST["nombre"] ."\n";
$cuerpo .= "Apellido: " . $_POST["apellido"] ."\n";
$cuerpo .= "Correo: " . $_POST["correo"] ."\n";
$cuerpo .= "Telefono: " . $_POST["telefono"] ."\n";
$cuerpo .= "Localidad: " . $_POST["localidad"] ."\n";
$cuerpo .= "Direccion: " . $_POST["direccion"] ."\n";
$cuerpo .= "CUIT: " . $_POST["cuit"] ."\n";
$cuerpo .= "Nombre de la Empresa: " . $_POST["nombref"] ."\n";
$cuerpo .= "Latitud: " . $_POST["latitud"] ."\n";
$cuerpo .= "Longitud: " . $_POST["longitud"] ."\n";
 
//Nota. Cabeceras para el env&#8730;&#8800;o en formato HTML. 
$headers = "MIME-Version: 1.0";
$headers .= "Content-type: text/html; charset=charset=UTF-8"; 
//Nota. Direcci&#8730;&#8805;n del remitente. 

//Nota. Direcci&#8730;&#8805;n de respuesta. 
$headers .= "Reply-To: info@agenciamisiones.org.ar ";
mail("app@agenciamisiones.org.ar,sistemas@agenciamisiones.org.ar","",$cuerpo,$headers);
header('Location: gracias.php');

?>
