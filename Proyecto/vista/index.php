<?php 
require '../config/database.php';  

$sqlEntradas = "SELECT e.id, c.codigo AS consecutivo, d.nombre AS estado, e.ingresoFecha, e.cliente, e.fallaCliente, m.nombre AS modulo
                FROM entradas AS e 
                INNER JOIN estado AS d ON e.id_estado = d.id
                INNER JOIN modulo AS m ON e.id_modulo = m.id
                INNER JOIN consecutivo AS c ON e.id_consecutivo = c.id";

$entradas = $conn->query($sqlEntradas);

$sqlConsecutivosDisponibles = "SELECT c.id, c.codigo 
                                FROM consecutivo AS c
                                WHERE c.id NOT IN (SELECT e.id_consecutivo FROM entradas AS e)";
$consecutivosDisponibles = $conn->query($sqlConsecutivosDisponibles);


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
        <h2 class="text-center">Registro</h2>
        <div class="row justify-content-space-between">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal">
                    <i class="fas fa-plus-circle"></i> Nuevo registro 
                    </a>


            </div>
        </div>
        <table class="table table-responsive-sm table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Folio</th>
                    <th>Estado</th>
                    <th>Fecha Ingreso</th>
                    <th>Modulo</th>
                    <th>Cliente</th>
                    <th>Falla Cliente</th>
                    <th>Acción</th>

                
                </tr>
            </thead>
            <tbody>
<?php
require '../config/database.php';  

if(isset($_GET['q']) && !empty($_GET['q'])) {
    $searchTerm = $_GET['q'];
    // Consulta SQL con la cláusula WHERE para filtrar los resultados según el término de búsqueda
    $sqlEntradas = "SELECT e.id, c.codigo AS consecutivo, d.nombre AS estado, e.ingresoFecha, e.cliente, e.fallaCliente, m.nombre AS modulo
    FROM entradas AS e 
    INNER JOIN estado AS d ON e.id_estado = d.id
    INNER JOIN modulo AS m ON e.id_modulo = m.id
    INNER JOIN consecutivo AS c ON e.id_consecutivo = c.id
    WHERE c.codigo LIKE '%$searchTerm%'
    OR d.nombre LIKE '%$searchTerm%'
    OR e.cliente LIKE '%$searchTerm%'
    OR e.fallaCliente LIKE '%$searchTerm%'
    OR m.nombre LIKE '%$searchTerm%'";
} else {
    // Consulta SQL sin la cláusula WHERE si no se ha enviado un término de búsqueda
    $sqlEntradas = "SELECT e.id, c.codigo AS consecutivo, d.nombre AS estado, e.ingresoFecha, e.cliente, e.fallaCliente, m.nombre AS modulo
    FROM entradas AS e 
    INNER JOIN estado AS d ON e.id_estado = d.id
    INNER JOIN modulo AS m ON e.id_modulo = m.id
    INNER JOIN consecutivo AS c ON e.id_consecutivo = c.id";
}


$entradas = $conn->query($sqlEntradas);
?>

<?php while($row_entrada = $entradas->fetch_assoc()){ ?>
    <tr>
        <td><?= $row_entrada['id']?></td>
        <td><?= $row_entrada['consecutivo']?></td>
        <td><?= $row_entrada['estado']?></td>
        <td><?= $row_entrada['ingresoFecha']?></td>
        <td><?= $row_entrada['modulo']?></td>
        <td><?= $row_entrada['cliente']?></td>
        <td><?= $row_entrada['fallaCliente']?></td>
        <td>
            <a href="#" class="btn btn-responsive-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row_entrada['id'];?>"> <i class="fa-solid fa-pen-to-square"></i> Editar</a>
            <a href="#" class="btn btn-responsive-sm btn-danger"  data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $row_entrada['id'];?>"><i class="fa-solid fa-trash"></i> Eliminar</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarEntradaModal" data-consecutivo="<?= $row_entrada['consecutivo']; ?>">Lab</button>

        </td> 
    </tr>
<?php }?>

            </tbody>
        </table>
        
        <?php 
        $sqlModulo = "SELECT id, nombre FROM modulo";
        $modulos = $conn->query($sqlModulo);
        $sqlEstado = "SELECT id, nombre FROM estado";
        $estados = $conn->query($sqlEstado);
        $sqlResponsable = "SELECT id, nombre FROM responsable";
        $responsable = $conn->query($sqlResponsable);
        $sqlConsecutivo = "SELECT id, codigo FROM consecutivo";
        $consecutivo = $conn->query($sqlConsecutivo);

        include 'nuevoModal.php'; 

        $estados->data_seek(0); 
        $modulos->data_seek(0);
        $responsable->data_seek(0);
        $consecutivo->data_seek(0);


        include 'editaModal.php';
        include 'eliminaModal.php';
        include 'agregarEntrada.php'; 
        ?>

        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
