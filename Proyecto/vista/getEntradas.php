<?php
require '../config/database.php';

// Verificar si se recibió el ID en la solicitud POST
if(isset($_POST['id'])) {
    // Obtener y escapar el ID
    $id = $conn->real_escape_string($_POST['id']);

    // Consulta SQL para seleccionar la entrada con el ID específico
    $sql = "SELECT id, id_consecutivo, id_estado, ingresoFecha, id_modulo, cliente, fallaCliente FROM entradas WHERE id=$id LIMIT 1";
    $resultado = $conn->query($sql);
    $rows = $resultado->num_rows;

    $entrada = [];

    // Verificar si se encontraron resultados
    if ($rows > 0) {
        // Obtener los datos de la entrada
        $entrada = $resultado->fetch_array();
    } 

    // Devolver los datos en formato JSON
    echo json_encode($entrada, JSON_UNESCAPED_UNICODE);
} else {
    // Si no se recibió el ID en la solicitud, devolver un mensaje de error
    echo json_encode(array('error' => 'No se recibió el ID en la solicitud'), JSON_UNESCAPED_UNICODE);
}
?>
