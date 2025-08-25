<?php
include 'db.php';
// Sección para registrar nuevos estudiantes
if (isset($_POST['name'])) {
    $nombre = trim($_POST['name']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['email']);
    $password_texto_plano = trim($_POST['password']);
    $fecha_nacimiento = trim($_POST['date']);
    $genero = trim($_POST['genero']);

    $password_hash = password_hash($password_texto_plano, PASSWORD_BCRYPT);

    $interesesSeleccionados = $_POST['intereses'] ?? [];
    if (!empty($_POST['otro_interes'])) {
        $interesesSeleccionados[] = trim($_POST['otro_interes']);
    }
    $intereses = implode(', ', $interesesSeleccionados);

    $sql  = "INSERT INTO alumnos (nombre, apellidos, correo, password_hash, fecha_de_nacimiento, genero, intereses) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellidos, $correo, $password_hash, $fecha_nacimiento, $genero, $intereses]);

    header('Location: registro.php?status=success');
    exit();
}

 // Sección para eliminar estudiantes
if (isset($_POST['confirmar_eliminacion']) && !empty($_POST['eliminar_ids'])) {
    $idsParaEliminar = $_POST['eliminar_ids'];
    $placeholders = implode(',', array_fill(0, count($idsParaEliminar), '?'));
    $sql = "DELETE FROM alumnos WHERE id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($idsParaEliminar);

    header('Location: Estudiantes.php?status=success');
    exit();
}

// Sección para agregar estudiantes
if (isset($_POST['confirmar_agregado']) && !empty($_POST['nuevo_nombre'])) {
    $sql = "INSERT INTO alumnos (nombre, apellidos, correo, intereses, fecha_de_nacimiento) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nuevo_nombre'],
        $_POST['nuevo_apellidos'],
        $_POST['nuevo_correo'],
        $_POST['nuevo_intereses'],
        $_POST['nuevo_fecha_nacimiento'],
    ]);

    header('Location: Estudiantes.php?status=success');
    exit();
}
// Sección para editar estudiantes
if (isset($_POST['confirmar_edicion']) && !empty($_POST['editar_id'])) {
    $sql = "UPDATE alumnos SET nombre = ?, apellidos = ?, correo = ?, intereses = ?, fecha_de_nacimiento = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['editar_nombre'],
        $_POST['editar_apellidos'],
        $_POST['editar_correo'],
        $_POST['editar_intereses'],
        $_POST['editar_fecha_nacimiento'],
        $_POST['editar_id']
    ]);
    header('Location: Estudiantes.php?status=success');
    exit();

}
exit();
?>