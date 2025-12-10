<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SST - Seguridad y Salud en el Trabajo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos/estilos.css">
    <link rel="stylesheet" href="estilos/estilosHF.css">
    <link rel="shortcut icon" href="img/icono.png" type="image/x-icon">

</head>
<body>
    <!-- Header -->
    <div id="header"></div>

  <!-- Panel Informativo -->
    <div class="panel">
        <div id="" class="panelh1">
            <h1>Aprende sobre Seguridad en el Trabajo 🦺, Medio Ambiente 🌱 y Hábitos Saludables ❤️ de forma divertida.</h1>
            <h5>Bienvenido/a a este espacio donde podrás aprender de forma sencilla y agradable sobre seguridad en el trabajo, cuidado del medio ambiente y hábitos saludables para mejorar tu bienestar cada día.</h5>
            <!-- BTN Quiz -->        
            <div class="divBtnQuiz">
                <a href="#" class="btnQuiz">Realizar el Quiz 📝</a>
            </div>
        </div>
        <div class="divImgPanel">
            <img class="imgPanel" src="img/imgPanel.png" alt="">
        </div>
    </div>

    

  <!-- Funcionamiento -->
    <section class="funcionamiento">
      <h2>¿Cómo funciona la plataforma?</h2>

      <div class="cards">

          <div class="card">
              <div class="icon">📘</div>
              <h3>Consulta los temas de estudio</h3>
              <p>
                  En la parte inferior del sitio encontrarás los contenidos preparados para esta capacitación.
                  Estos temas ofrecen una síntesis de la información principal que necesitas conocer.
              </p>
          </div>

          <div class="card">
              <div class="icon">🔗</div>
              <h3>Revisa las fuentes originales</h3>
              <p>
                  Como aquí solo se presenta un resumen, te recomendamos consultar también los recursos y páginas
                  originales utilizadas para elaborar el material, con el fin de obtener una comprensión completa.
              </p>
          </div>

          <div class="card">
              <div class="icon">📝</div>
              <h3>Accede al quiz de capacitación</h3>
              <p>
                  Desde la página principal podrás iniciar el quiz seleccionando “Realizar el Quiz 📝”. El sistema registrará
                  tus respuestas y generará tu puntaje automáticamente.
              </p>
          </div>

          <div class="card">
              <div class="icon">🏆</div>
              <h3>Revisa los mejores puntajes</h3>
              <p>
                  La plataforma muestra una tabla con los puntajes más altos, permitiendo evaluar el desempeño 
                  general y promover la mejora continua.
              </p>
          </div>

      </div>
    </section>

    <!-- Temas de Estudio -->
    <div class="carousel-container">
        <h2 class="h2Temas">Temas de estudio</h2>

        <div class="carousel">
            
            <!-- Slide 1 -->
            <div class="slide">
                <img src="img/segTrabajo.jpg" alt="">
                <div class="overlay">
                    <p><strong>Seguridad y Salud en el Trabajo</strong><br>
                        <a href="seguridad.html">Más Información</a>
                    </p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide">
                <img src="img/medAmbiente.jpg" alt="">
                <div class="overlay">
                    <p><strong>Medio Ambiente</strong><br>
                        <a href="medioAmbiente.html">Más Información</a>
                    </p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide">
                <img src="img/saludable.jpg" alt="">
                <div class="overlay">
                    <p><strong>Hábitos Saludables</strong><br>
                        <a href="habitosSaludables.html">Más Información</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Botones -->
        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>

        <!-- Indicadores -->
        <div class="dots"></div>
    </div>

  <!-- Tabla -->
  <div class="divTabla">
    <h2>Tabla de puntuación</h2>
  </div>



  <!-- Footer -->
  <div id="footer" ></div>

  <script src="js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>