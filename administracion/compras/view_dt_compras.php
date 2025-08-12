<?php
// Incluye el archivo de conexi\u00f3n a la base de datos
include("../../conexion/conexion.php");

// Inicia la sesi\u00f3n
session_start();

// Verifica si el usuario ha iniciado sesi\u00f3n. Si no, lo redirige.
if (!isset($_SESSION['nickname'])) {
    header('Location: ../index.php');
    exit();
}

// 1. Verifica que se haya pasado un ID de compra v\u00e1lido por la URL
if (!isset($_GET['id_compras']) || empty($_GET['id_compras'])) {
    // Es buena pr\u00e1ctica usar un mensaje de error m\u00e1s seguro y no mostrar detalles
    echo "ID de compra no proporcionado o no v\u00e1lido.";
    exit();
}

$idCompra = $_GET['id_compras'];

// 2. Obtiene la informaci\u00f3n de la compra principal de forma segura
// utilizando una consulta preparada para prevenir inyecci\u00f3n SQL.
// Prepara la consulta
$stmt_compra = mysqli_prepare($conn, "
    SELECT c.*, p.Nombre AS nombre_proveedor
    FROM compras c
    LEFT JOIN proveedor p ON c.fk_proveedor = p.id_proveedor
    WHERE c.id_compras = ?
");

// Vincula el par\u00e1metro y ejecuta la consulta
mysqli_stmt_bind_param($stmt_compra, "i", $idCompra); // "i" indica que el par\u00e1metro es un entero
mysqli_stmt_execute($stmt_compra);
$resCompra = mysqli_stmt_get_result($stmt_compra);
$datosCompra = mysqli_fetch_assoc($resCompra);
mysqli_stmt_close($stmt_compra);

if (!$datosCompra) {
    echo "Compra no encontrada.";
    exit();
}

// 3. Obtiene los detalles de la compra tambi\u00e9n de forma segura
// utilizando una consulta preparada.
// AQU\u00cd SE A\u00d1ADE LA CL\u00c1USULA 'AND dc.estado = 1' para filtrar solo los registros activos.
$stmt_detalles = mysqli_prepare($conn, "
    SELECT dc.*, prod.nombre AS nombre_producto
    FROM detalle_compras dc
    LEFT JOIN productos prod ON dc.fk_producto = prod.id_productos
    WHERE dc.fk_compras = ? AND dc.estado = 1
");

// Vincula el par\u00e1metro y ejecuta la consulta
mysqli_stmt_bind_param($stmt_detalles, "i", $idCompra); // "i" indica que el par\u00e1metro es un entero
mysqli_stmt_execute($stmt_detalles);
$resDetalles = mysqli_stmt_get_result($stmt_detalles);
mysqli_stmt_close($stmt_detalles);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Cafeter\u00eda Liceo Pre Universitario del Norte - Detalles de Compra</title>
    <!-- Hojas de estilo -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .sb-topnav .btn-link .fa-bars {
            font-size: 1.3em !important;
            vertical-align: middle;
        }

        table thead th {
            color: white !important;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="../index.php">Inicio</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../../pagina_administracion.php">Exit</a></li>
                    <li><a class="dropdown-item" href="../../cerrar-sesion.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <?php include '../../conexion/menu.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="container my-5">
                        <h2 class="text-center mb-2">Detalles de Compra #<?php echo htmlspecialchars($idCompra); ?></h2>
                        <div class="card mb-4 shadow rounded mx-auto" style="max-width: 1100px;">
                            <div class="card-body">
                                <p><strong>Encargado:</strong> <?php echo htmlspecialchars($datosCompra['encargado'] ?? ''); ?></p>
                                <p><strong>Proveedor:</strong> <?php echo htmlspecialchars($datosCompra['nombre_proveedor'] ?? ''); ?></p>
                                <p><strong>Total de Compra:</strong> Q<?php echo htmlspecialchars($datosCompra['total_compra'] ?? ''); ?></p>
                                <p><strong>Fecha:</strong> <?php echo htmlspecialchars($datosCompra['createAt'] ?? ''); ?></p>
                            </div>
                        </div>

                        <div class="table-responsive shadow rounded mx-auto" style="max-width: 1100px;">
                            <table id="datatablesSimple" class="table table-striped table-hover align-middle">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Unidad de Medida</th>
                                        <th scope="col">Costo</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Fecha Caducidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    // Comprobaci\u00f3n de que la consulta devolvi\u00f3 resultados
                                    if(mysqli_num_rows($resDetalles) > 0):
                                        while($row = mysqli_fetch_array($resDetalles)):
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nombre_producto'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($row['cantidad'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($row['unidad_de_medida'] ?? ''); ?></td>
                                        <td>Q<?php echo htmlspecialchars($row['precio'] ?? ''); ?></td>
                                        <td>Q<?php echo htmlspecialchars($row['sub_total'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($row['caducidad'] ?? ''); ?></td>
                                    </tr>
                                    <?php
                                        endwhile;
                                    else:
                                    ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No hay detalles registrados para esta compra.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-4">
                            <a href="listado.php" class="btn btn-primary">Volver al Listado de Compras</a>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4"></div>
            </footer>
        </div>
    </div>
    <!-- Scripts de Bootstrap y datatables -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple, {
                    labels: {
                        perPage: "Entradas por p\u00e1gina",
                        noRows: "No se encontraron resultados",
                        info: "Mostrando {start} a {end} de {rows} entradas",
                        loading: "Cargando...",
                        pagination: {
                            previous: "Anterior",
                            next: "Siguiente",
                            navigate: "Ir a la p\u00e1gina",
                            page: "P\u00e1gina",
                            showing: "Mostrando",
                            of: "de"
                        }
                    }
                });
            }

            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains(
                        'sb-sidenav-toggled'));
                });
            }

            if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                document.body.classList.toggle('sb-sidenav-toggled');
            }
        });
    </script>
</body>

</html>
