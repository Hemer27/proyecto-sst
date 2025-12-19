<?php
session_start();
require_once "php/conexion.php";

$id_tema = $_GET['tema'] ?? 0;
$dificultad = $_GET['dificultad'] ?? '';

if ($id_tema == 0 || !in_array($dificultad, ['facil','medio','dificil'])) {
    die("Datos inválidos");
}

/* Obtener nombre del tema */
$stmtTema = $conn->prepare("SELECT nombre_tema FROM temas WHERE id_tema = ?");
$stmtTema->bind_param("i", $id_tema);
$stmtTema->execute();
$temaNombre = $stmtTema->get_result()->fetch_assoc()['nombre_tema'] ?? 'Tema';

/* Función para traer preguntas */
function obtenerPreguntas($conn, $id_tema, $dif, $limite){
    $sql = "SELECT * FROM preguntas 
            WHERE id_tema = ? AND dificultad = ?
            ORDER BY RAND() LIMIT ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $id_tema, $dif, $limite);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

/* Lógica de dificultad */
$preguntas = [];

if ($dificultad === 'facil') {
    $preguntas = obtenerPreguntas($conn, $id_tema, 'facil', 10);
}
if ($dificultad === 'medio') {
    $preguntas = array_merge(
        obtenerPreguntas($conn, $id_tema, 'facil', 5),
        obtenerPreguntas($conn, $id_tema, 'medio', 5)
    );
}
if ($dificultad === 'dificil') {
    $preguntas = array_merge(
        obtenerPreguntas($conn, $id_tema, 'facil', 2),
        obtenerPreguntas($conn, $id_tema, 'medio', 3),
        obtenerPreguntas($conn, $id_tema, 'dificil', 5)
    );
}

shuffle($preguntas);
$totalPreguntas = count($preguntas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="estilos/estilosQuiz.css">
    <link rel="shortcut icon" href="img/icono.png" type="image/x-icon">
</head>
<body>

    <a href="index.php" class="btnSalir">Salir</a>

    <div class="cont">
        <h1>¡Prepárate! Tu desafío empieza ahora</h1>
        <h3><?php echo $temaNombre . " - " . ucfirst($dificultad); ?></h3>

        <div id="timer" class="timer">
            ⏳ Tiempo restante: <span id="time">10:00</span>
        </div>

        <?php if($totalPreguntas === 10): ?>
            <form id="quizForm"
                  data-id-tema="<?php echo $id_tema; ?>"
                  data-dificultad="<?php echo htmlspecialchars($dificultad); ?>">

                <?php foreach($preguntas as $i => $p): 
                    $opciones = [
                        $p['respuesta_correcta'],
                        $p['opcion2'],
                        $p['opcion3'],
                        $p['opcion4']
                    ];
                    shuffle($opciones);
                ?>
                    <div class="preguntaCont <?php echo $i === 0 ? 'active' : ''; ?>"
                        data-index="<?php echo $i; ?>"
                        data-id="<?php echo $p['id_pregunta']; ?>">
                        
                        <h2><?php echo ($i+1) . ". " . $p['pregunta']; ?></h2>

                        <?php foreach($opciones as $op): ?>
                            <label>
                                <input type="radio" name="p<?php echo $p['id_pregunta']; ?>" value="<?php echo htmlspecialchars($op); ?>">
                                <?php echo htmlspecialchars($op); ?>
                            </label><br>
                        <?php endforeach; ?>

                    </div>
                <?php endforeach; ?>

                <div class="botonesSA">
                    <button type="button" id="btnAnterior">Anterior</button>
                    <button type="button" id="btnSiguiente">Siguiente</button>
                    <button type="submit">Enviar Quiz</button>
                </div>

            </form>
            <p id="contadorPregunta">Pregunta 1 de 10</p>

        <?php else: ?>
            <p>No hay suficientes preguntas cargadas.</p>
        <?php endif; ?>
    </div>

    <script src="js/quiz.js"></script>
</body>
</html>