<?php
require "conexion.php";
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$tipo = $_POST['tipo'];
$correo = $_POST['correo'];
$estado = $_POST['estado'];
$codigobarra = $_POST['codigobarra'];
$nickname = $_POST['nickname'];
$contraseña = $_POST['contraseña'];



//imprimir en pantalla
//echo "Hola " . $nombre;

$sql = "INSERT INTO usuarios(nombre, apellido, telefono, tipo, correo, estado, codigobarra, nickname, contraseña) VALUES ('$nombre', '$apellido', '$telefono',
'$tipo', '$correo', '$estado', '$codigobarra', '$nickname', '$contraseña')";
if($conn ->query($sql)){
    header("Location: registrar.php");

}else{

}

?>