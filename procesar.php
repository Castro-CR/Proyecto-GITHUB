<?php
include 'db.php';



if (isset($_POST['confirmar_eliminacion']) && !empty($_POST['eliminar_ids'])) {
    $idsParaEliminar = $_POST['eliminar_ids'];
    $placeholders = implode(',', array_fill(0, count($idsParaEliminar), '?'));
    $sql = "DELETE FROM alumnos WHERE id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($idsParaEliminar);

    header('Location: Estudiantes.php?status=success');
    exit();
}


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



if (isset($_POST['name'])) {
    $nombre = trim($_POST['name']);
    $apellidos = trim($_POST['apellidos']);
    $fecha_nacimiento = trim($_POST['date']);
    $genero = trim($_POST['genero']);
    $correo = trim($_POST['email']);

    $interesesSeleccionados = $_POST['intereses'] ?? [];
    if (!empty($_POST['otro_interes'])) {
        $interesesSeleccionados[] = trim($_POST['otro_interes']);
    }
    $intereses = implode(', ', $interesesSeleccionados);


    
    $sql  = "INSERT INTO alumnos (nombre, apellidos, correo, fecha_de_nacimiento, genero, intereses) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $apellidos, $correo, $fecha_nacimiento, $genero, $intereses]);

    header('Location: registro.php?status=success');
    exit();
}


header('Location: estudiantes.php');
exit();
?>