<?php
session_start();

include("../../conexion/conexion.php");
$conn = conectar();
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
if ($_SESSION['estado'] == 'Eliminado') {
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
    <title>Cafetería Liceo Pre Universitario del Norte</title>
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

                        <div class="container-fluid px-4">
                            <h1 class="mt-4">Generar Reportes</h1>

                            <!-- Reporte por Rango de Fechas -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fa-solid fa-file-pdf"></i> Reporte por Rango de Fechas
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="generar_reporte_rango.php" target="_blank">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="fecha_final" class="form-label">Fecha final</label>
                                                <input type="date" class="form-control" id="fecha_final" name="fecha_final" required>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-danger me-2">Limpiar</button>
                                            <button type="submit" class="btn" style="background-color: #00A86B; color: #fff;">
                                                <i class="fa-solid fa-print"></i> Imprimir Reporte
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Reporte por Día Único -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fa-solid fa-calendar-day"></i> Reporte por Día Único
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="generar_reporte_dia.php" target="_blank">
                                        <div class="mb-3">
                                            <label for="fecha_unica" class="form-label">Selecciona el día</label>
                                            <input type="date" class="form-control" id="fecha_unica" name="fecha_unica" required>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-danger  me-2">Limpiar</button>
                                            <button type="submit" class="btn" style="background-color: #00A86B; color: #fff;">
                                                <i class="fa-solid fa-print"></i> Imprimir Reporte
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--
                            <div class="d-flex justify-content-end">
                                <a href="list.php" class="btn me-2" style="background-color: orange; color: #fff;">
                                    <i class="fa-solid fa-list"></i> Listado
                                </a>
                                <a href="recarga.php" class="btn" style="background-color: orange; color: #fff;">
                                    <i class="fa-solid fa-house"></i> Inicio
                                </a>
                            </div>
                            </div>
                            -->


                    <!-- FIN CONTENIDO -->
                </div>
            </main>
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

</body>

</html>