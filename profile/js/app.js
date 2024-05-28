const cargarDatos = async ( ) => {
    const requestSocio = await obtenerCardDatosSocio();
    document.getElementById('datos-socio').innerHTML = requestSocio;
}

cargarDatos();