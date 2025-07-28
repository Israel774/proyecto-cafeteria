<?php
include("conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM ventas WHERE id = $id";
$resultado = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado);

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $nombre = $_POST['NombreP'];
    $cantidad = $_POST['CantidadP'];
    $subtotal = $_POST['SubTotal'];

    $update = "UPDATE VentaDia SET 
                NombreP = '$nombre', 
                CantidadP = '$cantidad', 
                SubTotal = $subtotal 
                WHERE Id = $id";

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
                        <label class="form-label">Nombre del Producto:</label>
                        <input type="text" name="NombreP" class="form-control" value="<?php echo $row['NombreP']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad:</label>
                        <input type="number" name="CantidadP" class="form-control" value="<?php echo $row['CantidadP']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SubTotal:</label>
                        <input type="number" name="SubTotal" class="form-control" step="0.01" value="<?php echo $row['SubTotal']; ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-outline-secondary">
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

    <!-- Bootstrap y FontAwesome JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
