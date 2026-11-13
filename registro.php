<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}

$mensaje = $_SESSION['mensaje'] ?? null;
$tipo    = $_SESSION['tipo_mensaje'] ?? 'error';
$previo  = $_SESSION['datos_previos'] ?? [];
unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje'], $_SESSION['datos_previos']);

$valor = fn(string $campo): string => htmlspecialchars($previo[$campo] ?? '');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuario | Proyecto Login</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <main class="contenedor">
        <section class="tarjeta">
            <header class="tarjeta__encabezado">
                <h1>Crear usuario nuevo</h1>
                <p>Completá todos los campos para registrarte</p>
            </header>

            <?php if ($mensaje): ?>
                <div class="alerta alerta--<?= htmlspecialchars($tipo) ?>">
                    <?= htmlspecialchars($mensaje) ?>
                </div>
            <?php endif; ?>

            <form id="formRegistro" class="formulario" action="php/registrar.php" method="POST">
                <div class="fila">
                    <div class="campo">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" maxlength="50"
                               placeholder="Tu nombre" value="<?= $valor('nombre') ?>"
                               autocomplete="given-name" required>
                        <small class="error-msg"></small>
                    </div>

                    <div class="campo">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" maxlength="50"
                               placeholder="Tu apellido" value="<?= $valor('apellido') ?>"
                               autocomplete="family-name" required>
                        <small class="error-msg"></small>
                    </div>
                </div>

                <div class="campo">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" maxlength="100"
                           placeholder="ejemplo@gmail.com" value="<?= $valor('correo') ?>"
                           autocomplete="email" required>
                    <small class="error-msg"></small>
                </div>

                <div class="campo">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" minlength="6"
                           placeholder="Mínimo 6 caracteres"
                           autocomplete="new-password" required>
                    <small class="error-msg"></small>
                </div>

                <div class="campo">
                    <label for="confirmar_password">Confirmar contraseña</label>
                    <input type="password" id="confirmar_password" name="confirmar_password" minlength="6"
                           placeholder="Repetí la contraseña"
                           autocomplete="new-password" required>
                    <small class="error-msg"></small>
                </div>

                <button type="submit" class="boton">Crear nuevo usuario</button>
            </form>

            <p class="tarjeta__pie">
                ¿Ya tenés usuario? <a href="index.php">Volver al login</a>
            </p>
        </section>
    </main>

    <script src="js/validaciones.js"></script>
</body>
</html>
