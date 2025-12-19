<?php
session_start();
require_once "conexion.php";

ob_start(); // inicia buffer
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

header('Content-Type: application/json; charset=utf-8');

// Leer JSON
$input = json_decode(file_get_contents('php://input'), true);

if ($input === null) {
    echo json_encode([
        'status' => 'error',
        'message' => 'JSON no válido o vacío',
        'raw' => file_get_contents('php://input')
    ]);
    exit;
}

if (!isset($_SESSION['id_usuario'], $_SESSION['nombre'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No has iniciado sesión'
    ]);
    exit;
}

$_SESSION['apellido'] = $row['apellido'];
$id_usuario = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre'] . " " . $_SESSION['apellido'];

$total = 0;
$puntaje = 0;
$id_tema = $input['id_tema'] ?? 0;
$dificultad = $input['dificultad'] ?? '';

$detalle = [];

$respuestas = $input['respuestas'] ?? [];

// Obtener solo las preguntas que el usuario respondió
$ids = array_column($respuestas, 'id_pregunta');

if (count($ids) > 0) {
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "SELECT id_pregunta, pregunta, respuesta_correcta 
            FROM preguntas WHERE id_pregunta IN ($placeholders)";
    $stmtAll = $conn->prepare($sql);

    // Generar tipos dinámicamente (todos enteros)
    $types = str_repeat('i', count($ids));
    $stmtAll->bind_param($types, ...$ids);

    $stmtAll->execute();
    $resultAll = $stmtAll->get_result();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No se recibieron preguntas'
    ]);
    exit;
}

$respuestas = $input['respuestas'] ?? [];
$resMap = [];
foreach ($respuestas as $resp) {
    $resMap[$resp['id_pregunta']] = $resp['respuesta'];
}

while ($row = $resultAll->fetch_assoc()) {
    $id_pregunta = $row['id_pregunta'];
    $pregText = $row['pregunta'];
    $correcta = $row['respuesta_correcta'];

    $valor = $resMap[$id_pregunta] ?? ''; // vacío si no respondió
    $total++;

    if (mb_strtolower(trim($valor)) === mb_strtolower(trim($correcta))) {
        $puntaje++;
        $es_correcta = true;
    } else {
        $es_correcta = false;
    }

    $detalle[] = [
        'id_pregunta' => $id_pregunta,
        'pregunta' => $pregText,
        'seleccion' => $valor,
        'correcta' => $correcta,
        'es_correcta' => $es_correcta
    ];
}
// Guardar puntaje en resultados
$stmtIns = $conn->prepare("
    INSERT INTO resultados (id_usuario, nombre_usuario, id_tema, dificultad, puntaje)
    VALUES (?, ?, ?, ?, ?)
");
$stmtIns->bind_param("isisi", $id_usuario, $nombre_usuario, $id_tema, $dificultad, $puntaje);
$stmtIns->execute();

// Calcular porcentaje
$porcentaje = round(($puntaje / $total) * 100);
$gano = $puntaje >= 6;

// Obtener nombre del tema
$stmtTema = $conn->prepare("SELECT nombre_tema FROM temas WHERE id_tema = ?");
$stmtTema->bind_param("i", $id_tema);
$stmtTema->execute();
$temaNombre = $stmtTema->get_result()->fetch_assoc()['nombre_tema'] ?? 'Tema';

// Respuesta JSON
$response = [
    'status' => 'ok',
    'puntaje' => $puntaje,
    'total' => $total,
    'usuario' => $nombre_usuario,
    'detalle' => $detalle,
    'porcentaje' => $porcentaje,
    'gano' => $gano
];

if ($gano) {
    $response['certificado_url'] = "php/certificado.php?usuario=$nombre_usuario&tema=$temaNombre&dificultad=$dificultad&puntaje=$puntaje&total=$total&porcentaje=$porcentaje";
}

echo json_encode($response);