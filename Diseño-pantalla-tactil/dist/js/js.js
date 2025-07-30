function incrementar() {
  // Obtener el elemento con el ID 'contador'
    const contador = document.getElementById("cantidad");

  // Convertir el contenido a número y sumarle 1
    const valor = parseInt(contador.innerText);
    contador.innerText = valor + 1;
}

function disminuir() {
  // Obtener el elemento con el ID 'cantidad'
    const contador = document.getElementById("cantidad");

  // Convertir el contenido a número y sumarle 1
    const valor = parseInt(contador.innerText);
    contador.innerText = valor - 1;
}
