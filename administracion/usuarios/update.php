<?php 
include("conexion.php");
$id=$_POST["id"];
$nombre=$_POST["nombre"];
$apellido=$_POST["apellido"];
$telefono=$_POST["telefono"];
$tipo=$_POST["tipo"];
$correo=$_POST["correo"];
$estado=$_POST["estado"];
$codigobarra=$_POST["codigobarra"];
$nickname=$_POST["nickname"];
$contraseña=$_POST["contraseña"];
$modificacion=$_POST["modificacion"];


$sql = "UPDATE usuarios SET nombre ='$nombre', 
    apellido = '$apellido', telefono = '$telefono', tipo = '$tipo',
     correo = '$correo', estado = '$estado',
     codigobarra='$codigobarra', nickname='$nickname',
    contraseña = '$contraseña', modificacion = '$modificacion' WHERE id = '$id'";

$r = mysqli_query($conn, $sql);
if($r){
    header("Location: registro.php");
}else{

}


?>