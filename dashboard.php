<?php
session_start();

// Solo usuarios logueados pueden ver el escritorio
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['mensaje'] = 'Tenés que iniciar sesión para acceder.';
    $_SESSION['tipo_mensaje'] = 'error';
    header('Location: index.php');
    exit;
}

$nombreCompleto = htmlspecialchars($_SESSION['usuario_nombre'] . ' ' . $_SESSION['usuario_apellido']);
$correo         = htmlspecialchars($_SESSION['usuario_correo']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escritorio | Proyecto Login</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="body-dashboard">
    <nav class="barra">
        <span class="barra__marca">Proyecto Login</span>
        <a href="logout.php" class="boton boton--secundario">Cerrar sesión</a>
    </nav>

    <main class="contenedor">
        <section class="tarjeta tarjeta--ancha">
            <h1>¡Bienvenido/a, <?= $nombreCompleto ?>!</h1>
            <p>Iniciaste sesión correctamente con el correo <strong><?= $correo ?></strong>.</p>
            <p>Este es tu escritorio. Desde acá vas a poder gestionar todo lo que el sistema te permita hacer.</p>
        </section>
    </main>
</body>
</html>
