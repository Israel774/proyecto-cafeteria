<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibimos y sanitizamos los datos
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : 0;
    $total_pagado = isset($_POST['total_pagado']) ? floatval($_POST['total_pagado']) : 0;

    if ($id > 0 && $id_cliente > 0) {
        // Fecha de actualización
        $update_at = date('Y-m-d H:i:s');

        // Puedes agregar aquí los campos createby y updateby si lo manejas, por ejemplo:
        // $updateby = 1; // o quien esté haciendo la edición

        // Consulta SQL para actualizar
        $sql = "UPDATE ventas SET 
                id_cliente = $id_cliente, 
                total_pagado = $total_pagado, 
                update_at = '$update_at' 
                WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            // Redirigir a la lista de ventas o donde prefieras
            header("Location: ventas_diarias.php");
            exit();
        } else {
            echo "Error al actualizar la venta: " . mysqli_error($conn);
        }
    } else {
        echo "Datos inválidos.";
    }
} else {
    echo "Método no permitido.";
}
?>
