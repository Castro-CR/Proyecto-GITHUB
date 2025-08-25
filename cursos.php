<?php 
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php'; ?>
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
            <li><a href="cerrar_sesion.php">Salir</a></li>
        </ul>
    </nav>
    <main>
        <section> <!--Botones parte superior-->
            <form id="form-cursos" method="POST" action="procesar_cursos.php">
                <div class="botones">
                    <div><button type="button" id="btn-agregar" class="boton-agregar">Agregar</button>
                    <button type="button" id="btn-editar" class="boton-editar">Editar</button>
                    <button type="button" id="btn-eliminar" class="boton-eliminar">Eliminar</button>
                </div>
                <!--Filtro de búsqueda-->
                <input type="text" id="filtro-busqueda" class="filtro-busqueda" placeholder="Buscar por nombre, profesor, etc.">
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
                <?php //Consulta de SQL
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
                    </tr>
                    
                    <tr id="fila-editar" class="fila-editar" style="display: none;"> 
                            <td class="checkbox-eliminar"></td>
                            <input type="hidden" name="editar_id" id="editar_id">
                            <td><input type="text" name="editar_profesor_imparte_curso" id="editar_profesor_imparte_curso" placeholder="Profesor que imparte el curso"></td>
                            <td><input type="text" name="editar_nombre_curso" id="editar_nombre_curso" placeholder="Nombre del curso"></td>
                            <td><input type="text" name="editar_codigo_curso" id="editar_codigo_curso" placeholder="Código del curso"></td>
                            <td><input type="text" name="editar_descripcion_curso" id="editar_descripcion_curso" placeholder="Descripción"></td>
                            <td><input type="number" name="editar_creditos_curso" id="editar_creditos_curso" placeholder="Créditos del curso"></td>
                    </tr>
                </tbody>
            </table> <!-- Botones de confirmación y cancelar-->
            <div id="controles-confirmacion" class="controles-confirmacion">
                <button type="submit" id="btn-confirmar-eliminacion" name="confirmar_eliminacion" class="boton-confirmar-eliminar" style="display: none;">Confirmar Eliminación</button>
                <button type="submit" id="btn-guardar-nuevo" name="confirmar_agregado" class="boton-agregar-nuevo" style="display: none;">Guardar curso</button>
                <button type="submit" id="btn-confirmar-edicion" name="confirmar_edicion" class="boton-confirmar-editar" style="display: none;">Confirmar Edición</button>
                <button type="button" id="btn-cancelar" class="boton-cancelar">Cancelar</button>
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
                nombreEntidad: 'curso',
                selectorFila: '#form-cursos .fila-curso'
            });
    });
    </script>
</body>
</html>