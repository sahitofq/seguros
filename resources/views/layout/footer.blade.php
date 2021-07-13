<!--==============================footer=================================-->
<footer id="footer" class="footer">
    <div class="container">

        <div class="row row_3">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="logofooter">
                    <a href="{{ asset('/') }}">
                        <img alt="logo" src="{{ asset('img/logo-pie.svg') }}" />
                    </a>
                </div>
                <ul class="footer_list">
                    <li>
                        <p class="left">Seguros puma tiene actividades de asesoría, compra y análisis para seguros todo
                            riesgo
                            para su auto, estamos respaldados por de las más grandes compañías de seguros del país.</p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <h4 class="footer_title">CONTACTO</h4>
                <ul class="footer_list">
                    <li>
                        <p>
                            ¡Escríbenos o llámanos, respondemos enseguida!
                        </p>
                    </li>
                    <li><br>

                        <p>
                            <img src="{{ asset('img/cel.svg') }}" alt="" />Cel: +57 318 842-5431
                        </p>
                    </li>
                    <li>
                        <p>
                            <img src="{{ asset('img/mail.svg') }}" alt="" />info@segurospuma.com
                        </p>
                    </li>
                </ul>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <h4 class="footer_title second">SIGUENOS EN:</h4>
                <ul class="footer_cos">
                    <li><a href="{{ asset('/') }}"><span class="fa-facebook"></span></a></li>
                    <li><a href="{{ asset('/') }}"><span class="fa-instagram"></span></a></li>
                    <li><a href="{{ asset('/') }}"><span class="fa-linkedin"></span></a></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <article class="col-lg-12">
                <div class="copyright">&copy; <span id="copyright-year"></span> Seguros Puma 2020. <a
                        href="{{ asset('/') }}">Políticas de privacidad</a></div>

            </article>
        </div>
    </div>
</footer>






<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/menu.js') }}"></script>
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="{{ asset('js/touchTouch.jquery.js') }}"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>

<!--<script src="{{ asset('js/tm-scripts.js') }}"></script>
<script src="{{ asset('js/animate.js') }}"></script>
-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
