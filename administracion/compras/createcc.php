<?php
require "../../conexion/conexion.php";
$fk_producto = trim($_POST['fk_producto']);
$cantidad = trim($_POST['cantidad']);
$unidad_de_medida = trim($_POST['unidad_de_medida']);
$precio = trim($_POST['precio']);
$caducidad = trim($_POST['caducidad']);
$codigo_de_barras = trim($_POST['codigo_de_barras']);
$sub_total = trim($_POST['sub_total']);


$sql = "INSERT INTO detalle_compras(fk_producto, cantidad, unidad_de_medida, precio, caducidad, codigo_de_barras, sub_total, createAt ) 
values ('$fk_producto','$cantidad', '$unidad_de_medida', '$precio', '$caducidad','$codigo_de_barras','$sub_total', now() )";

if ($conn->query($sql) === TRUE) {
    header("Location: listado.php");
    exit(); // Asegurar que el script se detenga aquí
} else {
    echo "Error: " . $conn->error;
}
?>