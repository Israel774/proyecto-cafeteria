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
        <!-- contenido-->
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4"></h1>
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-box-open me-1"></i>
                Nueva Compra
              </div>
              <div class="card-body">
                <form id="formProducto" ethod="POST" action="createc.php" >
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="encargado" class="form-label">Encargado</label>
                      <input
                        type="text"
                        class="form-control"
                        id="encargado"
                        name="encargado"
                        required
                      />
                    </div>
                    <div class="col-md-6">
                      <label for="proveedor" class="form-label"
                        >Proveedor</label>
                      <select class="form-select" id="validationCustom04" name = "proveedor">
                            <option selected="" disabled="" value="">Seleccionar</option>
                            <option>Juan Pérez</option>
                            <option>Maria López</option>
                          </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="metodo_de_pago" class="form-label"
                        >Metodo de Pago</label
                      >
                   <select class="form-select" id="validationCustom04" name = "metodo_de_pago">
                            <option selected="" disabled="" value="">Seleccionar</option>
                            <option>Efectivo</option>
                            <option>Transferencia</option>
                          </select>

                      
                    </div>
                  
                   <div class="col-md-6">
                      <label for="total_compra" class="form-label"
                        >Total Compra</label
                      >
                      <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        id="total_compra"
                        name="total_compra"
                        required
                      />
                    </div>
                  </div>

                  <div class="row mb-3">
                
                     <label for="observaciones" class="form-label"
                      >Observaciones</label
                    >
                    <textarea
                      class="form-control"
                      id="observaciones"
                      name="observaciones"
                      rows="3"
                    ></textarea>
                  </div>

                  <div class="mb-3">
                    
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

                  <button type="submit" class="btn btn-primary">Detallar</button>
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
