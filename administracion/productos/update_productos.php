<?php
include("../../conexion/conexion.php");
$conn = conectar();
session_start();

// Obtener datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fk_proveedor = $_POST['fk_proveedor'];
$tipo_producto = $_POST['tipo_producto'];
$codigo_barra = $_POST['codigobarra'];
$descripcion = $_POST['descripcion'];
$imagen_actual = $_POST['imagen_actual'];
$update_by = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;
$update_at = date("Y-m-d H:i:s");

// Verificar si se subió una nueva imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
    $nombre_imagen_original = $_FILES['imagen']['name'];
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    $extension = pathinfo($nombre_imagen_original, PATHINFO_EXTENSION);

    // Crear nuevo nombre único
    $fecha_actual = date("Ymd_His");
    $nuevo_nombre_imagen = "img_" . $fecha_actual . "." . $extension;

    // Ruta relativa para guardar en BD
    $ruta_relativa = "imagenes/" . $nuevo_nombre_imagen;

    // Ruta física para mover el archivo
    $destino = "../../" . $ruta_relativa;

    // Mover la imagen
    move_uploaded_file($ruta_temporal, $destino);

    // Eliminar la imagen anterior si existe
    if (!empty($imagen_actual) && file_exists("../../" . $imagen_actual)) {
        unlink("../../" . $imagen_actual);
    }
} else {
    // Mantener la imagen actual si no se sube una nueva
    $ruta_relativa = $imagen_actual;
}

// Consulta de actualización
$sql = "UPDATE productos SET 
    nombre = '$nombre',
    precio = '$precio',
    stock = '$stock',
    fk_proveedor = '$fk_proveedor',
    tipo_producto = '$tipo_producto',
    codigo_barra = '$codigo_barra',
    descripcion = '$descripcion',
    imagen = '$ruta_relativa',
    update_by = '$update_by',
    update_at = '$update_at'
    WHERE id_productos = '$id'";

$r = mysqli_query($conn, $sql);

if ($r) {
    header("Location: productos_registrados.php");
} else {
    echo "Error al actualizar: " . mysqli_error($conn);
}
?>
