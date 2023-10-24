<?php
session_start();
include("conexion.php");

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tarea']) && isset($_POST['estado'])) {
    $tarea = $_POST['tarea'];
    $estado = $_POST['estado'];

    // Insertar la nueva tarea en la base de datos
    $query = "INSERT INTO tareas (tarea, estado, id_usuario) VALUES ('$tarea', '$estado', {$_SESSION['id_usuario']})";

    if ($conexion->query($query) === TRUE) {
        echo "Nueva tarea agregada correctamente. <a href='gestion_tareas.php'>Volver a la gestión de tareas</a>";
    } else {
        echo "Error al agregar la tarea: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Tarea</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <h1>Agregar Tarea</h1>
    <form action="agregar_tarea.php" method="post">
        Tarea: <input type="text" name="tarea"><br>
        Estado: <input type="text" name="estado"><br>
        <input type="submit" value="Agregar Tarea">
    </form>
</body>
</html>
