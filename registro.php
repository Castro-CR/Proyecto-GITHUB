<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="pagina-login">
    <header>
        <h1> Registro en Plataforma educativa Universidad Central</h1>
    </header>

    <!--Menu-->
<nav class="menu">
    <ul>
        <li><a href="index.php">Iniciar sesión</a></li>
    </ul>
</nav>


    <main>
        <section>
        <form action="procesar.php" method="POST">
        <fieldset>
        <legend>Registro de Estudiantes</legend>

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
            <div> <input type="checkbox" id="interes_otro">
            <label for="interes_otro">Otro</label>
            <input type="text" name="otro_interes" id="otro_interes_texto" placeholder="Especifique" style="display: none; margin-left: 10px;">
            </div>
        </div>
        </fieldset>
        <button class="submit-button" type="submit">Registrar</button>
        </form>
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

    <script src="script.js" defer></script>
    <script src="script.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('status') === 'success') {
                Swal.fire({
                    title: "¡Registro Exitoso!",
                    text: "Ya puedes iniciar sesión con tus credenciales.",
                    icon: "success",
                    confirmButtonColor: '#007bff'
                }).then(() => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                });
            }
        });
    </script>
</body>
</html>
</body>
</html>