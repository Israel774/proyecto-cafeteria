<?php
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

  include("../../conexion/conexion.php");

  // Consulta con join para traer nombre del proveedor
  $sql = "SELECT productos.*, proveedor.Nombre AS nombre_proveedor
          FROM productos
          INNER JOIN proveedor ON productos.fk_proveedor = proveedor.id_proveedor";

  $respuesta = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
      rel="stylesheet"
    />
    <link href="../css/styles.css" rel="stylesheet" />
    <script
      src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3" href="../index.php">Inicio</a>
      <!-- Sidebar Toggle-->
      <button
        class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
        id="sidebarToggle"
        href="#!"
      >
        <i class="fas fa-bars"></i>
      </button>
      <!-- Navbar Search-->
      <form
        class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"
      >
        <div class="input-group">
          <input
            class="form-control"
            type="text"
            placeholder="Search for..."
            aria-label="Search for..."
            aria-describedby="btnNavbarSearch"
          />
          <button class="btn btn-primary" id="btnNavbarSearch" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
      <!-- Navbar-->
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            id="navbarDropdown"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            ><i class="fas fa-user fa-fw"></i
          ></a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdown"
          >
            <li><a class="dropdown-item" href="#!">Settings</a></li>
            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
            <li><hr class="dropdown-divider" /></li>
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
            <!-- parte2fin-->
            <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-coffee me-1"></i>
        Productos de la Cafetería Escolar
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio Venta (Q)</th>
                    <th>Stock</th>
                    <th>Tipo</th>
                    <th>opciones</th>
                </tr>
            </thead>
            <tbody>
              <?php
                  while ($row = mysqli_fetch_array($respuesta)):
                ?>
                <tr>
                  <td><?php echo $row['id_productos']; ?></td>
                  <td><?php echo $row['nombre']; ?></td>
                  <td><?php echo $row['precio']; ?></td>
                  <td><?php echo $row['stock']; ?></td>
                  <td><?php echo $row['tipo_producto']; ?></td>
                  <td class="text-center">
                      <!-- Botón para borrar registro -->
                      <a href="delete.php?id_productos=<?php echo $row['id_productos']; ?>" title="Borrar Registro">
                          <button type="button" class="btn btn-outline-danger btn-xs btn-margin">
                              <i class="fa-solid fa-trash-can"></i>
                          </button>
                      </a>

                      <!-- Botón para editar registro -->
                      <a href="edit_productos.php?id_productos=<?php echo $row['id_productos']; ?>" title="Editar Registro">
                          <button type="button" class="btn btn-outline-warning btn-xs btn-margins">
                              <i class="fa-solid fa-pen-to-square"></i>
                          </button>
                      </a>

                      <!-- Botón para ver registro -->
                      <a href="view.php?id_productos=<?php echo $row['id_productos']; ?>" title="Ver Registro">
                          <button type="button" class="btn btn-xs btn-outline-rosado">
                              <i class="fa-solid fa-eye"></i>
                          </button>
                      </a>
                  </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>

          </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div
              class="d-flex align-items-center justify-content-between small"
            >
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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="../js/scripts.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="../js/datatables-simple-demo.js"></script>
  </body>
</html>
