<?php
include("../../conexion/conexion.php");
$sql = "SELECT * FROM usuario where estado = 'activo'" ;

$respuesta = mysqli_query($conn , $sql); 
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" />

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

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
        <a class="navbar-brand ps-3" href="../index.php">Inicio</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
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
                    <div class="container my-5">
                        <h2 class="text-center mb-4">Usuarios Registrados</h2>
                        <div class="table-responsive shadow rounded mx-auto" style="max-width: 1100px;">
                            <table id="datatablesSimple" class="table table-striped table-hover align-middle">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col" style="width: 160px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    while($row = mysqli_fetch_array($respuesta)):
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['nombre']; ?></td>
                                        <td><?php echo $row['apellido']; ?></td>
                                        <td><?php echo $row['telefono']; ?></td>
                                        <td><?php echo $row['tipo']; ?></td>
                                        <td class="text-center">
                                            <a href="delete.php?id_usuario=<?php echo $row['id_usuario']; ?>"
                                                title="Borrar Registro">
                                                <button type="button" class="btn btn-outline-danger btn-xs btn-margin">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </a>
                                            <a href="edit.php?id_usuario=<?php echo $row['id_usuario']; ?>"
                                                title="Editar Registro">
                                                <button type="button" class="btn btn-outline-warning btn-xs btn-margin">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>
                                            <a href="view.php?id_usuario=<?php echo $row['id_usuario']; ?>"
                                                title="Ver Registro">
                                                <button type="button" class="btn btn-xs btn-outline-rosado">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>

                                    <?php if (mysqli_num_rows($respuesta) === 0) : ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No hay usuarios registrados.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4"></div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>

    <script src="js/scripts.js"></script>

    <script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple, {

                labels: {
                    perPage: "Entradas por página",
                    noRows: "No se encontraron resultados",
                    info: "Mostrando {start} a {end} de {rows} entradas",
                    loading: "Cargando...",
                    pagination: {
                        previous: "Anterior",
                        next: "Siguiente",
                        navigate: "Ir a la página",
                        page: "Página",
                        showing: "Mostrando",
                        of: "de"
                    }
                }
            });
        }


        const sidebarToggle = document.body.querySelector('#sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', event => {
                event.preventDefault();
                document.body.classList.toggle('sb-sidenav-toggled');
                localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains(
                    'sb-sidenav-toggled'));
            });
        }

        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
    });

    function togglePassword() {
        const passInput = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (passInput && icon) {
            if (passInput.type === "password") {
                passInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    }
    </script>
</body>

</html>