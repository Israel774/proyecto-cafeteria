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

               <a class="nav-link" href="recarga.php">
                <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                Recargar Saldo
              </a>
               <a class="nav-link active" href="proveedor.php">
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
                    <!-- CONTENIDO -->

                   
                    <CENter><h3 class="mb-0">Registro Proveedor</h3><br></CENter>
              
              
                <div class="encabezado1">
                  <form class="row g-3 needs-validation" method = "POST" action="create.php">
                      <div class="col-md-4">
                          <label for="validationCustom01" class="form-label">Nombre</label>
                          <input type="text" class="form-control" name ="Nombre" required>
                      </div>
                      <div class="col-md-4">
                          <label for="validationCustom03" class="form-label">Direccion</label>
                          <input type="text" class="form-control" name ="Direccion" required>
                      </div>
                       <div class="col-md-4">
                          <label for="validationCustom01" class="form-label">Tipo_producto</label>
                          <input type="text" class="form-control" name ="Tipo_Producto" required>
                      </div>
                      <div class="col-md-4">
                          <label for="validationCustom03" class="form-label">Numero Telefono de Oficina </label>
                          <input type="number" class="form-control" name="Notelef_ficina" required>
                      </div>
                       <div class="col-md-4">
                          <label for="validationCustom01" class="form-label"> Nombre de repartidor</label>
                          <input type="text" class="form-control" name ="Nombre_De_Repartidor" required>
                      </div>
                       <div class="col-md-4">
                         <center> <label for="validationCustom03" class="form-label">Numero de telefono repartidor </label></center>
                          <input type="number" class="form-control" name="Notelef_Repartidor" required>
                      </div>
                       <div class="col-md-4">
                          <label for="validationCustom03" class="form-label">tipo_de_pago </label>
                          <input type="text" class="form-control" name="Tipo_De_Pago" required>
                      </div>
                      <div class="col-md-4">
                          <label for="validationCustom03" class="form-label">NitProveedor</label>
                          <input type="number" class="form-control" name="NitProveedor" required>
                      </div>
                      
                       
                     

                      
                      
                      <!-- 
                      <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">FechaDeNacimiento</label>
                          <input type="date" class="form-control" name="FechaDeNacimiento" required>
                      </div>-->
                      <br>
                      <div class="col-12 text-center mt-3">
                      <button class="btn btn-primary" type="submit">Registrar</button>
               
               
            </div>
                      
                      <div class="col-12">    
                          
                      </div>
                  </form>
                  <br><br><br><br>
                  

          
              </div>
                    <!-- FIN CONTENIDO -->
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
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