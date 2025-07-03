<?php
require "../../conexion/conexion.php";
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$tipo = $_POST['tipo'];
$correo = $_POST['correo'];
$estado = $_POST['estado'];
$codigobarra = $_POST['codigobarra'];
$nickname = $_POST['nickname'];
$contraseña = $_POST['contraseña'];
$Create_by = $_POST['Create_by'];
$Update_at = $_POST['Update_at'];


//imprimir en pantalla
//echo "Hola " . $nombre;

$sql = "INSERT INTO usuario(nombre, apellido, telefono, tipo, correo, estado, codigobarra, nickname, contraseña, Create_by, Update_at) VALUES ('$nombre', '$apellido', '$telefono',
'$tipo', '$correo', '$estado', '$codigobarra', '$nickname', '$contraseña', '$Create_by', '$Update_at')";
$sql2 = "INSERT INTO clientes(nombre, apellido, nickname, saldo, estado_de_tarjeta, Create_by, Update_at) VALUES ('$nombre', '$apellido', '$nickname', '0', 'Activo', '$Create_by', '$Update_at')";
if((($conn ->query($sql))) && (($conn ->query($sql2)))){
    header("Location: registrar.php");

}else{

}

?>