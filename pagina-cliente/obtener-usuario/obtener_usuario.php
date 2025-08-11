<?php
session_start();
require_once '../conexion/conexion.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    echo "No ha iniciado sesión";
    exit();
}

$id_usuario = (int)$_SESSION['id_usuario'];

// Verifica si el usuario está activo
if ($_SESSION['estado'] != 'Activo') {
    echo "<script>alert('Cuenta inactiva. Consulta con los administradores si se trata de algun error'); window.history.back();</script>";
    exit();
}

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
    $stmt_cliente = $conn->prepare("SELECT id_cliente, saldo FROM clientes WHERE nickname = ?");
    $stmt_cliente->bind_param("s", $nickname);
    $stmt_cliente->execute();
    $result_cliente = $stmt_cliente->get_result();

    if ($row_cliente = $result_cliente->fetch_assoc()) {
        $id_cliente = $row_cliente['id_cliente'];
        $saldo = $row_cliente['saldo'];

        // --- TERCERA CONSULTA: Obtener historial de compras ---
        $stmt_compras = $conn->prepare("SELECT DATE(create_at) AS fecha, total_pagado, id_venta FROM ventas WHERE id_cliente = ? ORDER BY create_at DESC");
        $stmt_compras->bind_param("i", $id_cliente);
        $stmt_compras->execute();
        $result_compras = $stmt_compras->get_result();

        // --- CUARTA CONSULTA: Obtener historial de recargas ---
        $stmt_recargas = $conn->prepare("SELECT DATE(create_at) AS fecha, salanterior, saltotal, salrecarga, metodoPago, id_recarga FROM recarga WHERE FK_cliente = ? ORDER BY create_at DESC");
        $stmt_recargas->bind_param("i", $id_cliente);
        $stmt_recargas->execute();
        $result_recargas = $stmt_recargas->get_result();
    } else {
        $saldo = 0;
        $id_cliente = null;
        $result_compras = null;
        $result_recargas = null;
    }
    $stmt_cliente->close();
    $nombre_completo = $nombre_usuario . ' ' . $apellido_usuario;
} else {
    $nombre_completo = "Usuario desconocido";
    $saldo = 0;
    $id_cliente = null;
    $result_compras = null;
    $result_recargas = null;
}

$stmt->close();
$conn->close();
?>