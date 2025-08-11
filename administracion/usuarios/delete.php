<?php
include("../../conexion/conexion.php");

$id_usuario = $_GET["id_usuario"];

$sql_get_nickname = "SELECT nickname FROM usuario WHERE id_usuario = '$id_usuario'";
$result = mysqli_query($conn, $sql_get_nickname);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nickname = $row['nickname'];

    $sql_usuario = "UPDATE usuario SET estado = 'Inactivo' WHERE id_usuario = '$id_usuario'";
    $res_usuario = mysqli_query($conn, $sql_usuario);

    $sql_cliente = "UPDATE clientes SET estado_de_tarjeta = 'Inactivo' WHERE nickname = '$nickname'";
    $res_cliente = mysqli_query($conn, $sql_cliente);

    if ($res_usuario && $res_cliente) {
        header("Location: registro.php");
        exit();
    } else {
        echo "Error al desactivar el usuario o cliente.";
    }
} else {
    echo "Usuario no encontrado.";
}
?>
