<?php
require "../../conexion/conexion.php";

// Recibir los datos del formulario (campos de texto, número, etc.)
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fk_proveedor = $_POST['fk_proveedor'];
$tipo_producto = $_POST['tipo_producto'];
$codigo_barra = $_POST['codigo_barra'];
$descripcion = $_POST['descripcion'];

// Recibir la imagen (desde el input type="file")
$nombre_imagen_original = $_FILES['imagen']['name'];
$ruta_temporal = $_FILES['imagen']['tmp_name'];
$extension = pathinfo($nombre_imagen_original, PATHINFO_EXTENSION);

// Crear nuevo nombre con fecha y hora
$fecha_actual = date("Ymd_His");
$nuevo_nombre_imagen = "img_" . $fecha_actual . "." . $extension;

// Ruta donde se guardará la imagen
$destino = "../../imagenes/" . $nuevo_nombre_imagen;

// Mover imagen a la carpeta
move_uploaded_file($ruta_temporal, $destino);

// Insertar en la base de datos
$sql = "INSERT INTO productos(nombre, precio, stock, fk_proveedor, tipo_producto, codigo_barra, descripcion, imagen, create_at)
        VALUES ('$nombre', '$precio', '$stock', '$fk_proveedor', '$tipo_producto', '$codigo_barra', '$descripcion', '$nuevo_nombre_imagen', NOW())";

if ($conn->query($sql)) {
    header("Location: registrar-producto.php");
} else {
    echo "Error: " . $conn->error;
}
?>
