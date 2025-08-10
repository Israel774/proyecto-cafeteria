<?php
session_start();
require "../../conexion/conexion.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../login.php");
    exit();
}

$nombre       = trim($_POST['nombre']);
$apellido     = trim($_POST['apellido']);
$telefono     = trim($_POST['telefono']);
$tipo         = trim($_POST['tipo']);
$correo       = trim($_POST['correo']);
$estado       = 'Activo'; 
$codigobarra  = trim($_POST['codigobarra']);
$nickname     = trim($_POST['nickname']);
$contraseña   = trim($_POST['contraseña']);
$modificacion = trim($_POST['modificacion']);

$create_by = $_SESSION['id_usuario'];

$sql_check_nickname = "SELECT COUNT(*) AS count FROM usuario WHERE nickname = '$nickname'";
$result_nickname = $conn->query($sql_check_nickname);
$row_nickname = $result_nickname->fetch_assoc();

if ($row_nickname['count'] > 0) {
    echo "<script>alert('El nickname ya está en uso. Por favor elige otro.'); window.history.back();</script>";
    exit();
}

$sql = "INSERT INTO usuario(
    nombre, apellido, telefono, tipo, correo, estado, codigobarra, nickname, contraseña, modificacion, Create_by, Create_at
) VALUES (
    '$nombre', '$apellido', '$telefono', '$tipo', '$correo', '$estado', '$codigobarra', '$nickname', '$contraseña', '$modificacion', '$create_by',  NOW()
)";

$sql2 = "INSERT INTO clientes(
    nombre, apellido, nickname, saldo, estado_de_tarjeta, Create_by, Create_at
) VALUES (
    '$nombre', '$apellido', '$nickname', 0, 'Activo', '$create_by', NOW()
)";

if ($conn->query($sql) && $conn->query($sql2)) {
    header("Location: registrar.php");
    exit();
} else {
    echo "Error al registrar usuario: " . $conn->error;
}
?>
