<?php
session_start();
require_once '../conexion/conexion.php'; // Asegúrate de que la ruta sea correcta

// Verifica si el usuario está autenticado y si se ha pasado un id_venta
if (!isset($_SESSION['id_usuario']) || !isset($_GET['id_venta'])) {
    header('Location: historial_compras.php');
    exit();
}

$id_usuario = (int)$_SESSION['id_usuario'];
$id_venta = (int)$_GET['id_venta'];

// --- CONSULTA PARA OBTENER DATOS PRINCIPALES DE LA VENTA Y DEL CLIENTE ---
$stmt_venta = $conn->prepare("
    SELECT v.total_pagado, v.create_at, c.nombre, c.apellido 
    FROM ventas v
    JOIN clientes c ON v.id_cliente = c.id_cliente
    WHERE v.id_venta = ? AND v.id_cliente IN (
        SELECT id_cliente 
        FROM clientes 
        WHERE nickname = (SELECT nickname FROM usuario WHERE id_usuario = ?)
    )
");
$stmt_venta->bind_param("ii", $id_venta, $id_usuario);
$stmt_venta->execute();
$result_venta = $stmt_venta->get_result();

if ($venta = $result_venta->fetch_assoc()) {
    $fecha_hora_compra = new DateTime($venta['create_at']);
    $fecha_compra = $fecha_hora_compra->format('d/m/Y');
    $hora_compra = $fecha_hora_compra->format('h:i a');
    $total_pagado = $venta['total_pagado'];
    $nombre_cliente = htmlspecialchars($venta['nombre'] . ' ' . $venta['apellido']);

    // --- CONSULTA PARA OBTENER LOS DETALLES DE LOS PRODUCTOS DE LA VENTA ---
    $stmt_detalles = $conn->prepare("
        SELECT dv.cantidad, dv.precio_unitario, dv.subtotal, p.nombre 
        FROM detalle_ventas dv
        JOIN productos p ON dv.id_producto = p.id_productos
        WHERE dv.id_venta = ?
    ");
    $stmt_detalles->bind_param("i", $id_venta);
    $stmt_detalles->execute();
    $result_detalles = $stmt_detalles->get_result();

} else {
    // Si la venta no existe o no pertenece al usuario, redirigir
    echo "<script>alert('Venta no encontrada o no pertenece a su cuenta.'); window.location.href='historial.php';</script>";
    exit();
}

$stmt_venta->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detalles de la Compra</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center">

  <header class="w-full bg-gray-400 py-6 text-center shadow-md">
    <h1 class="text-3xl font-extrabold text-red-700 uppercase">Detalles de la compra</h1>
  </header>

  <main class="w-full max-w-4xl px-4 py-8 flex flex-col gap-6">

    <section class="bg-white p-6 rounded-2xl shadow-lg">
      <h2 class="text-xl font-bold text-gray-800 mb-4">Resumen del pedido</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
        <p><span class="font-semibold">ID del Pedido:</span> #<?php echo htmlspecialchars($id_venta); ?></p>
        <p><span class="font-semibold">Fecha:</span> <?php echo htmlspecialchars($fecha_compra); ?></p>
        <p><span class="font-semibold">Cliente:</span> <?php echo $nombre_cliente; ?></p>
        <p><span class="font-semibold">Hora de compra:</span> <?php echo htmlspecialchars($hora_compra); ?></p>
      </div>
    </section>

    <section class="bg-white p-6 rounded-2xl shadow-lg">
      <h2 class="text-xl font-bold text-gray-800 mb-4">Productos comprados</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
          <thead class="bg-emerald-100">
            <tr>
              <th class="px-4 py-2 text-left text-gray-700 font-semibold">Producto</th>
              <th class="px-4 py-2 text-center text-gray-700 font-semibold">Cantidad</th>
              <th class="px-4 py-2 text-right text-gray-700 font-semibold">Precio unitario</th>
              <th class="px-4 py-2 text-right text-gray-700 font-semibold">Subtotal</th>
            </tr>
          </thead>
          <tbody class="divide-y text-gray-700">
            <?php if ($result_detalles && $result_detalles->num_rows > 0): ?>
            <?php while ($detalle = $result_detalles->fetch_assoc()): ?>
            <tr>
              <td class="px-4 py-3"><?php echo htmlspecialchars($detalle['nombre']); ?></td>
              <td class="px-4 py-3 text-center"><?php echo htmlspecialchars($detalle['cantidad']); ?></td>
              <td class="px-4 py-3 text-right">Q<?php echo htmlspecialchars(number_format($detalle['precio_unitario'], 2)); ?></td>
              <td class="px-4 py-3 text-right">Q<?php echo htmlspecialchars(number_format($detalle['subtotal'], 2)); ?></td>
            </tr>
            <?php endwhile; ?>
            <?php $result_detalles->close(); ?>
            <?php else: ?>
            <tr>
                <td colspan="4" class="px-4 py-3 text-center">No se encontraron productos para esta compra.</td>
            </tr>
            <?php endif; ?>
          </tbody>
          <tfoot class="bg-emerald-50">
            <tr>
              <td colspan="3" class="px-4 py-4 text-right font-bold text-gray-800">Total:</td>
              <td class="px-4 py-4 text-right font-bold text-green-600 text-lg">Q<?php echo htmlspecialchars(number_format($total_pagado, 2)); ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </section>

    <div class="text-center">
      <a href="historial_compras.php" class="inline-block bg-orange-500 text-white font-bold px-6 py-3 rounded-lg hover:bg-orange-600 transition">
        ← Regresar al historial
      </a>
    </div>
  </main>

  <footer class="w-full text-center text-sm text-gray-500 py-4 mt-auto">
  </footer>

</body>
</html>