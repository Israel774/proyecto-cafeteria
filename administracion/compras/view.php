<?php
  session_start();
  // Verifica si el usuario ha iniciado sesión
  if (!isset($_SESSION['nickname'])) {
      header('Location: ../index.php');
      exit();
  }

// Verifica el rol del usuario
if ($_SESSION['rol'] != 'Administrador') {
    echo "<script>alert(Acceso denegado. Solo los administradores pueden acceder a esta página.); window.history.back()</script>";
    exit();
}

//verifica si el usuario está activo
if ($_SESSION['estado'] != 'Activo') {
    echo "<script>alert('Cuenta inactiva. Consulta con los administradores si se trata de algun error'); window.history.back();</script>";
    exit();
}
include_once("../../conexion/conexion.php");
$conn = conectar();
$id_compras = $_GET['id_compras'];
$sql = "SELECT * FROM compras WHERE id_compras = '$id_compras'";
$r = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($r);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Usuario - PREU</title>

    <!-- FontAwesome, Bootstrap y estilos -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">
    
        <style>
            .btn-naranja {
  background-color: orange;     /* fondo naranja */
  color: white;                 /* texto e ícono blancos */
  border: 1px solid orange;     /* borde del mismo color */
  padding: 0.375rem 0.75rem;    /* padding como botón normal */
  font-size: 0.875rem;          /* tamaño pequeño si usas btn-xs */
  border-radius: 0.25rem;
  transition: background-color 0.3s, color 0.3s;
  text-decoration: none;        /* quita el subrayado del <a> */
  display: inline-block;
}

.btn-naranja:hover {
  background-color: #e69500;    /* naranja más oscuro en hover */
  color: white;                 /* mantiene el texto blanco */
  border-color: #e69500;
  cursor: pointer;
}
        </style>
    
</head>

<body>

   

    <!-- Main Content -->
    <div class="main-content">
        <div class="container mt-5">
            <h2 class="text-primary text-center mb-4">Editar Compra</h2>
            <form action="update.php" method="POST" class="card p-4 shadow">
                <input type="hidden" name="id_compras" value="<?= $row['id_compras'] ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Encargado</label>
                        <input type="text" class="form-control" name="encargado" id="encargado" value="<?= $row['encargado'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Proveedor</label>
                        <input type="text" class="form-control" name="fk_proveedor" id="fk_proveedor" value="<?= $row['fk_proveedor'] ?>" disabled>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label">Metodo de Pago</label>
                        <input type="text" class="form-control" name="metodo_de_pago" value="<?= $row['metodo_de_pago'] ?>" disabled>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">Total Compra</label>
                        <input type="num" class="form-control" name="total_compra" value="<?= $row['total_compra'] ?>" disabled>
                    </div>
                    
                    <div class="col-md-6">
    <label class="form-label">Observaciones</label>
    <textarea class="form-control" name="observaciones" disabled style="text-align: left;">
        <?= htmlspecialchars($row['observaciones']) ?>
    </textarea>
</div>


                    

<div class="col-12 text-center mt-4">
  <a href="listado.php" class="btn btn-xs btn-naranja">
    <i class="fas fa-arrow-left me-2"></i>Volver al listado
  </a>
</div>
                </div>
            </form>
        </div>

        
    </div>
    
   

   
   
</body>
</html>
