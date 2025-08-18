<?php
session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['nickname'])) {
    header('Location: ../index.php');
    exit();
}

// Verifica el rol del usuario
if ($_SESSION['rol'] != 'Administrador') {
    echo "<script>alert('Acceso denegado. Solo los administradores pueden acceder a esta página.'); window.history.back();</script>";
    exit();
}

// Verifica si el usuario está activo
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
    <title>Editar Usuario - PREU</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-primary text-center mb-4">Editar Usuario</h2>
            <form action="update.php" method="POST" class="card p-4 shadow">
                <input type="hidden" name="id" value="<?= $row['id_usuario'] ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $row['nombre'] ?>"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellido" id="apellido"
                            value="<?= $row['apellido'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Codigo de cliente</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="modificacion" id="modificacion"
                                value="<?= $row['modificacion'] ?>" required>
                            <button class="btn btn-primary" type="button" id="generarBtn">Generar nuevo</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="<?= $row['telefono'] ?>"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" name="tipo" required>
                            <option value="" disabled <?= empty($row['tipo']) ? 'selected' : '' ?>>Seleccionar</option>
                            <option value="Administrador" <?= $row['tipo'] == 'Administrador' ? 'selected' : '' ?>>
                                Administrador</option>
                            <option value="Alumno" <?= $row['tipo'] == 'Alumno' ? 'selected' : '' ?>>Alumno</option>
                            <option value="Docente" <?= $row['tipo'] == 'Docente' ? 'selected' : '' ?>>Docente</option>
                            <option value="Dependente" <?= $row['tipo'] == 'Dependente' ? 'selected' : '' ?>>Dependente
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" value="<?= $row['correo'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="estado" required>
                            <option value="Activo" <?= $row['estado'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
                            <option value="Inactivo" <?= $row['estado'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Código SICA</label>
                        <input type="text" class="form-control" name="codigobarra" value="<?= $row['codigobarra'] ?>"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nickname</label>
                        <input type="text" class="form-control" name="nickname" value="<?= $row['nickname'] ?>"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contraseña</label>
                        <input type="text" class="form-control" name="contraseña" value="<?= $row['contraseña_plano'] ?>"
                            required>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-save me-2"></i>Actualizar
                        </button>
                        <a href="registro.php" class="btn btn-danger ms-2">
                            <i class="fas fa-arrow-left me-2"></i>Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nombreInput = document.getElementById('nombre');
            const apellidoInput = document.getElementById('apellido');
            const modificacionInput = document.getElementById('modificacion');
            const generarBtn = document.getElementById('generarBtn');

            async function generarYValidarModificacion() {
                const nombre = nombreInput.value.trim().toLowerCase();
                const apellido = apellidoInput.value.trim().toLowerCase();

                if (nombre.length < 2 || apellido.length < 2) {
                    alert('Por favor, ingresa al menos 2 letras en Nombre y Apellido para generar el código.');
                    return;
                }

                let codigoGenerado;
                let codigoUnicoEncontrado = false;
                let intentos = 0;
                const maxIntentos = 10;

                while (!codigoUnicoEncontrado && intentos < maxIntentos) {
                    const letras = nombre.slice(0, 2) + apellido.slice(0, 2);
                    const numeros = '0123456789';
                    let aleatorios = '';
                    for (let i = 0; i < 4; i++) {
                        aleatorios += numeros.charAt(Math.floor(Math.random() * numeros.length));
                    }
                    codigoGenerado = (letras + aleatorios).toUpperCase();

                    // Verificar si el código ya existe en la base de datos
                    const response = await fetch(`verificar_modificacion.php?modificacion=${codigoGenerado}`);
                    const data = await response.json();

                    if (data.existe === false) {
                        codigoUnicoEncontrado = true;
                    }
                    intentos++;
                }

                if (codigoUnicoEncontrado) {
                    modificacionInput.value = codigoGenerado;
                } else {
                    alert('No se pudo generar un código único después de varios intentos. Por favor, intente de nuevo.');
                }
            }

            // Agrega el evento click al nuevo botón
            generarBtn.addEventListener('click', generarYValidarModificacion);

            // Código para limpiar espacios en los inputs
            document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], input[type="number"]').forEach(input => {
                input.addEventListener('input', function () {
                    if (this.selectionStart === 1 && this.value.startsWith(' ')) {
                        this.value = this.value.trimStart();
                    }
                });
            });
        });
    </script>
</body>
</html>