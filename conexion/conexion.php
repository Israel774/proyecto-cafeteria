<?php
date_default_timezone_set("America/Guatemala");

$hostname = "localhost";  //127.0.0.1 algunas veces
$user = "root"; //root siempre
$password = "";
$database = "cafeteria";  //nombre del mysql nombre de la tabla
$conn = new mysqli($hostname, $user, $password, $database);
if ($conn-> connect_error){
    die("error en la conexion:" . $conn->connect_error);
}


?>