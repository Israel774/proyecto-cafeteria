<?php
session_start();
require '../../conexion/conexion.php'; // Ruta a tu conexión
$conn = conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $claveIngresada = hash('sha512', $_POST['clave_admin']);

    // Buscar usuario con rol "admin"
    $query = "SELECT contraseña FROM usuario WHERE tipo = 'Administrador' LIMIT 1";
    $resultado = $conn->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        $admin = $resultado->fetch_assoc();

        // Verificar contraseña ingresada con hash
        if ($claveIngresada === $admin['contraseña']) {
            session_unset();
            session_destroy();
            header("Location: ../../index.html");
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta. No autorizado.'); window.history.back();</script>";
            exit();
        }
    } else {
        echo "<script>alert('No se encontró ningún administrador registrado.'); window.history.back();</script>";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
