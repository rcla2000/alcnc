const btnAgregar = document.querySelector('#btn-agregar');
const btnReducir = document.querySelector('#btn-reducir');
const btnEliminarImpuesto = document.querySelector('#btn-eliminar-impuesto');
const filas = document.querySelectorAll('#fila-informacion td');

// Material Select Initialization
$('[data-toggle="tooltip"]').tooltip();

const eliminarSignoDolar = (valor) => {
    return valor.replace('$', '');
}

const calcularTotal = () => {
    const cantidad = parseInt(filas[2].textContent);
    const precio = parseFloat(eliminarSignoDolar(filas[1].textContent));
    const impuesto = parseFloat(eliminarSignoDolar(filas[3].textContent));
    const total = (precio + impuesto) * cantidad;
    filas[4].textContent = `$${total.toFixed(2)}`;
}

// Actualizando la cantidad de la solicitud
const aumentarCantidad = () => {
    let cantidadActual = parseInt(filas[2].textContent);
    filas[2].textContent = cantidadActual + 1;
    calcularTotal();
}

const reducirCantidad = () => {
    let cantidadActual = parseInt(filas[2].textContent);
    if (cantidadActual > 1) {
        filas[2].textContent = cantidadActual - 1;
        calcularTotal();
    }
}

btnAgregar.addEventListener('click', aumentarCantidad);
btnReducir.addEventListener('click', reducirCantidad);





