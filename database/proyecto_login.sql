-- =====================================================
-- Proyecto Login - Base de datos
-- Motor: MySQL (XAMPP) - Puerto 3306
-- Importar desde phpMyAdmin o con:
--   mysql -u root -p < proyecto_login.sql
-- =====================================================

CREATE DATABASE IF NOT EXISTS proyecto_login
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE proyecto_login;

CREATE TABLE IF NOT EXISTS usuarios (
  id          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  nombre      VARCHAR(50)   NOT NULL,
  apellido    VARCHAR(50)   NOT NULL,
  correo      VARCHAR(100)  NOT NULL,
  password    VARCHAR(255)  NOT NULL,   -- se guarda el hash (password_hash), nunca el texto plano
  fecha_alta  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uk_usuarios_correo (correo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
