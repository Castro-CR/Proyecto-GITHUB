<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="pagina-login">
    <header>
        <h1> Registro en Plataforma educativa Universidad Central</h1>
    </header>

    <!--Menu-->
   <nav class="menu">
    <ul>
        <li><a href="index.html">Iniciar sesión</a></li>
    </ul>
</nav>


    <main>
        <section>
        <form action="procesar.php" method="POST">
        <fieldset>
        <legend>Registro de Usuario</legend>

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input class="form-input" type="text" id="name" name="name" required>
        </div>

        <label for="apellidos">Apellidos:</label>
        <input class="form-input" type="text" id="apellidos" name="apellidos" required>

        <label for="date">Fecha de Nacimiento:</label>
        <input class="form-input" type="date" id="date" name="date" required>

        <label for="email">Correo Electrónico:</label>
        <input class="form-input" type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input class="form-input" type="password" id="password" name="password" required>
        </fieldset>

        <fieldset>
        <legend>Genero</legend>
        <div>
            <div> <input type="radio" value="Masculino" name="genero" id="g-m">
            <label for="g-m">Masculino</label>
            </div>
            <div> <input type="radio" value="Femenino" name="genero" id="g-f">
            <label for="g-f">Femenino</label>
            </div>
            <div> <input type="radio" value="Otro" name="genero" id="g-o">
            <label for="g-o">Otro</label>
            </div>
            <div> <input type="radio" value="N/A" name="genero" id="g-n">
            <label for="g-n">Prefiero no decirlo</label>
            </div>
        </div>
        </fieldset>

        <fieldset>
        <legend>Seleccione sus intereses</legend>
        <div>
            <div> <input type="checkbox" name="intereses[]" id="interes1" value="Programación">
            <label for="interes1">Programación</label>
            </div>
            <div> <input type="checkbox" name="intereses[]" id="interes2" value="Diseño Gráfico">
            <label for="interes2">Diseño Gráfico</label>
            </div>
            <div> <input type="checkbox" name="intereses[]" id="interes3" value="Marketing Digital">
            <label for="interes3">Marketing Digital</label>
            </div>
        </div>
        </fieldset>
        <button class="submit-button" type="submit">Registrar</button>
        </form>
        </section>

        <section>
                    <table class="tabla-registro">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo Electrónico</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Género</th>
                    <th>Intereses</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM alumnos ORDER BY fecha_registro DESC");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>".htmlspecialchars($row['nombre'])."</td>
                            <td>".htmlspecialchars($row['apellidos'])."</td>
                            <td>".htmlspecialchars($row['correo'])."</td>
                            <td>{$row['fecha_de_nacimiento']}</td>
                            <td>".htmlspecialchars($row['genero'])."</td>
                            <td>{$row['intereses']}</td>
                            <td>{$row['fecha_registro']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
        </section>

        <section id="video-section">
     <iframe width="560" height="315" 
        src="https://www.youtube.com/embed/Si1ur_uq_N0" 
        title="Video Incrustado" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
        </iframe>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Módulo de Registro</p>
        <p>Contacto: <a href="mailto:acastro@uc.ac.com">acastro@uc.ac.com</a></p>
    </footer>
</body>
</html>