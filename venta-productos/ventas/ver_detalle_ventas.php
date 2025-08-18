<?php
  session_start();
  // Verifica si el usuario ha iniciado sesión
  if (!isset($_SESSION['nickname'])) {
      header('Location: ../index.php');
      exit();
  }

// Verifica el rol del usuario
if ($_SESSION['rol'] != 'Reportes&productos') {
    echo "<script>alert(Acceso denegado. Solo los de ventas y productos pueden acceder a esta página.); window.history.back()</script>";
    exit();
}

//verifica si el usuario está activo
if ($_SESSION['estado'] == 'Eliminado') {
    echo "<script>alert('Cuenta inactiva. Consulta con los administradores si se trata de algun error'); window.history.back();</script>";
    exit();
}
include("../../conexion/conexion.php");
$conn = conectar();
$fechaInicio = $_GET['fechaInicio'] ?? null;
$fechaFin = $_GET['fechaFin'] ?? null;

if ($fechaInicio && $fechaFin) {
    $sql = "SELECT id_venta, id_producto, cantidad, precio_unitario, subtotal, create_time, create_date 
            FROM detalle_ventas 
            WHERE DATE(create_date) BETWEEN ? AND ? 
            ORDER BY id_venta, id_producto";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fechaInicio, $fechaFin);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT id_venta, id_producto, cantidad, precio_unitario, subtotal, create_time, create_date 
            FROM detalle_ventas ORDER BY id_venta, id_producto";
    $result = $conn->query($sql);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Todos los Detalles de Ventas</title>
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
    <h4 class="text-center mb-4 text-dark">🧾 Detalles de Ventas <?= $fechaInicio && $fechaFin ? "del $fechaInicio al $fechaFin" : '' ?></h4>

    <table id="tablaCompleta" class="table table-striped table-hover table-bordered shadow rounded tabla-ajustada" style="width:100%">
        <thead class="table-success text-center">
            <tr>
                <th>ID Venta</th>
                <th>ID Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
                <th>Hora</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody class="text-center align-middle">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_venta']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_producto']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
                    echo "<td>Q" . number_format((float)$row['precio_unitario'], 2) . "</td>";
                    echo "<td>Q" . number_format((float)$row['subtotal'], 2) . "</td>";
                    echo "<td>" . htmlspecialchars($row['create_time']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['create_date']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay datos disponibles.</td></tr>";
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
    $('#tablaCompleta').DataTable({
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf', 'print'],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
    });
});
</script>
</body>
</html>
