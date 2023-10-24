<?php
// Datos de la conexión a la base de datos
$host = "localhost";
$usuario = "grupo1";
$contrasena = "grupo1";
$base_de_datos = "gestionTareas";

// Crear una conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Probar la conexión OJO OJO OJO; siempre comentar esta prueba
/*if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    echo "Conectado a la base de datos.";
}*/

//$conexion->close(); // Esto se usara desde otras archivos
?>