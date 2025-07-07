<?php
session_start();
require "../../conexion/conexion.php";
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$tipo = $_POST['tipo'];
$correo = $_POST['correo'];
$estado = $_POST['estado'];
$codigobarra = $_POST['codigobarra'];
$nickname = $_POST['nickname'];
$contraseña = hash('sha512', $_POST['contraseña']);
$create_by = $_SESSION['id_usuario'];


//imprimir en pantalla
//echo "Hola " . $nombre;

$sql = "INSERT INTO usuario(nombre, apellido, telefono, tipo, correo, estado, codigobarra, nickname, contraseña, Create_by, Create_at) VALUES ('$nombre', '$apellido', '$telefono',
'$tipo', '$correo', '$estado', '$codigobarra', '$nickname', '$contraseña', '$create_by', now())";
$sql2 = "INSERT INTO clientes(nombre, apellido, nickname, saldo, estado_de_tarjeta, Create_by, Create_at) VALUES ('$nombre', '$apellido', '$nickname', '0', 'Activo', '$create_by', now())";
if((($conn ->query($sql))) && (($conn ->query($sql2)))){
    header("Location: registrar.php");

}else{

}

?>