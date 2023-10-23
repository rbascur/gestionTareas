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

    // Consulta para obtener la tarea actual
    $query = "SELECT tarea, estado FROM tareas WHERE id_tarea = $id_tarea AND id_usuario = {$_SESSION['id_usuario']}";
    $resultado = $conexion->query($query);

    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();
        $tarea = $fila['tarea'];
        $estado = $fila['estado'];
    } else {
        echo "Tarea no encontrada.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_tarea'])) {
    $id_tarea = $_POST['id_tarea'];
    $tarea = $_POST['tarea'];
    $estado = $_POST['estado'];

    // Actualizar la tarea en la base de datos
    $query = "UPDATE tareas SET tarea = '$tarea', estado = '$estado' WHERE id_tarea = $id_tarea AND id_usuario = {$_SESSION['id_usuario']}";

    if ($conexion->query($query) === TRUE) {
        echo "Tarea actualizada correctamente. <a href='gestion_tareas.php'>Volver a la gestión de tareas</a>";
    } else {
        echo "Error al actualizar la tarea: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarea</title>
</head>
<body>
    <h1>Editar Tarea</h1>
    <form action="editar_tarea.php" method="post">
        <input type="hidden" name="id_tarea" value="<?php echo $id_tarea; ?>">
        Tarea: <input type="text" name="tarea" value="<?php echo $tarea; ?>"><br>
        Estado: <input type="text" name="estado" value="<?php echo $estado; ?>"><br>
        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
