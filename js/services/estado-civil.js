/**
 * Obtener Listado de Estados Civiles
 */
const obtenerEstadosCivil = async ( ) => {
    const URL = `../api/estadocivil/get_all`;
    const request = await fetch(URL, requestOptionsGet());
    return (await validateResponse(request));
};