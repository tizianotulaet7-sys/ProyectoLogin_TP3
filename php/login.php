<?php
/**
 * Procesa el formulario de login (POST).
 * Verifica el usuario con una consulta SELECT y abre la sesión.
 */

declare(strict_types=1);
session_start();
require_once __DIR__ . '/../config/conexion.php';

function volverConError(string $mensaje, string $correo = ''): never
{
    $_SESSION['mensaje']       = $mensaje;
    $_SESSION['tipo_mensaje']  = 'error';
    $_SESSION['correo_previo'] = $correo;
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$correo   = trim($_POST['usuario'] ?? '');
$password = $_POST['password'] ?? '';

// Validación del lado del servidor (por si se saltea el JavaScript)
if ($correo === '' || $password === '') {
    volverConError('Completá el usuario y la contraseña.', $correo);
}

$pdo  = conectar();
$stmt = $pdo->prepare('SELECT id, nombre, apellido, correo, password FROM usuarios WHERE correo = :correo LIMIT 1');
$stmt->execute([':correo' => $correo]);
$usuario = $stmt->fetch();

if (!$usuario || !password_verify($password, $usuario['password'])) {
    volverConError('Usuario o contraseña incorrectos.', $correo);
}

// Login correcto: se regenera el id de sesión y se guardan los datos del usuario
session_regenerate_id(true);
$_SESSION['usuario_id']       = (int) $usuario['id'];
$_SESSION['usuario_nombre']   = $usuario['nombre'];
$_SESSION['usuario_apellido'] = $usuario['apellido'];
$_SESSION['usuario_correo']   = $usuario['correo'];

header('Location: ../dashboard.php');
exit;
