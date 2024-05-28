/**
 * Obtener Listado de Grados Militares
 */
const obtenerGrados = async ( ) => {
    const URL = `../api/grado/get_all`;
    const request = await fetch(URL, requestOptionsGet());
    return (await validateResponse(request));
}