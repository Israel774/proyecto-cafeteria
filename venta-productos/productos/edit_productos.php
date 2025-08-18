<?php
  session_start();
  // Verifica si el usuario ha iniciado sesión
  if (!isset($_SESSION['nickname'])) {
      header('Location: ../index.php');
      exit();
  }

// Verifica el rol del usuario
if ($_SESSION['rol'] != 'Reportes&productos') {
    echo "<script>alert(Acceso denegado. Solo los de ventas y productos pueden acceder a esta página.); window.history.back()</script>";
    exit();
}

//verifica si el usuario está activo
if ($_SESSION['estado'] == 'Eliminado') {
    echo "<script>alert('Cuenta inactiva. Consulta con los administradores si se trata de algun error'); window.history.back();</script>";
    exit();
} 
include("../../conexion/conexion.php");
$conn = conectar();
$id_productos = $_GET['id_productos'];

// Consulta del producto con nombre del proveedor
$sql = "SELECT productos.*, proveedor.Nombre AS nombre_proveedor
        FROM productos
        INNER JOIN proveedor ON productos.fk_proveedor = proveedor.id_proveedor
        WHERE productos.id_productos = '$id_productos'";

$r = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($r);

// Consulta de todos los proveedores
$sql_proveedores = "SELECT id_proveedor, Nombre FROM proveedor";
$resultado_proveedores = mysqli_query($conn, $sql_proveedores);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar producto - PREU</title>

    <!-- FontAwesome, Bootstrap y estilos -->
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
            <h2 class="text-primary text-center mb-4">Editar Producto</h2>
            <form action="update_productos.php" method="POST" class="card p-4 shadow" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $row['id_productos'] ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?= $row['nombre'] ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Precio Venta</label>
                        <input type="number" class="form-control" name="precio" value="<?= $row['precio'] ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" value="<?= $row['stock'] ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="proveedor" class="form-label">Proveedor</label>
                        <select class="form-select" id="proveedor" name="fk_proveedor" required>
                            <option value="<?= $row['fk_proveedor'] ?>" selected><?= $row['nombre_proveedor'] ?></option>
                            <?php while ($fila = $resultado_proveedores->fetch_assoc()) { ?>
                                <?php if ($fila['id_proveedor'] != $row['fk_proveedor']) { ?>
                                    <option value="<?= $fila['id_proveedor']; ?>">
                                        <?= $fila['Nombre']; ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tipo de Producto</label>
                        <select class="form-select" id="proveedor" name="tipo_producto" required>
                            <option value="<?= $row['tipo_producto'] ?>" selected><?= $row['tipo_producto'] ?></option>
                            <option value="comidas">comidas</option>
                            <option value="postres">postres</option>
                            <option value="bebidasfrias">bebidas frías</option>
                            <option value="bebidascalientes">bebidas calientes</option>
                            <option value="snacks">snacks</option>
                            <option value="dulces">dulces</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Código de Barra</label>
                        <input type="text" class="form-control" value="<?= $row['codigo_barra'] ?>" readonly>
                        <input type="hidden" name="codigobarra" value="<?= $row['codigo_barra'] ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Descripción</label>
                        <textarea
                            class="form-control"
                            id="descripcion"
                            name="descripcion"
                            rows="3"
                            style="resize: none;"
                            required
                        ><?= htmlspecialchars($row['descripcion']) ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Imagen</label>
                        <?php if (!empty($row['imagen'])): ?>
                            <div class="mb-2">
                                <img src="../../<?= $row['imagen'] ?>" alt="Imagen actual" width="100">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="imagen" accept="image/*" />
                        <input type="hidden" name="imagen_actual" value="<?= $row['imagen'] ?>">
                    </div>

                    <div class="col-12 text-center">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-save me-2"></i>Actualizar
                        </button>
                        <a href="productos_registrados.php" class="btn btn-danger ms-2">
                            <i class="fas fa-arrow-left me-2"></i>Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
