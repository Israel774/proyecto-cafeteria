<?php
include '../../conexion/conexion.php';

$valor = $_GET['valor'] ?? null;
$productos = [];

if ($valor) {
    $sql = "SELECT * FROM productos WHERE tipo_producto = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $valor);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $productos[] = $fila;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos de categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .carrito-container {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-violet-500 min-h-screen flex flex-col md:flex-row p-4">

    <?php include 'menu-pantalla_tactil.php'; ?>
    
    <div class="flex-1 w-full flex justify-center md:ml-72">
        <div class="w-full max-w-screen-lg mx-auto">
            <h1 class="text-4xl font-bold text-center mb-8 text-red-700">Productos Disponibles</h1>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-2">
                <?php foreach ($productos as $producto): ?>
                <div class="bg-white shadow-lg rounded-2xl p-2 text-center hover:bg-yellow-200 transition flex flex-col justify-center items-center aspect-square w-full max-w-[150px] sm:max-w-[180px] md:max-w-[200px] mx-auto" data-id="<?php echo htmlspecialchars($producto['id_productos']); ?>" data-stock="<?php echo htmlspecialchars($producto['stock']); ?>">
                    <img src="../../<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="mb-1 w-2/3 h-auto"/>
                    <span class="text-base sm:text-lg font-semibold"><?php echo htmlspecialchars(substr($producto['nombre'], 0, 15)); ?></span>
                    <p class="font-semibold text-xs" style="font-size: 70% !important"><?php echo htmlspecialchars(substr($producto['descripcion'], 0, 20)); ?></p>
                    <p class="font-bold text-sm text-green-600">Q<?php echo htmlspecialchars($producto['precio']); ?></p>
                    <div class="flex items-center justify-center space-x-1 mt-1">
                        <button class="bg-gray-300 hover:bg-gray-400 rounded-full w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center text-xs font-bold" onclick="disminuir(<?php echo $producto['id_productos']; ?>)">-</button>
                        <span class="text-sm font-semibold" id="cantidad-<?php echo $producto['id_productos']; ?>">0</span>
                        <button class="bg-gray-300 hover:bg-gray-400 rounded-full w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center text-xs font-bold" onclick="incrementar(<?php echo $producto['id_productos']; ?>)">+</button>
                    </div>
                    <button class="mt-1 px-1 py-0.5 sm:px-2 sm:py-1 bg-green-500 text-white rounded-md hover:bg-green-600 text-xs sm:text-sm" onclick="agregarAlCarrito('<?php echo htmlspecialchars($producto['nombre']); ?>', <?php echo htmlspecialchars($producto['precio']); ?>, <?php echo htmlspecialchars($producto['id_productos']); ?>, '<?php echo htmlspecialchars($producto['imagen']); ?>', '<?php echo htmlspecialchars($producto['descripcion']); ?>', <?php echo htmlspecialchars($producto['stock']); ?>)">Agregar</button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <div id="carrito-container" class="fixed top-0 right-0 h-full w-80 bg-white shadow-lg p-4 transform translate-x-full carrito-container z-50">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Carrito</h2>
            <button id="cerrar-carrito" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
        </div>
        <ul id="lista-carrito" class="list-none p-0">
        </ul>
        <div class="mt-4 pt-4 border-t-2 border-gray-200">
        <p class="text-xl font-bold">Total: Q<span id="total-carrito">0.00</span></p>
        </div>
        <div id="botones-carrito" class="flex flex-col mt-4">
            <a href="ver_carrito.php">
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-lg font-semibold mb-2">
                    Ver Carrito
                </button>
            </a>
        </div>
    </div>

    <script src="js/js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if ($conn) {
    mysqli_close($conn);
}
?>