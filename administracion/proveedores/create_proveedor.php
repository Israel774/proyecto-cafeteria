<?php
require "../../conexion/conexion.php";
session_start();

// Validar que el usuario esté logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

$usuario_id = $_SESSION['id_usuario']; // ID del usuario que crea el registro

// Obtener datos del formulario
$Nombre = trim($_POST['Nombre']);
$Direccion = trim($_POST['Direccion']);
$Tipo_Producto = trim($_POST['Tipo_Producto']);
$Notelef_ficina = trim($_POST['Notelef_ficina']);
$Nombre_De_Repartidor = trim($_POST['Nombre_De_Repartidor']);
$Notelef_Repartidor = trim($_POST['Notelef_Repartidor']);
$Tipo_De_Pago = trim($_POST['Tipo_De_Pago']);
$NitProveedor = trim($_POST['NitProveedor']);

// 🔍 Verificar si ya existe un proveedor con el mismo Nombre
$sql_check = "SELECT id_proveedor FROM proveedor WHERE Nombre = ?";
$stmt_check = mysqli_prepare($conn, $sql_check);
mysqli_stmt_bind_param($stmt_check, "s", $Nombre);
mysqli_stmt_execute($stmt_check);
mysqli_stmt_store_result($stmt_check);

if (mysqli_stmt_num_rows($stmt_check) > 0) {
    echo "<script>alert('Ya existe un proveedor con este Nombre.'); window.history.back();</script>";
    exit();
}
mysqli_stmt_close($stmt_check);

// Insertar el nuevo proveedor
$sql = "INSERT INTO proveedor (
    Nombre, Direccion, Tipo_Producto, Notelef_ficina, 
    Nombre_De_Repartidor, Notelef_Repartidor, Tipo_De_Pago, NitProveedor, 
    Create_by, Create_at, activo
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 1)";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssisssssi", 
        $Nombre, 
        $Direccion, 
        $Tipo_Producto, 
        $Notelef_ficina, 
        $Nombre_De_Repartidor, 
        $Notelef_Repartidor, 
        $Tipo_De_Pago, 
        $NitProveedor, 
        $usuario_id
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: proveedor.php?success=1");
        exit();
    } else {
        echo "Error al insertar: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error en la preparación de la consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
