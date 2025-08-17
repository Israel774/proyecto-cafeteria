<?php
session_start(); // para acceder a $_SESSION
include("../../conexion/conexion.php");

$id_recarga = $_GET["id_recarga"];
$update_by = $_SESSION['id_usuario']; // ID del usuario logueado

$conn = conectar();

// Verificar que la recarga exista y esté activa
$sql_verificar = "SELECT * FROM recarga WHERE id_recarga = '$id_recarga' AND estado = 1";
$result = mysqli_query($conn, $sql_verificar);

if ($result && mysqli_num_rows($result) > 0) {
    $recarga = mysqli_fetch_assoc($result);
    $codigoBarra = $recarga['barras'];

    // Buscar el usuario con ese código de barras
    $sql_usuario = "SELECT nickname FROM usuario WHERE codigobarra = '$codigoBarra'";
    $res_usuario = mysqli_query($conn, $sql_usuario);

    if ($res_usuario && mysqli_num_rows($res_usuario) > 0) {
        $usuario = mysqli_fetch_assoc($res_usuario);
        $nickname = $usuario['nickname'];

        // Verificar que el cliente exista
        $sql_cliente = "SELECT * FROM clientes WHERE nickname = '$nickname'";
        $res_cliente = mysqli_query($conn, $sql_cliente);

        if ($res_cliente && mysqli_num_rows($res_cliente) > 0) {
            // Iniciar transacción
            mysqli_begin_transaction($conn);

            try {
                // Calcular monto de la recarga anulada
                $monto = $recarga['saltotal'] - $recarga['salanterior'];

                // 1. Marcar recarga como anulada (estado = 0) y tipo = 2 + quién la actualizó
                $sql_update_recarga = "UPDATE recarga 
                    SET estado = 0, tipo = 2, update_at = NOW(), update_by = '$update_by' 
                    WHERE id_recarga = '$id_recarga'";
                mysqli_query($conn, $sql_update_recarga);

                // 2. Actualizar saldo del cliente restando el monto de la recarga anulada
                $sql_update_cliente = "UPDATE clientes 
                    SET saldo = saldo - $monto, update_at = NOW() 
                    WHERE nickname = '$nickname'";
                mysqli_query($conn, $sql_update_cliente);

                // Confirmar cambios
                mysqli_commit($conn);
                header("Location: list.php");
                exit();

            } catch (Exception $e) {
                mysqli_rollback($conn);
                echo "Error durante la transacción: " . $e->getMessage();
            }

        } else {
            echo "No se encontró un cliente con el nickname: $nickname";
        }

    } else {
        echo "No se encontró un usuario con el código de barra: $codigoBarra";
    }

} else {
    echo "No se encontró la recarga activa con ID: $id_recarga";
}
?>
