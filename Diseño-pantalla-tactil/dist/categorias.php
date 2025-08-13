<?php
    session_start();

  // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['nickname'])) {
        header('Location: ../../index.html');
        exit();
    }

// Verifica el rol del usuario
if ($_SESSION['rol'] != 'Kiosko') {
    echo "<script>alert(Acceso denegado. pagina solo para kioskos.); window.history.back()</script>";
    exit();
}

//verifica si el usuario está activo
if ($_SESSION['estado'] != 'Activo') {
    echo "<script>alert('Cuenta inactiva. Consulta con los administradores si se trata de algun error'); window.history.back();</script>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Categorias de la tienda</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="categorias.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-violet-500 min-h-screen flex items-start justify-start p-4">

  <!-- Barra de navegación lateral -->
<?php include 'menu-pantalla_tactil.php'; ?>


  <!-- Contenido principal (Categorías de productos) -->
  <div class="ml-0 md:ml-72 w-full max-w-3xl" style="justify-items: center; max-width: 75%">
    <h1 class="text-4xl font-bold text-center mb-8 text-red-700">Bienvenido</h1>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
      
      <!-- Categoría: Hamburguesas -->
      <a href="menu.php?valor=comidas" class="tamaño-categorias bg-white shadow-lg rounded-2xl p-4 text-center hover:bg-yellow-200 transition">
        <img src="assets/img/imagen-comidas.png" alt="comidas" class="mx-auto mb-2" style="max-width: 50% !important; height:auto !important"/>
        <span class="text-xl font-semibold">Comida</span>
      </a>

      <!-- Categoría: Papas -->
      <a href="menu.php?valor=postres" class="bg-white shadow-lg rounded-2xl p-4 text-center hover:bg-yellow-200 transition">
        <img src="assets/img/imagen-postres.png" alt="Postres" class="mx-auto mb-2" />
        <span class="text-xl font-semibold">Postres</span>
      </a>

      <!-- Categoría: Bebidas -->
      <a href="menu.php?valor=bebidasfrias" class="bg-white shadow-lg rounded-2xl p-4 text-center hover:bg-yellow-200 transition">
        <img src="https://img.icons8.com/color/96/cola.png" alt="Bebidas frias" class="mx-auto mb-2" />
        <span class="text-xl font-semibold">Bebidas frias</span>
      </a>

      <!-- Categoría: Postres -->
      <a href="menu.php?valor=bebidascalientes" class="bg-white shadow-lg rounded-2xl p-4 text-center hover:bg-yellow-200 transition">
        <img src="assets/img/imagen-bebida-caliente.png" alt="Postres" class="mx-auto mb-2" />
        <span class="text-xl font-semibold">Bebidas calientes</span>
      </a>

      <!-- Categoría: Combos -->
      <a href="menu.php?valor=snacks" class="bg-white shadow-lg rounded-2xl p-4 text-center hover:bg-yellow-200 transition">
        <img src="assets/img/imagen-snacks.png" alt="snacks" class="mx-auto mb-2" />
        <span class="text-xl font-semibold">Snacks</span>
      </a>

      <!-- Categoría: Ensaladas -->
      <a href="menu.php?valor=dulces" class="bg-white shadow-lg rounded-2xl p-4 text-center hover:bg-yellow-200 transition">
        <img src="assets/img/imagen-dulces.png" alt="dulces" class="mx-auto mb-2" />
        <span class="text-xl font-semibold">Dulces</span>
      </a>

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


  <!-- Bootstrap CSS y JS para modales -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/js.js"></script>

</body>
</html>
