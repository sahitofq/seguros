@extends('mail.mail_footer')
@section('mailinfo')
    <tr>
        <td width="73"></td>
        <td width="577">
            <p style="font-weight: bold; font-size: 18px;">Cordial saludo <br>
                {{ $users->form_person_name }}</p>
        </td>
    </tr>
    <tr>
        <td height="99">&nbsp;</td>
        <td>Recibimos tu solicitud para adquirir un seguro confiable con<br>
            nosotros, tenemos para ti la mejor cotización que arroja <br>
            nuestro sistema, la cual puedes descargar ahora.</td>
    </tr>
    <tr>
        <td height="75" colspan="2" style="text-align: center">
            <a href="{{ env('APP_URL') }}/excel/{{ $users->seguro_nombre }}/{{ $users->form_id }}">
                <img src="{{ env('APP_URL') }}/img/email/boton.jpg" width="345" height="44" />
            </a>
        </td>
    </tr>
    <tr>
        <td height="76">&nbsp;</td>
        <td>En poco nos contactaremos contigo para para conocer un poco<br>
            más sobre lo que estás buscando, o si prefieres escríbenos a: </td>
    </tr>
    <tr>
        <td height="62">&nbsp;</td>
        <td><a href="mailto:{{ $asesor->asesor_correo }}" style="color: #c66700">{{ $asesor->asesor_correo }}</a><br>
            o comunícate al <span style="color: #c66700">+ 57 {{ $asesor->asesor_telefono }}</span></td>
    </tr>
    <tr>
        <td height="46">&nbsp;</td>
        <td>¡Feliz día!</td>
    </tr>
@endsection
