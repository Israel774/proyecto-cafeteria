<?php 
include("../../conexion/conexion.php");
$conn = conectar();
$id_proveedor=$_POST["id_proveedor"];  
$Nombre = $_POST['Nombre'];
$Direccion = $_POST['Direccion'];
$Tipo_Producto = $_POST['Tipo_Producto'];
$Notelef_ficina = $_POST['Notelef_ficina'];
$Nombre_De_Repartidor = $_POST['Nombre_De_Repartidor'];
$Notelef_Repartidor = $_POST['Notelef_Repartidor'];
$Tipo_De_Pago = $_POST['Tipo_De_Pago'];
$NitProveedor = $_POST['NitProveedor'];


$sql = "UPDATE proveedor SET Nombre ='$Nombre', 
    Direccion = '$Direccion', Tipo_Producto = '$Tipo_Producto', Notelef_ficina = '$Notelef_ficina',
     Nombre_De_Repartidor = '$Nombre_De_Repartidor', Notelef_Repartidor = '$Notelef_Repartidor',
     Tipo_De_Pago='$Tipo_De_Pago', NitProveedor='$NitProveedor'
     WHERE id_proveedor = '$id_proveedor'"
     ;

$r = mysqli_query($conn, $sql);
if($r){
    header("Location: listado_proveedor.php");
}else{

}


?>