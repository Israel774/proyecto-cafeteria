<?php
require "../../conexion/conexion.php";

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fk_proveedor = $_POST['fk_proveedor'];
$tipo_producto = $_POST['tipo_producto'];
$codigo_barra = $_POST['codigo_barra'];
$descripcion = $_POST['descripcion'];

// Recibir la imagen
$nombre_imagen_original = $_FILES['imagen']['name'];
$ruta_temporal = $_FILES['imagen']['tmp_name'];
$extension = pathinfo($nombre_imagen_original, PATHINFO_EXTENSION);

// Crear nuevo nombre con fecha y hora
$fecha_actual = date("Ymd_His");
$nuevo_nombre_imagen = "img_" . $fecha_actual . "." . $extension;

// **Ruta relativa que se guardará en la base de datos**
$ruta_relativa = "imagenes/" . $nuevo_nombre_imagen;

// Ruta física para mover el archivo (ajustar según la estructura de carpetas)
$destino = "../../" . $ruta_relativa;

// Mover imagen a la carpeta
move_uploaded_file($ruta_temporal, $destino);

// Insertar en la base de datos la ruta relativa
$sql = "INSERT INTO productos(nombre, precio, stock, fk_proveedor, tipo_producto, codigo_barra, descripcion, imagen, create_at)
        VALUES ('$nombre', '$precio', '$stock', '$fk_proveedor', '$tipo_producto', '$codigo_barra', '$descripcion', '$ruta_relativa', NOW())";

if ($conn->query($sql)) {
    header("Location: registrar-producto.php");
} else {
    echo "Error: " . $conn->error;
}
?>
