<?php
include("conexion.php");

$idVenta = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($idVenta <= 0) {
    die("ID de venta inválido.");
}

$sql = "SELECT id_producto AS NombreP, cantidad, precio_unitario AS PrecioUni, subtotal AS SubTotal, create_date
        FROM detalle_ventas
        WHERE id_venta = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idVenta);
$stmt->execute();
$res = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalle del Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
    <style>
        .tabla-ajustada th,
        .tabla-ajustada td {
            font-size: 0.75rem;
            padding: 0.3rem;
            text-align: center;
            vertical-align: middle;
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .tabla-ajustada th {
            background-color: #343a40;
            color: white;
        }
        @media (min-width: 768px) {
            .tabla-ajustada {
                table-layout: fixed;
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h4 class="text-center mb-4 text-dark">🧾 Detalle del Producto</h4>

    <table id="mitabla" class="table table-striped table-hover table-bordered shadow rounded tabla-ajustada">
        <thead class="table-success text-center">
            <tr>
                <th>ID Producto</th>
                <th>Cantidad</th>
                <th>Precio U.</th>
                <th>Fecha</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody class="text-center align-middle">
            <?php
            if ($res && $res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['NombreP']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
                    echo "<td>Q" . number_format((float)$row['PrecioUni'], 2) . "</td>";
                    echo "<td>" . htmlspecialchars($row['create_date']) . "</td>";
                    echo "<td class='fw-bold text-dark'>Q" . number_format((float)$row['SubTotal'], 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay datos disponibles para esta venta.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="ReporteDeVentas.php" class="btn btn-sm btn-success">Regresar</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $('#mitabla').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    });
</script>
</body>
</html>
