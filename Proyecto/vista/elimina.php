<?php
require '../config/database.php';

$id = $conn->real_escape_string($_POST['id']);

$sql = "DELETE FROM entradas WHERE id=$id";


if ($conn->query($sql)) {
    // Actualización exitosa
} else {
    // Error en la actualización
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Redireccionar a la página principal
header('Location: index.php');
?>
