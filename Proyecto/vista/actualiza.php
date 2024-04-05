<?php
require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);
$folio = $conn->real_escape_string($_POST['folio']);
$estado = $conn->real_escape_string($_POST['estado']);
$ingresoFecha = $conn->real_escape_string($_POST['ingresoFecha']);
$modulos = $conn->real_escape_string($_POST['modulos']);
$cliente = $conn->real_escape_string($_POST['cliente']);
$fallaCliente = $conn->real_escape_string($_POST['fallaCliente']);

$sql = "UPDATE entradas 
        SET folio ='$folio', id_estado =$estado, ingresoFecha ='$ingresoFecha', id_modulo = $modulos, cliente='$cliente', fallaCliente='$fallaCliente' 
        WHERE id=$id";

if ($conn->query($sql)) {
    // Actualización exitosa
} else {
    // Error en la actualización
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Redireccionar a la página principal
header('Location: index.php');
?>
