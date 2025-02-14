<?php
$host = 'localhost';       // Servidor de la base de datos
$dbname = 'tareas_db';     // Nombre de la base de datos
$user = 'root';            // Usuario de la base de datos (por defecto es 'root')
$pass = 'curso';           // Contraseña de la base de datos

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>