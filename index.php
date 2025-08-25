<?php session_start(); // Inicia la sesión para recordar si el usuario ya está logueado ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="pagina-iniciosesion">
    <header>
        <h1>Bienvenido a Connect Campus</h1>
    </header>

    <nav class="menu">
        <ul>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <li><a href="Estudiantes.php">Estudiantes</a></li>
                <li><a href="Cursos.php">Cursos</a></li>
                <li><a href="Profesores.php">Profesores</a></li>
                <li><a href="logout.php">Salir</a></li>
            <?php else: ?>
                <li><a href="registro.php">Registro</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <main>
        <section class="#">
            <form method="POST" action="login.php">
                <div class="form-group col-sm-6">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" class="form-control form-input" id="correo" name="correo" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control form-input" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary submit-button">Iniciar Sesión</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Connect Campus</p>
        <p>Contacto: <a href="mailto:anthony@uc.ac.com">anthony@uc.ac.com</a></p>
    </footer>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            Swal.fire({
                icon: 'error',
                title: 'Error de Autenticación',
                text: 'El correo electrónico o la contraseña son incorrectos.',
                confirmButtonColor: '#007bff'
            });
        }
    </script>
</body>
</html>