<?php
session_start();
require_once '.././conexion/conexion.php'; // Asegúrate de que esta ruta sea correcta

if (!isset($_SESSION['id_usuario'])) {
    echo "No ha iniciado sesión";
    exit();
}

$id_usuario = (int)$_SESSION['id_usuario'];

// --- PRIMERA CONSULTA: Obtener nombre, apellido, nickname ---
$stmt = $conn->prepare("SELECT nombre, apellido, nickname FROM usuario WHERE id_usuario = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {

    $nombre_usuario = $row['nombre'];
    $apellido_usuario = $row['apellido'];
    $nickname = $row['nickname'];

    // --- SEGUNDA CONSULTA: Obtener datos de cliente ---
    // Prepara la consulta para obtener el dato del cliente usando el nickname
    $stmt_cliente = $conn->prepare("SELECT * FROM clientes WHERE nickname = ?");
    $stmt_cliente->bind_param("s", $nickname); // "s" porque nickname es un string
    $stmt_cliente->execute();
    $result_cliente = $stmt_cliente->get_result();

    // Verifica si se encontró datos del cliente
    if ($row_cliente = $result_cliente->fetch_assoc()) {
        $saldo = $row_cliente['saldo']; // Aquí obtienes el valor del saldo

        $id_cliente = $row_cliente['id_cliente'];

        // --- TERCERA CONSULTA: Obtener datos para el historial de compras ---
        // Prepara la consulta para obtener los datos de las compras
        $stmt_compras = $conn->prepare("SELECT DATE(create_at) AS fecha, total_pagado, id_venta FROM ventas WHERE id_cliente = ?");
        $stmt_compras->bind_param("i", $id_cliente);
        $stmt_compras->execute();
        $result_compras = $stmt_compras->get_result();



    } else {
        $saldo = 0; // O un valor predeterminado si no se encuentra el saldo
    }
    $stmt_cliente->close();


    $nombre_completo = $nombre_usuario . ' ' . $apellido_usuario;

} else {
    $nombre_completo = "Usuario desconocido";
    $saldo = 0; // También inicializa el saldo si el usuario es desconocido
}

$stmt->close(); // Cierra el statement de usuario
$conn->close(); // Cierra la conexión a la base de datos

?>