<?php
session_start();
// ... (código PHP no modificado) ...
if (!isset($_SESSION['nickname'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SESSION['rol'] != 'Administrador') {
    echo "<script>alert('Acceso denegado. Solo los administradores pueden acceder a esta página.'); window.history.back()</script>";
    exit();
}

if ($_SESSION['estado'] == 'Eliminado') {
    echo "<script>alert('Cuenta inactiva. Consulta con los administradores si se trata de algun error'); window.history.back();</script>";
    exit();
}
include("../../conexion/conexion.php");
$conn = conectar();
$id_usuario = $_GET['id_usuario'];
$sql = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'";
$r = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($r);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ver Usuario - PREU</title>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    
    <style>
        .btn-naranja {
            background-color: orange;
            color: white;
            border: 1px solid orange;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
            transition: background-color 0.3s, color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-naranja:hover {
            background-color: #e69500;
            color: white;
            border-color: #e69500;
            cursor: pointer;
        }

        /* Oculta el área de impresión por defecto */
        #print-area {
            display: none;
        }

        /* Estilos para la impresión */
        @media print {
            /* Oculta todo el contenido del body excepto el área de impresión */
            body > *:not(#print-area) {
                display: none;
            }
            /* Muestra el área de impresión y la posiciona para que sea la única visible */
            #print-area {
                display: block !important;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%; /* Asegura que ocupe todo el espacio de la página */
            }
            /* Elimina los márgenes del navegador para la impresión */
            @page {
                size: auto;
                margin: 0;
            }
        }
        
        .print-container {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-primary text-center mb-4">Ver Usuario</h2>
            <form class="card p-4 shadow">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($row['nombre']) ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellido" value="<?= htmlspecialchars($row['apellido']) ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Codigo de cliente</label>
                        <input type="text" class="form-control" id="codigo-cliente" name="modificacion" value="<?= htmlspecialchars($row['modificacion']) ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="<?= htmlspecialchars($row['telefono']) ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" name="tipo" disabled>
                            <option value="Administrador" <?= $row['tipo'] == 'Administrador' ? 'selected' : '' ?>>Administrador</option>
                            <option value="Alumno" <?= $row['tipo'] == 'Alumno' ? 'selected' : '' ?>>Alumno</option>
                            <option value="Docente" <?= $row['tipo'] == 'Docente' ? 'selected' : '' ?>>Docente</option>
                            <option value="Dependente" <?= $row['tipo'] == 'Dependente' ? 'selected' : '' ?>>Dependente</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" value="<?= htmlspecialchars($row['correo']) ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="estado" disabled>
                            <option value="Activo" <?= $row['estado'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
                            <option value="Inactivo" <?= $row['estado'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Código SICA</label>
                        <input type="text" class="form-control" name="codigobarra" value="<?= htmlspecialchars($row['codigobarra']) ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nickname</label>
                        <input type="text" class="form-control" id="nickname" name="nickname" value="<?= htmlspecialchars($row['nickname']) ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contraseña</label>
                        <input type="text" class="form-control" id="password" name="contraseña" value="<?= htmlspecialchars($row['contraseña_plano']) ?>" disabled>
                    </div>
                    
                    <div class="col-12 text-center mt-4">
                        <a href="registro.php" class="btn btn-xs btn-naranja">
                            <i class="fas fa-arrow-left me-2"></i>Volver al listado
                        </a>
                        <button type="button" class="btn btn-xs btn-naranja" onclick="imprimirDatosUsuario()">
                            <i class="fas fa-print me-2"></i>Imprimir datos
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div id="print-area" class="print-container">
        <h3 style="margin-bottom: 5px;">Datos de Acceso</h3>
        <p style="margin-bottom: 3px;"><strong>Usuario:</strong> <span id="print-nickname"></span></p>
        <p style="margin-bottom: 3px;"><strong>Contraseña:</strong> <span id="print-password"></span></p>
        <p style="margin-bottom: 20px;"><strong>Código de Cliente:</strong> <span id="print-codigo-cliente"></span></p>
        <div>
            <svg id="barcode"></svg>
        </div>
    </div>

    <script>
        function imprimirDatosUsuario() {
            // Obtener los datos del formulario
            const nickname = document.getElementById('nickname').value;
            const password = document.getElementById('password').value;
            const codigoCliente = document.getElementById('codigo-cliente').value;

            // Llenar el área de impresión
            document.getElementById('print-nickname').innerText = nickname;
            document.getElementById('print-password').innerText = password;
            document.getElementById('print-codigo-cliente').innerText = codigoCliente;
            
            // Generar el código de barras con los nuevos tamaños
            JsBarcode("#barcode", codigoCliente, {
                format: "CODE128", 
                displayValue: true,
                width: 1.5, 
                height: 20 
            });

            // Llamar a la función de impresión
            window.print();
        }
    </script>
</body>
</html>