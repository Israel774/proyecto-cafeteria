<?php
include '../../conexion/conexion.php';

$fechaInicio = $_GET['fechaInicio'] ?? null;
$fechaFin = $_GET['fechaFin'] ?? null;

$ventas = [];

if ($fechaInicio && $fechaFin) {
    $sql = "SELECT id, id_producto, cantidad, precio_unitario, subtotal 
            FROM detalle_ventas 
            WHERE DATE(create_date) BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fechaInicio, $fechaFin);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT id, id_producto, cantidad, precio_unitario, subtotal FROM detalle_ventas";
    $result = $conn->query($sql);
}

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ventas[] = $row;
    }
}

// Para el enlace "Visualizar", crea la URL según si hay filtro o no:
$visualizarUrl = 'ver_detalle_ventas.php';
if ($fechaInicio && $fechaFin) {
    $visualizarUrl .= '?fechaInicio=' . urlencode($fechaInicio) . '&fechaFin=' . urlencode($fechaFin);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Reporte de Ventas</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables CSS y JS -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="../index.php">Inicio</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Configuración</a></li>
                <li><a class="dropdown-item" href="#!">Actividad</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#!">Cerrar sesión</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">
    <?php include '../../conexion/menu.php'; ?>
    <div id="layoutSidenav_content">
        <main class="app-main">
            <div class="app-content-header container-fluid">
                <br>
                <h2>Reportes de Venta</h2>
                <form method="GET" class="row g-2 align-items-center mb-3">
                    <div class="col-auto">
                        <label for="fechaInicio" class="col-form-label">Desde:</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" id="fechaInicio" name="fechaInicio" class="form-control" required
                            value="<?= htmlspecialchars($fechaInicio) ?>">
                    </div>
                    <div class="col-auto">
                        <label for="fechaFin" class="col-form-label">Hasta:</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" id="fechaFin" name="fechaFin" class="form-control" required
                            value="<?= htmlspecialchars($fechaFin) ?>">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn" style="background-color: #00A86B; color: white; border: none;">Filtrar</button>
                    </div>

                    <div class="col-auto">
                        <a href="ReporteDeVentas.php" class="btn" style="background-color: #00A86B; color: white; border: none;">Ver todo</a>
                    </div>

                    <div class="col-auto">
                        <a href="<?= $visualizarUrl ?>" class="btn btn-primary">Visualizar</a>
                    </div>
                </form>

                <table id="miTabla" class="display nowrap table table-hover" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>ID Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>SubTotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['id_producto']) ?></td>
                                <td><?= htmlspecialchars($row['cantidad']) ?></td>
                                <td>Q<?= number_format($row['precio_unitario'], 2) ?></td>
                                <td>Q<?= number_format($row['subtotal'], 2) ?></td>
                                <td style="display: flex; gap: 6px; align-items: center;">
                                    <a href="delete.php?id=<?= urlencode($row['id']) ?>">
                                        <button type="button" title="Borrar registro" class="btn btn-danger">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </a>
                                    <a href="view.php?id=<?= urlencode($row['id']) ?>">
                                        <button type="button" class="btn" style="background-color: #f78acb; color: white;" title="Ver detalle">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4"></div>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="../assets/demo/chart-area-demo.js"></script>
<script src="../assets/demo/chart-bar-demo.js"></script>

<script>
    $(document).ready(function () {
        $('#miTabla').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            },
            scrollX: true
        });
    });
</script>

</body>
</html>
