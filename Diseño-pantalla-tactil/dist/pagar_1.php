<?php
// pagar_1.php
header('Content-Type: text/html; charset=utf-8');

// Verifica que la solicitud sea de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Recibir y sanitizar los datos del formulario JSON
    $data = json_decode(file_get_contents('php://input'), true);

    $codigoBarra = $data['codigobarra'] ?? null;
    $idCliente = $data['id_cliente'] ?? null;
    $carrito = $data['carrito'] ?? [];
    $totalCompra = $data['total_compra'] ?? 0.00;
    
    // 2. Incluir el archivo de conexión
    require_once '../../conexion/conexion.php'; 
    $conn = conectar(); 
    
    $cliente = null;
    // Si la conexión fue exitosa y se proporcionó un código de barra
    if ($conn && $codigoBarra) {
        $sql = "SELECT nombre, apellido, nickname FROM usuario WHERE modificacion = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $codigoBarra);
        $stmt->execute();
        $result = $stmt->get_result();
        $cliente = $result->fetch_assoc();
        $stmt->close();
    }
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Compra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .no-print {
                display: none !important;
            }
            #receipt-container {
                display: block !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-xl no-print">
        <h1 class="text-3xl font-bold text-center mb-6">Recibo de Compra</h1>
        <div class="mb-6 border-b pb-4">
            <h2 class="text-xl font-semibold mb-2">Datos del Cliente</h2>
            <?php if ($cliente): ?>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($cliente['nombre']); ?></p>
                <p><strong>Apellido:</strong> <?php echo htmlspecialchars($cliente['apellido']); ?></p>
                <p><strong>Nickname:</strong> <?php echo htmlspecialchars($cliente['nickname']); ?></p>
            <?php else: ?>
                <p class="text-red-500">No se encontraron los datos del cliente.</p>
            <?php endif; ?>
        </div>
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Detalles del Pedido</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Producto</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Precio</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Cantidad</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($carrito)): ?>
                        <?php foreach ($carrito as $producto): ?>
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap"><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                <td class="px-4 py-2 whitespace-nowrap text-center">Q<?php echo number_format($producto['precio'], 2); ?></td>
                                <td class="px-4 py-2 whitespace-nowrap text-center"><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                                <td class="px-4 py-2 whitespace-nowrap text-right">Q<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">El carrito está vacío.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="text-right border-t pt-4">
            <p class="text-xl font-bold">Total: Q<?php echo number_format($totalCompra, 2); ?></p>
        </div>
        <div class="flex justify-end gap-4 mt-6 no-print">
            <button onclick="window.print()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">Imprimir Recibo</button>
            <a href="categorias.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Volver al Menú de Productos</a>
        </div>
    </div>
    <div id="receipt-container" style="display: none; max-width: 300px; margin: 20px auto; background-color: white; padding: 15px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
        <h1 style="text-align: center; font-size: 1.5em; margin-bottom: 10px;">Recibo</h1>
        <div style="border-bottom: 1px dashed #ccc; padding-bottom: 10px; margin-bottom: 10px;">
            <h2 style="font-size: 1.1em; margin-bottom: 5px;">Cliente</h2>
            <?php if ($cliente): ?>
                <p style="font-size: 0.9em; margin-bottom: 3px;"><strong>Nombre:</strong> <?php echo htmlspecialchars($cliente['nombre']); ?></p>
                <p style="font-size: 0.9em; margin-bottom: 3px;"><strong>Apellido:</strong> <?php echo htmlspecialchars($cliente['apellido']); ?></p>
            <?php else: ?>
                <p style="font-size: 0.9em; color: red;">Datos no encontrados.</p>
            <?php endif; ?>
        </div>
        <div style="margin-bottom: 10px;">
            <h2 style="font-size: 1.1em; margin-bottom: 5px;">Pedido</h2>
            <table style="width: 100%; font-size: 0.9em;">
                <thead>
                    <tr>
                        <th style="text-align: left; padding-right: 5px;">Producto</th>
                        <th style="text-align: right;">Cant.</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($carrito)): ?>
                        <?php foreach ($carrito as $producto): ?>
                            <tr>
                                <td style="padding-right: 5px;"><?php echo htmlspecialchars(substr($producto['nombre'], 0, 20)); ?></td>
                                <td style="text-align: right;"><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                                <td style="text-align: right;">Q<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" style="text-align: center;">Carrito vacío</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div style="border-top: 1px dashed #ccc; padding-top: 10px;">
            <p style="text-align: right; font-size: 1em;"><strong>Total:</strong> Q<?php echo number_format($totalCompra, 2); ?></p>
        </div>
        <p style="text-align: center; font-size: 0.8em; margin-top: 10px;">¡Gracias por su compra!</p>
    </div>
    <script>
        // ... El script JavaScript puede mantenerse igual
    </script>
</body>
</html>

<?php
    $conn->close(); // Cierra la conexión después de usarla
} else {
    // Si la solicitud no es POST (por acceso directo), redirige a una página de inicio
    header('Location: ../index.php');
    exit;
}
?>