<?php
require '../../vendor/autoload.php';    
use Dompdf\Dompdf;
use Dompdf\Options;

include '../../conexion/conexion.php';  

$fecha = $_POST['fecha_unica'];

$sql = "SELECT * FROM recarga WHERE DATE(create_at) = '$fecha'";
$res = mysqli_query($conn, $sql);

$html = "<h2>Reporte de Recargas - Día Único</h2>";
$html .= "<p>Fecha: $fecha</p>";
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

$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("reporte_recargas_dia.pdf", ["Attachment" => false]);
exit;
?>
