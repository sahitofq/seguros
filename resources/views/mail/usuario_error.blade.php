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
        <td>Recibimos tu solicitud para adquirir un seguro confiable con <br>
            nosotros, la cual nos arrojó información que tu vehículo, <br>
            no puede obtener una cotización en este momento.</td>
    </tr>
    <tr>
        <td height="95">&nbsp;</td>
        <td>Si prefieres puedes escríbenos a: <a href="mailto:{{ $asesor->asesor_correo }}"
                style="color: #c66700">{{ $asesor->asesor_correo }}</a> o comunícate al <span style="color: #c66700"><br>
                + 57 {{ $asesor->asesor_telefono }}</span>, o en poco nos contactaremos contigo <br>
            para para conocer un poco más sobre lo que estás buscando.</td>
    </tr>
    <tr>
        <td height="46">&nbsp;</td>
        <td>¡Feliz día!</td>
    </tr>
    <tr>
   
@endsection
