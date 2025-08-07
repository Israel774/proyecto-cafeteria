<?php
// Arreglo con los ítems del menú
$menu = [
    [
        'nombre' => 'Comidas',
        'img' => 'assets/img/iconos-lateral/imagen-comidas.png',
        'alt' => 'Comidas',
        'ruta' => 'menu.php?valor=comidas'
    ],
    [
        'nombre' => 'Postres',
        'img' => 'assets/img/iconos-lateral/imagen-postres.png',
        'alt' => 'Postres',
        'ruta' => 'menu.php?valor=postres'
    ],
    [
        'nombre' => 'Bebidas frias',
        'img' => 'https://img.icons8.com/color/48/cola.png',
        'alt' => 'Bebidas frias',
        'ruta' => 'menu.php?valor=bebidasfrias'
    ],
    [
        'nombre' => 'Bebidas Calientes',
        'img' => 'assets/img/iconos-lateral/imagen-bebida-caliente.png',
        'alt' => 'Bebidas Calientes',
        'ruta' => 'menu.php?valor=bebidascalientes'
    ],
    [
        'nombre' => 'Snacks',
        'img' => 'assets/img/iconos-lateral/imagen-snacks.png',
        'alt' => 'Snacks',
        'ruta' => 'menu.php?valor=snacks'
    ],
    [
        'nombre' => 'Dulces',
        'img' => 'assets/img/iconos-lateral/imagen-dulces.png',
        'alt' => 'Dulces',
        'ruta' => 'menu.php?valor=dulces'
    ]
];
?>

<section>
    <nav class="bg-white shadow-lg w-64 h-screen fixed top-0 left-0 p-4 rounded-2xl md:block z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out" id="menu-lateral">
        <div class="flex justify-end md:hidden">
            <button id="cerrar-menu" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
        </div>
        <h2 class="text-2xl font-bold text-center mb-6 text-red-700">Menú</h2>

        <div class="flex flex-col justify-between flex-1">
            <ul class="space-y-6">
                <li>
                    <button id="abrir-carrito" class="w-full flex items-center space-x-2 text-lg font-semibold text-gray-700 hover:text-red-700 p-2 rounded-lg bg-gray-100 hover:bg-gray-200">
                        <img src="https://img.icons8.com/color/48/shopping-cart.png" alt="Carrito de compras" style="width: 24px; height: 24px;"/>
                        <span>Carrito (<span id="contador-carrito">0</span>)</span>
                    </button>
                </li>
                <?php foreach ($menu as $item): ?>
                    <li>
                        <a href="<?= $item['ruta'] ?>" class="flex items-center space-x-2 text-lg font-semibold hover:text-red-700">
                            <img src="<?= $item['img'] ?>" alt="<?= $item['alt'] ?>" />
                            <span><?= $item['nombre'] ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div>
                <a href="../index.php">
                    <button class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg text-lg font-semibold mt-6">
                        Cancelar compra
                    </button>
                </a>
                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg text-lg font-semibold mt-6"
                        data-bs-toggle="modal" data-bs-target="#logoutModal">
                    Cerrar sesión
                </button>
            </div>
        </div>
    </nav>

    <button id="abrir-menu" class="fixed top-4 left-4 z-50 p-2 bg-red-700 text-white rounded-full md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</section>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="cerrar_sesion.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirmar cierre de sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>Ingrese la contraseña del administrador autorizado para cerrar sesión:</p>
                    <input type="password" name="clave_admin" class="form-control mt-2" required placeholder="Contraseña de administrador">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Cerrar sesión</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>