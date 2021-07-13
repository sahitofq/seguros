$("#dialog").dialog({
    autoOpen: false,
    show: {
        effect: "blind",
        duration: 1000
    },
    hide: {
        effect: "blind",
        duration: 1000
    }
});

$.extend({
    redirectPost: function(location, args) {
        var form = '';
        $.each(args, function(key, value) {
            form += '<input type="hidden" name="' + key + '" value="' + value + '">';
        });
        $('<form style="display:none !important;" action="' + location + '" method="POST">' + form + '</form>')
            .appendTo($(document.body))
            .submit();
    }
});

var formIngresed = $('#form-home');
var errorContainer = $('#placaErrorMessage');
var expPlaca = /[A-Za-z]{3}[0-9]{3}/;

formIngresed.on('submit', function(e) {
    var namePlacaInput = $('#namePlacaInput').val();
    e.preventDefault();

    if (namePlacaInput === '') {
        return errorContainer.addClass('invalid').find('.error-message').text('Debe ingresar una placa');
    } else if (!expPlaca.test(namePlacaInput)) {
        return errorContainer.addClass('invalid').find('.error-message').text('El formato de la placa es inválida.');
    }

    var enpoint = backendURL + '/api/get-placa-number';
    $.ajax({
        url: enpoint,
        method: 'POST',
        data: {
            placa_request: namePlacaInput
        },
        beforeSend: function() {
            $('#loader').show();
        },
        success: function(res) {
            if (res.error === false) {
                var _res = res.data;
                var redirect = $('#todoRiesgoURL').val();
                $('#loader').hide();
                $.redirectPost(redirect, {
                    _token: $('#tokenTodoRiesgo').val(),
                    mf_code: _res.mf_code,
                    mf_id: _res.mf_id,
                    mf_name: _res.mf_name,
                    placa: _res.placa,
                    model: res.data_external['Data']['Modelo'],
                    brand: res.data_external['Data']['Brand'],
                    brandline: res.data_external['Data']['BrandLine'],
                    classid: res.data_external['Data']['ClassId'],
                    valorasegurado: res.data_external['Data']['ValorAsegurado']

                });
            } else {
                $('#loader').hide();
                $("#dialog").dialog("open");
            }
        },
        error: function(data) {
            $('#loader').hide();
            $("#dialog").dialog("open");
        }
    });
});

/**
 * Validar un email por string.
 * @param {string} email Email a validar
 * @return boolean
 */
function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

/**
 * Funcionalidad para enviar el formulario de todo riesgo (Propietario y datos de Vehiculo)
 */


$("#propietary_doctype").change(function() {
    if ($(this).val() == "N") {
        $('#propietary_gender').hide();
        $('#propietary_birth').hide();
    } else {
        $('#propietary_gender').show();
        $('#propietary_birth').show();
    }
});

var errorLeft = $('#errorMessagePropietario');
var errorRight = $('#errorMessageVehicle');

function showError(text, left = true) {
    errorLeft.removeClass('show');
    errorRight.removeClass('show');
    if (left) {
        errorLeft.addClass('show').text(text);
    } else {
        errorRight.addClass('show').text(text);
    }
    return false;
}

var todoRiesgoForm = $('#contact-form');
todoRiesgoForm.on('submit', function(e) {
    e.preventDefault();

    var propietary_name = $('#propietary_name').val();
    var propietary_doctype = $('#propietary_doctype').val();
    var propietary_numberdoc = $('#propietary_numberdoc').val();
    var propietary_gender = $('#propietary_gender').val();
    var propietary_birth = $('#propietary_birth').val();
    var propietary_email = $('#propietary_email').val();
    var propietary_phone = $('#propietary_phone').val();
    var vehicle_placa = $('#vehicle_placa').val();
    var vehicle_marca = $('#vehicle_marca').val();
    var vehicle_model = $('#vehicle_model').val();
    var vehicle_ref = $('#vehicle_ref').val();
    var todoRiesgoUso = $('input[name=todoRiesgoUso]:checked').val();
    var vehicle_city = $('#vehicle_city').val();

    var _token = $('#token_vehicleForm').val();

    //console.log(todoRiesgoUso);

    var telRegex = /3[0-9]{9}/g;
    var nitRegex = /[0-9]{9}-[0-9]{1}/g;

    if (propietary_name === '' && propietary_name.indexOf(" ") > 0) {
        return showError('Debe ingresar su nombre completo.');
    } else if (propietary_doctype === '' || propietary_doctype === 'null') {
        return showError('Debe ingresar un tipo de documento válido.');
    } else if (propietary_doctype === 'N' && !nitRegex.test(propietary_numberdoc)) {
        return showError('Debe ingresar un NIT válido (con el digito de vrificacion "-").');
    } else if (propietary_numberdoc === '' || !(propietary_numberdoc.length >= 7 && propietary_numberdoc.length <= 11)) {
        return showError('Debe ingresar un número de documento válido.');
    } else if (propietary_gender === '' || propietary_gender === 'null' && propietary_doctype != 'N') {
        return showError('Debe informarnos de su género.');
    } else if (propietary_birth === '' && propietary_doctype != 'N' || calcularEdad(propietary_birth) < 18) {
        return showError('Ingrese su fecha de nacimiento válido y debe mayor de edad.');
    } else if (propietary_email === '' || !validateEmail(propietary_email)) {
        return showError('Debe ingresar un email válido.');
    } else if (propietary_phone === '' || !telRegex.test(propietary_phone)) {
        return showError('Debe ingresar un teléfono válido.');
    } else if (vehicle_placa === '' || !expPlaca.test(vehicle_placa)) {
        return showError('Debe ingresar una placa válida.', false);
    } else if (vehicle_marca === '') {
        return showError('Debe ingresar una marca de vehículo válida.', false);
    } else if (vehicle_model === '') {
        return showError('Debe ingresar un modelo válido.', false);
    } else if (vehicle_ref === '') {
        return showError('Debe ingresar una referencia válida.', false);
    } else if (!todoRiesgoUso || todoRiesgoUso === '') {
        return showError('Debe seleccionar si el auto es nuevo o usado.', false);
    } else if (vehicle_city === '' || vehicle_city === 'null') {
        return showError('Debe ingresar la ciudad del vehículo.', false);
    } else {
        $.ajax({
            url: backendURL + '/api/register-vehicle',
            method: 'POST',
            data: {
                _token,
                form_person_name: propietary_name,
                form_person_doctype: propietary_doctype,
                form_person_docnumber: propietary_numberdoc,
                form_person_gender: propietary_gender,
                form_person_birth: propietary_birth,
                form_person_email: propietary_email,
                form_person_phone: propietary_phone,
                form_vehi_placa: vehicle_placa,
                form_vehi_marca: vehicle_marca,
                form_vehi_model: vehicle_model,
                form_vehi_code: vehicle_ref,
                form_vehi_used: todoRiesgoUso,
                form_vehi_city: vehicle_city,
                form_vehi_brand: $('#brand').val(),
                form_vehi_brandline: $('#brandline').val(),
                form_vehi_classid: $('#classid').val(),
                form_vehi_valorasegurado: $('#valorasegurado').val(),
            },
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(res) {
                //console.log(res);
                if (!res.error) {
                    //var redirect = $('#todoRiesgoURL').val();
                    location.replace("todo-riesgo-list/" + res.id);
                    /*
                    $.redirectPost(redirect, {
                        _token: $('#token_vehicleForm').val(),
                        salida: res.data_external,
                    });
                    */
                } else if (res.ref == 2) {
                    $('#loader').hide();
                    location.replace("error-cotizacion/" + res.id);
                    /*
                     $.redirectPost("error-cotizacion", {
                         _token: $('#token_vehicleForm').val(),
                         salida: res.data_external,
                     });
                     */
                }
                $('#loader').hide();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#loader').hide();
                $("#dialog").dialog("open");
            }
        });
    }
});



/**
 * Inicializar el selector de ciudades.
 */
function initCitySelector() {
    $('#vehicle_city').select2({
        minimumInputLength: 3,
        language: 'es',
        placeholder: 'Selecciona una ciudad',
        ajax: {
            delay: 250,
            url: function(params) {
                return backendURL + '/city/get-by-name/' + params.term;
            },
            processResults: function(data) {
                var citiesResults = [];
                for (var i = 0; i < data.data.cities.length; i++) {
                    var element = data.data.cities[i];
                    citiesResults.push({
                        text: element.ct_name + " (" + element.dp_name + ")",
                        id: element.ct_id
                    });
                }

                return {
                    results: citiesResults
                };
            }
        }
    });
}

/**
 * Inoicializar el selector de referencias para hacer el autocompletado.
 */
function initReferencesSelector() {
    $('#vehicle_ref').select2({
        minimumInputLength: 3,
        ajax: {
            delay: 250,
            url: function(params) {
                return backendURL + '/mark-fasecolda/get-by-name/' + params.term;
            },
            processResults: function(data) {
                var references = [];
                for (var i = 0; i < data.data.references.length; i++) {
                    var element = data.data.references[i];
                    references.push({
                        id: element.mf_code,
                        text: element.mf_name,
                        mf_id: element.mf_id
                    });
                }

                return {
                    results: references
                };
            }
        }
    });
}

function initDatePickerBirthday() {
    $('.hasDatepicker').datepicker({
        autoHide: true,
        format: 'dd-mm-yyyy',
        language: 'es-ES'
    });
}


function calcularEdad(fecha_nacimiento) {
    var hoy = new Date();
    var divisiones = fecha_nacimiento.split("-")
    var cumpleanos = new Date(divisiones[2] + "-" + divisiones[1] + "-" + divisiones[0]);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();
    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }
    return edad;
}

initCitySelector();
initReferencesSelector();
initDatePickerBirthday();