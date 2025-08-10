<?php
    session_start();

  // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['nickname'])) {
        header('Location: ../index.html');
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
    <title>Inicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
<style>
    body {
        background-image: url('https://images.unsplash.com/photo-1509042239860-f550ce710b93'); /* Reemplaza con la ruta correcta de tu imagen */
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: center; /* Nueva propiedad para centrar la imagen */
    }
    .overlay {
        background-color: rgba(0, 0, 0, 0.2);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
    </head>
    <body>

    <div class="overlay">
        <div class="text-center text-white space-y-8">
        <h1 class="text-4xl font-extrabold">¡Bienvenido al Asistente de tienda!</h1>
        <h2 class="text-xl font-semibold" style="margin: 10%;">Descubre nuestros productos exclusivos</h2>
        <a href="dist/categorias.php" class="bg-gray-500 hover:bg-yellow-500 text-black font-bold py-4 px-8 rounded-full text-xl transition duration-300">Haz click para iniciar</a>
        </div>
    </div>

</body>
</html>
