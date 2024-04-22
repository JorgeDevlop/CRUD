<?php
require '../config/database.php';

// Obtener los datos del formulario
$id = $conn->real_escape_string($_POST['id']);
$folio = $conn->real_escape_string($_POST['folio']);
$estado = $conn->real_escape_string($_POST['estado']);
$ingresoFecha = $conn->real_escape_string($_POST['ingresoFecha']);
$modulos = $conn->real_escape_string($_POST['modulos']);
$cliente = $conn->real_escape_string($_POST['cliente']);
$fallaCliente = $conn->real_escape_string($_POST['fallaCliente']);

// Consulta SQL para actualizar el registro
$sql = "UPDATE entradas 
        SET id_consecutivo =$folio, id_estado =$estado, ingresoFecha ='$ingresoFecha', id_modulo = $modulos, cliente='$cliente', fallaCliente='$fallaCliente' 
        WHERE id=$id";

// Ejecutar la consulta
if ($conn->query($sql)) {
    // Actualización exitosa
    // Redireccionar a la página principal
    header('Location: index.php');
} else {
    // Error en la actualización
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
