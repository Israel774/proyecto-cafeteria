<?php 
include("../../conexion/conexion.php");
$id_detalle_compra = $_GET['id_compras'];
$sql = "SELECT * FROM detalle_compras WHERE fk_compras = '$id_detalle_compra'";
$r = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($r);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalle de Compra - PREU</title>

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
            <h2 class="text-primary text-center mb-4">Detalle de Compra</h2>
                <input type="hidden" name="id_detalle_compra" value="<?= $row['id_detalle_compra'] ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" name="fk_producto" id="fk_producto" value="<?= $row['fk_producto'] ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cantidad</label>
                        <input type="text" class="form-control" name="cantidad" id="cantidad" value="<?= $row['cantidad'] ?>" disabled>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label">Unidad de Medida</label>
                        <input type="text" class="form-control" name="unidad_de_medida" value="<?= $row['unidad_de_medida'] ?>" disabled>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">Precio</label>
                        <input type="num" class="form-control" name="precio" value="<?= $row['precio'] ?>" disabled>
                    </div>
                    
                     <div class="col-md-6">
                        <label class="form-label">Fecha de Caducidad</label>
                        <input type="date" class="form-control" name="caducidad" id="caducidad" value="<?= $row['caducidad'] ?>" disabled>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label">Codigo de Barras</label>
                        <input type="text" class="form-control" name="codigo_de_barras" value="<?= $row['codigo_de_barras'] ?>" disabled>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">SubTotal</label>
                        <input type="num" class="form-control" name="sub_total" value="<?= $row['sub_total'] ?>" disabled>
                    </div>


                    

<div class="col-12 text-center mt-4">
  <a href="listado.php" class="btn btn-xs btn-naranja">
    <i class="fas fa-arrow-left me-2"></i>Volver al listado
  </a>
</div>
                </div>
        </div>

        
    </div>
    
   

   
   
</body>
</html>
