<?php 
   include("../../conexion/conexion.php");
    $id_proveedor = $_GET['id_proveedor'];
    $sql = "SELECT * FROM proveedor WHERE id_proveedor = '$id_proveedor'";
    $r = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($r);
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
     <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">



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
                    <!-- CONTENIDO -->

           



 <div class="content-container">
    <div class="container">
        <center><h3 class="mb-4">Detalles del Proveedor</h3></center>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">ID</label>
                <input type="text" class="form-control" value="<?= $row['id_proveedor'] ?>" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" value="<?= $row['Nombre'] ?>" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">Dirección</label>
                <input type="text" class="form-control" value="<?= $row['Direccion'] ?>" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tipo de Producto</label>
                <input type="text" class="form-control" value="<?= $row['Tipo_Producto'] ?>" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">Teléfono de Oficina</label>
                <input type="number" class="form-control" value="<?= $row['Notelef_ficina'] ?>" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">Nombre del Repartidor</label>
                <input type="text" class="form-control" value="<?= $row['Nombre_De_Repartidor'] ?>" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">Teléfono del Repartidor</label>
                <input type="number" class="form-control" value="<?= $row['Notelef_Repartidor'] ?>" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tipo de Pago</label>
                <input type="text" class="form-control" value="<?= $row['Tipo_De_Pago'] ?>" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">NIT del Proveedor</label>
                <input type="text" class="form-control" value="<?= $row['NitProveedor'] ?>" disabled>
            </div>
        </div>
        
<div class="col-12 text-center mt-4">
  <a href="listado_proveedor.php" class="btn btn-xs btn-naranja">
    <i class="fas fa-arrow-left me-2"></i>Volver al listado
  </a>

  <a href="../../pagina_administracion.php" class="btn btn-xs btn-naranja">
    <i class="fas fa-arrow-left me-2"></i>MENU
  </a>



    </div>
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
</body>

</html>