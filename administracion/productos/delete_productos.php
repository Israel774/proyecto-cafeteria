 <?php
include("../../conexion/conexion.php");

$id_productos = $_GET["id_productos"];

// Eliminar lógicamente: poner estado en 0 (inactivo)
$sql = "UPDATE productos SET estado = 0 WHERE id_productos = '$id_productos'";
$res = mysqli_query($conn, $sql);

if ($res) {
    header("Location: productos_registrados.php"); // Redirige de vuelta al listado
    exit();
} else {
    // Puedes agregar un mensaje de error si quieres
    echo "Error al desactivar usuario.";
}
?>

