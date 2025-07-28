<?php
include("conexion.php");
$id = $_GET["id"];
$sql = "DELETE FROM detalle_ventas WHERE id = '$id'";
$res = mysqli_query($conn, $sql);
if ($res) {
    header("Location: ReporteDeVentas.php");
    exit();
}
?>
