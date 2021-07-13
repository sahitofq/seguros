@extends('mail.mail_footer')
@section('mailinfo')
    <tr>
        <td width="73"></td>
        <td width="577">
            <p style="font-weight: bold; font-size: 18px;">Hola asesor puma, el usuario: </p>
        </td>
    </tr>
    <tr>
        <td height="99" rowspan="2">&nbsp;</td>
        <td style="text-align: left">
            <table width="541" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td style="text-align: left"><strong>Nombre</strong>: {{ $users->form_person_name }} </td>
                        <td style="text-align: left"><strong>{{ $users->form_person_doctype }}
                            </strong>{{ $users->form_person_docnumber }} </td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Cel: </strong>{{ $users->form_person_phone }} </td>
                        <td style="text-align: left"><strong>mail:</strong>{{ $users->form_person_email }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
        </td>
    </tr>
    <tr>
        <td>Solicito una cotización de su seguro todo riesgo, la cual no fue posible cotizar con ninguna aseguradora.</td>
    </tr>
@endsection
