<?php
session_start(); // para acceder a $_SESSION

include("../../conexion/conexion.php");
$id_recarga = $_GET["id_recarga"];
<<<<<<< Updated upstream

// Usuario que realiza la actualización
$update_by = $_SESSION['nickname']; // o $_SESSION['nickname'] si es texto
=======
$conn = conectar();
>>>>>>> Stashed changes

$sql_verificar = "SELECT * FROM recarga WHERE id_recarga = '$id_recarga' AND estado = 1";
$result = mysqli_query($conn, $sql_verificar);

if ($result && mysqli_num_rows($result) > 0) {
    $recarga = mysqli_fetch_assoc($result);
    $codigoBarra = $recarga['barras'];
    $salanterior = $recarga['salanterior'];

    // Buscar el usuario que tenga ese código de barras
    $sql_usuario = "SELECT nickname FROM usuario WHERE codigobarra = '$codigoBarra'";
    $res_usuario = mysqli_query($conn, $sql_usuario);

    if ($res_usuario && mysqli_num_rows($res_usuario) > 0) {
        $usuario = mysqli_fetch_assoc($res_usuario);
        $nickname = $usuario['nickname'];

        // Verificar si ese nickname existe en la tabla clientes
        $sql_cliente = "SELECT * FROM clientes WHERE nickname = '$nickname'";
        $res_cliente = mysqli_query($conn, $sql_cliente);

        if ($res_cliente && mysqli_num_rows($res_cliente) > 0) {
            // Iniciar transacción
            mysqli_begin_transaction($conn);

            try {
                // 1. Marcar recarga como anulada y tipo = 2 (resta) + quién la actualizó
                $sql_update_recarga = "UPDATE recarga 
                    SET estado = 0, tipo = 2, update_at = NOW(), update_by = '$update_by' 
                    WHERE id_recarga = '$id_recarga'";
                mysqli_query($conn, $sql_update_recarga);

                // 2. Actualizar saldo del cliente
                $sql_update_cliente = "UPDATE clientes 
                    SET saldo = '$salanterior', update_at = NOW() 
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
