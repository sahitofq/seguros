@extends('layout.site-layout')
@section('content')

    <div class="inf-stuck">
        <div class="linea">
            <div class="container">
                <h1 class="record wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                    COTIZA TU SEGURO TODO RIESGO EN TIEMPO RECORD
                </h1>
            </div>
        </div>
    </div>
    <div class="container">
        <article class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="box_content">
                    <div class="banner_box">
                        <div class="campo-inf" style="margin-top: 30px">
                            <div class="wrapper">
                                <div class="box-info-detalle">
                                    <div class="box-info-segmento">
                                        <div class="segmento-colum col-lg-4 col-md-4 col-sm-12">
                                            <img src="{{ asset('img/seguros/' . strtolower($seguro->seguro_seguro) . '.jpg') }}"
                                                alt="{{ $seguro->seguro_seguro }}" />
                                        </div>
                                        <div class="segmento-colum col-lg-4 col-md-4 col-sm-12 espaciotop">
                                            <div class="segmento-colum col-lg-6 col-md-6 col-sm-6">
                                                <div class="til-respues">Tipo de seguro</div>
                                                <div class="til-respues-price">Todo riesgo</div>
                                            </div>
                                            <div class="segmento-colum col-lg-6 col-md-6 col-sm-6">
                                                <div class="til-respues">Daño - Pérdida total</div>
                                                <div class="til-respues-price"> {{ $seguro->seguro_d_total }}%</div>
                                            </div>
                                            <div class="segmento-colum col-lg-6 col-md-6 col-sm-6">
                                                <div class="til-respues">Hurto - Pérdida total</div>
                                                <div class="til-respues-price"> {{ $seguro->seguro_h_total }}%</div>
                                            </div>
                                            <div class="segmento-colum col-lg-6 col-md-6 col-sm-6">
                                                <div class="til-respues">Daños a terceros</div>
                                                <div class="til-respues-price">
                                                    ${{ number_format($seguro->seguro_tercero, 0, ',', '.') }}
                                                    millones</div>
                                            </div>
                                            <div class="segmento-colum col-lg-6 col-md-6 col-sm-6">
                                                <div class="til-respues">Daño - Pérdida parcial deducible</div>
                                                <div class="til-respues-price">
                                                    {{ !strpos($seguro->seguro_d_parcial, 'SMMLV') ? '$' . number_format($seguro->seguro_d_parcial, 0, ',', '.') : $seguro->seguro_d_parcial . '%' }}
                                                </div>
                                            </div>
                                            <div class="segmento-colum col-lg-6 col-md-6 col-sm-6">
                                                <div class="til-respues">Hurto - Pérdida parcial deducible</div>
                                                <div class="til-respues-price">
                                                    {{ !strpos($seguro->seguro_h_parcial, 'SMMLV') ? '$' . number_format($seguro->seguro_h_parcial, 0, ',', '.') : $seguro->seguro_h_parcial . '%' }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="segmento-colum col-lg-4 col-md-4 col-sm-12">
                                            <div class="price-tarjeta">
                                                <div class="fondo-tarjeta">
                                                    <div class="text-tarjetap tilg"> Pago de contado <b class="u-fontBold">
                                                            ${{ number_format($seguro->seguro_real_seguro, 0, ',', '.') }}
                                                        </b> </div>
                                                    <!--  <div class="text-tarjeta campo-fon">
                                                                                    <div class="text-tarjeta-prin col-lg-6 col-md-12 col-sm-12">
                                                                                        Subtotal:
                                                                                    </div>
                                                                                    <div class="text-tarjeta-gen">
                                                                                        $1.898.378
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-tarjeta">
                                                                                    <div class="text-tarjeta-prin col-lg-6 col-md-12 col-sm-12">
                                                                                        Gastos de emisión:
                                                                                    </div>
                                                                                    <div class="text-tarjeta-gen">
                                                                                        $1.898.378
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-tarjeta campo-fon">
                                                                                    <div class="text-tarjeta-prin col-lg-6 col-md-12 col-sm-12">
                                                                                        Valor IVA:
                                                                                    </div>
                                                                                    <div class="text-tarjeta-gen">
                                                                                        $1.898.378
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-tarjeta">
                                                                                    <div class="text-tarjeta-prin col-lg-6 col-md-12 col-sm-12">
                                                                                        Subtotal:
                                                                                    </div>
                                                                                    <div class="text-tarjeta-gen">
                                                                                        $1.898.378
                                                                                    </div>
                                                                                </div>
                                                                                -->
                                                    <div class="btns central">
                                                        <a href="{{ asset('/excel/' . $seguro->seguro_nombre . '/' . $seguro->seguro_form_id . '/send') }}"
                                                            class="btn_ver">¡Iniciar Compra!</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (count($resumen))
                                        <div class="box-info-respt">
                                            <div class="general-text">
                                                <div class="general-text-black">Resumen</div>
                                                <ul>
                                                    @foreach ($resumen as $item)
                                                        <li>{{ $item->resumen_nombre }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    @if (count($afectacion))
                                        <div class="box-info-respt">
                                            <div class="general-text">
                                                <div class="general-text-black">Afectación a terceros</div>
                                                <ul>
                                                    @foreach ($afectacion as $item)
                                                        <li>{{ $item->resumen_nombre }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    @if (count($perdida))
                                        <div class="box-info-respt">
                                            <div class="general-text">
                                                <div class="general-text-black">Daños o pérdidas</div>
                                                <ul>
                                                    @foreach ($perdida as $item)
                                                        <li>{{ $item->resumen_nombre }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    @if (count($conducir))
                                        <div class="box-info-respt">
                                            <div class="general-text">
                                                <div class="general-text-black">Si no puedes conducir</div>
                                                <ul>
                                                    @foreach ($conducir as $item)
                                                        <li>{{ $item->resumen_nombre }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    @if (count($lastimas))
                                        <div class="box-info-respt">
                                            <div class="general-text">
                                                <div class="general-text-black">Si te lastimas</div>
                                                <ul>
                                                    @foreach ($lastimas as $item)
                                                        <li>{{ $item->resumen_nombre }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    @if (count($otros))
                                        <div class="box-info-respt">
                                            <div class="general-text">
                                                <div class="general-text-black">Otros beneficios</div>
                                                <ul>
                                                    @foreach ($otros as $item)
                                                        <li>{{ $item->resumen_nombre }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>

@endsection
