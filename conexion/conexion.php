<?php
// conexion.php
function conectar() {
    date_default_timezone_set("America/Guatemala");
    $hostname = "localhost";
    $user = "root";
    $password = "";
    $database = "cafeteria";
    $conn = new mysqli($hostname, $user, $password, $database);
    if ($conn->connect_error) {
        // En caso de error, el script se detiene.
        die("Error en la conexión: " . $conn->connect_error);
    }
    return $conn;
}
?>