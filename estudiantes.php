<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .fila-agregar, .checkbox-eliminar, .controles-confirmacion { display: none; }
    </style>
</head>
<body class="pagina-estudiantes">
    <header>
        <h1>Módulo de Estudiantes</h1>
    </header>


    <nav class="menu">
        <ul>
            <li><a href="Profesores.php">Profesores</a></li>
            <li><a href="Cursos.php">Cursos</a></li>
            <li><a href="cerrar_sesion.php">Salir</a></li>
        </ul>
    </nav>

    <main>
        <section style="width: auto;"> <!--Botones parte superior-->
            <form id="form-estudiantes" method="POST" action="procesar.php">
                <div class="botones">
                  <div><button type="button" id="btn-agregar" class="boton-agregar">Agregar</button>
                    <button type="button" id="btn-editar" class="boton-editar">Editar</button>
                    <button type="button" id="btn-eliminar" class="boton-eliminar">Eliminar</button>
                </div> <!--Filtro de búsqueda-->
                <input type="text" id="filtro-busqueda" class="filtro-busqueda" placeholder="Buscar por nombre, correo, etc.">
                </div>
                <table>
                    <thead>
                    <tr>
                        <th class="checkbox-eliminar"></th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo Electrónico</th>
                        <th>Materia que cursa</th>
                        <th>Fecha de Nacimiento</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php //Consulta de SQL
                    $stmt = $pdo->query("SELECT * FROM alumnos ORDER BY id ASC");
                    while ($alumno = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='fila-alumno'>";
                        echo "<td class='checkbox-eliminar'><input type='checkbox' name='eliminar_ids[]' value='" . $alumno['id'] . "'></td>";
                        echo "<td data-columna='nombre'>" . htmlspecialchars($alumno['nombre']) . "</td>";
                        echo "<td data-columna='apellidos'>" . htmlspecialchars($alumno['apellidos']) . "</td>";
                        echo "<td data-columna='correo'>" . htmlspecialchars($alumno['correo']) . "</td>";
                        echo "<td data-columna='materia_cursa'>" . htmlspecialchars($alumno['intereses']) . "</td>";
                        echo "<td data-columna='fecha_nacimiento'>" . htmlspecialchars($alumno['fecha_de_nacimiento']) . "</td>";
                        echo "</tr>";
                    }
                    ?> 
                    <tr id="fila-agregar" class="fila-agregar">
                        <td class="checkbox-eliminar"></td>
                        <td><input type="text" name="nuevo_nombre" placeholder="Nombre del estudiante"></td>
                        <td><input type="text" name="nuevo_apellidos" placeholder="Apellidos del estudiante"></td>
                        <td><input type="email" name="nuevo_correo" placeholder="Correo electrónico"></td>
                        <td><input type="text" name="nuevo_intereses" placeholder="Materia que cursa"></td>
                        <td><input type="date" name="nuevo_fecha_nacimiento" placeholder="Fecha de nacimiento"></td>
                    </tr>

                    <tr id="fila-editar" class="fila-editar" style="display: none;">
                        <td class="checkbox-eliminar"></td>
                        <input type="hidden" name="editar_id" id="editar_id">
                        <td><input type="text" name="editar_nombre" id="editar_nombre" placeholder="Nombre del estudiante"></td>
                        <td><input type="text" name="editar_apellidos" id="editar_apellidos" placeholder="Apellidos del estudiante"></td>
                        <td><input type="email" name="editar_correo" id="editar_correo" placeholder="Correo electrónico"></td>
                        <td><input type="text" name="editar_intereses" id="editar_intereses" placeholder="Materia que cursa"></td>
                        <td><input type="date" name="editar_fecha_de_nacimiento" id="editar_fecha_de_nacimiento" placeholder="Fecha de nacimiento"></td>
                    </tr>
                    </tbody>
                </table>

                <div id="controles-confirmacion" class="controles-confirmacion">
                <button type="submit" id="btn-confirmar-eliminacion" name="confirmar_eliminacion" class="boton-confirmar-eliminar" style="display: none;">Confirmar Eliminación</button>
                <button type="submit" id="btn-confirmar-edicion" name="confirmar_edicion" class="boton-confirmar-editar" style="display: none;">Confirmar Edición</button>
                <button type="submit" id="btn-guardar-nuevo" name="confirmar_agregado" class="boton-agregar-nuevo" style="display: none;">Guardar estudiante</button>
                <button type="button" id="btn-cancelar" class="boton-cancelar">Cancelar</button>
            </div>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Módulo de Estudiantes</p>
        <p>Contacto: <a href="mailto:anthony@uc.ac.com">anthony@uc.ac.com</a></p>
    </footer>
    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            inicializarPaginaCRUD({
                formId: 'form-estudiantes',
                nombreEntidad: 'alumno',
                selectorFila: '#form-estudiantes .fila-alumno'
            });
        });
    </script>
</body>
</html>