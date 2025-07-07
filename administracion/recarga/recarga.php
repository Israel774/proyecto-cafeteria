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
                            <h1 class="mt-4"></h1>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fa-solid fa-cash-register"></i>
                                    Recargar Saldo
                                    <!-- Titulo principal-->
                                </div>
                                <div class="card-body">
                                    <form id="recargaForm" method="POST" action="recargec.php">
                                        <div class="row mb-3">




                                            <!-- Campo para ingresar el código de barras -->
                                            <div class="mb-3">
                                                <label for="barras" class="form-label">Código de Barras</label>
                                                <input type="text" class="form-control" id="barras" name="barras"
                                                    required />
                                            </div>

                                            <!-- Campos que se llenarán automáticamente -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="nombre" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre"
                                                        name="nombre" disabled />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="precio" class="form-label">Apellido</label>
                                                    <input type="text" class="form-control" id="apellido"
                                                        name="apellido  " disabled />
                                                </div>
                                            </div>







                                            <!-- Label bloqueado para mostrar saldo antes de la recarga -->
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Saldo anterior</label>
                                                <input type="text" class="form-control" id="salanterior"
                                                    name="salanterior" disabled /> <!-- disabled -->
                                            </div>
                                            <!-- label para la suma del saldo anterior con el monto a recargar -->

                                            <div class="col-md-6">
                                                <label for="precio" class="form-label">Saldo total</label>
                                                <input type="number" step="0.01" class="form-control" id="saltotal"
                                                    name="saltotal" disabled /> <!-- disabled -->
                                            </div>
                                        </div>
                                        <!-- Label monto del saldo a recargar -->
                                        <div class="mb-3">
                                            <label for="tipo" class="form-label">Saldo a Recargar</label>
                                            <input type="text" class="form-control" id="salrecarga" name="salrecarga"
                                                required />
                                        </div>
                                        <!-- Label con select de los metodos de pago -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="proveedor" class="form-label">Metodo de Pago</label>
                                                <select class="form-select" id="metodoPago" name="metodoPago" required>
                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="Tarjeta">Tarjeta</option>

                                                </select>
                                            </div>
                                            <!-- Label con select para marcar si necesita recibo -->


                                            <div class="col-md-6">
                                                <label for="proveedor" class="form-label">¿Necesita Recibo?</label>
                                                <select class="form-select" id="FK_recibo" name="FK_recibo" required>
                                                    <!-- Pendiente a correccion de ID, name y DB -->
                                                    <option value="0">No</option>
                                                    <option value="1">Si</option>
                                                    <!-- Aquí puedes cargar los proveedores desde base de datos -->
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Campos ocultos o manejados por el sistema -->
                                        <input type="hidden" name="create_by" value="usuario_actual" />
                                        <input type="hidden" name="update_by" value="usuario_actual" />
                                        <input type="hidden" name="create_at" value="" />
                                        <input type="hidden" name="update_at" value="" />

                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <button type="reset" class="btn btn-secondary">
                                            Limpiar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
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
</body>

</html>