<?php
/**
 * Conexión a la base de datos MySQL mediante PDO.
 * Configuración por defecto de XAMPP: usuario root sin contraseña, puerto 3306.
 */

declare(strict_types=1);

const DB_HOST = '127.0.0.1';
const DB_PORT = '3306';
const DB_NAME = 'proyecto_login';
const DB_USER = 'root';
const DB_PASS = '';

function conectar(): PDO
{
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';

    try {
        return new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        exit('Error de conexión con la base de datos. Verificá que MySQL esté iniciado en XAMPP y que exista la base "' . DB_NAME . '".');
    }
}
