@extends('layout.site-layout')
@section('content')

    <section id="todo-riesgo-section">
        <div class="banner-landing2" data-wow-duration="1s">
            <div class="img_fleft_floa">
                <img src="{{ asset('img/experiencia.png') }}" alt="" />
            </div>

            <div class="container">
                <article class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h2 class="datos">Resultados de todo riesgo</h2>
                    </div>
                    @foreach ($salida as $key => $seguro)
                        <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <div class="box_content">
                                <div class="banner_box second2">
                                    <div class="campo-inf" style="margin-top: 30px">
                                        <form id="contact-form" class="contact-form">
                                            <div class="wrapper">
                                                <div class="box-info">
                                                    <div class="box-info-segmento">
                                                        <div class="segmento-colum col-lg-3 col-md-2 col-sm-12">
                                                            <img src="{{ asset('img/seguros/' . strtolower($seguro['seguro_seguro']) . '.jpg') }}"
                                                                alt="{{ $seguro['seguro_seguro'] }}" />
                                                        </div>
                                                        <div class="segmento-colum col-lg-7 col-md-8 col-sm-12">
                                                            <div class="til-info">
                                                                {{ $seguro['seguro_nombre'] }}
                                                            </div>
                                                            <div class="price-info">
                                                                ${{ number_format($seguro['seguro_real_seguro'], 0, ',', '.') }}
                                                            </div>
                                                            <!--<div class="extra-info">o 10 cuotas de $573.241 </div>-->
                                                        </div>
                                                        <div class="segmento-colum col-lg-2 col-md-2 col-sm-12">
                                                            <div class="btns central">
                                                                <a class="btn_ver" target="_blank"
                                                                    href="{{ asset('/todo-riesgo-list/' . $id . '/' . $seguro['seguro_nombre']) }}"
                                                                    data-type="submit">¡VER
                                                                    MÁS!</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-info-respt">
                                                        <div class="segmento-colum col-lg-4 col-md-4 col-sm-12">
                                                            <div class="til-respues">Tipo de seguro</div>
                                                            <div class="til-respues-price">Todo riesgo </div>
                                                        </div>
                                                        <div class="segmento-colum col-lg-4 col-md-4 col-sm-12">
                                                            <div class="til-respues">Daño - Pérdida total</div>
                                                            <div class="til-respues-price">
                                                                {{ $seguro['seguro_d_total'] }}%
                                                            </div>
                                                        </div>
                                                        <div class="segmento-colum col-lg-4 col-md-4 col-sm-12">
                                                            <div class="til-respues">Hurto - Pérdida total</div>
                                                            <div class="til-respues-price">
                                                                {{ $seguro['seguro_h_total'] }}%</div>
                                                        </div>
                                                    </div>
                                                    <div class="box-info-respt">
                                                        <div class="segmento-colum col-lg-4 col-md-4 col-sm-12">
                                                            <div class="til-respues">Daños a terceros</div>
                                                            <div class="til-respues-price">
                                                                ${{ number_format($seguro['seguro_tercero'], 0, ',', '.') }}
                                                                millones
                                                            </div>
                                                        </div>
                                                        <div class="segmento-colum col-lg-4 col-md-4 col-sm-12">
                                                            <div class="til-respues">Daño - Pérdida parcial deducible</div>
                                                            <div class="til-respues-price">
                                                                {{ !strpos($seguro['seguro_d_parcial'], 'SMMLV') ? '$' . number_format($seguro['seguro_d_parcial'], 0, ',', '.') : $seguro['seguro_d_parcial'] . '%' }}
                                                            </div>
                                                        </div>
                                                        <div class="segmento-colum col-lg-4 col-md-4 col-sm-12">
                                                            <div class="til-respues">Hurto - Pérdida parcial deducible</div>
                                                            <div class="til-respues-price">
                                                                {{ !strpos($seguro['seguro_h_parcial'], 'SMMLV') ? '$' . number_format($seguro['seguro_h_parcial'], 0, ',', '.') : $seguro['seguro_h_parcial'] . '%' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </article>

            </div>
        </div>
    </section>

@endsection
