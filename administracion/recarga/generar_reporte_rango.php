<?php
require '../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Conexión a la base de datos
include '../../conexion/conexion.php';

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

// Encabezado HTML
$html = "<h2>Reporte de Recargas - Rango de Fechas</h2>";
$html .= "<p>Desde: $fecha_inicio Hasta: $fecha_final</p>";
$html .= "<table border='1' width='100%' cellspacing='0' cellpadding='5'>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Saldo Recargado</th>
            <th>Saldo Total</th>
            <th>Metodo de Pago</th>
            <th>Estado</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>";

// Consulta con prepared statements
$stmt = $conn->prepare("SELECT nombre, apellido, salrecarga, saltotal, metodoPago, tipo, create_at 
                        FROM recarga 
                        WHERE DATE(create_at) BETWEEN ? AND ?");
$stmt->bind_param("ss", $fecha_inicio, $fecha_final);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // Determinar estado según el tipo
    if ($row['tipo'] == 2) {
        $estado = "Eliminado";
    } elseif ($row['tipo'] == 1) {
        $estado = "Exitoso";
    } else {
        $estado = "Desconocido";
    }

    $html .= "<tr>
        <td>{$row['nombre']}</td>
        <td>{$row['apellido']}</td>
        <td>{$row['salrecarga']}</td>
        <td>{$row['saltotal']}</td>
        <td>{$row['metodoPago']}</td>
        <td>{$estado}</td>
        <td>{$row['create_at']}</td>
    </tr>";
}
$stmt->close();

$html .= "</tbody></table>";

// Generar PDF
$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('Carta', 'portrait');
$dompdf->render();
$dompdf->stream("reporte_recargas_rango.pdf", ["Attachment" => false]);
exit;
?>
