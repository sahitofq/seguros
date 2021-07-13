@component('layout.header')
@endcomponent
<div id="loader">
    <div class="spinner">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
</div>
<div id="dialog" class="hide" title="Error">
    <p>Error en la conexion con las aseguradoras</p>
</div>
<div id="content">
    @yield('content')
</div>
@component('layout.footer')
@endcomponent
