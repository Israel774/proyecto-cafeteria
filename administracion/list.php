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
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
</head>
 
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
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
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menú</div>

                       <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsuarios"
              aria-expanded="false" aria-controls="collapseUsuarios">
              <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
              Usuarios
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseUsuarios" aria-labelledby="headingUsuarios"
              data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="usuarios/registrar.php">Registrar Usuario</a>
                <a class="nav-link" href="usuarios/registro.php">Lista de Usuarios</a>
              </nav>
            </div>
            <a class="nav-link" href="index.html">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-plus-circle"></i>
                </div>
                Registro de productos
              </a>
            
              <a class="nav-link" href="productos_registrados.html">
                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                Productos registrados
              </a>
               <a class="nav-link" href="compras.php">
                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                Compras Productos
              </a>

               <!-- Inicio de Pestaña de recarga-->
                <a class="nav-link active" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRecarge"
              aria-expanded="false" aria-controls="collapseRecarge">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-cash-register"></i></div>
              Recargar
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <!-- Inicio del menu seleccionable -->
            <div class="collapse" id="collapseRecarge" aria-labelledby="headingRecarge"
              data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="recarga.php">Recargar Saldo</a><!-- Pagina para recargar saldos-->
                <a class="nav-link active" href="list.php">Lista de Recargas</a> <!-- Pagina para ver las recargas hechas a los usuarios-->
              </nav>
              <!-- Fin del menu seleccionable -->
            </div>
               <!-- Fin de Pestaña de recarga-->

               <a class="nav-link" href="proveedor.php">
                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                Registro de Proveedor
              </a>

                 <a class="nav-link" href="listado_proveedor.php">
                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                listado de Proveedor
              </a>

                    </div>
                </div>

            </nav>
        </div>
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
                            <table class="table table-bordered table-striped table-hover text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Saldo Anterior</th>
                                        <th>Saldo Recargado</th>
                                        <th>Saldo Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Sergio</td>
                                        <td>Chitop</td>
                                        <td>20</td>
                                        <td>30</td>
                                        <td>50</td>                                         
                                        <td>
                                            <button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                            <button type="button" class="btn btn-outline-warning"><i class="fa-solid fa-pencil"></i></button>
                                            <button type="button" class="btn btn-outline-info"><i class="fa-solid fa-eye"></i></button>
                                        </td>
                                    </tr>
                                    <!-- Puedes agregar más filas de ejemplo aquí -->
                                </tbody>
                            </table>
                            <a href="index.php" class="btn btn-secondary mt-3">Inicio</a>
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
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>