<?php

/**
 * CRUD modal en PHP y MySQL
 * 
 * Este archivo realiza la conexión a MySQL

 * 
 */

$conn = new mysqli("127.0.0.1", "root", "", "mdistoreage");

if ($conn->connect_error) {
    die("Error de conexión" . $conn->connect_error);
}
