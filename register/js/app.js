// ------------step-wizard-------------
$(document).ready(function () {
    //$('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

        var target = $(e.target);
    
        if (target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
        
        const verify = e.target.dataset.verify;
        if(verify == '1'){
            const idForm = e.target.dataset.idForm;
            const form = document.getElementById(`${idForm}`);
            if(!isFormValidity(form)){ return; }
        }
        const finish = e.target.dataset.finish;
        if(finish == '1'){
            Swal.fire({
                icon: "info",
                title: "Registrar Socio",
                text: "¿Esta seguro(a) que desea registrar los datos ingresados?",
                showCancelButton: true,
                confirmButtonText: "Registrar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    validarDatosRegistro();
                }
            });
            return;
        }
        var active = $('.wizard .nav-tabs li.active');
        active.next().removeClass('disabled');
        nextTab(active);

    });
    $(".prev-step").click(function (e) {

        var active = $('.wizard .nav-tabs li.active');
        prevTab(active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}


$('.nav-tabs').on('click', 'li', function(e) {
    const verify = this.dataset.verify;
    if(verify == '1'){
        const idForm = this.dataset.idForm;
        const form = document.getElementById(`${idForm}`);
        if(!isFormValidity(form)){ return; }
    }
    $('.nav-tabs li.active').removeClass('active');
    $(this).addClass('active');
});

let estadosCivil = [];
let expedidos = [];
let grados = [];
let parentescos = [];

const loadValuesSelect = async ( ) => {
    // Carga de datos de Estado Civil
    const responseEstadoCivil = await obtenerEstadosCivil();
    estadosCivil = responseEstadoCivil.success ? responseEstadoCivil.data.estados : [];
    loadSelect('estado-civil-id', estadosCivil, ['idEstadoCivil', 'detalle']);

    // Carga de Selects de Expedido de CI
    const responseExpedido = await obtenerExpedidos();
    expedidos = responseExpedido.success ? responseExpedido.data.expediciones : [];
    loadSelect('expedido-id', expedidos, ['idExpedicion', 'acronimo']);

    // Carga de grados militares
    const responseGrado = await obtenerGrados();
    grados = responseGrado.success ? responseGrado.data.grados : [];
    loadSelect('grado-id', grados, ['idGrado', 'detalle']);

    // Carga de lista de parentescos
    const responseParentesco = await obtenerParentescos();
    parentescos = responseParentesco.success ? responseParentesco.data.parentesco : [];
    // Cargando un beneficiario
    nuevoBeneficiario();

}

loadValuesSelect();








