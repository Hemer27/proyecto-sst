<?php
$nombre_usuario = $_GET['usuario'] ?? 'Usuario';
$temaNombre     = $_GET['tema'] ?? 'Tema';
$dificultad     = $_GET['dificultad'] ?? '';
$puntaje        = (int)($_GET['puntaje'] ?? 0);
$total          = (int)($_GET['total'] ?? 0);
$porcentaje     = (int)($_GET['porcentaje'] ?? 0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificado</title>
    <!-- Vinculamos el CSS externo -->
    <link rel="stylesheet" href="../estilos/certificado.css">
</head>
<body>
    <div class="certificado">
        <div class="titulo">CERTIFICADO DE FINALIZACIÓN</div>
        <div class="texto">
            Se certifica que <b><?= htmlspecialchars($nombre_usuario) ?></b> ha completado el quiz de 
            "<b><?= htmlspecialchars($temaNombre) ?></b>" en nivel "<b><?= htmlspecialchars($dificultad) ?></b>" 
            con un puntaje de <?= $puntaje ?>/<?= $total ?> (<?= $porcentaje ?>%).
        </div>
        <div class="texto">Fecha: <?= date('d/m/Y') ?></div>
        <div class="footer">Este certificado no es oficial y no equivale a un documento legal.</div>
    </div>
</body>
</html>