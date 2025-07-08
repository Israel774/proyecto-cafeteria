


<?php
require "../conexion/conexion.php";

// Obtener datos del formulario
$Nombre = $_POST['Nombre'];
$Direccion = $_POST['Direccion'];
$Tipo_Producto = $_POST['Tipo_Producto'];
$Notelef_ficina = $_POST['Notelef_ficina'];
$Nombre_De_Repartidor = $_POST['Nombre_De_Repartidor'];
$Notelef_Repartidor = $_POST['Notelef_Repartidor'];
$Tipo_De_Pago = $_POST['Tipo_De_Pago'];
$NitProveedor = $_POST['NitProveedor'];



// Crear consulta SQL
$sql = "INSERT INTO proveedor(Nombre, Direccion, Tipo_Producto, Notelef_ficina, Nombre_De_Repartidor, Notelef_Repartidor, Tipo_De_Pago, NitProveedor)
     VALUES (
    '$Nombre', '$Direccion', '$Tipo_Producto', '$Notelef_ficina', '$Nombre_De_Repartidor','$Notelef_Repartidor', '$Tipo_De_Pago', '$NitProveedor')";


if ($conn->query($sql)) {
    header("Location: proveedor.php");
    exit();
} else {
   
}
?>
