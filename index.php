<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SST - Seguridad y Salud en el Trabajo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos/estilos.css">
    <link rel="shortcut icon" href="img/icono.png" type="image/x-icon">

</head>
<body>
    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow">
        <div class="container">
            <!-- Logo / Título -->
            <a class="navbar-brand fw-bold" href="#inicio">SST</a>

            <!-- Botón para móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Enlaces de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                <a class="nav-link" href="#inicio">Inicio</a>
                </li>
                <li class="nav-item">
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Temas
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Seguridad y Salud en el Trabajo</a></li>
                    <li><a class="dropdown-item" href="#">Medio Ambiente</a></li>
                    <li><a class="dropdown-item" href="#">Hábitos Saludables</a></li>
                  </ul>
                </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#puntajes">Puntajes</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

  <!-- Panel Informativo -->
    <div class="panel">
        <div id="" class="">
            <h1>Aprende sobre Seguridad en el Trabajo 🦺, Medio Ambiente 🌱 y Hábitos Saludables ❤️ de forma divertida.</h1>
        </div>
    </div>

  <!-- BTN Quiz -->
    <div class="divBtnQuiz">
        <a href="#" class="btnQuiz">Realizar el Quiz 📝</a>
    </div>

  <!-- Temas de Estudio -->
    <div class="divTemasGeneral">
        <h2 class="h2Temas">Temas de estudio</h2>
        <div class="divContTemas">
            <div class="divImgTemas">
                <img src="img/segTrabajo.jpg" alt="">
                <div class="trabajo">
                    <p><strong>Seguridad y Salud en el Trabajo</strong>
                      <br>  Mas Información
                    </p>
                </div>
            </div>

            <div class="divImgTemas">
                <img src="img/medAmbiente.jpg" alt="">
                <div class="ambiente">
                    <p><strong>Medio Ambiente</strong>
                      <br>  Mas Información
                    </p>
                </div>
            </div>

            <div class="divImgTemas">
                <img src="img/saludable.jpg" alt="">
                <div class="salud">
                    <p><strong>Hábitos Saludables</strong>
                      <br>  Mas Información
                    </p>
                </div>
            </div>
        </div>
    </div>

  <!-- Tabla FALTA EL TEMA -->
  <div class="divTabla">
    <h2>Tabla de puntuación</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Puntaje</th>
          <th scope="col">Dificultad</th>
          <th scope="col">Fecha</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Luis</td>
          <td>5/10</td>
          <td>Dificil</td>
          <td>22/05/25</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Ana</td>
          <td>5/10</td>
          <td>Intemedio</td>
          <td>22/05/25</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Daniela</td>
          <td>5/10</td>
          <td>Intemedio</td>
          <td>22/05/25</td>
        </tr>
      </tbody>
    </table>
  </div>



  <!-- Footer -->
  <footer class="text-center">
    <p>&copy; 2025 - Proyecto SST. Basado en fuentes oficiales (OIT, Ministerio de Trabajo).</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>