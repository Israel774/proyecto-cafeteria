<?php
require '../../vendor/autoload.php';    
use Dompdf\Dompdf;
use Dompdf\Options;

include '../../conexion/conexion.php';  

$fecha = $_POST['fecha_unica'];

// Encabezado del HTML
$html = "<h2>Reporte de Recargas - Día Único</h2>";
$html .= "<p>Fecha: $fecha</p>";
$html .= "<table border='1' width='100%' cellspacing='0' cellpadding='5'>
    <thead>
        <tr>
            <th>Codigo de barras</th>
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

// Consulta con prepared statement
$stmt = $conn->prepare("SELECT barras, nombre, apellido, salrecarga, saltotal, metodoPago, tipo, create_at 
                        FROM recarga 
                        WHERE DATE(create_at) = ?");
$stmt->bind_param("s", $fecha);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // Evaluar el tipo para mostrar texto
    if ($row['tipo'] == 2) {
        $estado = "Eliminado";
    } elseif ($row['tipo'] == 1) {
        $estado = "Exitoso";
    } else {
        $estado = "Desconocido"; // Por si hay otros valores
    }

    $html .= "<tr>
        <td>{$row['barras']}</td>
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

// Configuración de Dompdf
$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('Carta', 'portrait');
$dompdf->render();
$dompdf->stream("reporte_recargas_dia.pdf", ["Attachment" => false]);
exit;
?>
