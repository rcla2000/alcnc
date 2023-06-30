const btnFiltrar = document.querySelector('#btn-filtrar');

btnFiltrar.addEventListener('click', () => {
    const tipoSolicitud = document.querySelector('#tipo-solicitud').value;
    window.location.href = `//${window.location.host}/dashboard/${tipoSolicitud}`;
});