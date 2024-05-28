/**
 * Obtener Listado de Parentescos Familiares
 */
const obtenerParentescos = async ( ) => {
    const URL = `../api/parentesco/get_all`;
    const request = await fetch(URL, requestOptionsGet());
    return (await validateResponse(request));
}