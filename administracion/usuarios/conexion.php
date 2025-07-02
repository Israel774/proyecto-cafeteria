<?php
$hostname = "localhost";  //127.0.0.1 algunas veces
$user = "root"; //root siempre
$password = "";
$database = "colegio";  //nombre del mysql nombre de la tabla
$conn = new mysqli($hostname, $user, $password, $database);
if ($conn-> connect_error){
    die("error en la conexion:" . $conn->connect_error);
}


?>