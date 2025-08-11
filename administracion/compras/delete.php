<?php
include("../../conexion/conexion.php");
$id_compras = $_GET["id_compras"];
$sql = "DELETE FROM compras WHERE id_compras = '$id_compras'";
$res = mysqli_query($conn, $sql);
if($res){
    header("Location:listado.php");
}else{

}
?>  