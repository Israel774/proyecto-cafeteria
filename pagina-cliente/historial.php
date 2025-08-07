<?php
include 'obtener-usuario/obtener_usuario.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['nickname'])) {
    header('Location: ../index.php');
    exit();
}

//verifica si el usuario está activo
if ($_SESSION['estado'] != 'Activo') {
    echo "<script>alert('Cuenta inactiva. Consulta con los administradores si se trata de algun error'); window.history.back();</script>";
    exit();
}

// Conectar a la base de datos
require_once '../conexion/conexion.php'; // Asegúrate de usar la ruta correcta

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi Cuenta - Pedidos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

     <link rel="stylesheet" href="../administracion/usuarios/estilos.css">
    <link rel="stylesheet" href="../administracion/usuarios/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" />
    <style>
    .sb-topnav .btn-link .fa-bars {
        font-size: 1.3em !important;
        vertical-align: middle;
       
    }
    .btn-outline-rosado {
  color: white;             
  background-color: #ff69b4;     
  border: 1px solid #ff69b4;  
  margin-right: 0.25rem;
  transition: background-color 0.3s, color 0.3s;
}

.btn-outline-rosado:hover {
  background-color: #ff69b4;
  color: black !important;              
  border-color: #ff69b4;
  cursor: pointer;
}

    </style>
    </head>
    <body class="bg-blue-300 min-h-screen flex flex-col items-center">

    <!-- Encabezado -->
    <header class="w-full bg-purple-500 py-4 px-6 shadow-md flex justify-between items-center">
        <h1 class="text-2xl font-extrabold text-black uppercase">Mi Cuenta - <?php echo $nombre_completo;?></h1>
        
        <!-- Perfil del usuario -->
        <div class="relative inline-block text-left">
        <button onclick="toggleDropdown()" class="flex items-center gap-2 focus:outline-none">
            Explorar
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Menú desplegable -->
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10">
            <a href="historial.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Historial de compras</a>
            <a href="historial-recargas.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Historial de recargas</a>
            <a href="../cerrar-sesion.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Cerrar sesión</a>
        </div>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="w-full max-w-5xl px-4 py-8 flex flex-col gap-8">

        <!-- Saldo actual -->
        <section class="bg-teal-300 p-6 rounded-2xl shadow-lg flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Saldo actual</h2>
            <p class="text-lg text-gray-500">Dinero disponible para comprar</p>
        </div>
        <span class="text-4xl font-extrabold text-green-600">Q <?php echo $saldo;?></span>
        </section>

        <!-- Historial de pedidos -->
        <section class="bg-teal-300 p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Historial de compras</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
            <thead class="bg-black-500">
                <tr class="text-center">
                <th class="px-4 py-3 text-gray-800 font-semibold">Fecha</th>
                <th class="px-4 py-3 text-gray-800 font-semibold">Total pagado</th>
                <th class="px-4 py-3 text-gray-800 font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y text-center">
                <?php while ($row_compras = $result_compras->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row_compras['fecha']; ?></td>
                    <td><?php echo $row_compras['total_pagado']; ?></td>
                    <td>
                        <a href="view.php?id_venta=<?php echo $row_compras['id_venta']; ?>" title="Ver detelle de la compra">
                        <button type="button" class="btn btn-xs btn-outline-rosado">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            </table>
        </div>
        </section>
    </main>

    <!-- Pie de página -->
    <footer class="w-full text-center text-sm text-gray-500 py-4 mt-auto"></footer>

    <!-- Script para el dropdown -->
    <script>
        function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
        }

        // Opcional: Cierra el menú si se hace clic fuera de él
        document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = event.target.closest('button');
        const isClickInside = dropdown.contains(event.target) || button;
        if (!isClickInside && !dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
        }
        });
    </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>

</body>
</html>
