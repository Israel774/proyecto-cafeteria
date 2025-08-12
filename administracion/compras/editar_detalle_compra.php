<?php
// Incluir el archivo de conexi\u00f3n a la base de datos
include("../../conexion/conexion.php");

// Inicia la sesi\u00f3n
session_start();
if (!isset($_SESSION['nickname'])) {
    header('Location: ../index.php');
    exit();
}

// 1. Obtener el ID de la compra de la URL
if (!isset($_GET['id_compras']) || empty($_GET['id_compras'])) {
    die("Error: ID de compra no proporcionado.");
}
$id_compras = $_GET['id_compras'];

// 2. Consulta para obtener la informaci\u00f3n principal de la compra
// Usamos una consulta preparada para seguridad
$sql_compra = "SELECT c.*, p.Nombre AS nombre_proveedor
               FROM compras c
               LEFT JOIN proveedor p ON c.fk_proveedor = p.id_proveedor
               WHERE c.id_compras = ?";
$stmt_compra = mysqli_prepare($conn, $sql_compra);
mysqli_stmt_bind_param($stmt_compra, "i", $id_compras);
mysqli_stmt_execute($stmt_compra);
$result_compra = mysqli_stmt_get_result($stmt_compra);
$compra_info = mysqli_fetch_array($result_compra);
mysqli_stmt_close($stmt_compra);

// Verificar si se encontr\u00f3 la compra
if (!$compra_info) {
    die("Error: Compra no encontrada.");
}

// 3. Consulta para obtener todos los productos y sus detalles para esta compra
// Se a\u00f1ade la condici\u00f3n 'estado = 1'
$sql_detalles = "SELECT dc.id_detalle_compra, dc.cantidad, dc.precio, dc.sub_total, p.nombre, p.id_productos
                 FROM detalle_compras dc
                 LEFT JOIN productos p ON dc.fk_producto = p.id_productos
                 WHERE dc.fk_compras = ? AND dc.estado = 1";
$stmt_detalles = mysqli_prepare($conn, $sql_detalles);

if ($stmt_detalles === false) {
    die("Error en la preparaci\u00f3n de la consulta: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt_detalles, "i", $id_compras);
mysqli_stmt_execute($stmt_detalles);
$result_detalles = mysqli_stmt_get_result($stmt_detalles);

// 4. Consulta para obtener la lista completa de productos para el dropdown
$sql_productos = "SELECT id_productos, nombre FROM productos ORDER BY nombre ASC";
$result_productos = mysqli_query($conn, $sql_productos);

$productos_disponibles = [];
while ($row_prod = mysqli_fetch_assoc($result_productos)) {
    $productos_disponibles[] = $row_prod;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Detalles de Compra - PREU</title>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-primary text-center mb-4">Editar Detalles de Compra #<?php echo htmlspecialchars($id_compras); ?></h2>

            <div class="card p-4 shadow mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Encargado:</strong> <?php echo htmlspecialchars($compra_info['encargado']); ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Proveedor:</strong> <?php echo htmlspecialchars($compra_info['nombre_proveedor']); ?>
                    </div>
                </div>
            </div>

            <form action="update_detalle_compras.php" method="POST" id="form-detalles" class="card p-4 shadow">
                <input type="hidden" name="id_compras" value="<?php echo htmlspecialchars($id_compras); ?>">

                <h4 class="mb-3">Productos de la Compra</h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (mysqli_num_rows($result_detalles) > 0) {
                                while ($detalle = mysqli_fetch_assoc($result_detalles)) {
                            ?>
                            <tr data-id="<?php echo htmlspecialchars($detalle['id_detalle_compra']); ?>">
                                <td>
                                    <select class="form-control" name="detalles[<?php echo htmlspecialchars($detalle['id_detalle_compra']); ?>][fk_producto]">
                                        <?php foreach ($productos_disponibles as $producto) { ?>
                                            <option value="<?php echo htmlspecialchars($producto['id_productos']); ?>"
                                                <?php echo ($producto['id_productos'] == $detalle['id_productos']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($producto['nombre']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control cantidad"
                                        name="detalles[<?php echo htmlspecialchars($detalle['id_detalle_compra']); ?>][cantidad]"
                                        value="<?php echo htmlspecialchars($detalle['cantidad']); ?>" step="1" min="1" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control precio-unitario"
                                        name="detalles[<?php echo htmlspecialchars($detalle['id_detalle_compra']); ?>][precio_unitario]"
                                        value="<?php echo htmlspecialchars($detalle['precio']); ?>" step="0.01" min="0" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control subtotal"
                                        name="detalles[<?php echo htmlspecialchars($detalle['id_detalle_compra']); ?>][subtotal]"
                                        value="<?php echo htmlspecialchars($detalle['sub_total']); ?>" readonly>
                                </td>
                                <td class="text-center">
                                    <a href="delete_detalle_compras.php?id_detalle_compras=<?php echo htmlspecialchars($detalle['id_detalle_compra']); ?>"
                                        class="btn btn-danger btn-sm" title="Eliminar Detalle de Compra">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo '<tr><td colspan="5" class="text-center text-muted">No se encontraron detalles para esta compra.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-12 text-center mt-4">
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-save me-2"></i>Actualizar Detalles
                    </button>
                    <a href="listado.php" class="btn btn-danger ms-2">
                        <i class="fas fa-arrow-left me-2"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-detalles');
            
            // Funci\u00f3n para calcular el subtotal de una fila
            function calcularSubtotal(row) {
                const cantidadInput = row.querySelector('.cantidad');
                const precioInput = row.querySelector('.precio-unitario');
                const subtotalInput = row.querySelector('.subtotal');

                const cantidad = parseFloat(cantidadInput.value);
                const precio = parseFloat(precioInput.value);

                if (!isNaN(cantidad) && !isNaN(precio)) {
                    const subtotal = cantidad * precio;
                    subtotalInput.value = subtotal.toFixed(2);
                } else {
                    subtotalInput.value = '';
                }
            }

            // A\u00f1adir un listener a todos los campos de cantidad y precio
            form.querySelectorAll('.cantidad, .precio-unitario').forEach(input => {
                input.addEventListener('input', function () {
                    const row = this.closest('tr');
                    calcularSubtotal(row);
                });
            });

            // Calcular el subtotal inicial al cargar la p\u00e1gina para cada fila
            form.querySelectorAll('tbody tr').forEach(row => {
                calcularSubtotal(row);
            });
        });
    </script>
</body>

</html>
