<?php
require "conexion.php";
$encargado = trim($_POST['encargado']);
$metodo_de_pago = trim($_POST['metodo_de_pago']);
$proveedor = trim($_POST['proveedor']);
$total_compra = trim($_POST['total_compra']);
$observaciones = trim($_POST['observaciones']);
$estado = trim($_POST['estado']);

$sql = "INSERT INTO compras_cole(encargado, metodo_de_pago, proveedor, total_compra, observaciones, estado, createAt ) 
values ('$encargado','$metodo_de_pago', '$proveedor', '$total_compra', '$observaciones','$estado', now() )";

if ($conn->query($sql) === TRUE) {
    header("Location: detalle_compras.php");
    exit(); // Asegurar que el script se detenga aquí
} else {
    echo "Error: " . $conn->error;
}
?>