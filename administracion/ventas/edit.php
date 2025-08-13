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
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("ID de venta inválido.");
}

$sql = "SELECT * FROM ventas WHERE id = $id";
$resultado = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = intval($_POST['id_cliente']);
    $total_pagado = floatval($_POST['total_pagado']);

    $update = "UPDATE ventas SET 
                id_cliente = $id_cliente, 
                total_pagado = $total_pagado,
                update_at = NOW() 
                WHERE id = $id";

    mysqli_query($conn, $update);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light fw-bold">
                <i class="fa-solid fa-pen-to-square me-2"></i> Editar Venta
            </div>
            <div class="card-body bg-white">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">ID Cliente:</label>
                        <input type="number" name="id_cliente" class="form-control" value="<?php echo $row['id_cliente']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Pagado:</label>
                        <input type="number" name="total_pagado" step="0.01" class="form-control" value="<?php echo $row['total_pagado']; ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="ventas_diarias.php" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-save"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
