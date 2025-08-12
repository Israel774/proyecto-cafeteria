<?php
// Incluir el archivo de conexi\u00f3n a la base de datos
include("../../conexion/conexion.php");

// Inicia la sesi\u00f3n
session_start();

// Verificar si el usuario ha iniciado sesi\u00f3n
if (!isset($_SESSION['nickname'])) {
    header('Location: ../index.php');
    exit();
}

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar que se recibieron los datos necesarios
    if (!isset($_POST['id_compras']) || !isset($_POST['detalles'])) {
        die("Error: Datos incompletos para la actualizaci\u00f3n.");
    }

    $id_compras = $_POST['id_compras'];
    $detalles = $_POST['detalles'];

    // Inicializar el total de la compra a 0 para recalcularlo
    $nuevo_total_compra = 0;

    // Preparar la consulta para actualizar cada detalle de la compra
    $sql_update_detalle = "UPDATE detalle_compras 
                           SET fk_producto = ?, cantidad = ?, precio = ?, sub_total = ? 
                           WHERE id_detalle_compra = ?";
    $stmt_update_detalle = mysqli_prepare($conn, $sql_update_detalle);

    // Verificar si la preparaci\u00f3n de la consulta fall\u00f3
    if ($stmt_update_detalle === false) {
        die("Error en la preparaci\u00f3n de la consulta de detalle: " . mysqli_error($conn));
    }

    // Recorrer el array de detalles y actualizar cada registro
    foreach ($detalles as $id_detalle_compra => $detalle_data) {
        // Obtener los datos del detalle
        $fk_producto = $detalle_data['fk_producto'];
        $cantidad = $detalle_data['cantidad'];
        $precio_unitario = $detalle_data['precio_unitario'];
        $subtotal = $detalle_data['subtotal'];

        // Sumar al nuevo total de la compra
        $nuevo_total_compra += $subtotal;

        // Vincular par\u00e1metros y ejecutar la consulta para el detalle
        mysqli_stmt_bind_param($stmt_update_detalle, "idssi", $fk_producto, $cantidad, $precio_unitario, $subtotal, $id_detalle_compra);
        if (!mysqli_stmt_execute($stmt_update_detalle)) {
            die("Error al actualizar detalle de compra: " . mysqli_stmt_error($stmt_update_detalle));
        }
    }

    // Cerrar el statement del detalle
    mysqli_stmt_close($stmt_update_detalle);

    // Preparar la consulta para actualizar el total de la compra principal
    $sql_update_compra_total = "UPDATE compras SET total_compra = ? WHERE id_compras = ?";
    $stmt_update_compra_total = mysqli_prepare($conn, $sql_update_compra_total);

    // Verificar si la preparaci\u00f3n de la consulta fall\u00f3
    if ($stmt_update_compra_total === false) {
        die("Error en la preparaci\u00f3n de la consulta de total: " . mysqli_error($conn));
    }
    
    // Vincular par\u00e1metros y ejecutar la consulta para el total
    mysqli_stmt_bind_param($stmt_update_compra_total, "si", $nuevo_total_compra, $id_compras);
    if (!mysqli_stmt_execute($stmt_update_compra_total)) {
        die("Error al actualizar el total de la compra: " . mysqli_stmt_error($stmt_update_compra_total));
    }

    // Cerrar el statement del total
    mysqli_stmt_close($stmt_update_compra_total);

    // Cerrar la conexi\u00f3n
    mysqli_close($conn);

    // Redirigir de vuelta a la p\u00e1gina de detalles de compra con un mensaje de \u00e9xito
    header("Location: view_dt_compras.php?id_compras=" . $id_compras . "&status=success");
    exit();

} else {
    // Si no es un m\u00e9todo POST, redirigir
    header("Location: listado.php");
    exit();
}
?>
