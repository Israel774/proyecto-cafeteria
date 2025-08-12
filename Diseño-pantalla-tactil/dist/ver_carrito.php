<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ver Carrito</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="js/js.js"></script>
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
            <div class="mt-8 space-y-4" style="">
                <a href="proceder_pedido.php">
                    <button class="w-full bg-blue-400 hover:bg-blue-600 text-white py-4 rounded-xl text-xl font-bold" style="margin: 1% 0;">
                        Pagar ahora
                    </button>
                </a>
                <a href="#" onclick="vaciarCarritoYRedirigir('../index.php')">
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

    <footer class="w-full text-center text-sm text-gray-500 py-4">
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
    renderizarCarritoCompleto();
});

function renderizarCarritoCompleto() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const listaProductos = document.getElementById('lista-carrito-detallada');
    const resumenSubtotal = document.getElementById('resumen-subtotal');
    const resumenTotal = document.getElementById('resumen-total');
    let subtotal = 0;

    if (listaProductos) {
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
}
function actualizarCantidad(id, cambio) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const productoIndex = carrito.findIndex(p => p.id === id);

    if (productoIndex !== -1) {
        const producto = carrito[productoIndex];
        let nuevaCantidad = producto.cantidad + cambio;

        const stockDisponible = producto.stock;

        if (cambio > 0 && nuevaCantidad > stockDisponible) {
            // Evita incrementar si se supera el stock
            alert(`No se puede agregar más. Solo quedan ${stockDisponible} unidades en stock.`);
        } else if (nuevaCantidad > 0) {
            producto.cantidad = nuevaCantidad;
            localStorage.setItem('carrito', JSON.stringify(carrito));
            renderizarCarritoCompleto();
        } else {
            // Elimina el producto si la cantidad es 0 o menos
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

</script>
</body>
</html>