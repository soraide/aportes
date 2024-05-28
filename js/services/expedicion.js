/**
 * Obtener Listado de Horarios Creados
 */
const obtenerExpedidos = async ( ) => {
    const URL = `../api/expedicion/get_all`;
    const request = await fetch(URL, requestOptionsGet());
    return (await validateResponse(request));
}