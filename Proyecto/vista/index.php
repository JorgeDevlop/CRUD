<?php require '../config/database.php';  

$sqlEntradas = "SELECT e.id,e.folio,d.nombre AS estado FROM entradas AS e INNER JOIN estado AS d
ON e.id_estado=d.id ";

$entradas = $conn->query($sqlEntradas);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD-MDI</title>
    <link href ="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href ="../assets/css/all.min.css" rel="stylesheet">

</head>
<body>

<div class="container py-3">
    <h2 class="text-center">Registro</h2>

    <div class="row justify-content-end">
    <div class="col-auto">
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Nuevo registro </a>
    
    </div>

    </div>
    <table class="table table-sm table-striped table-hover mt-4">
        <thead class="table-dark">
            <tr>
            <th>#</th>
            <th>Folio</th>
            <th>Estado</th>
            <th>Fecha Ingreso</th>
            <th>Modulo</th>
            <th>Cliente</th>
            <th>Falla Cliente</th>
            <th>Accion</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row_entrada = $entradas->fetch_assoc()){ ?>

            <tr>
                <td><?= $row_entrada['id']?></td>
                <td><?= $row_entrada['folio']?></td>
                <td><?= $row_entrada['estado']?></td>
                <td></td>


            </tr>
        
            <?php }?>


        

        </tbody>
    </table>
    
    <?php 
    $sqlModulo = "SELECT id, nombre FROM modulo";
    $modulos = $conn ->query($sqlModulo);
     ?>

<?php 
    $sqlEstado = "SELECT id, nombre FROM estado";
    $estados = $conn ->query($sqlEstado);
     ?>
<?php include 'nuevoModal.php'; ?>

<script src ="../assets/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>