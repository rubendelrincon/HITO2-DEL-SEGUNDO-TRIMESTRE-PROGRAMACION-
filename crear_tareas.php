<?php
session_start(); // Inicia una nueva sesión o reanuda la sesión existente
if (!isset($_SESSION['usuario_id'])) { // Verifica si el usuario ha iniciado sesión
    header("Location: iniciar_sesion.php"); // Redirige al usuario a la página de inicio de sesión si no ha iniciado sesión
    exit(); // Termina la ejecución del script
}
include 'db.php'; // Incluye el archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Verifica si el formulario ha sido enviado
    $descripcion = $_POST['descripcion']; // Obtiene la descripción de la tarea del formulario
    $usuario_id = $_SESSION['usuario_id']; // Obtiene el ID del usuario de la sesión

    $stmt = $conn->prepare("INSERT INTO tareas (usuario_id, descripcion) VALUES (?, ?)"); // Prepara la consulta SQL para insertar una nueva tarea
    $stmt->execute([$usuario_id, $descripcion]); // Ejecuta la consulta con los valores proporcionados
    header("Location: mostrar_tareas.php"); // Redirige al usuario a la página de mostrar tareas
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres del documento -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para que sea compatible con dispositivos móviles -->
    <title>Agregar Tarea</title> <!-- Título de la página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Incluye el CSS de Bootstrap -->
</head>
<body>
    <div class="container mt-5"> <!-- Contenedor principal con margen superior -->
        <h2>Agregar Nueva Tarea</h2> <!-- Título de la página -->
        <form method="POST"> <!-- Formulario para agregar una nueva tarea -->
            <div class="mb-3"> <!-- Grupo de formulario con margen inferior -->
                <label for="descripcion" class="form-label">Descripción</label> <!-- Etiqueta para el campo de descripción -->
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea> <!-- Campo de texto para la descripción de la tarea -->
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button> <!-- Botón para enviar el formulario -->
        </form>
        <a href="mostrar_tareas.php" class="btn btn-secondary mt-3">Volver a Mis Tareas</a> <!-- Enlace para volver a la página de mostrar tareas -->
    </div>
</body>
</html>