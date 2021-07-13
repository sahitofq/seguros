@extends('layout.site-layout')
@section('content')

    <section id="todo-riesgo-section">
        <div class="inf-stuck">
            <div class="linea">
                <div class="container">
                    <h1 class="record wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                        COTIZA TU SEGURO TODO RIESGO EN TIEMPO RECORD
                    </h1>
                </div>
            </div>
        </div>
        <div class="banner-landing2" data-wow-duration="1s">
            <div class="img_fleft_floa">
                <img src="img/experiencia.png" alt="" />
            </div>
            <div class="container">
                <form id="contact-form">
                    <input type="hidden" value="{{ csrf_token() }}" id="token_vehicleForm">
                    <article class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <h2 class="datos">Ingresa tus datos</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                            <div class="box_content">
                                <div class="banner_box second1">
                                    <h4>
                                        Datos del propietario
                                    </h4>
                                    <div class="error-message-wrap" id='errorMessagePropietario'></div>
                                    <div class="campo-inf">
                                        <div class="contact-form">
                                            <div class="wrapper">
                                                <div class="coll-12">
                                                    <label class="name wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.3s">
                                                        <input type="text" id='propietary_name'
                                                            placeholder="* Nombre completo" />
                                                    </label>
                                                </div>

                                                <div class="coll-12">
                                                    <label class="email wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.5s">
                                                        <select class="select-blacki" type="text" id='propietary_doctype'
                                                            name="select">
                                                            <option selected enable value="null">Tipo de documento</option>
                                                            <option value="CD">Carnet Diplomático</option>
                                                            <option value="CC">Cédula de Ciudadanía</option>
                                                            <option value="CE">Cédula de Extranjería</option>
                                                            <option value="N">N.I.T</option>
                                                            <option value="PA">Pasaporte</option>
                                                            <option value="RC">Registro Civil</option>
                                                            <option value="TI">Tarjeta de Identidad</option>
                                                        </select>
                                                    </label>
                                                </div>

                                                <div class="coll-12">
                                                    <label class="phone wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.6s">
                                                        <input type="text" id='propietary_numberdoc'
                                                            placeholder="* Número de documento" value="" />
                                                    </label>
                                                </div>
                                                <div class="coll-12">
                                                    <label class="email wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.5s">
                                                        <select class="select-blacki" type="text" id='propietary_gender'
                                                            required name="select">
                                                            <option selected enable value="null">Sexo</option>
                                                            <option value="F">Femenino</option>
                                                            <option value="M">Masculino</option>
                                                            <!--<option value="PJ">Persona jurídica</option>-->
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="coll-12">
                                                    <input type="text" readonly id='propietary_birth'
                                                        placeholder="* fecha de nacimiento" class="hasDatepicker">
                                                </div>
                                                <div class="coll-12">
                                                    <label class="email wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.5s">
                                                        <input type="email" id='propietary_email'
                                                            placeholder="* Correo electrónico" value="" />
                                                    </label>
                                                </div>
                                                <div class="coll-12">
                                                    <label class="email wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.5s">
                                                        <input type="phone" id='propietary_phone'
                                                            placeholder="* Número celular" value="" />
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                            <div class="box_content">
                                <div class="banner_box second1">
                                    <h4>
                                        Datos de tu vehiculo
                                    </h4>
                                    <div class="error-message-wrap" id='errorMessageVehicle'>
                                        Error al personalizar error
                                    </div>
                                    <div class="campo-inf">
                                        <div class="contact-form">
                                            <div class="wrapper">
                                                <div class="coll-12">
                                                    <label class="name wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.3s">
                                                        <input type="text" id='vehicle_placa' value="{{ $data['placa'] }}" disabled
                                                            placeholder="* Placa" value="" />
                                                    </label>
                                                </div>
                                                <div class="coll-12">
                                                    <label class="name wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.3s">
                                                        <input type="text" id='vehicle_marca' placeholder="* Marca" disabled
                                                            value="{{ explode(' ', $data['mf_name'])[0] }}" />
                                                    </label>
                                                </div>
                                                <div class="coll-12">
                                                    <label class="name wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.3s">
                                                        <input type="text" id='vehicle_model' placeholder="* Modelo" disabled
                                                            value="{{ $data['model'] }}" />
                                                    </label>
                                                </div>

                                                <div class="coll-12" style="margin-bottom: 12px">
                                                    <label class="name wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.3s">
                                                        <select id="vehicle_ref" placeholder='Seleccione una referencia' disabled> 
                                                            <option selected value="{{ $data['mf_code'] }}">
                                                                {{ $data['mf_name'] }}</option>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="coll-12" style="margin-bottom: 10px;">
                                                    <div class="checkbox-todo-riesgo wow slideInRight"
                                                        data-wow-duration="1s" data-wow-delay="0.5s">
                                                        <div class="checkbox-tr-wrapper-left">
                                                            <input type="radio" name="todoRiesgoUso" value='Nuevo'
                                                                id='todoRiesgoUsoNuevo'>
                                                            <label for="todoRiesgoUsoNuevo">
                                                                <div class="checkbox-tr checkbox-tr-left">
                                                                    <div class="checkbox-radio"></div>
                                                                    <span>Nuevo</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox-tr-wrapper-right">
                                                            <input type="radio" name="todoRiesgoUso" value='Usado'
                                                                id='todoRiesgoUsoUsado'>
                                                            <label for="todoRiesgoUsoUsado">
                                                                <div class="checkbox-tr checkbox-tr-right">
                                                                    <div class="checkbox-radio"></div>
                                                                    <span>Usado</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="coll-12">
                                                    <label class="email wow slideInRight" data-wow-duration="1s"
                                                        data-wow-delay="0.7s">
                                                        <style>
                                                            .select2-container {
                                                                width: 100% !important;
                                                            }

                                                            .select2-container .select2-selection--single {
                                                                height: 42px !important;
                                                                padding: 6px !important;
                                                            }

                                                            .select2-container--default .select2-selection--single .select2-selection__arrow {
                                                                height: 38px !important;
                                                            }

                                                        </style>
                                                        <select id="vehicle_city">
                                                            <option value="null" selected>Seleccione una ciudad</option>
                                                        </select>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <div class="btns central">
                                <input type="hidden" id='todoRiesgoURL' value="{{ url('/todo-riesgo-list') }}">
                                <input type="hidden" id='brand' value="{{ $data['brand'] }}">
                                <input type="hidden" id='brandline' value="{{ $data['brandline'] }}">
                                <input type="hidden" id='classid' value="{{ $data['classid'] }}">
                                <input type="hidden" id='valorasegurado' value="{{ $data['valorasegurado'] }}">
                                <button class="btn btn-primary btn1" type="submit">¡COTIZA AHORA!</button>
                            </div>
                        </div>
                    </article>
                </form>
            </div>
        </div>
    </section>

@endsection
