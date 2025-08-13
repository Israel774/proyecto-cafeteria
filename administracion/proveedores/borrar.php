<?php
include("../../conexion/conexion.php");
<<<<<<< Updated upstream
session_start();

// Verificar sesión y rol administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'Administrador') {
    header("Location: ../index.php");
    exit();
}

// Validar ID de proveedor
if (isset($_GET['id_proveedor']) && is_numeric($_GET['id_proveedor'])) {
    $id_proveedor = intval($_GET['id_proveedor']);
    $usuario_id = $_SESSION['id_usuario']; // Usuario que realiza la eliminación

    // Consulta preparada para marcar como inactivo (borrado lógico)
    $sql = "UPDATE proveedor 
            SET activo = 0, 
                Update_by = '$usuario_id', 
                Update_at = NOW() 
            WHERE id_proveedor = ?";

    $stmt = mysqli_prepare($conn, $sql);
=======
$conn = conectar();
    $id_proveedor = $_GET["id_proveedor"];
   
>>>>>>> Stashed changes
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_proveedor);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: listado_proveedor.php?success=1");
        } else {
            header("Location: listado_proveedor.php?error=1");
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: listado_proveedor.php?error=2");
    }
} else {
    header("Location: listado_proveedor.php?error=3");
}

mysqli_close($conn);
?>
