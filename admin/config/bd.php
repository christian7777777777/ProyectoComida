<?php
// Datos de conexión a la base de datos
$host = 'localhost'; // Host de la base de datos
$dbname = 'bd_sitio_web'; // Nombre de la base de datos
$usuario = 'root'; // Usuario de la base de datos
$contrasena = ''; // Contraseña de la base de datos

try {
    // Crear una nueva conexión PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $contrasena);

    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    // En caso de error, imprimir el mensaje de error
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}
?>