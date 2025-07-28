<?php
$ventas = [
    [
        "Id" => 1,
        "NombreP" => "Café Americano",
        "CantidadP" => 2,
        "PrecioUni" => 15.00,
        "SubTotal" => 30.00
    ],
    [
        "Id" => 2,
        "NombreP" => "Latte",
        "CantidadP" => 1,
        "PrecioUni" => 20.00,
        "SubTotal" => 20.00
    ],
    [
        "Id" => 3,
        "NombreP" => "Pan dulce",
        "CantidadP" => 3,
        "PrecioUni" => 10.00,
        "SubTotal" => 30.00
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../index.php">Inicio</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>   
    </nav> 
    <div id="layoutSidenav">
        <?php include '../../conexion/menu.php'; ?>
        <div id="layoutSidenav_content">
            <!-- contenido-->

            <main class="app-main">
                <!--begin::App Content Header-->
                <div class="app-content-header">
                    <div class="container-fluid">
                        <h3 class="mb-0"></h3><br>
                        <h2>Reportes de Venta</h2>
                        <!-- Selector de rango de fechas -->
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

                        <!-- Tabla con diseño personalizado -->
                        <table id="miTabla" class="display nowrap table table-hover" style="width:100%">

                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre del producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Precio Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ventas as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['Id'] ?? '—') ?></td>
                                    <td><?= htmlspecialchars($row['NombreP'] ?? '—') ?></td>
                                    <td><?= htmlspecialchars($row['CantidadP'] ?? '—') ?></td>
                                    <td>Q<?= number_format($row['PrecioUni'] ?? 0, 2) ?></td>
                                    <td>Q<?= number_format($row['SubTotal'] ?? 0, 2) ?></td>
                                    <td style="display: flex; gap: 6px; align-items: center;">
                                        <a href="delete.php?id=<?= urlencode($row['Id'] ?? '') ?>">
                                            <button type="button" title="Borrar registro" class="btn btn-danger">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </a>

<a href="view.php?id=<?= urlencode($row['Id'] ?? '') ?>">
    <button type="button" class="btn" style="background-color: #f78acb; color: white; border: 1px solid #f78acb;" title="Ver detalle">
        <i class="fa-regular fa-eye"></i>
    </button>
</a>

                                    </td>

                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Scripts -->
                        <script src="https://kit.fontawesome.com/76679858d1.js" crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                            crossorigin="anonymous"></script>

                        <!-- DataTables -->
                        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
                        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
                        <script>
                        $(document).ready(function() {
                            $('#miTabla').DataTable({
                                responsive: true,
                                language: {
                                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                                }
                            });
                        });
                        </script>
                    </div>
                </div>
                <!--end::App Content Header-->

                <!--begin::App Content-->
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- espacio para más contenido si quieres -->
                        </div>
                    </div>
                </div>
                <!--end::App Content-->
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4"></div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous">
    </script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>