<?php 
include("../../conexion/conexion.php");
$conn = conectar();
    $id_compras = $_GET["id_compras"];
   
    
$sql = "UPDATE compras SET activo='0' WHERE id_compras = '$id_compras' ";
    $res = mysqli_query($conn, $sql);
    if($res){
        header("Location:listado.php");
    }else{
    }
?>