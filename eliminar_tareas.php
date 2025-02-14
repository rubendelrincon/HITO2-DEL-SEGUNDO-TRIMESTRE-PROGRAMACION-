<?php
session_start(); // Inicia la sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: iniciar_sesion.php");
    exit();
}
include 'db.php';

if (isset($_GET['id'])) {
    $tarea_id = $_GET['id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verificar que la tarea pertenece al usuario
    $stmt = $conn->prepare("SELECT id FROM tareas WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$tarea_id, $usuario_id]);
    if ($stmt->rowCount() > 0) {
        // Eliminar la tarea
        $stmt = $conn->prepare("DELETE FROM tareas WHERE id = ?");
        $stmt->execute([$tarea_id]);
    }
    header("Location: mostrar_tareas.php");
}
?>