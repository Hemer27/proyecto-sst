<?php
header('Content-Type: application/json');
include 'conexion.php';

if(!$conn) {
    echo json_encode(['error' => 'No se pudo conectar a la DB']);
    exit;
}

// Obtener temas
$temas = [];
$result = $conn->query("SELECT id_tema, nombre_tema FROM temas");
if($result){
    while($row = $result->fetch_assoc()){
        $temas[] = $row;
    }
}

// Obtener dificultades únicas
$dificultades = [];
$result2 = $conn->query("SELECT DISTINCT dificultad FROM preguntas");
if($result2){
    while($row = $result2->fetch_assoc()){
        $dificultades[] = $row['dificultad'];
    }
}

// Devolver JSON
echo json_encode([
    'temas' => $temas,
    'dificultades' => $dificultades
]);
?>