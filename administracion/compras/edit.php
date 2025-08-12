<?php 
include("../../conexion/conexion.php");
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
    <title>Editar Compra - PREU</title>

    <!-- FontAwesome, Bootstrap y estilos -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="styles.css">
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
                        <input type="text" class="form-control" name="encargado" id="encargado" value="<?= $row['encargado'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Proveedor</label>
                        <input type="text" class="form-control" name="fk_proveedor" id="fk_proveedor" value="<?= $row['fk_proveedor'] ?>" required>
                    </div>

                    
                    <div class="col-md-6">
                        <label class="form-label">Metodo de Pago</label>
                        <input type="text" class="form-control" name="metodo_de_pago" value="<?= $row['metodo_de_pago'] ?>" required>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">Total Compra</label>
                        <input type="num" class="form-control" name="total_compra" value="<?= $row['total_compra'] ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control" name="observaciones" required style="text-align: left;">
                         <?= htmlspecialchars($row['observaciones']) ?>
                        </textarea>
                    </div>
                    
                    <div class="col-12 text-center">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-save me-2"></i>Actualizar
                        </button>
                        <a href="listado.php" class="btn btn-danger ms-2">
                            <i class="fas fa-arrow-left me-2"></i>Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        
    </div>
</body>
</html>
