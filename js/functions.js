const validateResponse = async (request) => {
    let response = {status: false, message: ''};
    if(request.ok){
        const text = await request.text();
        if(isJSON(text)){
            response = JSON.parse(text);
        }else{
            response.message = 'Problemas en el servidor.';
        }
        return(response);
    }else{
        response.message = 'No se pudo comunicar con el servidor.';
    }
    return response;
};

const loadSelect = (idElement, data, params = []) => {
    const control = {
        id : params.length == 2 ? params[0] : 'id',
        name : params.length == 2 ? params[1] : 'name',
    };
    const select = document.getElementById(idElement);
    data.forEach((item) => {
        const option = createOption(item[control.id], capitalize(item[control.name]));
        select.appendChild(option);
    });
}

const createOption = (id, value) => {
    const option = document.createElement('option');
    option.value = id;
    option.textContent = value;
    return option;
}

const capitalize = (text) => {
    const firstLetter = text.charAt(0).toUpperCase();
    return firstLetter + text.slice(1);
};

const textToHtml = (text) => {
    const parser = new DOMParser();
    const html = parser.parseFromString(text, 'text/html');
    const node = html.body.childNodes[0];
    return node;
};

const isJSON = (data) => {
    try {
        JSON.parse(data);
    } catch (e) {
        return false;
    }
    return true;
}

const convertPDFToBase64 = (element, destination) => {
    let file = element.files[0];
    // read the files
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = (e) => {
        document.getElementById(destination).value = reader.result.toString();
    };
    reader.onerror = (e) => {
        Swal.fire({
            icon: 'error',
            title: 'Carga de Documento',
            text: 'No se pudo cargar el documento.'
        });
        console.log(e);
    };
}