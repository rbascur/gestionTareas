<?php
session_start();
include("conexion.php");

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    // El usuario no está autenticado, muestra botones de inicio de sesión y registro
    echo "<h1>Bienvenido a la Gestión de Tareas</h1>";
    echo "<p>Inicia sesión o regístrate para comenzar:</p>";
    echo "<a href='login.php'>Iniciar Sesión</a> | <a href='registro.php'>Registrarse</a>";
    exit(); // Detiene la ejecución del resto de la página
}

// El usuario está autenticado, obtenemos sus tareas
$id_usuario = $_SESSION['id_usuario'];
$query = "SELECT id_tarea, tarea, estado FROM tareas WHERE id_usuario = $id_usuario";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Tareas</title>
</head>
<body>
    <h1>Gestión de Tareas</h1>
    <p>Bienvenido, Usuario <?php echo $id_usuario; ?>.</p>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>

    <h2>Tus Tareas:</h2>
    <ul>
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<li>{$fila['tarea']} (Estado: {$fila['estado']})</li>";
                echo "<a href='editar_tarea.php?id={$fila['id_tarea']}'>Editar</a> | <a href='eliminar_tarea.php?id={$fila['id_tarea']}'>Eliminar</a>";
            }
        } else {
            echo "<li>No tienes tareas aún.</li>";
        }
        ?>
    </ul>

    <h2>Agregar Nueva Tarea:</h2>
    <form action="agregar_tarea.php" method="post">
        Tarea: <input type="text" name="tarea"><br>
        Estado: <input type="text" name="estado"><br>
        <input type="submit" value="Agregar Tarea">
    </form>
</body>
</html>
