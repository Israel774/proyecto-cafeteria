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
    <title>Ver Carrito</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Estilos personalizados para el spinner de cantidad */
        input[type="number"]::-webkit-inner-spin-button, 
        input[type="number"]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .hidden {
            display: none;
        }
        /* Estilos para el recibo de impresión */
        @media print {
            body > *:not(#receipt-container) {
                display: none;
            }
            /* Ocultar el modal de pago al imprimir */
            #modalPago {
                display: none !important;
            }
            #receipt-container {
                display: block !important;
                width: 300px;
                margin: 0 auto;
                padding: 15px;
                box-shadow: none;
                font-family: monospace;
                font-size: 10px;
            }
        }
    </style>
</head>
<body class="bg-purple-300 min-h-screen flex flex-col items-center justify-between">

    <header class="w-full bg-indigo-700 py-6 text-center shadow-md">
        <h1 class="text-3xl font-extrabold text-white uppercase">Ver Carrito</h1>
    </header>

    <main class="flex flex-col md:flex-row w-full max-w-6xl px-6 py-8 gap-8">

        <section class="w-full md:w-2/3 bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Tu pedido</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Producto
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subtotal
                            </th>
                        </tr>
                    </thead>
                    <tbody id="lista-carrito-detallada" class="bg-white divide-y divide-gray-200">
                    </tbody>
                </table>
            </div>
        </section>

        <aside class="w-full md:w-1/3 bg-white rounded-xl shadow-lg p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Total del Carrito</h2>
                <div class="flex justify-between text-lg font-medium mb-2">
                    <span>Subtotal</span>
                    <span id="resumen-subtotal">Q0.00</span>
                </div>
                <div class="flex justify-between text-xl font-bold text-red-700 mt-4 border-t pt-4">
                    <span>Total</span>
                    <span id="resumen-total">Q0.00</span>
                </div>
            </div>
            <div class="mt-8 space-y-4">
                <button onclick="abrirModalPago()" class="w-full bg-blue-400 hover:bg-blue-600 text-white py-4 rounded-xl text-xl font-bold" style="margin: 1% 0;">
                    Pagar ahora
                </button>
                <a href="#" onclick="vaciarCarritoYRedirigir('categorias.php')">
                    <button class="w-full bg-red-400 hover:bg-red-600 text-gray-800 py-4 rounded-xl text-lg font-semibold" style="margin: 1% 0;">
                        Cancelar pedido
                    </button>
                </a>
                <a href="categorias.php">
                    <button class="w-full bg-green-400 hover:bg-green-500 text-gray-800 py-4 rounded-xl text-lg font-semibold" style="margin: 1% 0;">
                        Agregar mas productos
                    </button>
                </a>
            </div>
        </aside>
    </main>

    <div id="receipt-container" style="display: none;"></div>

    <div id="modalPago" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="cerrarModalPago()">&times;</span>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Confirmar Pago</h3>
            <form id="formPago">
                <div class="mb-4">
                    <label for="codigoBarra" class="block text-gray-700 text-sm font-bold mb-2">Ingresa tu código único:</label>
                    <input type="text" id="codigoBarra" name="codigobarra" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                
                <div id="datos-cliente" class="space-y-2 mt-4 hidden">
                    <p><strong>Nombre:</strong> <span id="nombre-cliente"></span></p>
                    <p><strong>Apellido:</strong> <span id="apellido-cliente"></span></p>
                    <p><strong>Nickname:</strong> <span id="nickname-cliente"></span></p>
                    <input type="hidden" id="id-cliente-input">
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="button" onclick="cerrarModalPago()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-xl">
                        Cancelar
                    </button>
                    <button type="submit" id="btnConfirmarCompra" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-xl" disabled>
                        Confirmar Compra
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="w-full text-center text-sm text-gray-500 py-4">
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            renderizarCarritoCompleto();

            const formPago = document.getElementById('formPago');
            if (formPago) {
                formPago.addEventListener('submit', procesarCompra);
            }
        });

        // Funciones para el carrito
        function renderizarCarritoCompleto() {
            const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            const listaProductos = document.getElementById('lista-carrito-detallada');
            const resumenSubtotal = document.getElementById('resumen-subtotal');
            const resumenTotal = document.getElementById('resumen-total');
            let subtotal = 0;
            
            if (!listaProductos) return;

            listaProductos.innerHTML = '';
            
            if (carrito.length === 0) {
                listaProductos.innerHTML = '<tr><td colspan="4" class="text-center text-gray-500 py-4">El carrito está vacío.</td></tr>';
                resumenSubtotal.textContent = 'Q0.00';
                resumenTotal.textContent = 'Q0.00';
                return;
            }

            carrito.forEach(producto => {
                const subtotalProducto = producto.precio * producto.cantidad;
                subtotal += subtotalProducto;
                const tr = document.createElement('tr');
                tr.className = 'text-gray-900';
                tr.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-4">
                            <button class="text-red-500 text-2xl" onclick="eliminarDelCarrito(${producto.id})">&times;</button>
                            <img src="../../${producto.imagen}" alt="${producto.nombre}" class="w-12 h-12" />
                            <div>
                                <div class="text-sm font-medium">${producto.nombre}</div>
                                <p class="text-xs text-gray-500">Q${producto.precio.toFixed(2)}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center hidden md:table-cell">Q${producto.precio.toFixed(2)}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center justify-center space-x-2">
                            <button class="bg-gray-200 px-2 rounded" onclick="actualizarCantidad(${producto.id}, -1)">-</button>
                            <span>${producto.cantidad}</span>
                            <button class="bg-gray-200 px-2 rounded" onclick="actualizarCantidad(${producto.id}, 1)">+</button>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right font-bold">Q${subtotalProducto.toFixed(2)}</td>
                `;
                listaProductos.appendChild(tr);
            });
            
            resumenSubtotal.textContent = `Q${subtotal.toFixed(2)}`;
            resumenTotal.textContent = `Q${subtotal.toFixed(2)}`;
        }

        function actualizarCantidad(id, cambio) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            const productoIndex = carrito.findIndex(p => p.id === id);
            if (productoIndex !== -1) {
                const producto = carrito[productoIndex];
                let nuevaCantidad = producto.cantidad + cambio;
                const stockDisponible = producto.stock;
                if (cambio > 0 && nuevaCantidad > stockDisponible) {
                    alert(`No se puede agregar más. Solo quedan ${stockDisponible} unidades en stock.`);
                } else if (nuevaCantidad > 0) {
                    producto.cantidad = nuevaCantidad;
                    localStorage.setItem('carrito', JSON.stringify(carrito));
                    renderizarCarritoCompleto();
                } else {
                    carrito.splice(productoIndex, 1);
                    localStorage.setItem('carrito', JSON.stringify(carrito));
                    renderizarCarritoCompleto();
                }
            }
        }

        function eliminarDelCarrito(id) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            const productoIndex = carrito.findIndex(p => p.id === id);
            if (productoIndex !== -1) {
                carrito.splice(productoIndex, 1);
                localStorage.setItem('carrito', JSON.stringify(carrito));
                renderizarCarritoCompleto();
            }
        }

        // Funciones para el modal y pago
        const modalPago = document.getElementById('modalPago');
        const codigoBarraInput = document.getElementById('codigoBarra');
        const datosClienteDiv = document.getElementById('datos-cliente');
        const btnConfirmarCompra = document.getElementById('btnConfirmarCompra');
        const receiptContainer = document.getElementById('receipt-container');

        function abrirModalPago() {
            modalPago.style.display = 'block';
        }

        function cerrarModalPago() {
            modalPago.style.display = 'none';
            codigoBarraInput.value = '';
            datosClienteDiv.classList.add('hidden');
            btnConfirmarCompra.disabled = true;
        }

        if (codigoBarraInput) {
            codigoBarraInput.addEventListener('keyup', () => {
                const codigo = codigoBarraInput.value.trim();
                if (codigo.length > 0) {
                    obtenerDatosCliente(codigo);
                } else {
                    datosClienteDiv.classList.add('hidden');
                    btnConfirmarCompra.disabled = true;
                }
            });
        }

        async function obtenerDatosCliente(codigo) {
            try {
                const response = await fetch('obtener_cliente_por_codigo.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ codigobarra: codigo })
                });
                const data = await response.json();
                if (data.success) {
                    document.getElementById('nombre-cliente').textContent = data.nombre;
                    document.getElementById('apellido-cliente').textContent = data.apellido;
                    document.getElementById('nickname-cliente').textContent = data.nickname;
                    document.getElementById('id-cliente-input').value = data.id_cliente || '';
                    datosClienteDiv.classList.remove('hidden');
                    btnConfirmarCompra.disabled = false;
                } else {
                    datosClienteDiv.classList.add('hidden');
                    btnConfirmarCompra.disabled = true;
                }
            } catch (error) {
                console.error('Error al obtener datos del cliente:', error);
                datosClienteDiv.classList.add('hidden');
                btnConfirmarCompra.disabled = true;
            }
        }

        async function procesarCompra(event) {
            event.preventDefault();

            if (btnConfirmarCompra) {
                btnConfirmarCompra.disabled = true;
                btnConfirmarCompra.textContent = 'Procesando...';
            }

            const idCliente = document.getElementById('id-cliente-input').value;
            const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            const totalCompra = parseFloat(document.getElementById('resumen-total').textContent.replace('Q', ''));

            if (carrito.length === 0 || !idCliente) {
                alert('El carrito está vacío o el cliente no está identificado.');
                if (btnConfirmarCompra) {
                    btnConfirmarCompra.disabled = false;
                    btnConfirmarCompra.textContent = 'Confirmar Compra';
                }
                return;
            }

            try {
                const response = await fetch('procesar_compra.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_cliente: idCliente,
                        carrito: carrito,
                        total_compra: totalCompra
                    })
                });

                const data = await response.json();

                if (data.success) {
                    alert('Compra registrada con éxito!');
                    
                    // Ocultar el modal antes de imprimir
                    cerrarModalPago();
                    
                    generarEImprimirRecibo(data.recibo);

                    localStorage.removeItem('carrito');
                    renderizarCarritoCompleto();
                } else {
                    alert('Error al procesar la compra: ' + (data.message || 'Error desconocido.'));
                }
            } catch (error) {
                console.error('Error en la solicitud:', error);
                alert('Ocurrió un error al procesar la compra. Intenta de nuevo.');
            } finally {
                if (btnConfirmarCompra) {
                    btnConfirmarCompra.disabled = false;
                    btnConfirmarCompra.textContent = 'Confirmar Compra';
                }
            }
        }

        function generarEImprimirRecibo(datosRecibo) {
            // Eliminar el contenido actual para evitar duplicados
            receiptContainer.innerHTML = '';

            let htmlRecibo = `
                <div style="text-align: center;">
                    <h1 style="font-size: 1.2em; font-weight: bold; margin-bottom: 5px;">RECIBO DE COMPRA</h1>
                    <p>Fecha: ${new Date().toLocaleString()}</p>
                    <hr style="border-top: 1px dashed #000; margin: 10px 0;">
                    
                    <h2 style="font-size: 1.1em; font-weight: bold; margin-bottom: 5px;">Cliente</h2>
                    <p>${datosRecibo.cliente.nombre} ${datosRecibo.cliente.apellido}</p>
                    <hr style="border-top: 1px dashed #000; margin: 10px 0;">

                    <h2 style="font-size: 1.1em; font-weight: bold; margin-bottom: 5px;">Detalles del Pedido</h2>
                    <div style="width: 100%; text-align: left;">
                        ${datosRecibo.productos.map(p => `
                            <div style="display: flex; justify-content: space-between;">
                                <span>${p.nombre}</span>
                                <span>${p.cantidad} x Q${(p.subtotal / p.cantidad).toFixed(2)}</span>
                                <span>Q${p.subtotal.toFixed(2)}</span>
                            </div>
                        `).join('')}
                    </div>
                    <hr style="border-top: 1px dashed #000; margin: 10px 0;">

                    <p style="text-align: right; font-size: 1.2em; font-weight: bold;">TOTAL: Q${datosRecibo.total.toFixed(2)}</p>

                    <p style="text-align: center; margin-top: 10px;">¡Gracias por su compra!</p>
                </div>
            `;
            
            if (receiptContainer) {
                receiptContainer.innerHTML = htmlRecibo;
                window.print();
                // Ocultar el recibo después de imprimir para que no se muestre en la página principal
                receiptContainer.innerHTML = '';
            }
        }

        // Función para vaciar el carrito y redirigir
        function vaciarCarritoYRedirigir(url) {
            localStorage.removeItem('carrito');
            window.location.href = url;
        }
    </script>
</body>
</html>