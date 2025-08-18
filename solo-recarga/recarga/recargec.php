<?php
session_start();

require "../../conexion/conexion.php";
require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$conn = conectar();

// Datos del formulario
$barras = $_POST["codigobarra"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$salanterior = $_POST["saldo"];
$saltotal    = $_POST["saltotal"];
$salrecarga  = $_POST["salrecarga"];
$metodoPago  = $_POST["metodoPago"];
$recibo      = $_POST["recibo"];

// Usuario que hace la recarga
$created_by = $_SESSION['id_usuario'];
$usuario = $_SESSION['nickname'];

// Insertar la recarga
$sql = "INSERT INTO recarga (
            barras, nombre, apellido, salanterior, saltotal, salrecarga, metodoPago, estado, create_at, create_by
        ) VALUES (
            '$barras', '$nombre', '$apellido', '$salanterior', '$saltotal', '$salrecarga', '$metodoPago', 1, NOW(), '$created_by'
        )";

if ($conn->query($sql)) {
    // Actualizar saldo del cliente
    $sqlUpdate = "UPDATE recarga r
                    INNER JOIN usuario u ON u.codigobarra = r.barras
                    INNER JOIN clientes c ON u.nickname = c.nickname
                    SET c.saldo = $saltotal
                    WHERE r.barras = '$barras'";
    
    if ($conn->query($sqlUpdate)) {
        if ($recibo == "Si") {
            // Generar PDF
            $fecha = date('d/m/Y H:i:s');
            $numero_recibo = rand(10000, 99999);

            $html = "
            <html>
            <head>
            <title>Recibo de Recarga</title>
            <meta charset='UTF-8'>
            <style>
                body {
                    font-family: monospace;
                    font-size: 12px;
                    width: 220px; /* ancho de papel 80mm */
                    margin: 0 auto;
                    padding: 0;
                    text-align: center;
                }
                h2 {
                    text-align: center;
                    margin: 0;
                }
                .linea {
                    border-top: 1px dashed #000;
                    margin: 10px 0;
                    position: relative;
                    width: 100%;
                }
                .section-title {
                    font-weight: bold;
                    font-size: 12px;
                    position: relative;
                    top: -10px;
                    background: #fff;
                    display: inline-block;
                    padding: 0 5px;
                }
                p {
                    margin: 3px 0;
                    text-align: left;
                }
                .center {
                    text-align: center;
                }
            </style>
            </head>
            <body>
                <!-- Datos de la empresa -->
                <h2>Liceo Pre Universitario del Norte</h2>
                <p class='center'>Ciudad: Cobán</p>
                <p class='center'>Dirección: 3a. Avenida 8-32, Zona 10, Barrio La Libertad, 3, Cobán 16001, Guatemala</p>
                <br>

                <div class='linea'><span class='section-title'>Descripción del Recibo</span></div>
                <p><strong>Usuario:</strong> {$usuario}</p>
                <p><strong>Recibo N°:</strong> {$numero_recibo}</p>
                <p><strong>Fecha:</strong> {$fecha}</p>
<br>
                <div class='linea'><span class='section-title'>Datos del Cliente</span></div>
                <p><strong>Nombre:</strong> {$nombre} </p>
                <p><strong>Apellido:</strong> {$apellido}</p>
                <p><strong>Código:</strong> {$barras}</p>
<br>
                <div class='linea'><span class='section-title'>Forma de Pago</span></div>
                <p><strong>{$metodoPago}</strong> Q{$salrecarga}</p>
<br>
                <div class='linea'><span class='section-title'>Detalles de la Recarga</span></div>
                <p><strong>Saldo Anterior:</strong> Q{$salanterior}</p>
                <p><strong>Recarga:</strong> Q{$salrecarga}</p>
                <p><strong>Saldo Total:</strong> Q{$saltotal}</p>

                <div class='linea'></div>
                <p class='center'>¡Gracias por su recarga! Esperamos servirle pronto, tenga un buen día.</p>
            </body>
            </html>
            ";

            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper([0, 0, 226.77, 750]); // ajusta altura según contenido
            $dompdf->render();

            // Mostrar PDF en navegador (nueva pestaña)
            $dompdf->stream("recibo_{$numero_recibo}.pdf", ["Attachment" => false]);
            exit;

        } else {
            header("Location: recarga.php?success=1");
        }
    } else {
        echo "Error al actualizar saldo: " . $conn->error;
    }
} else {
    echo "Error al insertar recarga: " . $conn->error;
}
?>
