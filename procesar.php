<?php
include 'db.php';

$nombre = trim($_POST['name'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$fecha_nacimiento = trim($_POST['date'] ?? '');
$genero = trim($_POST['genero'] ?? '');
$intereses = isset($_POST['intereses']) ? implode(',', $_POST['intereses']) : '';
$correo = trim($_POST['email'] ?? '');


$errores = [];
if ($nombre === '')  $errores[] = 'El nombre es obligatorio.';
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = 'Correo inválido.';
if ($apellidos === '') $errores[] = 'Los apellidos son obligatorios.';
if ($fecha_nacimiento === '') $errores[] = 'La fecha de nacimiento es obligatoria.';
if ($genero === '') $errores[] = 'El género es obligatorio.';
if ($intereses === '') $errores[] = 'Debe seleccionar al menos un interés.';


if (count($errores) > 0) {
  foreach ($errores as $err) {
    echo "<p style='color:red;'>$err</p>";
  }
  echo "<p><a href='registro.php'>Volver</a></p>";
  exit;
}

$sql  = "INSERT INTO alumnos (nombre, apellidos, correo, fecha_de_nacimiento, genero, intereses ) VALUES (:nombre, :apellidos, :correo, :fecha_de_nacimiento, :genero, :intereses)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nombre' => $nombre, 
    ':correo' => $correo,
    ':apellidos' => $apellidos,
    ':fecha_de_nacimiento' => $fecha_nacimiento,
    ':genero' => $genero,
    ':intereses' => $intereses
]);

header('Location: registro.php');
exit;
?>