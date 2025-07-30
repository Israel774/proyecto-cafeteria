<?php
include '../../conexion/conexion.php';

$fechaInicio = $_GET['fechaInicio'] ?? null;
$fechaFin = $_GET['fechaFin'] ?? null;

$ventas = [];

if ($fechaInicio && $fechaFin) {
    $sql = "SELECT id, id_producto, cantidad, precio_unitario, subtotal FROM detalle_ventas WHERE fecha BETWEEN ? AND ?";
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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="../index.php">Inicio</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Buscar..." />
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end">
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
                    <h2>Reportes de Venta</h2>
                    <form method="GET" class="row g-2 align-items-center mb-3">
                        <div class="col-auto">
                            <label for="fechaInicio" class="col-form-label">Desde:</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" id="fechaInicio" name="fechaInicio" class="form-control" required>
                        </div>
                        <div class="col-auto">
                            <label for="fechaFin" class="col-form-label">Hasta:</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" id="fechaFin" name="fechaFin" class="form-control" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success">Filtrar</button>
                        </div>
                    </form>

                    <table id="miTabla" class="display nowrap table table-hover" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nombre del producto</th>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
        crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>
