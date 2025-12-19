document.addEventListener('DOMContentLoaded', () => {

    const preguntas = document.querySelectorAll('.preguntaCont');
    const total = preguntas.length;
    let current = 0;

    const contador = document.getElementById('contadorPregunta');
    const btnAnterior = document.getElementById('btnAnterior');
    const btnSiguiente = document.getElementById('btnSiguiente');
    const quizForm = document.getElementById('quizForm');

    // Función para mostrar pregunta actual
    function mostrarPregunta(index) {
        preguntas.forEach((p, i) => p.classList.toggle('active', i === index));
        if (contador) contador.textContent = `Pregunta ${index + 1} de ${total}`;
        if (btnAnterior) btnAnterior.disabled = index === 0;
        if (btnSiguiente) btnSiguiente.disabled = index === total - 1;
    }

    // Navegación
    if (btnSiguiente) {
        btnSiguiente.addEventListener('click', () => {
            if (current < total - 1) {
                current++;
                mostrarPregunta(current);
            }
        });
    }

    if (btnAnterior) {
        btnAnterior.addEventListener('click', () => {
            if (current > 0) {
                current--;
                mostrarPregunta(current);
            }
        });
    }

    if (total > 0) mostrarPregunta(current);

    // Enviar quiz
    if (quizForm) {
        quizForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Detener el timer al enviar
            clearInterval(timerInterval);

            // Evitar doble envío
            if (quizForm.dataset.enviado === "true") return;
            quizForm.dataset.enviado = "true";

            // Bloquear navegación
            btnAnterior.disabled = true;
            btnSiguiente.disabled = true;

            // Bloquear botón de enviar
            const btnEnviar = quizForm.querySelector('button[type="submit"]');
            if (btnEnviar) btnEnviar.disabled = true;

            // Mostrar todas las preguntas
            preguntas.forEach(p => p.classList.add('active'));

            // Bloquear radios
            preguntas.forEach(p => {
                p.querySelectorAll('input[type="radio"]').forEach(op => op.disabled = true);
            });

            // Recolectar respuestas
            const respuestas = [];
            preguntas.forEach(p => {
                const idPregunta = p.dataset.id;
                const seleccionada = p.querySelector('input[type="radio"]:checked');
                respuestas.push({
                    id_pregunta: idPregunta,
                    respuesta: seleccionada ? seleccionada.value : "" // aunque no respondan
                });
            });

            // Enviar al backend
            fetch('php/procesarQuiz.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    respuestas: respuestas,
                    id_tema: quizForm.dataset.idTema,
                    dificultad: quizForm.dataset.dificultad
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'error') {
                    alert("Error: " + data.message);
                    return;
                }

                alert(`Quiz finalizado\nPuntaje: ${data.puntaje}/${data.total} (${data.porcentaje}%)`);

                    if (data.gano && data.certificado_url) {
                        window.location.href = data.certificado_url;
                    }

                // Resaltar respuestas correctas e incorrectas
                data.detalle.forEach(d => {
                    const pregunta = document.querySelector(`.preguntaCont[data-id="${d.id_pregunta}"]`);
                    if (!pregunta) return;

                    const correcta = d.correcta.trim().toLowerCase();

                    pregunta.querySelectorAll('input[type="radio"]').forEach(op => {
                        const opVal = op.value.trim().toLowerCase();

                        // Resaltar la correcta
                        if(opVal === correcta){
                            op.parentElement.style.border = "2px solid green";
                            op.parentElement.style.backgroundColor = "#d9f9d9";
                        }

                        // Si el usuario eligió una opción incorrecta, marcarla en rojo
                        if(op.checked && opVal !== correcta){
                            op.parentElement.style.border = "2px solid red";
                            op.parentElement.style.backgroundColor = "#f9d9d9";
                        }
                    });
                });
            })
            .catch(err => {
                console.error("Fetch error:", err);
                alert("Error al enviar el quiz.");
            });

        });
    }

});



//////////////////////

// ===== Ttimer del quiz =====
let tiempoTotal = 10 * 60; // 10 minutos en segundos
let timerInterval;

const timerDiv = document.getElementById('timer');
const timeSpan = document.getElementById('time');

function actualizarTimer() {
    const minutos = Math.floor(tiempoTotal / 60);
    const segundos = tiempoTotal % 60;

    timeSpan.textContent =
        `${minutos}:${segundos < 10 ? '0' : ''}${segundos}`;

    // Cambiar color según tiempo
    if (tiempoTotal <= 60) {
        timerDiv.classList.add('danger');
    } else if (tiempoTotal <= 180) {
        timerDiv.classList.add('warning');
    }

    if (tiempoTotal <= 0) {
        clearInterval(timerInterval);
        finalizarPorTiempo();
    }

    tiempoTotal--;
}

// Iniciar timer
timerInterval = setInterval(actualizarTimer, 1000);
actualizarTimer();

function finalizarPorTiempo() {
    alert("⏰ Se acabó el tiempo. El quiz se enviará automáticamente.");

    // Simula el submit del formulario
    const quizForm = document.getElementById('quizForm');
    if (quizForm) {
        quizForm.dispatchEvent(new Event('submit'));
    }
}

document.querySelector('.btnSalir').addEventListener('click', e => {
    if (!confirm('¿Seguro que quieres salir? Se perderá el progreso.')) {
        e.preventDefault();
    }
});