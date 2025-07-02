<?php
include("conexion.php");
$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$r = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($r);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalle del Usuario</title>

    <!-- Bootstrap y estilos -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Sidebar -->
    

    <!-- Main Content -->
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-danger mb-4 text-center">Detalle del Usuario</h2>
            <div class="card shadow p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="<?= $row['nombre'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellidos</label>
                        <input type="text" class="form-control" value="<?= $row['apellido'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="number" class="form-control" value="<?= $row['telefono'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tipo</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($row['tipo']) ?>" disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Correo</label>
                        <input type="text" class="form-control" value="<?= $row['correo'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <input type="text" class="form-control" value="<?= $row['estado'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Código de Barra</label>
                        <input type="text" class="form-control" value="<?= $row['codigobarra'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nickname</label>
                        <input type="text" class="form-control" value="<?= $row['nickname'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contraseña</label>
                        <input type="text" class="form-control" value="<?= $row['contraseña'] ?>" disabled>
                    </div>

                    <div class="col-12 text-center mt-4">
                        <a href="registro.php" class="btn btn-success">
                            <i class="fas fa-arrow-left me-2"></i>Volver al listado
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    

</body>

</html>