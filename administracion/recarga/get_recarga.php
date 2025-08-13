<?php
require_once __DIR__ . '/../../conexion/conexion.php'; // define $conn
$conn = conectar();
if (isset($_POST['id_recarga'])) {
    $id = intval($_POST['id_recarga']);

    $stmt = $conn->prepare("SELECT barras, nombre, apellido, salanterior, saltotal, salrecarga, metodoPago FROM recarga WHERE id_recarga = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        echo '
        <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong><i class="fa-solid fa-barcode"></i> Código de Barras:</strong> ' . htmlspecialchars($row['barras']) . '</li>
            <li class="list-group-item"><strong><i class="fa-solid fa-user me-2"></i>Nombre:</strong> ' . htmlspecialchars($row['nombre']) . '</li>
            <li class="list-group-item"><strong><i class="fa-solid fa-user-tag me-2"></i>Apellido:</strong> ' . htmlspecialchars($row['apellido']) . '</li>
            <li class="list-group-item"><strong><i class="fa-solid fa-wallet me-2"></i>Saldo Total:</strong> Q' . number_format($row['saltotal'], 2) . '</li>
            <li class="list-group-item"><strong><i class="fa-solid fa-money-bill-wave me-2"></i>Saldo Recargado:</strong> Q' . number_format($row['salrecarga'], 2) . '</li>
            <li class="list-group-item"><strong><i class="fa-solid fa-clock-rotate-left me-2"></i>Saldo Anterior:</strong> Q' . number_format($row['salanterior'], 2) . '</li>
            <li class="list-group-item"><strong><i class="fa-solid fa-credit-card me-2"></i>Método de Pago:</strong> ' . htmlspecialchars($row['metodoPago']) . '</li>
            
        </ul>';
    } else {
        echo '<div class="alert alert-warning text-center">No se encontraron datos para esta recarga.</div>';
    }
}
?>
