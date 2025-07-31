<?php
require '../../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Conexión a la base de datos
include '../../conexion/conexion.php';

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

// Consultar datos entre fechas
$sql = "SELECT * FROM recarga WHERE DATE(create_at) BETWEEN '$fecha_inicio' AND '$fecha_final'";
$res = mysqli_query($conn, $sql);

// Generar tabla HTML
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
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>";

while ($row = mysqli_fetch_assoc($res)) {
    $html .= "<tr>
        <td>{$row['nombre']}</td>
        <td>{$row['apellido']}</td>
        <td>{$row['salrecarga']}</td>
        <td>{$row['saltotal']}</td>
        <td>{$row['metodoPago']}</td>
        <td>{$row['create_at']}</td>
    </tr>";
}
$html .= "</tbody></table>";

// Generar PDF
$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("reporte_recargas_rango.pdf", ["Attachment" => false]);
exit;
?>
