<?php
/**
 * Procesa el alta de un usuario nuevo (POST).
 * Valida los datos y los guarda en MySQL con un INSERT.
 */

declare(strict_types=1);
session_start();
require_once __DIR__ . '/../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../registro.php');
    exit;
}

$nombre    = trim($_POST['nombre'] ?? '');
$apellido  = trim($_POST['apellido'] ?? '');
$correo    = trim($_POST['correo'] ?? '');
$password  = $_POST['password'] ?? '';
$confirmar = $_POST['confirmar_password'] ?? '';

function volverConError(string $mensaje, array $datos): never
{
    $_SESSION['mensaje']       = $mensaje;
    $_SESSION['tipo_mensaje']  = 'error';
    $_SESSION['datos_previos'] = $datos;
    header('Location: ../registro.php');
    exit;
}

$datos = ['nombre' => $nombre, 'apellido' => $apellido, 'correo' => $correo];

// Validaciones del lado del servidor
if ($nombre === '' || $apellido === '' || $correo === '' || $password === '' || $confirmar === '') {
    volverConError('Todos los campos son obligatorios.', $datos);
}
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    volverConError('El correo electrónico no es válido.', $datos);
}
if (mb_strlen($password) < 6) {
    volverConError('La contraseña debe tener al menos 6 caracteres.', $datos);
}
if ($password !== $confirmar) {
    volverConError('Las contraseñas no coinciden.', $datos);
}

$pdo = conectar();

// Verificar que el correo no esté registrado
$stmt = $pdo->prepare('SELECT id FROM usuarios WHERE correo = :correo LIMIT 1');
$stmt->execute([':correo' => $correo]);
if ($stmt->fetch()) {
    volverConError('Ya existe un usuario registrado con ese correo.', $datos);
}

// Alta del usuario (la contraseña se guarda hasheada)
$stmt = $pdo->prepare(
    'INSERT INTO usuarios (nombre, apellido, correo, password)
     VALUES (:nombre, :apellido, :correo, :password)'
);
$stmt->execute([
    ':nombre'   => $nombre,
    ':apellido' => $apellido,
    ':correo'   => $correo,
    ':password' => password_hash($password, PASSWORD_DEFAULT),
]);

$_SESSION['mensaje']       = 'Usuario creado correctamente. Ya podés iniciar sesión.';
$_SESSION['tipo_mensaje']  = 'exito';
$_SESSION['correo_previo'] = $correo;
header('Location: ../index.php');
exit;
