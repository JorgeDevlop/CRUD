<?php
require '../config/database.php';

$folio = $conn->real_escape_string($_POST['folio']);
$estado = $conn->real_escape_string($_POST['estado']);
$ingresoFecha = $conn->real_escape_string($_POST['ingresoFecha']);
$modulos = $conn->real_escape_string($_POST['modulos']);
$cliente = $conn->real_escape_string($_POST['cliente']);
$fallaCliente = $conn->real_escape_string($_POST['fallaCliente']);

$sql = "INSERT INTO entradas (folio,id_estado,ingresoFecha,id_modulo,cliente,fallaCliente)
VALUES ('$folio',$estado,NOW(),$modulos,'$cliente','$fallaCliente')" ;

if ($conn->query($sql)){
    $id = $conn->insert_id;
}

header('Location:index.php');
?>