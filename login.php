<?php
session_start();
include 'db.php';

// Verifica que el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';

    // Busca al usuario por su correo
    $sql = "SELECT id, nombre, password_hash FROM alumnos WHERE correo = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica si se encontró un usuario y si la contraseña encriptada coincide
    if ($usuario && password_verify($password, $usuario['password_hash'])) {
        // Credenciales correctas: guarda los datos en la sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        
        // Redirige a la página de estudiantes
        header("Location: Estudiantes.php");
        exit();
    } else {
        // Credenciales incorrectas: redirige de vuelta al login con un mensaje de error
        header("Location: index.php?error=1");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>