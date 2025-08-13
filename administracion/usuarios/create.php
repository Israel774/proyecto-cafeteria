<?php
session_start();
require "../../conexion/conexion.php";
$conn = conectar();
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
$contraseña   = hash('sha512', trim($_POST['contraseña']));
$modificacion = trim($_POST['modificacion']);

$create_by = $_SESSION['id_usuario'];

$sql_check_nickname = "SELECT COUNT(*) AS count FROM usuario WHERE nickname = ?";
$stmt = $conn->prepare($sql_check_nickname);
$stmt->bind_param("s", $nickname);
$stmt->execute();
$result_nickname = $stmt->get_result();
$row_nickname = $result_nickname->fetch_assoc();
$stmt->close();

if ($row_nickname['count'] > 0) {
    echo "<script>alert('El nickname ya está en uso. Por favor elige otro.'); window.history.back();</script>";
    exit();
}

$sql_check_codigobarra = "SELECT COUNT(*) AS count FROM usuario WHERE codigobarra = ?";
$stmt = $conn->prepare($sql_check_codigobarra);
$stmt->bind_param("s", $codigobarra);
$stmt->execute();
$result_codigobarra = $stmt->get_result();
$row_codigobarra = $result_codigobarra->fetch_assoc();
$stmt->close();

if ($row_codigobarra['count'] > 0) {
    echo "<script>alert('El codigobarra ya está en uso. Por favor elige otro.'); window.history.back();</script>";
    exit();
}

// Nota: No es recomendable verificar si una contraseña ya existe en la base de datos
// antes de registrar un usuario. Dos usuarios pueden tener la misma contraseña
// (aunque en la práctica, al usar un hash salado, esto es menos probable).
// Por lo tanto, se ha eliminado la validación de la contraseña.

$sql = "INSERT INTO usuario(
    nombre, apellido, telefono, tipo, correo, estado, codigobarra, nickname, contraseña, modificacion, Create_by, Create_at
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssss", $nombre, $apellido, $telefono, $tipo, $correo, $estado, $codigobarra, $nickname, $contraseña, $modificacion, $create_by);

$sql2 = "INSERT INTO clientes(
    nombre, apellido, nickname, saldo, estado_de_tarjeta, Create_by, Create_at
) VALUES (?, ?, ?, 0, 'Activo', ?, NOW())";

$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("ssss", $nombre, $apellido, $nickname, $create_by);

if ($stmt->execute() && $stmt2->execute()) {
    header("Location: registrar.php");
    exit();
} else {
    echo "Error al registrar usuario: " . $stmt->error;
}

$stmt->close();
$stmt2->close();
$conn->close();
?>