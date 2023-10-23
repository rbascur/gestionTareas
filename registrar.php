<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (nombres, apellidos, email, contrasena) VALUES ('$nombres', '$apellidos', '$email', '$contrasena')";

    if ($conexion->query($query) === TRUE) {
        echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "Error al registrar: " . $conexion->error;
    }
}

$conexion->close();
?>
