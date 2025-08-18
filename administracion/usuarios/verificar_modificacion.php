<?php
header('Content-Type: application/json');

include("../../conexion/conexion.php");
$conn = conectar();

$modificacion = $_GET['modificacion'] ?? '';

$existe = false;
if (!empty($modificacion)) {
    // Escapa la entrada para prevenir inyección SQL
    $modificacion_segura = mysqli_real_escape_string($conn, $modificacion);
    $sql = "SELECT COUNT(*) AS count FROM usuario WHERE modificacion = '$modificacion_segura'";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila['count'] > 0) {
        $existe = true;
    }
}

echo json_encode(['existe' => $existe]);

mysqli_close($conn);
?>