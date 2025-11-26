// Template - Header y Footer
function loadComponent(id, file) {
  fetch(file)
    .then(response => response.text())
    .then(data => {
      document.getElementById(id).innerHTML = data;
    });
}

loadComponent("header", "templates/header.html");
loadComponent("footer", "templates/footer.html");

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

// Carrusel Temas
let slideIndex = 0;
let slides = document.getElementsByClassName("slide");
let dotsContainer = document.querySelector(".dots");

// Crear puntos autoamticamente
for (let i = 0; i < slides.length; i++) {
    let dot = document.createElement("span");
    dot.setAttribute("onclick", "currentSlide(" + i + ")");
    dotsContainer.appendChild(dot);
}
let dots = document.querySelectorAll(".dots span");

// Mostrar el slide actual
function showSlides(n) {
    if (n >= slides.length) slideIndex = 0;
    if (n < 0) slideIndex = slides.length - 1;

    for (let slide of slides) slide.style.display = "none";
    for (let dot of dots) dot.classList.remove("active");

    slides[slideIndex].style.display = "block";
    dots[slideIndex].classList.add("active");
}

// Controles manuales
function nextSlide() {
    slideIndex++;
    showSlides(slideIndex);
}

function prevSlide() {
    slideIndex--;
    showSlides(slideIndex);
}

document.querySelector(".next").onclick = nextSlide;
document.querySelector(".prev").onclick = prevSlide;

// Puntos
function currentSlide(n) {
    slideIndex = n;
    showSlides(slideIndex);
}

// Auto-play
setInterval(() => {
    slideIndex++;
    showSlides(slideIndex);
}, 8000);

// Inicializar
showSlides(slideIndex);