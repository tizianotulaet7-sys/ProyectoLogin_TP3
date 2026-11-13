/**
 * Validaciones del lado del cliente
 * - Campos vacíos (incluye los que solo tienen espacios)
 * - Formato de correo
 * - Coincidencia de contraseñas en el alta de usuario
 */

document.addEventListener('DOMContentLoaded', () => {
    const formLogin = document.getElementById('formLogin');
    const formRegistro = document.getElementById('formRegistro');

    if (formLogin) {
        formLogin.addEventListener('submit', (e) => {
            if (!validarLogin(formLogin)) e.preventDefault();
        });
    }

    if (formRegistro) {
        formRegistro.addEventListener('submit', (e) => {
            if (!validarRegistro(formRegistro)) e.preventDefault();
        });

        // Aviso en vivo si las contraseñas no coinciden
        const confirmar = formRegistro.querySelector('#confirmar_password');
        const password = formRegistro.querySelector('#password');
        confirmar.addEventListener('input', () => {
            if (confirmar.value && confirmar.value !== password.value) {
                marcarError(confirmar, 'Las contraseñas no coinciden.');
            } else {
                limpiarError(confirmar);
            }
        });
    }

    // Al escribir en un campo con error, se limpia el mensaje
    document.querySelectorAll('.formulario input').forEach((input) => {
        input.addEventListener('input', () => {
            if (input.id !== 'confirmar_password') limpiarError(input);
        });
    });
});

const EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function validarLogin(form) {
    let valido = validarVacios(form);

    const usuario = form.querySelector('#usuario');
    if (usuario.value.trim() && !EMAIL_REGEX.test(usuario.value.trim())) {
        marcarError(usuario, 'Ingresá un correo válido.');
        valido = false;
    }

    return valido;
}

function validarRegistro(form) {
    let valido = validarVacios(form);

    const correo = form.querySelector('#correo');
    const password = form.querySelector('#password');
    const confirmar = form.querySelector('#confirmar_password');

    if (correo.value.trim() && !EMAIL_REGEX.test(correo.value.trim())) {
        marcarError(correo, 'Ingresá un correo válido.');
        valido = false;
    }

    if (password.value && password.value.length < 6) {
        marcarError(password, 'La contraseña debe tener al menos 6 caracteres.');
        valido = false;
    }

    if (confirmar.value && password.value !== confirmar.value) {
        marcarError(confirmar, 'Las contraseñas no coinciden.');
        valido = false;
    }

    return valido;
}

/** Revisa todos los inputs con atributo required */
function validarVacios(form) {
    let valido = true;
    form.querySelectorAll('input[required]').forEach((input) => {
        if (input.value.trim() === '') {
            marcarError(input, 'Este campo es obligatorio.');
            valido = false;
        } else {
            limpiarError(input);
        }
    });
    return valido;
}

function marcarError(input, mensaje) {
    input.classList.add('input--error');
    const msg = input.parentElement.querySelector('.error-msg');
    if (msg) msg.textContent = mensaje;
}

function limpiarError(input) {
    input.classList.remove('input--error');
    const msg = input.parentElement.querySelector('.error-msg');
    if (msg) msg.textContent = '';
}
