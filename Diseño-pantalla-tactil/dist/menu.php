<?php
$valor = $_GET['valor'] ?? null;
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos de categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Categorias de la tienda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="categorias.css">
    </head>
    <body class="bg-violet-500 min-h-screen flex items-start justify-start p-4">

    <!-- Barra de navegación lateral -->
    <?php include 'menu-pantalla_tactil.php'; ?>
    <!-- Contenido principal (Categorías de productos) -->
    <div class="ml-0 md:ml-72 w-full max-w-3xl" style="justify-items: center; max-width: 75%;">
        <h1 class="text-4xl font-bold text-center mb-8 text-red-700">Productos Disponibles</h1>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Producto de ejemplo -->
            <div class="tamaño-categorias bg-white shadow-lg rounded-2xl p-4 text-center hover:bg-yellow-200 transition">
                <img src="https://img.icons8.com/color/96/cola.png" alt="comidas" class="mx-auto mb-2" style="max-width: 50% !important; height:auto !important"/>
                <!-- Controles de cantidad -->
                <div class="flex items-center space-x-4 mt-4">
                    <span class="text-gray-700 font-medium">Cantidad:</span>
                    <button class="bg-gray-300 hover:bg-gray-400 rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold" onclick="disminuir()">-</button>
                    <span class="text-xl font-semibold" id="cantidad">0</span>
                    <button class="bg-gray-300 hover:bg-gray-400 rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold" onclick="incrementar()">+</button>
                </div>
                <span class="text-xl font-semibold">Coca cola</span>
                <p class=" font-semibold" style="font-size: 60% !important">coca cola de 500ml</p>
            </div>
        </div>
    </div>
    <script src="js/js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>