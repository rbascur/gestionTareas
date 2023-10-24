<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    // Consulta para verificar la autenticación
    $query = "SELECT id_usuario, contrasena FROM usuarios WHERE email = '$email'";
    $resultado = $conexion->query($query);

    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();
        if (password_verify($contrasena, $fila["contrasena"])) {
            $_SESSION["id_usuario"] = $fila["id_usuario"];
            header("Location: gestion_tareas.php"); // Redirigir a la página de gestión de tareas
        } else {
            echo "Contraseña incorrecta. <a href='login.php'>Intentar de nuevo</a>";
        }
    } else {
        echo "Usuario no encontrado. <a href='login.php'>Intentar de nuevo</a>";
    }
}

$conexion->close();
?>
