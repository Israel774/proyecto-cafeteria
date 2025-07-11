<?php
session_start();

// Verifica si el usuario está autenticado y tiene rol con ID 3
if (!isset($_SESSION['nickname'])) {
    header('Location: ../index.php');
    exit();
}

// Conectar a la base de datos
require_once '../conexion/conexion.php'; // Asegúrate de usar la ruta correcta

// Obtener la lista de usuarios
$sql = "SELECT id_usuario, nickname FROM usuario";
$result = $conn->query($sql);

$users = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    echo "No se encontraron usuarios.";
}

// No olvides cerrar la conexión si ya no se necesita más adelante
$conn->close();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mi Cuenta - Pedidos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-blue-300 min-h-screen flex flex-col items-center">

    <!-- Encabezado -->
    <header class="w-full bg-purple-500 py-4 px-6 shadow-md flex justify-between items-center">
        <h1 class="text-2xl font-extrabold text-black uppercase">Mi Cuenta - Anderson Rodriguez</h1>
        
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
        <span class="text-4xl font-extrabold text-green-600">Q450.00</span>
        </section>

        <!-- Historial de pedidos -->
        <section class="bg-teal-300 p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Historial de compras</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
            <thead class="bg-black-500">
                <tr>
                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Fecha</th>
                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Saldo Anterior</th>
                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Monto recargado</th>
                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Saldo Post-recarga</th>
                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y">

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

</body>
</html>
