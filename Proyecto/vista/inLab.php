<?php 
require '../config/database.php';  

// Ejecutar la consulta SQL inicial sin la cláusula WHERE
$sqlLaboratorios = "SELECT l.id, c.codigo AS consecutivo, r.nombre AS responsable, l.diagMotor, l.repMotor, l.infoCpl, l.comentario
FROM laboratorio AS l 
INNER JOIN consecutivo AS c ON l.id_consecutivo = c.id
INNER JOIN responsable AS r ON l.id_responsable = r.id";

// Almacenar los resultados de la consulta inicial en la variable $laboratorio
$laboratorio = $conn->query($sqlLaboratorios);









// Si hay un término de búsqueda, ejecutar la consulta de búsqueda y almacenar los resultados en la variable $searchResults
if(isset($_GET['q']) && !empty($_GET['q'])) {
    $searchTerm = $_GET['q'];
    $sqlSearch = "SELECT l.id, c.codigo AS consecutivo, r.nombre AS responsable, l.diagMotor, l.repMotor, l.infoCpl, l.comentario
    FROM laboratorio AS l 
    INNER JOIN consecutivo AS c ON l.id_consecutivo = c.id
    INNER JOIN responsable AS r ON l.id_responsable = r.id
    WHERE c.codigo LIKE '%$searchTerm%'
    OR r.nombre LIKE '%$searchTerm%'
    OR l.diagMotor LIKE '%$searchTerm%'
    OR l.repMotor LIKE '%$searchTerm%'
    OR l.comentario LIKE '%$searchTerm%'";
    $searchResults = $conn->query($sqlSearch);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD-MDI</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/all.min.css" rel="stylesheet">
</head>
<body>
<form action="" method="GET" class="container py-1">
    <div class="input-group input-group-sm">
        <input type="text"  placeholder="Buscar..." name="q" value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>">
        <button class="btn btn-primary " type="submit">Buscar</button>
        <?php if(isset($_GET['q']) && !empty($_GET['q'])): ?>
            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="btn btn-secondary btn-sm">Limpiar</a>
        <?php endif; ?>
    </div>
</form>

<div class="container py-3">
    <h2 class="text-center">Laboratorio</h2>
    <div class="row justify-content-space-between">
        <div class="col-auto">
            
        </div>
    </div>
   
    <table class="table table-responsive-sm table-striped table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Consecutivo</th>
                <th>Responsable</th>
                <th>DiagMotor</th>
                <th>RepMotor</th>
                <th>infoCpl</th>
                <th>Comentario</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            if(isset($searchResults)) {
                while($row_laboratorio = $searchResults->fetch_assoc()) { 
            ?>
                <tr>
                    <td><?= $row_laboratorio['id']?></td>
                    <td><?= $row_laboratorio['consecutivo']?></td>
                    <td><?= $row_laboratorio['responsable']?></td>
                    <td><?= $row_laboratorio['diagMotor']?></td>
                    <td><?= $row_laboratorio['repMotor']?></td>
                    <td><?= $row_laboratorio['infoCpl']?></td>
                    <td><?= $row_laboratorio['comentario']?></td>
                    <td>            
                    <a href="#" class="btn btn-responsive-sm btn-danger"  data-bs-toggle="modal" data-bs-target="#eliminaEntrada" 
                    data-bs-id="<?= $row_laboratorio['id'];?>"><i class="fa-solid fa-trash"></i> Eliminar</a></td> 
                </tr>
            <?php 
                }
            } else {
                while($row_laboratorio = $laboratorio->fetch_assoc()) { 
            ?>
                <tr>
                    <td><?= $row_laboratorio['id']?></td>
                    <td><?= $row_laboratorio['consecutivo']?></td>
                    <td><?= $row_laboratorio['responsable']?></td>
                    <td><?= $row_laboratorio['diagMotor']?></td>
                    <td><?= $row_laboratorio['repMotor']?></td>
                    <td><?= $row_laboratorio['infoCpl']?></td>
                    <td><?= $row_laboratorio['comentario']?></td>
                    <td>            
                    <a href="#" class="btn btn-responsive-sm btn-danger"  data-bs-toggle="modal" data-bs-target="#eliminaEntrada" 
                    data-bs-id="<?= $row_laboratorio['id'];?>"><i class="fa-solid fa-trash"></i> Eliminar</a></td> 
                </tr>
            <?php 
                }
            }
            ?>
        </tbody>
    </table>

<?php
// Aquí incluyes otros archivos
include 'agregarEntrada.php';
include 'eliminaEntrada.php';
include 'index.php'



?>

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>
