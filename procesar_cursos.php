<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['confirmar_eliminacion']) && !empty($_POST['eliminar_ids'])) {
        $idsParaEliminar = $_POST['eliminar_ids'];
        $placeholders = implode(',', array_fill(0, count($idsParaEliminar), '?'));
        $sql = "DELETE FROM cursos WHERE id IN ($placeholders)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($idsParaEliminar);
    }

    if (isset($_POST['confirmar_agregado']) && !empty($_POST['nuevo_nombre_curso'])) {
        $sql = "INSERT INTO cursos (profesor_imparte_curso, nombre_curso, codigo_curso, descripcion, creditos) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['nuevo_profesor'],
            $_POST['nuevo_nombre_curso'],
            $_POST['nuevo_codigo_curso'],
            $_POST['nuevo_descripcion'],
            $_POST['nuevos_creditos_curso']
        ]);
    }
}

header('Location: cursos.php?status=success');
exit();
?>