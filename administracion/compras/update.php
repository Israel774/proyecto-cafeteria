<?php
require "../../conexion/conexion.php";
$encargado = trim($_POST['encargado']);
$metodo_de_pago = trim($_POST['metodo_de_pago']);
$fk_proveedor = trim($_POST['fk_proveedor']);
$total_compra = trim($_POST['total_compra']);
$observaciones = trim($_POST['observaciones']);

$sql = "UPDATE compras SET encargado ='$encargado', 
    metodo_de_pago = '$metodo_de_pago', fk_proveedor = '$fk_proveedor', total_compra = '$total_compra',
     observaciones = '$observaciones' WHERE id_compras = '$id_compras'";

$r = mysqli_query($conn, $sql);
if($r){
    header("Location: listado.php");
}else{

}


?>