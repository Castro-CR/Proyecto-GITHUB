<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'ver_detalles') {

    $profesor_id = $_GET['id'] ?? 0;
    $sql = "SELECT * FROM profesores WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$profesor_id]);
    $profesor = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$profesor) {
        die("Profesor no encontrado.");
    }

    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Detalles del Profesor</title>
        <link rel="stylesheet" href="estilos.css"> </head>
    <body class="pagina-detalle">
        <header>
            <h1>Detalles de <?php echo htmlspecialchars($profesor['nombre']) . " " . htmlspecialchars($profesor['apellidos']); ?></h1>
        </header>
        <main>
            <section>
                <p><strong>ID:</strong> <?php echo $profesor['id']; ?></p>
                <p><strong>Nombre completo:</strong> <?php echo htmlspecialchars($profesor['nombre']) . " " . htmlspecialchars($profesor['apellidos']); ?></p>
                <p><strong>Correo:</strong> <?php echo htmlspecialchars($profesor['correo']); ?></p>
                <p><strong>Curso que imparte:</strong> <?php echo htmlspecialchars($profesor['curso_imparte']); ?></p>
                <p><strong>Estudiantes asignados:</strong> <?php echo htmlspecialchars($profesor['estudiantes_asignados']); ?></p>
                <p><strong>Sede:</strong> <?php echo htmlspecialchars($profesor['sede_imparte']); ?></p>
                <br>
                <a href="Profesores.php" class="btn-volver">Volver a la lista</a>
            </section>
        </main>
    </body>
    </html>
    <?php
    exit(); 
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Lógica para ELIMINAR
    if (isset($_POST['confirmar_eliminacion']) && !empty($_POST['eliminar_ids'])) {
        $idsParaEliminar = $_POST['eliminar_ids'];
        $placeholders = implode(',', array_fill(0, count($idsParaEliminar), '?'));
        $sql = "DELETE FROM profesores WHERE id IN ($placeholders)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($idsParaEliminar);
    }

    // Lógica para AGREGAR
    if (isset($_POST['confirmar_agregado']) && !empty($_POST['nuevo_nombre'])) {
        $sql = "INSERT INTO profesores (nombre, apellidos, correo, curso_imparte, estudiantes_asignados, sede_imparte) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['nuevo_nombre'],
            $_POST['nuevo_apellidos'],
            $_POST['nuevo_correo'],
            $_POST['nuevo_curso'],
            $_POST['nuevo_estudiantes'],
            $_POST['nuevo_sede']
        ]);
    }

    // Al terminar, redirigimos a la página principal de profesores
    header('Location: Profesores.php?status=success');
    exit();
}


header('Location: Profesores.php');
exit();
?>