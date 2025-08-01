
<?php
include("../../conexion/conexion.php");
$sql = "SELECT * FROM usuario";
$respuesta = mysqli_query($conn , $sql); 

// Inicia la sesión

session_start();

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
            
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    
                    
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
                  <form class="row g-3 needs-validation" method = "POST" action="create_proveedor.php">
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
                <a href="../../pagina_administracion.php" class="btn btn-xs btn-naranja">
    <i class="fas fa-arrow-left me-2"></i>MENU
  </a>

               
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
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
  

      <!-- para espacios en blanco -->

    <script>
        // Trim en el submit
        document.querySelector('form').addEventListener('submit', function (e) {
            const inputs = this.querySelectorAll('input[type="text"], input[type="email"], input[type="number"], input[type="password"]');
            inputs.forEach(input => {
                input.value = input.value.trim();
            });
        });

        // Prevenir espacios al inicio durante la escritura
        document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], input[type="number"]').forEach(input => {
            input.addEventListener('input', function () {
                if (this.selectionStart === 1 && this.value.startsWith(' ')) {
                    this.value = this.value.trimStart();
                }
            });
        });
    </script>


</body>

</html>