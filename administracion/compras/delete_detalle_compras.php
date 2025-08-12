<?php
// Incluye el archivo de conexi\u00f3n a la base de datos
include("../../conexion/conexion.php");

// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Si no es POST, redirige de vuelta a la lista.
    header('Location: listado.php');
    exit();
}

// 1. Obtiene el ID de la compra y la contrase\u00f1a del formulario
$idCompra = $_POST['id_compras'] ?? null;
$password = hash('sha512', $_POST['password'] ?? '');

// Verifica que los datos necesarios existan
if (!$idCompra || !$password) {
    header('Location: listado.php?error=data_missing');
    exit();
}

// 2. Busca un administrador con la contrase\u00f1a proporcionada
// ADVERTENCIA: La contrase\u00f1a se almacena como texto plano.
// Esto es un riesgo de seguridad. Considera encriptar las contrase\u00f1as.
$stmt_auth = mysqli_prepare($conn, "SELECT id_usuario FROM usuario WHERE tipo = 'Administrador' AND contraseña = ? LIMIT 1");
mysqli_stmt_bind_param($stmt_auth, "s", $password);
mysqli_stmt_execute($stmt_auth);
$res_auth = mysqli_stmt_get_result($stmt_auth);
$admin_exists = mysqli_fetch_assoc($res_auth);
mysqli_stmt_close($stmt_auth);

// 3. Si se encontr\u00f3 un administrador con la contrase\u00f1a, procede con la eliminaci\u00f3n
if ($admin_exists) {
    // Realiza un borrado l\u00f3gico: actualiza el estado de la compra a 0.
    // Tambi\u00e9n usamos consultas preparadas para mayor seguridad.
    $stmt_delete = mysqli_prepare($conn, "UPDATE compras SET activo = 0 WHERE id_compras = ?");
    mysqli_stmt_bind_param($stmt_delete, "i", $idCompra);
    $success = mysqli_stmt_execute($stmt_delete);
    mysqli_stmt_close($stmt_delete);

    if ($success) {
        header('Location: listado.php?success=deleted');
    } else {
        header('Location: listado.php?error=db_error');
    }
} else {
    // Autenticaci\u00f3n fallida
    header('Location: listado.php?error=auth_failed');
}

// Cierra la conexi\u00f3n a la base de datos
mysqli_close($conn);
exit();
