<?php
session_start();
include("conexion.php");

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_tarea = $_GET['id'];

    // Consulta para eliminar la tarea
    $query = "DELETE FROM tareas WHERE id_tarea = $id_tarea AND id_usuario = {$_SESSION['id_usuario']}";

    if ($conexion->query($query) === TRUE) {
        echo "Tarea eliminada correctamente. <a href='gestion_tareas.php'>Volver a la gestión de tareas</a>";
    } else {
        echo "Error al eliminar la tarea: " . $conexion->error;
    }
}
?>
