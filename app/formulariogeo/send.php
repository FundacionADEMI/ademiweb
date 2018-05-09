<?php
include 'conexion.php';

$nombre=$_POST["nombre"];
$apellido= $_POST["apellido"];
$rubro=$_POST["rubro"];
$correo=$_POST["correo"];
$telefono=$_POST["telefono"];
$direccion=$_POST["direccion"];
$nombref=$_POST["nombref"];
$cuit=$_POST["cuit"];
$latitud=$_POST["latitud"];
$longitud=$_POST["longitud"];


echo $nombre, $apellido , $rubro, $correo, $telefono, $direccion, $nombref, $cuit, $latitud, $longitud;



mysql_query(" INSERT INTO emprendedores (nombre,apellido,rubro,correo,telefono,direccion,nombref,cuit,latitud,longitud) 
('$nombre', '$apellido','$rubro','$correo','$telefono','$direccion','$nombref','$cuit','$latitud','$longitud'); ") or die("Error en:" . mysql_error());

				

$cuerpo .= "Nombre: " . $nombre ."\n";
$cuerpo .= "Apellido: " . $apellido ."\n";
$cuerpo .= "Rubro: " . $rubro ."\n";
$cuerpo .= "Correo: " . $correo ."\n";
$cuerpo .= "Telefono: " . $telefono ."\n";

$cuerpo .= "Direccion: " . $direccion ."\n";
$cuerpo .= "Nombre de la Empresa: " . $nombref ."\n";
$cuerpo .= "CUIT: " . $cuit ."\n";
$cuerpo .= "Latitud: " . $latitud ."\n";
$cuerpo .= "Longitud: " .$longitud ."\n";
 
 echo $cuerpo;
//Nota. Cabeceras para el env&#8730;&#8800;o en formato HTML. 
$headers = "MIME-Version: 1.0";
$headers .= "Content-type: text/html; charset=charset=UTF-8"; 
//Nota. Direcci&#8730;&#8805;n del remitente. 

//Nota. Direcci&#8730;&#8805;n de respuesta. 
$headers .= "Reply-To: info@agenciamisiones.org.ar ";
mail("app@agenciamisiones.org.ar,aleavellaneda1@gmai.com,sistema@agenciamisiones.org.ar","",$cuerpo,$headers);
header('Location: gracias.php');