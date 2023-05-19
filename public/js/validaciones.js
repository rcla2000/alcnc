const estaVacio = (valor) => {
    if (valor === undefined || valor == null || valor.trim().length == 0) {
        return true;
    }
    return false;
}

const fechaCorrecta = (fecha) => {
    const regex = new RegExp('^[0-9]{2}/[0-9]{2}/[0-9]{4}$');
    return regex.test(fecha);
}

const telefonoSvCorrecto = (telefono) => {
    const regex = new RegExp('^[267][0-9]{3}-[0-9]{4}$');
    return regex.test(telefono);
}

const soloLetras = (e) => {
    const regex = /^[a-zA-Z\u00C0-\u017F\s]+$/;
    const key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (!regex.test(key)) {
        e.preventDefault();
        return false;
    }
}

const soloNumeros = (e) => {
    const code = (e.which) ? e.which : e.keyCode;

    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.
        e.preventDefault();
        return false;
    }
}

const agregarError = (elemento, elementoMensaje, mensaje) => {
    elemento.classList.add("is-invalid");
    elementoMensaje.textContent = mensaje;
};

const limpiarError = (elemento, elementoMensaje) => {
    elemento.classList.remove("is-invalid");
    elementoMensaje.textContent = "";
};