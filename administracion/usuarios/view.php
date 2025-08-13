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
                        <label class="form-label">Modificación</label>
                        <input type="text" class="form-control" name="modificacion" value="<?= htmlspecialchars($row['modificacion']) ?>" disabled>
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
                        <label class="form-label">Código de Barra</label>
                        <input type="text" class="form-control" name="codigobarra" value="<?= htmlspecialchars($row['codigobarra']) ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nickname</label>
                        <input type="text" class="form-control" name="nickname" value="<?= htmlspecialchars($row['nickname']) ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contraseña</label>
                        <input type="text" class="form-control" name="contraseña" value="<?= htmlspecialchars($row['contraseña']) ?>" disabled>
                    </div>
                    
                    <div class="col-12 text-center mt-4">
                        <a href="registro.php" class="btn btn-xs btn-naranja">
                            <i class="fas fa-arrow-left me-2"></i>Volver al listado
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>