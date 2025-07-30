<?php 
include("../../conexion/conexion.php");
    $id_proveedor = $_GET["id_proveedor"];
   
    
$sql = "UPDATE proveedor SET activo='0' WHERE id_proveedor = '$id_proveedor' ";
    $res = mysqli_query($conn, $sql);
    if($res){
        header("Location:listado_proveedor.php");
    }else{
    }
?>