<?php
// Arreglo con los ítems del menú. Si tiene subítems, se representa como array anidado.
$menu = [
    'Usuarios' => [
        'icono' => 'fas fa-user',
        'submenu' => [
            'Registrar Usuario' => '../usuarios/registrar.php',
            'Lista de Usuarios' => '../usuarios/registro.php'
        ]
    ],
    'Productos' => [
        'icono' => 'fas fa-user',
        'submenu' => [
            'Registro de Productos' => '../productos/registrar-producto.php',
            'Productos Registrados' => '../productos/productos_registrados.php',
        ]
    ],
    'Compras' => [
        'icono' => 'fas fa-user',
        'submenu' => [
            'Compra de Productos' => '../compras/compras.php',
            'Detalle de compras' => '../compras/detalle_compras.php',
        ]
    ],
    'Recargar' => [
        'icono' => 'fa-solid fa-cash-register',
        'submenu' => [
            'Recargar Saldo' => '../recarga/recarga.php',
            'Lista de Recargas' => '../recarga/list.php'
        ]
    ],
    'Proveedores' => [
        'icono' => 'fa-solid fa-cash-register',
        'submenu' => [
            'Registro de Proveedores' => '../proveedores/proveedor.php',
            'Listado de proveedores' => '../proveedores/listado_proveedor.php'
        ]
    ],
    'Ventas' => [
        'icono' => 'fa-solid fa-cash-register',
        'submenu' => [
            'Ventas diaras' => '../ventas/ventas_diarias.php',
            'Reporte de ventas' => '../ventas/ReporteDeVentas.php'
        ]
    ],
];
?>

<section id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Menú</div>

                <?php
                $idContador = 1; // Para identificar los colapsables
                foreach ($menu as $titulo => $opcion) :
                    $icono = isset($opcion['icono']) ? $opcion['icono'] : 'fas fa-circle';
                    if (isset($opcion['submenu'])) :
                        // Tiene submenú
                        $collapseId = 'collapse' . $idContador++;
                        ?>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>"
                           aria-expanded="false" aria-controls="<?= $collapseId ?>">
                            <div class="sb-nav-link-icon"><i class="<?= $icono ?>"></i></div>
                            <?= $titulo ?>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="<?= $collapseId ?>" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <?php foreach ($opcion['submenu'] as $nombre => $ruta): ?>
                                    <a class="nav-link" href="<?= $ruta ?>"><?= $nombre ?></a>
                                <?php endforeach; ?>
                            </nav>
                        </div>
                    <?php else: ?>
                        <!-- Elemento sin submenú -->
                        <a class="nav-link" href="<?= $opcion['link'] ?>">
                            <div class="sb-nav-link-icon"><i class="<?= $icono ?>"></i></div>
                            <?= $titulo ?>
                        </a>
                    <?php endif;
                endforeach;
                ?>
            </div>
        </div>
    </nav>
</section>
