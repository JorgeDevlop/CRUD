<?php 
require '../config/database.php';  

$sqlEntradas = "SELECT e.id, e.folio, d.nombre AS estado, e.ingresoFecha, e.cliente, e.fallaCliente, m.nombre AS modulo
                FROM entradas AS e 
                INNER JOIN estado AS d ON e.id_estado = d.id
                INNER JOIN modulo AS m ON e.id_modulo = m.id";

$entradas = $conn->query($sqlEntradas);
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
        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal">
                    <i class="fas fa-plus-circle"></i> Nuevo registro 
                </a>
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
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
<?php
require '../config/database.php';  

// Verificar si se ha enviado un término de búsqueda
if(isset($_GET['q']) && !empty($_GET['q'])) {
    $searchTerm = $_GET['q'];
    // Consulta SQL con la cláusula WHERE para filtrar los resultados según el término de búsqueda
    $sqlEntradas = "SELECT e.id, e.folio, d.nombre AS estado, e.ingresoFecha, e.cliente, e.fallaCliente, m.nombre AS modulo
                    FROM entradas AS e 
                    INNER JOIN estado AS d ON e.id_estado = d.id
                    INNER JOIN modulo AS m ON e.id_modulo = m.id
                    WHERE e.folio LIKE '%$searchTerm%'
                    OR d.nombre LIKE '%$searchTerm%'
                    OR e.cliente LIKE '%$searchTerm%'
                    OR e.fallaCliente LIKE '%$searchTerm%'
                    OR m.nombre LIKE '%$searchTerm%'";
} else {
    // Consulta SQL sin la cláusula WHERE si no se ha enviado un término de búsqueda
    $sqlEntradas = "SELECT e.id, e.folio, d.nombre AS estado, e.ingresoFecha, e.cliente, e.fallaCliente, m.nombre AS modulo
                    FROM entradas AS e 
                    INNER JOIN estado AS d ON e.id_estado = d.id
                    INNER JOIN modulo AS m ON e.id_modulo = m.id";
}

$entradas = $conn->query($sqlEntradas);
?>

                <?php while($row_entrada = $entradas->fetch_assoc()){ ?>
                    <tr>
                        <td><?= $row_entrada['id']?></td>
                        <td><?= $row_entrada['folio']?></td>
                        <td><?= $row_entrada['estado']?></td>
                        <td><?= $row_entrada['ingresoFecha']?></td>
                        <td><?= $row_entrada['modulo']?></td>
                        <td><?= $row_entrada['cliente']?></td>
                        <td><?= $row_entrada['fallaCliente']?></td>
                        <td>

                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row_entrada['id'];?>"> <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                       <a href="#" class="btn btn-sm btn-danger"  data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $row_entrada['id'];?>"><i class="fa-solid fa-trash"></i> Eliminar</a>
                        </td> 
                    </tr>
                <?php }?>
            </tbody>
        </table>
        
        <?php 
        $sqlModulo = "SELECT id, nombre FROM modulo";
        $modulos = $conn->query($sqlModulo);
        ?>

<?php 
$sqlEstado = "SELECT id, nombre FROM estado";
$estados = $conn->query($sqlEstado);
?>


<?php 
 include 'nuevoModal.php'; 

 $estados->data_seek(0); 
 $modulos->data_seek(0);

 include 'editaModal.php';
 include 'eliminaModal.php'; ?>


<script>
    let nuevoModal = document.getElementById('nuevoModal');
    let editaModal = document.getElementById('editaModal');
    let eliminaModal = document.getElementById('eliminaModal');

    nuevoModal.addEventListener('shown.bs.modal',event =>{
        nuevoModal.querySelector('.modal-body #folio').focus()

    })

    nuevoModal.addEventListener('hide.bs.modal',event =>{

    nuevoModal.querySelector('.modal-body #folio').value =""
    nuevoModal.querySelector('.modal-body #estado').value =""
    nuevoModal.querySelector('.modal-body #ingresoFecha').value =""
    nuevoModal.querySelector('.modal-body #modulos').value =""
    nuevoModal.querySelector('.modal-body #cliente').value =""
    nuevoModal.querySelector('.modal-body #fallaCliente').value =""

    })
    editaModal.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget;
    let id = button.getAttribute('data-bs-id');

    let inputId = editaModal.querySelector('.modal-body #id');
    let inputFolio = editaModal.querySelector('.modal-body #folio');
    let inputEstado = editaModal.querySelector('.modal-body #estado');
    let inputIngreso = editaModal.querySelector('.modal-body #ingresoFecha');
    let inputModulos = editaModal.querySelector('.modal-body #modulos');
    let inputCliente = editaModal.querySelector('.modal-body #cliente');
    let inputFalla = editaModal.querySelector('.modal-body #fallaCliente');

    let url = "getEntradas.php";
    let formData = new FormData();
    formData.append('id', id);

    fetch(url, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        inputId.value = data.id;
        inputFolio.value = data.folio;
        inputEstado.value = data.estado;
        inputIngreso.value = data.ingresoFecha; 
        // Buscar el módulo correspondiente en la lista de módulos y seleccionarlo
        let options = inputModulos.querySelectorAll('option');
        for (let option of options) {
            if (option.value == data.id_modulo) {
                option.selected = true;
                break;
            }
        }
        inputCliente.value = data.cliente;
        inputFalla.value = data.falla;
    })
    .catch(err => console.log(err));
});

     

    eliminaModal.addEventListener('shown.bs.modal', event => {

        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        eliminaModal.querySelector('.modal-footer #id').value=id

    })
</script>

        <script src="../assets/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
