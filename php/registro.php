<?php
include "conexion.php";

// Tomar datos y limpiar
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$email = strtolower(trim($_POST['email']));
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Verificar si el email ya existe
$stmtCheck = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
$stmtCheck->bind_param("s", $email);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    echo "<script>
            alert('El correo ya está registrado. Intenta con otro.');
            window.location.href = '../registro.html';
          </script>";
    exit;
}

// Insertar nuevo usuario
$stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $apellido, $email, $password);

if ($stmt->execute()) {
    echo "<script>
            alert('Registro exitoso. Serás redirigido al login.');
            window.location.href = '../login.html';
          </script>";
} else {
    echo "<script>
            alert('Error al registrar usuario.');
            window.location.href = '../registro.html';
          </script>";
}

$stmt->close();
$conn->close();
?>