<?php
session_start();

// Si ya hay una sesión iniciada, se envía directo al escritorio
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}

$mensaje = $_SESSION['mensaje'] ?? null;
$tipo    = $_SESSION['tipo_mensaje'] ?? 'error';
$correo  = $_SESSION['correo_previo'] ?? '';
unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje'], $_SESSION['correo_previo']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Proyecto Login</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <main class="contenedor">
        <section class="tarjeta">
            <header class="tarjeta__encabezado">
                <h1>Iniciar sesión</h1>
                <p>Ingresá con tu usuario y contraseña</p>
            </header>

            <?php if ($mensaje): ?>
                <div class="alerta alerta--<?= htmlspecialchars($tipo) ?>">
                    <?= htmlspecialchars($mensaje) ?>
                </div>
            <?php endif; ?>

            <form id="formLogin" class="formulario" action="php/login.php" method="POST">
                <div class="campo">
                    <label for="usuario">Usuario (correo electrónico)</label>
                    <input type="email" id="usuario" name="usuario"
                           placeholder="ejemplo@gmail.com"
                           value="<?= htmlspecialchars($correo) ?>"
                           autocomplete="username" required>
                    <small class="error-msg"></small>
                </div>

                <div class="campo">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password"
                           placeholder="Tu contraseña"
                           autocomplete="current-password" required>
                    <small class="error-msg"></small>
                </div>

                <button type="submit" class="boton">Ingresar</button>
            </form>

            <p class="tarjeta__pie">
                ¿No tenés usuario? <a href="registro.php">Crear un usuario nuevo</a>
            </p>
        </section>
    </main>

    <script src="js/validaciones.js"></script>
</body>
</html>
