<?php
require "../../conexion/conexion.php";
$encargado = trim($_POST['encargado']);
$metodo_de_pago = trim($_POST['metodo_de_pago']);
$fk_proveedor = trim($_POST['fk_proveedor']);
$total_compra = trim($_POST['total_compra']);
$observaciones = trim($_POST['observaciones']);


$sql = "INSERT INTO compras(encargado, metodo_de_pago, fk_proveedor, total_compra, observaciones, createAt ) 
values ('$encargado','$metodo_de_pago', '$fk_proveedor', '$total_compra', '$observaciones', now() )";

if ($conn->query($sql) === TRUE) {
    header("Location: detalle_compras.php");
    exit(); // Asegurar que el script se detenga aquí
} else {
    echo "Error: " . $conn->error;
}
?>