// Template - Header y Footer con sesión
function loadComponent(id, file) {
  fetch(file)
    .then(response => response.text())
    .then(data => {
      document.getElementById(id).innerHTML = data;

      // Revisa la sesión después de cargar el header
      if (id === "header") {
        const loginArea = document.getElementById("login-area");
        fetch("php/estadoSesion.php") // desde la raíz hacia php
          .then(res => res.json())
          .then(data => {
            if (data.loggedIn && loginArea) {
              loginArea.innerHTML = `
                <span class="nav-link text-light">${data.nombre}</span>
                <a class="btn btn-outline-light btn-sm ms-2" href="php/logout.php">Cerrar Sesión</a>
              `;
            }
          })
          .catch(err => console.error(err));
      }
    });
}

// Cargar header y footer
loadComponent("header", "templates/header.html");
loadComponent("footer", "templates/footer.html");

// Carrusel Temas
document.addEventListener("DOMContentLoaded", () => {
    // Carrusel
    let slideIndex = 0;
    const slides = document.querySelectorAll(".carousel .slide");
    const dotsContainer = document.querySelector(".dots");
    const nextBtn = document.querySelector(".next");
    const prevBtn = document.querySelector(".prev");

    if (!slides.length || !dotsContainer) return; // Evita errores si no hay slides

    // Crear puntos dinámicamente
    slides.forEach((_, i) => {
        const dot = document.createElement("span");
        dot.addEventListener("click", () => currentSlide(i));
        dotsContainer.appendChild(dot);
    });

    const dots = document.querySelectorAll(".dots span");

    function showSlides(n) {
        if (n >= slides.length) slideIndex = 0;
        if (n < 0) slideIndex = slides.length - 1;

        slides.forEach(slide => slide.style.display = "none");
        dots.forEach(dot => dot.classList.remove("active"));

        slides[slideIndex].style.display = "block";
        dots[slideIndex].classList.add("active");
    }

    function nextSlide() {
        slideIndex++;
        showSlides(slideIndex);
    }

    function prevSlide() {
        slideIndex--;
        showSlides(slideIndex);
    }

    function currentSlide(n) {
        slideIndex = n;
        showSlides(slideIndex);
    }

    nextBtn?.addEventListener("click", nextSlide);
    prevBtn?.addEventListener("click", prevSlide);

    // Auto-play
    setInterval(nextSlide, 8000);

    // Inicializar
    showSlides(slideIndex);
});

// Traer los temas y la dificultad de la base de datos
function cargarOpciones() {
    fetch('php/opcionesDificultad.php')
        .then(res => res.json())
        .then(data => {
            const selectTema = document.getElementById('tema');
            const selectDificultad = document.getElementById('dificultad');

            // Limpiar selects
            selectTema.innerHTML = '';
            selectDificultad.innerHTML = '';

            // Llenar temas
            data.temas.forEach(t => {
                const option = document.createElement('option');
                option.value = t.id_tema;
                option.textContent = t.nombre_tema;
                selectTema.appendChild(option);
            });

            // Llenar dificultades
            data.dificultades.forEach(d => {
                const option = document.createElement('option');
                option.value = d;
                option.textContent = d.charAt(0).toUpperCase() + d.slice(1);
                selectDificultad.appendChild(option);
            });
        });
}

    // Modal quiz
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modalQuiz');
        const btnCancelar = document.getElementById('btnCancelar');
        const btnIniciar = document.getElementById('btnIniciar');
        const btnQuiz = document.getElementById('btnQuiz');

        // Botón Realizar Quiz
        btnQuiz.addEventListener('click', () => {
            fetch('php/estadoSesion.php')
                .then(res => res.json())
                .then(data => {
                    if (!data.loggedIn) {
                        alert("Debes iniciar sesión para realizar el quiz");
                    } else {
                        cargarOpciones();
                        modal.style.display = 'flex';
                    }
                });
        });

    // Botón Cancelar del modal
    btnCancelar.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Botón Iniciar Quiz
    btnIniciar.addEventListener('click', () => {
        const tema = document.getElementById('tema').value;
        const dificultad = document.getElementById('dificultad').value;

        modal.style.display = 'none';
        window.location.href = `quiz.php?tema=${encodeURIComponent(tema)}&dificultad=${encodeURIComponent(dificultad)}`;
    });
});

// Obtener tema y dificultad
const urlParams = new URLSearchParams(window.location.search);
const temaId = urlParams.get('tema');
const dificultad = urlParams.get('dificultad');

const infoQuiz = document.getElementById('infoQuiz');

// Muestra directamente el ID del tema y dificultad
infoQuiz.textContent = `${temaId} - ${dificultad}`;

fetch(`php/getTema.php?id=${temaId}`)
  .then(res => res.json())
  .then(data => {
      infoQuiz.textContent = `${data.nombre} - ${dificultad}`;
  });

// Modal con imagenes - tipos de riesgos
function abrirModalMultiple(listaImagenes) {
    const galeria = document.getElementById("modalGaleria");
    galeria.innerHTML = "";

    listaImagenes.forEach(img => {
        const imagen = document.createElement("img");
        imagen.src = img;
        galeria.appendChild(imagen);
    });

    document.getElementById("modal").style.display = "block";
}

function cerrarModal() {
    document.getElementById("modal").style.display = "none";
}

