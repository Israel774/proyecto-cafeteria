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
                    <!-- parte2fin-->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-coffee me-1"></i>
                            Ventas Diarias
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="display nowrap table table-hover" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre del Cliente</th>
                                        <th>Cantidad</th>
                                        <th>Total Pagado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Gaseosa Coca-Cola 500ml</td>
                                        <td>1</td>
                                        <td>Q5.00</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="delete.php?id=1" class="btn btn-danger" title="Borrar">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </a>
                                                <a href="edit.php?id=1" class="btn"
                                                    style="background-color: #ffc107; color: black; border: 1px solid #ffc107;"
                                                    title="Editar">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>



                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Tortilla con frijol y queso</td>
                                        <td>4</td>
                                        <td>Q30.00</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="delete.php?id=2" class="btn btn-danger" title="Borrar">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    <a href="edit.php?id=1" class="btn"
                                                        style="background-color: #ffc107; color: black; border: 1px solid #ffc107;"
                                                        title="Editar">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>



                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Pan dulce</td>
                                        <td>5</td>
                                        <td>Q40.00</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="delete.php?id=3" class="btn btn-danger" title="Borrar">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </a>
                                                <a href="edit.php?id=1" class="btn"
                                                    style="background-color: #ffc107; color: black; border: 1px solid #ffc107;"
                                                    title="Editar">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>


                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Café</td>
                                        <td>7</td>
                                        <td>Q25.00</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="delete.php?id=4" class="btn btn-danger" title="Borrar">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </a>
                                                <a href="edit.php?id=1" class="btn"
                                                    style="background-color: #ffc107; color: black; border: 1px solid #ffc107;"
                                                    title="Editar">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>



                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <script src="https://kit.fontawesome.com/76679858d1.js" crossorigin="anonymous"></script>
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                                crossorigin="anonymous"></script>

                            <!-- DataTables -->
                            <link rel="stylesheet"
                                href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
                            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
                            <script>
                            $(document).ready(function() {
                                $('#miTabla').DataTable({
                                    responsive: true,
                                    language: {
                                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                                    }
                                });
                            });
                            </script>



                        </div>
                    </div>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous">
    </script>




</body>

</html>