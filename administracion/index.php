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
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  </head>

  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3" href="index.php">Inicio</a>
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
              
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductos"
                aria-expanded="false" aria-controls="collapseProductos">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Productos
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapseProductos" aria-labelledby="headingUsuarios"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="productos/registrar-producto.php">Registro de Productos</a>
                  <a class="nav-link" href="productos/productos_registrados.php">Productos Registrados</a>
                </nav>
              </div>

              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCompras"
                aria-expanded="false" aria-controls="collapseCompras">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Compras
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapseCompras" aria-labelledby="headingUsuarios"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="compras/compras.php">Compra de Productos</a>
                  <a class="nav-link" href="compras/detalle_compras.php">Detalle de compras</a>
                </nav>
              </div>

              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRecargas"
                aria-expanded="false" aria-controls="collapseRecargas">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Recargar
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapseRecargas" aria-labelledby="headingUsuarios"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="recarga/recarga.php">Recargar Saldo</a>
                  <a class="nav-link" href="recarga/list.php">Lista de Recargas</a>
                </nav>
              </div>

              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProveedores"
                aria-expanded="false" aria-controls="collapseProveedores">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Proveedores
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapseProveedores" aria-labelledby="headingUsuarios"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="proveedores/proveedor.php">Registro de Proveedores</a>
                  <a class="nav-link" href="proveedores/listado_proveedor.php">Listado de proveedores</a>
                </nav>
              </div>


              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProveedores"
                aria-expanded="false" aria-controls="collapseProveedores">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Ventas
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapseProveedores" aria-labelledby="headingUsuarios"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="ventas/ventas_diarias.php">Ventas diaras</a>
                  <a class="nav-link" href="ventas/ReporteDeVentas.php">Reporte de ventas</a>
                </nav>
              </div>

              </div>
            </div>
          </nav>
        </div>
        <div id="layoutSidenav_content">
          <!-- contenido-->
          <main>
            
          </main>
          <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4"></div>
          </footer>
        </div>
      </div>
      <div id="layoutSidenav_content">
        <!-- contenido-->
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4"></h1>
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-box-open me-1"></i>
                Nuevo Producto
              </div>
              <div class="card-body">
                <form id="formProducto">
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="nombre" class="form-label">Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" required />
                    </div>
                    <div class="col-md-6">
                      <label for="precio" class="form-label">Precio de Venta</label>
                      <input type="number" step="0.01" class="form-control" id="precio" name="precio" required />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="stock" class="form-label">Stock</label>
                      <input type="number" class="form-control" id="stock" name="stock" required />
                    </div>
                    <div class="col-md-6">
                      <label for="proveedor" class="form-label">Proveedor</label>
                      <select class="form-select" id="proveedor" name="fk_proveedor" required>
                        <option value="">Selecciona un proveedor</option>
                        <!-- Aquí puedes cargar los proveedores desde base de datos -->
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="tipo" class="form-label">Tipo de producto</label>
                      <input type="text" class="form-control" id="tipo" name="tipo_producto" required />
                    </div>
                    <div class="col-md-6">
                      <label for="codigo" class="form-label">Código de barra</label>
                      <input type="text" class="form-control" id="codigo" name="codigo_barra" required />
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="img" class="form-label">Imagen</label>
                    <input type="file" class="form-control" id="img" name="img" accept="image/*" />
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
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4"></div>
        </footer>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
      crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
  </body>

  </html>