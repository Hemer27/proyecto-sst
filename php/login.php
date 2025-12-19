<?php
session_start();
include "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_usuario, nombre, apellido, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $nombre, $apellido, $hash_password);
        $stmt->fetch();

        if (password_verify($password, $hash_password)) {
            
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;

            header("Location: ../index.php");
            exit;
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location.href='../login.html';</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location.href='../login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>