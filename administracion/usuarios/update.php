<?php 
include("../../conexion/conexion.php");
$conn = conectar();
$id_usuario     = $_POST["id"];
$nombre         = $_POST["nombre"];
$apellido       = $_POST["apellido"];
$telefono       = $_POST["telefono"];
$tipo           = $_POST["tipo"];
$correo         = $_POST["correo"];
$estado         = $_POST["estado"]; 
$codigobarra    = $_POST["codigobarra"];
$nickname       = $_POST["nickname"];
$contraseña     = hash('sha512', $_POST["contraseña"]);
$contraseña_plana = $_POST["contraseña"];
$modificacion   = $_POST["modificacion"];

$sql_usuario = "UPDATE usuario SET 
    nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', tipo = '$tipo', correo = '$correo', 
    estado = '$estado', codigobarra = '$codigobarra', nickname = '$nickname', contraseña = '$contraseña', contraseña_plano = '$contraseña_plana', modificacion = '$modificacion' 
    WHERE id_usuario = '$id_usuario'";

$r1 = mysqli_query($conn, $sql_usuario);

$sql_cliente = "UPDATE clientes SET 
    estado_de_tarjeta = '$estado' 
WHERE nickname = '$nickname'";

$r2 = mysqli_query($conn, $sql_cliente);

if ($r1 && $r2) {
    header("Location: registro.php");
    exit();
} else {
    echo "Error al actualizar: " . mysqli_error($conn);
}
?>
