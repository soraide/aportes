/**
 * Registrar un nuevo socio
 */
const registrarSocio = async (form) => {
    const URL = `../api/socio/create`;
    const params = convertFormToURLSearchParams(form);
    const request = await fetch(URL, requestOptionsPost(params));
    return (await validateResponse(request));
};
/**
 * Obtener Vista Datos del Socio
 */
const obtenerCardDatosSocio = async ( ) => {
    const URL = `../api/socio/cardDatosSocio`;
    const request = await fetch(URL, requestOptionsGet());
    return (await request.text());
};