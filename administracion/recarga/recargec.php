<?php
session_start(); // Importante para acceder a $_SESSION

require "../../conexion/conexion.php";

$barras      = $_POST["codigobarra"];
$nombre      = $_POST["nombre"];
$apellido    = $_POST["apellido"];
$salanterior = $_POST["saldo"];
$saltotal    = $_POST["saltotal"];
$salrecarga  = $_POST["salrecarga"];
$metodoPago  = $_POST["metodoPago"];

// Usuario que hace la recarga
$created_by = $_SESSION['nickname']; // o $_SESSION['id_usuario'] si usas IDs

// Insertar con create_by
$sql = "INSERT INTO recarga (
            barras, nombre, apellido, salanterior, saltotal, salrecarga, metodoPago, estado, create_at, create_by
        ) VALUES (
            '$barras', '$nombre', '$apellido', '$salanterior', '$saltotal', '$salrecarga', '$metodoPago', 1, NOW(), '$created_by'
        )";

// Ejecutar inserción
if ($conn->query($sql)) {
    // Actualizar saldo del cliente
    $sqlUpdate = "UPDATE recarga r
                  INNER JOIN usuario u ON u.codigobarra = r.barras
                  INNER JOIN clientes c ON u.nickname = c.nickname
                  SET c.saldo = $saltotal
                  WHERE r.barras = '$barras'";
    
    if ($conn->query($sqlUpdate)) {
        header("Location: recarga.php");
    } else {
        echo "Error al actualizar saldo: " . $conn->error;
    }
} else {
    echo "Error al insertar recarga: " . $conn->error;
}
?>
