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

require "../../conexion/conexion.php"; // tu conexión a la BD
$conn = conectar();
$sql = "SELECT id_proveedor, Nombre FROM proveedor";
$resultado = $conn->query($sql);
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
    <title>Cafetería Liceo Pre Universitario del Norte - Registrar Producto</title>
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
            <li><a class="dropdown-item" href="../../pagina_administracion.php">Exit</a></li>
            <li><a class="dropdown-item" href="../../cerrar-sesion.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div id="layoutSidenav">
      <?php include '../../conexion/menu.php'; ?>
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
                <form id="formProducto" enctype="multipart/form-data" action="create_productos.php" method="POST">
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="nombre" class="form-label">Nombre</label>
                      <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        name="nombre"
                        required
                      />
                    </div>
                    <div class="col-md-6">
                      <label for="precio" class="form-label"
                        >Precio de Venta</label>
                      <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        id="precio"
                        name="precio"
                        required
                      />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="stock" class="form-label">Stock</label>
                      <input
                        type="number"
                        class="form-control"
                        id="stock"
                        name="stock"
                        required
                      />
                    </div>
                    <div class="col-md-6">
                      <label for="proveedor" class="form-label">Proveedor</label>
                      <select class="form-select" id="proveedor" name="fk_proveedor" required>
                        <option value="" disabled selected>Selecciona un proveedor</option>

                        <?php while ($fila = $resultado->fetch_assoc()) { ?>
                          <option value="<?php echo $fila['id_proveedor']; ?>">
                            <?php echo $fila['Nombre']; ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="proveedor" class="form-label">Tipo de producto</label>
                      <select class="form-select" id="proveedor" name="tipo_producto" required>
                        <option value="" disabled selected>Selecciona un producto</option>
                        <option value="comidas" >comidas</option>
                        <option value="postres" >postres</option>
                        <option value="bebidasfrias" >bebidas frías</option>
                        <option value="bebidascalientes" >bebidas calientes</option>
                        <option value="snacks" >snacks</option>
                        <option value="dulces" >dulces</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="codigo" class="form-label"
                        >Código de barra</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="codigo"
                        name="codigo_barra"
                        required
                      />
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="descripcion" class="form-label"
                      >Descripción</label
                    >
                    <textarea
                      class="form-control"
                      id="descripcion"
                      name="descripcion"
                      rows="3"
                    ></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="img" class="form-label">Imagen</label>
                    <input
                      type="file"
                      class="form-control"
                      id="img"
                      name="imagen"
                      accept="image/*"
                    />
                  </div>

                  <!-- Campos ocultos o manejados por el sistema -->
                  <input
                    type="hidden"
                    name="create_by"
                    value="usuario_actual"
                  />
                  <input
                    type="hidden"
                    name="update_by"
                    value="usuario_actual"
                  />
                  <input type="hidden" name="create_at" value="" />
                  <input type="hidden" name="update_at" value="" />

                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <button type="reset" class="btn btn-danger">
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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="../js/scripts.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="js/datatables-simple-demo.js"></script>
  </body>
</html>