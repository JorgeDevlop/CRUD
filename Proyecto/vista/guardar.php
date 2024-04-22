<?php
require '../config/database.php';

$folio = $conn->real_escape_string($_POST['folio']);
$responsable = $conn->real_escape_string($_POST['responsable']);
$diagMotor = $conn->real_escape_string($_POST['diagMotor']);
$repMotor = $conn->real_escape_string($_POST['repMotor']);
$infoCpl = $conn->real_escape_string($_POST['infoCpl']);
$comentario = $conn->real_escape_string($_POST['comentario']);

$sql = "INSERT INTO laboratorio (id_consecutivo, id_responsable, diagMotor, repMotor, infoCpl, comentario)
        VALUES ('$folio', '$responsable', '$diagMotor', '$repMotor', '$infoCpl', '$comentario')";

if ($conn->query($sql)) {
    $id = $conn->insert_id;
    // Cerrar la conexión con la base de datos
    $conn->close();
    // Redirigir al usuario a index.php
    header('Location: inLab.php');
    exit(); // Detener la ejecución del script después de la redirección
} else {
    // Mostrar un mensaje de error si la inserción falla
    echo "Error al insertar datos en la tabla laboratorio: " . $conn->error;
}
?>
