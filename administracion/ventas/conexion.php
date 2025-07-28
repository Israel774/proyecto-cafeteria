<?php
$hostname = "localhost";
$user = "root";
$password = "";
$database = "cafeteria";
$conn = new mysqli($hostname, $user, $password, $database);
if($conn -> connect_error){
    die("Error en la conexion: " . $conn-> connect_error);
}
?> 