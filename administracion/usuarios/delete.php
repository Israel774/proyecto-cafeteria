<?php
include("../../conexion/conexion.php");
$id = $_GET["id"];
$sql = "DELETE FROM usuario WHERE id_usuario = '$id'";
$res = mysqli_query($conn, $sql);
if($res){
    header("Location:registro.php");
}else{

}
?>  