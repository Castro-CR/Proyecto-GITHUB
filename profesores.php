<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .fila-agregar, .checkbox-eliminar, .controles-confirmacion { display: none; }
    </style>
</head>
<body class="pagina-profesores">
    <header>
        <h1>Módulo de profesores</h1>
    </header>
    <nav class="menu">
        <ul>
            <li><a href="Estudiantes.php">Estudiantes</a></li>
            <li><a href="Cursos.php">Cursos</a></li>
            <li><a href="index.html">Salir</a></li>
        </ul>
    </nav>
    <main>
        <section>
            <form id="form-profesores" method="POST" action="procesar_profes.php">
                <div class="acciones-superiores">
                    <button type="button" id="btn-agregar">Agregar</button>
                    <button type="button" id="btn-eliminar">Eliminar</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="checkbox-eliminar"></th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Curso</th>
                            <th>Estudiantes</th>
                            <th>Sede</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM profesores ORDER BY id ASC");
                        while ($profesor = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr class='fila-profesor'>";
                            echo "<td class='checkbox-eliminar'><input type='checkbox' name='eliminar_ids[]' value='" . $profesor['id'] . "'></td>";
                            echo "<td data-columna='nombre'>" . htmlspecialchars($profesor['nombre']) . "</td>";
                            echo "<td data-columna='apellidos'>" . htmlspecialchars($profesor['apellidos']) . "</td>";
                            echo "<td data-columna='correo'>" . htmlspecialchars($profesor['correo']) . "</td>";
                            echo "<td data-columna='curso_imparte'>" . htmlspecialchars($profesor['curso_imparte']) . "</td>";
                            echo "<td data-columna='estudiantes_asignados'>" . htmlspecialchars($profesor['estudiantes_asignados']) . "</td>";
                            echo "<td data-columna='sede_imparte'>" . htmlspecialchars($profesor['sede_imparte']) . "</td>";
                            echo "<input type='hidden' class='profesor-id' value='" . $profesor['id'] . "'>";
                            echo "<td><a href='procesar_profes.php?accion=ver_detalles&id=" . $profesor['id'] . "' class='btn-detalle'>Ver Detalles</a></td>";
                            echo "</tr>";
                        }
                        ?>
                        <tr id="fila-agregar" class="fila-agregar">
                            <td class="checkbox-eliminar"></td>
                            <td><input type="text" name="nuevo_nombre" placeholder="Nombre"></td>
                            <td><input type="text" name="nuevo_apellidos" placeholder="Apellidos"></td>
                            <td><input type="email" name="nuevo_correo" placeholder="correo@ejemplo.com"></td>
                            <td><input type="text" name="nuevo_curso" placeholder="Curso"></td>
                            <td><input type="number" name="nuevo_estudiantes" placeholder="Cantidad"></td>
                            <td><input type="text" name="nuevo_sede" placeholder="Sede"></td>
                        </tr>
                    </tbody>
                </table>
                <div id="controles-confirmacion" class="controles-confirmacion">
                    <button type="submit" id="btn-guardar-nuevo" name="confirmar_agregado" style="display: none;">Guardar Profesor</button>
                    <button type="submit" id="btn-confirmar-eliminacion" name="confirmar_eliminacion" style="display: none;">Confirmar Eliminación</button>
                    <button type="button" id="btn-cancelar">Cancelar</button>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Módulo de Profesores</p>
    </footer>
    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            inicializarPaginaCRUD({
                formId: 'form-profesores',
                nombreEntidad: 'profesor'
            });
        });
    </script>
</body>
</html>