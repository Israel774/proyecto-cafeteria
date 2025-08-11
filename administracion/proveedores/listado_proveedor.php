
<?php
include("../../conexion/conexion.php");
$sql = "SELECT * FROM proveedor where activo=1" ;
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
    <title>Cafetería Liceo Pre Universitario del Norte - Lista de Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">



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

                    <div class="sama">
    <div>
      <center>  <h1 class="mb-4 text-center">Proveedores Registrados</h1> </center>

        <?php if (mysqli_num_rows($respuesta) > 0): ?>
        <table class="table table-bordered table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Numero Telefono de Oficina</th>
                    <th>Nombre de repartidor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                                    $i = 1;
                                    while($row = mysqli_fetch_array($respuesta)):
                                    ?>
                                    
                <tr>
                       <td><?php echo $i++; ?></td>
                    
                    <td><?php echo $row['Nombre']; ?></td>
                    <td><?php echo $row['Notelef_ficina']; ?></td>
                    <td><?php echo $row['Nombre_De_Repartidor']; ?></td>
                    <td class="text-center">
                                            <a href="borrar.php?id_proveedor=<?php echo $row['id_proveedor']; ?>"
                                                title="Borrar Registro">
                                                <button type="button" class="btn btn-outline-danger btn-xs btn-margin">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </a>
                                            <a href="actualizar.php?id_proveedor=<?php echo $row['id_proveedor']; ?>"
                                                title="Editar Registro">
                                                <button type="button" class="btn btn-outline-warning btn-xs btn-margin">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>
                                            <a href="ver.php?id_proveedor=<?php echo $row['id_proveedor']; ?>" title="Ver Registro">
  <button type="button" class="btn btn-xs btn-outline-rosado">
    <i class="fa-solid fa-eye"></i>
  </button>
</a>
                                        </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
           <p class="alert alert-info">No hay Proveedores  registrados.</p>
        <?php endif; ?>

        
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