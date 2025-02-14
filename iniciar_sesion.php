<?php
// Inicia una nueva sesión o reanuda la sesión existente
session_start();

// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los valores de correo y contraseña enviados por el formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Prepara una consulta SQL para seleccionar el usuario con el correo proporcionado
    $stmt = $conn->prepare("SELECT id, nombre_usuario, contrasena FROM usuarios WHERE correo = ?");
    // Ejecuta la consulta con el correo proporcionado
    $stmt->execute([$correo]);
    // Obtiene el resultado de la consulta
    $usuario = $stmt->fetch();

    // Verifica si el usuario existe y si la contraseña proporcionada coincide con la almacenada
    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        // Si las credenciales son correctas, guarda el ID y nombre de usuario en la sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
        // Redirige al usuario a la página de mostrar tareas
        header("Location: mostrar_tareas.php");
    } else {
        // Si las credenciales no son correctas, muestra un mensaje de alerta
        echo "<script>alert('no estan bien las credenciales.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Incluye el CSS de Bootstrap desde un CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>
        <!-- Formulario para iniciar sesión -->
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <!-- Campo de entrada para el correo electrónico -->
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <!-- Campo de entrada para la contraseña -->
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>