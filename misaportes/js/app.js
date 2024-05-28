const cargarAportesSocio = async ( ) => {
    const requestSocio = await obtenerCardAportesSocio();
    document.getElementById('aportes-socio').innerHTML = requestSocio;
}

cargarAportesSocio();