<?php
require "../../conexion/conexion.php";
$barras = $_POST["codigobarra"];
$salanterior = $_POST["saldo"];
$saltotal = $_POST["saltotal"];
$salrecarga = $_POST["salrecarga"];
$metodoPago = $_POST["metodoPago"];
$FK_recibo = $_POST["FK_recibo"];
//IMPRIMIR INFO EN PANTALLA
//echo "Hola ".$nombre


$sql = "INSERT INTO recarga (barras, salanterior, saltotal, salrecarga, metodoPago, FK_recibo, create_at) VALUES ('$barras', '$salanterior','$saltotal', '$salrecarga', '$metodoPago', '$FK_recibo', now())";
//$resultado = $conn->query($sql);
if($conn->query($sql)){
    header("Location: recarga.php");
}else{

}

?>