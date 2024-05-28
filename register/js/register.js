let filesPdf = new FormData();
let cantBeneficiarios = 0;
$(document).ready(() => {

  $("#password").focus(()=>{
    verificaPass();
  });
  $("#password").keyup(()=>{
    verificaPass();
  })

  $('form :input[required], form select[required]').on('input change', function() {
    var form = $(this).closest('form');
    var isFormValid = true;

    // Verificar si todos los campos requeridos están completados
    form.find(':input[required], form select[required]').each(function() {
      if ($(this).val() === '') {
        isFormValid = false;
        return false; // Salir del bucle cuando se encuentra un campo vacío
      }
    });
  });
})

$("#flexCheckChecked").on('change', () => {
  if($("#flexCheckChecked").is(":checked")){
    $("#checkPoliticas").hide();
  }else{
    $("#checkPoliticas").show();
    $("#checkPoliticas").text("Debe aceptar las políticas");
  }
})


const verificaPass = () => {
  const passwordField = document.getElementById('password');
  var password = passwordField.value;
  var passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;
  passwordField.setCustomValidity(!passwordRegex.test(password) ? 'La contraseña debe tener 8 caracteres alfanuméricos' : '');
}

/*const form = document.getElementById('form_register');
const submitButton = document.querySelector('button[type="submit"]');
submitButton.addEventListener('click', (event) => {
  //event.preventDefault();
  if (form.checkValidity() === false) {
    const invalidFields = form.querySelectorAll(':invalid');
    const element = invalidFields[0];
    Swal.fire({
      title: element.name,
      position: "bottom-end",
      text: element.validationMessage,
      showConfirmButton: false,
      timer: 3000
    });
  }
});*/

$("#form_register").on('submit', (e)=>{
  e.preventDefault();
  
  var formData = new FormData();
  var formFields = $(e.target).serializeArray();

  // Agregar los archivos seleccionados al FormData
  $('.filePdf').each(function() {
    var input = this;
    var fileName = $(input).data('filename');
    var file = input.files[0];
    if (file) {
      formData.append(fileName, file);
    }
  });

  // // Obtener los otros campos del formulario y agregarlos al FormData
  // var formFields = $(e.target).serializeArray();
  let benNombres = [];
  let benPaterno = [];
  let benMaterno = [];
  let benParent = [];
  let benCi = [];
  $.each(formFields, function(i, field) {
    if(field.name == "paternoBen[]"){
      benPaterno.push(field.value);
    }else if(field.name == "maternoBen[]") {
      benMaterno.push(field.value);
    }else if(field.name == "nombresBen[]"){
      benNombres.push(field.value);
    }else if(field.name == "parentesco[]"){
      benParent.push(field.value);
    }else if(field.name == "ciBen[]"){
      benCi.push(field.value);
    }else{
      formData.append(field.name, field.value);
    }
  });
  formData.append("benNombres", benNombres);
  formData.append("benPaterno", benPaterno);
  formData.append("benMaterno", benMaterno);
  formData.append("benParent", benParent);
  formData.append("benCi", benCi);

  // // Enviar el FormData al servidor jquery
  $.ajax({
    url: '../api/socio/create',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    dataType: 'json',
    success: function(response) {
      if(response.status == 'success'){
        Swal.fire({
          icon: 'success',
          title: 'Registro exitoso',
          text: 'Ingrese con su correo y contraseña',
          showConfirmButton: true,
          timer: 3000
        })
        setTimeout(() => {
           window.location.href = '../auth';
         }, 3010)
      }
      else{
        Swal.fire({
          icon: 'error',
          title: 'Ocurrió un error en el registro',
          text: 'Intente nuevamente más tarde',
          showConfirmButton: true,
          timer: 1900
        })
      }
    },
    error: function(response) {
      Swal.fire({
        icon: 'error',
        title: 'Ocurrió un error en el registro',
        text: 'Intente nuevamente más tarde',
        showConfirmButton: true,
        timer: 1900
      }) 
    }
  })

  for (var pair of formData.entries()) {
    console.log(pair[0] + ': ' + pair[1]);
  }
})

$(".filePdf").on('change', (e) => {
  $(e.target).addClass('is-valid');
})

function nuevoBeneficiario(){
  cantBeneficiarios++;
  $.ajax({
    url: 'components/view_beneficiario.php',
    type: 'POST',
    data: { 'id': cantBeneficiarios },
    dataType: 'TEXT',
    success: function(response) {
      const content = textToHtml(response);
      const container = document.getElementById('beneficiarios');
      container.appendChild(content);
      loadSelect(`expedido-id-beneficiario-${cantBeneficiarios}`, expedidos, ['idExpedicion', 'acronimo']);
      loadSelect(`parentesco-id-beneficiario-${cantBeneficiarios}`, parentescos, ['idParentesco', 'parentesco']);
      var height = document.body.scrollHeight;
      window.scrollTo(0, height);
    },
    error: function(response) {
      console.log(response);
    }
  })
}

function removerBeneficiario(){
  const beneficiario = document.getElementById('bnf-'+cantBeneficiarios);
  document.getElementById('beneficiarios').removeChild(beneficiario);
  cantBeneficiarios--;
  
  var height = document.body.scrollHeight;
  window.scrollTo(0, height);
}

document.getElementById('btn-obscure-password').onclick = ( ) => {
  const pass = document.getElementById('password');
  const isObscure = pass.dataset.obscure == '1';
  pass.dataset.obscure = isObscure ? '0' : '1';
  pass.type = isObscure ? 'text' : 'password';
}

const validarDatosRegistro = () => {

  const forms = [
    document.getElementById('form-datos-personales'),
    document.getElementById('form-datos-ubicacion'),
    document.getElementById('form-datos-militares'),
    document.getElementById('form-datos-beneficiarios')
  ];

  for(i = 0 ; i < forms.length ; i++){
    if(!isFormValidity(forms[i])){
      Swal.fire({
        icon: 'error',
        title: 'Registrar Socio',
        text: `Complete los campos marcados en la ${forms[i].dataset.name}`,
        showConfirmButton: true,
        timer: 1900
      })
      return;
    }
  }

  servicioRegistrarSocio(forms);

};

const servicioRegistrarSocio = async (forms) => {
  const btnRegistrar = document.getElementById('btn-submit');
  const ACCION = 'REGISTRAR SOCIO';
  btnRegistrar.disabled = true;
  const request = await registrarSocio(forms);
  if(request.success){
      setTimeout(() => {
          location.href = '../auth';
      }, 2000);
  }
  btnRegistrar.disabled = request.success;
  Swal.fire({
    icon: request.success ? 'success' : 'error',
    title: 'Registrar Socio',
    text: `${request.message}`,
    timer: 1900
  });
  console.log(ACCION, request.message);
};