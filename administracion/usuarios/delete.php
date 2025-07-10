<?php
include("../../conexion/conexion.php");
$id_usuario = $_GET["id_usuario"];
$sql = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";
$res = mysqli_query($conn, $sql);
if($res){
    header("Location:registro.php");
}else{

}
?>  