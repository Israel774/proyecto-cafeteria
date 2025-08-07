// Variable global para el carrito de compras
let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

document.addEventListener('DOMContentLoaded', () => {
    actualizarVistaCarrito();
    
    // Lógica para el carrito
    const abrirCarritoBtn = document.getElementById('abrir-carrito');
    if (abrirCarritoBtn) {
        abrirCarritoBtn.addEventListener('click', () => {
            const carritoContainer = document.getElementById('carrito-container');
            if (carritoContainer) {
                carritoContainer.classList.remove('translate-x-full');
            }
        });
    }

    const cerrarCarritoBtn = document.getElementById('cerrar-carrito');
    if (cerrarCarritoBtn) {
        cerrarCarritoBtn.addEventListener('click', () => {
            const carritoContainer = document.getElementById('carrito-container');
            if (carritoContainer) {
                carritoContainer.classList.add('translate-x-full');
            }
        });
    }

    // Lógica para el menú lateral responsivo
    const abrirMenuBtn = document.getElementById('abrir-menu');
    const cerrarMenuBtn = document.getElementById('cerrar-menu');
    const menuLateral = document.getElementById('menu-lateral');

    if (abrirMenuBtn && menuLateral) {
        abrirMenuBtn.addEventListener('click', () => {
            menuLateral.classList.remove('-translate-x-full');
        });
    }

    if (cerrarMenuBtn && menuLateral) {
        cerrarMenuBtn.addEventListener('click', () => {
            menuLateral.classList.add('-translate-x-full');
        });
    }
});

// Función para incrementar la cantidad de un producto en la UI
function incrementar(id) {
    const cantidadElement = document.getElementById(`cantidad-${id}`);
    const productoCard = document.querySelector(`[data-id="${id}"]`);
    
    if (cantidadElement && productoCard) {
        let cantidad = parseInt(cantidadElement.innerText) || 0;
        const stockDisponible = parseInt(productoCard.dataset.stock) || 0;

        if (cantidad < stockDisponible) {
            cantidad++;
            cantidadElement.innerText = cantidad;
        } else {
            alert(`No hay más stock disponible para este producto. (Stock actual: ${stockDisponible})`);
        }
    }
}


// Función para disminuir la cantidad de un producto en la UI
function disminuir(id) {
    const cantidadElement = document.getElementById(`cantidad-${id}`);
    if (cantidadElement) {
        let cantidad = parseInt(cantidadElement.innerText) || 0;
        if (cantidad > 0) {
            cantidad--;
            cantidadElement.innerText = cantidad;
        }
    }
}

// Función principal para agregar productos al carrito
function agregarAlCarrito(nombre, precio, id) {
    const cantidadElement = document.getElementById(`cantidad-${id}`);
    if (!cantidadElement) return;

    const cantidad = parseInt(cantidadElement.innerText);
    if (cantidad === 0) return;

    const productoExistente = carrito.find(p => p.id === id);

    if (productoExistente) {
        productoExistente.cantidad += cantidad;
    } else {
        carrito.push({ id, nombre, precio, cantidad });
    }

    cantidadElement.innerText = '0';

    guardarCarrito();
    actualizarVistaCarrito();
}

// Función para guardar el estado del carrito en el localStorage
function guardarCarrito() {
    localStorage.setItem('carrito', JSON.stringify(carrito));
}

// Función para actualizar la visualización del carrito en el panel
function actualizarVistaCarrito() {
    const listaCarrito = document.getElementById('lista-carrito');
    const totalCarrito = document.getElementById('total-carrito');
    const contadorCarrito = document.getElementById('contador-carrito');
    let total = 0;
    let totalItems = 0;

    if (listaCarrito) {
        listaCarrito.innerHTML = '';
        if (carrito.length === 0) {
            const li = document.createElement('li');
            li.textContent = "El carrito está vacío.";
            li.className = "text-gray-500 italic";
            listaCarrito.appendChild(li);
            if (totalCarrito) totalCarrito.textContent = '0.00';
        } else {
            carrito.forEach((producto, index) => {
                const li = document.createElement('li');
                const subtotal = producto.precio * producto.cantidad;
                li.className = "flex justify-between items-center py-2 border-b last:border-b-0";
                li.innerHTML = `
                    <span>${producto.nombre} x ${producto.cantidad}</span>
                    <div class="flex items-center">
                        <span class="mr-2">Q${subtotal.toFixed(2)}</span>
                        <button class="text-red-500 hover:text-red-700 font-bold text-lg" onclick="eliminarDelCarrito(${index})">&times;</button>
                    </div>
                `;
                listaCarrito.appendChild(li);
                total += subtotal;
                totalItems += producto.cantidad;
            });
            if (totalCarrito) totalCarrito.textContent = total.toFixed(2);
        }
    }
    
    if (contadorCarrito) {
        contadorCarrito.textContent = totalItems;
    }
}

// Función para eliminar un producto del carrito
function eliminarDelCarrito(index) {
    carrito.splice(index, 1);
    guardarCarrito();
    actualizarVistaCarrito();
}