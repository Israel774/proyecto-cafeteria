<?php
// Incluir el archivo de conexi\u00f3n a la base de datos
require "../../conexion/conexion.php";

// Recuperar y sanear los datos del formulario
// trim() elimina espacios en blanco al inicio y final
$encargado = trim($_POST['encargado']);
$metodo_de_pago = trim($_POST['metodo_de_pago']);
$fk_proveedor = trim($_POST['fk_proveedor']);
$total_compra = trim($_POST['total_compra']);
$observaciones = trim($_POST['observaciones']);

// Preparar la consulta de inserci\u00f3n
// NOTA: Se recomienda usar consultas preparadas (prepared statements) para mayor seguridad.
$sql = "INSERT INTO compras(encargado, metodo_de_pago, fk_proveedor, total_compra, observaciones, createAt, activo) 
        VALUES ('$encargado', '$metodo_de_pago', '$fk_proveedor', '$total_compra', '$observaciones', now(), '1')";

if ($conn->query($sql) === TRUE) {
    // La inserci\u00f3n fue exitosa
    $ultimo_id = $conn->insert_id;

    // Verificar qu\u00e9 bot\u00f3n fue presionado para determinar la redirecci\u00f3n
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'save_only') {
            // Si se presion\u00f3 'Registrar sin detallar', redirigir a la lista
            header("Location: listado.php");
            exit(); // Detener la ejecuci\u00f3n del script
        } elseif ($_POST['action'] === 'save_and_detail') {
            // Si se presion\u00f3 'Detallar', redirigir a la p\u00e1gina de detalles con el ID
            header("Location: detalle_compras.php?id_compras=" . $ultimo_id);
            exit(); // Detener la ejecuci\u00f3n del script
        }
    }

    // Opcional: Redirecci\u00f3n por defecto si no se detecta la acci\u00f3n
    header("Location: listado.php");
    exit();

} else {
    // Si la inserci\u00f3n falla, mostrar el error
    echo "Error: " . $conn->error;
}
?>
