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
$id_productos = $_GET['id_productos'];
$sql = "SELECT productos.*, proveedor.Nombre AS nombre_proveedor
        FROM productos
        INNER JOIN proveedor ON productos.fk_proveedor = proveedor.id_proveedor
        WHERE productos.id_productos = '$id_productos'";

$r = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($r);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ver Producto - Sistema</title>

  <!-- FontAwesome, Bootstrap y estilos -->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
      <h2 class="text-primary text-center mb-4">Detalles del Producto</h2>
      <form class="card p-4 shadow">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" value="<?= $row['nombre'] ?>" disabled>
          </div>

          <div class="col-md-6">
            <label class="form-label">Precio</label>
            <input type="text" class="form-control" value="Q <?= number_format($row['precio'], 2) ?>" disabled>
          </div>

          <div class="col-md-6">
            <label class="form-label">Stock</label>
            <input type="text" class="form-control" value="<?= $row['stock'] ?>" disabled>
          </div>

          <div class="col-md-6">
            <label class="form-label">Tipo de Producto</label>
            <input type="text" class="form-control" value="<?= $row['tipo_producto'] ?>" disabled>
          </div>

          <div class="col-md-6">
            <label class="form-label">Código de Barra</label>
            <input type="text" class="form-control" value="<?= $row['codigo_barra'] ?>" disabled>
          </div>

          <div class="col-md-6">
            <label class="form-label">Proveedor</label>
            <input type="text" class="form-control" value="<?= $row['nombre_proveedor'] ?>" disabled>
          </div>

          <div class="col-md-12">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" rows="3" disabled><?= $row['descripcion'] ?></textarea>
          </div>

          <?php if (!empty($row['imagen'])): ?>
          <div class="col-md-12 text-center">
            <label class="form-label d-block">Imagen del Producto</label>
            <img src="../../<?= $row['imagen'] ?>" alt="Imagen del producto" class="img-fluid rounded" style="max-height: 250px;">
          </div>
          <?php endif; ?>

          <div class="col-12 text-center mt-4">
            <a href="productos_registrados.php" class="btn btn-xs btn-naranja">
              <i class="fas fa-arrow-left me-2"></i>Volver al listado
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
