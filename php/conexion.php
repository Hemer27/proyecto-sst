<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "quizverde";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_errno) {
    error_log("Error de conexión MySQL: " . $conn->connect_error);
    echo "No se pudo conectar a la base de datos.";
    exit;
}

$conn->set_charset("utf8mb4");
?>