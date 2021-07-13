@extends('layout.site-layout')
@section('content')

    <section id="banner">
        <!--=================== banner ==================-->
        <div class="inf-stuck">
            <div class="linea">
                <div class="container">
                    <h1 class="record wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                        COTIZA TU SEGURO TODO RIESGO EN TIEMPO RECORD
                    </h1>
                </div>
            </div>
        </div>
        <div class="banner-landing" data-wow-duration="1s">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="img_fright">
                    <img src="img/experiencia.png" alt="" />
                </div>
            </div>
            <div class="container">
                <article class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                        <div class="box_content">
                            <h2 class="text-blanco bounceInDown animated">
                                <span class="span1">TRABAJAMOS</span> <br>
                                <span class="span2">con las más importantes </span>
                                <span class="span3">aseguradoras del país.</span><br>
                                <br>
                                <span class="span4">Encuentra tu seguro todo riesgo en cuestión de minutos.</span><br>
                                <span class="span4">Un asesor pronto se comunicará contigo.</span> <br>
                            </h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                        <div class="box_content">
                            <div class="banner_box second1">
                                <h4>
                                    Ingresa los datos de tu vehículo.
                                </h4>
                                <div class="campo-inf">
                                    <form id="form-home" class="contact-form checkPlacaIngresed">
                                        <input type="hidden" id='todoRiesgoURL' value="{{ url('/post-todo-riesgo') }}">
                                        <input type="hidden" id='tokenTodoRiesgo' value="{{ csrf_token() }}">
                                        <label class="name wow slideInRight" data-wow-duration="1s" data-wow-delay="0.3s">
                                            <input type="text" name="name" placeholder="Número de placa"
                                                id="namePlacaInput" />
                                            <div id="placaErrorMessage">
                                                <span class="error-message">*Verifique la información.</span>
                                            </div>
                                        </label>
                                        <div class="btns">
                                            <button type="submit" class="btn btn-primary btn1">¡COTIZA AHORA!</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="row_1">
        <div class="linea">
            <div class="container">
                <article class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="campofon">
                            <div class="central">
                                <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">NUESTRAS PÓLIZAS
                                    CUBREN</h4>
                                <h5 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">Todo tipo de daño y
                                    gestión.
                                </h5>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <div class="container">
        <article class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="border_box">
                    <img src="{{ asset('img/servicio/ser1.svg') }}" alt="" />
                    <div class="box_content">
                        <h5>Daños a terceros</h5>
                        <p class="second">
                            Praesent vestibulum mole lacus. Aenan nonummy hendrerit mauris. Phasellus porta.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="border_box">
                    <img src="{{ asset('img/servicio/ser2.svg') }}" alt="" />

                    <div class="box_content">
                        <h5>Servicio de grúa</h5>
                        <p class="second">
                            Praesent vestibulum mole lacus. Aenan nonummy hendrerit mauris. Phasellus porta.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="border_box">
                    <img src="{{ asset('img/servicio/ser3.svg') }}" alt="" />
                    <div class="box_content">
                        <h5>Servicio técnico</h5>
                        <p class="second">
                            Praesent vestibulum mole lacus. Aenan nonummy hendrerit mauris. Phasellus porta.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="border_box">
                    <img src="{{ asset('img/servicio/ser4.svg') }}" alt="" />

                    <div class="box_content">
                        <h5>Revisión periodica</h5>
                        <p class="second">
                            Praesent vestibulum mole lacus. Aenan nonummy hendrerit mauris. Phasellus porta.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="border_box">
                    <img src="{{ asset('img/servicio/ser5.svg') }}" alt="" />

                    <div class="box_content">
                        <h5>Descuentos en técnomecainca</h5>
                        <p class="second">
                            Praesent vestibulum mole lacus. Aenan nonummy hendrerit mauris. Phasellus porta.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="border_box">
                    <img src="{{ asset('img/servicio/ser6.svg') }}" alt="" />

                    <div class="box_content">
                        <h5>Asitencia legal</h5>
                        <p class="second">
                            Praesent vestibulum mole lacus. Aenan nonummy hendrerit mauris. Phasellus porta.
                        </p>
                    </div>
                </div>
            </div>
        </article>
    </div>

    <div class="row_4">
        <section class="row_6">
            <div class="linea_negra">
                <div class="container">
                    <article class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="campofon_blanco">
                                <div class="central">
                                    <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">LO ULTIMO</h4>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <div class="container">
            <article class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <img src="{{ asset('img/paga2_img1.jpg') }}" alt="page2_img" class="full_width">
                    <h5 class="noticia">
                        QUE HACER EN CASO DE SINIESTRO
                    </h5>
                    <p class="second">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum mole lacus. Aenan
                        nonummy
                        hendrerit mauris. Phasellus porta. Fusce suscipit mi.
                    </p>
                    <a href="#" class="castom_btn">Leer más</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.8s">
                    <img src="{{ asset('img/paga2_img2.jpg') }}" alt="page2_img" class="full_width">
                    <h5 class="noticia">
                        QUE HACER EN CASO DE SINIESTRO
                    </h5>
                    <p class="second">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum mole lacus. Aenan
                        nonummy
                        hendrerit mauris. Phasellus porta. Fusce suscipit mi.
                    </p>
                    <a href="#" class="castom_btn">Leer más</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.1s">
                    <img src="{{ asset('img/paga2_img3.jpg') }}" alt="page2_img" class="full_width">
                    <h5 class="noticia">
                        QUE HACER EN CASO DE SINIESTRO
                    </h5>
                    <p class="second">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum mole lacus. Aenan
                        nonummy
                        hendrerit mauris. Phasellus porta. Fusce suscipit mi.
                    </p>
                    <a href="#" class="castom_btn">Leer más</a>
                </div>
            </article>
        </div>
    </div>

    <div class="row_3">
        <section class="row_3">
            <div class="linea_blanca">
                <div class="container">
                    <article class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="campofon_claro">
                                <div class="central">
                                    <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">ALIADOS</h4>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>



    <div class="wrapper">
        <div class="container">
            <article class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="owl_wrap2">
                        <div id="owl2">
                            <div class="item">
                                <img src="{{ asset('img/owl_img1.jpg') }}" alt="owl_img">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/owl_img2.jpg') }}" alt="owl_img">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/owl_img3.jpg') }}" alt="owl_img">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/owl_img4.jpg') }}" alt="owl_img">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/owl_img5.jpg') }}" alt="owl_img">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/owl_img6.jpg') }}" alt="owl_img">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/owl_img7.jpg') }}" alt="owl_img">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/owl_img8.jpg') }}" alt="owl_img">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/owl_img1.jpg') }}" alt="owl_img">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/owl_img2.jpg') }}" alt="owl_img">
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <!--
        <script>
            $(document).ready(function(){
                  $('#slider').camera({
                      height: '30.7%',
                      loader: true,
                      minHeight: '200px',
                      navigation: true,
                      navigationHover: false,
                      pagination: false,
                      playPause: false,
                      thumbnails: false,
                      time: 3000,
                      fx: 'simpleFade'
                      
                  });
              });
          
              $(function(){
                  $('a.touch_img').touchTouch();
              });
          </script>
        -->
    <script>
        $(document).ready(function() {
            $("#owl1").owlCarousel({
                navigation: false,
                pagination: true,
                autoPlay: 600000, //Set AutoPlay to 3 seconds

                itemsCustom: [
                    [0, 1],
                    [767, 1],
                    [991, 1],
                    [1170, 1],
                    [1200, 1]
                ]
            });
        });

        $(document).ready(function() {
            $("#owl2").owlCarousel({
                navigation: true,
                pagination: false,
                autoPlay: 600000, //Set AutoPlay to 3 seconds

                itemsCustom: [
                    [320, 2],
                    [480, 3],
                    [767, 5],
                    [995, 6],
                    [1170, 8],
                    [1920, 8]
                ]
            });
        });

    </script>
@endsection
