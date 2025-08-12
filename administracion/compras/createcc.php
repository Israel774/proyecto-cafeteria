<?php
require "../../conexion/conexion.php";

$fk_compras = trim($_POST['id_compra']); // ID de la compra a la que pertenece este detalle
$fk_producto = trim($_POST['fk_producto']);
$cantidad = trim($_POST['cantidad']);
$unidad_de_medida = trim($_POST['unidad_de_medida']);
$precio = trim($_POST['precio']);
$caducidad = trim($_POST['caducidad']);
$codigo_de_barras = trim($_POST['codigo_de_barras']);

// Calcular subtotal (cantidad * precio)
$sub_total = $cantidad * $precio;

$sql = "INSERT INTO detalle_compras 
        (estado, fk_compras, fk_producto, cantidad, unidad_de_medida, precio, caducidad, codigo_de_barras, sub_total, createAt) 
        VALUES 
        ('1', '$fk_compras', '$fk_producto', '$cantidad', '$unidad_de_medida', '$precio', '$caducidad', '$codigo_de_barras', '$sub_total', NOW())";

if ($conn->query($sql) === TRUE) {
    header("Location: listado.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
