<?php
// Incluye el archivo de conexión
include("conexion.php");

// Consulta para seleccionar todos los registros de la tabla "usuarios"
$query = "SELECT * FROM usuarios";
$resultado = $conexion->query($query);

// Verifica si la consulta se ejecutó correctamente
if ($resultado) {
    // Verifica si hay al menos un registro
    if ($resultado->num_rows > 0) {
        // Imprime una tabla HTML con los resultados
        echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
            </tr>";

        // Recorre los registros y muestra los datos en la tabla
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila["id_usuario"] . "</td>";
            echo "<td>" . $fila["nombres"] . "</td>";
            echo "<td>" . $fila["apellidos"] . "</td>";
            echo "<td>" . $fila["email"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros.";
    }
} else {
    echo "Error al ejecutar la consulta: " . $conexion->error;
}

// Cierra la conexión
$conexion->close();
?>
