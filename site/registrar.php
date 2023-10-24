<?php /*
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

$conexion->close(); */

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

    // Intenta agregar un nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (nombres, apellidos, email, contrasena) VALUES ('$nombres', '$apellidos', '$email', '$contrasena')";

    try {
        if ($conexion->query($query) === TRUE) {
            echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
        }
    } catch (mysqli_sql_exception $ex) {
        $errorCode = $ex->getCode();

        if ($errorCode === 1062) {
            echo "El correo electrónico ya está registrado. Puede usar otro correo o iniciar sesión en la cuenta que ya tiene.";
        } else {
            echo "Error al registrar: " . $ex->getMessage();
        }
    }
}

$conexion->close();

?>
