<?php
session_start();
require "../../conexion/conexion.php";
$conn = conectar();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['id_usuario'])) {
    die("Error: No has iniciado sesión.");
}

$id_usuario = $_SESSION['id_usuario'];

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fk_proveedor = $_POST['fk_proveedor'];
$tipo_producto = $_POST['tipo_producto'];
$codigo_barra = $_POST['codigo_barra'];
$descripcion = $_POST['descripcion'];

// Verificar si el código de barra ya existe
$sql_check = "SELECT id_productos FROM productos WHERE codigo_barra = '$codigo_barra' LIMIT 1";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    echo "<script>
            alert('Error: El código de barra ya está registrado.');
            window.history.back();
          </script>";
    exit();
}

// Recibir la imagen
$nombre_imagen_original = $_FILES['imagen']['name'];
$ruta_temporal = $_FILES['imagen']['tmp_name'];
$extension = pathinfo($nombre_imagen_original, PATHINFO_EXTENSION);

// Crear nuevo nombre con fecha y hora
$fecha_actual = date("Ymd_His");
$nuevo_nombre_imagen = "img_" . $fecha_actual . "." . $extension;

// **Ruta relativa que se guardará en la base de datos**
$ruta_relativa = "imagenes/" . $nuevo_nombre_imagen;

// Ruta física para mover el archivo
$destino = "../../" . $ruta_relativa;

// Mover imagen a la carpeta
move_uploaded_file($ruta_temporal, $destino);

// Insertar en la base de datos la ruta relativa junto con el usuario que lo creó
$sql = "INSERT INTO productos(
            nombre, precio, stock, fk_proveedor, tipo_producto, codigo_barra, descripcion, imagen, create_at, create_by
        ) VALUES (
            '$nombre', '$precio', '$stock', '$fk_proveedor', '$tipo_producto', '$codigo_barra', '$descripcion', '$ruta_relativa', NOW(), '$id_usuario'
        )";

if ($conn->query($sql)) {
    header("Location: registrar-producto.php");
} else {
    echo "Error: " . $conn->error;
}
?>
