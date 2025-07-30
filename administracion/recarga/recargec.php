<?php
require "../../conexion/conexion.php";
$barras = $_POST["codigobarra"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$salanterior = $_POST["saldo"];
$saltotal = $_POST["saltotal"];
$salrecarga = $_POST["salrecarga"];
$metodoPago = $_POST["metodoPago"];


//IMPRIMIR INFO EN PANTALLA
//echo "Hola ".$nombre

$sql = "INSERT INTO recarga (barras, nombre, apellido, salanterior, saltotal, salrecarga, metodoPago, estado, create_at) VALUES ('$barras', '$nombre', '$apellido', '$salanterior','$saltotal', '$salrecarga', '$metodoPago', 1, now())";


//$resultado = $conn->query($sql);
if($conn->query($sql)){
    //header("Location: recarga.php");
    $sql = "UPDATE recarga r
INNER JOIN usuario u ON u.codigobarra = r.barras
INNER JOIN clientes c ON u.nickname = c.nickname
SET c.saldo = $saltotal;";
if($conn->query($sql)){
    header("Location: recarga.php");
}else{

}
    
}else{

}

?>