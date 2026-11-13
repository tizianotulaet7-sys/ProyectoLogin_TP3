# Proyecto Login

- **Alumno:** Tiziano Tula
- **Materia:** Análisis de Sistemas
- **Año de cursada:** 2026

Sistema de login con alta de usuarios, desarrollado de forma independiente para el TP3.

## Tecnologías

| Capa | Tecnología |
|------|------------|
| Front-end | HTML5, CSS3 (responsive, sin frameworks), JavaScript |
| Back-end | PHP 8 (PDO + sesiones) |
| Base de datos | MySQL, puerto 3306 |
| Servidor | XAMPP – Apache en puertos 80 / 443, localhost (127.0.0.1) |

## Funcionalidades

- **Login** (`index.php`): formulario con usuario (correo) y contraseña, ambos con `required`. JavaScript verifica que no estén vacíos y que el correo sea válido. Envía por `POST` a `php/login.php`, que verifica los datos con una consulta `SELECT` y abre la sesión.
- **Alta de usuario** (`registro.php`): nombre, apellido, correo, contraseña y confirmación. JavaScript verifica campos vacíos y que las contraseñas coincidan. `php/registrar.php` guarda el registro con un `INSERT`.
- **Escritorio** (`dashboard.php`): página protegida por sesión con mensaje de bienvenida y botón para cerrar sesión (`logout.php`).
- **Seguridad**: contraseñas guardadas con `password_hash()`, consultas preparadas (evitan inyección SQL), salida escapada con `htmlspecialchars()` y validación también del lado del servidor.

## Estructura

```
ProyectoLogin_TP3/
├── index.php              # Interfaz de login
├── registro.php           # Interfaz de alta de usuario
├── dashboard.php          # Escritorio del usuario logueado
├── logout.php             # Cierre de sesión
├── config/conexion.php    # Conexión PDO a MySQL
├── php/login.php          # Verificación del login (SELECT)
├── php/registrar.php      # Alta de usuario (INSERT)
├── css/estilos.css        # Estilos responsive
├── js/validaciones.js     # Validaciones del lado del cliente
└── database/proyecto_login.sql  # Script de la base de datos
```

## Instalación

1. Copiar la carpeta `ProyectoLogin_TP3` dentro de `C:\xampp\htdocs\`.
2. Abrir el panel de XAMPP e iniciar **Apache** y **MySQL**.
3. Entrar a `http://localhost/phpmyadmin`, ir a **Importar** y cargar `database/proyecto_login.sql` (crea la base `proyecto_login` y la tabla `usuarios`).
4. Si tu MySQL tiene contraseña para `root`, editarla en `config/conexion.php`.
5. Abrir `http://localhost/ProyectoLogin_TP3/` en el navegador.
6. Crear un usuario desde **Crear un usuario nuevo** e iniciar sesión.
