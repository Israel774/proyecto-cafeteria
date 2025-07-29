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


  <!-- Bootstrap CSS y JS para modales -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
