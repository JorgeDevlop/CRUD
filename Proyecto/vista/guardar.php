<?php
require '../config/database.php';

$entrada = $conn->real_escape_string($_POST['entrada']);
$consecutivo = $conn->real_escape_string($_POST['consecutivo']);
$responsable = $conn->real_escape_string($_POST['responsable']);
$diagMotor = $conn->real_escape_string($_POST['diagMotor']);
$repMotor = $conn->real_escape_string($_POST['repMotor']);
$infoCpl = $conn->real_escape_string($_POST['infoCpl']);
$comentario = $conn->real_escape_string($_POST['comentario']);

$sql = "INSERT INTO laboratorio (id_entrada, id_consecutivo, id_responsable, diagMotor, repMotor, infoCpl, comentario)
        VALUES ('$entrada', '$consecutivo', '$responsable', '$diagMotor', '$repMotor', '$infoCpl', '$comentario')";

if ($conn->query($sql)) {
    $id = $conn->insert_id;
    // Cerrar la conexión con la base de datos
    $conn->close();
    // Redirigir al usuario a index.php
    header('Location: index.php');
    exit(); // Detener la ejecución del script después de la redirección
} else {
    // Mostrar un mensaje de error si la inserción falla
    echo "Error al insertar datos en la tabla laboratorio: " . $conn->error;
}
?>
