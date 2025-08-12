<?php
session_start();

if (!isset($_SESSION['nickname'])) {
    // No ha iniciado sesión, redirigir
    header("Location: ../../index.html");
    exit;
}

include("../../conexion/conexion.php");
  $sql = "SELECT * FROM recarga WHERE estado = 1 ORDER BY id_recarga DESC";
    $respuesta = mysqli_query($conn, $sql);

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['nickname'])) {
    header('Location: ../index.php');
    exit();
}

// Verifica el rol del usuario
if ($_SESSION['rol'] != 'Administrador') {
    echo "<script>alert(Acceso denegado. Solo los administradores pueden acceder a esta página.); window.history.back()</script>";
    exit();
}

//verifica si el usuario está activo
if ($_SESSION['estado'] != 'Activo') {
    echo "<script>alert('Cuenta inactiva. Consulta con los administradores si se trata de algun error'); window.history.back();</script>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cafetería Liceo Pre Universitario del Norte - Listado de recargas</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


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
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../../pagina_administracion.php">Exit</a></li>
                    <li><a class="dropdown-item" href="cerrar.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <?php include '../../conexion/menu.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"></h1>
                    <!-- parte1-->
                    <div class="row">



                    </div>
                    <!-- parte1fin-->
                    <!-- parte2-->
                    <div class="row">



                    </div>
                    <!-- ***************************************CONTENIDO************************************************ -->
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4 text-center">Registro de Recargas</h1>
                            <div class="sama">
                                <div>
                                    <?php if (mysqli_num_rows($respuesta) > 0): ?>
                                        <table id="miTabla" class="display nowrap table table-hover text-center" style="width:100%">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Saldo Total</th>
                                                    <th>Saldo que se recargó</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($respuesta)):  ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row['id_recarga'];  ?></td>
                                                        <td class="text-center"><?php echo $row['nombre'];  ?></td>
                                                        <td class="text-center"><?php echo $row['apellido'];  ?></td>
                                                        <td class="text-center"><?php echo $row['saltotal'];  ?></td>
                                                        <td class="text-center"><?php echo $row['salrecarga'];  ?></td>
                                                        <td class="text-center">
                                                            <button type="button" title="Borrar Registro" class="btn" style="background-color: #dc3545; color: #fff;" onclick="window.location.href='delete.php?id_recarga=<?php echo $row['id_recarga']; ?>'">
                                                                <i class="fa-solid fa-trash-can"></i> Eliminar
                                                            </button>
                                                            <button type="button"
                                                                title="Ver información"
                                                                class="btn verRecargaBtn"
                                                                style="background-color: #e83e8c; color: #fff; border-color: #e83e8c;"
                                                                data-id="<?php echo $row['id_recarga']; ?>">
                                                                <i class="fa-solid fa-eye"></i> Ver
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endwhile ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <div class="alert text-center mt-4" style="background-color: #000000ff; color: #fff;">
                                            Datos de usuarios no encontrados
                                        </div>
                                    <?php endif; ?>

                                    <!-- <a href="recarga.php" class="btn mt-3" style="background-color: orange; color: #fff;">
                                        <i class="fa-solid fa-house"></i> Inicio
                                    </a>
                                    <a href="reporte.php" class="btn mt-3" style="background-color: orange; color: #fff;">
                                        <i class="fa-solid fa-file-lines"></i> Reportes
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    </main>
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

        <!-- FIN CONTENIDO -->
    </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
        </div>
    </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>

    <!-- Codificacion para apertura de ventana emergente "Ver" -->
    <!-- Modal Estilizado -->
    <div class="modal fade" id="modalRecarga" tabindex="-1" aria-labelledby="modalRecargaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0 rounded-4">
                <div class="modal-header bg-dark text-white rounded-top-4">
                    <h5 class="modal-title" id="modalRecargaLabel">
                        <i class="fa-solid fa-circle-info me-2"></i> Detalle de Recarga
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body" id="modal-content">
                    <!-- Aquí irán los datos con AJAX -->
                </div>
                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.verRecargaBtn', function() {
            var id = $(this).data('id');

            $.ajax({
                url: 'get_recarga.php', // Archivo que devuelve HTML con el detalle
                method: 'POST',
                data: {
                    id_recarga: id
                },
                success: function(response) {
                    $('#modal-content').html(response); // Inserta datos en el modal

                    const modal = new bootstrap.Modal(document.getElementById('modalRecarga'));
                    modal.show();
                },
                error: function() {
                    $('#modal-content').html('<p class="text-danger">Error al cargar los datos.</p>');
                }
            });
        });
    </script>
    <!-- Fin de codificacion para apertura de ventana emergente "Ver" -->

</body>

</html>