<?php
session_start();
if (!isset($_SESSION['nickname'])) {
    // No ha iniciado sesión, redirigir
    header("Location: ../../index.html");
    exit;
}
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['nickname'])) {
    header('Location: ../index.php');
    exit();
}

// Verifica el rol del usuario
if ($_SESSION['rol'] != 'Cajero') {
    echo "<script>alert(Acceso denegado. Solo para cajeros pueden acceder a esta página.); window.history.back()</script>";
    exit();
}

//verifica si el usuario está activo
if ($_SESSION['estado'] == 'Eliminado') {
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
    <title>Cafetería Liceo Pre Universitario del Norte - Recargas</title>
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
                    <li><a class="dropdown-item" href="cerrar.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <?php include '../menu.php'; ?>
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
                    <!-- ***************************************CONTENIDO************************************************ -->

                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4"></h1>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fa-solid fa-cash-register"></i>
                                    Recargar Saldo
                                    <!-- Titulo principal-->
                                </div>
                                <div class="card-body">
                                    <form id="recargaForm" method="POST" action="recargec.php" target="_blank">
                                        <div class="row mb-3">




                                            <!-- Campo para ingresar el código de barras -->
                                            <div class="mb-3">
                                                <label for="barras" class="form-label">Código de Barras</label>
                                                <input type="text" class="form-control" id="codigobarra"
                                                    name="codigobarra" required oninput="buscarNombre()" />
                                            </div>

                                            <!-- Campos que se llenarán automáticamente -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="nombre" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                                        readonly />
                                                </div>


                                                <div class="col-md-6">
                                                    <label for="precio" class="form-label">Apellido</label>
                                                    <input type="text" class="form-control" id="apellido"
                                                        name="apellido" readonly />
                                                </div>
                                            </div>
                                            <!-- Label bloqueado para mostrar saldo antes de la recarga -->
                                            <div class="col-md-6">
                                                <label for="nombre" class="form-label">Saldo anterior</label>
                                                <input type="text" class="form-control" id="saldo" name="saldo"
                                                    readonly /> <!-- disabled -->
                                            </div>
                                            <!-- label para la suma del saldo anterior con el monto a recargar -->








                                            <div class="col-md-6">
                                                <label for="saltotal" class="form-label">Saldo total</label>
                                                <input type="number" step="0.01" class="form-control" id="saltotal"
                                                    name="saltotal" readonly />
                                            </div>
                                        </div>
                                        <!-- Label monto del saldo a recargar -->
                                        <div class="mb-3">
                                            <label for="salrecarga" class="form-label">Saldo a Recargar</label>
                                            <input type="number" step="0.01" class="form-control" id="salrecarga"
                                                name="salrecarga" required oninput="calcularSaldoTotal()" />
                                        </div>
                                        <!-- Label con select de los metodos de pago -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="proveedor" class="form-label">Metodo de Pago</label>
                                                <select class="form-select" id="metodoPago" name="metodoPago" required>
                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="Tarjeta" disabled>Tarjeta</option>

                                                </select>
                                            </div>
                                            <!-- Label con select para marcar si necesita recibo -->


                                            <div class="col-md-6">
                                                <label for="proveedor" class="form-label">¿Necesita Recibo?</label>
                                                <select class="form-select" id="recibo" name="recibo" required>
                                                    <!-- Pendiente a correccion de ID, name y DB -->
                                                    <option value="No">No</option>
                                                    <option value="Si">Si</option>
                                                    <!-- Aquí puedes cargar los proveedores desde base de datos -->
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Campos ocultos o manejados por el sistema -->
                                        <input type="hidden" name="create_by" value="<?php echo htmlspecialchars($_SESSION['nickname']); ?>" />
                                        <input type="hidden" name="update_by" value="<?php echo htmlspecialchars($_SESSION['nickname']); ?>" />
                                        <input type="hidden" name="create_at" value="" />
                                        <input type="hidden" name="update_at" value="" />

                                        <div class="d-flex gap-2 mb-2">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-plus"></i> Agregar
                                            </button>
                                            <button type="reset" class="btn btn-danger">
                                                <i class="fas fa-times"></i> Cancelar
                                            </button>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                                            <!--
                                            <a href="list.php" class="btn btn-warning" style="background-color: orange; color: #fff;">
                                                <i class="fas fa-list"></i> Listado
                                            </a>
                                            <a href="reporte.php" class="btn btn-warning" style="background-color: orange; color: #fff;">
                                                <i class="fas fa-file-alt"></i> Reportes
                                            </a>
                                            -->
                        </div>
                       
                    </main>
                    <!-- FIN CONTENIDO -->
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
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

    <script>
    // Obtener referencias a los elementos del DOM usando tus IDs
    const codigoBarrasInput = document.getElementById('codigobarra');
    const nombreInput = document.getElementById('nombre'); // Tu input para el nombre
    const apellidoInput = document.getElementById('apellido'); // Tu input para el apellido
    const saldoInput = document.getElementById('saldo'); // Tu input para el saldo
    const salRecargaInput = document.getElementById('salrecarga'); // Saldo a recargar (ingresado por usuario)
    const salTotalInput = document.getElementById('saltotal'); // Saldo total (calculado)

    // Función para buscar el nombre, apellido y saldo haciendo una solicitud a PHP
    async function buscarNombre() {
        const codigo = codigoBarrasInput.value.trim(); // Obtener el valor del input y limpiar espacios

        // Limpiar los campos y mostrar "Buscando..."
        nombreInput.value = 'Buscando...';
        apellidoInput.value = 'Buscando...';
        saldoInput.value = 'Buscando...';

        nombreInput.style.color = 'gray';
        apellidoInput.style.color = 'gray';
        saldoInput.style.color = 'gray';

        if (codigo === '') {
            nombreInput.value = ''; // Vaciar si no hay código
            apellidoInput.value = '';
            saldoInput.value = '';
            nombreInput.style.color = ''; // Resetear color
            apellidoInput.style.color = '';
            saldoInput.style.color = '';
            return;
        }

        try {
            // Realizar la solicitud POST a tu archivo PHP (buscar_nombre.php)
            // ¡AJUSTA ESTA URL SI ES NECESARIO!
            // Por ejemplo, si 'buscar_nombre.php' está en una subcarpeta 'api': 'api/buscar_nombre.php'
            const response = await fetch('buscar_nombre.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    codigobarra: codigo
                })
            });

            // Verificar si la respuesta fue exitosa
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            // Parsear la respuesta JSON del PHP
            const data = await response.json();

            // Actualizar los campos con los valores recibidos
            if (data.nombre && data.apellido && (data.saldo !== undefined)) { // Verificar que los datos existen
                nombreInput.value = data.nombre;
                apellidoInput.value = data.apellido;
                saldoInput.value = data.saldo; // El saldo puede ser 0 o un número

                // Cambiar color según si se encontró o no
                const textColor = (data.nombre === 'No encontrado' || data.apellido === 'No encontrado' || data
                    .saldo === 'No encontrado') ? 'red' : 'black';
                nombreInput.style.color = textColor;
                apellidoInput.style.color = textColor;
                saldoInput.style.color = textColor;

            } else {
                // Esto debería capturar si el PHP devuelve un error o una estructura inesperada
                nombreInput.value = 'Error al obtener datos';
                apellidoInput.value = '';
                saldoInput.value = '';
                nombreInput.style.color = 'red';
                apellidoInput.style.color = 'red';
                saldoInput.style.color = 'red';
            }

        } catch (error) {
            console.error('Error al comunicarse con el backend:', error);
            nombreInput.value = 'Error de conexión';
            apellidoInput.value = '';
            saldoInput.value = '';
            nombreInput.style.color = 'red';
            apellidoInput.style.color = 'red';
            saldoInput.style.color = 'red';
        } finally {
            // Lógica final si es necesaria
        }
    }

    function calcularSaldoTotal() {
        // Obtener los valores y convertirlos a números flotantes
        const saldoAnterior = parseFloat(saldoInput.value) || 0; // Si no es un número, se asume 0
        const saldoARecargar = parseFloat(salRecargaInput.value) || 0; // Si no es un número, se asume 0

        const saldoTotal = saldoAnterior + saldoARecargar;

        // Mostrar el saldo total en el input correspondiente, formateado a 2 decimales
        salTotalInput.value = saldoTotal.toFixed(2);
        salTotalInput.style.color = 'green'; // Opcional: color para el total
    }
    </script>






</body>

</html>