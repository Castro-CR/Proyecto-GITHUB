<?php include 'db.php'; ?>
<!--Página de cursos-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .fila-agregar, .checkbox-eliminar, .controles-confirmacion { display: none; }
    </style>
</head>
<body class="pagina-cursos">
    <header>
        <h1>Módulo de cursos</h1>
    </header>

    <nav class="menu">
        <ul>
            <li><a href="Estudiantes.php">Estudiantes</a></li>
            <li><a href="Profesores.php">Profesores</a></li>
            <li><a href="index.html">Salir</a></li>
        </ul>
    </nav>
    <main>
        <section>
            <form id="form-cursos" method="POST" action="procesar_cursos.php">
                <div class="botones">
                    <button type="button" id="btn-agregar">Agregar</button>
                    <button type="button" id="btn-eliminar">Eliminar</button>
                </div>
            <table>
                <thead>
                    <tr>
                        <th class="checkbox-eliminar"></th>
                        <th>Profesor que imparte el curso</th>
                        <th>Nombre del curso</th>
                        <th>Código del curso</th>
                        <th>Descripción</th>
                        <th>Créditos</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   $stmt = $pdo->query("SELECT * FROM cursos ORDER BY id ASC");
                    while ($curso = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='fila-curso'>";
                        echo "<td class='checkbox-eliminar'><input type='checkbox' name='eliminar_ids[]' value='" .$curso['id']."'></td>";
                        echo "<td data-columna='profesor_imparte_curso'>" .htmlspecialchars($curso['profesor_imparte_curso']) . "</td>";
                        echo "<td data-columna='nombre_curso'>" .htmlspecialchars($curso['nombre_curso']) . "</td>";
                        echo "<td data-columna='codigo_curso'>" .htmlspecialchars($curso['codigo_curso']) . "</td>";
                        echo "<td data-columna='descripcion_curso'>" .htmlspecialchars($curso['descripcion']) . "</td>";
                        echo "<td data-columna='creditos_curso'>" .htmlspecialchars($curso['creditos']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                    <tr id="fila-agregar" class="fila-agregar">
                        <td><input type="text" name="nuevo_profesor" placeholder="Profesor que imparte el curso"></td>
                        <td><input type="text" name="nuevo_nombre_curso" placeholder="Nombre del curso"></td>
                        <td><input type="text" name="nuevo_codigo_curso" placeholder="Código del curso"></td>
                        <td><input type="text" name="nuevo_descripcion" placeholder="Descripción"></td>
                        <td><input type="number" name="nuevos_creditos_curso" placeholder="Créditos del curso"></td>
                </tbody>
            </table>
            <div id="controles-confirmacion" class="controles-confirmacion">
                <button type="submit" id="btn-confirmar-eliminacion" name="confirmar_eliminacion" style="display: none;">Confirmar Eliminación</button>
                <button type="submit" id="btn-guardar-nuevo" name="confirmar_agregado" style="display: none;">Guardar curso</button>
                <button type="button" id="btn-cancelar">Cancelar</button>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Módulo de Profesores</p>
        <p>Contacto: <a href="mailto:acastro@uc.ac.com">acastro@uc.ac.com</a></p>
    </footer>

    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            inicializarPaginaCRUD({
                formId: 'form-cursos',
                nombreEntidad: 'curso'
            });
    });
    </script>
</body>
</html>