let filesPdf = new FormData();
let cantBeneficiarios = 1;
$(document).ready(() => {
  $("#btn-submit").prop('disabled',true);


  $("#pass").focus(()=>{
    verificaPass();
  });
  $("#pass").keyup(()=>{
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

    // Habilitar o deshabilitar el botón de envío según la validación
    if (isFormValid) {
      $('#btn-submit').prop('disabled', false);
    } else {
      $('#btn-submit').prop('disabled', true);
    }
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
  var password = $("#pass").val();
  var passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;
  if (!passwordRegex.test(password)) {
    $("#btn-submit").prop('disabled',true);
    $("#verifyPass").show();
  }else{
    $("#verifyPass").hide();
    $("#btn-submit").prop('disabled',false);
  }
}

$("#form_register").on('submit', (e)=>{
  e.preventDefault();
  if(!tieneExtencion()){
    return;
  }
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


function tieneExtencion(){
  var value = $("#extension_ci").val();
  if(value != ""){
    $("#btn-submit").prop('disabled',false);
  }else{
    $("#checkPoliticas").html('| Seleccione la extensión de su carnet')
    $("#btn-submit").prop('disabled',true);
    return false;
  }
  return true;
}

function nuevoBeneficiario(){
  cantBeneficiarios++;
  const html = `
      <div class="col-md-12 mt-3" id="bnf-${cantBeneficiarios}">
        <h5><i class="fas fa-circle-user"></i> Beneficiario ${cantBeneficiarios}</h5>
        <div class="row">
          <div class="col-md-12 mt-3">
            <div class="form-outline">
              <input type="text" class="form-control" name="nombresBen[]" required />
              <label class="form-label">Nombres</label>
              <div class="form-notch">
                <div class="form-notch-leading" style="width: 9px;"></div>
                <div class="form-notch-middle" style="width: 60.8px;"></div>
                <div class="form-notch-trailing"></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-3">
            <div class="form-outline">
              <input type="text" class="form-control" name="paternoBen[]" required>
              <label class="form-label">Ap. Paterno</label>
              <div class="form-notch">
                <div class="form-notch-leading" style="width: 9px;"></div>
                <div class="form-notch-middle" style="width: 60.8px;"></div>
                <div class="form-notch-trailing"></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-3">
            <div class="form-outline">
              <input type="text" class="form-control" name="maternoBen[]" required>
              <label class="form-label">Ap. Materno</label>
              <div class="form-notch">
                <div class="form-notch-leading" style="width: 9px;"></div>
                <div class="form-notch-middle" style="width: 60.8px;"></div>
                <div class="form-notch-trailing"></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-3">
            <div class="form-outline">
              <input type="text" class="form-control" name="parentesco[]" required>
              <label class="form-label">Parentezco</label>
              <div class="form-notch">
                <div class="form-notch-leading" style="width: 9px;"></div>
                <div class="form-notch-middle" style="width: 60.8px;"></div>
                <div class="form-notch-trailing"></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-3">
            <div class="form-outline">
              <input type="text" class="form-control" name="ciBen[]" required>
              <label class="form-label">Cédula de Identidad</label>
              <div class="form-notch">
                <div class="form-notch-leading" style="width: 9px;"></div>
                <div class="form-notch-middle" style="width: 60.8px;"></div>
                <div class="form-notch-trailing"></div>
              </div>
            </div>
          </div>
        </div>
      </div>`;
  $("#beneficiarios").append(html);
  var height = document.body.scrollHeight;
  window.scrollTo(0, height);
}

function removerBeneficiario(){
  const beneficiario = document.getElementById('bnf-'+cantBeneficiarios);
  document.getElementById('beneficiarios').removeChild(beneficiario);
  cantBeneficiarios--;
  
  var height = document.body.scrollHeight;
  window.scrollTo(0, height);
}