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
    <!-- Barra de navegación lateral -->
    <nav class="bg-white shadow-lg w-64 h-screen fixed top-0 left-0 p-4 rounded-2xl md:block hidden">
        <h2 class="text-2xl font-bold text-center mb-6 text-red-700">Menú</h2>

        <!-- Contenedor flexible que empuja el botón hacia abajo -->
        <div class="flex flex-col justify-between flex-1">
            <ul class="space-y-6">
                <?php foreach ($menu as $item): ?>
                    <li>
                        <a href="<?= $item['ruta'] ?>" class="flex items-center space-x-2 text-lg font-semibold hover:text-red-700">
                            <img src="<?= $item['img'] ?>" alt="<?= $item['alt'] ?>" />
                            <span><?= $item['nombre'] ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Botón siempre abajo -->
            <a href="../index.html">
                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg text-lg font-semibold mt-6">
                    Cancelar compra
                </button>
            </a>
            <!-- Botón de cerrar sesión -->
             <button class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg text-lg font-semibold mt-6"
                    data-bs-toggle="modal" data-bs-target="#logoutModal">
                Cerrar sesión
                </button>
        </div>
    </nav>
</section>

<!-- Modal para confirmar cierre de sesión -->
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
