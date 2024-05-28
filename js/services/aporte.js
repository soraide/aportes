/**
 * Obtener Vista Aportes del Socio
 */
const obtenerCardAportesSocio = async ( ) => {
    const URL = `../api/aporte/cardAportesSocio`;
    const request = await fetch(URL, requestOptionsGet());
    return (await request.text());
};