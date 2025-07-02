<?php
$hostname = "localhost";
$user = "root";
$password = "";
$datebase = "compras";

$conn = new mysqli($hostname, $user, $password, $datebase);

if($conn -> connect_error){
    die("error en la conexion: " . $conn->connect_error);
}
?>