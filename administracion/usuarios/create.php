<?php
session_start();
require "../../conexion/conexion.php";

// Verifica que el usuario esté logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../login.php");
    exit();
}

// Limpiar espacios en blanco al inicio y final
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$telefono = trim($_POST['telefono']);
$tipo = trim($_POST['tipo']);
$correo = trim($_POST['correo']);
$estado = trim($_POST['estado']);
$codigobarra = trim($_POST['codigobarra']);
$nickname = trim($_POST['nickname']);
$contraseña = trim($_POST['contraseña']);

// Encriptar la contraseña
$contraseña = hash('sha512', $contraseña);

// Obtener ID del usuario que registra
$create_by = $_SESSION['id_usuario'];

// Verificar si ya existe el nickname
$sql_check_nickname = "SELECT COUNT(*) AS count FROM usuario WHERE nickname = '$nickname'";
$result_nickname = $conn->query($sql_check_nickname);
$row_nickname = $result_nickname->fetch_assoc();

if ($row_nickname['count'] > 0) {
    // Nickname ya existe
    echo "<script>alert('El nickname ya está en uso. Por favor elige otro.'); window.history.back();</script>";
    exit();
}

// Consulta para insertar en la tabla usuario
$sql = "INSERT INTO usuario(
    nombre, apellido, telefono, tipo, correo, estado, codigobarra, nickname, contraseña, Create_by, Create_at
) VALUES (
    '$nombre', '$apellido', '$telefono', '$tipo', '$correo', '$estado', '$codigobarra', '$nickname', '$contraseña', '$create_by', NOW()
)";

// Consulta para insertar en la tabla clientes
$sql2 = "INSERT INTO clientes(
    nombre, apellido, nickname, saldo, estado_de_tarjeta, Create_by, Create_at
) VALUES (
    '$nombre', '$apellido', '$nickname', 0, 'Activo', '$create_by', NOW()
)";

// Ejecutar ambas consultas
if ($conn->query($sql) && $conn->query($sql2)) {
    header("Location: registrar.php");
    exit();
} else {
    echo "Error al registrar usuario: " . $conn->error;
}
?>
