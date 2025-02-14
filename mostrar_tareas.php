<?php
// Inicia la sesión
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // Si no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: iniciar_sesion.php");
    exit();
}

// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Obtener las tareas del usuario
$usuario_id = $_SESSION['usuario_id']; // Obtiene el ID del usuario de la sesión
$stmt = $conn->prepare("SELECT * FROM tareas WHERE usuario_id = ?"); // Prepara la consulta SQL
$stmt->execute([$usuario_id]); // Ejecuta la consulta con el ID del usuario
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtiene todas las tareas del usuario en un array asociativo
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Incluye Bootstrap para estilos -->
</head>
<body>
    <div class="container mt-5">
        <h2>Mis Tareas</h2>
        <a href="crear_tareas.php" class="btn btn-success mb-3">Agregar Tarea</a> <!-- Enlace para agregar una nueva tarea -->
        <table class="table">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $tarea): ?> <!-- Itera sobre las tareas del usuario -->
                <tr>
                    <td><?php echo $tarea['descripcion']; ?></td> <!-- Muestra la descripción de la tarea -->
                    <td><?php echo $tarea['completada'] ? 'Completada' : 'Pendiente'; ?></td> <!-- Muestra el estado de la tarea -->
                    <td><?php echo $tarea['fecha_creacion']; ?></td> <!-- Muestra la fecha de creación de la tarea -->
                    <td>
                        <a href="eliminar_tareas.php?id=<?php echo $tarea['id']; ?>" class="btn btn-danger">Eliminar</a> <!-- Enlace para eliminar la tarea -->
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="logout.php" class="btn btn-primary">Cerrar Sesión</a> <!-- Enlace para cerrar sesión -->
    </div>
</body>
</html>