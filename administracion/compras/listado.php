<?php
// Incluye el archivo de conexi\u00f3n a la base de datos
include("../../conexion/conexion.php");

// Inicia la sesi\u00f3n.
session_start();

// Verifica si el usuario ha iniciado sesi\u00f3n
if (!isset($_SESSION['nickname'])) {
    header('Location: ../index.php');
    exit();
}

// 1. Obtener solo las compras con activo = 1
$sql = "SELECT c.*, p.Nombre AS nombre_proveedor
        FROM compras c
        LEFT JOIN proveedor p ON c.fk_proveedor = p.id_proveedor
        WHERE c.activo = 1
        ORDER BY c.id_compras DESC";
$respuesta = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Cafeteria Liceo Pre Universitario del Norte - Lista de Compras</title>

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

        .btn-outline-rosado {
            color: #ff69b4;
            background-color: white;
            border: 1px solid #ff69b4;
            margin-right: 0.25rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-outline-rosado:hover {
            background-color: #ff69b4;
            color: white;
            border-color: #ff69b4;
            cursor: pointer;
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
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
</form>
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
                        <h2 class="text-center mb-4">Compras Registradas</h2>
                        <div class="table-responsive shadow rounded mx-auto" style="max-width: 1100px;">
                            <table id="datatablesSimple" class="table table-striped table-hover align-middle">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Encargado</th>
                                        <th scope="col">Proveedor</th>
                                        <th scope="col">Total Compra</th>
                                        <th scope="col" style="width: 150px;">Acciones Compra</th>
                                        <th scope="col" style="width: 250px;">Acciones Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (mysqli_num_rows($respuesta) > 0) :
                                        while ($row = mysqli_fetch_array($respuesta)) :
                                            $idCompra = $row['id_compras'];
                                    ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo htmlspecialchars($row['encargado']); ?></td>
                                                <td><?php echo htmlspecialchars($row['nombre_proveedor']); ?></td>
                                                <td>Q<?php echo htmlspecialchars($row['total_compra']); ?></td>
                                                <td class="text-center">
                                                    <!-- Bot\u00f3n para eliminar que ahora abre el modal -->
                                                    <button type="button" class="btn btn-outline-danger btn-xs btn-margin" title="Borrar Registro"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal" data-id-compra="<?php echo $idCompra; ?>">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                    <a href="edit.php?id_compras=<?php echo $idCompra; ?>"
                                                        class="btn btn-outline-warning btn-xs btn-margin" title="Editar Registro">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="view.php?id_compras=<?php echo $idCompra; ?>"
                                                        title="Ver Registro">
                                                        <button type="button" class="btn btn-xs btn-outline-rosado">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="view_dt_compras.php?id_compras=<?php echo $idCompra; ?>"
                                                        class="btn btn-outline-info btn-xs btn-margin" title="Ver Detalles de Compra">
                                                        <i class="fa-solid fa-list-ul"></i>
                                                    </a>
                                                    <a href="detalle_compras.php?id_compras=<?php echo $idCompra; ?>"
                                                        class="btn btn-outline-success btn-xs btn-margin" title="Registrar Nuevo Detalle">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </a>
                                                    <a href="editar_detalle_compra.php?id_compras=<?php echo $idCompra; ?>"
                                                        class="btn btn-outline-primary btn-xs btn-margin" title="Editar Detalles de Compra">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                        endwhile;
                                    else : ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No hay compras registradas.</td>
                                            </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4"></div>
            </footer>
        </div>
    </div>

    <!-- Modal de confirmaci\u00f3n de eliminaci\u00f3n -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="delete_detalle_compras.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_compras" id="deleteCompraId">
                        <div class="mb-3">
                            <label for="adminPassword" class="form-label">Contraseña de Administrador:</label>
                            <input type="password" class="form-control" id="adminPassword" name="password" required>
                        </div>
                        Estas seguro de que deseas eliminar este registro? Esta acción es irreversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                        perPage: "Entradas por pagina",
                        noRows: "No se encontraron resultados",
                        info: "Mostrando {start} a {end} de {rows} entradas",
                        loading: "Cargando...",
                        pagination: {
                            previous: "Anterior",
                            next: "Siguiente",
                            navigate: "Ir a la pagina",
                            page: "Pagina",
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

            // JavaScript para manejar el modal de eliminaci\u00f3n
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', event => {
                // Bot\u00f3n que activ\u00f3 el modal
                const button = event.relatedTarget;
                // Extrae la informaci\u00f3n de los atributos de datos
                const idCompra = button.getAttribute('data-id-compra');
                // Actualiza el campo oculto del formulario del modal
                const modalInput = deleteModal.querySelector('#deleteCompraId');
                modalInput.value = idCompra;
            });
        });
    </script>
</body>

</html>
